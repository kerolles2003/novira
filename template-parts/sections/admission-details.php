<?php
/**
 * Template Part: Admission Details
 *
 * Displays admission requirements and process for departments.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get department-specific admission data
$slug = get_post_field( 'post_name', get_the_ID() );

$admission_data = array(
	'education' => array(
		'title'      => __( 'متطلبات القبول', 'novira-academy' ),
		'steps'      => array(
			array(
				'title'       => __( 'التقديم', 'novira-academy' ),
				'description' => __( 'املأ نموذج التسجيل عبر الإنترنت أو قم بزيارة الأكاديمية.', 'novira-academy' ),
			),
			array(
				'title'       => __( 'المقابلة', 'novira-academy' ),
				'description' => __( 'مقابلة شخصية لتحديد مستوى الطالب وأهدافه.', 'novira-academy' ),
			),
			array(
				'title'       => __( 'التسجيل', 'novira-academy' ),
				'description' => __( 'دفع الرسوم والتسجيل في البرنامج المناسب.', 'novira-academy' ),
			),
		),
		'deadlines' => array(
			__( 'التسجيل مفتوح على مدار العام', 'novira-academy' ),
			__( 'تبدأ الدورات الجديدة كل 3 أشهر', 'novira-academy' ),
		),
	),
	'translation' => array(
		'title'      => __( 'كيف تطلب خدمة الترجمة', 'novira-academy' ),
		'steps'      => array(
			array(
				'title'       => __( 'إرسال المستندات', 'novira-academy' ),
				'description' => __( 'أرسل المستندات المراد ترجمتها عبر البريد الإلكتروني أو واتساب.', 'novira-academy' ),
			),
			array(
				'title'       => __( 'تقديم العرض', 'novira-academy' ),
				'description' => __( 'نرسل لك عرض سعر وجدول زمني للترجمة.', 'novira-academy' ),
			),
			array(
				'title'       => __( 'الاستلام', 'novira-academy' ),
				'description' => __( 'استلام المستندات المترجمة معتمدة وختم رسمي.', 'novira-academy' ),
			),
		),
		'deadlines' => array(
			__( 'ترجمة عادية: 3-5 أيام عمل', 'novira-academy' ),
			__( 'ترجمة عاجلة: 24 ساعة', 'novira-academy' ),
		),
	),
	'american-diploma' => array(
		'title'      => __( 'شروط القبول في الدبلوم الأمريكي', 'novira-academy' ),
		'steps'      => array(
			array(
				'title'       => __( 'طلب الالتحاق', 'novira-academy' ),
				'description' => __( 'تقديم طلب الالتحاق مع المستندات المطلوبة.', 'novira-academy' ),
			),
			array(
				'title'       => __( 'اختبار القبول', 'novira-academy' ),
				'description' => __( 'اختبار لتحديد المستوى الأكاديمي للطالب.', 'novira-academy' ),
			),
			array(
				'title'       => __( 'القبول', 'novira-academy' ),
				'description' => __( 'استلام خط القبول وبدء إجراءات التسجيل.', 'novira-academy' ),
			),
		),
		'deadlines' => array(
			__( 'الfall semester: أغسطس', 'novira-academy' ),
			__( 'الspring semester: يناير', 'novira-academy' ),
		),
	),
);

$data = isset( $admission_data[ $slug ] ) ? $admission_data[ $slug ] : $admission_data['education'];
?>

<section id="admission" class="admission-details section" aria-label="<?php echo esc_attr( $data['title'] ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'القبول والتسجيل', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php echo esc_html( $data['title'] ); ?></h2>
		</div>

		<div class="admission-content">
			<div class="admission-steps">
				<h3 class="steps-title"><?php esc_html_e( 'خطوات التسجيل', 'novira-academy' ); ?></h3>
				<ol class="steps-list">
					<?php foreach ( $data['steps'] as $index => $step ) : ?>
						<li class="step-item">
							<span class="step-number" aria-hidden="true"><?php echo esc_html( $index + 1 ); ?></span>
							<div class="step-content">
								<h4 class="step-title"><?php echo esc_html( $step['title'] ); ?></h4>
								<p class="step-description"><?php echo esc_html( $step['description'] ); ?></p>
							</div>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>

			<div class="admission-info">
				<h3 class="info-title"><?php esc_html_e( 'مواعيد مهمة', 'novira-academy' ); ?></h3>
				<ul class="info-list">
					<?php foreach ( $data['deadlines'] as $deadline ) : ?>
						<li>
							<span class="info-icon" aria-hidden="true">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
									<path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
									<path d="M22 4L12 14.01l-3-3"/>
								</svg>
							</span>
							<?php echo esc_html( $deadline ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</section>
