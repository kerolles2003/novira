<?php
/**
 * Empty state — no articles yet (archive) or an empty category (taxonomy).
 * Offers a clear next step plus links to other populated categories.
 * $args['context']: 'archive' (default) | 'taxonomy'.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nvb_context = isset( $args['context'] ) ? $args['context'] : 'archive';

if ( 'taxonomy' === $nvb_context ) {
	$nvb_title = __( 'لا توجد مقالات في هذا التصنيف بعد', 'novira-academy' );
	$nvb_desc  = __( 'جرّب تصنيفًا آخر من الأسفل، أو تصفّح كل المقالات المنشورة.', 'novira-academy' );
} else {
	$nvb_title = __( 'المكتبة قيد التجهيز', 'novira-academy' );
	$nvb_desc  = __( 'نعمل على نشر أول مقالاتنا التعليمية. تابعنا قريبًا، أو تواصل معنا لأي سؤال يخص طالبك.', 'novira-academy' );
}

// Other populated categories to guide the reader onward (empty on a brand-new blog).
$nvb_empty_cats = novira_blog_top_categories( 5 );
?>
<div class="nvblog-empty">
	<div class="nvblog-empty__art" aria-hidden="true">
		<svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
			<path d="M32 19c-4.6-3.4-10.2-4.2-19-3.4v29c8.8-.8 14.4 0 19 3.4 4.6-3.4 10.2-4.2 19-3.4v-29c-8.8-.8-14.4 0-19 3.4z"/>
			<path d="M32 19v29"/>
			<path d="M48 10.5l1.7 3.6 3.8.5-2.8 2.6.7 3.8-3.4-1.9-3.4 1.9.7-3.8-2.8-2.6 3.8-.5z" fill="currentColor" stroke="none" opacity=".9"/>
		</svg>
	</div>
	<h2 class="nvblog-empty__title"><?php echo esc_html( $nvb_title ); ?></h2>
	<p class="nvblog-empty__desc"><?php echo esc_html( $nvb_desc ); ?></p>
	<div class="nvblog-empty__actions">
		<?php if ( 'taxonomy' === $nvb_context ) : ?>
			<a class="nvblog-btn nvblog-btn--primary" href="<?php echo esc_url( get_post_type_archive_link( 'blog_post' ) ); ?>"><?php esc_html_e( 'كل المقالات', 'novira-academy' ); ?></a>
			<a class="nvblog-btn nvblog-btn--ghost" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'العودة للرئيسية', 'novira-academy' ); ?></a>
		<?php else : ?>
			<a class="nvblog-btn nvblog-btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'العودة للرئيسية', 'novira-academy' ); ?></a>
			<a class="nvblog-btn nvblog-btn--ghost" href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'تواصل معنا', 'novira-academy' ); ?></a>
		<?php endif; ?>
	</div>

	<?php if ( ! empty( $nvb_empty_cats ) ) : ?>
		<div class="nvblog-empty__cats">
			<span class="nvblog-empty__cats-label"><?php esc_html_e( 'أو تصفّح موضوعًا آخر:', 'novira-academy' ); ?></span>
			<?php foreach ( $nvb_empty_cats as $nvb_ec ) : ?>
				<a class="nvblog-empty__cat" style="--cc: <?php echo esc_attr( novira_blog_accent( $nvb_ec ) ); ?>;" href="<?php echo esc_url( get_term_link( $nvb_ec ) ); ?>"><?php echo esc_html( $nvb_ec->name ); ?></a>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>
