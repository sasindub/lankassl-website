<?php
page_start(['title' => 'Page not found', 'body' => 'no-hero']);
?>
<section class="nf">
	<div class="container" style="display:grid;gap:20px;justify-items:center">
		<h1 class="gold" data-split>404</h1>
		<h2 class="h-md" data-reveal>This page could not be found.</h2>
		<p class="lead" data-reveal>The page may have moved during our website upgrade.</p>
		<div class="hero-actions" data-reveal style="justify-content:center">
			<a class="btn btn-gold" href="<?= url('home') ?>">Back to home <?= icon('arrow') ?></a>
			<a class="btn btn-ghost" href="<?= url('products') ?>">Browse products</a>
		</div>
	</div>
</section>
<?php page_end(); ?>
