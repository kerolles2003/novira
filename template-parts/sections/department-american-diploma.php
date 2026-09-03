<?php
/**
 * Template Part: American Diploma Department
 *
 * Displays American Diploma curriculum, admission, and registration form.
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
$curriculum    = get_post_meta( get_the_ID(), '_diploma_curriculum', true );
$admission     = get_post_meta( get_the_ID(), '_diploma_admission', true );

// Fallback data if no custom fields
if ( empty( $curriculum ) ) {
	$curriculum = array(
		array(
			'subject'    => __( 'اللغة الإنجليزية', 'novira-academy' ),
			'grades'     => __( '10-12', 'novira-academy' ),
			'hours'      => __( '5 حصص أسبوعياً', 'novira-academy' ),
			'description' => __( 'تطوير مهارات القراءة والكتابة والاستماع والتحدث بالإنجليزية.', 'novira-academy' ),
		),
		array(
			'subject'    => __( 'الرياضيات', 'novira-academy' ),
			'grades'     => __( '10-12', 'novira-academy' ),
			'hours'      => __( '4 حصص أسبوعياً', 'novira-academy' ),
			'description' => __( 'الرياضيات الأساسية المتقدمة وفق المنهج الأمريكي.', 'novira-academy' ),
		),
		array(
			'subject'    => __( 'العلوم', 'novira-academy' ),
			'grades'     => __( '10-12', 'novira-academy' ),
			'hours'      => __( '3 حصص أسبوعياً', 'novira-academy' ),
			'description' => __( 'علوم عامة مع مختبر عملي.', 'novira-academy' ),
		),
	);
}

if ( empty( $admission ) ) {
	$admission = array(
		'deadlines' => array(
			__( 'فصل الخريف: أغسطس', 'novira-academy' ),
			__( 'فصل الربيع: يناير', 'novira-academy' ),
		),
		'documents' => array(
			__( 'شهادة الميلاد', 'novira-academy' ),
			__( 'الشهادة السابقة', 'novira-academy' ),
			__( 'صور شخصية', 'novira-academy' ),
			__( 'ملء نموذج التسجيل', 'novira-academy' ),
		),
	);
}
?>

<section id="curriculum" class="american-diploma-department section" aria-label="<?php esc_attr_e( 'الدبلوم الأمريكي', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'المنهج الدراسي', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'المنهج الأمريكي المعتمد', 'novira-academy' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'نقدّم منهجاً أمريكياً معتمداً من Cognia بإعداد أكاديمي متدرّج من Grade 10 حتى Grade 12، بحصص أسبوعية ومتابعة مستمرة.', 'novira-academy' ); ?></p>
		</div>

		<div class="curriculum-grid">
			<?php foreach ( $curriculum as $subject ) : ?>
				<?php get_template_part( 'template-parts/content/curriculum', null, $subject ); ?>
			<?php endforeach; ?>
		</div>

		<div class="section-header" id="admission">
			<span class="section-tag"><?php esc_html_e( 'القبول والتسجيل', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'شروط القبول', 'novira-academy' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'معلومات مهمة حول شروط القبول والمستندات المطلوبة.', 'novira-academy' ); ?></p>
		</div>

		<?php get_template_part( 'template-parts/content/admission-process', null, $admission ); ?>

		<div class="section-header" id="register">
			<span class="section-tag"><?php esc_html_e( 'التقديم', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'سجّل الآن', 'novira-academy' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'املأ نموذج الاهتمام وسنتواصل معك لبدء إجراءات التسجيل.', 'novira-academy' ); ?></p>
		</div>

		<?php get_template_part( 'template-parts/components/registration-interest-form' ); ?>
	</div>
</section>
