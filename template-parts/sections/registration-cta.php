<?php
/**
 * Template Part: Registration CTA Section (Redesigned — "enrollment card")
 *
 * The homepage conversion moment: a deep-purple band with a high-contrast white
 * enrollment card (floating labels + tactile program chips). Posts to the
 * existing admin-post handler — the field contract is unchanged:
 *   action=novira_registration, nonce=novira_registration_nonce,
 *   fields: first_name, last_name, program, phone.
 *
 * All markup is scoped under `.nrf`.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$whatsapp = get_theme_mod( 'novira_whatsapp', '201090600927' );

// Post-submit state (handler redirects to /?registration=success|error).
$nrf_state = isset( $_GET['registration'] ) ? sanitize_key( wp_unslash( $_GET['registration'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

$nrf_programs = array(
	'american-diploma' => __( 'الدبلومة الأمريكية', 'novira-academy' ),
	'translation'      => __( 'الترجمة المعتمدة', 'novira-academy' ),
	'languages-skills' => __( 'تنمية المهارات واللغات', 'novira-academy' ),
);
?>

<section class="nrf" id="register" aria-label="<?php esc_attr_e( 'التسجيل', 'novira-academy' ); ?>">
	<div class="nrf__bg" aria-hidden="true">
		<span class="nrf__glow nrf__glow--a"></span>
		<span class="nrf__glow nrf__glow--b"></span>
		<span class="nrf__grid"></span>
	</div>

	<div class="nrf__container">

		<?php // ---------- Copy side ---------- ?>
		<div class="nrf__copy">
			<span class="nrf__eyebrow" data-reveal>
				<span class="nrf__pulse" aria-hidden="true"></span>
				<?php esc_html_e( 'التسجيل المبكر مفتوح الآن', 'novira-academy' ); ?>
			</span>
			<h2 class="nrf__title" data-reveal style="--i:1"><?php esc_html_e( 'هل طالبك جاهز للبدء؟', 'novira-academy' ); ?></h2>
			<p class="nrf__desc" data-reveal style="--i:2">
				<?php esc_html_e( 'أرسل بياناتك وسيتواصل معك فريقنا لمناقشة المرحلة الدراسية والاختبار المناسب لطالبك.', 'novira-academy' ); ?>
			</p>

			<ul class="nrf__trust" data-reveal style="--i:3" role="list">
				<li class="nrf__trust-item">
					<span class="nrf__trust-ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7.5V12l3 2"/></svg></span>
					<?php esc_html_e( 'رد خلال ساعات', 'novira-academy' ); ?>
				</li>
				<li class="nrf__trust-item">
					<span class="nrf__trust-ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2.5 5 5.2v5.3c0 4.4 3 8.5 7 9.9 4-1.4 7-5.5 7-9.9V5.2z"/><path d="m9.2 12 2 2 3.6-3.6"/></svg></span>
					<?php esc_html_e( 'استشارة مجانية', 'novira-academy' ); ?>
				</li>
				<li class="nrf__trust-item">
					<span class="nrf__trust-ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 20v-1.5a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4V20"/><circle cx="9" cy="7.5" r="3.5"/><path d="M22 20v-1.5a4 4 0 0 0-3-3.9"/><path d="M16 4.1a3.5 3.5 0 0 1 0 6.8"/></svg></span>
					<?php esc_html_e( '+1500 طالب التحقوا بنا', 'novira-academy' ); ?>
				</li>
			</ul>

			<a href="https://wa.me/<?php echo esc_attr( $whatsapp ); ?>"
			   class="nrf__wa" data-reveal style="--i:4"
			   target="_blank" rel="noopener noreferrer">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.5 14.4c-.3-.15-1.8-.9-2-1s-.5-.15-.7.15-.8 1-1 1.2-.35.2-.65.05a8.2 8.2 0 0 1-2.4-1.5 9 9 0 0 1-1.65-2.05c-.15-.3 0-.45.15-.6l.45-.5c.15-.2.2-.3.3-.5s0-.4 0-.55-.7-1.65-.95-2.25c-.25-.6-.5-.5-.7-.5h-.6a1.1 1.1 0 0 0-.8.4A3.4 3.4 0 0 0 6 9c0 1.5 1.1 3 1.25 3.2s2.15 3.3 5.2 4.6c.7.3 1.25.5 1.7.65.7.2 1.35.2 1.85.1.55-.05 1.75-.7 2-1.4s.25-1.3.2-1.4-.25-.2-.55-.35z"/><path d="M12 2A10 10 0 0 0 3.5 17.2L2 22l5-1.5A10 10 0 1 0 12 2zm0 18.2a8.2 8.2 0 0 1-4.2-1.15l-.3-.18-3.1.8.83-3-.2-.3A8.2 8.2 0 1 1 12 20.2z"/></svg>
				<?php esc_html_e( 'تفضّل التواصل واتساب؟', 'novira-academy' ); ?>
			</a>
		</div>

		<?php // ---------- Enrollment card ---------- ?>
		<div class="nrf__card-wrap" data-reveal>
			<form class="nrf-card" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
				<?php wp_nonce_field( 'novira_registration', 'novira_registration_nonce' ); ?>
				<input type="hidden" name="action" value="novira_registration">
					<?php // Honeypot: hidden from real users; bots that fill it are rejected server-side. ?>
					<div class="nrf-hp" aria-hidden="true" style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden">
						<label for="nrf-hp"><?php esc_html_e( 'اترك هذا الحقل فارغاً', 'novira-academy' ); ?></label>
						<input type="text" id="nrf-hp" name="novira_hp" tabindex="-1" autocomplete="off">
					</div>

				<div class="nrf-card__head">
					<span class="nrf-card__ico" aria-hidden="true">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M15.5 3.5 20 8 9 19l-4.5.5L5 15z"/><path d="M13.5 5.5 18 10"/></svg>
					</span>
					<div>
						<h3 class="nrf-card__title"><?php esc_html_e( 'سجّل بيانات طالبك', 'novira-academy' ); ?></h3>
						<p class="nrf-card__sub"><?php esc_html_e( 'ونتواصل معك خلال 24 ساعة لتحديد الأنسب.', 'novira-academy' ); ?></p>
					</div>
				</div>

				<?php if ( 'success' === $nrf_state ) : ?>
					<div class="nrf-alert nrf-alert--ok" role="status">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="m8.5 12 2.5 2.5 4.5-5"/></svg>
						<?php esc_html_e( 'تم استلام طلبك! سيتواصل معك فريقنا قريباً.', 'novira-academy' ); ?>
					</div>
				<?php elseif ( 'error' === $nrf_state ) : ?>
					<div class="nrf-alert nrf-alert--err" role="alert">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 8v5M12 16h.01"/></svg>
						<?php esc_html_e( 'يرجى مراجعة البيانات والمحاولة مرة أخرى.', 'novira-academy' ); ?>
					</div>
				<?php endif; ?>

				<div class="nrf-row">
					<div class="nrf-field">
						<input class="nrf-input" type="text" name="first_name" id="nrf-first" placeholder=" " required>
						<label class="nrf-label" for="nrf-first"><?php esc_html_e( 'الاسم الأول', 'novira-academy' ); ?></label>
					</div>
					<div class="nrf-field">
						<input class="nrf-input" type="text" name="last_name" id="nrf-last" placeholder=" " required>
						<label class="nrf-label" for="nrf-last"><?php esc_html_e( 'الاسم الأخير', 'novira-academy' ); ?></label>
					</div>
				</div>

				<div class="nrf-field nrf-field--phone">
					<input class="nrf-input" type="tel" name="phone" id="nrf-phone" placeholder=" " inputmode="tel" required>
					<label class="nrf-label" for="nrf-phone"><?php esc_html_e( 'رقم واتساب', 'novira-academy' ); ?></label>
					<span class="nrf-prefix" aria-hidden="true">+20</span>
				</div>

				<fieldset class="nrf-programs">
					<legend class="nrf-programs__label"><?php esc_html_e( 'البرنامج المطلوب', 'novira-academy' ); ?></legend>
					<div class="nrf-chips">
						<?php $nrf_first = true; foreach ( $nrf_programs as $nrf_val => $nrf_lbl ) : ?>
							<label class="nrf-chip">
								<input type="radio" name="program" value="<?php echo esc_attr( $nrf_val ); ?>"<?php echo $nrf_first ? ' required' : ''; ?>>
								<span><?php echo esc_html( $nrf_lbl ); ?></span>
							</label>
						<?php $nrf_first = false; endforeach; ?>
					</div>
				</fieldset>

				<button type="submit" class="nrf-submit">
					<span class="nrf-submit__txt" data-loading="<?php esc_attr_e( 'جاري الإرسال…', 'novira-academy' ); ?>"><?php esc_html_e( 'احجز مكان طالبك', 'novira-academy' ); ?></span>
					<span class="nrf-submit__ico" aria-hidden="true">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 6l-6 6 6 6"/><path d="M18 12H5"/></svg>
					</span>
				</button>

				<p class="nrf-card__note">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/></svg>
					<?php esc_html_e( 'بياناتك آمنة — نستخدمها فقط للتواصل معك.', 'novira-academy' ); ?>
				</p>
			</form>
		</div>

	</div>
</section>

<style>
.nrf {
	--n-purple: #5b14e6; --n-violet: #7b2cff; --n-ink: #1a0a3d; --n-muted: #6f63a3;
	--n-line: #e9e3f7; --n-soft: #fbfaff;
	position: relative; overflow: hidden; isolation: isolate;
	padding: 84px 0;
	background: radial-gradient(120% 90% at 85% 0%, #7b2cff 0%, rgba(123,44,255,0) 55%), linear-gradient(135deg, #2a0a66 0%, #5b14e6 60%, #7b2cff 100%);
	font-family: var(--ff-body, 'Almarai', sans-serif);
}
.nrf *, .nrf *::before, .nrf *::after { box-sizing: border-box; }
.nrf__bg { position: absolute; inset: 0; z-index: -1; pointer-events: none; }
.nrf__glow { position: absolute; border-radius: 50%; filter: blur(120px); }
.nrf__glow--a { top: -30%; right: -8%; width: 40%; height: 70%; background: rgba(255,255,255,.16); }
.nrf__glow--b { bottom: -34%; left: -10%; width: 46%; height: 80%; background: rgba(30,10,70,.5); }
.nrf__grid { position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px); background-size: 48px 48px; mask-image: radial-gradient(75% 70% at 30% 40%, #000, transparent 78%); }

.nrf__container { width: 100%; max-width: 1160px; margin-inline: auto; padding-inline: 24px; display: grid; grid-template-columns: 0.9fr 1.1fr; gap: 50px; align-items: center; }

/* ---- Copy ---- */
.nrf__copy { color: #fff; text-align: start; }
.nrf__eyebrow { display: inline-flex; align-items: center; gap: 9px; font-weight: 700; font-size: 13.5px; color: #fff; background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.25); padding: 7px 15px; border-radius: 999px; backdrop-filter: blur(6px); }
.nrf__pulse { width: 9px; height: 9px; border-radius: 50%; background: #4ade80; box-shadow: 0 0 0 0 rgba(74,222,128,.6); animation: nrf-pulse 2s infinite; }
@keyframes nrf-pulse { 0% { box-shadow: 0 0 0 0 rgba(74,222,128,.55); } 70% { box-shadow: 0 0 0 8px rgba(74,222,128,0); } 100% { box-shadow: 0 0 0 0 rgba(74,222,128,0); } }
.nrf__title { font-family: var(--ff-display, 'Noto Kufi Arabic', sans-serif); font-weight: 800; font-size: clamp(30px, 4vw, 50px); line-height: 1.22; margin: 18px 0 16px; text-shadow: 0 8px 30px rgba(20,5,52,.35); }
.nrf__desc { font-size: clamp(15px, 1.5vw, 18px); line-height: 1.85; color: rgba(255,255,255,.85); max-width: 420px; margin: 0 0 26px; margin-inline-start: auto; }
.nrf__trust { list-style: none; margin: 0 0 28px; padding: 0; display: flex; flex-direction: column; gap: 13px; }
.nrf__trust-item { display: flex; align-items: center; gap: 11px; font-size: 15px; font-weight: 700; color: #fff; }
.nrf__trust-ico { width: 38px; height: 38px; border-radius: 11px; display: grid; place-items: center; background: rgba(255,255,255,.14); border: 1px solid rgba(255,255,255,.2); color: #fff; flex: none; }
.nrf__wa { display: inline-flex; align-items: center; gap: 10px; color: #fff; font-weight: 700; font-size: 15px; text-decoration: none; padding: 12px 22px; border-radius: 999px; border: 1.5px solid rgba(255,255,255,.35); background: rgba(255,255,255,.08); transition: background .2s ease, transform .2s ease; }
.nrf__wa:hover { background: rgba(255,255,255,.16); transform: translateY(-2px); }

/* ---- Enrollment card ---- */
.nrf-card { position: relative; background: #fff; border-radius: 26px; padding: 32px 30px; box-shadow: 0 40px 90px rgba(20,5,52,.4); }
.nrf-card__head { display: flex; align-items: center; gap: 14px; margin-bottom: 22px; }
.nrf-card__ico { width: 50px; height: 50px; border-radius: 15px; display: grid; place-items: center; color: #fff; background: linear-gradient(135deg, #7b2cff, #5b14e6); box-shadow: 0 12px 24px rgba(91,20,230,.32); flex: none; }
.nrf-card__title { font-family: var(--ff-display, sans-serif); font-weight: 800; font-size: 21px; color: var(--n-ink); margin: 0 0 3px; }
.nrf-card__sub { font-size: 12.5px; color: var(--n-muted); margin: 0; }

.nrf-alert { display: flex; align-items: center; gap: 9px; font-size: 13.5px; font-weight: 700; padding: 12px 15px; border-radius: 13px; margin-bottom: 18px; }
.nrf-alert svg { flex: none; }
.nrf-alert--ok { background: #e9f9ef; color: #0f9d58; border: 1px solid #bfeccf; }
.nrf-alert--err { background: #fdecec; color: #d13438; border: 1px solid #f6c9c9; }

.nrf-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.nrf-field { position: relative; margin-bottom: 14px; }
.nrf-input { width: 100%; height: 56px; padding: 22px 15px 8px; border: 1.5px solid var(--n-line); border-radius: 14px; background: var(--n-soft); color: var(--n-ink); font-family: inherit; font-size: 15px; transition: border-color .2s ease, box-shadow .2s ease, background .2s ease; }
.nrf-input:focus { outline: none; border-color: var(--n-purple); background: #fff; box-shadow: 0 0 0 4px rgba(91,20,230,.12); }
.nrf-label { position: absolute; inset-inline-start: 15px; top: 17px; color: var(--n-muted); font-size: 15px; pointer-events: none; transform-origin: right top; transition: top .18s ease, font-size .18s ease, color .18s ease, font-weight .18s ease; }
.nrf-input:focus + .nrf-label, .nrf-input:not(:placeholder-shown) + .nrf-label { top: 8px; font-size: 11.5px; font-weight: 700; color: var(--n-purple); }
.nrf-field--phone .nrf-input { padding-inline-end: 52px; direction: rtl; }
.nrf-prefix { position: absolute; inset-inline-end: 14px; top: 50%; transform: translateY(-50%); color: var(--n-muted); font-weight: 800; font-size: 14px; direction: ltr; pointer-events: none; }

.nrf-programs { border: 0; padding: 0; margin: 2px 0 20px; }
.nrf-programs__label { font-size: 12.5px; font-weight: 700; color: var(--n-muted); padding: 0; margin-bottom: 9px; }
.nrf-chips { display: grid; grid-template-columns: repeat(3, 1fr); gap: 9px; }
.nrf-chip { position: relative; display: block; cursor: pointer; }
.nrf-chip input { position: absolute; inset: 0; opacity: 0; cursor: pointer; margin: 0; }
.nrf-chip span { display: block; padding: 11px 8px; text-align: center; font-size: 12.5px; font-weight: 700; line-height: 1.35; color: var(--n-ink); background: var(--n-soft); border: 1.5px solid var(--n-line); border-radius: 12px; transition: border-color .18s ease, background .18s ease, color .18s ease, box-shadow .18s ease, transform .18s ease; }
.nrf-chip:hover span { border-color: #c9b6f3; }
.nrf-chip input:focus-visible + span { border-color: var(--n-purple); box-shadow: 0 0 0 3px rgba(91,20,230,.18); }
.nrf-chip input:checked + span { border-color: var(--n-purple); color: var(--n-purple); background: linear-gradient(135deg, rgba(123,44,255,.12), rgba(91,20,230,.09)); box-shadow: 0 8px 18px rgba(91,20,230,.16); transform: translateY(-2px); }

.nrf-submit { position: relative; overflow: hidden; width: 100%; display: flex; align-items: center; justify-content: center; gap: 10px; padding: 15px; border: 0; border-radius: 15px; cursor: pointer; color: #fff; font-family: var(--ff-display, sans-serif); font-weight: 800; font-size: 16px; background: linear-gradient(120deg, #7b2cff, #5b14e6); box-shadow: 0 16px 32px rgba(91,20,230,.34); transition: transform .2s ease, box-shadow .2s ease; }
.nrf-submit::after { content: ""; position: absolute; inset: 0; background: linear-gradient(120deg, transparent 35%, rgba(255,255,255,.4) 50%, transparent 65%); transform: translateX(-130%); transition: transform .7s ease; }
.nrf-submit:hover { transform: translateY(-2px); box-shadow: 0 22px 40px rgba(91,20,230,.46); }
.nrf-submit:hover::after { transform: translateX(130%); }
.nrf-submit:active { transform: translateY(0) scale(.99); }
.nrf-submit__ico { display: inline-flex; transition: transform .2s ease; }
.nrf-submit:hover .nrf-submit__ico { transform: translateX(-4px); }
.nrf-submit.is-loading { pointer-events: none; opacity: .85; }
.nrf-submit.is-loading .nrf-submit__ico { animation: nrf-spin .7s linear infinite; }
@keyframes nrf-spin { to { transform: rotate(-360deg); } }
.nrf-card__note { display: flex; align-items: center; justify-content: center; gap: 7px; margin: 14px 0 0; font-size: 11.5px; color: var(--n-muted); }

/* ---- Reveal ---- */
.nrf [data-reveal] { opacity: 0; transform: translateY(24px); transition: opacity .6s ease, transform .6s ease; transition-delay: calc(var(--i, 0) * 80ms); }
.nrf__card-wrap[data-reveal] { transform: translateY(30px) scale(.98); }
.nrf [data-reveal].is-in { opacity: 1; transform: none; }
@media (prefers-reduced-motion: reduce) {
	.nrf [data-reveal] { opacity: 1; transform: none; transition: none; }
	.nrf__pulse, .nrf-submit::after { animation: none; }
}

/* ---- Responsive ---- */
@media (max-width: 900px) {
	.nrf { padding: 62px 0; }
	.nrf__container { grid-template-columns: 1fr; gap: 34px; max-width: 560px; }
	.nrf__copy { text-align: center; }
	.nrf__desc { margin-inline: auto; }
	.nrf__trust { align-items: center; }
}
@media (max-width: 520px) {
	.nrf__container { padding-inline: 18px; }
	.nrf-card { padding: 26px 20px; border-radius: 22px; }
	.nrf-row { grid-template-columns: 1fr; gap: 0; }
	.nrf-chips { grid-template-columns: 1fr; }
	.nrf-chip span { padding: 12px 14px; }
}
/* LTR activation (inert under RTL): mirror the submit arrow glyph and follow
   reading order on the hover nudge. */
[dir="ltr"] .nrf-submit__ico svg { transform: scaleX(-1); }
[dir="ltr"] .nrf-submit:hover .nrf-submit__ico { transform: translateX(4px); }
</style>

<script>
( function () {
	var root = document.querySelector( '.nrf' );
	if ( ! root ) { return; }

	/* Scroll reveal */
	var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var reveals = root.querySelectorAll( '[data-reveal]' );
	if ( reveals.length ) {
		if ( ! ( 'IntersectionObserver' in window ) || reduce ) {
			reveals.forEach( function ( el ) { el.classList.add( 'is-in' ); } );
		} else {
			var io = new IntersectionObserver( function ( entries ) {
				entries.forEach( function ( e ) { if ( e.isIntersecting ) { e.target.classList.add( 'is-in' ); io.unobserve( e.target ); } } );
			}, { threshold: 0.15, rootMargin: '0px 0px -8% 0px' } );
			reveals.forEach( function ( el ) { io.observe( el ); } );
		}
	}

	/* Submit loading state (the real POST proceeds normally) */
	var form = root.querySelector( '.nrf-card' );
	var btn = root.querySelector( '.nrf-submit' );
	if ( form && btn ) {
		form.addEventListener( 'submit', function () {
			if ( form.checkValidity && ! form.checkValidity() ) { return; }
			btn.classList.add( 'is-loading' );
			var t = btn.querySelector( '.nrf-submit__txt' );
			if ( t ) { t.textContent = t.getAttribute( 'data-loading' ) || t.textContent; }
		} );
	}

	/* After redirect, bring the form into view so the result banner is seen */
	if ( /[?&]registration=/.test( window.location.search ) ) {
		var target = document.getElementById( 'register' );
		if ( target ) { setTimeout( function () { target.scrollIntoView( { behavior: 'smooth', block: 'center' } ); }, 300 ); }
	}
}() );
</script>
