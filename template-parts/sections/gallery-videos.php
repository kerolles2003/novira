<?php
/**
 * Template Part: Gallery & Videos Section (Premium Split)
 *
 * Two independent premium blocks:
 * 1. Photo gallery as an asymmetric bento grid.
 * 2. Video library as a cinematic featured-player panel.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$gallery_dir = get_template_directory() . '/assets/images/gallery';
$gallery_url = get_template_directory_uri() . '/assets/images/gallery';
$all_gallery_images = array();

if ( is_dir( $gallery_dir ) ) {
	$files = array_diff( scandir( $gallery_dir ), array( '.', '..' ) );
	// Sort files naturally so caro_1.webp comes before 2.avif
	natsort( $files );
	foreach ( $files as $file ) {
		if ( preg_match( '/\.(avif|webp|jpg|jpeg|png)$/i', $file ) ) {
			$all_gallery_images[] = array(
				'src'   => $gallery_url . '/' . $file,
				'alt'   => __( 'صور الأكاديمية', 'novira-academy' ),
				'label' => __( 'حياة الأكاديمية', 'novira-academy' ),
			);
		}
	}
}

// The bento grid is designed for exactly 6 items
$gallery_images = array_slice( $all_gallery_images, 0, 6 );
$remaining_count = max( 0, count( $all_gallery_images ) - 6 );

$shorts = array(
	'36dc1_R_aPM',
	'm3P1twyedtE',
	'NZft4c1kO-8',
	'-5WFAkpgW5U',
);
?>

<!-- Premium Photo Gallery -->
<section class="gallery-premium" aria-label="<?php esc_attr_e( 'معرض الصور', 'novira-academy' ); ?>">
	<div class="gallery-premium__container">

		<div class="gallery-premium__header">
			<div>
				<span class="gallery-premium__eyebrow"><?php esc_html_e( 'لقطات من حياتنا', 'novira-academy' ); ?></span>
				<h2 class="gallery-premium__title"><?php esc_html_e( 'معرض الصور', 'novira-academy' ); ?></h2>
			</div>
			<a href="<?php echo esc_url( home_url( '/gallery' ) ); ?>" class="gallery-premium__view-all">
				<?php esc_html_e( 'عرض جميع الصور', 'novira-academy' ); ?>
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="transform rtl:-scale-x-100"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
			</a>
		</div>

		<div class="gallery-premium__grid" role="list">
			<?php foreach ( $gallery_images as $index => $image ) : ?>
				<figure class="gallery-premium__item gallery-premium__item--<?php echo esc_attr( $index + 1 ); ?>" role="listitem">
					<img
						src="<?php echo esc_url( $image['src'] ); ?>"
						alt="<?php echo esc_attr( sprintf( __( 'لقطة من أكاديمية نوفيرا رقم %d', 'novira-academy' ), $index + 1 ) ); ?>"
						class="gallery-premium__image"
						loading="lazy"
					>
					<figcaption class="gallery-premium__caption">
						<span class="gallery-premium__caption-text"><?php echo esc_html( $image['label'] ); ?></span>
					</figcaption>
				</figure>
			<?php endforeach; ?>
			<?php if ( $remaining_count > 0 ) : ?>
			<a href="<?php echo esc_url( home_url( '/gallery' ) ); ?>" class="gallery-premium__item gallery-premium__item--more" role="listitem">
				<span class="gallery-premium__more-count">+<?php echo esc_html( $remaining_count ); ?></span>
				<span class="gallery-premium__more-label"><?php esc_html_e( 'صورة أخرى', 'novira-academy' ); ?></span>
			</a>
			<?php endif; ?>
		</div>

	</div>
</section>

<!-- Video Library -->
<section class="video-library bg-gradient-to-br from-[#4C1D95] to-[#1E1B4B] py-16 lg:py-24" aria-label="<?php esc_attr_e( 'مكتبة الفيديوهات', 'novira-academy' ); ?>">
	<div class="video-library__container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

		<div class="video-library__header mb-12 flex flex-col md:flex-row items-center justify-between">
			<div class="mb-6 md:mb-0 text-center md:text-right">
				<span class="video-library__eyebrow inline-block bg-white/10 text-white px-4 py-1 rounded-full font-bold text-sm mb-4 border border-white/20"><?php esc_html_e( 'شاهد بنفسك', 'novira-academy' ); ?></span>
				<h2 class="video-library__title text-3xl md:text-4xl lg:text-5xl font-black !text-white mb-4"><?php esc_html_e( 'مكتبة الفيديوهات', 'novira-academy' ); ?></h2>
			</div>
			<a href="<?php echo esc_url( home_url( '/videos' ) ); ?>" class="video-library__view-all inline-flex items-center space-x-2 space-x-reverse font-bold transition-colors">
				<span><?php esc_html_e( 'عرض جميع الفيديوهات', 'novira-academy' ); ?></span>
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="transform rtl:-scale-x-100"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
			</a>
		</div>

		<div class="video-library__stage" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px; width: 100%;">
			<?php foreach ( $shorts as $short_id ) : ?>
				<div class="video-library__short" style="position: relative; padding-bottom: 177.77%; height: 0; overflow: hidden; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
					<button type="button" class="video-facade" data-video-id="<?php echo esc_attr( $short_id ); ?>" aria-label="<?php esc_attr_e( 'تشغيل الفيديو', 'novira-academy' ); ?>" style="position: absolute; inset: 0; width: 100%; height: 100%; padding: 0; border: none; cursor: pointer; background: #000;">
						<img src="https://i.ytimg.com/vi/<?php echo esc_attr( $short_id ); ?>/hqdefault.jpg" alt="" loading="lazy" decoding="async" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;">
						<span aria-hidden="true" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 64px; height: 64px; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.6); border-radius: 9999px;">
							<svg width="28" height="28" viewBox="0 0 24 24" fill="#ffffff" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
						</span>
					</button>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>

<script>
(function () {
	var stage = document.querySelector( '.video-library__stage' );
	if ( ! stage ) { return; }
	stage.addEventListener( 'click', function ( e ) {
		var btn = e.target.closest( '.video-facade' );
		if ( ! btn ) { return; }
		var id = btn.getAttribute( 'data-video-id' );
		var iframe = document.createElement( 'iframe' );
		iframe.src = 'https://www.youtube.com/embed/' + id + '?autoplay=1';
		iframe.title = 'YouTube video';
		iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
		iframe.allowFullscreen = true;
		iframe.style.cssText = 'position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;';
		btn.parentNode.replaceChild( iframe, btn );
	} );
})();
</script>
