<?php
page_start(['title' => 'Awards & Recognition']);
page_hero('Achievements', 'Awards &amp; <span class="gold">recognition</span>', 'Consistent national recognition for quality, productivity and manufacturing excellence.', 'awards/trophies.webp', ['Achievements' => null, 'Awards' => null]);
?>

<section class="section">
	<div class="container award-feature">
		<div class="trophy-frame" data-reveal>
			<img src="<?= img('awards/cnci-2021.webp') ?>" alt="Lanka SSL team receiving the CNCI Achiever Award" loading="lazy" data-parallax>
		</div>
		<div class="prose">
			<p class="eyebrow" data-reveal>Highlight</p>
			<h2 class="h-lg" data-split>National Gold — CNCI Achiever Awards 2020.</h2>
			<p data-reveal>Lanka SSL was honoured with the coveted <strong>National Gold Award in the Extra-Large Manufacturing Sector</strong> at the Achiever Awards 2020 conducted by the Ceylon National Chamber of Industries (CNCI) — a significant milestone beyond its previous Merit Award — along with an all-island Top Ten Award.</p>
			<p data-reveal>We have also achieved consecutive Gold Awards at the National Convention on Quality and Productivity since 2014, and Gold Awards at the National Business Excellence Awards (NCCSL) — including second and first runner-up in the Overall Large Category in 2018 and 2021.</p>
		</div>
	</div>
</section>

<section class="section alt">
	<div class="container">
		<div class="section-head split">
			<div style="display:grid;gap:18px">
				<p class="eyebrow" data-reveal>Award history</p>
				<h2 class="h-lg" data-split>A decade of winning.</h2>
			</div>
		</div>
		<div class="award-list" data-stagger>
			<?php foreach ($AWARDS as $a): ?>
				<div class="award-row">
					<span class="yr"><?= e($a[0]) ?></span>
					<h3><?= e($a[1]) ?></h3>
					<span class="res"><?= e($a[2]) ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-head">
			<p class="eyebrow" data-reveal>Moments</p>
			<h2 class="h-md" data-split>From the award stage</h2>
		</div>
		<div class="masonry" data-stagger>
			<?php foreach (['awards/nbe-2018.webp' => 'National Business Excellence Awards', 'gallery/g7.webp' => 'CNCI Achiever Awards', 'gallery/g26.webp' => 'National Convention on Quality & Productivity', 'gallery/g27.webp' => 'Gold Award — SLAAQP', 'gallery/g21.webp' => 'Our trophies', 'gallery/g25.webp' => 'Quality circle team'] as $src => $cap): ?>
				<a class="m-item glightbox" href="<?= img($src) ?>" data-gallery="awards" data-title="<?= e($cap) ?>">
					<img src="<?= img($src) ?>" alt="<?= e($cap) ?>" loading="lazy"><span class="m-cap"><?= e($cap) ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php cta_band(); ?>
<?php page_end(); ?>
