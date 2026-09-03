<?php
/**
 * Template Part: Responsive Image Component
 *
 * Reusable responsive image component with srcset, sizes, and lazy loading.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get data from template args
$image_id   = isset( $args['image_id'] ) ? $args['image_id'] : 0;
$image_url  = isset( $args['image_url'] ) ? $args['image_url'] : '';
$alt        = isset( $args['alt'] ) ? $args['alt'] : '';
$caption    = isset( $args['caption'] ) ? $args['caption'] : '';
$size       = isset( $args['size'] ) ? $args['size'] : 'medium_large';
$class      = isset( $args['class'] ) ? $args['class'] : '';
$show_caption = isset( $args['show_caption'] ) ? $args['show_caption'] : false;
$link       = isset( $args['link'] ) ? $args['link'] : '';

// If image ID is provided, get image data
if ( $image_id ) {
	$image_src = wp_get_attachment_image_src( $image_id, $size );
	$full_src  = wp_get_attachment_image_src( $image_id, 'full' );
	$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

	if ( ! $image_src ) {
		return;
	}

	// Use provided alt or from image
	if ( empty( $alt ) ) {
		$alt = $image_alt;
	}

	// Build srcset
	$sizes_list = array(
		'small'  => 300,
		'medium' => 600,
		'large'  => 1024,
	);

	$srcset = array();
	foreach ( $sizes_list as $size_name => $width ) {
		$size_src = wp_get_attachment_image_src( $image_id, $size_name );
		if ( $size_src && $size_src[1] <= $width ) {
			$srcset[] = "{$size_src[0]} {$size_src[1]}w";
		}
	}

	if ( $full_src ) {
		$srcset[] = "{$full_src[0]} {$full_src[1]}w";
	}

	$srcset_str = implode( ', ', $srcset );
	$sizes_str  = '(max-width: ' . $image_src[1] . 'px) 100vw, ' . $image_src[1] . 'px';

	$image_html = sprintf(
		'<img src="%s" srcset="%s" sizes="%s" width="%d" height="%d" alt="%s" class="responsive-image %s" loading="lazy" decoding="async">',
		esc_url( $image_src[0] ),
		esc_attr( $srcset_str ),
		esc_attr( $sizes_str ),
		$image_src[1],
		$image_src[2],
		esc_attr( $alt ),
		esc_attr( $class )
	);
} elseif ( ! empty( $image_url ) ) {
	// Simple image URL
	$image_html = sprintf(
		'<img src="%s" alt="%s" class="responsive-image %s" loading="lazy" decoding="async">',
		esc_url( $image_url ),
		esc_attr( $alt ),
		esc_attr( $class )
	);
} else {
	return;
}

// Wrap with link if provided
if ( ! empty( $link ) ) {
	$image_html = sprintf(
		'<a href="%s" class="responsive-image-link">%s</a>',
		esc_url( $link ),
		$image_html
	);
}
?>

<div class="novira-responsive-image-wrapper <?php echo esc_attr( $class ); ?>">
	<?php echo $image_html; ?>
	<?php if ( $show_caption && ! empty( $caption ) ) : ?>
		<figcaption class="responsive-image-caption"><?php echo esc_html( $caption ); ?></figcaption>
	<?php endif; ?>
</div>
