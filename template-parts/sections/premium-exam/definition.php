<?php
/**
 * Premium Exam — "What is this exam?" definition section (shared component).
 *
 * Answers the parent's FIRST question ("What is EST?") in one place, before the
 * preparation journey. Content is single-sourced from novira_exam_meta():
 * `definition` (authoritative, what the exam is) and `purpose` (why the score
 * matters). The optional `sections` list makes "what it measures" concrete and
 * scannable. Reusable across every exam spoke — EST, Digital SAT, ACT — with
 * different datasets only. Reuses the premium design system (.est-wrap,
 * .est-section-head, .est-eyebrow, .est-reveal, --est-* tokens); styles live in
 * premium-exam.css. No JavaScript.
 *
 * @param array $args {
 *   @type string $anchor         Section id (for in-page nav).
 *   @type string $eyebrow        Section eyebrow.
 *   @type string $title          Heading ("ما هو اختبار EST؟").
 *   @type string $definition     Authoritative definition paragraph.
 *   @type string $purpose        Why the score matters (secondary paragraph).
 *   @type string $measures_label Label above the skills list.
 *   @type array  $sections       Skill areas the exam measures (strings).
 * }
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$a = wp_parse_args( isset( $args ) ? $args : array(), array(
	'anchor'         => 'about',
	'eyebrow'        => '',
	'title'          => '',
	'definition'     => '',
	'purpose'        => '',
	'measures_label' => __( 'يقيس الاختبار', 'novira-academy' ),
	'sections'       => array(),
) );

// Nothing authoritative to show → render nothing (never an empty shell).
if ( '' === (string) $a['definition'] && '' === (string) $a['purpose'] ) {
	return;
}

$icon      = function_exists( 'novira_premium_exam_icons' ) ? novira_premium_exam_icons() : array();
$eyebrow_i = isset( $icon['file'] ) ? $icon['file'] : '';
$check_i   = isset( $icon['check'] ) ? $icon['check'] : '';
$sections  = array_values( array_filter( (array) $a['sections'], 'strlen' ) );
?>
<section class="est-about" id="<?php echo esc_attr( $a['anchor'] ); ?>" aria-labelledby="pex-about-title">
	<div class="est-wrap">
		<div class="est-section-head est-reveal">
			<span class="est-eyebrow"><?php echo $eyebrow_i; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_html( $a['eyebrow'] ); ?></span>
			<h2 id="pex-about-title"><?php echo esc_html( $a['title'] ); ?></h2>
		</div>

		<div class="est-about__grid">
			<div class="est-about__copy est-reveal">
				<?php if ( '' !== (string) $a['definition'] ) : ?>
					<p class="est-about__lead"><?php echo esc_html( $a['definition'] ); ?></p>
				<?php endif; ?>
				<?php if ( '' !== (string) $a['purpose'] ) : ?>
					<p class="est-about__note"><?php echo esc_html( $a['purpose'] ); ?></p>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $sections ) ) : ?>
				<aside class="est-about__measures est-reveal est-reveal--scale" aria-label="<?php echo esc_attr( $a['measures_label'] ); ?>">
					<h3 class="est-about__measures-title"><?php echo esc_html( $a['measures_label'] ); ?></h3>
					<ul class="est-about__list" role="list">
						<?php foreach ( $sections as $section ) : ?>
							<li><span class="est-check"><?php echo $check_i; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><?php echo esc_html( $section ); ?></li>
						<?php endforeach; ?>
					</ul>
				</aside>
			<?php endif; ?>
		</div>
	</div>
</section>
