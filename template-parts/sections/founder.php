<?php
/**
 * Template Part: Founder Trust Block (single source of truth)
 *
 * The founder's photo and copy live here ONCE. The About page renders the
 * full version; the homepage renders a compact version with a link back to
 * About. Reused content — nothing here is new.
 *
 * Development Visual Mode: the two-column "documentary profile" always renders.
 * Uses the real founder photo when present, else a replaceable placeholder, so
 * the layout never collapses. Replacement = drop in assets/images/founder.jpg
 * OR swap assets/placeholders/founder-placeholder.jpg — no PHP edit needed.
 *
 * @package Novira_Academy
 *
 * @param array $args {
 *     @type bool $compact         Render the short homepage version. Default false.
 *     @type bool $show_about_link Show a link to the About page. Default false.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$compact         = ! empty( $args['compact'] );
$show_about_link = ! empty( $args['show_about_link'] );
$founder_src     = file_exists( get_template_directory() . '/assets/images/founder.jpg' )
	? get_template_directory_uri() . '/assets/images/founder.jpg'
	: get_template_directory_uri() . '/assets/images/founder/founder.webp';

// Real credentials, drawn only from the verified bio below — nothing invented.
$founder_creds = array(
	__( 'بكالوريوس اللغات والترجمة الفورية', 'novira-academy' ),
	__( 'الدبلومة الأمريكية', 'novira-academy' ),
	__( 'اختبارات EST · SAT · ACT', 'novira-academy' ),
);
?>
<section class="founder-section founder--v2 reveal" aria-label="<?php esc_attr_e( 'المؤسس', 'novira-academy' ); ?>">
	<div class="fdr__inner">

		<!-- Portrait + monogram seal (signature element) -->
		<figure class="fdr__portrait">
			<span class="fdr__panel" aria-hidden="true"></span>
			<span class="fdr__frame">
				<img class="fdr__img" src="<?php echo esc_url( $founder_src ); ?>" width="800" height="800"
					alt="<?php esc_attr_e( 'مؤسس أكاديمية نوفيرا — مستر يوسف زكي', 'novira-academy' ); ?>" loading="lazy" decoding="async">
			</span>
			<span class="fdr__mono" aria-hidden="true">م</span>
		</figure>

		<!-- Documentary profile -->
		<div class="fdr__body">
			<span class="fdr__eyebrow"><span class="fdr__tick" aria-hidden="true"></span><?php esc_html_e( 'المؤسس', 'novira-academy' ); ?></span>

			<h2 class="fdr__name"><?php esc_html_e( 'يوسف', 'novira-academy' ); ?> <span class="accent"><?php esc_html_e( 'زكي', 'novira-academy' ); ?></span></h2>

			<p class="fdr__lead"><?php esc_html_e( 'مؤسس أكاديمية نوفيرا أكاديمي، يمتلك خبرة واسعة في مجال الدبلومة الأمريكية واللغة الإنجليزية والاختبارات الدولية لسنوات.', 'novira-academy' ); ?></p>

			<?php if ( ! $compact ) : ?>
				<p class="fdr__lead fdr__para"><?php esc_html_e( 'حاصل على بكالوريوس اللغات والترجمة الفورية، واهتم خلال مسيرته المهنية بتطوير المهارات وبناء القدرات بأسلوب عملي ومبتكر.', 'novira-academy' ); ?></p>
				<p class="fdr__lead fdr__para"><?php esc_html_e( 'انطلق في تأسيس الأكاديمية إيمانًا منه بأهمية التعليم والتدريب في تحقيق النجاح، وحرصًا على تقديم محتوى تدريبي عالي الجودة يواكب متطلبات سوق العمل ويساهم في إعداد كوادر مؤهلة وقادرة على التطور المستمر.', 'novira-academy' ); ?></p>
			<?php endif; ?>

			<ul class="fdr__creds" aria-label="<?php esc_attr_e( 'المؤهلات', 'novira-academy' ); ?>">
				<?php foreach ( $founder_creds as $cred ) : ?>
					<li class="fdr__chip"><?php echo esc_html( $cred ); ?></li>
				<?php endforeach; ?>
			</ul>

			<p class="fdr__sign" aria-hidden="true"><?php esc_html_e( 'يوسف زكي', 'novira-academy' ); ?></p>

			<?php if ( $compact && $show_about_link ) : ?>
				<a class="btn-primary fdr__cta" href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'تعرّف أكثر على نوفيرا أكاديمي', 'novira-academy' ); ?></a>
			<?php endif; ?>
		</div>

	</div>
</section>

<style>
/* === FOUNDER — documentary profile (scoped, brand-native, RTL-first) === */
.founder--v2 {
	position: relative;
	overflow: hidden;
	padding: clamp(64px, 9vw, 112px) 0;
	background:
		radial-gradient(120% 90% at 100% 0%, rgba(123, 44, 255, 0.07), transparent 55%),
		radial-gradient(90% 80% at 0% 100%, rgba(33, 150, 255, 0.06), transparent 55%),
		var(--white);
}
.founder--v2 .fdr__inner {
	max-width: 1120px;
	margin: 0 auto;
	padding: 0 clamp(20px, 5vw, 40px);
	display: grid;
	grid-template-columns: 330px 1fr;
	gap: clamp(36px, 6vw, 80px);
	align-items: center;
}

