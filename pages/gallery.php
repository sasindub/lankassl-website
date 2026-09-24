<?php
page_start(['title' => 'Gallery']);
page_hero('Gallery', 'Inside <span class="gold">Lanka SSL</span>', 'Our facility, our people and the moments that define us.', 'gallery/g17.webp', ['Gallery' => null]);
?>

<section class="section">
	<div class="container">
		<div class="filters" role="group" aria-label="Filter gallery" data-reveal>
			<button class="filter is-on" data-filter="all" aria-pressed="true">All</button>
			<?php foreach ($GALLERY as $key => $g): ?>
				<button class="filter" data-filter="<?= e($key) ?>" aria-pressed="false"><?= e($g['label']) ?></button>
			<?php endforeach; ?>
		</div>
		<div class="masonry">
			<?php foreach ($GALLERY as $key => $g): foreach ($g['items'] as $item): ?>
				<a class="m-item glightbox" href="<?= img('gallery/' . $item . '.webp') ?>" data-gallery="site" data-cat="<?= e($key) ?>" data-title="<?= e($g['label']) ?>" data-reveal>
					<img src="<?= img('gallery/t/' . $item . '.webp') ?>" alt="<?= e($g['label']) ?> — Lanka Special Steels" loading="lazy">
					<span class="m-cap"><?= e($g['label']) ?></span>
				</a>
			<?php endforeach; endforeach; ?>
		</div>
	</div>
</section>

<?php cta_band('Visit our facility', 'Interested in seeing how our wire is made? Get in touch to arrange a visit to our Sapugaskanda plant.'); ?>
<?php page_end(); ?>
