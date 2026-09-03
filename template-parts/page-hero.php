<section class="page-hero-banner">
	<div class="page-hero-orb page-hero-orb-1"></div>
	<div class="page-hero-orb page-hero-orb-2"></div>
	<div class="page-hero-content">
		<h1 class="page-hero-title"><?php echo esc_html( $args['title'] ?? get_the_title() ); ?></h1>
		<?php if ( ! empty( $args['subtitle'] ) ) : ?>
			<p class="page-hero-subtitle"><?php echo esc_html( $args['subtitle'] ); ?></p>
		<?php endif; ?>
		<nav class="breadcrumb" aria-label="breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'الرئيسية', 'novira-academy' ); ?></a>
			<span class="breadcrumb-sep">›</span>
			<span><?php echo esc_html( $args['title'] ?? get_the_title() ); ?></span>
		</nav>
	</div>
</section>
