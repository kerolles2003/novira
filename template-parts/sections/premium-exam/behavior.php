<?php
/**
 * Premium Exam — behaviour (shared component, Sprint 5.0).
 *
 * The scroll-progress bar, reveal-on-scroll, staggered sequences, count-up for
 * real numeric facts, and the stepper route draw. Identical logic to the inline
 * script in page-est.php, scoped to `.est-page`, so a premium spoke that uses
 * the `.est-page` wrapper gets the same choreography. Respects reduced-motion.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<script>
( function () {
	var page = document.querySelector( '.est-page' );
	if ( ! page ) { return; }
	var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	var bar = page.querySelector( '.est-progress' );
	if ( bar && ! reduce ) {
		var ticking = false;
		var update = function () {
			var doc = document.documentElement;
			var max = ( doc.scrollHeight - doc.clientHeight ) || 1;
			var p = Math.min( 1, Math.max( 0, ( window.scrollY || doc.scrollTop ) / max ) );
			bar.style.transform = 'scaleX(' + p + ')';
			ticking = false;
		};
		window.addEventListener( 'scroll', function () {
			if ( ! ticking ) { ticking = true; requestAnimationFrame( update ); }
		}, { passive: true } );
		update();
	}

	var countUp = function ( el ) {
		var target = parseFloat( el.getAttribute( 'data-count' ) );
		if ( isNaN( target ) ) { return; }
		if ( reduce ) { el.textContent = String( target ); return; }
		var dur = 1100, start = null;
		el.textContent = '0';
		var step = function ( ts ) {
			if ( ! start ) { start = ts; }
			var t = Math.min( 1, ( ts - start ) / dur );
			var eased = 1 - Math.pow( 1 - t, 3 );
			el.textContent = String( Math.round( target * eased ) );
			if ( t < 1 ) { requestAnimationFrame( step ); } else { el.textContent = String( target ); }
		};
		requestAnimationFrame( step );
	};

	var reveals = page.querySelectorAll( '.est-reveal' );
	var track = page.querySelector( '.est-steps__track' );

	if ( reduce || ! ( 'IntersectionObserver' in window ) ) {
		reveals.forEach( function ( el ) { el.classList.add( 'is-in' ); } );
		if ( track ) { track.classList.add( 'is-in' ); }
		page.querySelectorAll( '.est-stat__num[data-count]' ).forEach( function ( el ) {
			el.textContent = el.getAttribute( 'data-count' );
		} );
		return;
	}

	page.querySelectorAll( '.est-steps__track, .est-stats, .est-feats' ).forEach( function ( group ) {
		Array.prototype.forEach.call( group.children, function ( child, idx ) {
			if ( child.classList.contains( 'est-reveal' ) ) { child.dataset.i = idx; }
		} );
	} );

	var io = new IntersectionObserver( function ( entries ) {
		entries.forEach( function ( e ) {
			if ( ! e.isIntersecting ) { return; }
			var el = e.target;
			el.style.transitionDelay = ( Math.min( el.dataset.i || 0, 5 ) * 80 ) + 'ms';
			el.classList.add( 'is-in' );
			var num = el.querySelector ? el.querySelector( '.est-stat__num[data-count]' ) : null;
			if ( num ) { countUp( num ); }
			io.unobserve( el );
		} );
	}, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' } );
	reveals.forEach( function ( el ) { io.observe( el ); } );

	if ( track ) {
		var tio = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( e ) {
				if ( e.isIntersecting ) { track.classList.add( 'is-in' ); tio.unobserve( track ); }
			} );
		}, { threshold: 0.3 } );
		tio.observe( track );
	}
} )();
</script>
