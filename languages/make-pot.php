<?php
/**
 * Minimal POT extractor for the novira-academy theme.
 * Scans theme PHP files with token_get_all() for gettext calls using the
 * 'novira-academy' text domain and writes languages/novira-academy.pot.
 *
 * Usage: php make-pot.php <theme-dir>
 */

// CLI-only build tool. Never allow web execution (it scans/writes paths from
// $argv, which register_argc_argv=On would populate from the query string).
// This file should also be excluded from the production build.
if ( 'cli' !== PHP_SAPI ) {
	exit;
}

$theme = rtrim( $argv[1] ?? '', '/\\' );
if ( '' === $theme || ! is_dir( $theme ) ) {
	fwrite( STDERR, "Theme dir not found\n" );
	exit( 1 );
}

$domain = 'novira-academy';
$funcs  = array(
	// name => [ msgid arg index, msgctxt/plural handling ]
	'__'          => array( 'msgid' => 0, 'domain' => 1 ),
	'_e'          => array( 'msgid' => 0, 'domain' => 1 ),
	'esc_html__'  => array( 'msgid' => 0, 'domain' => 1 ),
	'esc_html_e'  => array( 'msgid' => 0, 'domain' => 1 ),
	'esc_attr__'  => array( 'msgid' => 0, 'domain' => 1 ),
	'esc_attr_e'  => array( 'msgid' => 0, 'domain' => 1 ),
	'_x'          => array( 'msgid' => 0, 'ctxt' => 1, 'domain' => 2 ),
	'esc_html_x'  => array( 'msgid' => 0, 'ctxt' => 1, 'domain' => 2 ),
	'esc_attr_x'  => array( 'msgid' => 0, 'ctxt' => 1, 'domain' => 2 ),
	'_n'          => array( 'msgid' => 0, 'plural' => 1, 'domain' => 3 ),
	'_nx'         => array( 'msgid' => 0, 'plural' => 1, 'ctxt' => 3, 'domain' => 4 ),
);

$files = array();
$rii   = new RecursiveIteratorIterator(
	new RecursiveCallbackFilterIterator(
		new RecursiveDirectoryIterator( $theme, FilesystemIterator::SKIP_DOTS ),
		function ( $cur ) {
			$name = $cur->getFilename();
			if ( $cur->isDir() ) {
				return ! in_array( $name, array( '.opencode', '.agents', 'node_modules', '.git', 'plugins' ), true );
			}
			return 'php' === strtolower( $cur->getExtension() );
		}
	)
);
foreach ( $rii as $f ) {
	$files[] = $f->getPathname();
}
sort( $files );

/** Decode a PHP string literal token to its runtime value (single/double quoted). */
function decode_literal( $raw ) {
	$q = $raw[0];
	$inner = substr( $raw, 1, -1 );
	if ( "'" === $q ) {
		return str_replace( array( "\\'", '\\\\' ), array( "'", '\\' ), $inner );
	}
	// Double-quoted: handle common escapes.
	return stripcslashes( $inner );
}

/** Escape a value for POT msgid output. */
function pot_escape( $s ) {
	$s = str_replace( array( '\\', '"' ), array( '\\\\', '\\"' ), $s );
	$s = str_replace( array( "\r\n", "\r", "\n" ), '\n', $s );
	$s = str_replace( "\t", '\t', $s );
	return $s;
}

$entries = array(); // key => [ 'msgid', 'ctxt', 'plural', 'refs' => [], 'comments' => [] ]