/* Portrait */
.founder--v2 .fdr__portrait { position: relative; margin: 0; width: 100%; max-width: 330px; }
.founder--v2 .fdr__panel {
	position: absolute; inset: 0;
	border-radius: var(--radius-xl);
	background: var(--grad);
	transform: translate(-18px, 18px);
	opacity: 0;
}
.founder--v2 .fdr__frame {
	position: relative; display: block;
	width: 100%; aspect-ratio: 1 / 1;
	border-radius: var(--radius-xl);
	overflow: hidden;
	border: 5px solid #fff;
	box-shadow: 0 30px 64px -26px rgba(91, 20, 230, 0.5);
	will-change: transform;
}
.founder--v2 .fdr__img { display: block; width: 100%; height: 100%; object-fit: cover; }
.founder--v2 .fdr__mono {
	position: absolute; inset-block-end: -20px; inset-inline-start: -20px;
	width: 76px; height: 76px;
	display: grid; place-items: center;
	border-radius: var(--radius-full);
	background: var(--grad);
	border: 4px solid #fff;
	color: #fff;
	font-family: var(--ff-display); font-weight: 800; font-size: 34px; line-height: 1;
	box-shadow: 0 16px 32px -10px rgba(91, 20, 230, 0.6);
}

/* Body */
.founder--v2 .fdr__eyebrow {
	display: inline-flex; align-items: center; gap: 12px;
	font-family: var(--ff-display); font-weight: 700; font-size: 14px;
	letter-spacing: 0.04em; color: var(--purple);
}
.founder--v2 .fdr__tick { width: 36px; height: 3px; border-radius: 2px; background: var(--grad); display: inline-block; transform-origin: right center; }
.founder--v2 .fdr__honorific { margin: 18px 0 0; font-family: var(--ff-body); font-size: 18px; color: var(--text-muted); }
.founder--v2 .fdr__name {
	margin: 2px 0 0;
	font-family: var(--ff-display); font-weight: 800;
	font-size: clamp(34px, 4.6vw, 58px); line-height: 1.08;
	color: var(--text-dark);
}
.founder--v2 .fdr__name .accent {
	background: var(--grad); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;
}
.founder--v2 .fdr__lead {
	margin: 18px 0 0;
	font-family: var(--ff-body); font-size: 17px; line-height: 1.9; color: var(--text-muted);
	max-width: 56ch;
}
.founder--v2 .fdr__para { font-size: 16px; }
.founder--v2 .fdr__creds { display: flex; flex-wrap: wrap; gap: 10px; margin: 26px 0 0; padding: 0; list-style: none; }
.founder--v2 .fdr__chip {
	font-family: var(--ff-body); font-weight: 700; font-size: 13px; color: var(--text-dark);
	background: var(--grad-soft); border: 1px solid rgba(91, 20, 230, 0.16);
	border-radius: var(--radius-pill); padding: 8px 16px;
}
.founder--v2 .fdr__sign {
	margin: 26px 0 0;
	font-family: var(--ff-display); font-weight: 700; font-size: 22px; color: var(--purple); opacity: 0.85;
}
.founder--v2 .fdr__sign::before { content: "—"; margin-inline-end: 10px; opacity: 0.55; }
.founder--v2 .fdr__cta { display: inline-flex; margin-top: 28px; }

