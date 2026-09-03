<?php
/**
 * Blog Archive (/blog) — "رؤى نوفيرا".
 *
 * A premium, search-first educational library for the blog_post CPT. Section
 * order on page 1: search hero → editorial lead (featured focal + most-read
 * rail) → Popular Categories directory → latest grid (with category chips) →
 * pagination → contact CTA. Deeper pages drop the lead/directory and show the
 * grid. All markup is scoped under `.nvblog`; styles in assets/css/blog-archive.css
 * (enqueued from inc/blog-archive.php). Renders inside the header's <main id="primary">.
 *
 * @package Novira_Academy
 */

get_header();

// Whether to show the page-1-only editorial blocks (lead + category directory).
$nvb_has_posts = have_posts();
$nvb_show_lead = $nvb_has_posts && ! is_paged();

// Popular categories for the hero quick-links (real, expandable terms).
$nvb_quick = novira_blog_top_categories( 5 );
?>

<div class="nvblog">

	<section class="nvblog-hero" aria-labelledby="nvblog-hero-title">
		<div class="nvblog-hero__bg" aria-hidden="true">
			<span class="nvblog-hero__glow nvblog-hero__glow--a"></span>
			<span class="nvblog-hero__glow nvblog-hero__glow--b"></span>
			<span class="nvblog-hero__grid"></span>
		</div>
		<div class="nvblog-container">
			<div class="nvblog-hero__inner">
				<?php get_template_part( 'template-parts/components/breadcrumb-trail' ); ?>

				<span class="nvblog-eyebrow nvblog-animate nvblog-animate--1">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 5a2 2 0 0 1 2-2h6v18H6a2 2 0 0 0-2 2zM20 5a2 2 0 0 0-2-2h-6v18h6a2 2 0 0 1 2 2z"/></svg>
					<?php esc_html_e( 'مكتبة نوفيرا التعليمية', 'novira-academy' ); ?>
				</span>

				<h1 id="nvblog-hero-title" class="nvblog-hero__title nvblog-animate nvblog-animate--2">
					<?php esc_html_e( 'رؤى تُرافق', 'novira-academy' ); ?> <span><?php esc_html_e( 'رحلة طالبك', 'novira-academy' ); ?></span>
				</h1>

				<p class="nvblog-hero__desc nvblog-animate nvblog-animate--3">
					<?php esc_html_e( 'مقالات ودلائل عملية حول الدبلومة الأمريكية والاستعداد لاختبارات EST و Digital SAT و ACT، ومهارات الدراسة والتقديم الجامعي — بلا حشو، خطوة بخطوة.', 'novira-academy' ); ?>
				</p>

				<div class="nvblog-animate nvblog-animate--4">
					<?php get_template_part( 'template-parts/blog/search-form' ); ?>

					<?php if ( ! empty( $nvb_quick ) ) : ?>
						<div class="nvblog-quick">
							<span class="nvblog-quick__label"><?php esc_html_e( 'مواضيع شائعة:', 'novira-academy' ); ?></span>
							<?php foreach ( $nvb_quick as $nvb_term ) : ?>
								<a class="nvblog-quick__link" href="<?php echo esc_url( get_term_link( $nvb_term ) ); ?>"><?php echo esc_html( $nvb_term->name ); ?></a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<?php
	if ( $nvb_show_lead ) {
		get_template_part( 'template-parts/blog/lead' );
		get_template_part( 'template-parts/blog/popular-categories' );
	}

	get_template_part(
		'template-parts/blog/results',
		null,
		array(
			'current'    => 'all',
			'context'    => 'archive',
			'after_lead' => $nvb_show_lead,
			'grid_title' => $nvb_show_lead ? __( 'أحدث المقالات', 'novira-academy' ) : __( 'كل المقالات', 'novira-academy' ),
			'eyebrow'    => __( 'تصفّح المكتبة', 'novira-academy' ),
		)
	);

	get_template_part( 'template-parts/blog/cta' );
	?>

</div>

<?php
get_footer();
