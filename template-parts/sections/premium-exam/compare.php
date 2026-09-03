<?php
/**
 * Premium Exam — S4 Comparison table (shared component, Sprint 5.0).
 * Mirrors page-est.php S4. The highlighted column (violet rails) is data-driven
 * via $highlight so each spoke can own its own column (EST → 'est', SAT → 'sat').
 *
 * @param array $args {
 *   @type string $eyebrow,$title,$desc,$trophy_title,$trophy_desc,$note,$highlight
 *   @type array  $rows       each [ 'label', 'est', 'sat', 'act' ] (bool true => check)
 *   @type string $links_lead lead phrase before the cross-exam internal links
 *   @type array  $links      each [ 'label', 'url' ] — internal links to sibling
 *                            exams / the hub (SEO + navigation). Empty = none.
 * }
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$a    = wp_parse_args( isset( $args ) ? $args : array(), array(
	'eyebrow'      => '',
	'title'        => '',
	'desc'         => '',
	'trophy_title' => '',
	'trophy_desc'  => '',
	'rows'         => array(),
	'note'         => '',
	'highlight'    => 'sat',
	'links_lead'   => '',
	'links'        => array(),
) );
$icon = novira_premium_exam_icons();
$yes  = '<span class="est-yes" aria-label="' . esc_attr__( 'نعم', 'novira-academy' ) . '">' . $icon['check'] . '</span>';

// Fixed exam columns; the highlighted one gets the est-table__col-est treatment.
$cols   = array( 'est' => 'EST', 'sat' => 'Digital SAT', 'act' => 'ACT' );
$hl_cls = function ( $key ) use ( $a ) {
	return ( $a['highlight'] === $key ) ? ' est-table__col-est' : '';
};
$cell   = function ( $val ) use ( $yes ) {
	return ( true === $val ) ? $yes : esc_html( $val );
};
?>
<section class="est-compare" aria-labelledby="pex-compare-title">
	<div class="est-wrap">
		<div class="est-section-head est-reveal">
			<span class="est-eyebrow"><?php echo $icon['target']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_html( $a['eyebrow'] ); ?></span>
			<h2 id="pex-compare-title"><?php echo esc_html( $a['title'] ); ?></h2>
			<p><?php echo esc_html( $a['desc'] ); ?></p>
		</div>

		<div class="est-compare__layout">
			<div class="est-trophy est-reveal">
				<div class="est-trophy__icon"><?php echo $icon['trophy']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				<h3><?php echo esc_html( $a['trophy_title'] ); ?></h3>
				<p><?php echo esc_html( $a['trophy_desc'] ); ?></p>
			</div>

			<div class="est-table est-reveal est-reveal--scale">
				<div class="est-table__inner">
					<div class="est-table__row est-table__head">
						<div class="est-table__cell est-table__cell--label"><?php esc_html_e( 'المعيار', 'novira-academy' ); ?></div>
						<div class="est-table__cell<?php echo esc_attr( $hl_cls( 'est' ) ); ?>">EST</div>
						<div class="est-table__cell<?php echo esc_attr( $hl_cls( 'sat' ) ); ?>">Digital SAT</div>
						<div class="est-table__cell<?php echo esc_attr( $hl_cls( 'act' ) ); ?>">ACT</div>
					</div>
					<?php foreach ( $a['rows'] as $row ) : ?>
						<div class="est-table__row">
							<div class="est-table__cell est-table__cell--label"><?php echo esc_html( $row['label'] ); ?></div>
							<div class="est-table__cell<?php echo esc_attr( $hl_cls( 'est' ) ); ?>"><?php echo $cell( $row['est'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
							<div class="est-table__cell<?php echo esc_attr( $hl_cls( 'sat' ) ); ?>"><?php echo $cell( $row['sat'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
							<div class="est-table__cell<?php echo esc_attr( $hl_cls( 'act' ) ); ?>"><?php echo $cell( $row['act'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php if ( $a['note'] ) : ?>
			<p class="est-table__note"><?php echo esc_html( $a['note'] ); ?></p>
		<?php endif; ?>

		<?php
		$links = array_values( array_filter( (array) $a['links'], function ( $l ) {
			return ! empty( $l['label'] ) && ! empty( $l['url'] );
		} ) );
		if ( ! empty( $links ) ) :
			?>
			<p class="est-related-links est-reveal">
				<?php
				if ( '' !== (string) $a['links_lead'] ) {
					echo esc_html( $a['links_lead'] ) . ' ';
				}
				$parts = array();
				foreach ( $links as $l ) {
					$parts[] = '<a href="' . esc_url( $l['url'] ) . '">' . esc_html( $l['label'] ) . '</a>';
				}
				echo implode( '<span class="est-related-links__sep"> · </span>', $parts ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- links pre-escaped above.
				?>
			</p>
		<?php endif; ?>
	</div>
</section>
