<?php

function icon(string $name, string $class = 'ico'): string
{
	static $paths = [
		'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'arrow-ur' => '<path d="M7 17 17 7M8 7h9v9"/>',
		'chev'     => '<path d="m6 9 6 6 6-6"/>',
		'phone'    => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2"/>',
		'mail'     => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
		'pin'      => '<path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/>',
		'fax'      => '<path d="M7 9V3h10v6"/><rect x="3" y="9" width="18" height="9" rx="2"/><path d="M7 14h10v7H7z"/>',
		'sun'      => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>',
		'moon'     => '<path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/>',
		'menu'     => '<path d="M4 7h16M4 12h16M4 17h10"/>',
		'close'    => '<path d="M6 6l12 12M18 6 6 18"/>',
		'check'    => '<path d="m5 12 5 5L20 7"/>',
		'download' => '<path d="M12 4v11M7 10l5 5 5-5M5 20h14"/>',
		'shield'   => '<path d="M12 3 4 6v6c0 5 3.5 8 8 9 4.5-1 8-4 8-9V6z"/><path d="m9 12 2 2 4-4"/>',
		'award'    => '<circle cx="12" cy="9" r="6"/><path d="M8.5 14 7 22l5-3 5 3-1.5-8"/>',
		'globe'    => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/>',
		'flask'    => '<path d="M9 3h6M10 3v6L4.5 19a1.5 1.5 0 0 0 1.3 2h12.4a1.5 1.5 0 0 0 1.3-2L14 9V3"/><path d="M7 15h10"/>',
		'hardhat'  => '<path d="M3 18h18M5 18v-3a7 7 0 0 1 14 0v3M10 8V5h4v3"/>',
		'truck'    => '<path d="M3 6h11v10H3zM14 10h4l3 3v3h-7"/><circle cx="7" cy="18" r="2"/><circle cx="17" cy="18" r="2"/>',
		'users'    => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20a6.5 6.5 0 0 1 13 0"/><path d="M16 4.5a3.5 3.5 0 0 1 0 7M18 14a6.5 6.5 0 0 1 3.5 6"/>',
		'spark'    => '<path d="M12 3v4M12 17v4M3 12h4M17 12h4M6 6l2.5 2.5M15.5 15.5 18 18M6 18l2.5-2.5M15.5 8.5 18 6"/>',
		'layers'   => '<path d="m12 3 9 5-9 5-9-5z"/><path d="m3 13 9 5 9-5"/>',
		'upload'   => '<path d="M12 20V9M7 14l5-5 5 5M5 4h14"/>',
		'facebook' => '<path d="M14 8h3V4h-3a4 4 0 0 0-4 4v3H7v4h3v6h4v-6h3l1-4h-4V8z"/>',
		'linkedin' => '<rect x="3" y="3" width="18" height="18" rx="3"/><path d="M8 10v7M8 7v.01M12 17v-4a2 2 0 0 1 4 0v4M12 10v7"/>',
		'play'     => '<path d="M8 5v14l11-7z"/>',
		'cart'     => '<path d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.5L21 8H6.2"/><circle cx="10" cy="20" r="1.4"/><circle cx="17" cy="20" r="1.4"/>',
		'trash'    => '<path d="M4 7h16M9 7V4h6v3M6 7l1 13h10l1-13"/>',
		'plus'     => '<path d="M12 5v14M5 12h14"/>',
		'minus'    => '<path d="M5 12h14"/>',
		'bag'      => '<path d="M5 8h14l-1 12H6z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/>',
	];
	return '<svg class="' . $class . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . ($paths[$name] ?? '') . '</svg>';
}

/** The Lanka SSL wordmark: navy on light backgrounds, white on dark ones (switched in CSS). */
function brand_logo(string $class = '', string $alt = ''): string
{
	$cls = trim('brand-logo ' . $class);
	return '<span class="' . e($cls) . '">'
		. '<img class="logo-navy" src="' . img('brand/lanka-ssl-navy.png') . '" alt="' . e($alt) . '" width="600" height="494">'
		. '<img class="logo-white" src="' . img('brand/lanka-ssl-white.png') . '" alt="" aria-hidden="true" width="600" height="494">'
		. '</span>';
}

