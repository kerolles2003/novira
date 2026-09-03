<?php
/**
 * Premium Exam — Courses catalog section (shared component, Sprint 4.3.6).
 *
 * The official academic course catalog for every exam spoke. Courses come from
 * novira_exam_courses($exam) (inc/exam-courses.php), filtered by the current
 * exam, so EST shows only EST courses, Digital SAT only its own, etc. — from one
 * dataset. Reuses the premium design system verbatim: `.est-wrap`,
 * `.est-section-head`, `.est-eyebrow`, `.est-reveal`, and the `--est-*` tokens
 * (card styling in assets/css/exam-courses.css). No hardcoded cards, no per-exam
 * markup, no new visual language.
 *
 * Each card carries: image, title, optional level chip (e.g. "EST 1"), ONE
 * concise line, related-exam chips, an expandable details disclosure (native
 * <details> — full educational description, keyboard-accessible, zero JS), and a
 * single explicit CTA link. Adding AP later needs only data (see the provider).
 *
 * @param array $args {
 *   @type string $exam      Exam slug (defaults to the current spoke).
 *   @type string $eyebrow   Section eyebrow.
 *   @type string $title     Section heading (answers "what will my child study?").
 *   @type string $desc      Section intro.
 *   @type string $cta_label Standardized CTA on every card.
 *   @type string $wa_url    Fallback link for courses without a detail page yet.
 * }
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$a = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'exam'      => function_exists( 'novira_current_exam_slug' ) ? novira_current_exam_slug() : '',
		'eyebrow'   => __( 'الكورسات الدراسية', 'novira-academy' ),
		'title'     => __( 'ما الذي سيدرسه طالبك؟', 'novira-academy' ),
		'desc'      => '',
		'cta_label' => __( 'اطلب الكورس', 'novira-academy' ),
		'wa_url'    => '#',
		// WhatsApp prefill; %s is replaced with the course name, e.g.
		// "عايز اشترك في كورس (الرياضيات — المستوى الأول — EST)".
		'wa_message'=> __( 'عايز اشترك في كورس (%s)', 'novira-academy' ),
	)
);

$courses = function_exists( 'novira_exam_courses' ) ? novira_exam_courses( $a['exam'] ) : array();
if ( empty( $courses ) ) {
	return; // No courses for this exam — render nothing (never an empty shell).
}

$icons     = function_exists( 'novira_premium_exam_icons' ) ? novira_premium_exam_icons() : array();
$eyebrow_i = isset( $icons['cap'] ) ? $icons['cap'] : '';
$wa_icon   = isset( $icons['whatsapp'] ) ? $icons['whatsapp'] : '';
$chevron   = '<svg class="pex-course__chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>';
$has_msg   = false !== strpos( (string) $a['wa_message'], '%s' );
?>
<section class="est-courses" aria-labelledby="pex-courses-title">
	<div class="est-wrap">
		<div class="est-section-head est-reveal">
			<span class="est-eyebrow"><?php echo $eyebrow_i; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_html( $a['eyebrow'] ); ?></span>
			<h2 id="pex-courses-title"><?php echo esc_html( $a['title'] ); ?></h2>
			<?php if ( ! empty( $a['desc'] ) ) : ?>
				<p><?php echo esc_html( $a['desc'] ); ?></p>
			<?php endif; ?>
		</div>

		<ul class="pex-courses" role="list">
			<?php
			foreach ( $courses as $index => $course ) :
				$title    = isset( $course['title_display'] ) ? $course['title_display'] : $course['title'];
				$has_url  = ! empty( $course['url'] );
				$wa_name  = isset( $course['wa_name'] ) ? $course['wa_name'] : $title;
				$level    = isset( $course['level_label'] ) ? $course['level_label'] : '';
				$details  = isset( $course['details'] ) ? $course['details'] : '';

				if ( $has_url ) {
					// A real course-detail page exists — link straight to it.
					$href = $course['url'];
				} else {
					// No detail page yet: open WhatsApp with a course-specific message
					// auto-filled, e.g. "عايز اشترك في كورس (الرياضيات — المستوى الأول — EST)".
					$msg  = $has_msg ? sprintf( $a['wa_message'], $wa_name ) : $a['wa_message'];
					$href = $a['wa_url'] . ( false === strpos( $a['wa_url'], '?' ) ? '?' : '&' ) . 'text=' . rawurlencode( $msg );
				}
				$cta_icon = $has_url ? $chevron : $wa_icon;
				?>
				<li class="pex-course est-reveal">
					<article class="pex-course__card">
						<span class="pex-course__media">
							<img src="<?php echo esc_url( $course['image'] ); ?>" alt="<?php echo esc_attr( $title ); ?>" width="480" height="300" loading="lazy" decoding="async">
							<?php if ( '' !== $level ) : ?>
								<span class="pex-course__level"><?php echo esc_html( $level ); ?></span>
							<?php endif; ?>
						</span>
						<div class="pex-course__body">
							<h3 class="pex-course__title"><?php echo esc_html( $title ); ?></h3>
							<p class="pex-course__desc"><?php echo esc_html( $course['desc'] ); ?></p>

							<?php if ( ! empty( $course['also_for'] ) ) : ?>
								<span class="pex-course__exams">
									<span class="pex-course__exams-label"><?php esc_html_e( 'متاح أيضاً لـ', 'novira-academy' ); ?></span>
									<?php foreach ( $course['also_for'] as $other_label ) : ?>
										<span class="pex-course__exam"><?php echo esc_html( $other_label ); ?></span>
									<?php endforeach; ?>
								</span>
							<?php endif; ?>

							<?php if ( '' !== $details ) : ?>
								<details class="pex-course__details">
									<summary class="pex-course__summary">
										<span><?php esc_html_e( 'تفاصيل الكورس', 'novira-academy' ); ?></span>
										<span class="pex-course__summary-chev" aria-hidden="true"></span>
									</summary>
									<div class="pex-course__details-body"><p><?php echo esc_html( $details ); ?></p></div>
								</details>
							<?php endif; ?>

							<a class="pex-course__cta<?php echo $has_url ? '' : ' pex-course__cta--wa'; ?>"
								href="<?php echo esc_url( $href ); ?>"
								<?php echo $has_url ? '' : 'target="_blank" rel="noopener noreferrer"'; ?>
								aria-label="<?php echo esc_attr( $a['cta_label'] . '؛ ' . $title ); ?>">
								<?php echo $cta_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <span><?php echo esc_html( $a['cta_label'] ); ?></span>
							</a>
						</div>
					</article>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
