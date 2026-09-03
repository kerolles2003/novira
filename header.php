<?php
/**
 * Header Template
 *
 * Contains opening document tags and site header.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php novira_language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php if ( is_front_page() ) : ?>
	<link rel="preload" as="image" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/gallery/caro_1.webp' ); ?>" type="image/avif" fetchpriority="high">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary">
	<?php esc_html_e( 'المحتوى الرئيسي', 'novira-academy' ); ?>
</a>

<?php get_template_part( 'template-parts/layout/header' ); ?>

<main id="primary" class="site-main">
