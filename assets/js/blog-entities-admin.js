/**
 * Semantic entity picker (BLOG-01.3A) — dependency-free searchable multi-select.
 *
 * Enhances each .nv-ent-field into a token/tag input: search existing terms,
 * add new ones inline (type + Enter), remove with the chip × or Backspace. The
 * selected term NAMES are kept as a JSON array in the field's hidden input, which
 * inc/blog-entities.php reads on save (creating any new terms).
 *
 * @package Novira_Academy
 */
(function () {
	'use strict';

	var CFG = window.NV_ENT || { terms: {}, i18n: {} };
	var I18N = CFG.i18n || {};

	function el( tag, cls ) {
		var node = document.createElement( tag );
		if ( cls ) { node.className = cls; }
		return node;
	}
	function lc( s ) { return String( s ).toLowerCase(); }

	Array.prototype.forEach.call( document.querySelectorAll( '.nv-ent-field' ), function ( field ) {
		var tax    = field.getAttribute( 'data-tax' );
		var all    = ( CFG.terms && CFG.terms[ tax ] ) ? CFG.terms[ tax ].slice() : [];
		var chips  = field.querySelector( '.nv-ent-chips' );
		var search = field.querySelector( '.nv-ent-search' );
		var menu   = field.querySelector( '.nv-ent-menu' );
		var input  = field.querySelector( '.nv-ent-input' );

		var selected = [];
		try {
			selected = JSON.parse( input.value || '[]' );
			if ( ! Array.isArray( selected ) ) { selected = []; }
		} catch ( e ) { selected = []; }

		function sync() { input.value = JSON.stringify( selected ); }

		function has( list, name ) {
			var n = lc( name );
			return list.some( function ( x ) { return lc( x ) === n; } );
		}

		function renderChips() {
			chips.innerHTML = '';
			selected.forEach( function ( name ) {
				var chip = el( 'span', 'nv-ent-chip' );
				chip.appendChild( document.createTextNode( name ) );
				var x = el( 'button', 'nv-ent-x' );
				x.type = 'button';
				x.setAttribute( 'aria-label', ( I18N.remove || 'Remove' ) + ': ' + name );
				x.innerHTML = '&times;';
				x.addEventListener( 'click', function () { remove( name ); search.focus(); } );
				chip.appendChild( x );
				chips.appendChild( chip );
			} );
		}

		function add( name ) {
			name = ( name || '' ).trim();
			if ( '' === name || has( selected, name ) ) { return; }
			selected.push( name );
			if ( ! has( all, name ) ) { all.push( name ); }
			sync();
			renderChips();
		}

		function remove( name ) {
			selected = selected.filter( function ( s ) { return s !== name; } );
			sync();
			renderChips();
		}

		function closeMenu() {
			menu.hidden = true;
			menu.innerHTML = '';
			search.setAttribute( 'aria-expanded', 'false' );
		}

		function option( label, cls, onPick ) {
			var li = el( 'li', cls );
			li.setAttribute( 'role', 'option' );
			li.textContent = label;
			if ( onPick ) {
				li.addEventListener( 'mousedown', function ( e ) { e.preventDefault(); onPick(); } );
			}
			return li;
		}

		function openMenu() {
			var q = lc( search.value.trim() );
			menu.innerHTML = '';

			all.filter( function ( t ) {
				return ! has( selected, t ) && ( '' === q || lc( t ).indexOf( q ) !== -1 );
			} ).slice( 0, 8 ).forEach( function ( t ) {
				menu.appendChild( option( t, 'nv-ent-opt', function () { add( t ); search.value = ''; openMenu(); } ) );
			} );

			var typed = search.value.trim();
			if ( '' !== typed && ! has( all, typed ) ) {
				menu.appendChild( option( ( I18N.add || 'Add' ) + ' “' + typed + '”', 'nv-ent-opt nv-ent-opt--new', function () { add( typed ); search.value = ''; openMenu(); } ) );
			}

			if ( ! menu.children.length ) {
				menu.appendChild( option( I18N.none || 'No results', 'nv-ent-opt nv-ent-opt--none', null ) );
			}

			menu.hidden = false;
			search.setAttribute( 'aria-expanded', 'true' );
		}

		search.setAttribute( 'role', 'combobox' );
		search.setAttribute( 'aria-expanded', 'false' );
		search.setAttribute( 'aria-autocomplete', 'list' );

		search.addEventListener( 'focus', openMenu );
		search.addEventListener( 'input', openMenu );
		search.addEventListener( 'blur', function () { setTimeout( closeMenu, 120 ); } );
		search.addEventListener( 'keydown', function ( e ) {
			if ( 'Enter' === e.key ) {
				var v = search.value.trim();
				if ( v ) { e.preventDefault(); add( v ); search.value = ''; openMenu(); }
			} else if ( 'Backspace' === e.key && '' === search.value && selected.length ) {
				remove( selected[ selected.length - 1 ] );
			} else if ( 'Escape' === e.key ) {
				closeMenu();
			}
		} );

		renderChips();
		sync();
	} );
})();
