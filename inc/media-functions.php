<?php
/**
 * Media Query Functions
 *
 * Provides functions for querying media by category, tag, and other criteria.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get media by category
 *
 * @param string $category Category slug
 * @param int    $limit Number of items to return
 * @param string $order Order direction
 * @return array Array of attachment objects
 */
function novira_get_media_by_category( $category, $limit = 12, $order = 'DESC' ) {
	$args = array(
		'post_type'      => 'attachment',
		'post_mime_type' => array( 'image', 'video' ),
		'post_status'    => 'inherit',
		'posts_per_page' => $limit,
		'orderby'        => 'date',
		'order'          => $order,
		'tax_query'      => array(
			array(
				'taxonomy' => 'media_category',
				'field'    => 'slug',
				'terms'    => $category,
			),
		),
	);

	return get_posts( $args );
}

/**
 * Get media by tag
 *
 * @param string $tag Tag slug
 * @param int    $limit Number of items to return
 * @return array Array of attachment objects
 */
function novira_get_media_by_tag( $tag, $limit = 12 ) {
	$args = array(
		'post_type'      => 'attachment',
		'post_mime_type' => array( 'image', 'video' ),
		'post_status'    => 'inherit',
		'posts_per_page' => $limit,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'tag'            => $tag,
	);

	return get_posts( $args );
}

/**
 * Get media by multiple categories
 *
 * @param array  $categories Array of category slugs
 * @param int    $limit Number of items to return
 * @param string $relation Taxonomy relation (AND/OR)
 * @return array Array of attachment objects
 */
function novira_get_media_by_categories( $categories, $limit = 12, $relation = 'OR' ) {
	$tax_query = array(
		'relation' => $relation,
	);

	foreach ( $categories as $category ) {
		$tax_query[] = array(
			'taxonomy' => 'media_category',
			'field'    => 'slug',
			'terms'    => $category,
		);
	}

	$args = array(
		'post_type'      => 'attachment',
		'post_mime_type' => array( 'image', 'video' ),
		'post_status'    => 'inherit',
		'posts_per_page' => $limit,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'tax_query'      => $tax_query,
	);

	return get_posts( $args );
}

/**
 * Get recent media
 *
 * @param int    $limit Number of items to return
 * @param string $mime_type Mime type filter (image, video, or empty for all)
 * @return array Array of attachment objects
 */
function novira_get_recent_media( $limit = 12, $mime_type = '' ) {
	$args = array(
		'post_type'      => 'attachment',
		'post_status'    => 'inherit',
		'posts_per_page' => $limit,
		'orderby'        => 'date',
		'order'          => 'DESC',
	);

	if ( ! empty( $mime_type ) ) {
		$args['post_mime_type'] = $mime_type;
	}

	return get_posts( $args );
}

/**
 * Get media by parent post
 *
 * @param int $parent_id Parent post ID
 * @param int $limit Number of items to return
 * @return array Array of attachment objects
 */
function novira_get_media_by_parent( $parent_id, $limit = -1 ) {
	$args = array(
		'post_type'      => 'attachment',
		'post_parent'    => $parent_id,
		'post_status'    => 'inherit',
		'posts_per_page' => $limit,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	);

	return get_posts( $args );
}

/**
 * Get featured images from posts
 *
 * @param string $post_type Post type
 * @param int    $limit Number of items to return
 * @param array  $tax_query Taxonomy query
 * @return array Array of attachment objects
 */
function novira_get_featured_images( $post_type = 'post', $limit = 12, $tax_query = array() ) {
	$args = array(
		'post_type'      => $post_type,
		'posts_per_page' => $limit,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'meta_key'       => '_thumbnail_id',
	);

	if ( ! empty( $tax_query ) ) {
		$args['tax_query'] = $tax_query;
	}

	$posts = get_posts( $args );
	$images = array();

	foreach ( $posts as $post ) {
		$image_id = get_post_thumbnail_id( $post->ID );
		if ( $image_id ) {
			$images[] = get_post( $image_id );
		}
	}

	return $images;
}

/**
 * Get media count by category
 *
 * @param string $category Category slug
 * @return int Number of media items
 */
function novira_get_media_count_by_category( $category ) {
	$args = array(
		'post_type'      => 'attachment',
		'post_mime_type' => array( 'image', 'video' ),
		'post_status'    => 'inherit',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'tax_query'      => array(
			array(
				'taxonomy' => 'media_category',
				'field'    => 'slug',
				'terms'    => $category,
			),
		),
	);

	return count( get_posts( $args ) );
}

/**
 * Get all media categories with counts
 *
 * @return array Array of category objects
 */
function novira_get_media_categories() {
	return get_terms( array(
		'taxonomy'   => 'media_category',
		'hide_empty' => true,
		'orderby'    => 'count',
		'order'      => 'DESC',
	) );
}

/**
 * Get media gallery data for JavaScript
 *
 * @param array $args Query arguments
 * @return array Gallery data array
 */
function novira_get_gallery_data( $args = array() ) {
	$defaults = array(
		'category' => '',
		'limit'    => 12,
	);

	$args = wp_parse_args( $args, $defaults );

	if ( ! empty( $args['category'] ) ) {
		$media = novira_get_media_by_category( $args['category'], $args['limit'] );
	} else {
		$media = novira_get_recent_media( $args['limit'] );
	}

	$gallery = array();

	foreach ( $media as $item ) {
		$is_video = strpos( $item->post_mime_type, 'video' ) !== false;
		$thumb_url = wp_get_attachment_image_url( $item->ID, 'novira-card' );
		$full_url = wp_get_attachment_url( $item->ID );

		$gallery_item = array(
			'id'        => $item->ID,
			'title'     => $item->post_title,
			'caption'   => $item->post_excerpt,
			'thumb_url' => $thumb_url,
			'full_url'  => $full_url,
			'is_video'  => $is_video,
			'mime_type' => $item->post_mime_type,
		);

		if ( $is_video ) {
			$gallery_item['video_url'] = wp_get_attachment_url( $item->ID );
		}

		$gallery[] = $gallery_item;
	}

	return $gallery;
}
