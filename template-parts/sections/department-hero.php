<?php
/**
 * Template Part: Department Hero
 *
 * Hero section for department pages with featured image and breadcrumbs.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$slug        = get_post_field( 'post_name', get_the_ID() );
$department_title = get_the_title();
$department_desc  = get_the_excerpt();
$hero_image       = get_the_post_thumbnail_url( get_the_ID(), 'full' );

// Department-specific fallback content
$department_data = array(
	'education' => array(
		'tag'   => __( 'التعليم والتطوير المهني', 'novira-academy' ),
		'title' => __( 'أكاديمية نوفيرا للتعليم', 'novira-academy' ),
	),
	'translation' => array(
		'tag'   => __( 'الترجمة المعتمدة', 'novira-academy' ),
		'title' => __( 'خدمات الترجمة المعتمدة', 'novira-academy' ),
	),
	'american-diploma' => array(
		'tag'   => __( 'الدبلوم الأمريكي', 'novira-academy' ),
		'title' => __( 'البرنامج الأمريكي', 'novira-academy' ),
	),
);

$data = isset( $department_data[ $slug ] ) ? $department_data[ $slug ] : array(
	'tag'   => '',
	'title' => $department_title,
);
?>

<section class="department-hero" aria-label="<?php echo esc_attr( $department_title ); ?>">
	<div class="hero-background">
		<?php if ( $hero_image ) : ?>
			<img src="<?php echo esc_url( $hero_image ); ?>" 
				 alt="<?php echo esc_attr( $department_title ); ?>"
				 class="hero-bg-image"
				 loading="eager">
		<?php endif; ?>
		<div class="hero-overlay"></div>
	</div>

	<div class="hero-content container">
		<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'مسار التنقل', 'novira-academy' ); ?>">
			<ol class="breadcrumbs-list">
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'الرئيسية', 'novira-academy' ); ?></a></li>
				<li aria-current="page"><?php echo esc_html( $department_title ); ?></li>
			</ol>
		</nav>

		<div class="department-badge">
			<span class="badge-text"><?php echo esc_html( $data['tag'] ); ?></span>
		</div>

		<h1 class="department-title">
			<?php echo esc_html( $department_title ); ?>
		</h1>

		<?php if ( $department_desc ) : ?>
			<p class="department-description">
				<?php echo esc_html( $department_desc ); ?>
			</p>
		<?php endif; ?>

		<div class="department-actions">
			<a href="#programs" class="btn btn-primary btn-lg">
				<?php esc_html_e( 'اكتشف البرامج', 'novira-academy' ); ?>
				<span class="btn-icon" aria-hidden="true">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<path d="M7 17l9.2-9.2M17 17V8H8"/>
					</svg>
				</span>
			</a>
			<a href="#contact" class="btn btn-outline btn-lg">
				<?php esc_html_e( 'تواصل معنا', 'novira-academy' ); ?>
			</a>
		</div>
	</div>
</section>
