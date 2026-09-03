<?php
/**
 * Template Part: Video Gallery Component
 *
 * Reusable video gallery component for multiple video embeds.
 * Supports YouTube, Vimeo, and self-hosted videos.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get data from template args
$videos    = isset( $args['videos'] ) ? $args['videos'] : array();
$columns   = isset( $args['columns'] ) ? $args['columns'] : 3;
$autoplay  = isset( $args['autoplay'] ) ? $args['autoplay'] : false;
$class     = isset( $args['class'] ) ? $args['class'] : '';

// If no videos provided, return
if ( empty( $videos ) ) {
	return;
}
?>

<div class="novira-video-gallery columns-<?php echo esc_attr( $columns ); ?> <?php echo esc_attr( $class ); ?>">
	<?php foreach ( $videos as $index => $video ) : ?>
		<?php
		$video_url  = isset( $video['url'] ) ? $video['url'] : '';
		$title      = isset( $video['title'] ) ? $video['title'] : '';
		$thumbnail  = isset( $video['thumbnail'] ) ? $video['thumbnail'] : '';
		$duration   = isset( $video['duration'] ) ? $video['duration'] : '';

		if ( empty( $video_url ) ) {
			continue;
		}

		// Detect video type
		$video_type = novira_detect_video_type( $video_url );
		?>
		<div class="video-gallery-item" data-video-type="<?php echo esc_attr( $video_type ); ?>" data-video-url="<?php echo esc_url( $video_url ); ?>">
			<div class="video-thumbnail">
				<?php if ( ! empty( $thumbnail ) ) : ?>
					<img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy" decoding="async">
				<?php else : ?>
					<div class="video-placeholder">
						<span class="play-icon">&#9654;</span>
					</div>
				<?php endif; ?>
				
				<?php if ( ! empty( $duration ) ) : ?>
					<span class="video-duration"><?php echo esc_html( $duration ); ?></span>
				<?php endif; ?>
				
				<button class="play-button" aria-label="<?php esc_attr_e( 'تشغيل الفيديو', 'novira-academy' ); ?>">
					<span class="play-icon">&#9654;</span>
				</button>
			</div>
			
			<?php if ( ! empty( $title ) ) : ?>
				<div class="video-info">
					<h3 class="video-title"><?php echo esc_html( $title ); ?></h3>
				</div>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>

<!-- Video Modal -->
<div class="video-modal" id="videoModal" role="dialog" aria-hidden="true" aria-label="<?php esc_attr_e( 'مشغل الفيديو', 'novira-academy' ); ?>">
	<div class="video-modal-content">
		<button class="video-modal-close" aria-label="<?php esc_attr_e( 'إغلاق', 'novira-academy' ); ?>">&times;</button>
		<div class="video-modal-iframe">
			<iframe src="" frameborder="0" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
		</div>
	</div>
</div>

<?php
/**
 * Detect video type from URL
 *
 * @param string $url Video URL
 * @return string Video type (youtube, vimeo, self-hosted)
 */
function novira_detect_video_type( $url ) {
	if ( preg_match( '/(?:youtube\.com|youtu\.be)/', $url ) ) {
		return 'youtube';
	}
	if ( preg_match( '/vimeo\.com/', $url ) ) {
		return 'vimeo';
	}
	return 'self-hosted';
}
?>