function page_start(array $o = []): void
{
	global $COMPANY, $PRODUCTS;
	$title = isset($o['title']) ? $o['title'] . ' | ' . $COMPANY['name'] : $COMPANY['name'] . ' — ' . $COMPANY['tagline'];
	$desc  = $o['description'] ?? 'Lanka Special Steels Limited — Sri Lanka’s leading manufacturer of hot-dipped galvanized iron wire, barbed wire and chain link fencing under the LAXAPANA brand. A subsidiary of E.B. Creasy & Co. PLC.';
	$bodyClass = $o['body'] ?? '';
	?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= e($title) ?></title>
	<meta name="description" content="<?= e($desc) ?>">
	<meta name="theme-color" content="#0b0a08">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="<?= e($COMPANY['name']) ?>">
	<meta property="og:title" content="<?= e($title) ?>">
	<meta property="og:description" content="<?= e($desc) ?>">
	<meta property="og:image" content="<?= img('site/hero-factory.webp') ?>">
	<link rel="icon" type="image/png" href="<?= img('brand/favicon.png') ?>">
	<link rel="apple-touch-icon" href="<?= img('brand/apple-touch-icon.png') ?>">
	<script>
		(function () {
			document.documentElement.classList.add('js');
			try {
				var t = localStorage.getItem('lssl-theme');
				if (t === 'light' || t === 'dark') document.documentElement.setAttribute('data-theme', t);
			} catch (e) {}
		})();
	</script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Sora:wght@300;400;600;700&family=Noto+Sans+Sinhala:wght@500&family=Noto+Sans+Tamil:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox@3.3.0/dist/css/glightbox.min.css">
	<link rel="stylesheet" href="<?= asset('css/site.css') ?>?v=<?= ASSET_VERSION ?>">
</head>
<body class="<?= e($bodyClass) ?>">
	<a class="skip" href="#main">Skip to content</a>
	<div class="progress" aria-hidden="true"><span></span></div>

	<header class="site-header" id="top">
		<div class="container header-inner">
			<a class="brand" href="<?= url('home') ?>" aria-label="Lanka Special Steels — Home">
				<?= brand_logo() ?>
				<span class="brand-text">
					<strong>Lanka Special Steels</strong>
					<small><?= e($COMPANY['parent']) ?></small>
				</span>
			</a>

			<nav class="nav" aria-label="Main">
				<ul>
					<li><a href="<?= url('home') ?>" class="<?= is_active('home') ? 'is-active' : '' ?>">Home</a></li>
					<li class="has-drop">
						<button class="<?= is_active('about-company', 'board-of-directors', 'management-team', 'business-excellence') ? 'is-active' : '' ?>" aria-expanded="false">Company <?= icon('chev', 'ico chev') ?></button>
						<div class="drop">
							<a href="<?= url('about-company') ?>"><strong>About Us</strong><span>Our story, vision &amp; values</span></a>
							<a href="<?= url('board-of-directors') ?>"><strong>Board of Directors</strong><span>Governance &amp; leadership</span></a>
							<a href="<?= url('management-team') ?>"><strong>Management Team</strong><span>The people who run Lanka SSL</span></a>
							<a href="<?= url('business-excellence') ?>"><strong>Business Excellence</strong><span>Safety, quality &amp; exports</span></a>
						</div>
					</li>
					<li class="has-drop has-mega">
						<button class="<?= is_active('products', 'product', 'product-specification', 'product-brochures') ? 'is-active' : '' ?>" aria-expanded="false">Products <?= icon('chev', 'ico chev') ?></button>
						<div class="drop mega">
							<div class="mega-grid">
								<?php foreach ($PRODUCTS as $slug => $p): ?>
									<a href="<?= url('products/' . $slug) ?>" class="mega-item">
										<span class="mega-thumb"><img src="<?= img($p['image']) ?>" alt="" loading="lazy"></span>
										<span><strong><?= e($p['short']) ?></strong><span><?= e($p['badge']) ?></span></span>
									</a>
								<?php endforeach; ?>
							</div>
							<div class="mega-foot">
								<a href="<?= url('products') ?>">All products <?= icon('arrow') ?></a>
								<a href="<?= url('product-specification') ?>">Specifications</a>
								<a href="<?= url('product-brochures') ?>">Brochures</a>
							</div>
						</div>
					</li>
					<li class="has-drop">
						<button class="<?= is_active('awards', 'certifications', 'press-release') ? 'is-active' : '' ?>" aria-expanded="false">Achievements <?= icon('chev', 'ico chev') ?></button>
						<div class="drop">
							<a href="<?= url('awards') ?>"><strong>Awards</strong><span>National recognition since 2014</span></a>
							<a href="<?= url('certifications') ?>"><strong>Certifications</strong><span>SLS, BIS &amp; ISO</span></a>
							<a href="<?= url('press-release') ?>"><strong>Press Releases</strong><span>News &amp; media coverage</span></a>
						</div>
					</li>
					<li><a href="<?= url('gallery') ?>" class="<?= is_active('gallery') ? 'is-active' : '' ?>">Gallery</a></li>
					<li><a href="<?= url('careers') ?>" class="<?= is_active('careers') ? 'is-active' : '' ?>">Careers</a></li>
				</ul>
			</nav>

			<div class="header-actions">
				<button class="cart-toggle" type="button" aria-label="Open cart" aria-controls="cart-drawer" title="Your cart">
					<?= icon('cart') ?><span class="cart-count" data-cart-count hidden>0</span>
				</button>
				<button class="theme-toggle" type="button" aria-label="Switch colour theme" title="Switch light / dark">
					<?= icon('sun', 'ico sun') ?><?= icon('moon', 'ico moon') ?>
				</button>
				<a class="btn btn-gold btn-sm header-cta" href="<?= url('contact') ?>">Contact Us</a>
				<button class="burger" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu"><?= icon('menu') ?></button>
			</div>
		</div>
	</header>

	<div class="mobile-menu" id="mobile-menu" aria-hidden="true">
		<div class="mobile-menu-inner">
			<button class="mobile-close" type="button" aria-label="Close menu"><?= icon('close') ?></button>
			<nav aria-label="Mobile">
				<a href="<?= url('home') ?>">Home</a>
				<p class="mm-label">Company</p>
				<a href="<?= url('about-company') ?>">About Us</a>
				<a href="<?= url('board-of-directors') ?>">Board of Directors</a>
				<a href="<?= url('management-team') ?>">Management Team</a>
				<a href="<?= url('business-excellence') ?>">Business Excellence</a>
				<p class="mm-label">Products</p>
				<a href="<?= url('products') ?>">All Products</a>
				<?php foreach ($PRODUCTS as $slug => $p): ?>
					<a class="mm-sub" href="<?= url('products/' . $slug) ?>"><?= e($p['short']) ?></a>
				<?php endforeach; ?>
				<a class="mm-sub" href="<?= url('product-specification') ?>">Specifications</a>
				<a class="mm-sub" href="<?= url('product-brochures') ?>">Brochures</a>
				<p class="mm-label">Achievements</p>
				<a href="<?= url('awards') ?>">Awards</a>
				<a href="<?= url('certifications') ?>">Certifications</a>
				<a href="<?= url('press-release') ?>">Press Releases</a>
				<p class="mm-label">More</p>
				<a href="<?= url('gallery') ?>">Gallery</a>
				<a href="<?= url('careers') ?>">Careers</a>
				<a href="<?= url('contact') ?>">Contact</a>
				<a href="<?= url('checkout') ?>">Cart &amp; Checkout</a>
			</nav>
		</div>
	</div>

	<aside class="cart-drawer" id="cart-drawer" aria-hidden="true" aria-label="Your cart">
		<div class="cart-backdrop" data-cart-close></div>
		<div class="cart-panel" role="dialog" aria-modal="true" aria-labelledby="cart-title">
			<div class="cart-head">
				<h2 id="cart-title">Your cart</h2>
				<button class="icon-btn" type="button" data-cart-close aria-label="Close cart"><?= icon('close') ?></button>
			</div>
			<div class="cart-body" data-cart-items data-lenis-prevent></div>
			<div class="cart-foot">
				<p class="cart-note">Prices and delivery are confirmed by our sales team after you place your order.</p>
				<a class="btn btn-gold" href="<?= url('checkout') ?>" data-cart-checkout>Place order <?= icon('arrow') ?></a>
			</div>
		</div>
	</aside>

	<dialog class="add-dialog" id="add-dialog" aria-labelledby="add-title" data-lenis-prevent>
		<form method="dialog" class="add-form" novalidate>
			<button class="icon-btn add-close" type="submit" value="cancel" aria-label="Close"><?= icon('close') ?></button>
			<div class="add-product">
				<span class="add-thumb"><img src="" alt="" data-add-image></span>
				<div><p class="eyebrow" data-add-family></p><h2 id="add-title" data-add-name></h2></div>
			</div>
			<div class="field"><label for="add-variant" data-add-label>Option</label><select id="add-variant" data-add-variant required></select></div>
			<div class="field"><label for="add-note">Note <span class="muted">(optional)</span></label><input id="add-note" data-add-note maxlength="200" placeholder="Any specification details"></div>
			<div class="field"><label for="add-qty">Quantity <span class="muted" data-add-unit></span></label>
				<div class="qty"><button type="button" class="qty-btn" data-step="-1" aria-label="Decrease"><?= icon('minus') ?></button><input id="add-qty" data-add-qty type="number" min="1" max="100000" value="1" inputmode="numeric"><button type="button" class="qty-btn" data-step="1" aria-label="Increase"><?= icon('plus') ?></button></div>
			</div>
			<button class="btn btn-gold" type="submit" value="add" data-add-submit><?= icon('cart') ?> Add to cart</button>
		</form>
	</dialog>

	<div class="toast" role="status" aria-live="polite" data-toast></div>

	<main id="main">
<?php
}

