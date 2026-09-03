<?php
/**
 * Featured Image Handler
 *
 * Provides functions for handling featured images with proper sizing,
 * alt text, and responsive image support.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get featured image with proper sizing
 *
 * @param int    $post_id Post ID
 * @param string $size Image size
 * @param array  $attr Additional attributes
 * @return string HTML image tag or empty string
 */
function novira_get_featured_image( $post_id = 0, $size = 'medium_large', $attr = array() ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	if ( ! has_post_thumbnail( $post_id ) ) {
		return '';
	}

	$defaults = array(
		'class'    => 'featured-image',
		'loading'  => 'lazy',
		'decoding' => 'async',
	);

	$attr = wp_parse_args( $attr, $defaults );

	// Add alt text if not set
	if ( empty( $attr['alt'] ) ) {
		$attr['alt'] = get_post_meta( get_post_thumbnail_id( $post_id ), '_wp_attachment_image_alt', true );
		if ( empty( $attr['alt'] ) ) {
			$attr['alt'] = get_the_title( $post_id );
		}
	}

	return get_the_post_thumbnail( $post_id, $size, $attr );
}

/**
 * Get featured image URL
 *
 * @param int    $post_id Post ID
 * @param string $size Image size
 * @return string Image URL or empty string
 */
function novira_get_featured_image_url( $post_id = 0, $size = 'full' ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	if ( ! has_post_thumbnail( $post_id ) ) {
		return '';
	}

	return get_the_post_thumbnail_url( $post_id, $size );
}

/**
 * Get featured image ID
 *
 * @param int $post_id Post ID
 * @return int|false Attachment ID or false
 */
function novira_get_featured_image_id( $post_id = 0 ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	return get_post_thumbnail_id( $post_id );
}

/**
 * Get featured image alt text
 *
 * @param int $post_id Post ID
 * @return string Alt text
 */
function novira_get_featured_image_alt( $post_id = 0 ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$thumbnail_id = get_post_thumbnail_id( $post_id );
	if ( ! $thumbnail_id ) {
		return '';
	}

	$alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
	if ( empty( $alt ) ) {
		$alt = get_the_title( $post_id );
	}

	return $alt;
}

/**
 * Get responsive featured image with srcset
 *
 * @param int    $post_id Post ID
 * @param string $size Image size
 * @param array  $attr Additional attributes
 * @return string HTML image tag with srcset
 */
function novira_get_responsive_featured_image( $post_id = 0, $size = 'medium_large', $attr = array() ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	if ( ! has_post_thumbnail( $post_id ) ) {
		return '';
	}

	$defaults = array(
		'class'    => 'featured-image responsive-image',
		'loading'  => 'lazy',
		'decoding' => 'async',
	);

	$attr = wp_parse_args( $attr, $defaults );

	// Add alt text
	if ( empty( $attr['alt'] ) ) {
		$attr['alt'] = novira_get_featured_image_alt( $post_id );
	}

	// Get image data
	$image_id  = get_post_thumbnail_id( $post_id );
	$image_src = wp_get_attachment_image_src( $image_id, $size );
	$full_src  = wp_get_attachment_image_src( $image_id, 'full' );

	if ( ! $image_src ) {
		return '';
	}

	// Build srcset
	$sizes = array(
		'small'  => 300,
		'medium' => 600,
		'large'  => 1024,
	);

	$srcset = array();
	foreach ( $sizes as $size_name => $width ) {
		$size_src = wp_get_attachment_image_src( $image_id, $size_name );
		if ( $size_src && $size_src[1] <= $width ) {
			$srcset[] = "{$size_src[0]} {$size_src[1]}w";
		}
	}

	// Add original size
	if ( $full_src ) {
		$srcset[] = "{$full_src[0]} {$full_src[1]}w";
	}

	$srcset_str = implode( ', ', $srcset );
	$sizes_str  = '(max-width: ' . $image_src[1] . 'px) 100vw, ' . $image_src[1] . 'px';

	$attr_str = '';
	foreach ( $attr as $key => $value ) {
		$attr_str .= ' ' . esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
	}

	return sprintf(
		'<img src="%s" srcset="%s" sizes="%s" width="%d" height="%d"%s>',
		esc_url( $image_src[0] ),
		esc_attr( $srcset_str ),
		esc_attr( $sizes_str ),
		$image_src[1],
		$image_src[2],
		$attr_str
	);
}

/**
 * Check if post has featured image
 *
 * @param int $post_id Post ID
 * @return bool
 */
function novira_has_featured_image( $post_id = 0 ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	return has_post_thumbnail( $post_id );
}

/**
 * Add custom image sizes for theme
 */
function novira_register_image_sizes() {
	add_image_size( 'novira-hero', 1920, 1080, true );
	add_image_size( 'novira-card', 600, 400, true );
	add_image_size( 'novira-thumb', 300, 300, true );
}
add_action( 'after_setup_theme', 'novira_register_image_sizes' );

/**
 * Add custom sizes to srcset
 */
function novira_add_custom_image_sizes( $sizes, $size ) {
	$custom_sizes = array(
		'novira-hero'  => 'Novira Hero',
		'novira-card'  => 'Novira Card',
		'novira-thumb' => 'Novira Thumb',
	);

	return array_merge( $sizes, $custom_sizes );
}
add_filter( 'image_size_names_choose', 'novira_add_custom_image_sizes' );
