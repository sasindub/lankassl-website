<?php
page_start(['title' => 'Product Brochures']);
page_hero('Downloads', 'Product <span class="gold">brochures</span>', 'Download product information in English, Sinhala and Tamil.', 'products/gi-spool.webp', ['Products' => 'products', 'Brochures' => null]);
?>

<section class="section">
	<div class="container">
		<div class="doc-grid" data-stagger>
			<?php foreach ($BROCHURES as $b): ?>
				<article class="doc">
					<a class="doc-media" href="<?= url($b[3]) ?>" target="_blank" rel="noopener"><img src="<?= img($b[2]) ?>" alt="<?= e($b[0]) ?>" loading="lazy"></a>
					<div class="doc-body">
						<div class="doc-meta"><span>Brochure</span><span><?= e($b[1]) ?></span></div>
						<h3><?= e($b[0]) ?></h3>
						<div class="doc-actions"><a class="link-arrow" href="<?= url($b[3]) ?>" target="_blank" rel="noopener">Download PDF <?= icon('download') ?></a></div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php cta_band(); ?>
<?php page_end(); ?>
