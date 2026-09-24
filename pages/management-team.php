<?php
page_start(['title' => 'Management Team']);
page_hero('Leadership', 'Management <span class="gold">Team</span>', 'The people who lead our operations, quality, sales and support — with pride, passion and purpose.', 'site/team-all.webp', ['Company' => null, 'Management Team' => null]);
?>

<section class="section">
	<div class="container leader">
		<div class="leader-photo" data-reveal>
			<img src="<?= img($CEO['photo']) ?>" alt="<?= e($CEO['name'] ?: $CEO['role']) ?>, Lanka Special Steels" loading="lazy">
		</div>
		<div class="prose">
			<p class="eyebrow" data-reveal><?= e($CEO['role']) ?></p>
			<h2 class="h-lg" data-split><?= $CEO['name'] ? e($CEO['name']) : 'Leading with <span class="gold">purpose</span>.' ?></h2>
			<p class="lead" data-reveal>Our management team combines decades of steel industry experience with a culture of teamwork, continuous improvement and safety-first operations.</p>
			<p data-reveal>Together we are committed to delivering reliable, high-quality products, developing our people and upholding the highest standards of ethical conduct — in line with the values of the E.B. Creasy Group.</p>
		</div>
	</div>
</section>

<section class="section alt">
	<div class="container">
		<div class="section-head">
			<p class="eyebrow" data-reveal>Our team</p>
			<h2 class="h-lg" data-split>The people behind Lanka SSL.</h2>
		</div>
		<div class="people-grid" data-stagger>
			<?php foreach ($MANAGEMENT as $m): ?>
				<article class="person">
					<div class="person-photo"><img src="<?= img('people/' . $m[2] . '.webp') ?>" alt="<?= e($m[0]) ?>" loading="lazy"></div>
					<div class="person-body"><strong><?= e($m[0]) ?></strong><span><?= e($m[1]) ?></span></div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php cta_band('Build your career with Lanka SSL', 'We are always looking for driven people who love to learn and embrace new challenges.'); ?>
<?php page_end(); ?>
