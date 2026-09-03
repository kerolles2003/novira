<?php
/**
 * 404 (Not Found) Template
 *
 * Renders inside the <main id="primary"> opened by header.php (footer.php
 * closes it), so no additional <main> landmark is added here.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$e404_whatsapp = get_theme_mod( 'novira_whatsapp', '201090600927' );

// Primary destinations to recover navigation.
$e404_links = array(
	array( 'url' => home_url( '/' ),                  'label' => __( 'الرئيسية', 'novira-academy' ) ),
	array( 'url' => home_url( '/american-diploma/' ), 'label' => __( 'الدبلومة الأمريكية', 'novira-academy' ) ),
	array( 'url' => home_url( '/translation/' ),      'label' => __( 'الترجمة المعتمدة', 'novira-academy' ) ),
	array( 'url' => home_url( '/education/' ),         'label' => __( 'التعليم والتطوير المهني', 'novira-academy' ) ),
	array( 'url' => home_url( '/exams/' ),             'label' => __( 'الامتحانات', 'novira-academy' ) ),
	array( 'url' => home_url( '/contact/' ),           'label' => __( 'تواصل معنا', 'novira-academy' ) ),
);

get_header();
?>

<section class="e404" aria-labelledby="e404-title">
	<div class="e404__inner">
		<p class="e404__code" aria-hidden="true">404</p>
		<h1 class="e404__title" id="e404-title"><?php esc_html_e( 'عذراً، الصفحة غير موجودة', 'novira-academy' ); ?></h1>
		<p class="e404__desc">
			<?php esc_html_e( 'قد يكون الرابط قديماً أو تمت إزالة الصفحة. يمكنك البحث أو الانتقال إلى أحد أقسامنا.', 'novira-academy' ); ?>
		</p>

		<div class="e404__search">
			<?php get_search_form(); ?>
		</div>

		<nav class="e404__links" aria-label="<?php esc_attr_e( 'روابط سريعة', 'novira-academy' ); ?>">
			<?php foreach ( $e404_links as $e404_link ) : ?>
				<a class="e404__link" href="<?php echo esc_url( $e404_link['url'] ); ?>"><?php echo esc_html( $e404_link['label'] ); ?></a>
			<?php endforeach; ?>
		</nav>

		<a class="e404__wa" href="https://wa.me/<?php echo esc_attr( $e404_whatsapp ); ?>" target="_blank" rel="noopener noreferrer">
			<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.5 14.4c-.3-.15-1.8-.9-2-1s-.5-.15-.7.15-.8 1-1 1.2-.35.2-.65.05a8.2 8.2 0 0 1-2.4-1.5 9 9 0 0 1-1.65-2.05c-.15-.3 0-.45.15-.6l.45-.5c.15-.2.2-.3.3-.5s0-.4 0-.55-.7-1.65-.95-2.25c-.25-.6-.5-.5-.7-.5h-.6a1.1 1.1 0 0 0-.8.4A3.4 3.4 0 0 0 6 9c0 1.5 1.1 3 1.25 3.2s2.15 3.3 5.2 4.6c.7.3 1.25.5 1.7.65.7.2 1.35.2 1.85.1.55-.05 1.75-.7 2-1.4s.25-1.3.2-1.4-.25-.2-.55-.35z"/><path d="M12 2A10 10 0 0 0 3.5 17.2L2 22l5-1.5A10 10 0 1 0 12 2zm0 18.2a8.2 8.2 0 0 1-4.2-1.15l-.3-.18-3.1.8.83-3-.2-.3A8.2 8.2 0 1 1 12 20.2z"/></svg>
			<?php esc_html_e( 'تواصل معنا عبر واتساب', 'novira-academy' ); ?>
		</a>
	</div>
</section>

<style>
/* Self-contained styling for the standalone error page (no dedicated
   stylesheet is enqueued for it). Uses the site's brand purple. */
.e404 { display: flex; align-items: center; justify-content: center; text-align: center;
	min-height: 62vh; padding: 96px 20px 72px;
	background: radial-gradient(120% 80% at 50% 0%, #7b2cff 0%, rgba(123,44,255,0) 55%), linear-gradient(135deg, #2a0a66 0%, #5b14e6 70%);
	font-family: var(--ff-body, 'Almarai', sans-serif); }
.e404__inner { width: 100%; max-width: 620px; color: #fff; }
.e404__code { font-family: var(--ff-display, 'Noto Kufi Arabic', sans-serif); font-weight: 800;
	font-size: clamp(72px, 16vw, 132px); line-height: 1; margin: 0; letter-spacing: 2px;
	background: linear-gradient(180deg, #fff, rgba(255,255,255,.55)); -webkit-background-clip: text; background-clip: text; color: transparent; }
.e404__title { font-family: var(--ff-display, 'Noto Kufi Arabic', sans-serif); font-weight: 800;
	font-size: clamp(22px, 4vw, 32px); margin: 6px 0 12px; }
.e404__desc { font-size: clamp(15px, 1.6vw, 17px); line-height: 1.8; color: rgba(255,255,255,.85);
	max-width: 460px; margin: 0 auto 26px; }
.e404__search { max-width: 420px; margin: 0 auto 24px; }
.e404__search :is(input[type="search"], input[type="text"]) { width: 100%; height: 50px; padding: 0 16px;
	border: 1.5px solid rgba(255,255,255,.3); border-radius: 12px; background: rgba(255,255,255,.12);
	color: #fff; font-family: inherit; font-size: 15px; }
.e404__search input::placeholder { color: rgba(255,255,255,.65); }
.e404__search :is(input[type="search"], input[type="text"]):focus { outline: none; border-color: #fff; background: rgba(255,255,255,.2); }
.e404__search button { margin-top: 10px; height: 46px; padding: 0 22px; border: 0; border-radius: 12px;
	cursor: pointer; color: #5b14e6; background: #fff; font-family: inherit; font-weight: 800; font-size: 15px; }
.e404__links { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; margin: 0 auto 26px; }
.e404__link { color: #fff; text-decoration: none; font-weight: 700; font-size: 14px; padding: 9px 16px;
	border: 1px solid rgba(255,255,255,.28); border-radius: 999px; background: rgba(255,255,255,.08);
	transition: background .2s ease, transform .2s ease; }
.e404__link:hover { background: rgba(255,255,255,.18); transform: translateY(-2px); }
.e404__wa { display: inline-flex; align-items: center; gap: 9px; color: #5b14e6; font-weight: 800; font-size: 15px;
	text-decoration: none; padding: 12px 24px; border-radius: 999px; background: #fff;
	box-shadow: 0 14px 30px rgba(20,5,52,.35); transition: transform .2s ease; }
.e404__wa:hover { transform: translateY(-2px); }
@media (prefers-reduced-motion: reduce) {
	.e404__link, .e404__wa { transition: none; }
}
</style>

<?php
get_footer();
