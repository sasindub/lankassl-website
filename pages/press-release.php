<?php
page_start(['title' => 'Press Releases']);
page_hero('Newsroom', 'Press <span class="gold">releases</span>', 'News, research and media coverage about Lanka Special Steels.', 'site/inauguration.webp', ['Achievements' => null, 'Press Releases' => null]);
?>

<section class="section">
	<div class="container">
		<div class="doc-grid" data-stagger>
			<?php foreach ($PRESS as $i => $p): ?>
				<article class="doc<?= $i === 0 ? ' doc-featured' : '' ?>">
					<a class="doc-media glightbox" href="<?= img($p[2]) ?>" data-gallery="press" data-title="<?= e($p[0]) ?>" <?= $i === 0 ? 'style="aspect-ratio:16/10"' : '' ?>>
						<img src="<?= img($p[2]) ?>" alt="<?= e($p[0]) ?>" loading="lazy">
					</a>
					<div class="doc-body">
						<div class="doc-meta"><span><?= e($p[1]) ?></span><span><?= e($p[4]) ?></span></div>
						<h3><?= e($p[0]) ?></h3>
						<div class="doc-actions">
							<a class="link-arrow glightbox" href="<?= img($p[2]) ?>" data-gallery="press-links">Read <?= icon('arrow') ?></a>
							<?php if ($p[3]): ?><a class="link-arrow" href="<?= url($p[3]) ?>" target="_blank" rel="noopener">PDF <?= icon('download') ?></a><?php endif; ?>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php cta_band('Media enquiries', 'For press information, interviews or high-resolution images, please contact our corporate office.'); ?>
<?php page_end(); ?>
