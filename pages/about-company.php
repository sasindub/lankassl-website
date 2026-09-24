<?php
page_start(['title' => 'About Us', 'description' => 'Lanka Special Steels Limited — BOI-registered leader in Sri Lanka’s steel wire industry and a subsidiary of E.B. Creasy & Co. PLC.']);
page_hero('About Lanka SSL', 'Trusted Name <span class="gold">in Steels</span>.', 'A BOI-registered leader in Sri Lanka’s steel wire industry — and the country’s largest, most established manufacturer of galvanized iron wire.', 'site/hero-factory.webp', ['Company' => null, 'About Us' => null]);
?>

<section class="section">
	<div class="container split">
		<div class="prose">
			<p class="eyebrow" data-reveal>Corporate overview</p>
			<h2 class="h-lg" data-split>Leading the fencing wire segment.</h2>
			<p class="lead" data-reveal>Lanka Special Steels Limited (Lanka SSL) is widely recognised as the largest and most established manufacturer of galvanized iron wire in Sri Lanka.</p>
			<p data-reveal>With a strong focus on quality, reliability and customer satisfaction, we manufacture a comprehensive range of galvanized and mild steel wire products for agriculture, construction, infrastructure development, industry and residential use. An extensive, well-integrated island-wide distribution network keeps our products — sold under the well-known <strong>LAXAPANA</strong> brand — consistently available across Sri Lanka.</p>
			<p data-reveal>As a subsidiary of <strong>E.B. Creasy &amp; Co. PLC</strong>, one of the country’s oldest and most diversified conglomerates, Lanka SSL benefits from a legacy of trust, stability and strong corporate governance.</p>
		</div>
		<div class="media-frame" data-reveal>
			<img src="<?= img('site/inauguration.webp') ?>" alt="Inauguration of the Lanka SSL manufacturing facility" loading="lazy" data-parallax>
			<div class="media-badge"><strong>1878</strong><span>E.B. Creasy heritage — over a century of Sri Lankan business</span></div>
		</div>
	</div>
</section>

<section class="section alt">
	<div class="container">
		<div class="section-head center">
			<p class="eyebrow" data-reveal>Our journey</p>
			<h2 class="h-lg" data-split>Three decades of shaping Sri Lanka’s steel wire industry.</h2>
		</div>
		<div class="timeline">
			<span class="timeline-fill" aria-hidden="true"></span>
			<?php foreach ($MILESTONES as $m): ?>
				<div class="t-item" data-reveal>
					<div class="t-year"><?= e($m[0]) ?></div>
					<div class="t-body"><h3><?= e($m[1]) ?></h3><p><?= e($m[2]) ?></p></div>
				</div>
			<?php endforeach; ?>
			<div class="t-item" data-reveal>
				<div class="t-year">Today</div>
				<div class="t-body"><h3>Sri Lanka’s leading GI wire manufacturer</h3><p>Hot-dipped galvanized wire and value-added products — barbed wire and chain link fencing — made to global standards and exported to India and Canada.</p></div>
			</div>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="split" style="align-items:start">
			<div class="prose">
				<p class="eyebrow" data-reveal>Our vision</p>
				<h2 class="h-lg" data-split>Enhancing the quality of life of the communities we serve.</h2>
			</div>
			<div class="prose">
				<p class="lead" data-reveal>Aligned with the broader vision of the E.B. Creasy Group, we remain committed to excellence across every aspect of our operations.</p>
				<p data-reveal>We are driven to create sustainable value for all stakeholders by continuously improving our systems, processes and capabilities through innovation — achieved through the active involvement, empowerment and development of our employees, the backbone of our organisation.</p>
			</div>
		</div>
	</div>
</section>

<section class="section alt">
	<div class="container">
		<div class="section-head">
			<p class="eyebrow" data-reveal>Core values</p>
			<h2 class="h-lg" data-split>What guides everything we do.</h2>
		</div>
		<div class="strength-grid" data-stagger>
			<?php foreach ($VALUES as $i => $v): ?>
				<div class="strength">
					<span class="num"><?= e(strtoupper($v[0][0])) ?></span>
					<h3><?= e($v[0]) ?></h3>
					<p><?= e($v[1]) ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-head">
			<p class="eyebrow" data-reveal>People, offer &amp; conduct</p>
			<h2 class="h-lg" data-split>How we make the difference.</h2>
		</div>
		<div class="card-grid four" data-stagger>
			<?php foreach ($PILLARS as $i => $p): ?>
				<div class="card">
					<span class="icon-box"><?= icon(['users', 'award', 'spark', 'shield'][$i]) ?></span>
					<h3><?= e($p[0]) ?></h3>
					<p><?= e($p[1]) ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section alt">
	<div class="container">
		<div class="section-head">
			<p class="eyebrow" data-reveal>What makes us stand out</p>
			<h2 class="h-lg" data-split>Seven reasons customers choose us.</h2>
		</div>
		<div class="strength-grid" data-stagger>
			<?php foreach ($STRENGTHS as $i => $s): ?>
				<div class="strength">
					<span class="num"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
					<h3><?= e($s[0]) ?></h3>
					<p><?= e($s[1]) ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section-tight">
	<div class="container card-grid two">
		<a class="card" href="<?= url('board-of-directors') ?>" data-reveal>
			<span class="icon-box"><?= icon('shield') ?></span>
			<h3>Board of Directors</h3>
			<p>Experienced leadership from across the E.B. Creasy Group.</p>
			<span class="link-arrow">Meet the board <?= icon('arrow') ?></span>
		</a>
		<a class="card" href="<?= url('management-team') ?>" data-reveal>
			<span class="icon-box"><?= icon('users') ?></span>
			<h3>Management Team</h3>
			<p>The people who lead our operations, quality, sales and support.</p>
			<span class="link-arrow">Meet the team <?= icon('arrow') ?></span>
		</a>
	</div>
</section>

<?php cta_band(); ?>
<?php page_end(); ?>
