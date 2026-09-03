<?php
/**
 * Premium Exam — S5 Parent follow-up (shared component, Sprint 5.0).
 * Mirrors page-est.php S5.
 *
 * @param array $args { @type string $eyebrow,$title,$desc,$image,$image_alt; @type array $items [ ['i','t','d'], ... ] }
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$a    = wp_parse_args( isset( $args ) ? $args : array(), array(
	'eyebrow'   => '',
	'title'     => '',
	'desc'      => '',
	'items'     => array(),
	'image'     => '',
	'image_alt' => '',
) );
$icon = novira_premium_exam_icons();
?>
<section class="est-parents" aria-labelledby="pex-parents-title">
	<div class="est-wrap est-parents__grid">
		<div class="est-parents__head est-reveal">
			<span class="est-eyebrow"><?php echo $icon['message']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_html( $a['eyebrow'] ); ?></span>
			<h2 id="pex-parents-title"><?php echo esc_html( $a['title'] ); ?></h2>
			<p><?php echo esc_html( $a['desc'] ); ?></p>
			<ul class="est-parents__list">
				<?php foreach ( $a['items'] as $p ) : ?>
					<li class="est-feature-row">
						<span class="est-feature-row__icon"><?php echo $icon[ $p['i'] ]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<div>
							<h4><?php echo esc_html( $p['t'] ); ?></h4>
							<p><?php echo esc_html( $p['d'] ); ?></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="est-parents__visual est-reveal est-reveal--scale">
			<img src="<?php echo esc_url( $a['image'] ); ?>" alt="<?php echo esc_attr( $a['image_alt'] ); ?>" width="640" height="512" loading="lazy" decoding="async">
		</div>
	</div>
</section>
