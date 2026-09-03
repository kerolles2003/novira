<?php
/**
 * Blog search — a blog_post-scoped site search, styled as the hero centrepiece.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<form role="search" method="get" class="nvblog-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="nvblog-search__field">
		<span class="nvblog-search__icon" aria-hidden="true">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
		</span>
		<label for="nvblog-search-input" class="screen-reader-text"><?php esc_html_e( 'ابحث في المقالات', 'novira-academy' ); ?></label>
		<input
			type="search"
			id="nvblog-search-input"
			name="s"
			class="nvblog-search__input"
			value="<?php echo esc_attr( get_search_query() ); ?>"
			placeholder="<?php esc_attr_e( 'ابحث عن موضوع… مثلاً: الاستعداد لاختبار EST', 'novira-academy' ); ?>"
			autocomplete="off"
		>
		<input type="hidden" name="post_type" value="blog_post">
		<button type="submit" class="nvblog-search__btn"><?php esc_html_e( 'ابحث', 'novira-academy' ); ?></button>
	</div>
</form>
