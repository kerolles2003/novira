<?php
/**
 * Premium Exam — S7 CTA (shared component, Sprint 5.0). Mirrors page-est.php S7.
 *
 * @param array $args { @type string $title,$desc,$wa_url,$primary_label,$secondary_href,$secondary_label }
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$a    = wp_parse_args( isset( $args ) ? $args : array(), array(
	'title'           => '',
	'desc'            => '',
	'wa_url'          => '#',
	'primary_label'   => __( 'احجز استشارتك المجانية', 'novira-academy' ),
	'secondary_href'  => home_url( '/contact' ),
	'secondary_label' => __( 'تواصل مع الفريق', 'novira-academy' ),
) );
$icon = novira_premium_exam_icons();
?>
<section class="est-cta" aria-labelledby="pex-cta-title">
	<div class="est-wrap">
		<div class="est-cta__panel est-reveal est-reveal--scale">
			<h2 id="pex-cta-title"><?php echo esc_html( $a['title'] ); ?></h2>
			<p><?php echo esc_html( $a['desc'] ); ?></p>
			<div class="est-cta__actions">
				<a class="est-btn est-btn--light" href="<?php echo esc_url( $a['wa_url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo $icon['whatsapp']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_html( $a['primary_label'] ); ?></a>
				<a class="est-btn est-btn--outline-light" href="<?php echo esc_url( $a['secondary_href'] ); ?>"><?php echo esc_html( $a['secondary_label'] ); ?></a>
			</div>
		</div>
	</div>
</section>
