<?php
/**
 * Blog category archive (/blog-category/…).
 *
 * Reuses the premium blog library shell so browsing a single topic stays inside
 * the same editorial experience: term-titled hero, the same search field and
 * category rail (with the current term active), grid, pagination, and CTA.
 *
 * @package Novira_Academy
 */

get_header();

$nvb_term = get_queried_object();
$nvb_name = ( $nvb_term && isset( $nvb_term->name ) ) ? $nvb_term->name : __( 'المقالات', 'novira-academy' );
$nvb_desc = ( $nvb_term && ! empty( $nvb_term->description ) )
	? $nvb_term->description
	: __( 'كل المقالات والدلائل المنشورة ضمن هذا التصنيف.', 'novira-academy' );
$nvb_tid  = ( $nvb_term && isset( $nvb_term->term_id ) ) ? (int) $nvb_term->term_id : 'all';
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
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.6 13.4 12 22l-9-9V4a1 1 0 0 1 1-1h8z"/><circle cx="7.5" cy="7.5" r="1.4" fill="currentColor" stroke="none"/></svg>
					<?php esc_html_e( 'تصنيف المقالات', 'novira-academy' ); ?>
				</span>

				<h1 id="nvblog-hero-title" class="nvblog-hero__title nvblog-animate nvblog-animate--2"><?php echo esc_html( $nvb_name ); ?></h1>

				<p class="nvblog-hero__desc nvblog-animate nvblog-animate--3"><?php echo esc_html( $nvb_desc ); ?></p>

				<div class="nvblog-animate nvblog-animate--4">
					<?php get_template_part( 'template-parts/blog/search-form' ); ?>
				</div>
			</div>
		</div>
	</section>

	<?php
	get_template_part(
		'template-parts/blog/results',
		null,
		array(
			'current'    => $nvb_tid,
			'context'    => 'taxonomy',
			'after_lead' => false,
			'eyebrow'    => __( 'تصنيف', 'novira-academy' ),
			/* translators: %s: category name. */
			'grid_title' => sprintf( __( 'مقالات ضمن %s', 'novira-academy' ), $nvb_name ),
		)
	);

	get_template_part( 'template-parts/blog/cta' );
	?>

</div>

<?php
get_footer();