/** Product data for the cart script (names, images, order options). */
function catalog_json(): string
{
	global $PRODUCTS, $ORDER_OPTIONS;
	$out = [];
	foreach ($PRODUCTS as $slug => $p) {
		if (!isset($ORDER_OPTIONS[$slug])) continue;
		$o = $ORDER_OPTIONS[$slug];
		$out[$slug] = [
			'name' => $p['name'], 'short' => $p['short'], 'family' => $p['family'],
			'image' => img($p['image']), 'photo' => !empty($p['photo']), 'url' => url('products/' . $slug),
			'unit' => $o['unit'], 'label' => $o['label'], 'variants' => $o['variants'], 'noteHint' => $o['note_hint'] ?? '',
		];
	}
	return json_encode($out, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG);
}

/** "Add to cart" button for product cards. */
function add_to_cart_button(string $slug, string $class = 'btn btn-ghost btn-sm'): string
{
	return '<button type="button" class="' . $class . ' add-btn" data-add-to-cart="' . e($slug) . '">' . icon('cart') . ' Add to cart</button>';
}

function page_hero(string $eyebrow, string $title, string $lead = '', string $image = 'site/hero-factory.webp', array $crumbs = []): void
{
	?>
	<section class="page-hero">
		<div class="page-hero-media" aria-hidden="true">
			<img src="<?= img($image) ?>" alt="" data-parallax>
		</div>
		<div class="container page-hero-inner">
			<nav class="crumbs" aria-label="Breadcrumb">
				<a href="<?= url('home') ?>">Home</a>
				<?php foreach ($crumbs as $label => $href): ?>
					<span>/</span><?php if ($href): ?><a href="<?= url($href) ?>"><?= e($label) ?></a><?php else: ?><span aria-current="page"><?= e($label) ?></span><?php endif; ?>
				<?php endforeach; ?>
			</nav>
			<p class="eyebrow" data-reveal><?= e($eyebrow) ?></p>
			<h1 class="page-title" data-split><?= $title ?></h1>
			<?php if ($lead): ?><p class="page-lead" data-reveal><?= e($lead) ?></p><?php endif; ?>
		</div>
	</section>
	<?php
}

