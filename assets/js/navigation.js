/**
 * Navigation Handler for Novira Academy
 *
 * Handles mobile menu toggle, accessibility, and scroll behavior.
 *
 * @package Novira_Academy
 * @version 2.0.0
 */

( function() {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function() {
		initMobileMenu();
		initDropdowns();
		initSmoothScroll();
		initScrollHeader();
		initAccessibility();
	} );

	/**
	 * Dropdown menus: desktop American Diploma flyout (click/touch
	 * persistence; hover & focus are handled in CSS) and the mobile
	 * accordion in the slide-in panel.
	 */
	function initDropdowns() {
		var desktopToggles = document.querySelectorAll( '.nav-dropdown-toggle' );

		function closeDesktop() {
			desktopToggles.forEach( function( btn ) {
				var menu = document.getElementById( btn.getAttribute( 'aria-controls' ) );
				if ( menu ) {
					menu.classList.remove( 'is-open' );
				}
				btn.setAttribute( 'aria-expanded', 'false' );
			} );
		}

		desktopToggles.forEach( function( btn ) {
			var menu = document.getElementById( btn.getAttribute( 'aria-controls' ) );
			if ( ! menu ) {
				return;
			}
			btn.addEventListener( 'click', function( e ) {
				e.preventDefault();
				var willOpen = ! menu.classList.contains( 'is-open' );
				closeDesktop();
				if ( willOpen ) {
					menu.classList.add( 'is-open' );
					btn.setAttribute( 'aria-expanded', 'true' );
				}
			} );
		} );

		if ( desktopToggles.length ) {
			document.addEventListener( 'click', function( e ) {
				if ( ! e.target.closest( '.has-dropdown' ) ) {
					closeDesktop();
				}
			} );

			document.addEventListener( 'keydown', function( e ) {
				if ( e.key === 'Escape' ) {
					closeDesktop();
				}
			} );
		}

		// Mobile accordion
		document.querySelectorAll( '.mobile-subnav-toggle' ).forEach( function( btn ) {
			var sub = document.getElementById( btn.getAttribute( 'aria-controls' ) );
			if ( ! sub ) {
				return;
			}
			btn.addEventListener( 'click', function() {
				var open = sub.classList.toggle( 'is-open' );
				btn.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			} );
		} );
	}

	/**
	 * Initialize mobile slide-in menu
	 */
	function initMobileMenu() {
		var toggle = document.querySelector( '.nav-hamburger' );
		var panel = document.querySelector( '.mobile-nav' );
		var backdrop = document.querySelector( '.mobile-nav__backdrop' );
		var closeBtn = document.querySelector( '.mobile-nav__close' );
		var body = document.body;

		if ( ! toggle || ! panel ) {
			return;
		}

		// Panel starts closed: make it inert so its links are not keyboard
		// focusable behind the page (and not exposed to assistive tech).
		panel.setAttribute( 'inert', '' );

		function openMenu() {
			toggle.setAttribute( 'aria-expanded', 'true' );
			panel.setAttribute( 'aria-hidden', 'false' );
			panel.removeAttribute( 'inert' );
			if ( backdrop ) {
				backdrop.classList.add( 'is-visible' );
			}
			body.classList.add( 'menu-open' );
			closeBtn && closeBtn.focus();
		}

		function closeMenu() {
			toggle.setAttribute( 'aria-expanded', 'false' );
			panel.setAttribute( 'aria-hidden', 'true' );
			panel.setAttribute( 'inert', '' );
			if ( backdrop ) {
				backdrop.classList.remove( 'is-visible' );
			}
			body.classList.remove( 'menu-open' );
			toggle.focus();
		}

		// Trap Tab focus inside the panel while it is open.
		panel.addEventListener( 'keydown', function( e ) {
			if ( e.key !== 'Tab' || ! body.classList.contains( 'menu-open' ) ) {
				return;
			}
			var focusables = panel.querySelectorAll( 'a[href], button:not([disabled]), input, select, textarea, [tabindex]:not([tabindex="-1"])' );
			if ( ! focusables.length ) {
				return;
			}
			var first = focusables[0];
			var last = focusables[ focusables.length - 1 ];
			if ( e.shiftKey && document.activeElement === first ) {
				e.preventDefault();
				last.focus();
			} else if ( ! e.shiftKey && document.activeElement === last ) {
				e.preventDefault();
				first.focus();
			}
		} );

		toggle.addEventListener( 'click', function() {
			if ( this.getAttribute( 'aria-expanded' ) === 'true' ) {
				closeMenu();
			} else {
				openMenu();
			}
		} );

		if ( closeBtn ) {
			closeBtn.addEventListener( 'click', closeMenu );
		}

		if ( backdrop ) {
			backdrop.addEventListener( 'click', closeMenu );
		}

		document.addEventListener( 'keydown', function( e ) {
			if ( e.key === 'Escape' && body.classList.contains( 'menu-open' ) ) {
				closeMenu();
			}
		} );

		var panelLinks = panel.querySelectorAll( 'a' );
		panelLinks.forEach( function( link ) {
			link.addEventListener( 'click', closeMenu );
		} );
	}

	/**
	 * Smooth scroll for anchor links
	 */
	function initSmoothScroll() {
		var anchors = document.querySelectorAll( 'a[href^="#"]' );

		anchors.forEach( function( link ) {
			link.addEventListener( 'click', function( e ) {
				var id = this.getAttribute( 'href' );
				if ( id === '#' ) {
					return;
				}

				var target = document.querySelector( id );
				if ( target ) {
					e.preventDefault();
					var headerHeight = document.querySelector( '.site-header' )?.offsetHeight || 0;
					var top = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;

					window.scrollTo( { top: top, behavior: 'smooth' } );

					target.setAttribute( 'tabindex', '-1' );
					target.focus( { preventScroll: true } );
				}
			} );
		} );
	}

	/**
	 * Scroll header behavior: shadow on scroll, hide on scroll down
	 */
	function initScrollHeader() {
		var header = document.querySelector( '.site-header' );
		if ( ! header ) {
			return;
		}

		var lastScroll = 0;
		var threshold = 80;

		window.addEventListener( 'scroll', function() {
			var current = window.pageYOffset;

			if ( current > threshold ) {
				header.classList.add( 'scrolled' );
			} else {
				header.classList.remove( 'scrolled' );
			}

			if ( current > lastScroll && current > threshold ) {
				header.classList.add( 'header-hidden' );
			} else {
				header.classList.remove( 'header-hidden' );
			}

			lastScroll = current;
		}, { passive: true } );
	}

	/**
	 * Accessibility: keyboard navigation detection, skip link
	 */
	function initAccessibility() {
		document.addEventListener( 'keydown', function( e ) {
			if ( e.key === 'Tab' ) {
				document.body.classList.add( 'keyboard-navigation' );
			}
		} );

		document.addEventListener( 'mousedown', function() {
			document.body.classList.remove( 'keyboard-navigation' );
		} );

		var skipLink = document.querySelector( '.skip-link' );
		if ( skipLink ) {
			skipLink.addEventListener( 'click', function( e ) {
				e.preventDefault();
				var target = document.querySelector( this.getAttribute( 'href' ) );
				if ( target ) {
					target.setAttribute( 'tabindex', '-1' );
					target.focus();
				}
			} );
		}
	}

} )();
