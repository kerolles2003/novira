/**
 * Education & Skills Landing — behaviour.
 *
 * Scoped to page-education.php (the `.edu` root). Provides:
 *  - scroll-reveal (IntersectionObserver on [data-reveal])
 *  - stat count-up when the stats band enters view
 *  - courses carousel (prev/next, responsive slides-per-view, RTL-aware)
 *  - testimonials slider (dots) for the mobile one-card view
 *
 * All guards no-op gracefully if the markup is absent.
 *
 * @package Novira_Academy
 */
( function () {
	'use strict';

	var root = document.querySelector( '.edu' );
	if ( ! root ) {
		return;
	}

	var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	/* ---------- Scroll reveal ---------- */
	var reveals = root.querySelectorAll( '[data-reveal]' );
	if ( reveals.length ) {
		if ( ! ( 'IntersectionObserver' in window ) || reduceMotion ) {
			reveals.forEach( function ( el ) { el.classList.add( 'is-in' ); } );
		} else {
			var ro = new IntersectionObserver( function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						entry.target.classList.add( 'is-in' );
						ro.unobserve( entry.target );
					}
				} );
			}, { threshold: 0.14, rootMargin: '0px 0px -8% 0px' } );
			reveals.forEach( function ( el ) { ro.observe( el ); } );
		}
	}

	/* ---------- Stat count-up ---------- */
	var stats = root.querySelectorAll( '.edu-stat__n[data-count]' );
	if ( stats.length ) {
		var animateCount = function ( el ) {
			var target = parseInt( el.getAttribute( 'data-count' ), 10 ) || 0;
			var pre = el.getAttribute( 'data-pre' ) || '';
			var suf = el.getAttribute( 'data-suf' ) || '';
			if ( reduceMotion ) {
				el.textContent = pre + target + suf;
				return;
			}
			var start = null;
			var dur = 1500;
			var step = function ( ts ) {
				if ( start === null ) { start = ts; }
				var p = Math.min( ( ts - start ) / dur, 1 );
				var eased = 1 - Math.pow( 1 - p, 3 );
				el.textContent = pre + Math.round( target * eased ) + suf;
				if ( p < 1 ) { requestAnimationFrame( step ); }
			};
			requestAnimationFrame( step );
		};

		if ( ! ( 'IntersectionObserver' in window ) ) {
			stats.forEach( animateCount );
		} else {
			var band = root.querySelector( '.edu-stats' );
			var so = new IntersectionObserver( function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						stats.forEach( animateCount );
						so.disconnect();
					}
				} );
			}, { threshold: 0.3 } );
			if ( band ) { so.observe( band ); }
		}
	}

	/* ---------- Courses carousel ---------- */
	( function () {
		var carousel = root.querySelector( '.edu-carousel' );
		if ( ! carousel ) { return; }
		var track = carousel.querySelector( '.edu-carousel__track' );
		var slides = track ? track.children : [];
		var prev = carousel.querySelector( '.edu-carousel__nav--prev' );
		var next = carousel.querySelector( '.edu-carousel__nav--next' );
		if ( ! track || ! slides.length ) { return; }

		var index = 0;

		var perView = function () {
			var w = window.innerWidth;
			if ( w <= 620 ) { return 1; }
			if ( w <= 1020 ) { return 2; }
			return 3;
		};

		var maxIndex = function () {
			return Math.max( 0, slides.length - perView() );
		};

		var apply = function () {
			var pv = perView();
			if ( index > maxIndex() ) { index = maxIndex(); }
			var slideW = slides[ 0 ].getBoundingClientRect().width;
			var gap = parseFloat( getComputedStyle( track ).columnGap || getComputedStyle( track ).gap || 20 ) || 20;
			var shift = ( slideW + gap ) * index;
			// RTL: content flows right-to-left, so advancing moves the track right.
			track.style.transform = 'translateX(' + shift + 'px)';
			if ( prev ) { prev.disabled = index >= maxIndex(); prev.style.opacity = index >= maxIndex() ? '.4' : '1'; }
			if ( next ) { next.disabled = index <= 0; next.style.opacity = index <= 0 ? '.4' : '1'; }
		};

		// In this RTL layout the "prev" (right chevron) shows earlier items,
		// the "next" (left chevron) shows later items.
		if ( next ) {
			next.addEventListener( 'click', function () {
				if ( index < maxIndex() ) { index++; apply(); }
			} );
		}
		if ( prev ) {
			prev.addEventListener( 'click', function () {
				if ( index > 0 ) { index--; apply(); }
			} );
		}

		var rt;
		window.addEventListener( 'resize', function () {
			clearTimeout( rt );
			rt = setTimeout( apply, 150 );
		} );

		apply();
	}() );

	/* ---------- Testimonials slider (mobile dots) ---------- */
	( function () {
		var quotes = root.querySelectorAll( '.edu-quote' );
		var dots = root.querySelectorAll( '.edu-dot' );
		if ( ! quotes.length || ! dots.length ) { return; }

		var setActive = function ( i ) {
			quotes.forEach( function ( q, n ) { q.classList.toggle( 'is-active', n === i ); } );
			dots.forEach( function ( d, n ) { d.classList.toggle( 'is-active', n === i ); } );
		};

		dots.forEach( function ( dot, i ) {
			dot.addEventListener( 'click', function () { setActive( i ); } );
		} );

		// Ensure first card is shown in the mobile single-card view.
		setActive( 0 );
	}() );

}() );
