/**
 * Courses Register — behaviour.
 *
 * Scoped to page-courses.php (the `.crs` root). Provides:
 *  - scroll reveal (IntersectionObserver on [data-reveal])
 *  - the index: filter the register by field of study, announced politely
 *
 * Progressive enhancement throughout. Without JS every field stays visible, so
 * the register is fully readable and crawlable; all guards no-op if the markup
 * is absent.
 *
 * @package Novira_Academy
 */
( function () {
	'use strict';

	var root = document.querySelector( '.crs' );
	if ( ! root ) {
		return;
	}

	var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	/* ---------- Scroll reveal ---------- */
	var reveals = root.querySelectorAll( '[data-reveal]' );
	if ( reveals.length ) {
		if ( ! ( 'IntersectionObserver' in window ) || reduceMotion ) {
			Array.prototype.forEach.call( reveals, function ( el ) { el.classList.add( 'is-in' ); } );
		} else {
			var ro = new IntersectionObserver( function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						entry.target.classList.add( 'is-in' );
						ro.unobserve( entry.target );
					}
				} );
			}, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' } );
			Array.prototype.forEach.call( reveals, function ( el ) { ro.observe( el ); } );
		}
	}

	/* ---------- The index: filter the register by field ---------- */
	( function () {
		var chips = Array.prototype.slice.call( root.querySelectorAll( '.crs-chip' ) );
		var fields = Array.prototype.slice.call( root.querySelectorAll( '.crs-field' ) );
		var register = root.querySelector( '.crs-register' );
		var status = root.querySelector( '.crs-status' );
		if ( ! chips.length || ! fields.length ) {
			return;
		}

		var reveal = function ( scope ) {
			Array.prototype.forEach.call( scope.querySelectorAll( '[data-reveal]' ), function ( el ) {
				el.classList.add( 'is-in' );
			} );
		};

		var apply = function ( filter, chip ) {
			var shown = 0;

			fields.forEach( function ( field ) {
				var show = filter === 'all' || field.getAttribute( 'data-field' ) === filter;
				field.hidden = ! show;
				if ( show ) {
					shown += field.querySelectorAll( '.crs-entry' ).length;
					// Fields revealed after their observer fired would stay invisible.
					reveal( field );
				}
			} );

			if ( status ) {
				status.textContent = chip.textContent.replace( /\s+/g, ' ' ).trim() + ' — ' + shown;
			}

			// If the reader has already scrolled past the register, bring its top
			// back into view so the filtered result is not off-screen.
			if ( register && register.getBoundingClientRect().top < 0 ) {
				register.scrollIntoView( {
					behavior: reduceMotion ? 'auto' : 'smooth',
					block: 'start'
				} );
			}
		};

		chips.forEach( function ( chip ) {
			chip.addEventListener( 'click', function () {
				chips.forEach( function ( c ) { c.setAttribute( 'aria-pressed', 'false' ); } );
				chip.setAttribute( 'aria-pressed', 'true' );
				apply( chip.getAttribute( 'data-filter' ), chip );
			} );
		} );
	}() );

}() );