foreach ( $files as $path ) {
	$rel    = str_replace( '\\', '/', substr( $path, strlen( $theme ) + 1 ) );
	$code   = file_get_contents( $path );
	$tokens = token_get_all( $code );
	$n      = count( $tokens );

	for ( $i = 0; $i < $n; $i++ ) {
		$t = $tokens[ $i ];
		if ( ! is_array( $t ) || T_STRING !== $t[0] || ! isset( $funcs[ $t[1] ] ) ) {
			continue;
		}
		$spec = $funcs[ $t[1] ];
		$line = $t[2];

		// Preceding token must not be -> :: or function (method defs etc.)
		for ( $p = $i - 1; $p >= 0; $p-- ) {
			$pt = $tokens[ $p ];
			if ( is_array( $pt ) && in_array( $pt[0], array( T_WHITESPACE, T_COMMENT, T_DOC_COMMENT ), true ) ) {
				continue;
			}
			break;
		}
		if ( $p >= 0 ) {
			$pt = $tokens[ $p ];
			if ( is_array( $pt ) && in_array( $pt[0], array( T_OBJECT_OPERATOR, T_DOUBLE_COLON, T_FUNCTION ), true ) ) {
				continue;
			}
		}

		// Grab translators comment just above (search back for comment on prior lines).
		$translators = null;
		for ( $p = $i - 1, $steps = 0; $p >= 0 && $steps < 12; $p--, $steps++ ) {
			$pt = $tokens[ $p ];
			if ( is_array( $pt ) && ( T_COMMENT === $pt[0] || T_DOC_COMMENT === $pt[0] ) && false !== stripos( $pt[1], 'translators' ) ) {
				$translators = trim( preg_replace( '~^/\*+|\*+/$|^//~', '', trim( $pt[1] ) ) );
				break;
			}
			if ( is_array( $pt ) && T_WHITESPACE === $pt[0] ) {
				continue;
			}
			// stop only after passing a few significant tokens
			if ( ! is_array( $pt ) && in_array( $pt, array( ';', '{', '}' ), true ) ) {
				break;
			}
		}

		// Collect argument string literals at depth 1 of this call.
		$j = $i + 1;
		while ( $j < $n && is_array( $tokens[ $j ] ) && T_WHITESPACE === $tokens[ $j ][0] ) {
			$j++;
		}
		if ( $j >= $n || '(' !== $tokens[ $j ] ) {
			continue;
		}
		$depth = 0;
		$args  = array();
		$cur   = null; // literal accumulator for current arg (null = non-literal)
		$curset = false;
		for ( $k = $j; $k < $n; $k++ ) {
			$tk = $tokens[ $k ];
			if ( '(' === $tk || ( is_array( $tk ) && T_CURLY_OPEN === $tk[0] ) ) {
				$depth++;
				if ( $depth > 1 ) { $curset = true; $cur = null; }
				continue;
			}
			if ( ')' === $tk ) {
				$depth--;
				if ( 0 === $depth ) {
					$args[] = $curset ? $cur : null;
					break;
				}
				continue;
			}
			if ( 1 === $depth && ',' === $tk ) {
				$args[] = $curset ? $cur : null;
				$cur = null; $curset = false;
				continue;
			}
			if ( is_array( $tk ) && in_array( $tk[0], array( T_WHITESPACE, T_COMMENT, T_DOC_COMMENT ), true ) ) {
				continue;
			}
			if ( 1 === $depth && is_array( $tk ) && T_CONSTANT_ENCAPSED_STRING === $tk[0] ) {
				if ( ! $curset || null !== $cur ) {
					$cur    = ( $curset && null !== $cur ) ? $cur . decode_literal( $tk[1] ) : decode_literal( $tk[1] );
					$curset = true;
				}
				continue;
			}
			if ( 1 === $depth && '.' === $tk ) {
				continue; // literal concatenation
			}
			if ( 1 === $depth ) {
				$cur = null; $curset = true; // non-literal arg
			}
		}

		$msgid = $args[ $spec['msgid'] ] ?? null;
		$dom   = $args[ $spec['domain'] ] ?? null;
		if ( null === $msgid || $domain !== $dom ) {
			continue;
		}
		$ctxt   = isset( $spec['ctxt'] ) ? ( $args[ $spec['ctxt'] ] ?? null ) : null;
		$plural = isset( $spec['plural'] ) ? ( $args[ $spec['plural'] ] ?? null ) : null;

		$key = ( $ctxt ?? '' ) . "\x04" . $msgid . "\x04" . ( $plural ?? '' );
		if ( ! isset( $entries[ $key ] ) ) {
			$entries[ $key ] = array( 'msgid' => $msgid, 'ctxt' => $ctxt, 'plural' => $plural, 'refs' => array(), 'comments' => array() );
		}
		$entries[ $key ]['refs'][] = $rel . ':' . $line;
		if ( $translators ) {
			$entries[ $key ]['comments'][ $translators ] = true;
		}
	}
}

$out  = "# Copyright (C) 2026 Novira Academy\n";
$out .= "# This file is distributed under the GNU General Public License v2 or later.\n";
$out .= "msgid \"\"\nmsgstr \"\"\n";
$out .= "\"Project-Id-Version: Novira Academy 1.0.0\\n\"\n";
$out .= "\"Report-Msgid-Bugs-To: https://noviraacademy.com\\n\"\n";
$out .= "\"POT-Creation-Date: 2026-07-06 00:00+0000\\n\"\n";
$out .= "\"PO-Revision-Date: YEAR-MO-DA HO:MI+ZONE\\n\"\n";
$out .= "\"Last-Translator: FULL NAME <EMAIL@ADDRESS>\\n\"\n";
$out .= "\"Language-Team: LANGUAGE <LL@li.org>\\n\"\n";
$out .= "\"Language: \\n\"\n";
$out .= "\"MIME-Version: 1.0\\n\"\n";
$out .= "\"Content-Type: text/plain; charset=UTF-8\\n\"\n";
$out .= "\"Content-Transfer-Encoding: 8bit\\n\"\n";
$out .= "\"X-Domain: novira-academy\\n\"\n\n";

foreach ( $entries as $e ) {
	foreach ( array_keys( $e['comments'] ) as $c ) {
		$out .= '#. ' . $c . "\n";
	}
	$refs = array_unique( $e['refs'] );
	foreach ( array_chunk( $refs, 6 ) as $chunk ) {
		$out .= '#: ' . implode( ' ', $chunk ) . "\n";
	}
	if ( null !== $e['ctxt'] ) {
		$out .= 'msgctxt "' . pot_escape( $e['ctxt'] ) . "\"\n";
	}
	$out .= 'msgid "' . pot_escape( $e['msgid'] ) . "\"\n";
	if ( null !== $e['plural'] ) {
		$out .= 'msgid_plural "' . pot_escape( $e['plural'] ) . "\"\n";
		$out .= "msgstr[0] \"\"\nmsgstr[1] \"\"\n\n";
	} else {
		$out .= "msgstr \"\"\n\n";
	}
}

$dest = $theme . '/languages/novira-academy.pot';
file_put_contents( $dest, $out );
echo 'Wrote ' . count( $entries ) . " entries to $dest\n";
