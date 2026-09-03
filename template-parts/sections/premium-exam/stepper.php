<?php
/**
 * Premium Exam — S2 Process Stepper (shared component, Sprint 5.0)
 *
 * Mirrors page-est.php S2. The est-page.css route animation is built for exactly
 * 6 stations (grid repeat(6), :nth-child up to 6) — pass 6 steps for parity.
 *
 * @param array $args { @type string $eyebrow,$title,$desc; @type array $steps [ ['t','d'], ... ] }
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$a    = wp_parse_args( isset( $args ) ? $args : array(), array(
	'eyebrow' => '',
	'title'   => '',
	'desc'    => '',
	'steps'   => array(),
	'anchor'  => 'prep',
) );
$icon = novira_premium_exam_icons();
?>
<section class="est-steps" id="<?php echo esc_attr( $a['anchor'] ); ?>" aria-labelledby="pex-steps-title">
	<div class="est-wrap">
		<div class="est-section-head est-reveal">
			<span class="est-eyebrow"><?php echo $icon['route']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_html( $a['eyebrow'] ); ?></span>
			<h2 id="pex-steps-title"><?php echo esc_html( $a['title'] ); ?></h2>
			<p><?php echo esc_html( $a['desc'] ); ?></p>
		</div>
		<ol class="est-steps__track">
			<?php foreach ( $a['steps'] as $n => $s ) : ?>
				<li class="est-step est-reveal">
					<span class="est-step__node"><b><?php echo esc_html( $n + 1 ); ?></b></span>
					<div class="est-step__card">
						<h4><?php echo esc_html( $s['t'] ); ?></h4>
						<p><?php echo esc_html( $s['d'] ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
