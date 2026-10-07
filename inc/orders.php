<?php
/*
 * Order validation and persistence, shared by the public order API and the admin panel.
 */

require_once __DIR__ . '/db.php';

const ORDER_MAX_ITEMS = 50;
const ORDER_MAX_QTY = 100000;

function clean_text($value, int $max): string
{
	$value = is_string($value) ? trim(preg_replace('/\s+/u', ' ', $value)) : '';
	return mb_substr($value, 0, $max);
}

/**
 * Validate a submitted order against the product catalogue.
 * Returns [array $order, array $errors] — $errors maps field => message.
 */
function validate_order(array $in): array
{
	global $PRODUCTS, $ORDER_OPTIONS, $DISTRICTS;
	$errors = [];

	$c = $in['customer'] ?? [];
	$order = [
		'customer_name' => clean_text($c['name'] ?? '', 120),
		'company'       => clean_text($c['company'] ?? '', 160),
		'email'         => clean_text($c['email'] ?? '', 160),
		'phone'         => clean_text($c['phone'] ?? '', 30),
		'address_line1' => clean_text($c['address_line1'] ?? '', 200),
		'address_line2' => clean_text($c['address_line2'] ?? '', 200),
		'city'          => clean_text($c['city'] ?? '', 100),
		'district'      => clean_text($c['district'] ?? '', 60),
		'postal_code'   => clean_text($c['postal_code'] ?? '', 12),
		'notes'         => mb_substr(trim((string) ($c['notes'] ?? '')), 0, 2000),
		'items'         => [],
	];

	if (mb_strlen($order['customer_name']) < 2) $errors['name'] = 'Please enter your full name.';
	if (!filter_var($order['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Please enter a valid email address.';
	$digits = preg_replace('/\D/', '', $order['phone']);
	if (strlen($digits) < 9 || strlen($digits) > 15) $errors['phone'] = 'Please enter a valid phone number.';
	if (mb_strlen($order['address_line1']) < 3) $errors['address_line1'] = 'Please enter your street address.';
	if (mb_strlen($order['city']) < 2) $errors['city'] = 'Please enter your city or town.';
	if (!in_array($order['district'], $DISTRICTS, true)) $errors['district'] = 'Please select your district.';
	if ($order['postal_code'] !== '' && !preg_match('/^\d{5}$/', $order['postal_code'])) $errors['postal_code'] = 'Postal codes have 5 digits.';

	$items = is_array($in['items'] ?? null) ? $in['items'] : [];
	if (!$items) $errors['items'] = 'Your cart is empty.';
	if (count($items) > ORDER_MAX_ITEMS) $errors['items'] = 'Too many lines in one order — please contact our sales team.';

	foreach (array_slice($items, 0, ORDER_MAX_ITEMS) as $i => $item) {
		$slug = is_string($item['slug'] ?? null) ? $item['slug'] : '';
		$variant = is_string($item['variant'] ?? null) ? $item['variant'] : '';
		$qty = filter_var($item['qty'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => ORDER_MAX_QTY]]);
		if (!isset($PRODUCTS[$slug], $ORDER_OPTIONS[$slug])) {
			$errors['items'] = 'One of the products in your cart is no longer available. Please remove it and try again.';
			continue;
		}
		if (!in_array($variant, $ORDER_OPTIONS[$slug]['variants'], true)) {
			$errors['items'] = 'Please choose a valid option for ' . $PRODUCTS[$slug]['short'] . '.';
			continue;
		}
		if ($qty === false) {
			$errors['items'] = 'Please enter a valid quantity for ' . $PRODUCTS[$slug]['short'] . '.';
			continue;
		}
		$note = clean_text($item['note'] ?? '', 200);
		$order['items'][] = [
			'product_slug' => $slug,
			'product_name' => $PRODUCTS[$slug]['name'],
			'variant'      => $note !== '' ? "$variant — $note" : $variant,
			'unit'         => $ORDER_OPTIONS[$slug]['unit'],
			'quantity'     => $qty,
		];
	}

	return [$order, $errors];
}

function generate_order_no(): string
{
	$alphabet = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
	$suffix = '';
	for ($i = 0; $i < 5; $i++) $suffix .= $alphabet[random_int(0, strlen($alphabet) - 1)];
	return 'LS' . date('ymd') . '-' . $suffix;
}

/** Insert a validated order and its items. Returns the order number. */
function create_order(array $order, string $ip): string
{
	$pdo = db();
	$pdo->beginTransaction();
	try {
		$orderNo = null;
		for ($attempt = 0; $attempt < 5 && $orderNo === null; $attempt++) {
			$candidate = generate_order_no();
			$exists = $pdo->prepare('SELECT 1 FROM orders WHERE order_no = ?');
			$exists->execute([$candidate]);
			if (!$exists->fetchColumn()) $orderNo = $candidate;
		}
		if ($orderNo === null) throw new RuntimeException('Could not allocate an order number');

		$stmt = $pdo->prepare('INSERT INTO orders (order_no, customer_name, company, email, phone, address_line1, address_line2, city, district, postal_code, notes, item_count, ip_address)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$stmt->execute([
			$orderNo, $order['customer_name'], $order['company'], $order['email'], $order['phone'],
			$order['address_line1'], $order['address_line2'], $order['city'], $order['district'], $order['postal_code'],
			$order['notes'] !== '' ? $order['notes'] : null, count($order['items']), $ip,
		]);
		$orderId = (int) $pdo->lastInsertId();

		$item = $pdo->prepare('INSERT INTO order_items (order_id, product_slug, product_name, variant, unit, quantity) VALUES (?, ?, ?, ?, ?, ?)');
		foreach ($order['items'] as $it) {
			$item->execute([$orderId, $it['product_slug'], $it['product_name'], $it['variant'], $it['unit'], $it['quantity']]);
		}
		$pdo->prepare('INSERT INTO order_status_history (order_id, status, note) VALUES (?, ?, ?)')
			->execute([$orderId, 'pending', 'Order placed on the website']);

		$pdo->commit();
		return $orderNo;
	} catch (Throwable $e) {
		$pdo->rollBack();
		throw $e;
	}
}

/** Simple abuse guard: limit orders per IP per hour. */
function too_many_orders(string $ip, int $limit = 10): bool
{
	$stmt = db()->prepare('SELECT COUNT(*) FROM orders WHERE ip_address = ? AND created_at > (NOW() - INTERVAL 1 HOUR)');
	$stmt->execute([$ip]);
	return (int) $stmt->fetchColumn() >= $limit;
}
