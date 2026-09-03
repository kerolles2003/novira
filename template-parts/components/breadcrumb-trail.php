<?php
/**
 * Component: Visible Breadcrumb Trail
 *
 * Rendering only — no business logic, no page-specific names, no hardcoded
 * chains. Consumes novira_breadcrumb_trail() (inc/seo.php), the single source
 * of truth shared with the BreadcrumbList JSON-LD. Future hierarchical pages
 * (/american-diploma/est, …) render correctly with zero changes here.
 *
 * Uses the existing `.breadcrumbs` markup convention so it inherits current
 * styles without introducing any new CSS.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'novira_breadcrumb_trail' ) ) {
	return;
}

$novira_crumbs = novira_breadcrumb_trail();

// Nothing meaningful to show (e.g. front page or a single top-level crumb).
if ( count( $novira_crumbs ) < 2 ) {
	return;
}

$novira_last = count( $novira_crumbs ) - 1;
?>
<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'مسار التنقل', 'novira-academy' ); ?>">
	<ol class="breadcrumbs-list">
		<?php foreach ( $novira_crumbs as $novira_index => $novira_crumb ) : ?>
			<?php if ( $novira_index === $novira_last ) : ?>
				<li aria-current="page"><?php echo esc_html( $novira_crumb['name'] ); ?></li>
			<?php else : ?>
				<li>
					<a href="<?php echo esc_url( $novira_crumb['url'] ); ?>"><?php echo esc_html( $novira_crumb['name'] ); ?></a>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ol>
</nav>
