<?php
/**
 * Novira Academy Customizer Settings
 *
 * Global settings only:
 * - Logo
 * - Contact information
 * - Social links
 * - Brand colors
 * - Footer
 *
 * Homepage content is managed through WordPress pages, not Customizer.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register customizer settings
 */
function novira_customize_register( $wp_customize ) {

	// =====================================================
	// Novira Academy Panel
	// =====================================================
	$wp_customize->add_panel( 'novira_panel', array(
		'title'       => __( 'Novira Academy', 'novira-academy' ),
		'description' => __( 'Theme-wide settings for Novira Academy.', 'novira-academy' ),
		'priority'    => 30,
	) );

	// =====================================================
	// Contact Information Section
	// =====================================================
	$wp_customize->add_section( 'novira_contact', array(
		'title' => __( 'Contact Information', 'novira-academy' ),
		'panel' => 'novira_panel',
	) );

	// WhatsApp Number
	$wp_customize->add_setting( 'novira_whatsapp', array(
		'default'           => '201090600927',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'novira_whatsapp', array(
		'label'   => __( 'WhatsApp Number (with country code)', 'novira-academy' ),
		'section' => 'novira_contact',
		'type'    => 'text',
	) );

	// Email Address
	$wp_customize->add_setting( 'novira_email', array(
		'default'           => 'noviraacademy@gmail.com',
		'sanitize_callback' => 'sanitize_email',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'novira_email', array(
		'label'   => __( 'Email Address', 'novira-academy' ),
		'section' => 'novira_contact',
		'type'    => 'email',
	) );

	// Phone Number
	$wp_customize->add_setting( 'novira_phone', array(
		'default'           => '01090600927',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'novira_phone', array(
		'label'   => __( 'Phone Number', 'novira-academy' ),
		'section' => 'novira_contact',
		'type'    => 'text',
	) );

	// Address
	$wp_customize->add_setting( 'novira_address', array(
		'default'           => __( 'المنيا، بني مزار، طريق الإبراهيمية، آخر شارع مستشفى أبو عوف', 'novira-academy' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'novira_address', array(
		'label'   => __( 'Address', 'novira-academy' ),
		'section' => 'novira_contact',
		'type'    => 'textarea',
	) );

	// =====================================================
	// Social Media Section
	// =====================================================
	$wp_customize->add_section( 'novira_social', array(
		'title' => __( 'Social Media', 'novira-academy' ),
		'panel' => 'novira_panel',
	) );

	// Facebook URL
	$wp_customize->add_setting( 'novira_facebook', array(
		'default'           => 'https://www.facebook.com/noviraacademy',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'novira_facebook', array(
		'label'   => __( 'Facebook URL', 'novira-academy' ),
		'section' => 'novira_social',
		'type'    => 'url',
	) );

	// Instagram URL
	$wp_customize->add_setting( 'novira_instagram', array(
		'default'           => 'https://www.instagram.com/noviraacademy?igsh=MXBlcnZ1b3o4NThraw==',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'novira_instagram', array(
		'label'   => __( 'Instagram URL', 'novira-academy' ),
		'section' => 'novira_social',
		'type'    => 'url',
	) );

	// TikTok URL
	$wp_customize->add_setting( 'novira_tiktok', array(
		'default'           => 'https://www.tiktok.com/@noviraacademy',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'novira_tiktok', array(
		'label'   => __( 'TikTok URL', 'novira-academy' ),
		'section' => 'novira_social',
		'type'    => 'url',
	) );

	// YouTube URL
	$wp_customize->add_setting( 'novira_youtube', array(
		'default'           => 'https://youtube.com/@noviraacadem?si=C2tRTrf-D1X9a9dY',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'novira_youtube', array(
		'label'   => __( 'YouTube URL', 'novira-academy' ),
		'section' => 'novira_social',
		'type'    => 'url',
	) );

	// =====================================================
	// Colors Section
	// =====================================================
	$wp_customize->add_section( 'novira_colors', array(
		'title' => __( 'Theme Colors', 'novira-academy' ),
		'panel' => 'novira_panel',
	) );

	// Primary Color
	$wp_customize->add_setting( 'novira_primary_color', array(
		'default'           => '#5B14E6',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'novira_primary_color', array(
		'label'   => __( 'Primary Color', 'novira-academy' ),
		'section' => 'novira_colors',
	) ) );

	// Secondary Color
	$wp_customize->add_setting( 'novira_secondary_color', array(
		'default'           => '#2196FF',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'novira_secondary_color', array(
		'label'   => __( 'Secondary Color', 'novira-academy' ),
		'section' => 'novira_colors',
	) ) );

	// =====================================================
	// Footer Section
	// =====================================================
	$wp_customize->add_section( 'novira_footer', array(
		'title' => __( 'Footer Settings', 'novira-academy' ),
		'panel' => 'novira_panel',
	) );

	// Footer Copyright Text
	$wp_customize->add_setting( 'novira_copyright', array(
		'default'           => __( 'جميع الحقوق محفوظة', 'novira-academy' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'novira_copyright', array(
		'label'   => __( 'Copyright Text', 'novira-academy' ),
		'section' => 'novira_footer',
		'type'    => 'text',
	) );

	// =====================================================
	// Google Reviews Section
	// =====================================================
	// Enter ONLY real, current values from the Google Business Profile.
	// All defaults are empty: nothing renders unless a real value is provided.
	$wp_customize->add_section( 'novira_google_reviews', array(
		'title'       => __( 'Google Reviews', 'novira-academy' ),
		'description' => __( 'Enter real values from your Google Business Profile. Leave any field empty to hide it. No placeholder or default data is ever shown.', 'novira-academy' ),
		'panel'       => 'novira_panel',
	) );

	// Google Rating (e.g. 4.9) — empty by default.
	$wp_customize->add_setting( 'novira_google_rating', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'novira_google_rating', array(
		'label'       => __( 'Google Rating (e.g. 4.9)', 'novira-academy' ),
		'description' => __( 'Use the exact current rating. Leave empty to hide.', 'novira-academy' ),
		'section'     => 'novira_google_reviews',
		'type'        => 'text',
	) );

	// Google Reviews Count (e.g. 20+) — empty by default.
	$wp_customize->add_setting( 'novira_google_reviews_count', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'novira_google_reviews_count', array(
		'label'       => __( 'Google Reviews Count (e.g. 20+)', 'novira-academy' ),
		'description' => __( 'Use the exact current count. Leave empty to hide.', 'novira-academy' ),
		'section'     => 'novira_google_reviews',
		'type'        => 'text',
	) );

	// Google Reviews URL — empty by default.
	$wp_customize->add_setting( 'novira_google_reviews_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'novira_google_reviews_url', array(
		'label'       => __( 'Google Reviews URL', 'novira-academy' ),
		'description' => __( 'Link to your Google Business Profile reviews page. Leave empty to hide the button.', 'novira-academy' ),
		'section'     => 'novira_google_reviews',
		'type'        => 'url',
	) );
}
add_action( 'customize_register', 'novira_customize_register' );

/**
 * Output custom CSS from customizer settings
 */
function novira_customizer_css() {
	$primary_color   = get_theme_mod( 'novira_primary_color', '#5B14E6' );
	$secondary_color = get_theme_mod( 'novira_secondary_color', '#2196FF' );

	$css = ":root {
		--primary: {$primary_color};
		--secondary: {$secondary_color};
	}";

	wp_add_inline_style( 'novira-main', $css );
}
add_action( 'wp_enqueue_scripts', 'novira_customizer_css', 20 );

/**
 * Customizer preview JavaScript
 */
function novira_customize_preview_js() {
	wp_enqueue_script( 'novira-customizer-preview',
		NOVIRA_URI . '/assets/js/customizer-preview.js',
		array( 'customize-preview' ),
		NOVIRA_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'novira_customize_preview_js' );
