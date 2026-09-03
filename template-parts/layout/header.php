<?php
/**
 * Template Part: Header Navigation (Redesigned)
 *
 * Clean white navbar with logo_horizontal.webp, nav links, and WhatsApp CTA.
 * Mobile: slide-in panel from right (RTL).
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$whatsapp = get_theme_mod( 'novira_whatsapp', '201090600927' );
$logo_url = get_template_directory_uri() . '/assets/images/logo_horizontal.webp';
$site_url = home_url( '/' );

// American Diploma dropdown — driven from the exam registry so it never drifts
// from the offered exams (EST / Digital SAT / ACT).
$diploma_url   = home_url( '/american-diploma/' );
$diploma_exams = function_exists( 'novira_diploma_offered_programs' ) ? novira_diploma_offered_programs() : array();
if ( empty( $diploma_exams ) ) {
	$diploma_exams = array(
		array( 'name' => 'EST', 'page_slug' => 'est' ),
		array( 'name' => 'Digital SAT', 'page_slug' => 'digital-sat' ),
		array( 'name' => 'ACT', 'page_slug' => 'act' ),
	);
}
?>

<header class="site-header fixed top-0 left-0 w-full z-50 bg-white/90 backdrop-blur-md shadow-sm transition-all duration-300" role="banner">
	<nav class="main-nav" aria-label="<?php esc_attr_e( 'القائمة الرئيسية', 'novira-academy' ); ?>">

		<!-- Logo -->
		<a href="<?php echo esc_url( $site_url ); ?>" class="nav-logo" aria-label="<?php bloginfo( 'name' ); ?>">
			<img
				src="<?php echo esc_url( $logo_url ); ?>"
				alt="<?php bloginfo( 'name' ); ?>"
				class="nav-logo__img"
				width="180"
				height="40"
				decoding="async"
			>
		</a>

		<!-- Desktop links -->
		<ul class="nav-links" role="list">
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'items_wrap'     => '%3$s',
					'link_before'    => '',
					'link_after'     => '',
					'depth'          => 2,
					'walker'         => new Novira_Walker_Nav_Desktop(),
				) );
				?>
			<?php else : ?>
				<li><a href="<?php echo esc_url( $site_url ); ?>"><?php esc_html_e( 'الرئيسية', 'novira-academy' ); ?></a></li>
				<li class="has-dropdown">
					<div class="nav-dropdown-trigger">
						<a href="<?php echo esc_url( $diploma_url ); ?>"><?php esc_html_e( 'الدبلومة الأمريكية', 'novira-academy' ); ?></a>
						<button type="button"
								class="nav-dropdown-toggle"
								aria-expanded="false"
								aria-controls="diploma-dropdown"
								aria-label="<?php esc_attr_e( 'عرض اختبارات الدبلومة', 'novira-academy' ); ?>">
							<svg class="nav-dropdown-caret" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<path d="M6 9l6 6 6-6"/>
							</svg>
						</button>
					</div>
					<ul class="nav-dropdown" id="diploma-dropdown" role="list">
						<li class="nav-dropdown__label" role="presentation"><?php esc_html_e( 'اختبارات الدبلومة', 'novira-academy' ); ?></li>
						<?php foreach ( $diploma_exams as $diploma_exam ) : ?>
							<li>
								<a href="<?php echo esc_url( home_url( '/american-diploma/' . $diploma_exam['page_slug'] . '/' ) ); ?>">
									<span class="nav-dropdown__name"><?php echo esc_html( $diploma_exam['name'] ); ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</li>
				<li><a href="<?php echo esc_url( home_url( '/translation/' ) ); ?>"><?php esc_html_e( 'الترجمة المعتمدة', 'novira-academy' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/education/' ) ); ?>"><?php esc_html_e( 'التعليم والتطوير المهني', 'novira-academy' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/courses/' ) ); ?>"><?php esc_html_e( 'الكورسات', 'novira-academy' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/exams/' ) ); ?>"><?php esc_html_e( 'الامتحانات', 'novira-academy' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'المقالات', 'novira-academy' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'من نحن', 'novira-academy' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'تواصل معنا', 'novira-academy' ); ?></a></li>
			<?php endif; ?>
		</ul>

		<!-- Right side: language switcher + CTA + hamburger -->
		<div class="nav-actions">
			<?php novira_language_switcher( 'desktop' ); ?>

			<a href="https://wa.me/<?php echo esc_attr( $whatsapp ); ?>"
			   class="nav-cta"
			   target="_blank"
			   rel="noopener noreferrer">
				<?php esc_html_e( 'احجز تقييم', 'novira-academy' ); ?>
			</a>

			<button class="nav-hamburger"
					aria-controls="mobile-nav"
					aria-expanded="false"
					aria-label="<?php esc_attr_e( 'فتح القائمة', 'novira-academy' ); ?>">
				<span class="nav-hamburger__line"></span>
				<span class="nav-hamburger__line"></span>
			</button>
		</div>

	</nav>
</header>

<!-- Mobile slide-in panel -->
<div class="mobile-nav" id="mobile-nav" aria-hidden="true" role="dialog" aria-label="<?php esc_attr_e( 'القائمة', 'novira-academy' ); ?>">
	<div class="mobile-nav__header">
		<a href="<?php echo esc_url( $site_url ); ?>" class="mobile-nav__logo" aria-label="<?php bloginfo( 'name' ); ?>">
			<img
				src="<?php echo esc_url( $logo_url ); ?>"
				alt="<?php bloginfo( 'name' ); ?>"
				class="mobile-nav__logo-img"
				width="150"
				height="34" decoding="async"
			>
		</a>
		<button class="mobile-nav__close" aria-label="<?php esc_attr_e( 'إغلاق القائمة', 'novira-academy' ); ?>">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
				<path d="M18 6L6 18M6 6l12 12"/>
			</svg>
		</button>
	</div>

	<ul class="mobile-nav__links" role="list">
		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'link_before'    => '',
				'link_after'     => '',
				'depth'          => 2,
				'walker'         => new Novira_Walker_Nav_Mobile(),
			) );
			?>
		<?php else : ?>
			<li><a href="<?php echo esc_url( $site_url ); ?>"><?php esc_html_e( 'الرئيسية', 'novira-academy' ); ?></a></li>
			<li class="has-dropdown">
				<div class="mobile-nav__row">
					<a href="<?php echo esc_url( $diploma_url ); ?>"><?php esc_html_e( 'الدبلومة الأمريكية', 'novira-academy' ); ?></a>
					<button type="button"
							class="mobile-subnav-toggle"
							aria-expanded="false"
							aria-controls="mobile-diploma-subnav"
							aria-label="<?php esc_attr_e( 'عرض اختبارات الدبلومة', 'novira-academy' ); ?>">
						<svg class="nav-dropdown-caret" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="M6 9l6 6 6-6"/>
						</svg>
					</button>
				</div>
				<ul class="mobile-subnav" id="mobile-diploma-subnav" role="list">
					<?php foreach ( $diploma_exams as $diploma_exam ) : ?>
						<li><a href="<?php echo esc_url( home_url( '/american-diploma/' . $diploma_exam['page_slug'] . '/' ) ); ?>"><?php echo esc_html( $diploma_exam['name'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</li>
			<li><a href="<?php echo esc_url( home_url( '/translation/' ) ); ?>"><?php esc_html_e( 'الترجمة المعتمدة', 'novira-academy' ); ?></a></li>
			<li><a href="<?php echo esc_url( home_url( '/education/' ) ); ?>"><?php esc_html_e( 'التعليم والتطوير المهني', 'novira-academy' ); ?></a></li>
			<li><a href="<?php echo esc_url( home_url( '/courses/' ) ); ?>"><?php esc_html_e( 'الكورسات', 'novira-academy' ); ?></a></li>
			<li><a href="<?php echo esc_url( home_url( '/exams/' ) ); ?>"><?php esc_html_e( 'الامتحانات', 'novira-academy' ); ?></a></li>
			<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'المقالات', 'novira-academy' ); ?></a></li>
			<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'من نحن', 'novira-academy' ); ?></a></li>
			<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'تواصل معنا', 'novira-academy' ); ?></a></li>
		<?php endif; ?>
	</ul>

	<?php novira_language_switcher( 'mobile' ); ?>

	<a href="https://wa.me/<?php echo esc_attr( $whatsapp ); ?>"
	   class="mobile-nav__cta"
	   target="_blank"
	   rel="noopener noreferrer">
		<?php esc_html_e( 'احجز تقييم', 'novira-academy' ); ?>
	</a>
</div>
<div class="mobile-nav__backdrop" aria-hidden="true"></div>
