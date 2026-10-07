<?php
page_start(['body' => 'page-home']);
$featured = $PRODUCTS['hot-dipped-gi-wire'];
?>

<div class="preloader" aria-hidden="true">
	<div class="preloader-inner">
		<?= brand_logo('on-dark') ?>
		<div class="preloader-bar"><span></span></div>
		<p>Trusted Name in Steels</p>
	</div>
</div>

<!-- Hero -->
<section class="hero">
	<div class="hero-media" aria-hidden="true">
		<img src="<?= img('site/hero-factory.webp') ?>" alt="" fetchpriority="high">
	</div>
	<div class="container hero-inner">
		<p class="eyebrow" data-reveal>Proudly Sri Lankan · Since 1998</p>
		<h1 class="h-xl" data-split>Sri Lanka’s <span class="gold">trusted name</span> in steel wire.</h1>
		<p class="hero-lead" data-reveal>The largest and most established manufacturer of hot-dipped galvanized iron wire in the country — delivering fencing and industrial wire island-wide under the <strong>LAXAPANA</strong> brand.</p>
		<div class="hero-actions" data-reveal>
			<a class="btn btn-gold" href="<?= url('products') ?>">Explore Products <?= icon('arrow') ?></a>
			<a class="btn btn-light" href="<?= url('contact') ?>">Talk to Sales</a>
		</div>

		<div class="hero-stats" data-stagger>
			<div class="hero-stat"><strong>1998</strong><span>Pioneered local steel wire manufacturing</span></div>
			<div class="hero-stat"><strong><span data-count="15000">15,000</span> MT</strong><span>Annual drawing &amp; galvanizing capacity</span></div>
			<div class="hero-stat"><strong><span data-count="400">400</span> g/m²</strong><span>Maximum zinc coating</span></div>
			<div class="hero-stat"><strong>India · Canada</strong><span>Direct export markets</span></div>
		</div>
	</div>
	<span class="scroll-cue">Scroll</span>
</section>

<!-- Standards ticker -->
<div class="marquee" aria-label="Standards and certifications">
	<div class="marquee-track">
		<?php for ($i = 0; $i < 2; $i++): ?>
			<?php foreach (['<b>SLS 139:2003</b> Galvanized Wire', '<b>SLS 31:1988</b> Barbed Wire', '<b>IS 280:2006</b> BIS Certified', '<b>ISO 9001:2015</b> Quality', '<b>ISO 45001:2018</b> Safety', '<b>BOI</b> Registered', '<b>E.B. Creasy</b> Group Company'] as $m): ?>
				<span class="marquee-item" <?= $i ? 'aria-hidden="true"' : '' ?>><?= $m ?></span>
			<?php endforeach; ?>
		<?php endfor; ?>
	</div>
</div>

<!-- About -->
<section class="section">
	<div class="container split">
		<div class="media-frame" data-reveal>
			<img src="<?= img('site/factory-side.webp') ?>" alt="Lanka Special Steels manufacturing facility in Sapugaskanda" loading="lazy" data-parallax>
			<div class="media-badge">
				<strong>BOI</strong>
				<span>Registered manufacturer and a subsidiary of <b>E.B. Creasy &amp; Co. PLC</b></span>
			</div>
		</div>
		<div class="prose">
			<p class="eyebrow" data-reveal>Who we are</p>
			<h2 class="h-lg" data-split>Built in Sri Lanka. Trusted for generations.</h2>
			<p class="lead" data-reveal>Lanka Special Steels Limited is a leader in Sri Lanka’s steel wire industry and holds a dominant position in the fencing wire segment.</p>
			<p data-reveal>We manufacture a comprehensive range of galvanized and mild steel wire products for agriculture, construction, infrastructure, industry and homes — backed by an extensive island-wide distribution network and the legacy, stability and governance of one of the country’s oldest conglomerates.</p>
			<ul class="check-list" data-stagger>
				<li><?= icon('check') ?> Largest domestic manufacturer of GI wire</li>
				<li><?= icon('check') ?> Only integrated SLS-certified barbed wire maker in Sri Lanka</li>
				<li><?= icon('check') ?> Sole authorised distributor of Tata Steel wire products</li>
			</ul>
			<div data-reveal><a class="link-arrow" href="<?= url('about-company') ?>">Discover our story <?= icon('arrow') ?></a></div>
		</div>
	</div>
</section>

