(function () {
	'use strict';

	var doc = document.documentElement;
	var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
	var hasGsap = typeof window.gsap !== 'undefined' && typeof window.ScrollTrigger !== 'undefined';
	var $ = function (s, c) { return (c || document).querySelector(s); };
	var $$ = function (s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); };

	function store(key, value) {
		try {
			if (value === undefined) return localStorage.getItem(key);
			localStorage.setItem(key, value);
		} catch (e) { return null; }
	}

	/* ---------- theme ---------- */
	$$('.theme-toggle').forEach(function (btn) {
		btn.addEventListener('click', function () {
			var next = doc.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
			doc.setAttribute('data-theme', next);
			store('lssl-theme', next);
			var meta = $('meta[name="theme-color"]');
			if (meta) meta.setAttribute('content', next === 'light' ? '#f8f5ee' : '#0b0a08');
		});
	});

	/* ---------- header / dropdowns / mobile ---------- */
	var header = $('.site-header');
	var progress = $('.progress span');
	var toTop = $('.to-top');
	var lastY = 0;

	function onScroll(y) {
		if (header) {
			header.classList.toggle('is-scrolled', y > 40);
			var menuOpen = $('.has-drop.open');
			header.classList.toggle('is-hidden', y > 400 && y > lastY + 4 && !menuOpen);
			if (y < lastY - 4) header.classList.remove('is-hidden');
		}
		if (toTop) toTop.classList.toggle('show', y > 900);
		if (progress) {
			var max = document.documentElement.scrollHeight - window.innerHeight;
			progress.style.transform = 'scaleX(' + (max > 0 ? Math.min(y / max, 1) : 0) + ')';
		}
		lastY = y;
	}

	var drops = $$('.has-drop');
	function closeDrops(except) {
		drops.forEach(function (d) {
			if (d !== except) {
				d.classList.remove('open');
				var b = $('button', d); if (b) b.setAttribute('aria-expanded', 'false');
			}
		});
	}
	drops.forEach(function (d) {
		var btn = $('button', d);
		var timer;
		btn.addEventListener('click', function (ev) {
			ev.stopPropagation();
			var open = !d.classList.contains('open');
			closeDrops(d);
			d.classList.toggle('open', open);
			btn.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
		if (finePointer) {
			d.addEventListener('mouseenter', function () { clearTimeout(timer); closeDrops(d); d.classList.add('open'); btn.setAttribute('aria-expanded', 'true'); });
			d.addEventListener('mouseleave', function () { timer = setTimeout(function () { d.classList.remove('open'); btn.setAttribute('aria-expanded', 'false'); }, 180); });
		}
	});
	document.addEventListener('click', function (ev) { if (!ev.target.closest('.has-drop')) closeDrops(); });
	document.addEventListener('keydown', function (ev) { if (ev.key === 'Escape') { closeDrops(); closeMobile(); } });

	var mobile = $('.mobile-menu');
	var burger = $('.burger');
	function openMobile() {
		mobile.classList.add('open'); mobile.setAttribute('aria-hidden', 'false');
		burger.setAttribute('aria-expanded', 'true'); document.body.style.overflow = 'hidden';
		if (lenis) lenis.stop();
	}
	function closeMobile() {
		if (!mobile || !mobile.classList.contains('open')) return;
		mobile.classList.remove('open'); mobile.setAttribute('aria-hidden', 'true');
		burger.setAttribute('aria-expanded', 'false'); document.body.style.overflow = '';
		if (lenis) lenis.start();
	}
	if (burger) burger.addEventListener('click', openMobile);
	var mClose = $('.mobile-close');
	if (mClose) mClose.addEventListener('click', closeMobile);

	/* ---------- smooth scroll ---------- */
	var lenis = null;
	if (!reduceMotion && typeof window.Lenis !== 'undefined') {
		lenis = new window.Lenis({ duration: 1.15, easing: function (t) { return Math.min(1, 1.001 - Math.pow(2, -10 * t)); }, smoothWheel: true });
		lenis.on('scroll', function (e) { onScroll(e.scroll); if (hasGsap) window.ScrollTrigger.update(); });
		if (hasGsap) {
			window.gsap.ticker.add(function (time) { lenis.raf(time * 1000); });
			window.gsap.ticker.lagSmoothing(0);
		} else {
			(function raf(t) { lenis.raf(t); requestAnimationFrame(raf); })(0);
		}
	} else {
		window.addEventListener('scroll', function () { onScroll(window.scrollY); }, { passive: true });
	}
	onScroll(window.scrollY);

	if (toTop) toTop.addEventListener('click', function () {
		if (lenis) lenis.scrollTo(0, { duration: 1.6 }); else window.scrollTo({ top: 0, behavior: 'smooth' });
	});
	$$('a[href^="#"]').forEach(function (a) {
		a.addEventListener('click', function (ev) {
			var id = a.getAttribute('href');
			if (id.length < 2) return;
			var target = $(id);
			if (!target) return;
			ev.preventDefault();
			if (lenis) lenis.scrollTo(target, { offset: -90 }); else target.scrollIntoView({ behavior: 'smooth' });
		});
	});

	/* ---------- split headings ---------- */
	function splitWords(el) {
		if (el.dataset.splitDone) return;
		el.dataset.splitDone = '1';
		var walk = function (node, out) {
			node.childNodes.forEach(function (child) {
				if (child.nodeType === 3) {
					child.textContent.split(/(\s+)/).forEach(function (part) {
						if (!part) return;
						if (/^\s+$/.test(part)) { out.appendChild(document.createTextNode(' ')); return; }
						var wrap = document.createElement('span'); wrap.className = 'split-line';
						var inner = document.createElement('span'); inner.textContent = part;
						wrap.appendChild(inner); out.appendChild(wrap);
					});
				} else if (child.nodeName === 'BR') {
					out.appendChild(document.createElement('br'));
				} else {
					// nested element (e.g. <span class="gold">): split its words, keeping the element around each word
					child.textContent.split(/(\s+)/).forEach(function (part) {
						if (!part) return;
						if (/^\s+$/.test(part)) { out.appendChild(document.createTextNode(' ')); return; }
						var wrap = document.createElement('span'); wrap.className = 'split-line';
						var inner = child.cloneNode(false); inner.textContent = part;
						wrap.appendChild(inner); out.appendChild(wrap);
					});
				}
			});
		};
		var frag = document.createDocumentFragment();
		walk(el, frag);
		el.innerHTML = '';
		el.appendChild(frag);
	}

	/* ---------- animations ---------- */
	function reveal() {
		if (!hasGsap || reduceMotion) {
			doc.classList.remove('js');
			return;
		}
		var gsap = window.gsap;
		gsap.registerPlugin(window.ScrollTrigger);
		gsap.defaults({ ease: 'power3.out' });

		// headings split into words
		$$('[data-split]').forEach(function (el) {
			splitWords(el);
			var words = $$('.split-line > span', el);
			var inHero = el.closest('.hero, .page-hero, .pd-hero');
			gsap.fromTo(words, { yPercent: 110 }, {
				yPercent: 0, duration: 1.1, stagger: 0.06, ease: 'expo.out',
				delay: inHero ? 0.15 : 0,
				scrollTrigger: inHero ? null : { trigger: el, start: 'top 88%' }
			});
		});

		// single reveals
		window.ScrollTrigger.batch('[data-reveal]', {
			start: 'top 90%',
			onEnter: function (els) { gsap.to(els, { opacity: 1, y: 0, duration: 1, stagger: 0.1, overwrite: true }); }
		});

		// stagger groups
		$$('[data-stagger]').forEach(function (group) {
			gsap.to(group.children, {
				opacity: 1, y: 0, duration: 0.9, stagger: 0.08,
				scrollTrigger: { trigger: group, start: 'top 86%' }
			});
		});

		// parallax media
		$$('[data-parallax]').forEach(function (img) {
			gsap.fromTo(img, { yPercent: -6 }, {
				yPercent: 6, ease: 'none',
				scrollTrigger: { trigger: img.parentElement, start: 'top bottom', end: 'bottom top', scrub: true }
			});
		});

		// hero ken-burns + fade on scroll
		var heroImg = $('.hero-media img');
		if (heroImg) {
			gsap.fromTo(heroImg, { scale: 1.18 }, { scale: 1.02, duration: 2.6, ease: 'power2.out' });
			gsap.to('.hero-inner', {
				yPercent: -12, opacity: 0.2, ease: 'none',
				scrollTrigger: { trigger: '.hero', start: 'top top', end: 'bottom top', scrub: true }
			});
		}

		// timeline progress line
		var fill = $('.timeline-fill');
		if (fill) {
			gsap.to(fill, { scaleY: 1, ease: 'none', scrollTrigger: { trigger: '.timeline', start: 'top 70%', end: 'bottom 60%', scrub: true } });
		}

		// counters
		$$('[data-count]').forEach(function (el) {
			var end = parseFloat(el.getAttribute('data-count'));
			var suffix = el.getAttribute('data-suffix') || '';
			var fmt = function (v) { return Math.round(v).toLocaleString('en-US') + suffix; };
			var o = { v: 0 };
			el.textContent = fmt(0);
			gsap.to(o, {
				v: end, duration: 2.2, ease: 'power2.out',
				scrollTrigger: { trigger: el, start: 'top 92%', once: true },
				onUpdate: function () { el.textContent = fmt(o.v); }
			});
		});

		// floating mascot / product
		$$('[data-float]').forEach(function (el, i) {
			gsap.to(el, { y: -14, rotation: i % 2 ? -1.5 : 1.5, duration: 3.2, ease: 'sine.inOut', yoyo: true, repeat: -1 });
		});

		// product visual scrub
		var pdImg = $('.pd-visual img.main');
		if (pdImg) {
			gsap.from(pdImg, { y: 40, opacity: 0, scale: 0.94, duration: 1.4, ease: 'expo.out', delay: 0.2 });
		}

		window.addEventListener('load', function () { window.ScrollTrigger.refresh(); });
	}

	/* ---------- preloader (first visit per session) ---------- */
	var pre = $('.preloader');
	function startPage() { reveal(); }
	if (pre) {
		var seen = null;
		try { seen = sessionStorage.getItem('lssl-intro'); } catch (e) {}
		if (seen || !hasGsap || reduceMotion) {
			pre.remove(); startPage();
		} else {
			try { sessionStorage.setItem('lssl-intro', '1'); } catch (e) {}
			if (lenis) lenis.stop();
			var tl = window.gsap.timeline({
				onComplete: function () { pre.remove(); if (lenis) lenis.start(); }
			});
			tl.to('.preloader img', { opacity: 1, y: 0, scale: 1, duration: 0.8, ease: 'expo.out' })
				.to('.preloader p', { opacity: 1, duration: 0.5 }, '-=0.4')
				.to('.preloader-bar span', { scaleX: 1, duration: 0.9, ease: 'power2.inOut' }, '-=0.5')
				.to('.preloader-inner', { opacity: 0, y: -20, duration: 0.45, ease: 'power2.in' })
				.to(pre, { clipPath: 'inset(0 0 100% 0)', duration: 0.9, ease: 'expo.inOut' }, '-=0.1')
				.add(startPage, '-=0.7');
			pre.style.clipPath = 'inset(0 0 0% 0)';
		}
	} else {
		startPage();
	}

	/* ---------- tilt on product cards ---------- */
	if (finePointer && !reduceMotion) {
		$$('[data-tilt]').forEach(function (card) {
			card.addEventListener('mousemove', function (e) {
				var r = card.getBoundingClientRect();
				var x = (e.clientX - r.left) / r.width - 0.5;
				var y = (e.clientY - r.top) / r.height - 0.5;
				card.style.transform = 'perspective(900px) rotateX(' + (-y * 6) + 'deg) rotateY(' + (x * 6) + 'deg) translateY(-4px)';
			});
			card.addEventListener('mouseleave', function () { card.style.transform = ''; });
		});
	}

	/* ---------- lightbox ---------- */
	if (typeof window.GLightbox !== 'undefined') {
		window.lsslLightbox = window.GLightbox({ selector: '.glightbox', touchNavigation: true, loop: true, openEffect: 'zoom', closeEffect: 'fade' });
	}

	/* ---------- gallery filter ---------- */
	var filters = $$('.filter');
	if (filters.length) {
		filters.forEach(function (f) {
			f.addEventListener('click', function () {
				filters.forEach(function (x) { x.classList.remove('is-on'); x.setAttribute('aria-pressed', 'false'); });
				f.classList.add('is-on'); f.setAttribute('aria-pressed', 'true');
				var cat = f.getAttribute('data-filter');
				var items = $$('.m-item');
				items.forEach(function (it) {
					var show = cat === 'all' || it.getAttribute('data-cat') === cat;
					it.classList.toggle('is-hidden', !show);
					it.classList.toggle('glightbox', show);
				});
				if (hasGsap && !reduceMotion) {
					window.gsap.fromTo(items.filter(function (i) { return !i.classList.contains('is-hidden'); }), { opacity: 0, y: 24 }, { opacity: 1, y: 0, duration: 0.6, stagger: 0.03 });
					window.ScrollTrigger.refresh();
				}
				if (window.lsslLightbox) window.lsslLightbox.reload();
			});
		});
	}

	/* ---------- forms ---------- */
	var productSelect = $('#f-product');
	if (productSelect) {
		var wanted = new URLSearchParams(location.search).get('product');
		var opt = wanted && $('option[data-slug="' + wanted.replace(/[^a-z0-9-]/g, '') + '"]', productSelect);
		if (opt) opt.selected = true;
	}
	$$('form[data-endpoint]').forEach(function (form) {
		var status = $('.form-status', form);
		var btn = $('button[type="submit"]', form);
		form.addEventListener('submit', function (ev) {
			ev.preventDefault();
			status.className = 'form-status';
			if (!form.checkValidity()) {
				form.reportValidity();
				return;
			}
			var file = $('input[type="file"]', form);
			if (file && file.files[0] && file.files[0].size > 3 * 1024 * 1024) {
				status.textContent = 'Please attach a CV smaller than 3 MB.';
				status.classList.add('err');
				return;
			}
			if (window.LSSL.demo) {
				status.textContent = 'This is a demo preview — form sending is enabled on the live website.';
				status.classList.add('ok');
				return;
			}
			var label = btn.innerHTML;
			btn.disabled = true;
			btn.textContent = 'Sending…';
			fetch(window.LSSL.root + '/' + form.getAttribute('data-endpoint'), { method: 'POST', body: new FormData(form) })
				.then(function (r) { return r.json(); })
				.then(function (res) {
					if (res && res.status === 'success') {
						status.textContent = form.getAttribute('data-success') || 'Thank you — your message has been sent. Our team will contact you shortly.';
						status.classList.add('ok');
						form.reset();
					} else {
						throw new Error((res && res.message) || 'failed');
					}
				})
				.catch(function () {
					status.textContent = 'Sorry, we could not send your message. Please call us or email sales@lankassl.com.';
					status.classList.add('err');
				})
				.finally(function () { btn.disabled = false; btn.innerHTML = label; });
		});
	});
})();
