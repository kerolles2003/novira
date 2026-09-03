<?php
/**
 * Learning-journey footer — rendered after the article body (inside the loop).
 *
 * A calm, editorial descent from content → more content → program → sequential
 * navigation → a subtle consultation. Every recommendation section self-hides
 * when it has nothing to show, so a lone article still gets a graceful ending.
 * Powered by inc/blog-recommendations.php (entity-aware). No SEO output here.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nvb_id = get_the_ID();

// Sequential neighbours (prefer the same category), excluded from "related" so
// nothing is recommended twice.
$nvb_prev = get_previous_post( true, '', 'blog_category' );
if ( ! $nvb_prev ) {
	$nvb_prev = get_previous_post( false, '', 'blog_category' );
}
$nvb_next = get_next_post( true, '', 'blog_category' );
if ( ! $nvb_next ) {
	$nvb_next = get_next_post( false, '', 'blog_category' );
}
$nvb_adjacent = array();
if ( $nvb_prev ) {
	$nvb_adjacent[] = $nvb_prev->ID;
}
if ( $nvb_next ) {
	$nvb_adjacent[] = $nvb_next->ID;
}

$nvb_related  = novira_blog_related_posts( $nvb_id, 3, $nvb_adjacent );
$nvb_program  = novira_blog_program_link( $nvb_id );
$nvb_whatsapp = get_theme_mod( 'novira_whatsapp', '201090600927' );
?>
<section class="nvblog-journey" aria-label="<?php esc_attr_e( 'واصل التعلّم', 'novira-academy' ); ?>">
	<div class="nvblog-container">

		<div class="nvblog-complete" data-complete>
			<span class="nvblog-complete__mark" aria-hidden="true">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
			</span>
			<span class="nvblog-complete__text">
				<b><?php esc_html_e( 'أتممت القراءة — أحسنت!', 'novira-academy' ); ?></b>
				<span><?php esc_html_e( 'كل مقال خطوة. إليك وجهتك التالية في رحلة التعلّم.', 'novira-academy' ); ?></span>
			</span>
		</div>

		<?php if ( ! empty( $nvb_related ) ) : ?>
			<div class="nvblog-jrnl">
				<div class="nvblog-jrnl__head">
					<span class="nvblog-head__eyebrow">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 5a2 2 0 0 1 2-2h6v18H6a2 2 0 0 0-2 2zM20 5a2 2 0 0 0-2-2h-6v18h6a2 2 0 0 1 2 2z"/></svg>
						<?php esc_html_e( 'واصل رحلتك', 'novira-academy' ); ?>
					</span>
					<h2 class="nvblog-jrnl__title"><?php esc_html_e( 'اقرأ بعد ذلك', 'novira-academy' ); ?></h2>
				</div>
				<div class="nvblog-recs">
					<?php
					foreach ( $nvb_related as $nvb_rid ) :
						$nvb_rcat = novira_blog_primary_category( $nvb_rid );
						$nvb_racc = novira_blog_accent( $nvb_rcat );
						?>
						<article class="nvblog-rec" style="--cc: <?php echo esc_attr( $nvb_racc ); ?>;">
							<div class="nvblog-rec__media<?php echo has_post_thumbnail( $nvb_rid ) ? '' : ' nvblog-rec__media--empty'; ?>">
								<?php
								if ( has_post_thumbnail( $nvb_rid ) ) {
									echo get_the_post_thumbnail( $nvb_rid, 'medium_large', array( 'loading' => 'lazy', 'decoding' => 'async', 'alt' => get_the_title( $nvb_rid ), 'sizes' => '(min-width: 760px) 260px, 90vw' ) );
								} else {
									echo '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 5a2 2 0 0 1 2-2h6v18H6a2 2 0 0 0-2 2zM20 5a2 2 0 0 0-2-2h-6v18h6a2 2 0 0 1 2 2z"/></svg>';
								}
								?>
								<?php if ( $nvb_rcat ) : ?>
									<span class="nvblog-rec__badge"><?php echo esc_html( $nvb_rcat->name ); ?></span>
								<?php endif; ?>
							</div>
							<div class="nvblog-rec__body">
								<div class="nvblog-rec__meta">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7.5v5l3 1.8"/></svg>
									<?php echo esc_html( novira_blog_reading_time_label( $nvb_rid ) ); ?>
								</div>
								<h3 class="nvblog-rec__title"><a href="<?php echo esc_url( get_permalink( $nvb_rid ) ); ?>"><?php echo esc_html( get_the_title( $nvb_rid ) ); ?></a></h3>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $nvb_program ) : ?>
			<aside class="nvblog-program">
				<span class="nvblog-program__icon" aria-hidden="true">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10 12 5 2 10l10 5 10-5Z"/><path d="M6 12v5c0 1.3 2.7 3 6 3s6-1.7 6-3v-5"/><path d="M22 10v6"/></svg>
				</span>
				<div class="nvblog-program__body">
					<span class="nvblog-program__eyebrow"><?php echo esc_html( $nvb_program['eyebrow'] ); ?></span>
					<h2 class="nvblog-program__title"><?php echo esc_html( $nvb_program['title'] ); ?></h2>
					<p class="nvblog-program__desc"><?php echo esc_html( $nvb_program['desc'] ); ?></p>
				</div>
				<a class="nvblog-program__cta" href="<?php echo esc_url( $nvb_program['url'] ); ?>">
					<?php echo esc_html( $nvb_program['cta'] ); ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
				</a>
			</aside>
		<?php endif; ?>

		<?php if ( $nvb_prev || $nvb_next ) : ?>
			<nav class="nvblog-prevnext" aria-label="<?php esc_attr_e( 'تصفّح المقالات بالترتيب', 'novira-academy' ); ?>">
				<?php if ( $nvb_prev ) : $nvb_pcat = novira_blog_primary_category( $nvb_prev->ID ); ?>
					<a class="nvblog-pn nvblog-pn--prev" href="<?php echo esc_url( get_permalink( $nvb_prev ) ); ?>" rel="prev">
						<span class="nvblog-pn__dir"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 6l6 6-6 6"/></svg> <?php esc_html_e( 'المقال السابق', 'novira-academy' ); ?></span>
						<span class="nvblog-pn__title"><?php echo esc_html( get_the_title( $nvb_prev ) ); ?></span>
						<span class="nvblog-pn__meta"><?php echo $nvb_pcat ? esc_html( $nvb_pcat->name ) . ' · ' : ''; ?><?php echo esc_html( novira_blog_reading_time_label( $nvb_prev->ID ) ); ?></span>
					</a>
				<?php endif; ?>
				<?php if ( $nvb_next ) : $nvb_ncat = novira_blog_primary_category( $nvb_next->ID ); ?>
					<a class="nvblog-pn nvblog-pn--next" href="<?php echo esc_url( get_permalink( $nvb_next ) ); ?>" rel="next">
						<span class="nvblog-pn__dir"><?php esc_html_e( 'المقال التالي', 'novira-academy' ); ?> <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 6l-6 6 6 6"/></svg></span>
						<span class="nvblog-pn__title"><?php echo esc_html( get_the_title( $nvb_next ) ); ?></span>
						<span class="nvblog-pn__meta"><?php echo $nvb_ncat ? esc_html( $nvb_ncat->name ) . ' · ' : ''; ?><?php echo esc_html( novira_blog_reading_time_label( $nvb_next->ID ) ); ?></span>
					</a>
				<?php endif; ?>
			</nav>
		<?php endif; ?>

		<aside class="nvblog-consult" aria-label="<?php esc_attr_e( 'استشارة', 'novira-academy' ); ?>">
			<span class="nvblog-consult__icon" aria-hidden="true">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.4 8.4 0 0 1-11.9 7.6L3 21l1.9-6.1A8.4 8.4 0 1 1 21 11.5Z"/></svg>
			</span>
			<div class="nvblog-consult__text">
				<b><?php esc_html_e( 'عندك سؤال يخص طالبك؟', 'novira-academy' ); ?></b>
				<span><?php esc_html_e( 'كلّمنا مباشرة — نجيبك ونرشّح الخطوة المناسبة، بلا التزام.', 'novira-academy' ); ?></span>
			</div>
			<div class="nvblog-consult__actions">
				<a class="nvblog-consult__wa" href="https://wa.me/<?php echo esc_attr( $nvb_whatsapp ); ?>" target="_blank" rel="noopener noreferrer">
					<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.5 15.2L2 22l4.9-1.4A10 10 0 1 0 12 2zm0 18.2a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-2.9.8.8-2.8-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.4-.7-1.7-.8s-.4-.1-.6.1-.6.8-.8 1-.3.2-.6.1a6.7 6.7 0 0 1-2-1.2 7.4 7.4 0 0 1-1.3-1.7c-.1-.2 0-.4.1-.5l.4-.5.3-.4v-.4c0-.1-.6-1.4-.8-1.9s-.4-.4-.5-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.2 5.2 0 0 0 1.1 2.8 11.8 11.8 0 0 0 4.5 4c.6.3 1.1.4 1.5.5a3.7 3.7 0 0 0 1.6.1c.5-.1 1.4-.6 1.6-1.1a2 2 0 0 0 .1-1.1c0-.2-.2-.2-.5-.4z"/></svg>
					<?php esc_html_e( 'استشارة على واتساب', 'novira-academy' ); ?>
				</a>
				<a class="nvblog-consult__link" href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'صفحة التواصل', 'novira-academy' ); ?></a>
			</div>
		</aside>

	</div>
</section>
