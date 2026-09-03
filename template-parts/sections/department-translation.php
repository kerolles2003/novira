<?php
/**
 * Template Part: Translation Department
 *
 * Displays translation services, pricing, and quote request form.
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
$services = get_post_meta( get_the_ID(), '_translation_services', true );
$pricing  = get_post_meta( get_the_ID(), '_translation_pricing', true );

// Fallback data if no custom fields
if ( empty( $services ) ) {
	$services = array(
		array(
			'type'        => __( 'ترجمة عادية', 'novira-academy' ),
			'description' => __( 'ترجمة مستندات رسمية ومعاملات تجارية بدقة عالية.', 'novira-academy' ),
			'turnaround'  => __( '3-5 أيام عمل', 'novira-academy' ),
		),
		array(
			'type'        => __( 'ترجمة معتمدة', 'novira-academy' ),
			'description' => __( 'ترجمة معتمدة رسمياً للسفارات والجهات الحكومية.', 'novira-academy' ),
			'turnaround'  => __( '5-7 أيام عمل', 'novira-academy' ),
		),
		array(
			'type'        => __( 'ترجمة عاجلة', 'novira-academy' ),
			'description' => __( 'ترجمة مستندات عاجلة خلال 24 ساعة.', 'novira-academy' ),
			'turnaround'  => __( '24 ساعة', 'novira-academy' ),
		),
	);
}

if ( empty( $pricing ) ) {
	$pricing = array(
		array(
			'service'   => __( 'ترجمة عادية', 'novira-academy' ),
			'price'     => __( 'من 100 جنيه لكل صفحة', 'novira-academy' ),
			'includes'  => array(
				__( 'ترجمة دقيقة', 'novira-academy' ),
				__( 'مراجعة لغوية', 'novira-academy' ),
				__( 'نسخة إلكترونية', 'novira-academy' ),
			),
		),
		array(
			'service'   => __( 'ترجمة معتمدة', 'novira-academy' ),
			'price'     => __( 'من 150 جنيه لكل صفحة', 'novira-academy' ),
			'includes'  => array(
				__( 'ترجمة معتمدة', 'novira-academy' ),
				__( 'ختم رسمي', 'novira-academy' ),
				__( 'نسخة إلكترونية وورقية', 'novira-academy' ),
			),
		),
	);
}
?>

<section id="services" class="translation-department section" aria-label="<?php esc_attr_e( 'خدمات الترجمة', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'خدماتنا', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'خدمات الترجمة المعتمدة', 'novira-academy' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'نقدم خدمات ترجمة احترافية ومعتمدة لتلبية احتياجاتك الرسمية والتجارية.', 'novira-academy' ); ?></p>
		</div>

		<div class="services-grid">
			<?php foreach ( $services as $service ) : ?>
				<?php get_template_part( 'template-parts/content/service-card', null, $service ); ?>
			<?php endforeach; ?>
		</div>

		<div class="section-header" id="pricing">
			<span class="section-tag"><?php esc_html_e( 'الأسعار', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'جدول الأسعار', 'novira-academy' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'أسعار تنافسية مع ضمان الجودة والدقة.', 'novira-academy' ); ?></p>
		</div>

		<?php get_template_part( 'template-parts/components/pricing-table', null, array( 'pricing' => $pricing ) ); ?>

		<div class="section-header" id="quote">
			<span class="section-tag"><?php esc_html_e( 'طلب عرض سعر', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'احصل على عرض سعر مجاني', 'novira-academy' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'املأ النموذج أدناه وسنرد عليك خلال ساعة.', 'novira-academy' ); ?></p>
		</div>

		<?php get_template_part( 'template-parts/components/quote-request-form' ); ?>
	</div>
</section>
