<?php
/*
 * Admin panel bootstrap: base URL, shared helpers, session and CSRF.
 */

$host = $_SERVER['HTTP_HOST'] ?? '';
$isLocal = preg_match('/^(localhost|127\.0\.0\.1)(:\d+)?$/', $host) === 1;
$https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || strtolower($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https';
$adminBase = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/admin/index.php')), '/');
$siteBase = rtrim(dirname($adminBase), '/');
define('ROOT', ($https ? 'https://' : 'http://') . $host . $siteBase);
define('ADMIN_URL', ROOT . '/admin');

require __DIR__ . '/../inc/bootstrap.php';
require __DIR__ . '/../inc/orders.php';

try {
	db();
} catch (Throwable $e) {
	error_log('Admin DB connection failed: ' . $e->getMessage());
	http_response_code(503);
	exit('The order database is not available. Check inc/db-config.php and that MySQL is running.');
}

header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: same-origin');
header('Cache-Control: no-store');
header('X-Robots-Tag: noindex, nofollow');

session_name('lssl_admin');
session_set_cookie_params(['lifetime' => 0, 'path' => $adminBase . '/', 'secure' => $https, 'httponly' => true, 'samesite' => 'Strict']);
session_start();

// Sign out after 2 hours of inactivity.
if (isset($_SESSION['admin_id'], $_SESSION['seen']) && time() - $_SESSION['seen'] > 7200) {
	$_SESSION = [];
	session_regenerate_id(true);
}
$_SESSION['seen'] = time();

function admin_url(string $path = '', array $query = []): string
{
	return ADMIN_URL . '/' . ltrim($path, '/') . ($query ? '?' . http_build_query($query) : '');
}

function redirect(string $to): never
{
	header('Location: ' . $to, true, 303);
	exit;
}

function csrf_token(): string
{
	if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
	return $_SESSION['csrf'];
}

function csrf_field(): string
{
	return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">';
}

function check_csrf(): void
{
	if (!hash_equals($_SESSION['csrf'] ?? '', (string) ($_POST['csrf'] ?? ''))) {
		http_response_code(400);
		exit('Your session expired. Please go back, refresh the page and try again.');
	}
}

function current_admin(): ?array
{
	static $admin = false;
	if ($admin === false) {
		$admin = null;
		if (!empty($_SESSION['admin_id'])) {
			$stmt = db()->prepare('SELECT id, username, name FROM admins WHERE id = ?');
			$stmt->execute([$_SESSION['admin_id']]);
			$admin = $stmt->fetch() ?: null;
		}
	}
	return $admin;
}

function require_admin(): array
{
	$admin = current_admin();
	if (!$admin) redirect(admin_url('login.php'));
	return $admin;
}

function flash(?string $message = null, string $type = 'ok'): ?array
{
	if ($message !== null) {
		$_SESSION['flash'] = [$message, $type];
		return null;
	}
	$f = $_SESSION['flash'] ?? null;
	unset($_SESSION['flash']);
	return $f;
}

function status_badge(string $status): string
{
	global $ORDER_STATUSES;
	return '<span class="badge badge-' . e($status) . '">' . e($ORDER_STATUSES[$status] ?? ucfirst($status)) . '</span>';
}

function admin_start(string $title, ?array $admin = null): void
{
	?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow">
	<title><?= e($title) ?> · Lanka SSL Admin</title>
	<link rel="icon" type="image/png" href="<?= img('brand/favicon.png') ?>">
	<script>try { var t = localStorage.getItem('lssl-theme'); if (t === 'light' || t === 'dark') document.documentElement.setAttribute('data-theme', t); } catch (e) {}</script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Sora:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= asset('css/site.css') ?>?v=<?= ASSET_VERSION ?>">
	<link rel="stylesheet" href="<?= asset('css/admin.css') ?>?v=<?= ASSET_VERSION ?>">
</head>
<body class="admin <?= $admin ? '' : 'admin-guest' ?>">
	<?php if ($admin): ?>
	<header class="admin-bar">
		<div class="admin-wrap admin-bar-inner">
			<a class="brand" href="<?= admin_url() ?>">
				<?= brand_logo() ?>
				<span class="brand-text"><strong>Lanka SSL</strong><small>Order management</small></span>
			</a>
			<nav class="admin-nav">
				<a href="<?= admin_url() ?>">Orders</a>
				<a href="<?= url('home') ?>" target="_blank" rel="noopener">View site <?= icon('arrow-ur') ?></a>
			</nav>
			<div class="admin-user">
				<button class="theme-toggle" type="button" aria-label="Switch colour theme"><?= icon('sun', 'ico sun') ?><?= icon('moon', 'ico moon') ?></button>
				<span class="admin-name"><?= e($admin['name'] ?: $admin['username']) ?></span>
				<form method="post" action="<?= admin_url('logout.php') ?>"><?= csrf_field() ?><button class="btn btn-ghost btn-sm" type="submit">Sign out</button></form>
			</div>
		</div>
	</header>
	<?php endif; ?>
	<main class="admin-main">
		<div class="admin-wrap">
		<?php if ($f = flash()): ?><div class="alert alert-<?= e($f[1]) ?>" role="status"><?= e($f[0]) ?></div><?php endif; ?>
<?php
}

function admin_end(): void
{
	?>
		</div>
	</main>
	<script>
		document.querySelectorAll('.theme-toggle').forEach(function (b) {
			b.addEventListener('click', function () {
				var next = document.documentElement.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
				document.documentElement.setAttribute('data-theme', next);
				try { localStorage.setItem('lssl-theme', next); } catch (e) {}
			});
		});
	</script>
</body>
</html>
<?php
}
