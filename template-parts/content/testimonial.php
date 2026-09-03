<?php
/**
 * Template Part: Testimonial Component
 *
 * Reusable component for displaying a testimonial.
 * Used in trust-proof section.
 *
 * @package Novira_Academy
 *
 * @var array $args {
 *     Testimonial data.
 *     @var string $quote  Testimonial quote text.
 *     @var string $author Author name.
 *     @var string $role   Author role/title.
 *     @var string $avatar Avatar image URL (optional).
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$quote  = isset( $args['quote'] ) ? $args['quote'] : '';
$author = isset( $args['author'] ) ? $args['author'] : '';
$role   = isset( $args['role'] ) ? $args['role'] : '';
$avatar = isset( $args['avatar'] ) ? $args['avatar'] : '';

// Generate initials for default avatar
$initials = '';
$name_parts = explode( ' ', $author );
foreach ( $name_parts as $part ) {
	$initials .= mb_substr( $part, 0, 1 );
}
$initials = mb_substr( $initials, 0, 2 );
?>

<blockquote class="testimonial-card" aria-label="<?php echo esc_attr( $author ); ?>">
	<div class="testimonial-quote">
		<span class="quote-mark" aria-hidden="true">
			<svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor" opacity="0.15">
				<path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
			</svg>
		</span>
		<p class="quote-text"><?php echo esc_html( $quote ); ?></p>
	</div>

	<div class="testimonial-author">
		<div class="author-avatar">
			<?php if ( $avatar ) : ?>
				<img src="<?php echo esc_url( $avatar ); ?>" 
					 alt="<?php echo esc_attr( $author ); ?>"
					 loading="lazy"
					 width="48"
					 height="48">
			<?php else : ?>
				<span class="avatar-initials" aria-hidden="true"><?php echo esc_html( $initials ); ?></span>
			<?php endif; ?>
		</div>
		<div class="author-info">
			<cite class="author-name"><?php echo esc_html( $author ); ?></cite>
			<span class="author-role"><?php echo esc_html( $role ); ?></span>
		</div>
	</div>

	<div class="testimonial-rating" aria-label="<?php esc_attr_e( 'تقييم 5 من 5', 'novira-academy' ); ?>">
		<?php for ( $i = 0; $i < 5; $i++ ) : ?>
			<span class="star" aria-hidden="true">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
					<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
				</svg>
			</span>
		<?php endfor; ?>
	</div>
</blockquote>
