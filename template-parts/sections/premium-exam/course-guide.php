<?php
/**
 * Premium Exam — "Which course is right for my child?" (shared component).
 *
 * A data-driven matcher that helps a parent see which course fits which
 * student. Rows come from novira_exam_course_guidance($exam) (a real student
 * situation → a course slug); the course title and level chip are resolved from
 * novira_exam_courses($exam), so the guidance can never drift from the catalog.
 * Reusable across every exam spoke — EST, Digital SAT, ACT — data only. Reuses
 * the premium design system (.est-wrap, .est-section-head, .est-eyebrow,
 * .est-reveal, --est-* tokens); styles in premium-exam.css. No JavaScript.
 *
 * Item 4: the closing note clarifies that course DURATION depends on the
 * student's assessment and academic plan — no numbers are invented.
 *
 * @param array $args {
 *   @type string $exam    Exam slug (defaults to the current spoke).
 *   @type string $anchor  Section id.
 *   @type string $eyebrow Section eyebrow.
 *   @type string $title   Heading ("أي كورس يناسب طالبك؟").
 *   @type string $desc    Section intro.
 *   @type string $note    Duration-depends-on-assessment clarification.
 * }
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$a = wp_parse_args( isset( $args ) ? $args : array(), array(
	'exam'    => function_exists( 'novira_current_exam_slug' ) ? novira_current_exam_slug() : '',
	'anchor'  => 'course-guide',
	'eyebrow' => __( 'اختيار الكورس', 'novira-academy' ),
	'title'   => __( 'أي كورس يناسب طالبك؟', 'novira-academy' ),
	'desc'    => '',
	'note'    => __( 'مدة كل كورس تُحدَّد حسب نتيجة التقييم المبدئي وخطة طالبك الدراسية — لا مقاس واحد يناسب الجميع.', 'novira-academy' ),
) );

$rows = function_exists( 'novira_exam_course_guidance' ) ? novira_exam_course_guidance( $a['exam'] ) : array();
if ( empty( $rows ) ) {
	return; // No guidance for this exam yet — render nothing (never an empty shell).
}

// Index this exam's courses by slug so each row resolves its title + level chip.
$courses_by_slug = array();
if ( function_exists( 'novira_exam_courses' ) ) {
	foreach ( novira_exam_courses( $a['exam'] ) as $course ) {
		if ( ! empty( $course['slug'] ) ) {
			$courses_by_slug[ $course['slug'] ] = $course;
		}
	}
}

$icon      = function_exists( 'novira_premium_exam_icons' ) ? novira_premium_exam_icons() : array();
$eyebrow_i = isset( $icon['route'] ) ? $icon['route'] : '';
$arrow     = '<svg class="pex-guide__arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>';
?>
<section class="est-guide" id="<?php echo esc_attr( $a['anchor'] ); ?>" aria-labelledby="pex-guide-title">
	<div class="est-wrap">
		<div class="est-section-head est-reveal">
			<span class="est-eyebrow"><?php echo $eyebrow_i; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_html( $a['eyebrow'] ); ?></span>
			<h2 id="pex-guide-title"><?php echo esc_html( $a['title'] ); ?></h2>
			<?php if ( '' !== (string) $a['desc'] ) : ?>
				<p><?php echo esc_html( $a['desc'] ); ?></p>
			<?php endif; ?>
		</div>

		<ul class="pex-guide" role="list">
			<?php
			foreach ( $rows as $row ) :
				$course_slug = isset( $row['course'] ) ? $row['course'] : '';
				if ( '' === $course_slug || ! isset( $courses_by_slug[ $course_slug ] ) ) {
					continue; // Skip a row whose course isn't offered for this exam.
				}
				$course = $courses_by_slug[ $course_slug ];
				$c_name = ! empty( $course['title'] ) ? $course['title'] : ( isset( $course['title_display'] ) ? $course['title_display'] : '' );
				$level  = isset( $course['level_label'] ) ? $course['level_label'] : '';
				?>
				<li class="pex-guide__row est-reveal">
					<span class="pex-guide__for"><?php echo esc_html( $row['for'] ); ?></span>
					<?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span class="pex-guide__course">
						<?php echo esc_html( $c_name ); ?>
						<?php if ( '' !== $level ) : ?>
							<span class="pex-guide__level"><?php echo esc_html( $level ); ?></span>
						<?php endif; ?>
					</span>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php if ( '' !== (string) $a['note'] ) : ?>
			<p class="pex-guide__note est-reveal">
				<span class="pex-guide__note-ico" aria-hidden="true"><?php echo isset( $icon['pulse'] ) ? $icon['pulse'] : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<?php echo esc_html( $a['note'] ); ?>
			</p>
		<?php endif; ?>
	</div>
</section>
