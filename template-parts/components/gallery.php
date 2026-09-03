<?php
/**
 * Template Part: Gallery Component
 *
 * Reusable gallery component with WordPress gallery shortcode integration.
 * Supports lightbox, masonry layout, and responsive images.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get data from template args
$ids     = isset( $args['ids'] ) ? $args['ids'] : '';
$columns = isset( $args['columns'] ) ? $args['columns'] : 3;
$size    = isset( $args['size'] ) ? $args['size'] : 'medium_large';
$link    = isset( $args['link'] ) ? $args['link'] : 'file';
$layout  = isset( $args['layout'] ) ? $args['layout'] : 'grid';

// If no IDs provided, use WordPress gallery shortcode
if ( empty( $ids ) ) {
	return;
}
?>

<div class="novira-gallery gallery-<?php echo esc_attr( $layout ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>">
	<?php
	echo do_shortcode( sprintf(
		'[gallery ids="%s" columns="%d" size="%s" link="%s" class="novira-gallery-grid"]',
		esc_attr( $ids ),
		esc_attr( $columns ),
		esc_attr( $size ),
		esc_attr( $link )
	) );
	?>
</div>
