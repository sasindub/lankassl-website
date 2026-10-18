<?php
require __DIR__ . '/bootstrap.php';
$admin = require_admin();

$status = $_GET['status'] ?? '';
if ($status !== '' && !isset($ORDER_STATUSES[$status])) $status = '';
$q = trim((string) ($_GET['q'] ?? ''));
$page = max(1, (int) ($_GET['p'] ?? 1));
$perPage = 20;

// Counts per status for the summary cards and tabs
$counts = array_fill_keys(array_keys($ORDER_STATUSES), 0);
foreach (db()->query('SELECT status, COUNT(*) AS n FROM orders GROUP BY status') as $r) $counts[$r['status']] = (int) $r['n'];
$total = array_sum($counts);
$today = (int) db()->query('SELECT COUNT(*) FROM orders WHERE created_at >= CURDATE()')->fetchColumn();

$where = [];
$params = [];
if ($status !== '') { $where[] = 'status = ?'; $params[] = $status; }
if ($q !== '') {
	$where[] = '(order_no LIKE ? OR customer_name LIKE ? OR company LIKE ? OR email LIKE ? OR phone LIKE ?)';
	$like = '%' . str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $q) . '%';
	array_push($params, $like, $like, $like, $like, $like);
}
$sqlWhere = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$countStmt = db()->prepare("SELECT COUNT(*) FROM orders $sqlWhere");
$countStmt->execute($params);
$matching = (int) $countStmt->fetchColumn();
$pages = max(1, (int) ceil($matching / $perPage));
$page = min($page, $pages);

$stmt = db()->prepare("SELECT id, order_no, status, customer_name, company, phone, city, district, item_count, subtotal, created_at
	FROM orders $sqlWhere ORDER BY created_at DESC, id DESC LIMIT $perPage OFFSET " . (($page - 1) * $perPage));
$stmt->execute($params);
$orders = $stmt->fetchAll();

function list_url(array $over = []): string
{
	global $status, $q;
	$query = array_filter(array_merge(['status' => $status, 'q' => $q], $over), fn($v) => $v !== '' && $v !== null && $v !== 1);
	return admin_url('', $query);
}

admin_start('Orders', $admin);
?>
<div class="admin-head">
	<div>
		<p class="eyebrow">Dashboard</p>
		<h1>Orders</h1>
	</div>
</div>

<div class="kpis">
	<div class="kpi"><span>Total orders</span><strong><?= number_format($total) ?></strong></div>
	<div class="kpi"><span>Today</span><strong><?= number_format($today) ?></strong></div>
	<div class="kpi kpi-pending"><span>Awaiting action</span><strong><?= number_format($counts['pending']) ?></strong></div>
	<div class="kpi"><span>In progress</span><strong><?= number_format($counts['confirmed'] + $counts['processing'] + $counts['dispatched']) ?></strong></div>
</div>

<div class="toolbar">
	<nav class="tabs" aria-label="Filter by status">
		<a href="<?= list_url(['status' => '', 'p' => null]) ?>" class="<?= $status === '' ? 'is-on' : '' ?>">All <span><?= $total ?></span></a>
		<?php foreach ($ORDER_STATUSES as $key => $label): ?>
			<a href="<?= list_url(['status' => $key, 'p' => null]) ?>" class="<?= $status === $key ? 'is-on' : '' ?>"><?= e($label) ?> <span><?= $counts[$key] ?></span></a>
		<?php endforeach; ?>
	</nav>
	<form class="search" method="get" role="search">
		<?php if ($status): ?><input type="hidden" name="status" value="<?= e($status) ?>"><?php endif; ?>
		<input type="search" name="q" value="<?= e($q) ?>" placeholder="Search order no, name, phone, email" aria-label="Search orders">
		<button class="btn btn-gold btn-sm" type="submit">Search</button>
	</form>
</div>

<div class="table-wrap">
	<table class="data admin-table">
		<thead><tr><th>Order</th><th>Customer</th><th>Location</th><th>Items</th><th>Total</th><th>Status</th><th>Placed</th><th></th></tr></thead>
		<tbody>
		<?php if (!$orders): ?>
			<tr><td colspan="8" class="empty-row"><?= $q || $status ? 'No orders match your filters.' : 'No orders yet. New orders from the website will appear here.' ?></td></tr>
		<?php endif; ?>
		<?php foreach ($orders as $o): $href = admin_url('order.php', ['id' => $o['id']]); ?>
			<tr class="row-link" data-href="<?= e($href) ?>">
				<td><a class="order-no" href="<?= e($href) ?>"><?= e($o['order_no']) ?></a></td>
				<td><strong><?= e($o['customer_name']) ?></strong><?php if ($o['company']): ?><br><span class="muted"><?= e($o['company']) ?></span><?php endif; ?><br><span class="muted"><?= e($o['phone']) ?></span></td>
				<td><?= e($o['city']) ?><br><span class="muted"><?= e($o['district']) ?></span></td>
				<td><?= (int) $o['item_count'] ?></td>
				<td><?= $o['subtotal'] !== null ? e(lkr((float) $o['subtotal'])) : '<span class="muted">To confirm</span>' ?></td>
				<td><?= status_badge($o['status']) ?></td>
				<td><?= e(date('d M Y', strtotime($o['created_at']))) ?><br><span class="muted"><?= e(date('g:i A', strtotime($o['created_at']))) ?></span></td>
				<td><a class="link-arrow" href="<?= e($href) ?>" aria-label="Open order <?= e($o['order_no']) ?>"><?= icon('arrow') ?></a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?php if ($pages > 1): ?>
<nav class="pager" aria-label="Pages">
	<?php if ($page > 1): ?><a class="btn btn-ghost btn-sm" href="<?= list_url(['p' => $page - 1]) ?>">← Previous</a><?php endif; ?>
	<span class="muted">Page <?= $page ?> of <?= $pages ?> · <?= $matching ?> orders</span>
	<?php if ($page < $pages): ?><a class="btn btn-ghost btn-sm" href="<?= list_url(['p' => $page + 1]) ?>">Next →</a><?php endif; ?>
</nav>
<?php endif; ?>

<script>
	document.querySelectorAll('.row-link').forEach(function (r) {
		r.addEventListener('click', function (e) { if (!e.target.closest('a')) location.href = r.dataset.href; });
	});
</script>
<?php admin_end(); ?>
