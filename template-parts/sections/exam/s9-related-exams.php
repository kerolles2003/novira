<?php
/**
 * Exam Spoke — S9 Related Exams (navigation bridge)
 *
 * Eliminates the dead-end after the consultation section. Links back to the
 * American Diploma Hub and surfaces the other offered exam spokes (excluding
 * the current page). Driven entirely by novira_diploma_offered_programs() —
 * no hardcoded exam names. When AP launches, it appears automatically.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$meta = isset( $args['meta'] ) ? $args['meta'] : null;
if ( ! $meta || ! function_exists( 'novira_diploma_offered_programs' ) ) {
	return;
}

$current_slug = $meta['page_slug'];
$other_exams  = array_values(
	array_filter(
		novira_diploma_offered_programs(),
		static function ( $program ) use ( $current_slug ) {
			return $program['page_slug'] !== $current_slug;
		}
	)
);

if ( empty( $other_exams ) ) {
	return;
}
?>
<section class="section exam-related" aria-label="<?php esc_attr_e( 'اختبارات أخرى', 'novira-academy' ); ?>">
	<div class="container">

		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'اختبارات الدبلومة', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'استكشف اختبارات أخرى', 'novira-academy' ); ?></h2>
			<p class="section-desc"><?php esc_html_e( 'الدبلومة الأمريكية تشمل أكثر من اختبار. تعرّف على الاختبارات الأخرى التي تُعدّ لها نوفيرا.', 'novira-academy' ); ?></p>
		</div>

		<div class="exam-related__grid">
			<?php foreach ( $other_exams as $program ) : ?>
				<a class="exam-related__card value-card"
				   href="<?php echo esc_url( home_url( '/american-diploma/' . $program['page_slug'] . '/' ) ); ?>">
					<span class="exam-related__name"><?php echo esc_html( $program['name'] ); ?></span>
					<span class="exam-related__cta">
						<?php
						/* translators: %s: exam name. */
						printf( esc_html__( 'تعرّف على %s', 'novira-academy' ), esc_html( $program['name'] ) );
						?>
					</span>
				</a>
			<?php endforeach; ?>
		</div>

		<p class="exam-related__hub-link">
			<a href="<?php echo esc_url( home_url( '/american-diploma/' ) ); ?>">
				<?php esc_html_e( '← العودة إلى الدبلومة الأمريكية', 'novira-academy' ); ?>
			</a>
		</p>

	</div>
</section>
