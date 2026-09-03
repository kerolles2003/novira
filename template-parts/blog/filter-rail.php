<?php
/**
 * Blog category filter chips — real, expandable blog_category terms, each carrying
 * its category accent as a colour dot, horizontally scrollable on small screens.
 * Rendered inside the list section, beneath its heading.
 *
 * $args['current']: 'all' (default) or a term ID — drives the active state.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nvb_current = isset( $args['current'] ) ? $args['current'] : 'all';
$nvb_terms   = get_terms( array(
	'taxonomy'   => 'blog_category',
	'hide_empty' => true,
	'orderby'    => 'count',
	'order'      => 'DESC',
) );
if ( is_wp_error( $nvb_terms ) ) {
	$nvb_terms = array();
}
?>
<nav class="nvblog-filters" aria-label="<?php esc_attr_e( 'تصفية المقالات حسب التصنيف', 'novira-academy' ); ?>">
	<div class="nvblog-filters__track">
		<a class="nvblog-chip" href="<?php echo esc_url( get_post_type_archive_link( 'blog_post' ) ); ?>"<?php echo ( 'all' === $nvb_current ) ? ' aria-current="true"' : ''; ?>>
			<?php esc_html_e( 'كل المقالات', 'novira-academy' ); ?>
		</a>
		<?php foreach ( $nvb_terms as $nvb_term ) : ?>
			<a class="nvblog-chip" style="--cc: <?php echo esc_attr( novira_blog_accent( $nvb_term ) ); ?>;" href="<?php echo esc_url( get_term_link( $nvb_term ) ); ?>"<?php echo ( (int) $nvb_current === (int) $nvb_term->term_id ) ? ' aria-current="true"' : ''; ?>>
				<span class="nvblog-chip__dot" aria-hidden="true"></span><?php echo esc_html( $nvb_term->name ); ?><span class="nvblog-chip__count"><?php echo esc_html( number_format_i18n( $nvb_term->count ) ); ?></span>
			</a>
		<?php endforeach; ?>
	</div>
</nav>
