<?php
/** @var array $product @var string $slug */
define('HEADER_TITLE', 'product');
page_start(['title' => $product['name'], 'description' => $product['lead'], 'body' => 'no-hero']);
$isPhoto = !empty($product['photo']);
?>

<section class="pd-hero">
	<div class="container pd-grid">
		<div>
			<nav class="crumbs" aria-label="Breadcrumb">
				<a href="<?= url('home') ?>">Home</a><span>/</span><a href="<?= url('products') ?>">Products</a><span>/</span><span aria-current="page"><?= e($product['short']) ?></span>
			</nav>
			<span class="tag" data-reveal><?= e($product['badge']) ?></span>
			<h1 data-split><?= e($product['name']) ?></h1>
			<p class="lead" data-reveal><?= e($product['lead']) ?></p>
			<div class="hero-actions" data-reveal>
				<a class="btn btn-gold" href="<?= url('contact') ?>?product=<?= e($slug) ?>">Request a Quote <?= icon('arrow') ?></a>
				<?php if (!empty($product['spec_tables'])): ?>
					<a class="btn btn-ghost" href="#specifications">Specifications</a>
				<?php endif; ?>
			</div>
		</div>
		<div>
			<div class="pd-visual">
				<?php if (!$isPhoto): ?><span class="ring"></span><span class="ring r2"></span><?php endif; ?>
				<a href="<?= img($product['image']) ?>" class="glightbox" data-gallery="product" style="position:relative;z-index:1">
					<img class="main<?= $isPhoto ? ' photo' : '' ?>" src="<?= img($product['image']) ?>" alt="<?= e($product['name']) ?>" fetchpriority="high">
				</a>
				<?php if (!empty($product['mascot'])): ?>
					<img class="mascot" src="<?= img('brand/mascot.webp') ?>" alt="" data-float>
				<?php endif; ?>
			</div>
			<?php if (!empty($product['gallery'])): ?>
				<div class="pd-thumbs">
					<?php foreach ($product['gallery'] as $g): ?>
						<a href="<?= img($g) ?>" class="glightbox" data-gallery="product" aria-label="View image"><img src="<?= img($g) ?>" alt="" loading="lazy"></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="container">
		<dl class="spec-cards" data-stagger>
			<?php foreach ($product['specs'] as $k => $v): ?>
				<div class="spec-card"><dt><?= e($k) ?></dt><dd><?= e($v) ?></dd></div>
			<?php endforeach; ?>
		</dl>
	</div>
</section>

<section class="section alt">
	<div class="container split" style="align-items:start">
		<div class="prose">
			<p class="eyebrow" data-reveal>Overview</p>
			<h2 class="h-md" data-split>Why choose <?= e($product['short']) ?>?</h2>
			<?php foreach ($product['overview'] as $para): ?>
				<p data-reveal><?= e($para) ?></p>
			<?php endforeach; ?>
		</div>
		<div class="prose">
			<?php if (!empty($product['highlights'])): ?>
				<p class="eyebrow" data-reveal>Key advantages</p>
				<ul class="check-list" data-stagger>
					<?php foreach ($product['highlights'] as $h): ?><li><?= icon('check') ?> <?= e($h) ?></li><?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<?php if (!empty($product['range'])): ?>
				<p class="eyebrow" data-reveal>Product range</p>
				<ul class="check-list" data-stagger>
					<?php foreach ($product['range'] as $h): ?><li><?= icon('check') ?> <?= e($h) ?></li><?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<p class="eyebrow" data-reveal style="margin-top:14px">Applications</p>
			<div class="chips" data-stagger>
				<?php foreach ($product['applications'] as $a): ?><span class="chip"><?= e($a) ?></span><?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<?php if (!empty($product['stock']) || !empty($product['spec_tables'])): ?>
<section class="section" id="specifications">
	<div class="container tables">
		<?php if (!empty($product['stock'])): $st = $product['stock']; ?>
			<div data-reveal>
				<div class="table-title"><h3><?= e($st['title']) ?></h3><span><?= e($st['note'] ?? 'Other sizes available on request') ?></span></div>
				<div class="table-wrap">
					<table class="data small">
						<thead><tr><?php foreach ($st['head'] as $h): ?><th><?= e($h) ?></th><?php endforeach; ?></tr></thead>
						<tbody><?php foreach ($st['rows'] as $r): ?><tr><?php foreach ($r as $c): ?><td><?= e($c) ?></td><?php endforeach; ?></tr><?php endforeach; ?></tbody>
					</table>
				</div>
			</div>
		<?php endif; ?>
		<?php foreach ($product['spec_tables'] ?? [] as $key): $t = $SPEC_TABLES[$key]; ?>
			<div data-reveal>
				<div class="table-title"><h3><?= e($t['title']) ?></h3><span>As per SLS 139:2003</span></div>
				<div class="table-wrap">
					<table class="data">
						<thead><tr><?php foreach ($t['head'] as $h): ?><th><?= e($h) ?></th><?php endforeach; ?></tr></thead>
						<tbody><?php foreach ($t['rows'] as $r): ?><tr><?php foreach ($r as $c): ?><td><?= e($c) ?></td><?php endforeach; ?></tr><?php endforeach; ?></tbody>
					</table>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
<?php endif; ?>

<section class="section<?= (!empty($product['stock']) || !empty($product['spec_tables'])) ? ' alt' : '' ?>">
	<div class="container">
		<div class="section-head split">
			<h2 class="h-md" data-reveal>Explore more products</h2>
			<a class="link-arrow" href="<?= url('products') ?>" data-reveal>All products <?= icon('arrow') ?></a>
		</div>
		<div class="product-grid" data-stagger>
			<?php
			$others = array_filter($PRODUCTS, fn($k) => $k !== $slug, ARRAY_FILTER_USE_KEY);
			foreach (array_slice($others, 0, 4, true) as $s => $p): ?>
				<article class="p-card" data-tilt>
					<div class="p-card-media<?= !empty($p['photo']) ? ' photo' : '' ?>"><img src="<?= img($p['image']) ?>" alt="<?= e($p['name']) ?>" loading="lazy"></div>
					<div class="p-card-body">
						<h3><?= e($p['short']) ?></h3>
						<span class="link-arrow">View <?= icon('arrow') ?></span>
					</div>
					<a class="p-card-link" href="<?= url('products/' . $s) ?>" aria-label="<?= e($p['name']) ?>"></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php cta_band('Get a quotation for ' . $product['short'], 'Share your quantity, size and delivery location — our sales team responds quickly with pricing and availability.'); ?>
<?php page_end(); ?>
