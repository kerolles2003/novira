/**
 * Theme JS (global).
 *
 * Scroll-reveal for `.reveal` elements. Sticky-header behaviour, smooth
 * anchor scrolling, and mobile navigation all live in navigation.js — this
 * file intentionally does NOT duplicate them (a second, offset-unaware smooth
 * scroll and an inline nav-background hack previously fought navigation.js and
 * forced a light nav background onto the dark landing pages).
 */
document.addEventListener('DOMContentLoaded', function () {
	// Scroll reveal
	var reveals = document.querySelectorAll('.reveal');
	if (!reveals.length) {
		return;
	}

	var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	if (reduceMotion || !('IntersectionObserver' in window)) {
		reveals.forEach(function (el) { el.classList.add('visible'); });
		return;
	}

	var observer = new IntersectionObserver(function (entries) {
		entries.forEach(function (entry) {
			if (entry.isIntersecting) {
				entry.target.classList.add('visible');
				observer.unobserve(entry.target);
			}
		});
	}, { threshold: 0.1 });

	reveals.forEach(function (el) {
		observer.observe(el);
	});
});