<!-- Products -->
<section class="section alt" id="products">
	<div class="container">
		<div class="section-head split">
			<div style="display:grid;gap:18px">
				<p class="eyebrow" data-reveal>Product portfolio</p>
				<h2 class="h-lg" data-split>Wire engineered for every <span class="gold">application</span>.</h2>
			</div>
			<a class="btn btn-ghost" href="<?= url('products') ?>" data-reveal>View all products <?= icon('arrow') ?></a>
		</div>

		<article class="p-feature" data-reveal>
			<div class="p-feature-media">
				<span class="tag" style="position:absolute;top:22px;left:22px">Flagship product</span>
				<img src="<?= img($featured['image']) ?>" alt="<?= e($featured['name']) ?>" loading="lazy" data-float>
			</div>
			<div class="p-feature-body">
				<h3 class="h-md"><?= e($featured['name']) ?></h3>
				<p class="muted"><?= e($featured['lead']) ?></p>
				<dl class="spec-mini">
					<?php foreach (array_slice($featured['specs'], 0, 4, true) as $k => $v): ?>
						<div><dt><?= e($k) ?></dt><dd><?= e($v) ?></dd></div>
					<?php endforeach; ?>
				</dl>
				<div><a class="btn btn-gold" href="<?= url('products/hot-dipped-gi-wire') ?>">View product <?= icon('arrow') ?></a></div>
			</div>
		</article>

		<div class="product-grid" data-stagger>
			<?php foreach ($PRODUCTS as $slug => $p): if ($slug === 'hot-dipped-gi-wire') continue; ?>
				<article class="p-card" data-tilt>
					<span class="tag"><?= e($p['badge']) ?></span>
					<div class="p-card-media<?= !empty($p['photo']) ? ' photo' : '' ?>"><img src="<?= img($p['image']) ?>" alt="<?= e($p['name']) ?>" loading="lazy"></div>
					<div class="p-card-body">
						<h3><?= e($p['short']) ?></h3>
						<p><?= e($p['lead']) ?></p>
						<div class="p-card-actions"><span class="link-arrow">Learn more <?= icon('arrow') ?></span><?= add_to_cart_button($slug) ?></div>
					</div>
					<a class="p-card-link" href="<?= url('products/' . $slug) ?>" aria-label="<?= e($p['name']) ?>"></a>
				</article>
			<?php endforeach; ?>
			<article class="p-card more">
				<div class="p-card-body">
					<h3>Explore the full portfolio</h3>
					<p>Specifications, brochures and end-use applications.</p>
					<span class="link-arrow">All products <?= icon('arrow') ?></span>
				</div>
				<a class="p-card-link" href="<?= url('products') ?>" aria-label="All products"></a>
			</article>
		</div>
	</div>
</section>

<!-- Why Lanka SSL -->
<section class="section">
	<div class="container">
		<div class="section-head">
			<p class="eyebrow" data-reveal>What makes us stand out</p>
			<h2 class="h-lg" data-split>Quality you can build on.</h2>
			<p class="lead" data-reveal>Technical expertise, operational efficiency and customer-first practices — the reasons contractors, farmers and industries across Sri Lanka choose Lanka SSL.</p>
		</div>
		<div class="strength-grid" data-stagger>
			<?php foreach ($STRENGTHS as $i => $s): ?>
				<div class="strength">
					<span class="num"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
					<h3><?= e($s[0]) ?></h3>
					<p><?= e($s[1]) ?></p>
				</div>
			<?php endforeach; ?>
			<div class="strength" style="background:var(--grad-gold);color:var(--on-gold)">
				<span class="num" style="color:inherit;opacity:.7">→</span>
				<h3>Need a custom specification?</h3>
				<p style="color:inherit;opacity:.8">Tensile strength, coil weight, mesh size — tell us what your project needs.</p>
				<a href="<?= url('contact') ?>" class="link-arrow" style="color:inherit">Contact sales <?= icon('arrow') ?></a>
			</div>
		</div>
	</div>
</section>

<!-- LAXAPANA brand -->
<section class="section-tight brand-band">
	<div class="container">
		<div class="brand-card" data-reveal>
			<div>
				<img class="laxapana" src="<?= img('brand/laxapana-white.png') ?>" alt="LAXAPANA" loading="lazy">
				<p class="eyebrow">Our consumer brand</p>
				<h2 class="h-lg" style="margin:14px 0 16px">A household name in every corner of the island.</h2>
				<p>Barbed wire, GI wire and chain link fencing from Lanka SSL reach homes, farms and project sites across Sri Lanka under the LAXAPANA brand — backed by an island-wide distribution network.</p>
				<p class="brand-slogan"><span lang="si">අපේ දෙයක්</span><span lang="ta">எங்களுடையது</span></p>
			</div>
			<div class="mascot-wrap">
				<img src="<?= img('brand/mascot.webp') ?>" alt="LAXAPANA chain link fence mascot" loading="lazy" data-float>
			</div>
		</div>
	</div>
