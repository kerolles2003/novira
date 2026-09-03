<?php
/**
 * Single Learning Article — blog_post.
 *
 * A reading-first educational experience: lavender article hero (breadcrumb →
 * category → title → lead → byline/date/reading-time), a featured banner that
 * bridges into the body, a reading-progress bar, an auto-generated sticky
 * table-of-contents, and generously-set Arabic prose that supports the full
 * range of editorial + educational blocks. Scoped under `.nvblog`; styles in
 * assets/css/blog-article.css and behaviour in assets/js/blog-article.js
 * (enqueued from inc/blog-single.php). Renders inside the header's <main id="primary">.
 *
 * @package Novira_Academy
 */

get_header();

while ( have_posts() ) :
	the_post();

	$nvb_cat    = novira_blog_primary_category();
	$nvb_accent = novira_blog_accent( $nvb_cat );

	// Render + prepare the body (heading anchors, TOC, responsive tables).
	list( $nvb_html, $nvb_toc ) = novira_blog_prepare_article( apply_filters( 'the_content', get_the_content() ) );

	$nvb_updated  = ( get_the_modified_date( 'Ymd' ) > get_the_date( 'Ymd' ) );
	$nvb_home     = esc_url( home_url( '/' ) );
	$nvb_blog_url = esc_url( get_post_type_archive_link( 'blog_post' ) );

	// Localised strings for the progressive-enhancement behaviours (finish time,
	// resume prompt, per-heading copy-link) — read by blog-article.js.
	$nvb_i18n = wp_json_encode(
		array(
			/* translators: %s: local clock time the article is estimated to finish. */
			'finish'    => __( 'تنتهي نحو %s', 'novira-academy' ),
			'resume'    => __( 'أكمل القراءة من حيث توقفت', 'novira-academy' ),
			'resumeBtn' => __( 'متابعة القراءة', 'novira-academy' ),
			'dismiss'   => __( 'إغلاق', 'novira-academy' ),
			'copy'      => __( 'نسخ رابط هذا القسم', 'novira-academy' ),
			'copied'    => __( 'تم نسخ الرابط', 'novira-academy' ),
		)
	);
	?>

	<div class="nvblog nvblog-single" style="--cc: <?php echo esc_attr( $nvb_accent ); ?>;" data-reading-min="<?php echo esc_attr( novira_blog_reading_time() ); ?>" data-i18n="<?php echo esc_attr( $nvb_i18n ); ?>">

		<div class="nvblog-progress" aria-hidden="true"><span class="nvblog-progress__bar"></span></div>

		<article <?php post_class( 'nvblog-article' ); ?>>

			<header class="nvblog-arthero">
				<div class="nvblog-arthero__bg" aria-hidden="true"><span class="nvblog-arthero__grid"></span></div>
				<div class="nvblog-container">
					<div class="nvblog-arthero__inner">

						<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'مسار التنقل', 'novira-academy' ); ?>">
							<ol class="nvblog-crumbs">
								<?php
								// Single source shared with the BreadcrumbList JSON-LD (expanded to
								// Home › Blog › Category › Article by novira_blog_breadcrumb_trail()).
								$nvb_trail = novira_breadcrumb_trail();
								$nvb_last  = count( $nvb_trail ) - 1;
								foreach ( $nvb_trail as $nvb_i => $nvb_crumb ) :
									if ( $nvb_i === $nvb_last ) :
										?>
										<li aria-current="page"><?php echo esc_html( $nvb_crumb['name'] ); ?></li>
									<?php else : ?>
										<li><a href="<?php echo esc_url( $nvb_crumb['url'] ); ?>"><?php echo esc_html( $nvb_crumb['name'] ); ?></a></li>
										<?php
									endif;
								endforeach;
								?>
							</ol>
						</nav>

						<?php if ( $nvb_cat ) : ?>
							<a class="nvblog-artcat" href="<?php echo esc_url( get_term_link( $nvb_cat ) ); ?>"><?php echo esc_html( $nvb_cat->name ); ?></a>
						<?php endif; ?>

						<h1 class="nvblog-arthero__title"><?php the_title(); ?></h1>

						<?php if ( has_excerpt() ) : ?>
							<p class="nvblog-arthero__lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
						<?php endif; ?>

						<div class="nvblog-artmeta">
							<span class="nvblog-artmeta__author">
								<?php echo get_avatar( get_the_author_meta( 'ID' ), 34, '', '', array( 'loading' => 'lazy' ) ); ?>
								<b><?php the_author(); ?></b>
							</span>
							<span class="nvblog-artmeta__sep" aria-hidden="true"></span>
							<span class="nvblog-artmeta__item">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4.5" width="18" height="17" rx="2.5"/><path d="M3 9.5h18M8 2.5v4M16 2.5v4"/></svg>
								<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></time>
							</span>
							<?php if ( $nvb_updated ) : ?>
								<span class="nvblog-artmeta__sep" aria-hidden="true"></span>
								<span class="nvblog-artmeta__item nvblog-artmeta__updated">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 11a8 8 0 1 0-2.3 5.7"/><path d="M20 5.5v6h-6"/></svg>
									<time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( sprintf( __( 'آخر تحديث %s', 'novira-academy' ), get_the_modified_date( 'j F Y' ) ) ); ?></time>
								</span>
							<?php endif; ?>
							<span class="nvblog-artmeta__sep" aria-hidden="true"></span>
							<span class="nvblog-artmeta__item">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7.5v5l3 1.8"/></svg>
								<span><?php echo esc_html( novira_blog_reading_time_label() ); ?></span>
							</span>
							<span class="nvblog-artmeta__finish" hidden></span>
						</div>

					</div>
				</div>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="nvblog-artmedia">
					<div class="nvblog-container">
						<figure class="nvblog-artmedia__frame">
							<?php
							the_post_thumbnail(
								'large',
								array(
									'alt'           => the_title_attribute( array( 'echo' => false ) ),
									'fetchpriority' => 'high',
									'decoding'      => 'async',
									'sizes'         => '(min-width: 1200px) 1140px, 100vw',
								)
							);
							?>
						</figure>
					</div>
				</div>
			<?php endif; ?>

			<div class="nvblog-artbody">
				<div class="nvblog-container">
					<div class="nvblog-article__grid">

						<?php if ( ! empty( $nvb_toc ) ) : ?>
							<details class="nvblog-toc" open>
								<summary class="nvblog-toc__summary">
									<svg class="nvblog-toc__ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 6h12M8 12h12M8 18h9"/><path d="M4 6h.01M4 12h.01M4 18h.01"/></svg>
									<?php esc_html_e( 'في هذا المقال', 'novira-academy' ); ?>
									<svg class="nvblog-toc__chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>
								</summary>
								<nav class="nvblog-toc__nav" aria-label="<?php esc_attr_e( 'محتويات المقال', 'novira-academy' ); ?>">
									<ul class="nvblog-toc__list">
										<?php foreach ( $nvb_toc as $nvb_item ) : ?>
											<li class="lvl-<?php echo (int) $nvb_item['level']; ?>"><a href="#<?php echo esc_attr( $nvb_item['id'] ); ?>"><?php echo esc_html( $nvb_item['text'] ); ?></a></li>
										<?php endforeach; ?>
									</ul>
								</nav>
							</details>
						<?php endif; ?>

						<div class="nvblog-prose">
							<?php echo $nvb_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- already run through the_content filters, then anchor/TOC/table processing. ?>
							<?php novira_blog_render_sources(); // Dormant EEAT references — prints only when sources exist. ?>
						</div>

					</div>
				</div>
			</div>

		</article>

		<?php get_template_part( 'template-parts/blog/journey' ); ?>
	</div>

	<?php
endwhile;

get_footer();
