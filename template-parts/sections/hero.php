<?php
/**
 * Template Part: Hero Section
 *
 * Homepage hero section with trust-building headline and real photo background.
 * Content is pulled from the front page WordPress page.
 *
 * Constitution: Trust Before Conversion, Institutional Identity
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get front page data
$front_page_id  = get_option( 'page_on_front' );
$hero_image     = '';
$hero_headline  = __( 'أكاديمية نوفيرا للتعليم الدولي والترجمة المعتمدة', 'novira-academy' );
$hero_subheadline = __( 'نبني الثقة أولاً. نقدّم محتوى حقيقي يعكس هوية المؤسسة التعليمية.', 'novira-academy' );

if ( $front_page_id ) {
	$hero_image = get_the_post_thumbnail_url( $front_page_id, 'full' );
	$title      = get_the_title( $front_page_id );
	$excerpt    = get_the_excerpt( $front_page_id );

	if ( $title ) {
		$hero_headline = $title;
	}
	if ( $excerpt ) {
		$hero_subheadline = $excerpt;
	}
}

$hero_cta_text = __( 'اكتشف أقسامنا', 'novira-academy' );
$whatsapp      = get_theme_mod( 'novira_whatsapp', '201090600927' );
?>

<section class="hero-section" aria-label="<?php esc_attr_e( 'الرئيسية', 'novira-academy' ); ?>">
	<div class="hero-background">
		<?php if ( $hero_image ) : ?>
			<img src="<?php echo esc_url( $hero_image ); ?>" 
				 alt="<?php esc_attr_e( 'أكاديمية نوفيرا', 'novira-academy' ); ?>"
				 class="hero-bg-image"
				 loading="eager">
		<?php endif; ?>
		<div class="hero-overlay"></div>
	</div>

	<div class="hero-content container">
		<div class="hero-badge">
			<span class="badge-dot"></span>
			<?php esc_html_e( 'مؤسسة تعليمية معتمدة', 'novira-academy' ); ?>
		</div>

		<h1 class="hero-headline">
			<?php echo esc_html( $hero_headline ); ?>
		</h1>

		<p class="hero-subheadline">
			<?php echo esc_html( $hero_subheadline ); ?>
		</p>

		<div class="hero-actions">
			<a href="#departments" class="btn btn-primary btn-lg">
				<?php echo esc_html( $hero_cta_text ); ?>
				<span class="btn-icon" aria-hidden="true">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<path d="M7 17l9.2-9.2M17 17V8H8"/>
					</svg>
				</span>
			</a>
			<a href="https://wa.me/<?php echo esc_attr( $whatsapp ); ?>" 
			   class="btn btn-outline btn-lg"
			   target="_blank"
			   rel="noopener noreferrer">
				<?php esc_html_e( 'تواصل معنا', 'novira-academy' ); ?>
			</a>
		</div>

		<div class="hero-stats">
			<div class="stat-item">
				<span class="stat-number" data-count="500">+500</span>
				<span class="stat-label"><?php esc_html_e( 'طالب مسجل', 'novira-academy' ); ?></span>
			</div>
			<div class="stat-item">
				<span class="stat-number" data-count="50">+50</span>
				<span class="stat-label"><?php esc_html_e( 'دورة تدريبية', 'novira-academy' ); ?></span>
			</div>
			<div class="stat-item">
				<span class="stat-number" data-count="10">+10</span>
				<span class="stat-label"><?php esc_html_e( 'سنوات خبرة', 'novira-academy' ); ?></span>
			</div>
		</div>
	</div>

	<div class="hero-scroll-indicator" aria-hidden="true">
		<span class="scroll-text"><?php esc_html_e( 'اكتشف المزيد', 'novira-academy' ); ?></span>
		<div class="scroll-arrow">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
				<path d="M12 5v14M5 12l7 7 7-7"/>
			</svg>
		</div>
	</div>
</section>
