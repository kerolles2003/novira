<?php
/**
 * Premium Exam — FAQ (shared component, Sprint 5.0).
 *
 * A NEW premium section (the EST page has no on-page FAQ today — pre-existing
 * gap; this component will be back-ported to EST at consolidation). Native
 * <details>/<summary> accordion: fully keyboard-accessible with zero JS.
 * Styled by the scoped .pex-faq rules the spoke template ships inline.
 *
 * @param array $args { @type string $eyebrow,$title,$desc; @type array $items [ ['question','answer'], ... ] }
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$a    = wp_parse_args( isset( $args ) ? $args : array(), array(
	'eyebrow' => '',
	'title'   => '',
	'desc'    => '',
	'items'   => array(),
	'anchor'  => 'faq',
) );
$icon  = novira_premium_exam_icons();
$items = array_values( array_filter( (array) $a['items'], function ( $i ) {
	return ! empty( $i['question'] ) && ! empty( $i['answer'] );
} ) );
if ( empty( $items ) ) {
	return;
}
?>
<section class="est-faq" id="<?php echo esc_attr( $a['anchor'] ); ?>" aria-labelledby="pex-faq-title">
	<div class="est-wrap est-faq__wrap">
		<div class="est-section-head est-reveal">
			<span class="est-eyebrow"><?php echo $icon['message']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_html( $a['eyebrow'] ); ?></span>
			<h2 id="pex-faq-title"><?php echo esc_html( $a['title'] ); ?></h2>
			<?php if ( $a['desc'] ) : ?><p><?php echo esc_html( $a['desc'] ); ?></p><?php endif; ?>
		</div>

		<div class="pex-faq est-reveal">
			<?php foreach ( $items as $i => $item ) : ?>
				<details class="pex-faq__item"<?php echo 0 === $i ? ' open' : ''; ?>>
					<summary class="pex-faq__q">
						<span><?php echo esc_html( $item['question'] ); ?></span>
						<span class="pex-faq__chev" aria-hidden="true"></span>
					</summary>
					<div class="pex-faq__a"><p><?php echo esc_html( $item['answer'] ); ?></p></div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
