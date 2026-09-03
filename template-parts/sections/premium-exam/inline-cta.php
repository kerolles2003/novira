<?php
/**
 * Premium Exam — contextual inline CTA (shared component).
 *
 * A compact, lower-weight call to action for mid-page moments — distinct from
 * the full-panel closing CTA (premium-exam/cta.php). Used immediately after the
 * course catalog to catch the parent who isn't sure which course fits:
 * "لست متأكداً؟ → احجز تقييم مستوى". Reusable across every exam spoke; the
 * assessment prefill message is passed in. Reuses the premium tokens and the
 * .est-btn system; styles in premium-exam.css. No JavaScript.
 *
 * @param array $args {
 *   @type string $title         Prompt (question).
 *   @type string $desc          One supporting line (optional).
 *   @type string $primary_label Primary button label.
 *   @type string $primary_href  Primary button href (e.g. WhatsApp).
 *   @type bool   $primary_blank Open primary in a new tab (default true).
 * }
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$a = wp_parse_args( isset( $args ) ? $args : array(), array(
	'title'         => '',
	'desc'          => '',
	'primary_label' => '',
	'primary_href'  => '',
	'primary_blank' => true,
) );

if ( '' === (string) $a['title'] || '' === (string) $a['primary_label'] || '' === (string) $a['primary_href'] ) {
	return; // Nothing actionable — render nothing.
}

$icon    = function_exists( 'novira_premium_exam_icons' ) ? novira_premium_exam_icons() : array();
$wa_icon = isset( $icon['whatsapp'] ) ? $icon['whatsapp'] : '';
?>
<section class="est-inline-cta" aria-label="<?php echo esc_attr( $a['title'] ); ?>">
	<div class="est-wrap">
		<div class="est-inline-cta__panel est-reveal">
			<div class="est-inline-cta__text">
				<p class="est-inline-cta__title"><?php echo esc_html( $a['title'] ); ?></p>
				<?php if ( '' !== (string) $a['desc'] ) : ?>
					<p class="est-inline-cta__desc"><?php echo esc_html( $a['desc'] ); ?></p>
				<?php endif; ?>
			</div>
			<a class="est-btn est-btn--primary est-inline-cta__btn"
				href="<?php echo esc_url( $a['primary_href'] ); ?>"
				<?php echo $a['primary_blank'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
				<?php echo $wa_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_html( $a['primary_label'] ); ?>
			</a>
		</div>
	</div>
</section>
