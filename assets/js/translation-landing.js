/**
 * Certified Translation Landing — behaviour.
 *
 * Scroll reveal, stat count-up, sticky header, mobile menu, FAQ accordion,
 * and the testimonials carousel. All effects respect prefers-reduced-motion.
 *
 * @package Novira_Academy
 */
( function () {
	'use strict';

	var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	function ready( fn ) {
		if ( document.readyState !== 'loading' ) { fn(); }
		else { document.addEventListener( 'DOMContentLoaded', fn ); }
	}

	ready( function () {

		/* ---------- Scroll reveal ---------- */
		var reveals = [].slice.call( document.querySelectorAll( '[data-reveal]' ) );
		if ( reduce || ! ( 'IntersectionObserver' in window ) ) {
			reveals.forEach( function ( el ) { el.classList.add( 'is-visible' ); } );
		} else {
			var io = new IntersectionObserver( function ( entries ) {
				entries.forEach( function ( e ) {
					if ( e.isIntersecting ) {
						e.target.classList.add( 'is-visible' );
						io.unobserve( e.target );
					}
				} );
			}, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' } );
			reveals.forEach( function ( el ) { io.observe( el ); } );
		}

		/* ---------- Stat count-up ---------- */
		var counters = [].slice.call( document.querySelectorAll( '.tl-stat__v[data-count]' ) );
		function runCount( el ) {
			var target = parseInt( el.getAttribute( 'data-count' ), 10 ) || 0;
			var pre = el.getAttribute( 'data-pre' ) || '';
			var suf = el.getAttribute( 'data-suf' ) || '';
			if ( reduce ) { el.textContent = pre + target + suf; return; }
			var start = null, dur = 1400;
			function step( ts ) {
				if ( ! start ) { start = ts; }
				var p = Math.min( ( ts - start ) / dur, 1 );
				var eased = 1 - Math.pow( 1 - p, 3 );
				el.textContent = pre + Math.floor( eased * target ) + suf;
				if ( p < 1 ) { requestAnimationFrame( step ); }
			}
			requestAnimationFrame( step );
		}
		if ( counters.length ) {
			if ( ! ( 'IntersectionObserver' in window ) ) {
				counters.forEach( runCount );
			} else {
				var cio = new IntersectionObserver( function ( entries ) {
					entries.forEach( function ( e ) {
						if ( e.isIntersecting ) { runCount( e.target ); cio.unobserve( e.target ); }
					} );
				}, { threshold: 0.6 } );
				counters.forEach( function ( el ) { cio.observe( el ); } );
			}
		}

		/* ---------- Sticky header ---------- */
		var header = document.getElementById( 'tl-header' );
		if ( header ) {
			var onScroll = function () {
				header.classList.toggle( 'is-scrolled', window.scrollY > 20 );
			};
			onScroll();
			window.addEventListener( 'scroll', onScroll, { passive: true } );
		}

		/* ---------- Mobile menu ---------- */
		var burger = document.getElementById( 'tl-burger' );
		var panel = document.getElementById( 'tl-mobile' );
		var backdrop = document.getElementById( 'tl-mobile-backdrop' );
		var closeBtn = document.getElementById( 'tl-mobile-close' );
		function setMenu( open ) {
			if ( ! panel ) { return; }
			panel.classList.toggle( 'is-open', open );
			if ( backdrop ) { backdrop.classList.toggle( 'is-open', open ); }
			panel.setAttribute( 'aria-hidden', open ? 'false' : 'true' );
			if ( burger ) { burger.setAttribute( 'aria-expanded', open ? 'true' : 'false' ); }
			document.body.style.overflow = open ? 'hidden' : '';
		}
		if ( burger ) { burger.addEventListener( 'click', function () { setMenu( true ); } ); }
		if ( closeBtn ) { closeBtn.addEventListener( 'click', function () { setMenu( false ); } ); }
		if ( backdrop ) { backdrop.addEventListener( 'click', function () { setMenu( false ); } ); }
		if ( panel ) {
			panel.querySelectorAll( 'a' ).forEach( function ( a ) {
				a.addEventListener( 'click', function () { setMenu( false ); } );
			} );
		}
		document.addEventListener( 'keydown', function ( e ) {
			if ( e.key === 'Escape' ) { setMenu( false ); }
		} );

		/* ---------- FAQ accordion ---------- */
		[].slice.call( document.querySelectorAll( '.tl-acc' ) ).forEach( function ( acc ) {
			var btn = acc.querySelector( '.tl-acc__q' );
			var body = acc.querySelector( '.tl-acc__a' );
			if ( ! btn || ! body ) { return; }
			if ( acc.classList.contains( 'is-open' ) ) { body.style.maxHeight = body.scrollHeight + 'px'; }
			btn.addEventListener( 'click', function () {
				var open = acc.classList.toggle( 'is-open' );
				btn.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
				body.style.maxHeight = open ? body.scrollHeight + 'px' : 0;
			} );
		} );
		window.addEventListener( 'resize', function () {
			[].slice.call( document.querySelectorAll( '.tl-acc.is-open .tl-acc__a' ) ).forEach( function ( b ) {
				b.style.maxHeight = b.scrollHeight + 'px';
			} );
		} );

		/* ---------- Testimonials carousel (mobile) ---------- */
		var track = document.getElementById( 'tl-testi-track' );
		var dotsWrap = document.getElementById( 'tl-testi-dots' );
		if ( track && dotsWrap ) {
			var dots = [].slice.call( dotsWrap.querySelectorAll( 'button' ) );
			var cards = [].slice.call( track.children );
			var isSlider = function () { return window.matchMedia( '(max-width: 900px)' ).matches; };

			dots.forEach( function ( dot, i ) {
				dot.addEventListener( 'click', function () {
					if ( isSlider() && cards[ i ] ) {
						cards[ i ].scrollIntoView( { behavior: reduce ? 'auto' : 'smooth', inline: 'center', block: 'nearest' } );
					}
					dots.forEach( function ( d ) { d.classList.remove( 'is-active' ); } );
					dot.classList.add( 'is-active' );
				} );
			} );

			track.addEventListener( 'scroll', function () {
				if ( ! isSlider() ) { return; }
				var mid = track.scrollLeft + track.clientWidth / 2;
				var best = 0, bestDist = Infinity;
				cards.forEach( function ( c, i ) {
					var center = c.offsetLeft + c.clientWidth / 2;
					var dist = Math.abs( center - mid );
					if ( dist < bestDist ) { bestDist = dist; best = i; }
				} );
				dots.forEach( function ( d, i ) { d.classList.toggle( 'is-active', i === best ); } );
			}, { passive: true } );
		}
	} );
} )();
