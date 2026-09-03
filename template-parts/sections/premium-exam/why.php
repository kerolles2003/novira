<?php
/**
 * Premium Exam — S3 Why (checklist + Cognia card). Shared component, Sprint 5.0.
 * Mirrors page-est.php S3.
 *
 * @param array $args { @type string $eyebrow,$title,$desc,$cognia_title,$cognia_desc,$cognia_bg,$cognia_logo; @type array $list }
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$a    = wp_parse_args( isset( $args ) ? $args : array(), array(
	'eyebrow'      => '',
	'title'        => '',
	'desc'         => '',
	'list'         => array(),
	'cognia_title' => '',
	'cognia_desc'  => '',
	'cognia_bg'    => '',
	'cognia_logo'  => '',
) );
$icon = novira_premium_exam_icons();
$flag = novira_premium_exam_flag( 'est-cognia__flag' );
?>
<section class="est-why" aria-labelledby="pex-why-title">
	<div class="est-wrap est-why__grid">
		<div class="est-why__head est-reveal">
			<span class="est-eyebrow"><?php echo $icon['star']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_html( $a['eyebrow'] ); ?></span>
			<h2 id="pex-why-title"><?php echo esc_html( $a['title'] ); ?></h2>
			<p><?php echo esc_html( $a['desc'] ); ?></p>
			<ul class="est-why__list">
				<?php foreach ( $a['list'] as $item ) : ?>
					<li><span class="est-check"><?php echo $icon['check']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><?php echo esc_html( $item ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="est-cognia est-reveal est-reveal--scale">
			<?php if ( $a['cognia_bg'] ) : ?>
				<img class="est-cognia__bg" src="<?php echo esc_url( $a['cognia_bg'] ); ?>" alt="" aria-hidden="true" width="700" height="360" loading="lazy" decoding="async">
			<?php endif; ?>
			<?php echo $flag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<div class="est-cognia__body">
				<?php if ( $a['cognia_logo'] ) : ?>
					<span class="est-cognia__seal">
						<img src="<?php echo esc_url( $a['cognia_logo'] ); ?>" alt="<?php esc_attr_e( 'اعتماد Cognia', 'novira-academy' ); ?>" width="44" height="44" loading="lazy" decoding="async">
					</span>
				<?php endif; ?>
				<h3><?php echo esc_html( $a['cognia_title'] ); ?></h3>
				<p><?php echo esc_html( $a['cognia_desc'] ); ?></p>
			</div>
		</div>
	</div>
</section>