</section>

<!-- Exports -->
<section class="section">
	<div class="container export">
		<div>
			<p class="eyebrow" data-reveal>Export presence</p>
			<h2 class="h-lg" data-split style="margin:18px 0">Meeting the world’s most demanding standards.</h2>
			<p class="lead" data-reveal>We export GI wire and barbed wire directly to India and Canada — markets known for stringent import quality — and are among the few foreign manufacturers authorised to export to India under BIS IS 280.</p>
			<div class="market-list" data-stagger>
				<div class="market"><?= icon('globe') ?><div><strong>India</strong><p>South India, Mumbai, Hyderabad &amp; Visakhapatnam — poultry and fencing applications.</p></div></div>
				<div class="market"><?= icon('globe') ?><div><strong>Canada</strong><p>Premium GI wire for poultry cage and fencing segments.</p></div></div>
				<div class="market"><?= icon('layers') ?><div><strong>USA · Europe · Japan</strong><p>Indirect exports through value-added products under the TIEP scheme.</p></div></div>
			</div>
		</div>
		<div class="routes" data-reveal aria-hidden="true">
			<svg viewBox="0 0 500 410">
				<defs>
					<linearGradient id="goldline" x1="0" x2="1"><stop offset="0" stop-color="#f6e3a1"/><stop offset="1" stop-color="#a8821f"/></linearGradient>
					<pattern id="dots" width="14" height="14" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="1.2" class="grid-dots"/></pattern>
				</defs>
				<rect width="500" height="410" fill="url(#dots)" opacity=".7"/>
				<path class="route" d="M330 300 C 300 180, 160 100, 90 90"/>
				<path class="route" d="M330 300 C 320 250, 305 225, 300 205"/>
				<path class="route" d="M330 300 C 380 200, 420 150, 440 110"/>
				<g><circle class="node-ring" cx="330" cy="300" r="10"/><circle class="node" cx="330" cy="300" r="6"/><text x="346" y="305">Sri Lanka</text><text class="sub" x="346" y="321">Sapugaskanda plant</text></g>
				<g><circle class="node-ring" cx="300" cy="205" r="8"/><circle class="node" cx="300" cy="205" r="5"/><text x="222" y="200">India</text><text class="sub" x="190" y="216">BIS · IS 280</text></g>
				<g><circle class="node-ring" cx="90" cy="90" r="8"/><circle class="node" cx="90" cy="90" r="5"/><text x="104" y="86">Canada</text><text class="sub" x="104" y="102">Poultry &amp; fencing</text></g>
				<g><circle class="node" cx="440" cy="110" r="4"/><text x="380" y="92">Japan</text></g>
			</svg>
		</div>
	</div>
</section>

<!-- Awards -->
<section class="section alt">
	<div class="container award-feature">
		<div class="trophy-frame" data-reveal>
			<img src="<?= img('awards/awards.webp') ?>" alt="Lanka SSL national awards" loading="lazy" data-parallax>
		</div>
		<div>
			<p class="eyebrow" data-reveal>Recognition</p>
			<h2 class="h-lg" data-split style="margin:18px 0">An award-winning record of excellence.</h2>
			<p class="lead" data-reveal>National Gold at the CNCI Achiever Awards 2020, consecutive Gold Awards at the National Convention on Quality &amp; Productivity since 2014, and top honours at the National Business Excellence Awards.</p>
			<div class="stats-row three" data-stagger>
				<div class="stat"><strong data-count="12" data-suffix="+">12+</strong><span>Gold awards since 2019</span></div>
				<div class="stat"><strong>2020</strong><span>CNCI National Gold</span></div>
				<div class="stat"><strong>2014</strong><span>Gold every year since</span></div>
			</div>
			<a class="link-arrow" href="<?= url('awards') ?>" data-reveal>See all awards <?= icon('arrow') ?></a>
		</div>
	</div>
</section>

<!-- Certification marks -->
<section class="section-tight">
	<div class="container">
		<div class="section-head center">
			<p class="eyebrow" data-reveal>Certified quality</p>
			<h2 class="h-md" data-split>National &amp; international certifications</h2>
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

<?php cta_band(); ?>

<?php page_end(); ?>
