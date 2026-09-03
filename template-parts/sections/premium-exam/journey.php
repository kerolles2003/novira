<?php
/**
 * Premium Exam — Learning Journey (shared component).
 *
 * A compact, visual path of the student's LEARNING STAGES from assessment to
 * the official exam. Distinct from the process stepper (premium-exam/stepper.php):
 * the stepper details the operational method (what the academy does each step);
 * this journey shows the student's educational ARC (the phases they progress
 * through). EDUCATIONAL STAGES ONLY — no timings, no dates, no invented numbers.
 *
 * Reusable across every exam spoke: the default stages describe a preparation
 * arc that is true for EST, Digital SAT, and ACT alike, so a spoke gets the
 * journey for free; pass `stages` to override. Reuses the premium tokens and
 * .est-* system; styles in premium-exam.css. No JavaScript.
 *
 * @param array $args {
 *   @type string $anchor  Section id.
 *   @type string $eyebrow Section eyebrow.
 *   @type string $title   Heading.
 *   @type string $desc    Section intro.
 *   @type array  $stages  [ [ 'i' => icon-key, 'label' => string, 'caption' => string ], ... ].
 * }
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$icon = function_exists( 'novira_premium_exam_icons' ) ? novira_premium_exam_icons() : array();

$a = wp_parse_args( isset( $args ) ? $args : array(), array(
	'anchor'  => 'journey',
	'eyebrow' => __( 'رحلة التعلّم', 'novira-academy' ),
	'title'   => __( 'رحلة طالبك من التقييم إلى الاختبار', 'novira-academy' ),
	'desc'    => __( 'مسار تعليمي متدرّج — كل مرحلة تبني على ما قبلها حتى يدخل طالبك الاختبار مستعداً فعلاً.', 'novira-academy' ),
	// Default educational stages (no timings). True for every exam spoke.
	'stages'  => array(
		array( 'i' => 'clipboard', 'label' => __( 'التقييم', 'novira-academy' ),           'caption' => __( 'نحدّد مستوى طالبك الحالي ونقطة انطلاقه.', 'novira-academy' ) ),
		array( 'i' => 'cap',       'label' => __( 'التأسيس', 'novira-academy' ),           'caption' => __( 'نبني الأساس المتين في المهارات التي يقيسها الاختبار.', 'novira-academy' ) ),
		array( 'i' => 'calendar',  'label' => __( 'البناء التراكمي', 'novira-academy' ),    'caption' => __( 'نمو أسبوعي متواصل مع معلمين متخصصين.', 'novira-academy' ) ),
		array( 'i' => 'target',    'label' => __( 'الجاهزية والمحاكاة', 'novira-academy' ), 'caption' => __( 'اختبارات تجريبية تُحاكي ظروف يوم الامتحان.', 'novira-academy' ) ),
		array( 'i' => 'trophy',    'label' => __( 'الاختبار الرسمي', 'novira-academy' ),     'caption' => __( 'يتقدّم طالبك مستعداً لأعلى درجة ممكنة.', 'novira-academy' ) ),
	),
) );

$eyebrow_i = isset( $icon['route'] ) ? $icon['route'] : '';
$stages    = array_values( array_filter( (array) $a['stages'], function ( $s ) {
	return ! empty( $s['label'] );
} ) );
if ( empty( $stages ) ) {
	return;
}
$total = count( $stages );
?>
<section class="est-journey" id="<?php echo esc_attr( $a['anchor'] ); ?>" aria-labelledby="pex-journey-title">
	<div class="est-wrap">
		<div class="est-section-head est-reveal">
			<span class="est-eyebrow"><?php echo $eyebrow_i; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_html( $a['eyebrow'] ); ?></span>
			<h2 id="pex-journey-title"><?php echo esc_html( $a['title'] ); ?></h2>
			<?php if ( '' !== (string) $a['desc'] ) : ?>
				<p><?php echo esc_html( $a['desc'] ); ?></p>
			<?php endif; ?>
		</div>

		<ol class="pex-journey est-reveal">
			<?php foreach ( $stages as $n => $stage ) : ?>
				<li class="pex-journey__stage">
					<span class="pex-journey__marker">
						<span class="pex-journey__icon"><?php echo isset( $icon[ $stage['i'] ] ) ? $icon[ $stage['i'] ] : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<span class="pex-journey__step" aria-hidden="true"><?php echo esc_html( $n + 1 ); ?></span>
					</span>
					<span class="pex-journey__body">
						<span class="pex-journey__label"><?php echo esc_html( $stage['label'] ); ?></span>
						<?php if ( ! empty( $stage['caption'] ) ) : ?>
							<span class="pex-journey__caption"><?php echo esc_html( $stage['caption'] ); ?></span>
						<?php endif; ?>
					</span>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
