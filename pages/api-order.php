<?php
/*
 * POST /api/order — JSON body: { customer: {...}, items: [{slug, variant, note, qty}], website: "" }
 * Responds with { status: "success", order_no } or { status: "error", message, errors }.
 */
require_once __DIR__ . '/../inc/orders.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

function respond(int $code, array $body): void
{
	http_response_code($code);
	echo json_encode($body, JSON_UNESCAPED_UNICODE);
	exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
	header('Allow: POST');
	respond(405, ['status' => 'error', 'message' => 'Method not allowed.']);
}

$raw = file_get_contents('php://input', false, null, 0, 200000);
$in = json_decode($raw ?: '', true);
if (!is_array($in)) {
	respond(400, ['status' => 'error', 'message' => 'Invalid request.']);
}

// Honeypot: real visitors never fill this hidden field.
if (!empty($in['website'])) {
	respond(200, ['status' => 'success', 'order_no' => generate_order_no()]);
}

[$order, $errors] = validate_order($in);
if ($errors) {
	respond(422, ['status' => 'error', 'message' => 'Please check the highlighted fields.', 'errors' => $errors]);
}

$ip = $_SERVER['REMOTE_ADDR'] ?? '';
try {
	if (too_many_orders($ip)) {
		respond(429, ['status' => 'error', 'message' => 'Too many orders from your connection. Please call our sales team.']);
	}
	$orderNo = create_order($order, $ip);
} catch (Throwable $e) {
	error_log('Order failed: ' . $e->getMessage());
	respond(500, ['status' => 'error', 'message' => 'We could not save your order right now. Please try again or call our sales team.']);
}

respond(201, ['status' => 'success', 'order_no' => $orderNo]);
