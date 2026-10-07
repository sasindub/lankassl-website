<?php
require __DIR__ . '/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	check_csrf();
	$_SESSION = [];
	session_regenerate_id(true);
	session_destroy();
}
redirect(admin_url('login.php'));