/* === Orchestrated entrance (fires when .reveal gains .visible) === */
.founder--v2 .fdr__panel,
.founder--v2 .fdr__frame,
.founder--v2 .fdr__mono,
.founder--v2 .fdr__eyebrow,
.founder--v2 .fdr__honorific,
.founder--v2 .fdr__name,
.founder--v2 .fdr__lead,
.founder--v2 .fdr__chip,
.founder--v2 .fdr__sign,
.founder--v2 .fdr__cta {
	opacity: 0; transform: translateY(16px);
	transition: opacity 0.7s ease, transform 0.7s cubic-bezier(0.2, 0.7, 0.2, 1);
}
.founder--v2 .fdr__frame { transform: translateY(22px) scale(0.965); }
.founder--v2 .fdr__tick { transition: transform 0.6s cubic-bezier(0.2, 0.7, 0.2, 1) 0.18s; transform: scaleX(0); }
.founder--v2 .fdr__mono { transform: scale(0.4) rotate(-14deg); transition: opacity 0.6s ease 0.5s, transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 0.5s; }

.founder-section.visible.founder--v2 .fdr__panel { opacity: 0.14; transform: translate(-18px, 18px); transition-delay: 0.04s; }
.founder-section.visible.founder--v2 .fdr__frame { opacity: 1; transform: none; transition-delay: 0.06s; }
.founder-section.visible.founder--v2 .fdr__mono { opacity: 1; transform: none; }
.founder-section.visible.founder--v2 .fdr__eyebrow { opacity: 1; transform: none; transition-delay: 0.12s; }
.founder-section.visible.founder--v2 .fdr__tick { transform: scaleX(1); }
.founder-section.visible.founder--v2 .fdr__honorific { opacity: 1; transform: none; transition-delay: 0.18s; }
.founder-section.visible.founder--v2 .fdr__name { opacity: 1; transform: none; transition-delay: 0.24s; }
.founder-section.visible.founder--v2 .fdr__lead { opacity: 1; transform: none; transition-delay: 0.32s; }
.founder-section.visible.founder--v2 .fdr__para { transition-delay: 0.38s; }
.founder-section.visible.founder--v2 .fdr__chip { opacity: 1; transform: none; }
.founder-section.visible.founder--v2 .fdr__creds .fdr__chip:nth-child(1) { transition-delay: 0.44s; }
.founder-section.visible.founder--v2 .fdr__creds .fdr__chip:nth-child(2) { transition-delay: 0.52s; }
.founder-section.visible.founder--v2 .fdr__creds .fdr__chip:nth-child(3) { transition-delay: 0.60s; }
.founder-section.visible.founder--v2 .fdr__sign { opacity: 0.85; transform: none; transition-delay: 0.62s; }
.founder-section.visible.founder--v2 .fdr__cta { opacity: 1; transform: none; transition-delay: 0.66s; }

/* Hover micro-interactions (after entrance settles) */
.founder--v2 .fdr__frame, .founder--v2 .fdr__mono { transition-property: opacity, transform, box-shadow; }
.founder--v2 .fdr__portrait:hover .fdr__frame { transform: translateY(-6px); box-shadow: 0 40px 72px -26px rgba(91, 20, 230, 0.58); }
.founder--v2 .fdr__portrait:hover .fdr__mono { transform: rotate(-6deg) scale(1.08); }

/* Responsive */
@media (max-width: 860px) {
	.founder--v2 .fdr__inner { grid-template-columns: 1fr; text-align: center; gap: 44px; }
	.founder--v2 .fdr__portrait { max-width: 320px; margin-inline: auto; }
	.founder--v2 .fdr__eyebrow, .founder--v2 .fdr__creds { justify-content: center; }
	.founder--v2 .fdr__lead { margin-inline: auto; max-width: 100%; }
}

/* Respect reduced motion — render the final state, no movement */
@media (prefers-reduced-motion: reduce) {
	.founder--v2 .fdr__panel,
	.founder--v2 .fdr__frame,
	.founder--v2 .fdr__mono,
	.founder--v2 .fdr__eyebrow,
	.founder--v2 .fdr__tick,
	.founder--v2 .fdr__honorific,
	.founder--v2 .fdr__name,
	.founder--v2 .fdr__lead,
	.founder--v2 .fdr__chip,
	.founder--v2 .fdr__sign,
	.founder--v2 .fdr__cta {
		opacity: 1 !important; transform: none !important; transition: none !important;
	}
	.founder--v2 .fdr__panel { opacity: 0.14 !important; transform: translate(-18px, 18px) !important; }
	.founder--v2 .fdr__tick { transform: scaleX(1) !important; }
}
</style>
