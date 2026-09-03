<?php
/**
 * Template Part: Education Department
 *
 * Displays education department programs and courses.
 * Uses WordPress custom fields for content.
 *
 * Constitution: Real Content Before Decorative Design
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get custom field data
$programs = get_post_meta( get_the_ID(), '_education_programs', true );
$courses  = get_post_meta( get_the_ID(), '_education_courses', true );

// Fallback data if no custom fields
if ( empty( $programs ) ) {
	$programs = array(
		array(
			'title'       => __( 'كورس اللغة الإنجليزية', 'novira-academy' ),
			'description' => __( 'تعلم اللغة الإنجليزية من الصفر إلى الاحتراف مع مدربيين معتمدين دولياً.', 'novira-academy' ),
			'duration'    => __( '3 أشهر', 'novira-academy' ),
			'requirements' => array(
				__( 'لا توجد متطلبات مسبقة', 'novira-academy' ),
				__( 'الحضور المنتظم', 'novira-academy' ),
			),
		),
		array(
			'title'       => __( 'تطوير المهارات المهنية', 'novira-academy' ),
			'description' => __( 'برامج تطوير مهارات متخصصة في التسويق، الإدار، والقيادة.', 'novira-academy' ),
			'duration'    => __( 'شهرين', 'novira-academy' ),
			'requirements' => array(
				__( 'خبرة في مجال العمل', 'novira-academy' ),
				__( 'إتقان أساسيات اللغة الإنجليزية', 'novira-academy' ),
			),
		),
	);
}

if ( empty( $courses ) ) {
	$courses = array(
		array(
			'title'       => __( 'English for Beginners', 'novira-academy' ),
			'description' => __( 'دورة شاملة للمبتدئين تشمل القراءة والكتابة والاستماع والتحدث.', 'novira-academy' ),
			'schedule'    => __( 'الأحد - الثلاثاء - الخميس | 6:00 - 8:00 مساءً', 'novira-academy' ),
		),
		array(
			'title'       => __( 'Business English', 'novira-academy' ),
			'description' => __( 'دورة متقدمة للإنجليزية التجارية تشمل المقابلات والعروض التقديمية.', 'novira-academy' ),
			'schedule'    => __( 'الاثنين - الأربعاء | 7:00 - 9:00 مساءً', 'novira-academy' ),
		),
	);
}
?>

<section id="programs" class="education-department section" aria-label="<?php esc_attr_e( 'برامج التعليم', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'البرامج التعليمية', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'برامجنا التعليمية المتميزة', 'novira-academy' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'نقدم مجموعة متنوعة من البرامج التعليمية المصممة لتلبية احتياجات الطلاب والمحترفين.', 'novira-academy' ); ?></p>
		</div>

		<div class="programs-grid">
			<?php foreach ( $programs as $program ) : ?>
				<?php get_template_part( 'template-parts/content/program-card', null, $program ); ?>
			<?php endforeach; ?>
		</div>

		<div class="section-header" id="courses">
			<span class="section-tag"><?php esc_html_e( 'الكورسات', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'كورساتنا التدريبية', 'novira-academy' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'كورسات قصيرة ومكثفة لتحقيق أهدافك التعليمية في أسرع وقت.', 'novira-academy' ); ?></p>
		</div>

		<div class="courses-grid">
			<?php foreach ( $courses as $course ) : ?>
				<?php get_template_part( 'template-parts/content/course-card', null, $course ); ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>
