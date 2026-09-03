<?php
/**
 * Template Part: Media Gallery Section
 *
 * Homepage section displaying real photos from WordPress media library.
 * Uses a filter to allow plugins to customize gallery images.
 *
 * Constitution: Real Content Before Decorative Design
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter gallery images for the media-gallery section.
 *
 * Plugins can override this filter to provide images from a gallery CPT or other source.
 * Default: queries recent attachments from WordPress media library.
 *
 * @param array $gallery_images Array of image data arrays.
 */
$gallery_images = apply_filters( 'novira_homepage_gallery', array() );

// If no images provided by filter, query WordPress media library
if ( empty( $gallery_images ) ) {
	$attachments = new WP_Query( array(
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'posts_per_page' => 5,
		'post_status'    => 'inherit',
		'orderby'        => 'date',
		'order'          => 'DESC',
		'meta_query'     => array(
			array(
				'key'     => '_novira_gallery',
				'compare' => 'EXISTS',
			),
		),
	) );

	// Fallback: if no images tagged for gallery, get recent uploads
	if ( ! $attachments->have_posts() ) {
		$attachments = new WP_Query( array(
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'posts_per_page' => 5,
			'post_status'    => 'inherit',
			'orderby'        => 'date',
			'order'          => 'DESC',
		) );
	}

	if ( $attachments->have_posts() ) {
		$index = 0;
		while ( $attachments->have_posts() ) {
			$attachments->the_post();
			$size_class = ( 0 === $index ) ? 'gallery-item-large' : 'gallery-item-medium';
			$gallery_images[] = array(
				'url'   => get_the_post_thumbnail_url( get_the_ID(), 'large' ),
				'alt'   => get_post_meta( get_the_ID(), '_wp_attachment_image_alt', true ),
				'class' => $size_class,
			);
			$index++;
		}
		wp_reset_postdata();
	}
}

// If still no images, show empty state
if ( empty( $gallery_images ) ) {
	return;
}

$video_url = get_post_meta( get_the_front_page_id(), '_novira_video_url', true );
?>

<section id="media-gallery" class="media-gallery-section section" aria-label="<?php esc_attr_e( 'معرض الصور', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'من حياة الأكاديمية', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'لقطات من أكاديمية نوفيرا', 'novira-academy' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'شاهد لحظات حقيقية من أنشطتنا التعليمية والمهنية.', 'novira-academy' ); ?></p>
		</div>

		<div class="gallery-grid">
			<?php foreach ( $gallery_images as $image ) : ?>
				<div class="gallery-item <?php echo esc_attr( $image['class'] ); ?>">
					<img src="<?php echo esc_url( $image['url'] ); ?>" 
						 alt="<?php echo esc_attr( $image['alt'] ); ?>"
						 loading="lazy"
						 width="400"
						 height="300">
					<div class="gallery-overlay">
						<span class="gallery-zoom" aria-hidden="true">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<circle cx="11" cy="11" r="8"/>
								<path d="M21 21l-4.35-4.35"/>
								<path d="M11 8v6M8 11h6"/>
							</svg>
						</span>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if ( $video_url ) : ?>
			<div class="video-section">
				<h3 class="video-title"><?php esc_html_e( 'شاهد الفيديو التعريفي', 'novira-academy' ); ?></h3>
				<?php get_template_part( 'template-parts/components/video-embed', null, array( 'url' => $video_url ) ); ?>
			</div>
		<?php endif; ?>
	</div>
</section>
