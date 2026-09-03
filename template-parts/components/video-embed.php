<?php
/**
 * Template Part: Video Embed Component
 *
 * Reusable component for embedding YouTube or self-hosted videos.
 *
 * @package Novira_Academy
 *
 * @var array $args {
 *     Video data.
 *     @var string $url Video URL (YouTube, Vimeo, or self-hosted).
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$url = isset( $args['url'] ) ? $args['url'] : '';

if ( empty( $url ) ) {
	return;
}

// Extract YouTube video ID
$youtube_id = '';
if ( preg_match( '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches ) ) {
	$youtube_id = $matches[1];
}

// Extract Vimeo video ID
$vimeo_id = '';
if ( preg_match( '/(?:vimeo\.com\/)([0-9]+)/', $url, $matches ) ) {
	$vimeo_id = $matches[1];
}
?>

<div class="video-embed-wrapper">
	<?php if ( $youtube_id ) : ?>
		<div class="video-container video-youtube" data-video-id="<?php echo esc_attr( $youtube_id ); ?>">
			<div class="video-placeholder" role="button" aria-label="<?php esc_attr_e( 'تشغيل الفيديو', 'novira-academy' ); ?>" tabindex="0">
				<img src="https://img.youtube.com/vi/<?php echo esc_attr( $youtube_id ); ?>/maxresdefault.jpg" 
					 alt="<?php esc_attr_e( 'صورة مصغرة للفيديو', 'novira-academy' ); ?>"
					 loading="lazy"
					 width="1280"
					 height="720">
				<div class="play-button" aria-hidden="true">
					<svg width="64" height="64" viewBox="0 0 24 24" fill="white">
						<path d="M8 5v14l11-7z"/>
					</svg>
				</div>
			</div>
			<iframe class="video-iframe" 
					src="" 
					title="<?php esc_attr_e( 'فيديو يوتيوب', 'novira-academy' ); ?>"
					frameborder="0" 
					allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
					allowfullscreen
					style="display: none;">
			</iframe>
		</div>
	<?php elseif ( $vimeo_id ) : ?>
		<div class="video-container video-vimeo">
			<iframe src="https://player.vimeo.com/video/<?php echo esc_attr( $vimeo_id ); ?>?byline=0&portrait=0" 
					title="<?php esc_attr_e( 'فيديو فيميو', 'novira-academy' ); ?>"
					frameborder="0" 
					allow="autoplay; fullscreen; picture-in-picture" 
					allowfullscreen>
			</iframe>
		</div>
	<?php else : ?>
		<div class="video-container video-self-hosted">
			<video controls preload="metadata" playsinline>
				<source src="<?php echo esc_url( $url ); ?>" type="video/mp4">
				<?php esc_html_e( 'متصفحك لا يدعم تشغيل الفيديو.', 'novira-academy' ); ?>
			</video>
		</div>
	<?php endif; ?>
</div>
