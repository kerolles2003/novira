/**
 * Exams ("امتحانات نوفيرا") Landing — behaviour.
 *
 * Scoped to page-exams.php (the `.exl` root):
 *   1. Scroll-reveal (IntersectionObserver on [data-reveal]).
 *   2. Subtle pointer-parallax on the hero floating chips.
 * Both no-op gracefully when unsupported or reduced motion is preferred.
 *
 * @package Novira_Academy
 */
( function () {
	'use strict';

	var root = document.querySelector( '.exl' );
	if ( ! root ) { return; }

	var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	/* ---- 1. Scroll reveal ---- */
	var reveals = root.querySelectorAll( '[data-reveal]' );
	if ( reveals.length ) {
		if ( ! ( 'IntersectionObserver' in window ) || reduce ) {
			reveals.forEach( function ( el ) { el.classList.add( 'is-in' ); } );
		} else {
			var io = new IntersectionObserver( function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						entry.target.classList.add( 'is-in' );
						io.unobserve( entry.target );
					}
				} );
			}, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' } );
			reveals.forEach( function ( el ) { io.observe( el ); } );
		}
	}

	/* ---- 2. Hero pointer-parallax on the floating chips ---- */
	var stage = root.querySelector( '.exl-hero__stage' );
	if ( ! stage || reduce ) { return; }
	var chips = stage.querySelectorAll( '.exl-chip' );
	if ( ! chips.length ) { return; }

	var ticking = false, mx = 0, my = 0;
	function apply() {
		// `translate` composes with the `exl-bob` keyframe on `transform`.
		chips.forEach( function ( el, i ) {
			var depth = ( i + 1 ) * 7;
			el.style.translate = ( mx * depth ).toFixed( 1 ) + 'px ' + ( my * depth ).toFixed( 1 ) + 'px';
		} );
		ticking = false;
	}
	stage.addEventListener( 'mousemove', function ( e ) {
		var r = stage.getBoundingClientRect();
		mx = ( e.clientX - r.left ) / r.width - 0.5;
		my = ( e.clientY - r.top ) / r.height - 0.5;
		if ( ! ticking ) { ticking = true; window.requestAnimationFrame( apply ); }
	} );
	stage.addEventListener( 'mouseleave', function () {
		chips.forEach( function ( el ) { el.style.translate = ''; } );
	} );
}() );
