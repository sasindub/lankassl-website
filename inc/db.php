<?php

function db(): PDO
{
	static $pdo = null;
	if ($pdo === null) {
		$path = __DIR__ . '/db-config.php';
		if (!is_file($path)) {
			throw new RuntimeException('Database is not configured: copy inc/db-config.example.php to inc/db-config.php');
		}
		$c = require $path;
		$pdo = new PDO(
			sprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4', $c['host'], $c['port'] ?? 3306, $c['database']),
			$c['username'],
			$c['password'],
			[
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES   => false,
			]
		);
	}
	return $pdo;
}
