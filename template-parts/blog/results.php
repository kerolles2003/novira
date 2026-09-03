<?php
/**
 * Blog results block — the list section (eyebrow + heading + category chips +
 * article grid + pagination) and the empty state. Operates on the main query.
 *
 * $args['current']    mixed  Active category for the chips ('all' | term ID).
 * $args['context']    string 'archive' | 'taxonomy' (empty-state copy).
 * $args['grid_title'] string Heading above the grid.
 * $args['eyebrow']    string Small label above the heading.
 * $args['after_lead'] bool   True when a lead/featured block already rendered on
 *                            this page, so an exhausted query shows no empty state.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nvb_current    = isset( $args['current'] ) ? $args['current'] : 'all';
$nvb_context    = isset( $args['context'] ) ? $args['context'] : 'archive';
$nvb_grid_title = isset( $args['grid_title'] ) ? $args['grid_title'] : __( 'أحدث المقالات', 'novira-academy' );
$nvb_eyebrow    = isset( $args['eyebrow'] ) ? $args['eyebrow'] : __( 'تصفّح المكتبة', 'novira-academy' );
$nvb_after_lead = ! empty( $args['after_lead'] );

if ( have_posts() ) :
	?>
	<section class="nvblog-list" aria-label="<?php echo esc_attr( $nvb_grid_title ); ?>">
		<div class="nvblog-container">
			<div class="nvblog-list__head">
				<span class="nvblog-head__eyebrow">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h10"/></svg>
					<?php echo esc_html( $nvb_eyebrow ); ?>
				</span>
				<h2 class="nvblog-head__title"><?php echo esc_html( $nvb_grid_title ); ?></h2>
			</div>

			<?php get_template_part( 'template-parts/blog/filter-rail', null, array( 'current' => $nvb_current ) ); ?>

			<div class="nvblog-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/blog/card' );
				endwhile;
				?>
			</div>

			<?php get_template_part( 'template-parts/blog/pagination' ); ?>
		</div>
	</section>
	<?php
elseif ( ! $nvb_after_lead ) :
	?>
	<section class="nvblog-section">
		<div class="nvblog-container">
			<?php get_template_part( 'template-parts/blog/empty', null, array( 'context' => $nvb_context ) ); ?>
		</div>
	</section>
	<?php
endif;
