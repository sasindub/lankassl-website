<?php

$host = $_SERVER['HTTP_HOST'] ?? '';
$isLocal = preg_match('/^(localhost|127\.0\.0\.1)(:\d+)?$/', $host) === 1;

if (getenv('LSSL_ROOT') !== false) {
	// Static export: root-relative URLs (e.g. LSSL_ROOT='' gives /home)
	define('ROOT', rtrim(getenv('LSSL_ROOT'), '/'));
} elseif ($isLocal) {
	$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
	define('ROOT', 'http://' . $host . $base);
} else {
	define('ROOT', 'https://lankassl.onespencer.co.uk');
}

/* =====================================================================
 * MAINTENANCE MODE — UNDER CONSTRUCTION
 * The whole site shows the under-construction page while we do upgrades.
 * To bring the normal site back, comment out / delete this block.
 * (Skipped on localhost so the revamp can be previewed.)
 * ===================================================================== */
if (!$isLocal) {
	http_response_code(503);
	header('Retry-After: 86400');
	require __DIR__ . '/under-construction.php';
	exit;
}
/* ===================== END MAINTENANCE MODE ====================== */

require __DIR__ . '/inc/bootstrap.php';

$segments = explode('/', trim($_GET['url'] ?? '', '/'));
$route = $segments[0] === '' ? 'home' : strtolower($segments[0]);

// Old URLs that were removed or renamed in the revamp.
$redirects = [
	'intro'                 => 'home',
	'barded-wire'           => 'products/barbed-wire',
	'pvc-coated-iron-wire'  => 'products/pvc-coated-gi-wire',
	'hot-dipped-gi-wire'    => 'products/hot-dipped-gi-wire',
	'nail-wire'             => 'products/nail-wire',
	'end-user-products'     => 'products',
	'news-event'            => 'gallery',
];
if (isset($redirects[$route]) || str_starts_with($route, 'detailed-')) {
	header('Location: ' . url($redirects[$route] ?? 'gallery'), true, 301);
	exit;
}

$pages = [
	'home', 'about-company', 'board-of-directors', 'management-team', 'business-excellence',
	'products', 'product-specification', 'product-brochures',
	'awards', 'certifications', 'press-release', 'gallery', 'careers', 'contact',
];

if ($route === 'products' && !empty($segments[1])) {
	$slug = strtolower($segments[1]);
	if (isset($PRODUCTS[$slug])) {
		$product = $PRODUCTS[$slug];
		require __DIR__ . '/pages/product.php';
		exit;
	}
	$route = '404';
}

if (in_array($route, $pages, true)) {
	define('HEADER_TITLE', $route);
	require __DIR__ . '/pages/' . $route . '.php';
} else {
	http_response_code(404);
	define('HEADER_TITLE', '404');
	require __DIR__ . '/pages/404.php';
}
