<?php
page_start(['title' => 'Products', 'description' => 'Hot-dipped GI wire, nail wire, barbed wire, PVC-coated wire, chain link fencing and Tata Steel wire products from Lanka Special Steels.']);
page_hero('Product portfolio', 'Steel wire for <span class="gold">every</span> project.', 'From our flagship hot-dipped GI wire to new chain link fencing — manufactured in Sri Lanka to national and international standards.', 'products/gi-coils.webp', ['Products' => null]);

?>

<section class="section">
	<div class="container">
		<div class="product-grid" data-stagger>
			<?php foreach ($PRODUCTS as $slug => $p): ?>
				<article class="p-card" data-tilt>
					<span class="tag"><?= e($p['badge']) ?></span>
					<div class="p-card-media<?= !empty($p['photo']) ? ' photo' : '' ?>"><img src="<?= img($p['image']) ?>" alt="<?= e($p['name']) ?>" loading="lazy"></div>
					<div class="p-card-body">
						<span class="eyebrow" style="font-size:11px"><?= e($p['family']) ?></span>
						<h3><?= e($p['name']) ?></h3>
						<p><?= e($p['lead']) ?></p>
						<span class="link-arrow">View details <?= icon('arrow') ?></span>
					</div>
					<a class="p-card-link" href="<?= url('products/' . $slug) ?>" aria-label="<?= e($p['name']) ?>"></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section alt">
	<div class="container">
		<div class="section-head">
			<p class="eyebrow" data-reveal>Where our wire goes</p>
			<h2 class="h-lg" data-split>End-use applications</h2>
			<p class="lead" data-reveal>Our wire is the raw material behind fences, mesh, nails and cable armouring made across Sri Lanka and abroad.</p>
		</div>
		<div class="app-grid" data-stagger>
			<?php foreach ($APPLICATIONS as $a): ?>
				<figure class="app-tile" style="margin:0"><img src="<?= img($a[1]) ?>" alt="<?= e($a[0]) ?>" loading="lazy"><span><?= e($a[0]) ?></span></figure>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section-tight">
	<div class="container card-grid two">
		<a class="card" href="<?= url('product-specification') ?>" data-reveal>
			<span class="icon-box"><?= icon('layers') ?></span>
			<h3>Technical specifications</h3>
			<p>Diameter, tolerance, tensile strength, zinc coating and coil data for GI and nail wire (SLS 139:2003).</p>
			<span class="link-arrow">View specifications <?= icon('arrow') ?></span>
		</a>
		<a class="card" href="<?= url('product-brochures') ?>" data-reveal>
			<span class="icon-box"><?= icon('download') ?></span>
			<h3>Product brochures</h3>
			<p>Download our brochures in English, Sinhala and Tamil — including hot-dipped vs electro-galvanized wire.</p>
			<span class="link-arrow">Download brochures <?= icon('arrow') ?></span>
		</a>
	</div>
</section>

<?php cta_band('Not sure which wire you need?', 'Tell us about your application and our technical sales team will recommend the right product and specification.'); ?>
<?php page_end(); ?>
