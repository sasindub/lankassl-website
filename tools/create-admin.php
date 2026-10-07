<?php
/*
 * Create or reset an admin account.
 *   php tools/create-admin.php <username> ["Display Name"] [password]
 * If no password is given, a strong one is generated and printed once.
 */
if (PHP_SAPI !== 'cli') exit("Run from the command line.\n");

require __DIR__ . '/../inc/db.php';

$username = $argv[1] ?? '';
if (!preg_match('/^[a-zA-Z0-9._-]{3,60}$/', $username)) {
	fwrite(STDERR, "Usage: php tools/create-admin.php <username> [\"Display Name\"] [password]\n");
	exit(1);
}
$name = $argv[2] ?? '';
$password = $argv[3] ?? rtrim(strtr(base64_encode(random_bytes(12)), '+/', 'Kx'), '=');
if (strlen($password) < 10) {
	fwrite(STDERR, "Password must be at least 10 characters.\n");
	exit(1);
}

$stmt = db()->prepare('INSERT INTO admins (username, name, password_hash) VALUES (?, ?, ?)
	ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash), name = IF(VALUES(name) = "", name, VALUES(name))');
$stmt->execute([$username, $name, password_hash($password, PASSWORD_DEFAULT)]);

echo "Admin '$username' saved.\n";
if (!isset($argv[3])) echo "Generated password: $password\n";
