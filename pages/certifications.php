<?php
page_start(['title' => 'Quality Certifications']);
page_hero('Achievements', 'Quality <span class="gold">certifications</span>', 'National and international certifications that reflect stringent quality, safety and manufacturing standards.', 'gallery/g18.webp', ['Achievements' => null, 'Certifications' => null]);
?>

<section class="section">
	<div class="container">
		<?php foreach (array_filter($CERTIFICATES, fn($c) => $c[3]) as $c): ?>
			<div class="cert-row">
				<div data-reveal>
					<a class="cert-doc glightbox" href="<?= img($c[3]) ?>" data-gallery="certs" data-title="<?= e($c[0]) ?> certificate">
						<img src="<?= img($c[3]) ?>" alt="<?= e($c[0]) ?> certificate — Lanka Special Steels Limited" loading="lazy">
					</a>
				</div>
				<div class="cert-info">
					<img class="mark-sm" src="<?= img($c[4]) ?>" alt="" data-reveal>
					<p class="eyebrow" data-reveal><?= e($c[1]) ?></p>
					<h2 class="h-lg" data-split><?= e($c[0]) ?></h2>
					<p class="lead" data-reveal><?= e($c[2]) ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<?php cta_band(); ?>
<?php page_end(); ?>
