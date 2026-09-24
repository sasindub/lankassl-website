<?php
page_start(['title' => 'Careers']);
page_hero('Careers', 'Build the future <span class="gold">with us</span>.', 'Lanka SSL is always looking for creative, driven people who love to learn, embrace new challenges and enjoy working as a team.', 'gallery/2024-jan6.webp', ['Careers' => null]);
?>

<section class="section">
	<div class="container">
		<div class="card-grid" data-stagger>
			<div class="card"><span class="icon-box"><?= icon('users') ?></span><h3>Teamwork</h3><p>A culture that nurtures talent and develops strong leadership.</p></div>
			<div class="card"><span class="icon-box"><?= icon('hardhat') ?></span><h3>Safe workplace</h3><p>ISO 45001-certified systems and a safety-first mindset.</p></div>
			<div class="card"><span class="icon-box"><?= icon('spark') ?></span><h3>Growth</h3><p>Learn from the leaders of Sri Lanka’s steel wire industry.</p></div>
		</div>
	</div>
</section>

<section class="section alt" id="vacancies">
	<div class="container">
		<div class="section-head">
			<p class="eyebrow" data-reveal>Open positions</p>
			<h2 class="h-lg" data-split>Current vacancies</h2>
		</div>
		<div class="jobs" data-stagger>
			<?php foreach ($VACANCIES as $v): ?>
				<article class="job">
					<div>
						<span class="doc-meta"><span><?= e($v[1]) ?></span><span>Full-time</span></span>
						<h3><?= e($v[0]) ?></h3>
						<p><?= e($v[2]) ?></p>
					</div>
					<a class="btn btn-ghost btn-sm" href="#apply" data-position="<?= e($v[0]) ?>">Apply <?= icon('arrow') ?></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section" id="apply">
	<div class="container contact-grid">
		<div class="prose">
			<p class="eyebrow" data-reveal>Apply now</p>
			<h2 class="h-lg" data-split>Send us your CV.</h2>
			<p class="lead" data-reveal>Tell us a little about yourself and attach your CV. Our HR team will be in touch if your profile matches an opening.</p>
			<div class="media-frame wide" data-reveal style="margin-top:10px">
				<img src="<?= img('gallery/g12.webp') ?>" alt="The Lanka SSL team" loading="lazy" data-parallax>
			</div>
		</div>
		<div class="form-card" data-reveal>
			<form class="form" data-endpoint="post-and-get/ajax/careers-message.php" data-success="Thank you — your application has been sent. Our HR team will contact you if your profile matches." enctype="multipart/form-data" novalidate>
				<div class="form-row">
					<div class="field"><label for="c-name">Full name *</label><input id="c-name" name="name" required autocomplete="name"></div>
					<div class="field"><label for="c-email">Email *</label><input id="c-email" type="email" name="email" required autocomplete="email"></div>
				</div>
				<div class="form-row">
					<div class="field"><label for="c-phone">Phone *</label><input id="c-phone" type="tel" name="phone" required autocomplete="tel"></div>
					<div class="field"><label for="c-position">Position *</label>
						<select id="c-position" name="position" required>
							<option value="">Select a position</option>
							<?php foreach ($VACANCIES as $v): ?><option><?= e($v[0]) ?></option><?php endforeach; ?>
							<option>General application</option>
						</select>
					</div>
				</div>
				<div class="field"><label for="c-cv">Attach your CV *</label><input id="c-cv" type="file" name="pdf" accept=".pdf,.doc,.docx" required><small>PDF or MS Word, under 3 MB.</small></div>
				<div class="field"><label for="c-msg">Message *</label><textarea id="c-msg" name="message" required></textarea></div>
				<div><button class="btn btn-gold" type="submit">Submit application <?= icon('arrow') ?></button></div>
				<p class="form-status" role="status" aria-live="polite"></p>
			</form>
		</div>
	</div>
</section>

<script>
	document.querySelectorAll('[data-position]').forEach(function (a) {
		a.addEventListener('click', function () { document.getElementById('c-position').value = a.getAttribute('data-position'); });
	});
</script>

<?php page_end(); ?>
