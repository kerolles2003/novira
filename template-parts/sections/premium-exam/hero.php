<?php
/**
 * Premium Exam — S1 Hero (shared component, Sprint 5.0)
 *
 * Mirrors the EST hero (page-est.php S1) exactly, but data-driven so any exam
 * spoke can reuse it. Styled by est-page.css (.est-* classes) with zero CSS
 * duplication. EST is NOT refactored to use this yet — see docs/digital-sat-premium.md.
 *
 * @param array $args {
 *   @type string $badge, $mark, $sub, $desc, $wa_url, $primary_label,
 *                $ghost_href, $ghost_label, $cognia_text, $cognia_logo,
 *                $image, $image_alt, $stats_title, $stats_sub
 * }
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$a    = wp_parse_args( isset( $args ) ? $args : array(), array(
	'badge'         => '',
	'mark'          => '',
	'sub'           => '',
	'desc'          => '',
	'wa_url'        => '#',
	'primary_label' => __( 'ابدأ الآن', 'novira-academy' ),
	'ghost_href'    => '#prep',
	'ghost_label'   => __( 'تعرّف على طريقة الإعداد', 'novira-academy' ),
	'cognia_text'   => __( 'برنامج معتمد من Cognia', 'novira-academy' ),
	'cognia_logo'   => '',
	'image'         => '',
	'image_alt'     => '',
	'stats_title'   => '',
	'stats_sub'     => '',
) );
$icon = novira_premium_exam_icons();
$flag = novira_premium_exam_flag( 'est-hero__flag' );
?>
<section class="est-hero" aria-labelledby="pex-hero-title">
	<div class="est-hero__grid-overlay" aria-hidden="true"></div>
	<div class="est-wrap est-hero__grid">
		<div class="est-hero__text">
			<span class="est-hero__badge"><?php echo $icon['cap']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_html( $a['badge'] ); ?></span>
			<h1 class="est-hero__title" id="pex-hero-title">
				<span class="est-hero__mark"><?php echo esc_html( $a['mark'] ); ?><i class="est-hero__stroke" aria-hidden="true"></i></span>
				<span class="est-hero__sub"><?php echo esc_html( $a['sub'] ); ?></span>
			</h1>
			<p class="est-hero__desc"><?php echo esc_html( $a['desc'] ); ?></p>
			<?php if ( $a['cognia_logo'] ) : ?>
				<div class="est-hero__cognia">
					<img src="<?php echo esc_url( $a['cognia_logo'] ); ?>" alt="<?php esc_attr_e( 'اعتماد Cognia', 'novira-academy' ); ?>" width="34" height="34" loading="eager" decoding="async">
					<span><?php echo esc_html( $a['cognia_text'] ); ?></span>
				</div>
			<?php endif; ?>
			<div class="est-hero__actions">
				<a class="est-btn est-btn--primary" href="<?php echo esc_url( $a['wa_url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo $icon['whatsapp']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_html( $a['primary_label'] ); ?></a>
				<a class="est-btn est-btn--ghost" href="<?php echo esc_url( $a['ghost_href'] ); ?>"><?php echo esc_html( $a['ghost_label'] ); ?></a>
			</div>
		</div>

		<div class="est-hero__visual">
			<div class="est-hero__visual-inner">
				<div class="est-hero__card">
					<img src="<?php echo esc_url( $a['image'] ); ?>" alt="<?php echo esc_attr( $a['image_alt'] ); ?>" width="640" height="800" loading="eager" decoding="async" fetchpriority="high">
					<span class="est-hero__card-flag" aria-hidden="true"><?php echo $flag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				</div>

				<div class="est-hero__stats-card">
					<span class="est-hero__stats-icon"><?php echo $icon['target']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div class="est-hero__stats-text">
						<b><?php echo esc_html( $a['stats_title'] ); ?></b>
						<small><?php echo esc_html( $a['stats_sub'] ); ?></small>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
