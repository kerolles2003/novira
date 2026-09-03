/**
 * About ("من نحن") Landing — behaviour.
 *
 * Scoped to page-about.php (the `.abt` root). Scroll-reveal only
 * (IntersectionObserver on [data-reveal]); no-ops gracefully if absent.
 *
 * @package Novira_Academy
 */
( function () {
	'use strict';

	var root = document.querySelector( '.abt' );
	if ( ! root ) {
		return;
	}

	/* ---- Video facade: swap thumbnail for the real iframe on click ---- */
	root.querySelectorAll( '.abt-card__play' ).forEach( function ( btn ) {
		btn.addEventListener( 'click', function () {
			var vid = btn.getAttribute( 'data-vid' );
			if ( ! vid ) { return; }
			var frame = document.createElement( 'iframe' );
			frame.className = 'abt-card__video';
			frame.src = 'https://www.youtube-nocookie.com/embed/' + encodeURIComponent( vid ) + '?rel=0&autoplay=1';
			frame.title = btn.getAttribute( 'aria-label' ) || '';
			frame.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
			frame.setAttribute( 'referrerpolicy', 'strict-origin-when-cross-origin' );
			frame.setAttribute( 'allowfullscreen', '' );
			btn.replaceWith( frame );
		} );
	} );

	var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var reveals = root.querySelectorAll( '[data-reveal]' );
	if ( ! reveals.length ) {
		return;
	}

	if ( ! ( 'IntersectionObserver' in window ) || reduce ) {
		reveals.forEach( function ( el ) { el.classList.add( 'is-in' ); } );
		return;
	}

	var io = new IntersectionObserver( function ( entries ) {
		entries.forEach( function ( entry ) {
			if ( entry.isIntersecting ) {
				entry.target.classList.add( 'is-in' );
				io.unobserve( entry.target );
			}
		} );
	}, { threshold: 0.14, rootMargin: '0px 0px -8% 0px' } );

	reveals.forEach( function ( el ) { io.observe( el ); } );
}() );
