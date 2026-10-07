(function () {
	'use strict';

	var LSSL = window.LSSL || {};
	var catalog = LSSL.catalog || {};
	var KEY = 'lssl-cart-v1';
	var MAX_QTY = 100000;
	var $ = function (s, c) { return (c || document).querySelector(s); };
	var $$ = function (s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); };

	/* ---------- store ---------- */
	function load() {
		var items = [];
		try { items = JSON.parse(localStorage.getItem(KEY) || '[]'); } catch (e) {}
		if (!Array.isArray(items)) items = [];
		return items.filter(function (it) {
			var p = it && catalog[it.slug];
			return p && p.variants.indexOf(it.variant) !== -1 && it.qty >= 1;
		}).map(function (it) {
			return { slug: it.slug, variant: it.variant, note: String(it.note || '').slice(0, 200), qty: clampQty(it.qty) };
		});
	}
	function save() {
		try { localStorage.setItem(KEY, JSON.stringify(cart)); } catch (e) {}
		render();
	}
	function clampQty(v) {
		v = parseInt(v, 10);
		if (!isFinite(v) || v < 1) return 1;
		return Math.min(v, MAX_QTY);
	}
	function add(slug, variant, qty, note) {
		note = String(note || '').trim().slice(0, 200);
		var existing = cart.filter(function (it) { return it.slug === slug && it.variant === variant && it.note === note; })[0];
		if (existing) existing.qty = clampQty(existing.qty + qty);
		else cart.push({ slug: slug, variant: variant, note: note, qty: clampQty(qty) });
		save();
	}

	var cart = load();

	/* ---------- helpers ---------- */
	function el(tag, cls, text) {
		var n = document.createElement(tag);
		if (cls) n.className = cls;
		if (text !== undefined) n.textContent = text;
		return n;
	}
	function iconSvg(path) {
		var ns = 'http://www.w3.org/2000/svg';
		var svg = document.createElementNS(ns, 'svg');
		svg.setAttribute('viewBox', '0 0 24 24'); svg.setAttribute('class', 'ico');
		svg.setAttribute('fill', 'none'); svg.setAttribute('stroke', 'currentColor');
		svg.setAttribute('stroke-width', '1.7'); svg.setAttribute('stroke-linecap', 'round'); svg.setAttribute('aria-hidden', 'true');
		var p = document.createElementNS(ns, 'path'); p.setAttribute('d', path); svg.appendChild(p);
		return svg;
	}
	var ICON = { minus: 'M5 12h14', plus: 'M12 5v14M5 12h14', trash: 'M4 7h16M9 7V4h6v3M6 7l1 13h10l1-13' };
	function unitLabel(unit, qty) {
		if (unit === 'kg') return 'kg';
		return qty === 1 ? unit : unit + 's';
	}

	var toastEl = $('[data-toast]');
	var toastTimer;
	function toast(msg, withLink) {
		if (!toastEl) return;
		toastEl.textContent = msg;
		if (withLink) {
			var b = el('button', 'toast-link', 'View cart');
			b.type = 'button';
			b.addEventListener('click', openDrawer);
			toastEl.appendChild(b);
		}
		toastEl.classList.add('show');
		clearTimeout(toastTimer);
		toastTimer = setTimeout(function () { toastEl.classList.remove('show'); }, 3600);
	}

	/* ---------- line item UI (drawer + checkout) ---------- */
	function lineItem(it, index, compact) {
		var p = catalog[it.slug];
		var row = el('div', 'line');
		var thumb = el('a', 'line-thumb' + (p.photo ? ' photo' : ''));
		thumb.href = p.url;
		var img = el('img'); img.src = p.image; img.alt = ''; img.loading = 'lazy';
		thumb.appendChild(img);
		row.appendChild(thumb);

		var info = el('div', 'line-info');
		var name = el('a', 'line-name', p.short); name.href = p.url;
		info.appendChild(name);
		info.appendChild(el('span', 'line-variant', it.variant));
		if (it.note) info.appendChild(el('span', 'line-note', '“' + it.note + '”'));

		var controls = el('div', 'line-controls');
		var qty = el('div', 'qty qty-sm');
		var minus = el('button', 'qty-btn'); minus.type = 'button'; minus.setAttribute('aria-label', 'Decrease'); minus.appendChild(iconSvg(ICON.minus));
		var input = el('input'); input.type = 'number'; input.min = '1'; input.max = String(MAX_QTY); input.value = it.qty; input.setAttribute('aria-label', 'Quantity for ' + p.short); input.inputMode = 'numeric';
		var plus = el('button', 'qty-btn'); plus.type = 'button'; plus.setAttribute('aria-label', 'Increase'); plus.appendChild(iconSvg(ICON.plus));
		qty.appendChild(minus); qty.appendChild(input); qty.appendChild(plus);
		controls.appendChild(qty);
		controls.appendChild(el('span', 'line-unit', unitLabel(p.unit, it.qty)));
		var remove = el('button', 'line-remove'); remove.type = 'button'; remove.setAttribute('aria-label', 'Remove ' + p.short); remove.appendChild(iconSvg(ICON.trash));
		controls.appendChild(remove);
		info.appendChild(controls);
		row.appendChild(info);

		minus.addEventListener('click', function () { if (cart[index].qty > 1) { cart[index].qty--; save(); } });
		plus.addEventListener('click', function () { cart[index].qty = clampQty(cart[index].qty + 1); save(); });
		input.addEventListener('change', function () { cart[index].qty = clampQty(input.value); save(); });
		remove.addEventListener('click', function () { cart.splice(index, 1); save(); });
		return row;
	}

	function render() {
		var count = cart.length;
		$$('[data-cart-count]').forEach(function (b) {
			b.textContent = count;
			b.hidden = count === 0;
		});

		var body = $('[data-cart-items]');
		var checkoutBtn = $('[data-cart-checkout]');
		if (body) {
			body.innerHTML = '';
			if (!count) {
				var empty = el('div', 'cart-empty');
				empty.appendChild(el('p', '', 'Your cart is empty.'));
				var a = el('a', 'link-arrow', 'Browse products →'); a.href = LSSL.root + '/products';
				empty.appendChild(a);
				body.appendChild(empty);
			} else {
				cart.forEach(function (it, i) { body.appendChild(lineItem(it, i, true)); });
			}
		}
		if (checkoutBtn) checkoutBtn.classList.toggle('is-disabled', !count);

		renderCheckout();
	}

	/* ---------- drawer ---------- */
	var drawer = $('#cart-drawer');
	var lastFocus = null;
	function openDrawer() {
		if (!drawer) return;
		lastFocus = document.activeElement;
		drawer.classList.add('open');
		drawer.setAttribute('aria-hidden', 'false');
		document.documentElement.classList.add('no-scroll');
		if (window.lsslLenis) window.lsslLenis.stop();
		var close = $('[data-cart-close].icon-btn', drawer);
		if (close) close.focus();
		if (toastEl) toastEl.classList.remove('show');
	}
	function closeDrawer() {
		if (!drawer || !drawer.classList.contains('open')) return;
		drawer.classList.remove('open');
		drawer.setAttribute('aria-hidden', 'true');
		document.documentElement.classList.remove('no-scroll');
		if (window.lsslLenis) window.lsslLenis.start();
		if (lastFocus) lastFocus.focus();
	}
	$$('.cart-toggle').forEach(function (b) { b.addEventListener('click', openDrawer); });
	$$('[data-cart-close]').forEach(function (b) { b.addEventListener('click', closeDrawer); });
	document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeDrawer(); });
	var checkoutLink = $('[data-cart-checkout]');
	if (checkoutLink) checkoutLink.addEventListener('click', function (e) { if (!cart.length) e.preventDefault(); });

	/* ---------- qty steppers (static markup) ---------- */
	document.addEventListener('click', function (e) {
		var btn = e.target.closest('.qty-btn[data-step]');
		if (!btn) return;
		var input = btn.parentElement.querySelector('input');
		input.value = clampQty((parseInt(input.value, 10) || 0) + parseInt(btn.getAttribute('data-step'), 10));
	});

	/* ---------- add-to-cart dialog ---------- */
	var dialog = $('#add-dialog');
	var current = null;
	function openAdd(slug) {
		var p = catalog[slug];
		if (!p || !dialog) return;
		current = slug;
		$('[data-add-image]', dialog).src = p.image;
		$('.add-thumb', dialog).classList.toggle('photo', !!p.photo);
		$('[data-add-family]', dialog).textContent = p.family;
		$('[data-add-name]', dialog).textContent = p.name;
		$('[data-add-label]', dialog).textContent = p.label;
		$('[data-add-unit]', dialog).textContent = '(' + p.unit + ')';
		var sel = $('[data-add-variant]', dialog);
		sel.innerHTML = '';
		p.variants.forEach(function (v) { sel.appendChild(el('option', '', v)); });
		var note = $('[data-add-note]', dialog);
		note.value = ''; note.placeholder = p.noteHint || 'Any specification details';
		$('[data-add-qty]', dialog).value = 1;
		if (typeof dialog.showModal === 'function') dialog.showModal(); else dialog.setAttribute('open', '');
		sel.focus();
	}
	if (dialog) {
		dialog.addEventListener('close', function () {
			if (dialog.returnValue === 'add' && current) {
				var p = catalog[current];
				var qty = clampQty($('[data-add-qty]', dialog).value);
				add(current, $('[data-add-variant]', dialog).value, qty, $('[data-add-note]', dialog).value);
				toast(p.short + ' added to cart', true);
			}
			dialog.returnValue = '';
			current = null;
		});
		dialog.addEventListener('click', function (e) { if (e.target === dialog) dialog.close('cancel'); });
	}
	document.addEventListener('click', function (e) {
		var btn = e.target.closest('[data-add-to-cart]');
		if (!btn) return;
		e.preventDefault();
		e.stopPropagation();
		openAdd(btn.getAttribute('data-add-to-cart'));
	});

	/* ---------- product page order panel ---------- */
	$$('[data-order-panel]').forEach(function (form) {
		form.addEventListener('submit', function (e) {
			e.preventDefault();
			var slug = form.getAttribute('data-order-panel');
			var p = catalog[slug];
			add(slug, form.elements.variant.value, clampQty(form.elements.qty.value), form.elements.note.value);
			form.elements.note.value = '';
			form.elements.qty.value = 1;
			toast(p.short + ' added to cart', true);
		});
	});

	/* ---------- checkout ---------- */
	var co = $('[data-checkout]');
	var coForm = co && $('[data-checkout-form]', co);
	var placed = false;

	function renderCheckout() {
		if (!co || placed) return;
		var empty = !cart.length;
		$('[data-checkout-empty]', co).hidden = !empty;
		coForm.hidden = empty;
		var list = $('[data-summary-items]', co);
		list.innerHTML = '';
		cart.forEach(function (it, i) { list.appendChild(lineItem(it, i, false)); });
		$('[data-summary-count]', co).textContent = cart.length + (cart.length === 1 ? ' item' : ' items');
	}

	function showErrors(errors) {
		$$('[data-error]', co).forEach(function (s) { s.textContent = ''; });
		$$('.field.has-error', co).forEach(function (f) { f.classList.remove('has-error'); });
		var first = null;
		Object.keys(errors || {}).forEach(function (k) {
			var slot = $('[data-error="' + k + '"]', co);
			if (!slot) return;
			slot.textContent = errors[k];
			var field = slot.closest('.field');
			if (field) { field.classList.add('has-error'); if (!first) first = field.querySelector('input, select, textarea'); }
		});
		if (first) first.focus();
	}

	function clientValidate(data) {
		var e = {};
		if (data.name.trim().length < 2) e.name = 'Please enter your full name.';
		if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(data.email.trim())) e.email = 'Please enter a valid email address.';
		var digits = data.phone.replace(/\D/g, '');
		if (digits.length < 9 || digits.length > 15) e.phone = 'Please enter a valid phone number.';
		if (data.address_line1.trim().length < 3) e.address_line1 = 'Please enter your street address.';
		if (data.city.trim().length < 2) e.city = 'Please enter your city or town.';
		if (!data.district) e.district = 'Please select your district.';
		if (data.postal_code && !/^\d{5}$/.test(data.postal_code.trim())) e.postal_code = 'Postal codes have 5 digits.';
		if (!cart.length) e.items = 'Your cart is empty.';
		return e;
	}

	if (coForm) {
		coForm.addEventListener('input', function (e) {
			var field = e.target.closest('.field.has-error');
			if (!field) return;
			field.classList.remove('has-error');
			var slot = field.querySelector('[data-error]');
			if (slot) slot.textContent = '';
		});
		coForm.addEventListener('submit', function (e) {
			e.preventDefault();
			var status = $('[data-checkout-status]', co);
			status.className = 'form-status'; status.textContent = '';
			var f = coForm.elements;
			var customer = {
				name: f.name.value, company: f.company.value, email: f.email.value, phone: f.phone.value,
				address_line1: f.address_line1.value, address_line2: f.address_line2.value, city: f.city.value,
				district: f.district.value, postal_code: f.postal_code.value, notes: f.notes.value
			};
			var errors = clientValidate(customer);
			showErrors(errors);
			if (Object.keys(errors).length) return;

			if (LSSL.demo) {
				status.textContent = 'This is a demo preview — orders are saved on the live website.';
				status.classList.add('ok');
				return;
			}

			var btn = $('[data-place-order]', co);
			var label = btn.innerHTML;
			btn.disabled = true; btn.textContent = 'Placing order…';
			fetch(LSSL.root + '/api/order', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				body: JSON.stringify({ customer: customer, items: cart, website: f.website.value })
			})
				.then(function (r) { return r.json().catch(function () { return { status: 'error' }; }); })
				.then(function (res) {
					if (res.status === 'success') {
						placed = true;
						cart = [];
						save();
						coForm.hidden = true;
						$('[data-checkout-empty]', co).hidden = true;
						$('[data-order-no]', co).textContent = res.order_no;
						$('[data-checkout-success]', co).hidden = false;
						window.scrollTo({ top: 0, behavior: 'smooth' });
					} else {
						showErrors(res.errors || {});
						status.textContent = res.message || 'Something went wrong. Please try again.';
						status.classList.add('err');
					}
				})
				.catch(function () {
					status.textContent = 'Could not reach the server. Please check your connection and try again.';
					status.classList.add('err');
				})
				.finally(function () { btn.disabled = false; btn.innerHTML = label; });
		});
	}

	// keep tabs in sync
	window.addEventListener('storage', function (e) { if (e.key === KEY) { cart = load(); render(); } });

	render();
})();
