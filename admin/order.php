<?php
require __DIR__ . '/bootstrap.php';
$admin = require_admin();

$id = (int) ($_GET['id'] ?? 0);
$stmt = db()->prepare('SELECT * FROM orders WHERE id = ?');
$stmt->execute([$id]);
$order = $stmt->fetch();
if (!$order) {
	http_response_code(404);
	admin_start('Order not found', $admin);
	echo '<div class="admin-head"><h1>Order not found</h1></div><a class="link-arrow" href="' . admin_url() . '">← Back to orders</a>';
	admin_end();
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	check_csrf();
	$newStatus = (string) ($_POST['status'] ?? '');
	$note = mb_substr(trim((string) ($_POST['note'] ?? '')), 0, 500);
	if (!isset($ORDER_STATUSES[$newStatus])) {
		flash('Please choose a valid status.', 'err');
	} elseif ($newStatus === $order['status'] && $note === '') {
		flash('No changes to save.', 'err');
	} else {
		$pdo = db();
		$pdo->beginTransaction();
		$pdo->prepare('UPDATE orders SET status = ? WHERE id = ?')->execute([$newStatus, $id]);
		$pdo->prepare('INSERT INTO order_status_history (order_id, status, note, admin_id) VALUES (?, ?, ?, ?)')->execute([$id, $newStatus, $note, $admin['id']]);
		$pdo->commit();
		flash($newStatus === $order['status'] ? 'Note added.' : 'Status updated to ' . $ORDER_STATUSES[$newStatus] . '.');
	}
	redirect(admin_url('order.php', ['id' => $id]));
}

$items = db()->prepare('SELECT * FROM order_items WHERE order_id = ? ORDER BY id');
$items->execute([$id]);
$items = $items->fetchAll();

$history = db()->prepare('SELECT h.*, a.name AS admin_name, a.username FROM order_status_history h LEFT JOIN admins a ON a.id = h.admin_id WHERE h.order_id = ? ORDER BY h.created_at DESC, h.id DESC');
$history->execute([$id]);
$history = $history->fetchAll();

function unit_label(string $unit, int $qty): string
{
	return $unit === 'kg' ? 'kg' : ($qty === 1 ? $unit : $unit . 's');
}

admin_start('Order ' . $order['order_no'], $admin);
?>
<a class="link-arrow back" href="<?= admin_url() ?>">← All orders</a>
<div class="admin-head">
	<div>
		<p class="eyebrow">Order</p>
		<h1><?= e($order['order_no']) ?> <?= status_badge($order['status']) ?></h1>
		<p class="muted">Placed <?= e(date('l, d F Y \a\t g:i A', strtotime($order['created_at']))) ?></p>
	</div>
	<button class="btn btn-ghost btn-sm no-print" type="button" onclick="window.print()">Print</button>
</div>

<div class="order-layout">
	<div class="order-col">
		<section class="panel">
			<h2>Items <span class="muted">(<?= count($items) ?>)</span></h2>
			<div class="table-wrap flat">
				<table class="data small">
					<thead><tr><th>Product</th><th>Option</th><th class="num">Quantity</th><th class="num">Unit price</th><th class="num">Total</th></tr></thead>
					<tbody>
					<?php foreach ($items as $it): ?>
						<tr>
							<td><strong><?= e($it['product_name']) ?></strong></td>
							<td><?= e($it['variant']) ?></td>
							<td class="num"><?= number_format((int) $it['quantity']) ?> <?= e(unit_label($it['unit'], (int) $it['quantity'])) ?></td>
							<td class="num"><?= $it['unit_price'] !== null ? e(lkr((float) $it['unit_price'])) : '<span class="muted">To confirm</span>' ?></td>
							<td class="num"><?= $it['line_total'] !== null ? e(lkr((float) $it['line_total'])) : '—' ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr><td colspan="4" class="num"><strong>Subtotal (priced items)</strong></td><td class="num"><strong><?= $order['subtotal'] !== null ? e(lkr((float) $order['subtotal'])) : '—' ?></strong></td></tr>
						<?php if (array_filter($items, fn($it) => $it['unit_price'] === null)): ?>
							<tr><td colspan="5" class="num muted">Items marked “To confirm” need a price from the sales team.</td></tr>
						<?php endif; ?>
					</tfoot>
				</table>
			</div>
		</section>

		<?php if ($order['notes']): ?>
		<section class="panel">
			<h2>Customer notes</h2>
			<p class="pre"><?= e($order['notes']) ?></p>
		</section>
		<?php endif; ?>

		<section class="panel">
			<h2>History</h2>
			<ol class="history">
				<?php foreach ($history as $h): ?>
					<li>
						<div class="history-top"><?= status_badge($h['status']) ?><span class="muted"><?= e(date('d M Y, g:i A', strtotime($h['created_at']))) ?></span></div>
						<?php if ($h['note']): ?><p><?= e($h['note']) ?></p><?php endif; ?>
						<small class="muted"><?= $h['admin_id'] ? 'by ' . e($h['admin_name'] ?: $h['username']) : 'Website' ?></small>
					</li>
				<?php endforeach; ?>
			</ol>
		</section>
	</div>

	<aside class="order-col">
		<section class="panel no-print">
			<h2>Update status</h2>
			<form class="form" method="post">
				<?= csrf_field() ?>
				<div class="field">
					<label for="s">Status</label>
					<select id="s" name="status">
						<?php foreach ($ORDER_STATUSES as $key => $label): ?>
							<option value="<?= e($key) ?>" <?= $order['status'] === $key ? 'selected' : '' ?>><?= e($label) ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="field"><label for="n">Note <span class="muted">(optional)</span></label><textarea id="n" name="note" maxlength="500" placeholder="e.g. Price confirmed by phone, dispatch on Monday"></textarea></div>
				<button class="btn btn-gold btn-block" type="submit">Save</button>
			</form>
		</section>

		<section class="panel">
			<h2>Customer</h2>
			<dl class="details">
				<dt>Name</dt><dd><?= e($order['customer_name']) ?></dd>
				<?php if ($order['company']): ?><dt>Company</dt><dd><?= e($order['company']) ?></dd><?php endif; ?>
				<dt>Phone</dt><dd><a href="tel:<?= e(preg_replace('/[^\d+]/', '', $order['phone'])) ?>"><?= e($order['phone']) ?></a></dd>
				<dt>Email</dt><dd><a href="mailto:<?= e($order['email']) ?>?subject=<?= rawurlencode('Your Lanka SSL order ' . $order['order_no']) ?>"><?= e($order['email']) ?></a></dd>
			</dl>
		</section>

		<section class="panel">
			<h2>Delivery address</h2>
			<address class="addr">
				<?= e($order['address_line1']) ?><br>
				<?php if ($order['address_line2']): ?><?= e($order['address_line2']) ?><br><?php endif; ?>
				<?= e($order['city']) ?><?= $order['postal_code'] ? ' ' . e($order['postal_code']) : '' ?><br>
				<?= e($order['district']) ?> District, Sri Lanka
			</address>
			<a class="link-arrow no-print" target="_blank" rel="noopener" href="https://www.google.com/maps/search/?api=1&query=<?= rawurlencode(implode(', ', array_filter([$order['address_line1'], $order['address_line2'], $order['city'], $order['district'], 'Sri Lanka']))) ?>">Open in Google Maps <?= icon('arrow-ur') ?></a>
		</section>
	</aside>
</div>
<?php admin_end(); ?>
