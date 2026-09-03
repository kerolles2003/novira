<?php
/**
 * Template Part: Department Card Component
 *
 * Reusable card component for displaying a department.
 * Used in department navigation section.
 *
 * @package Novira_Academy
 *
 * @var array $args {
 *     Department data.
 *     @var string $title       Department title.
 *     @var string $description Department description.
 *     @var string $icon        Icon identifier (education, translation, diploma).
 *     @var string $url         Department page URL.
 *     @var array  $features    Array of key features.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$title       = isset( $args['title'] ) ? $args['title'] : '';
$description = isset( $args['description'] ) ? $args['description'] : '';
$icon        = isset( $args['icon'] ) ? $args['icon'] : 'education';
$url         = isset( $args['url'] ) ? $args['url'] : '#';
$features    = isset( $args['features'] ) ? $args['features'] : array();

// Icon SVGs
$icons = array(
	'education'   => '<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14v7m0-7l-6.16-3.422"/></svg>',
	'translation' => '<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6"/><path d="M12 18v-6"/><path d="M9 15h6"/></svg>',
	'diploma'     => '<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>',
);

$icon_svg = isset( $icons[ $icon ] ) ? $icons[ $icon ] : $icons['education'];
?>

<article class="department-card" aria-label="<?php echo esc_attr( $title ); ?>">
	<a href="<?php echo esc_url( $url ); ?>" class="card-link">
		<div class="card-icon">
			<?php echo $icon_svg; ?>
		</div>

		<h3 class="card-title"><?php echo esc_html( $title ); ?></h3>

		<p class="card-description"><?php echo esc_html( $description ); ?></p>

		<?php if ( ! empty( $features ) ) : ?>
			<ul class="card-features">
				<?php foreach ( $features as $feature ) : ?>
					<li class="feature-item">
						<span class="feature-check" aria-hidden="true">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<path d="M20 6L9 17l-5-5"/>
							</svg>
						</span>
						<?php echo esc_html( $feature ); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<span class="card-cta">
			<?php esc_html_e( 'اعرف المزيد', 'novira-academy' ); ?>
			<span class="cta-arrow" aria-hidden="true">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
					<path d="M5 12h14M12 5l7 7-7 7"/>
				</svg>
			</span>
		</span>
	</a>
</article>
