<?php
require __DIR__ . '/bootstrap.php';

if (current_admin()) redirect(admin_url());

$error = '';
$username = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	check_csrf();
	$username = trim((string) ($_POST['username'] ?? ''));
	$password = (string) ($_POST['password'] ?? '');

	$stmt = db()->prepare('SELECT id, password_hash FROM admins WHERE username = ?');
	$stmt->execute([$username]);
	$row = $stmt->fetch();

	if ($row && password_verify($password, $row['password_hash'])) {
		session_regenerate_id(true);
		$_SESSION['admin_id'] = (int) $row['id'];
		$_SESSION['login_failures'] = 0;
		db()->prepare('UPDATE admins SET last_login_at = NOW() WHERE id = ?')->execute([$row['id']]);
		if (password_needs_rehash($row['password_hash'], PASSWORD_DEFAULT)) {
			db()->prepare('UPDATE admins SET password_hash = ? WHERE id = ?')->execute([password_hash($password, PASSWORD_DEFAULT), $row['id']]);
		}
		redirect(admin_url());
	}

	$_SESSION['login_failures'] = ($_SESSION['login_failures'] ?? 0) + 1;
	sleep(min($_SESSION['login_failures'], 5));
	$error = 'Incorrect username or password.';
}

admin_start('Sign in');
?>
<div class="login-wrap">
	<form class="login-card" method="post" novalidate>
		<?= brand_logo('login-logo', 'Lanka Special Steels') ?>
		<div>
			<p class="eyebrow">Admin</p>
			<h1>Order management</h1>
		</div>
		<?php if ($error): ?><div class="alert alert-err" role="alert"><?= e($error) ?></div><?php endif; ?>
		<?= csrf_field() ?>
		<div class="field"><label for="u">Username</label><input id="u" name="username" value="<?= e($username) ?>" autocomplete="username" required autofocus></div>
		<div class="field"><label for="p">Password</label><input id="p" name="password" type="password" autocomplete="current-password" required></div>
		<button class="btn btn-gold btn-block" type="submit">Sign in <?= icon('arrow') ?></button>
		<a class="muted login-back" href="<?= url('home') ?>">← Back to website</a>
	</form>
</div>
<?php admin_end(); ?>
