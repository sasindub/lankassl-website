<?php
page_start(['title' => 'Business Excellence', 'description' => 'Safety management, in-house quality assurance, certifications and export presence at Lanka Special Steels Limited.']);
page_hero('Business excellence', 'Safety, quality and <span class="gold">global</span> standards.', 'A safety-first culture, rigorous in-house testing and certifications that open the world’s most demanding markets.', 'site/line.webp', ['Company' => null, 'Business Excellence' => null]);
?>

<section class="section">
	<div class="container split">
		<div class="media-frame wide" data-reveal>
			<img src="<?= img('gallery/safety-3.webp') ?>" alt="Fire safety drill at the Lanka SSL factory" loading="lazy" data-parallax>
		</div>
		<div class="prose">
			<p class="eyebrow" data-reveal>Safety management system</p>
			<h2 class="h-lg" data-split>Safety first, every shift.</h2>
			<p data-reveal>The well-being, occupational health and safety of our employees is our highest priority. A comprehensive <strong>Smart Safety Management System</strong> embeds a safety-first culture across all operations — with clear guidance, stringent operational controls and continuous monitoring, including the safety of machinery and production processes.</p>
			<ul class="check-list" data-stagger>
				<li><?= icon('check') ?> Certified to ISO 45001:2018</li>
				<li><?= icon('check') ?> Structured risk management and workforce protection</li>
				<li><?= icon('check') ?> Regular drills and safety training</li>
			</ul>
		</div>
	</div>
</section>

<section class="section alt">
	<div class="container split reverse">
		<div class="media-frame wide" data-reveal>
			<img src="<?= img('gallery/g18.webp') ?>" alt="Quality assurance testing in the Lanka SSL laboratory" loading="lazy" data-parallax>
		</div>
		<div class="prose">
			<p class="eyebrow" data-reveal>Quality assurance</p>
			<h2 class="h-lg" data-split>Tested in-house. Verified independently.</h2>
			<p data-reveal>A fully equipped in-house Quality Assurance facility carries out tensile strength evaluations, zinc coating mass analysis, wrapping tests and numerous in-process checks to ensure consistent performance and compliance.</p>
			<p data-reveal>This is strengthened by regular independent testing through the <strong>Sri Lanka Standards Institution (SLSI)</strong>, the <strong>Industrial Technology Institute (ITI)</strong> and the <strong>University of Moratuwa</strong>.</p>
			<div class="chips" data-stagger>
				<span class="chip">Tensile strength</span><span class="chip">Zinc coating mass</span><span class="chip">Wrapping test</span><span class="chip">In-process checks</span>
			</div>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-head">
			<p class="eyebrow" data-reveal>Quality certifications</p>
			<h2 class="h-lg" data-split>Certified to national &amp; international standards.</h2>
			<p class="lead" data-reveal>Our signature hot-dip galvanized wire is certified to SLS 139:2003 and our barbed wire to SLS 31:1988. For export to India we hold BIS certification to IS 280:2006, and the company is ISO 9001:2015 accredited.</p>
		</div>
		<div class="marks" data-stagger>
			<?php foreach ($CERTIFICATES as $c): ?>
				<a class="mark" href="<?= url('certifications') ?>">
					<img src="<?= img($c[4]) ?>" alt="" loading="lazy">
					<strong><?= e($c[0]) ?></strong>
					<span><?= e($c[1]) ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section alt">
	<div class="container export">
		<div>
			<p class="eyebrow" data-reveal>Export presence</p>
			<h2 class="h-lg" data-split style="margin:18px 0">Trusted beyond our shores.</h2>
			<p class="lead" data-reveal>We export high-quality GI wire and barbed wire directly to India and Canada — both known for stringent import quality standards.</p>
			<p class="muted" data-reveal style="margin-top:16px">In India we serve major industrial regions including South India, Mumbai, Hyderabad and Visakhapatnam, mainly for poultry and fencing applications. Lanka SSL is among the limited number of foreign manufacturers authorised to export to India under BIS IS 280. Our GI wire also reaches the United States, Europe and Japan indirectly, through value-added products exported under the TIEP scheme.</p>
		</div>
		<div class="stats-row" style="grid-template-columns:1fr 1fr" data-stagger>
			<div class="stat"><strong>India</strong><span>Direct export · BIS IS 280 certified</span></div>
			<div class="stat"><strong>Canada</strong><span>Direct export · poultry &amp; fencing</span></div>
			<div class="stat"><strong>USA · EU</strong><span>Indirect export via TIEP</span></div>
			<div class="stat"><strong>Japan</strong><span>Indirect export via TIEP</span></div>
		</div>
	</div>
</section>

<?php cta_band(); ?>
<?php page_end(); ?>
