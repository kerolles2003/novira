/**
 * Customizer Live Preview
 *
 * @package Novira_Academy
 * @version 1.0.0
 */

( function( $ ) {
	'use strict';

	// Site title
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	// Site description
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Primary color
	wp.customize( 'novira_primary_color', function( value ) {
		value.bind( function( to ) {
			document.documentElement.style.setProperty( '--primary', to );
			document.documentElement.style.setProperty( '--purple', to );
		} );
	} );

	// Secondary color
	wp.customize( 'novira_secondary_color', function( value ) {
		value.bind( function( to ) {
			document.documentElement.style.setProperty( '--secondary', to );
			document.documentElement.style.setProperty( '--blue', to );
		} );
	} );

	// Hero badge
	wp.customize( 'novira_hero_badge', function( value ) {
		value.bind( function( to ) {
			$( '.hero-doc-badge' ).text( to );
		} );
	} );

	// Hero title
	wp.customize( 'novira_hero_title', function( value ) {
		value.bind( function( to ) {
			$( '.hero-doc-title' ).html( to );
		} );
	} );

	// Hero subtitle
	wp.customize( 'novira_hero_subtitle', function( value ) {
		value.bind( function( to ) {
			$( '.hero-doc-subtitle' ).text( to );
		} );
	} );

	// WhatsApp number
	wp.customize( 'novira_whatsapp', function( value ) {
		value.bind( function( to ) {
			$( '.whatsapp-float' ).attr( 'href', 'https://wa.me/' + to );
			$( 'a[href*="wa.me"]' ).each( function() {
				var href = $( this ).attr( 'href' );
				if ( href.indexOf( 'wa.me' ) !== -1 ) {
					$( this ).attr( 'href', 'https://wa.me/' + to );
				}
			} );
		} );
	} );

	// Email
	wp.customize( 'novira_email', function( value ) {
		value.bind( function( to ) {
			$( 'a[href^="mailto:"]' ).attr( 'href', 'mailto:' + to ).text( to );
		} );
	} );

	// Copyright text
	wp.customize( 'novira_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.footer-bottom p' ).html( '&copy; ' + new Date().getFullYear() + ' ' + noviraData.siteName + ' — ' + to );
		} );
	} );

	// Social media URLs
	wp.customize( 'novira_facebook', function( value ) {
		value.bind( function( to ) {
			$( 'a[aria-label="Facebook"]' ).attr( 'href', to );
		} );
	} );

	wp.customize( 'novira_instagram', function( value ) {
		value.bind( function( to ) {
			$( 'a[aria-label="Instagram"]' ).attr( 'href', to );
		} );
	} );

	wp.customize( 'novira_tiktok', function( value ) {
		value.bind( function( to ) {
			$( 'a[aria-label="TikTok"]' ).attr( 'href', to );
		} );
	} );

	wp.customize( 'novira_youtube', function( value ) {
		value.bind( function( to ) {
			$( 'a[aria-label="YouTube"]' ).attr( 'href', to );
		} );
	} );

} )( jQuery );