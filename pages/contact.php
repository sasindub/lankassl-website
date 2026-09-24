<?php
page_start(['title' => 'Contact Us', 'description' => 'Contact Lanka Special Steels Limited — corporate office in Colombo 07 and factory in Sapugaskanda.']);
page_hero('Contact', 'Let’s talk <span class="gold">steel</span>.', 'Questions, quotations or technical advice — our team is ready to help.', 'site/factory-2.webp', ['Contact' => null]);
$preselect = $_GET['product'] ?? '';
?>

<section class="section">
	<div class="container contact-grid">
		<div class="prose">
			<p class="eyebrow" data-reveal>Get in touch</p>
			<h2 class="h-lg" data-split>We’d love to hear from you.</h2>
			<p class="lead" data-reveal>Reach us by phone or email, or send a message and a member of our team will respond promptly.</p>
			<div class="info-list" data-stagger>
				<div class="info"><span class="icon-box"><?= icon('phone') ?></span><div><strong>Call us</strong><a href="tel:<?= e(str_replace(' ', '', $COMPANY['phone'])) ?>"><?= e($COMPANY['phone_all']) ?></a></div></div>
				<div class="info"><span class="icon-box"><?= icon('mail') ?></span><div><strong>Email</strong><a href="mailto:<?= e($COMPANY['email']) ?>"><?= e($COMPANY['email']) ?></a></div></div>
				<div class="info"><span class="icon-box"><?= icon('users') ?></span><div><strong>Sales department</strong><p><?= e($SALES_CONTACT['name']) ?> · <?= e($SALES_CONTACT['role']) ?></p><a href="tel:<?= e(str_replace(' ', '', $SALES_CONTACT['mobile'])) ?>"><?= e($SALES_CONTACT['mobile']) ?></a></div></div>
			</div>
		</div>
		<div class="form-card" data-reveal>
			<div class="mesh-bg" aria-hidden="true"></div>
			<form class="form" data-endpoint="post-and-get/ajax/send-message.php" novalidate style="position:relative">
				<div class="form-row">
					<div class="field"><label for="f-name">Full name *</label><input id="f-name" name="name" required autocomplete="name"></div>
					<div class="field"><label for="f-email">Email *</label><input id="f-email" type="email" name="email" required autocomplete="email"></div>
				</div>
				<div class="form-row">
					<div class="field"><label for="f-phone">Phone *</label><input id="f-phone" type="tel" name="phone" required autocomplete="tel"></div>
					<div class="field"><label for="f-product">Product of interest</label>
						<select id="f-product" name="product">
							<option value="">General enquiry</option>
							<?php foreach ($PRODUCTS as $s => $p): ?><option value="<?= e($p['name']) ?>" <?= $preselect === $s ? 'selected' : '' ?>><?= e($p['name']) ?></option><?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="field"><label for="f-msg">Message *</label><textarea id="f-msg" name="message" required placeholder="Quantity, size, delivery location…"></textarea></div>
				<div><button class="btn btn-gold" type="submit">Send message <?= icon('arrow') ?></button></div>
				<p class="form-status" role="status" aria-live="polite"></p>
			</form>
		</div>
	</div>
</section>

<section class="section alt">
	<div class="container">
		<div class="section-head">
			<p class="eyebrow" data-reveal>Our locations</p>
			<h2 class="h-lg" data-split>Find us.</h2>
		</div>
		<div class="locations" data-stagger>
			<?php foreach ($LOCATIONS as $l): ?>
				<article class="location">
					<iframe src="<?= e($l['map']) ?>" title="Map — <?= e($l['label']) ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
					<div class="location-body">
						<p class="eyebrow"><?= e($l['label']) ?></p>
						<h3>Lanka Special Steels Limited</h3>
						<p><?= icon('pin') ?><span><?= e($l['address']) ?></span></p>
						<p><?= icon('phone') ?><span><?= e(implode(' · ', $l['tel'])) ?></span></p>
						<p><?= icon('fax') ?><span>Fax <?= e($l['fax']) ?></span></p>
						<p><?= icon('mail') ?><a href="mailto:<?= e($l['email']) ?>"><?= e($l['email']) ?></a></p>
						<div><a class="link-arrow" href="<?= e($l['link']) ?>" target="_blank" rel="noopener">Get directions <?= icon('arrow-ur') ?></a></div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php page_end(); ?>
