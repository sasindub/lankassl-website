<?php
page_start(['title' => 'Product Specifications']);
page_hero('Technical data', 'Product <span class="gold">specifications</span>', 'Manufactured in accordance with SLS 139:2003. Custom tensile strength and coil weights are available on request.', 'products/gi-coils.webp', ['Products' => 'products', 'Specifications' => null]);
?>

<section class="section">
	<div class="container tables">
		<?php foreach ($SPEC_TABLES as $t): ?>
			<div data-reveal>
				<div class="table-title"><h3><?= e($t['title']) ?></h3><span>SLS 139:2003</span></div>
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

<?php cta_band('Need a different specification?', 'We can tailor diameter, tensile strength, zinc coating and coil weight to your requirement — even for small batches.'); ?>
<?php page_end(); ?>
