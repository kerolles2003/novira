/**
 * Premium Learning Article behaviours (single blog_post).
 *
 *   - Reading-progress bar (scroll position through the article body).
 *   - Table-of-contents active-section tracking + smooth anchor scrolling.
 *   - TOC stays open on desktop; collapses after a tap on mobile.
 *   - Accessible image lightbox (Esc / backdrop / close button).
 *
 * Vanilla, dependency-free, and defensive — every feature no-ops if its markup
 * is absent. Respects prefers-reduced-motion.
 *
 * @package Novira_Academy
 */
(function () {
	'use strict';

	var d = document;
	var root = d.querySelector('.nvblog-single');
	if (!root) { return; }

	var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	/* ---------------------------------------------------------------
	 * Reading progress + active TOC section
	 * ------------------------------------------------------------- */
	var bar = d.querySelector('.nvblog-progress__bar');
	var prose = d.querySelector('.nvblog-prose');
	var tocLinks = Array.prototype.slice.call(d.querySelectorAll('.nvblog-toc__list a'));

	var linkById = {};
	var headings = tocLinks.map(function (a) {
		var id = decodeURIComponent((a.getAttribute('href') || '').replace(/^#/, ''));
		linkById[id] = a;
		return d.getElementById(id);
	});

	var activeId = null;
	function setActive(id) {
		if (id === activeId) { return; }
		if (activeId && linkById[activeId]) {
			linkById[activeId].classList.remove('is-active');
			linkById[activeId].removeAttribute('aria-current');
		}
		activeId = id;
		if (id && linkById[id]) {
			linkById[id].classList.add('is-active');
			linkById[id].setAttribute('aria-current', 'true');
		}
	}

	var ticking = false;
	function measure() {
		ticking = false;

		if (bar && prose) {
			var rect = prose.getBoundingClientRect();
			var vh = window.innerHeight || d.documentElement.clientHeight;
			var scrollable = rect.height - vh;
			var ratio = scrollable <= 0 ? (rect.top <= 0 ? 1 : 0) : (-rect.top) / scrollable;
			ratio = Math.max(0, Math.min(1, ratio));
			bar.style.transform = 'scaleX(' + ratio + ')';
		}

		if (headings.length) {
			var trigger = 130;
			var current = null;
			for (var i = 0; i < headings.length; i++) {
				var h = headings[i];
				if (!h) { continue; }
				if (h.getBoundingClientRect().top <= trigger) { current = h.id; }
				else { break; }
			}
			setActive(current);
		}
	}
	function onScroll() {
		if (!ticking) { ticking = true; window.requestAnimationFrame(measure); }
	}
	window.addEventListener('scroll', onScroll, { passive: true });
	window.addEventListener('resize', onScroll);
	measure();

	/* ---------------------------------------------------------------
	 * TOC: keep open on desktop, smooth-scroll, collapse on mobile
	 * ------------------------------------------------------------- */
	var toc = d.querySelector('.nvblog-toc');
	var desktop = window.matchMedia('(min-width: 1080px)');
	function syncTocOpen() { if (toc && desktop.matches) { toc.open = true; } }
	syncTocOpen();
	if (desktop.addEventListener) { desktop.addEventListener('change', syncTocOpen); }

	tocLinks.forEach(function (a) {
		a.addEventListener('click', function (e) {
			var id = decodeURIComponent((a.getAttribute('href') || '').replace(/^#/, ''));
			var target = d.getElementById(id);
			if (!target) { return; }
			e.preventDefault();
			if (history.pushState) { history.pushState(null, '', '#' + id); }
			target.scrollIntoView({ behavior: reduce ? 'auto' : 'smooth', block: 'start' });
			target.focus({ preventScroll: true });
			if (toc && !desktop.matches) { toc.open = false; }
		});
	});

	/* ---------------------------------------------------------------
	 * Image lightbox
	 * ------------------------------------------------------------- */
	var box = null, boxImg = null, boxCap = null, lastFocused = null;

	function buildBox() {
		box = d.createElement('div');
		box.className = 'nvblog-lightbox';
		box.setAttribute('role', 'dialog');
		box.setAttribute('aria-modal', 'true');
		box.setAttribute('aria-label', 'عرض الصورة');
		box.innerHTML =
			'<button type="button" class="nvblog-lightbox__close" aria-label="إغلاق">' +
			'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M18 6 6 18M6 6l12 12"/></svg></button>' +
			'<img class="nvblog-lightbox__img" alt=""><p class="nvblog-lightbox__cap"></p>';
		boxImg = box.querySelector('.nvblog-lightbox__img');
		boxCap = box.querySelector('.nvblog-lightbox__cap');
		var closeBtn = box.querySelector('.nvblog-lightbox__close');
		closeBtn.addEventListener('click', closeBox);
		box.addEventListener('click', function (e) { if (e.target === box) { closeBox(); } });
		box.addEventListener('keydown', function (e) {
			if (e.key === 'Escape') { closeBox(); }
			else if (e.key === 'Tab') { e.preventDefault(); closeBtn.focus(); } // simple trap: one control
		});
		d.body.appendChild(box);
	}

	function openBox(img) {
		if (!box) { buildBox(); }
		lastFocused = d.activeElement;
		boxImg.src = img.getAttribute('data-full') || img.currentSrc || img.src;
		boxImg.alt = img.alt || '';
		var fig = img.closest('figure');
		var cap = fig ? fig.querySelector('figcaption') : null;
		boxCap.textContent = cap ? cap.textContent : '';
		boxCap.style.display = cap ? '' : 'none';
		d.documentElement.style.overflow = 'hidden';
		box.classList.add('is-open');
		box.querySelector('.nvblog-lightbox__close').focus();
	}

	function closeBox() {
		if (!box) { return; }
		box.classList.remove('is-open');
		d.documentElement.style.overflow = '';
		if (lastFocused && lastFocused.focus) { lastFocused.focus(); }
	}

	if (prose) {
		Array.prototype.forEach.call(prose.querySelectorAll('img'), function (img) {
			if (img.closest('a')) { return; } // keep linked images as links
			img.classList.add('nvblog-zoomable');
			img.setAttribute('tabindex', '0');
			img.setAttribute('role', 'button');
			img.addEventListener('click', function () { openBox(img); });
			img.addEventListener('keydown', function (e) {
				if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openBox(img); }
			});
		});
	}

	/* ---------------------------------------------------------------
	 * Localised strings (from the wrapper's data-i18n)
	 * ------------------------------------------------------------- */
	var i18n = {};
	try { i18n = JSON.parse(root.getAttribute('data-i18n') || '{}'); } catch (e) { i18n = {}; }
	function t(key) { return i18n[key] || ''; }

	/* ---------------------------------------------------------------
	 * Estimated finish time (visitor-local clock)
	 * ------------------------------------------------------------- */
	var finishEl = d.querySelector('.nvblog-artmeta__finish');
	var readMin = parseInt(root.getAttribute('data-reading-min'), 10) || 0;
	if (finishEl && readMin > 0) {
		try {
			var end = new Date(Date.now() + readMin * 60000);
			var locale = d.documentElement.lang || 'ar';
			var timeStr = end.toLocaleTimeString(locale, { hour: 'numeric', minute: '2-digit' });
			finishEl.textContent = (t('finish') || 'تنتهي نحو %s').replace('%s', timeStr);
			finishEl.hidden = false;
		} catch (e) { /* keep hidden */ }
	}

	/* ---------------------------------------------------------------
	 * Remember reading position + offer to resume
	 * ------------------------------------------------------------- */
	var storeKey = 'nvblog:pos:' + location.pathname;

	function currentRatio() {
		if (!prose) { return 0; }
		var r = prose.getBoundingClientRect();
		var vh = window.innerHeight || d.documentElement.clientHeight;
		var s = r.height - vh;
		if (s <= 0) { return r.top <= 0 ? 1 : 0; }
		return Math.max(0, Math.min(1, (-r.top) / s));
	}

	var lastSave = 0;
	window.addEventListener('scroll', function () {
		var now = Date.now();
		if (now - lastSave < 1000) { return; }
		lastSave = now;
		try {
			var ratio = currentRatio();
			if (ratio > 0.02 && ratio < 0.97) { localStorage.setItem(storeKey, ratio.toFixed(4)); }
			else { localStorage.removeItem(storeKey); }
		} catch (e) { /* storage unavailable */ }
	}, { passive: true });

	function targetForRatio(ratio) {
		var r = prose.getBoundingClientRect();
		var top = window.pageYOffset + r.top;
		var s = Math.max(0, prose.offsetHeight - (window.innerHeight || 0));
		return top + s * ratio;
	}

	(function initResume() {
		if (!prose) { return; }
		var saved = null;
		try { saved = parseFloat(localStorage.getItem(storeKey)); } catch (e) { return; }
		if (!saved || saved <= 0.03 || saved >= 0.97 || window.pageYOffset > 40) { return; }

		var el = d.createElement('div');
		el.className = 'nvblog-resume';
		el.innerHTML =
			'<div class="nvblog-resume__inner">' +
			'<span class="nvblog-resume__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 3h12v18l-6-4-6 4z"/></svg></span>' +
			'<span class="nvblog-resume__text"></span>' +
			'<button type="button" class="nvblog-resume__go"></button>' +
			'<button type="button" class="nvblog-resume__close"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M18 6 6 18M6 6l12 12"/></svg></button>' +
			'</div>';
		el.querySelector('.nvblog-resume__text').textContent = t('resume') || 'أكمل القراءة من حيث توقفت';
		var go = el.querySelector('.nvblog-resume__go');
		go.textContent = t('resumeBtn') || 'متابعة القراءة';
		var closeBtn = el.querySelector('.nvblog-resume__close');
		closeBtn.setAttribute('aria-label', t('dismiss') || 'إغلاق');
		d.body.appendChild(el);
		window.requestAnimationFrame(function () { el.classList.add('is-open'); });

		var gone = false;
		function hide() {
			if (gone) { return; }
			gone = true;
			el.classList.remove('is-open');
			setTimeout(function () { if (el.parentNode) { el.parentNode.removeChild(el); } }, 450);
		}
		go.addEventListener('click', function () {
			window.scrollTo({ top: targetForRatio(saved), behavior: reduce ? 'auto' : 'smooth' });
			hide();
		});
		closeBtn.addEventListener('click', hide);
		var auto = setTimeout(hide, 9000);
		window.addEventListener('scroll', function onFirst() {
			if (window.pageYOffset > 90) { clearTimeout(auto); hide(); window.removeEventListener('scroll', onFirst); }
		}, { passive: true });
	})();

	/* ---------------------------------------------------------------
	 * Copy-link control on every h2 / h3
	 * ------------------------------------------------------------- */
	function copyText(text) {
		if (navigator.clipboard && navigator.clipboard.writeText) { return navigator.clipboard.writeText(text); }
		return new Promise(function (resolve) {
			var ta = d.createElement('textarea');
			ta.value = text; ta.setAttribute('readonly', '');
			ta.style.position = 'fixed'; ta.style.opacity = '0';
			d.body.appendChild(ta); ta.select();
			try { d.execCommand('copy'); } catch (e) { /* noop */ }
			d.body.removeChild(ta); resolve();
		});
	}

	if (prose) {
		var linkSvg = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9.5 14.5l5-5"/><path d="M11.5 6.5l1.2-1.2a3.6 3.6 0 0 1 5 5l-2.2 2.2"/><path d="M12.5 17.5l-1.2 1.2a3.6 3.6 0 0 1-5-5l2.2-2.2"/></svg>';
		Array.prototype.forEach.call(prose.querySelectorAll('h2[id], h3[id]'), function (h) {
			var btn = d.createElement('button');
			btn.type = 'button';
			btn.className = 'nvblog-anchor';
			btn.setAttribute('aria-label', t('copy') || 'نسخ رابط هذا القسم');
			btn.innerHTML = linkSvg + '<span class="nvblog-anchor__toast">' + (t('copied') || 'تم نسخ الرابط') + '</span>';
			btn.addEventListener('click', function () {
				copyText(location.origin + location.pathname + '#' + h.id).then(function () {
					if (history.replaceState) { history.replaceState(null, '', '#' + h.id); }
					btn.classList.add('is-copied');
					setTimeout(function () { btn.classList.remove('is-copied'); }, 1600);
				});
			});
			h.appendChild(btn);
		});
	}

	/* ---------------------------------------------------------------
	 * Reading-completion reveal — a lightweight celebration when the
	 * learning-journey footer scrolls into view (never a popup / interrupt)
	 * ------------------------------------------------------------- */
	var complete = d.querySelector('.nvblog-complete[data-complete]');
	if (complete) {
		if ('IntersectionObserver' in window) {
			var io = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) { complete.classList.add('is-in'); io.disconnect(); }
				});
			}, { threshold: 0.4 });
			io.observe(complete);
		} else {
			complete.classList.add('is-in');
		}
	}
})();
