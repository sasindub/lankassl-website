<?php
page_start(['title' => 'Checkout', 'body' => 'no-hero page-checkout']);
?>

<section class="section checkout" data-checkout>
	<div class="container">
		<nav class="crumbs" aria-label="Breadcrumb"><a href="<?= url('home') ?>">Home</a><span>/</span><span aria-current="page">Checkout</span></nav>
		<div class="section-head" style="margin-top:18px">
			<p class="eyebrow">Place your order</p>
			<h1 class="h-lg">Checkout</h1>
			<p class="lead">Tell us where to deliver. Our sales team will confirm pricing, availability and delivery with you before anything is dispatched.</p>
		</div>

		<!-- Empty cart -->
		<div class="checkout-empty" data-checkout-empty hidden>
			<span class="icon-box"><?= icon('cart') ?></span>
			<h2 class="h-md">Your cart is empty</h2>
			<p class="muted">Browse our products and add what you need.</p>
			<a class="btn btn-gold" href="<?= url('products') ?>">Browse products <?= icon('arrow') ?></a>
		</div>

		<!-- Success -->
		<div class="checkout-success" data-checkout-success hidden>
			<span class="icon-box success"><?= icon('check') ?></span>
			<p class="eyebrow">Order received</p>
			<h2 class="h-lg">Thank you!</h2>
			<p class="lead">Your order number is <strong class="gold" data-order-no></strong>. Please keep it for your reference — our sales team will contact you shortly to confirm pricing and delivery.</p>
			<div class="hero-actions" style="justify-content:center">
				<a class="btn btn-gold" href="<?= url('products') ?>">Continue browsing <?= icon('arrow') ?></a>
				<a class="btn btn-ghost" href="tel:<?= e(str_replace(' ', '', $COMPANY['phone'])) ?>"><?= icon('phone') ?> <?= e($COMPANY['phone_all']) ?></a>
			</div>
		</div>

		<form class="checkout-grid" data-checkout-form novalidate>
			<div class="checkout-main">
				<div class="form-card">
					<h2 class="h-md">Contact details</h2>
					<div class="form">
						<div class="form-row">
							<div class="field"><label for="co-name">Full name *</label><input id="co-name" name="name" required autocomplete="name" maxlength="120"><small class="field-error" data-error="name"></small></div>
							<div class="field"><label for="co-company">Company <span class="muted">(optional)</span></label><input id="co-company" name="company" autocomplete="organization" maxlength="160"></div>
						</div>
						<div class="form-row">
							<div class="field"><label for="co-email">Email *</label><input id="co-email" name="email" type="email" required autocomplete="email" maxlength="160"><small class="field-error" data-error="email"></small></div>
							<div class="field"><label for="co-phone">Phone *</label><input id="co-phone" name="phone" type="tel" required autocomplete="tel" maxlength="30" placeholder="07X XXX XXXX"><small class="field-error" data-error="phone"></small></div>
						</div>
					</div>
				</div>

				<div class="form-card">
					<h2 class="h-md">Delivery address</h2>
					<div class="form">
						<div class="field"><label for="co-a1">Street address *</label><input id="co-a1" name="address_line1" required autocomplete="address-line1" maxlength="200"><small class="field-error" data-error="address_line1"></small></div>
						<div class="field"><label for="co-a2">Address line 2 <span class="muted">(optional)</span></label><input id="co-a2" name="address_line2" autocomplete="address-line2" maxlength="200"></div>
						<div class="form-row">
							<div class="field"><label for="co-city">City / town *</label><input id="co-city" name="city" required autocomplete="address-level2" maxlength="100"><small class="field-error" data-error="city"></small></div>
							<div class="field"><label for="co-district">District *</label>
								<select id="co-district" name="district" required>
									<option value="">Select district</option>
									<?php foreach ($DISTRICTS as $d): ?><option><?= e($d) ?></option><?php endforeach; ?>
								</select>
								<small class="field-error" data-error="district"></small>
							</div>
						</div>
						<div class="form-row">
							<div class="field"><label for="co-postal">Postal code <span class="muted">(optional)</span></label><input id="co-postal" name="postal_code" inputmode="numeric" autocomplete="postal-code" maxlength="5"><small class="field-error" data-error="postal_code"></small></div>
							<div class="field" aria-hidden="true"></div>
						</div>
						<div class="field"><label for="co-notes">Order notes <span class="muted">(optional)</span></label><textarea id="co-notes" name="notes" maxlength="2000" placeholder="Delivery instructions, preferred contact time, project details…"></textarea></div>
						<input class="hp" type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
					</div>
				</div>
			</div>

			<aside class="checkout-summary">
				<div class="form-card">
					<div class="summary-head"><h2 class="h-md">Order summary</h2><span class="muted" data-summary-count></span></div>
					<div class="summary-items" data-summary-items></div>
					<small class="field-error" data-error="items"></small>
					<div class="summary-total" data-summary-total hidden>
						<div class="cart-total"><span>Subtotal</span><strong data-summary-subtotal></strong></div>
						<small class="muted" data-summary-tbc></small>
					</div>
					<p class="cart-note">No payment is taken online. Our sales team will call or email you to confirm availability, delivery and the final amount.</p>
					<button class="btn btn-gold btn-block" type="submit" data-place-order><?= icon('bag') ?> Place order</button>
					<p class="form-status" role="status" aria-live="polite" data-checkout-status></p>
				</div>
			</aside>
		</form>
	</div>
</section>

<?php page_end(); ?>
