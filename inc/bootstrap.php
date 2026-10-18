<?php

const ASSET_VERSION = '2026.10.18';

function url(string $path = ''): string
{
	return ROOT . '/' . ltrim($path, '/');
}

function asset(string $path): string
{
	return ROOT . '/assets/v2/' . ltrim($path, '/');
}

function img(string $path): string
{
	return asset('img/' . ltrim($path, '/'));
}

function e(?string $value): string
{
	return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function is_active(string ...$routes): bool
{
	return defined('HEADER_TITLE') && in_array(HEADER_TITLE, $routes, true);
}

require __DIR__ . '/data.php';
require __DIR__ . '/layout.php';
