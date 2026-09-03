<?php
/**
 * Minimal PO → MO compiler (GNU gettext binary format). Line-based parser for
 * single-line PO entries (msgid/msgstr each on one line, possibly with adjacent
 * continuation quoted lines). Handles singular + plural; omits untranslated
 * entries (they fall back). Usage: php po2mo.php <src.po> <dest.mo>
 */
// CLI-only build tool. Never allow web execution (it reads/writes arbitrary
// paths from $argv, which register_argc_argv=On would populate from the query
// string). This file should also be excluded from the production build.
if ( 'cli' !== PHP_SAPI ) {
	exit;
}

$lines = explode( "\n", str_replace( "\r", '', file_get_contents( $argv[1] ) ) );
$dest  = $argv[2];

function po_dequote_line( $line, $keyword ) {
	// Strip leading keyword, then unescape the single quoted value.
	$v = trim( substr( $line, strlen( $keyword ) ) );
	if ( '' === $v || '"' !== $v[0] ) { return ''; }
	$v = substr( $v, 1, -1 ); // drop surrounding quotes
	return str_replace( array( '\\n', '\\t', '\\r', '\\"', '\\\\' ), array( "\n", "\t", "\r", '"', '\\' ), $v );
}

$entries = array();
$i = 0; $count = count( $lines );
$ctxt = null; $msgid = null; $plural = null; $msgstr = array();

$flush = function () use ( &$entries, &$ctxt, &$msgid, &$plural, &$msgstr ) {
	if ( null === $msgid ) { return; }
	$has = false;
	foreach ( $msgstr as $s ) { if ( '' !== $s ) { $has = true; break; } }
	if ( '' !== $msgid && ! $has ) { $ctxt=null;$msgid=null;$plural=null;$msgstr=array(); return; }
	$key = ( null !== $plural ) ? $msgid . "\0" . $plural : $msgid;
	if ( null !== $ctxt ) { $key = $ctxt . "\4" . $key; }
	ksort( $msgstr );
	$entries[ $key ] = implode( "\0", $msgstr );
	$ctxt=null;$msgid=null;$plural=null;$msgstr=array();
};

$last = null; // which field a bare "..." continuation line appends to
foreach ( $lines as $line ) {
	if ( '' === trim( $line ) ) { $flush(); $last = null; continue; }
	if ( '#' === $line[0] ) { continue; }
	if ( 0 === strpos( $line, 'msgctxt ' ) ) { $ctxt = po_dequote_line( $line, 'msgctxt ' ); $last = 'ctxt'; }
	elseif ( 0 === strpos( $line, 'msgid_plural ' ) ) { $plural = po_dequote_line( $line, 'msgid_plural ' ); $last = 'plural'; }
	elseif ( 0 === strpos( $line, 'msgid ' ) ) { $msgid = po_dequote_line( $line, 'msgid ' ); $last = 'msgid'; }
	elseif ( 0 === strpos( $line, 'msgstr[0] ' ) ) { $msgstr[0] = po_dequote_line( $line, 'msgstr[0] ' ); $last = 'str0'; }
	elseif ( 0 === strpos( $line, 'msgstr[1] ' ) ) { $msgstr[1] = po_dequote_line( $line, 'msgstr[1] ' ); $last = 'str1'; }
	elseif ( 0 === strpos( $line, 'msgstr ' ) ) { $msgstr[0] = po_dequote_line( $line, 'msgstr ' ); $last = 'str0'; }
	elseif ( '"' === $line[0] && null !== $last ) {
		$frag = po_dequote_line( $line, '' );
		if ( 'ctxt' === $last ) { $ctxt .= $frag; }
		elseif ( 'plural' === $last ) { $plural .= $frag; }
		elseif ( 'msgid' === $last ) { $msgid .= $frag; }
		elseif ( 'str0' === $last ) { $msgstr[0] = ( isset( $msgstr[0] ) ? $msgstr[0] : '' ) . $frag; }
		elseif ( 'str1' === $last ) { $msgstr[1] = ( isset( $msgstr[1] ) ? $msgstr[1] : '' ) . $frag; }
	}
}
$flush();

// Force a correct MO header so WP reads charset + plural-forms.
$entries[''] = "Project-Id-Version: Novira Academy 1.0.0\nLanguage: en_US\nMIME-Version: 1.0\nContent-Type: text/plain; charset=UTF-8\nContent-Transfer-Encoding: 8bit\nPlural-Forms: nplurals=2; plural=(n != 1);\n";

ksort( $entries );
$ids = array_keys( $entries ); $strs = array_values( $entries );
$n = count( $ids );

$o_ids = ''; $o_strs = ''; $id_tbl = array(); $str_tbl = array();
foreach ( $ids as $id ) { $id_tbl[] = array( strlen( $id ), strlen( $o_ids ) ); $o_ids .= $id . "\0"; }
foreach ( $strs as $st ) { $str_tbl[] = array( strlen( $st ), strlen( $o_strs ) ); $o_strs .= $st . "\0"; }

$id_tbl_off = 28; $str_tbl_off = $id_tbl_off + $n * 8;
$ids_off = $str_tbl_off + $n * 8; $strs_off = $ids_off + strlen( $o_ids );

$mo  = pack( 'V', 0x950412de ) . pack( 'V', 0 ) . pack( 'V', $n );
$mo .= pack( 'V', $id_tbl_off ) . pack( 'V', $str_tbl_off ) . pack( 'V', 0 ) . pack( 'V', 0 );
foreach ( $id_tbl as $t )  { $mo .= pack( 'VV', $t[0], $ids_off + $t[1] ); }
foreach ( $str_tbl as $t ) { $mo .= pack( 'VV', $t[0], $strs_off + $t[1] ); }
$mo .= $o_ids . $o_strs;

file_put_contents( $dest, $mo );
echo "wrote $n entries to $dest\n";
