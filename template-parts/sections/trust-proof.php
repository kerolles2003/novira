<?php
/**
 * Template Part: Trust Proof Section
 *
 * ⚠️ LEGACY — NOT RENDERED. Not included by any template; superseded on the
 * homepage by testimonials-stitch.php (real Google reviews). Its hardcoded
 * fallbacks contain invented testimonials and unverified counters
 * (+500 طالب / +10 سنوات خبرة), which violate the Real Content rule. Kept in
 * the repo intentionally (do not delete); do NOT re-enable unless every field
 * is gated to real admin data with no fallback. See docs/ux-writing-rewrite-4.2.W.md §7.
 *
 * Homepage section displaying testimonials.
 * Uses a filter to allow plugins to register testimonials dynamically.
 *
 * Constitution: Trust Before Conversion, Real Content
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter testimonials for the trust-proof section.
 *
 * Plugins can override this filter to provide testimonials from a CPT or other source.
 * Default: queries pages with 'testimonial' page template.
 *
 * @param array $testimonials Array of testimonial data arrays.
 */
$testimonials = apply_filters( 'novira_homepage_testimonials', array() );

// If no testimonials provided by filter, query pages with testimonial template
if ( empty( $testimonials ) ) {
	$testimonial_query = new WP_Query( array(
		'post_type'      => 'page',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
		'meta_key'       => '_wp_page_template',
		'meta_value'     => 'testimonial',
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	) );

	if ( $testimonial_query->have_posts() ) {
		while ( $testimonial_query->have_posts() ) {
			$testimonial_query->the_post();
			$testimonials[] = array(
				'quote'    => get_the_excerpt(),
				'author'   => get_the_title(),
				'role'     => get_post_meta( get_the_ID(), '_testimonial_role', true ),
				'avatar'   => get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ),
			);
		}
		wp_reset_postdata();
	}
}

// Fallback: static testimonials if no dynamic content exists
if ( empty( $testimonials ) ) {
	$testimonials = array(
		array(
			'quote'    => __( 'أكاديمية نوفيرا غيّرت مسار حياتي. تعلمت اللغة الإنجليزية بشكل احترافي وأصبحت قادرة على التواصل في بيئة العمل الدولي.', 'novira-academy' ),
			'author'   => __( 'سارة أحمد', 'novira-academy' ),
			'role'     => __( 'طالبة سابقة - كورس الإنجليزية', 'novira-academy' ),
			'avatar'   => '',
		),
		array(
			'quote'    => __( 'خدمة التترجمة المعتمدة كانت ممتازة. تم ترجمة وثائقي رسمياً بدقة عالية وفي الوقت المحدد.', 'novira-academy' ),
			'author'   => __( 'محمد علي', 'novira-academy' ),
			'role'     => __( 'عميل - الترجمة المعتمدة', 'novira-academy' ),
			'avatar'   => '',
		),
		array(
			'quote'    => __( 'ابني يدرس في البرنامج الأمريكي ويتحسن أداؤه أكاديمياً. المنهاج عصري والمعلمون متميزون.', 'novira-academy' ),
			'author'   => __( 'فاطمة خالد', 'novira-academy' ),
			'role'     => __( 'ولي أمر - الدبلوم الأمريكي', 'novira-academy' ),
			'avatar'   => '',
		),
	);
}
?>

<section id="trust-proof" class="trust-proof-section section" aria-label="<?php esc_attr_e( 'شهادات طلابنا', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'قصص نجاح', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'ماذا يقول طلابنا وشركاؤنا', 'novira-academy' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'نفخر بقصص نجاح طلابنا وثقة شركائنا في خدماتنا التعليمية والمهنية.', 'novira-academy' ); ?></p>
		</div>

		<div class="testimonials-grid">
			<?php foreach ( $testimonials as $testimonial ) : ?>
				<?php get_template_part( 'template-parts/content/testimonial', null, $testimonial ); ?>
			<?php endforeach; ?>
		</div>

		<div class="trust-badges">
			<div class="badge-item">
				<span class="badge-icon" aria-hidden="true">
					<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
						<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
					</svg>
				</span>
				<span class="badge-text"><?php esc_html_e( 'مؤسسة معتمدة', 'novira-academy' ); ?></span>
			</div>
			<div class="badge-item">
				<span class="badge-icon" aria-hidden="true">
					<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
						<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
						<circle cx="9" cy="7" r="4"/>
						<path d="M23 21v-2a4 4 0 00-3-3.87"/>
						<path d="M16 3.13a4 4 0 010 7.75"/>
					</svg>
				</span>
				<span class="badge-text"><?php esc_html_e( '+500 طالب', 'novira-academy' ); ?></span>
			</div>
			<div class="badge-item">
				<span class="badge-icon" aria-hidden="true">
					<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
						<path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
						<path d="M22 4L12 14.01l-3-3"/>
					</svg>
				</span>
				<span class="badge-text"><?php esc_html_e( '+10 سنوات خبرة', 'novira-academy' ); ?></span>
			</div>
		</div>
	</div>
</section>