function cta_band(string $title = 'Planning a project? Let’s talk steel.', string $text = 'Get expert advice, specifications and a quotation from our sales team — anywhere in Sri Lanka.'): void
{
	global $COMPANY;
	?>
	<section class="section cta-band">
		<div class="container">
			<div class="cta-card" data-reveal>
				<div class="mesh-bg" aria-hidden="true"></div>
				<div class="cta-copy">
					<h2><?= e($title) ?></h2>
					<p><?= e($text) ?></p>
				</div>
				<div class="cta-actions">
					<a class="btn btn-gold" href="<?= url('contact') ?>">Request a Quote <?= icon('arrow') ?></a>
					<a class="btn btn-ghost" href="tel:<?= e(str_replace(' ', '', $COMPANY['phone'])) ?>"><?= icon('phone') ?> <?= e($COMPANY['phone_all']) ?></a>
				</div>
			</div>
		</div>
	</section>
	<?php
}

function page_end(array $o = []): void
{
	global $COMPANY, $PRODUCTS, $LOCATIONS, $CERTIFICATES;
	?>
	</main>

	<footer class="site-footer">
		<div class="footer-glow" aria-hidden="true"></div>
		<div class="container">
			<div class="footer-top">
				<div class="footer-brand">
					<a class="brand" href="<?= url('home') ?>">
						<?= brand_logo('on-dark') ?>
						<span class="brand-text"><strong>Lanka Special Steels Limited</strong><small><?= e($COMPANY['parent']) ?></small></span>
					</a>
					<p>Sri Lanka’s largest and most established manufacturer of hot-dipped galvanized iron wire. Proudly Sri Lankan, trusted island-wide under the LAXAPANA brand.</p>
					<div class="footer-marks">
						<?php foreach ($CERTIFICATES as $c): ?>
							<img src="<?= img($c[4]) ?>" alt="<?= e($c[0]) ?>" title="<?= e($c[0]) ?>" loading="lazy">
						<?php endforeach; ?>
					</div>
				</div>
				<div class="footer-col">
					<h3>Products</h3>
					<?php foreach ($PRODUCTS as $slug => $p): ?>
						<a href="<?= url('products/' . $slug) ?>"><?= e($p['short']) ?></a>
					<?php endforeach; ?>
				</div>
				<div class="footer-col">
					<h3>Company</h3>
					<a href="<?= url('about-company') ?>">About Us</a>
					<a href="<?= url('board-of-directors') ?>">Board of Directors</a>
					<a href="<?= url('management-team') ?>">Management Team</a>
					<a href="<?= url('business-excellence') ?>">Business Excellence</a>
					<a href="<?= url('awards') ?>">Awards</a>
					<a href="<?= url('certifications') ?>">Certifications</a>
					<a href="<?= url('press-release') ?>">Press Releases</a>
					<a href="<?= url('gallery') ?>">Gallery</a>
					<a href="<?= url('careers') ?>">Careers</a>
				</div>
				<div class="footer-col footer-contact">
					<h3>Get in touch</h3>
					<?php foreach ($LOCATIONS as $l): ?>
						<p><?= icon('pin') ?><span><strong><?= e($l['label']) ?></strong><?= e($l['address']) ?></span></p>
					<?php endforeach; ?>
					<p><?= icon('phone') ?><a href="tel:<?= e(str_replace(' ', '', $COMPANY['phone'])) ?>"><?= e($COMPANY['phone_all']) ?></a></p>
					<p><?= icon('mail') ?><a href="mailto:<?= e($COMPANY['email']) ?>"><?= e($COMPANY['email']) ?></a></p>
					<div class="socials">
						<a href="<?= e($COMPANY['facebook']) ?>" target="_blank" rel="noopener" aria-label="Facebook"><?= icon('facebook') ?></a>
						<a href="<?= e($COMPANY['linkedin']) ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><?= icon('linkedin') ?></a>
					</div>
				</div>
			</div>
			<div class="footer-bottom">
				<p>© <?= date('Y') ?> Lanka Special Steels Limited. All rights reserved.</p>
				<p class="footer-slogan"><span lang="si">අපේ දෙයක්</span> · <span lang="ta">எங்களுடையது</span> · Made in Sri Lanka</p>
			</div>
		</div>
	</footer>

	<button class="to-top" type="button" aria-label="Back to top"><?= icon('arrow') ?></button>

	<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.13/dist/lenis.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/glightbox@3.3.0/dist/js/glightbox.min.js"></script>
	<script>window.LSSL = { root: <?= json_encode(ROOT) ?>, demo: <?= getenv('LSSL_DEMO') ? 'true' : 'false' ?>, catalog: <?= catalog_json() ?> };</script>
	<script src="<?= asset('js/site.js') ?>?v=<?= ASSET_VERSION ?>"></script>
	<script src="<?= asset('js/cart.js') ?>?v=<?= ASSET_VERSION ?>"></script>
	<?php foreach ($o['scripts'] ?? [] as $s): ?>
		<script src="<?= asset($s) ?>?v=<?= ASSET_VERSION ?>"></script>
	<?php endforeach; ?>
</body>
</html>
<?php
}
