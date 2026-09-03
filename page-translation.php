<?php
/**
 * Template: Certified Translation Landing
 *
 * Dedicated, pixel-matched landing page for the certified-translation service.
 * Force-routed for the `translation` page via novira_force_translation_template()
 * (template_include, functions.php). Uses the site's global header/footer
 * (get_header()/get_footer()) so the navbar and footer match every other page.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tl_whatsapp = get_theme_mod( 'novira_whatsapp', '201112690327' );
$tl_wa       = 'https://wa.me/' . $tl_whatsapp;
$tl_advisor  = get_template_directory_uri() . '/assets/images/founder/founder.webp';

get_header();
?>

<div class="tl">

	<?php // ===================== 1. HERO ===================== ?>
	<section class="tl-hero" aria-label="<?php esc_attr_e( 'ترجمة معتمدة', 'novira-academy' ); ?>">
		<div class="tl-hero__bg" aria-hidden="true">
			<span class="tl-hero__glow tl-hero__glow--a"></span>
			<span class="tl-hero__glow tl-hero__glow--b"></span>
			<span class="tl-hero__grid"></span>
		</div>
		<div class="tl-container tl-hero__grid-wrap">
			<div class="tl-hero__copy">
				<h1 class="tl-hero__title" data-reveal>
					<span class="tl-hero__title-lg"><?php esc_html_e( 'ترجمة معتمدة', 'novira-academy' ); ?></span>
					<span class="tl-hero__title-sm"><?php echo wp_kses( __( 'معترف بها لدى السفارات<br>والجامعات والجهات الرسمية', 'novira-academy' ), array( 'br' => array() ) ); ?></span>
				</h1>
				<p class="tl-hero__desc" data-reveal style="--i:1">
					<?php esc_html_e( 'ترجمة احترافية تتم مراجعتها بدقة من مترجم معتمد قبل التسليم لضمان قبولها من جميع الجهات.', 'novira-academy' ); ?>
				</p>

				<ul class="tl-hero__stats" role="list">
					<?php
					$tl_stats = array(
						array( 'v' => '+5000', 'count' => 5000, 'pre' => '+', 'l' => __( 'مستند تمت ترجمته', 'novira-academy' ), 'i' => 'file' ),
						array( 'v' => '100%',  'count' => 100,  'suf' => '%', 'l' => __( 'مراجعة قبل التسليم', 'novira-academy' ), 'i' => 'shield' ),
						array( 'v' => __( 'ترجمة معتمدة', 'novira-academy' ), 'l' => __( 'للسفارات والجهات الرسمية', 'novira-academy' ), 'i' => 'seal' ),
						array( 'v' => __( 'تسليم سريع', 'novira-academy' ), 'l' => __( 'في الوقت المحدد', 'novira-academy' ), 'i' => 'bolt' ),
						array( 'v' => __( 'سرية تامة', 'novira-academy' ), 'l' => __( 'لجميع الملفات', 'novira-academy' ), 'i' => 'lock' ),
					);
					foreach ( $tl_stats as $tl_i => $tl_s ) : ?>
						<li class="tl-stat" data-reveal style="--i:<?php echo (int) $tl_i + 2; ?>">
							<span class="tl-stat__ico"><?php echo novira_tl_icon( $tl_s['i'] ); // phpcs:ignore ?></span>
							<span class="tl-stat__v"<?php echo isset( $tl_s['count'] ) ? ' data-count="' . (int) $tl_s['count'] . '" data-pre="' . esc_attr( $tl_s['pre'] ?? '' ) . '" data-suf="' . esc_attr( $tl_s['suf'] ?? '' ) . '"' : ''; ?>><?php echo esc_html( $tl_s['v'] ); ?></span>
							<span class="tl-stat__l"><?php echo esc_html( $tl_s['l'] ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>

				<div class="tl-hero__cta" data-reveal style="--i:7">
					<a href="<?php echo esc_url( $tl_wa ); ?>" class="tl-btn tl-btn--primary tl-btn--lg" target="_blank" rel="noopener noreferrer">
						<?php echo novira_tl_icon( 'tag' ); // phpcs:ignore ?>
						<?php esc_html_e( 'احصل على تسعير مجاني', 'novira-academy' ); ?>
					</a>
					<a href="<?php echo esc_url( $tl_wa ); ?>" class="tl-btn tl-btn--ghost tl-btn--lg" target="_blank" rel="noopener noreferrer">
						<?php echo novira_tl_icon( 'whatsapp' ); // phpcs:ignore ?>
						<?php esc_html_e( 'تواصل واتساب', 'novira-academy' ); ?>
					</a>
				</div>
			</div>

			<div class="tl-hero__visual" data-reveal style="--i:3">
				<div class="tl-cert" aria-hidden="true">
					<span class="tl-cert__globe">
						<svg viewBox="0 0 200 200" class="tl-cert__globe-svg"><defs><radialGradient id="tlGlobe" cx="38%" cy="34%" r="75%"><stop offset="0%" stop-color="#8b5cff"/><stop offset="55%" stop-color="#5b14e6"/><stop offset="100%" stop-color="#2a0a66"/></radialGradient></defs><circle cx="100" cy="100" r="92" fill="url(#tlGlobe)"/><g fill="none" stroke="rgba(255,255,255,.35)" stroke-width="1.1"><ellipse cx="100" cy="100" rx="92" ry="34"/><ellipse cx="100" cy="100" rx="92" ry="64"/><ellipse cx="100" cy="100" rx="34" ry="92"/><ellipse cx="100" cy="100" rx="64" ry="92"/><line x1="8" y1="100" x2="192" y2="100"/><line x1="100" y1="8" x2="100" y2="192"/></g></svg>
					</span>
					<div class="tl-cert__paper">
						<span class="tl-cert__ribbon">CERTIFIED TRANSLATION</span>
						<span class="tl-cert__sub">Official Translation</span>
						<span class="tl-cert__line" style="width:88%"></span>
						<span class="tl-cert__line" style="width:74%"></span>
						<span class="tl-cert__line" style="width:82%"></span>
						<span class="tl-cert__line" style="width:60%"></span>
						<span class="tl-cert__line" style="width:78%"></span>
						<span class="tl-cert__seal">
							<svg viewBox="0 0 100 100"><defs><radialGradient id="tlSeal" cx="50%" cy="40%" r="60%"><stop offset="0%" stop-color="#f6d67b"/><stop offset="60%" stop-color="#d4a02a"/><stop offset="100%" stop-color="#a9781a"/></radialGradient></defs><circle cx="50" cy="50" r="30" fill="url(#tlSeal)" stroke="#8a5f12" stroke-width="1.5"/><circle cx="50" cy="50" r="22" fill="none" stroke="rgba(255,255,255,.6)" stroke-width="1"/><path d="M50 34l4.6 9.3 10.3 1.5-7.4 7.2 1.7 10.2L50 68.6l-9.2 4.8 1.7-10.2-7.4-7.2 10.3-1.5z" fill="#fff8e6"/></svg>
						</span>
						<span class="tl-cert__sign"></span>
					</div>
					<span class="tl-cert__stamp">
						<svg viewBox="0 0 90 120"><rect x="26" y="8" width="38" height="42" rx="9" fill="#3a1a8a"/><rect x="30" y="12" width="30" height="34" rx="6" fill="#5b14e6"/><rect x="34" y="48" width="22" height="12" rx="3" fill="#2a0a66"/><rect x="20" y="60" width="50" height="16" rx="5" fill="#c99a2e"/><ellipse cx="45" cy="104" rx="34" ry="9" fill="rgba(91,20,230,.18)"/></svg>
					</span>
				</div>
				<div class="tl-hero__badge">
					<span class="tl-hero__badge-ico"><?php echo novira_tl_icon( 'shield' ); // phpcs:ignore ?></span>
					<span><?php echo wp_kses( __( 'جودة ترجمة<br>تصنع فرقاً في<br>قبول أوراقك', 'novira-academy' ), array( 'br' => array() ) ); ?></span>
				</div>
			</div>
		</div>

		<?php // -------- Trust strip -------- ?>
		<div class="tl-container">
			<div class="tl-trust" data-reveal>
				<span class="tl-trust__label"><?php esc_html_e( 'تقبل ترجمتنا لدى:', 'novira-academy' ); ?></span>
				<div class="tl-trust__items">
					<?php
					$tl_trust = array(
						array( 'ar' => __( 'وزارة الخارجية', 'novira-academy' ), 'en' => __( 'FOREIGN AFFAIRS', 'novira-academy' ), 'i' => 'building' ),
						array( 'ar' => __( 'مكاتب التأشيرات', 'novira-academy' ), 'en' => __( 'VISA OFFICES', 'novira-academy' ), 'i' => 'passport' ),
						array( 'ar' => __( 'الهجرة', 'novira-academy' ), 'en' => __( 'IMMIGRATION', 'novira-academy' ), 'i' => 'plane' ),
						array( 'ar' => __( 'السفارات', 'novira-academy' ), 'en' => __( 'EMBASSIES', 'novira-academy' ), 'i' => 'bank' ),
					);
					foreach ( $tl_trust as $tl_t ) : ?>
						<div class="tl-trust__item">
							<span class="tl-trust__ico"><?php echo novira_tl_icon( $tl_t['i'] ); // phpcs:ignore ?></span>
							<span class="tl-trust__txt"><strong><?php echo esc_html( $tl_t['ar'] ); ?></strong><em><?php echo esc_html( $tl_t['en'] ); ?></em></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<?php // ===================== 2. FEAR / ADVISOR / WHY ===================== ?>
	<section class="tl-why tl-section">
		<div class="tl-container tl-why__grid">


			<div class="tl-advisor" data-reveal>
				<div class="tl-advisor__photo">
					<img src="<?php echo esc_url( $tl_advisor ); ?>" alt="<?php esc_attr_e( 'مستر يوسف زكي — مراجع الترجمة المعتمد', 'novira-academy' ); ?>" width="300" height="300" loading="lazy" decoding="async">
				</div>
				<div class="tl-advisor__cap">
					<span class="tl-advisor__eyebrow"><?php esc_html_e( 'لهذا السبب', 'novira-academy' ); ?></span>
					<strong><?php esc_html_e( 'يراجع مستر يوسف زكي', 'novira-academy' ); ?></strong>
					<span><?php esc_html_e( 'كل ترجمة قبل تسليمها', 'novira-academy' ); ?></span>
				</div>
			</div>

			<span class="tl-why__rule" aria-hidden="true"></span>

			<div class="tl-fear" data-reveal>
				<h2 class="tl-fear__title"><?php esc_html_e( 'هل تخاف يتم رفض أوراقك؟', 'novira-academy' ); ?></h2>
				<ul class="tl-fear__list" role="list">
					<?php
					$tl_fears = array(
						__( 'ترجمة غير معتمدة', 'novira-academy' ),
						__( 'أخطاء في الأسماء والتواريخ', 'novira-academy' ),
						__( 'اختلاف صيغة الجواز والبيانات', 'novira-academy' ),
						__( 'أخطاء لغوية أو تنسيق غير صحيح', 'novira-academy' ),
						__( 'رفض السفارات والجهات الرسمية', 'novira-academy' ),
						__( 'تأخير سفرك أو قبولك الجامعي', 'novira-academy' ),
					);
					foreach ( $tl_fears as $tl_fi => $tl_f ) : ?>
						<li data-reveal style="--i:<?php echo (int) $tl_fi; ?>">
							<span class="tl-x"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg></span>
							<?php echo esc_html( $tl_f ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<span class="tl-why__rule" aria-hidden="true"></span>

			<div class="tl-choose" data-reveal>
				<h2 class="tl-choose__title"><?php echo wp_kses( __( 'ليه آلاف العملاء اختاروا <span>Novira Academy؟</span>', 'novira-academy' ), array( 'span' => array() ) ); ?></h2>
				<div class="tl-choose__grid">
					<?php
					$tl_reasons = array(
						array( 'i' => 'cap',      't' => __( 'خبير دبلومة الترجمة', 'novira-academy' ), 's' => __( 'من الجامعة الأمريكية', 'novira-academy' ) ),
						array( 'i' => 'eye',      't' => __( 'مراجعة بشرية كاملة', 'novira-academy' ), 's' => '100%' ),
						array( 'i' => 'seal',     't' => __( 'ترجمة معتمدة', 'novira-academy' ), 's' => __( 'للسفارات والجامعات', 'novira-academy' ) ),
						array( 'i' => 'stack',    't' => __( 'خبرة في آلاف', 'novira-academy' ), 's' => __( 'المستندات الرسمية', 'novira-academy' ) ),
						array( 'i' => 'scale',    't' => __( 'ترجمة قانونية', 'novira-academy' ), 's' => __( 'وحقوقية', 'novira-academy' ) ),
						array( 'i' => 'bolt',     't' => __( 'سرعة في الإنجاز', 'novira-academy' ), 's' => __( 'دون التنازل عن الجودة', 'novira-academy' ) ),
						array( 'i' => 'target',   't' => __( 'دقة مطابقة', 'novira-academy' ), 's' => __( 'للأصل', 'novira-academy' ) ),
						array( 'i' => 'headset',  't' => __( 'دعم عملاء', 'novira-academy' ), 's' => __( 'قبل وبعد التسليم', 'novira-academy' ) ),
						array( 'i' => 'clock',    't' => __( 'تسليم في الموعد', 'novira-academy' ), 's' => __( 'المتفق عليه', 'novira-academy' ) ),
					);
					foreach ( $tl_reasons as $tl_ri => $tl_r ) : ?>
						<div class="tl-reason" data-reveal style="--i:<?php echo (int) $tl_ri; ?>">
							<span class="tl-reason__ico"><?php echo novira_tl_icon( $tl_r['i'] ); // phpcs:ignore ?></span>
							<span class="tl-reason__txt"><strong><?php echo esc_html( $tl_r['t'] ); ?></strong><em><?php echo esc_html( $tl_r['s'] ); ?></em></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<?php
	// ===================== 3. DOCUMENT TYPES =====================
	// Rendered as a dossier: one "file" per category, its name on the spine and
	// every document it covers listed by name. The names are what visitors scan
	// for ("do you translate MY paper?"), so they carry the hierarchy here.
	$tl_docs = array(
		array(
			'title' => __( 'الدراسة', 'novira-academy' ), 'icon' => 'cap',
			'items' => array( __( 'شهادة الثانوية العامة', 'novira-academy' ), __( 'شهادات التخرج', 'novira-academy' ), __( 'كشوف الدرجات', 'novira-academy' ), __( 'شهادة الخبرة', 'novira-academy' ), __( 'خطابات التوصية', 'novira-academy' ), __( 'SOP – أبحاث - مقالات', 'novira-academy' ) ),
		),
		array(
			'title' => __( 'السفر والهجرة', 'novira-academy' ), 'icon' => 'passport',
			'items' => array( __( 'جواز السفر', 'novira-academy' ), __( 'شهادة الميلاد', 'novira-academy' ), __( 'عقد الزواج', 'novira-academy' ), __( 'القيد العائلي', 'novira-academy' ), __( 'صحيفة الحالة الجنائية', 'novira-academy' ), __( 'رخصة القيادة', 'novira-academy' ), __( 'بطاقة الرقم القومي', 'novira-academy' ) ),
		),
		array(
			'title' => __( 'الأعمال والشركات', 'novira-academy' ), 'icon' => 'briefcase',
			'items' => array( __( 'السجل التجاري', 'novira-academy' ), __( 'البطاقة الضريبية', 'novira-academy' ), __( 'العقود والاتفاقيات', 'novira-academy' ), __( 'الفواتير والمراسلات', 'novira-academy' ), __( 'التوكيلات الرسمية', 'novira-academy' ), __( 'خطابات الخبرة', 'novira-academy' ) ),
		),
		array(
			'title' => __( 'الطبية', 'novira-academy' ), 'icon' => 'medical',
			'items' => array( __( 'التقارير الطبية', 'novira-academy' ), __( 'تحاليل وأشعة', 'novira-academy' ), __( 'التاريخ المرضي', 'novira-academy' ), __( 'الوصفات الطبية', 'novira-academy' ), __( 'شهادات اللياقة', 'novira-academy' ) ),
		),
	);

	// Kept in sync with the list itself so the headline count can never go stale.
	$tl_doc_total = 0;
	foreach ( $tl_docs as $tl_d ) {
		$tl_doc_total += count( $tl_d['items'] );
	}
	?>
	<section class="tl-docs tl-section tl-section--alt">
		<div class="tl-container">
			<h2 class="tl-h2" data-reveal><?php esc_html_e( 'نترجم جميع أنواع المستندات', 'novira-academy' ); ?></h2>
			<p class="tl-docs__lede" data-reveal style="--i:1">
				<?php
				printf(
					/* translators: %s: total number of document types listed in this section. */
					wp_kses( __( 'نترجم <b>%s</b> نوعاً من المستندات الرسمية. كل ترجمة تُراجع وتُختم قبل التسليم.', 'novira-academy' ), array( 'b' => array() ) ),
					esc_html( number_format_i18n( $tl_doc_total ) )
				);
				?>
			</p>

			<div class="tl-docs__stack">
				<?php foreach ( $tl_docs as $tl_di => $tl_d ) : ?>
					<section class="tl-file" data-reveal style="--i:<?php echo (int) $tl_di + 2; ?>">
						<div class="tl-file__spine">
							<span class="tl-file__ico"><?php echo novira_tl_icon( $tl_d['icon'], 22 ); // phpcs:ignore ?></span>
							<h3 class="tl-file__label"><span><?php echo esc_html( $tl_d['title'] ); ?></span></h3>
							<span class="tl-file__count">
								<b><?php echo esc_html( number_format_i18n( count( $tl_d['items'] ) ) ); ?></b>
								<?php /* translators: label under a count of 5–7 document types. */ ?>
								<i><?php esc_html_e( 'مستندات', 'novira-academy' ); ?></i>
							</span>
						</div>
						<ul class="tl-file__slips" role="list">
							<?php foreach ( $tl_d['items'] as $tl_it ) : ?>
								<li class="tl-slip"><?php echo esc_html( $tl_it ); ?></li>
							<?php endforeach; ?>
						</ul>
					</section>
				<?php endforeach; ?>

				<span class="tl-docs__seal" data-reveal aria-hidden="true">
					<svg viewBox="0 0 120 120" focusable="false">
						<circle class="tl-docs__seal-ring" cx="60" cy="60" r="55"/>
						<circle class="tl-docs__seal-ring tl-docs__seal-ring--in" cx="60" cy="60" r="47"/>
						<line class="tl-docs__seal-rule" x1="25" y1="44" x2="95" y2="44"/>
						<line class="tl-docs__seal-rule" x1="25" y1="77" x2="95" y2="77"/>
						<text class="tl-docs__seal-sm" x="60" y="38">NOVIRA</text>
						<text class="tl-docs__seal-lg" x="60" y="67">معتمد</text>
						<text class="tl-docs__seal-sm" x="60" y="91">CERTIFIED</text>
					</svg>
				</span>
			</div>

			<div class="tl-docs__ask" data-reveal style="--i:6">
				<p>
					<?php echo novira_tl_icon( 'upload', 22 ); // phpcs:ignore ?>
					<?php esc_html_e( 'لم تجد مستندك؟ أرسل صورة منه على واتساب ويصلك السعر والمدة.', 'novira-academy' ); ?>
				</p>
				<a href="<?php echo esc_url( $tl_wa ); ?>" class="tl-btn tl-btn--primary tl-btn--sm" target="_blank" rel="noopener noreferrer">
					<?php echo novira_tl_icon( 'whatsapp', 18 ); // phpcs:ignore ?>
					<?php esc_html_e( 'اسأل عن مستندك', 'novira-academy' ); ?>
				</a>
			</div>
		</div>
	</section>

	<?php // ===================== 4. LANGUAGES ===================== ?>
	<section class="tl-langs tl-section">
		<div class="tl-container">
			<h2 class="tl-h2" data-reveal><?php esc_html_e( 'اللغات التي نترجم بها', 'novira-academy' ); ?></h2>
			<div class="tl-langs__row">
				<?php
				$tl_langs = array(
					array( 'l' => __( 'عربي ↔ إنجليزي', 'novira-academy' ), 'f' => array( 'us', 'gb' ) ),
					array( 'l' => __( 'عربي ↔ ألماني', 'novira-academy' ), 'f' => array( 'de' ) ),
					array( 'l' => __( 'عربي ↔ فرنسي', 'novira-academy' ), 'f' => array( 'fr' ) ),
					array( 'l' => __( 'عربي ↔ إيطالي', 'novira-academy' ), 'f' => array( 'it' ) ),
					array( 'l' => __( 'عربي ↔ إسباني', 'novira-academy' ), 'f' => array( 'es' ) ),
					array( 'l' => __( 'عربي ↔ تركي', 'novira-academy' ), 'f' => array( 'tr' ) ),
					array( 'l' => __( 'عربي ↔ روسي', 'novira-academy' ), 'f' => array( 'ru' ) ),
					array( 'l' => __( 'والمزيد', 'novira-academy' ), 'f' => array( 'globe' ) ),
				);
				foreach ( $tl_langs as $tl_li => $tl_l ) : ?>
					<div class="tl-lang" data-reveal style="--i:<?php echo (int) $tl_li; ?>">
						<span class="tl-lang__flags">
							<?php foreach ( $tl_l['f'] as $tl_fl ) { echo novira_tl_flag( $tl_fl ); } // phpcs:ignore ?>
						</span>
						<span class="tl-lang__label"><?php echo esc_html( $tl_l['l'] ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php // ===================== 5. PROCESS ===================== ?>
	<section class="tl-process tl-section tl-section--alt">
		<div class="tl-container">
			<h2 class="tl-h2" data-reveal><?php esc_html_e( 'طريقة العمل معنا', 'novira-academy' ); ?></h2>
			<div class="tl-process__row">
				<?php
				// Ordered 1..6 in reading order (RTL: step 1 sits on the right).
				$tl_steps = array(
					array( 'n' => 1, 'i' => 'send',    't' => __( 'ترسل مستنداتك', 'novira-academy' ), 's' => __( 'عبر الموقع أو واتساب في دقائق', 'novira-academy' ) ),
					array( 'n' => 2, 'i' => 'eye',     't' => __( 'مراجعة أولية مجانية', 'novira-academy' ), 's' => __( 'نراجع ملفاتك ونحدد المتطلبات', 'novira-academy' ) ),
					array( 'n' => 3, 'i' => 'tag',     't' => __( 'يصلك السعر والمدة', 'novira-academy' ), 's' => __( 'نرسل السعر المناسب والمدة المتوقعة', 'novira-academy' ) ),
					array( 'n' => 4, 'i' => 'pen',     't' => __( 'نبدأ الترجمة', 'novira-academy' ), 's' => __( 'فريقنا المتخصص يبدأ العمل فوراً', 'novira-academy' ) ),
					array( 'n' => 5, 'i' => 'target',  't' => __( 'مراجعة دقيقة', 'novira-academy' ), 's' => __( 'مطابقة للأصل وضمان الجودة', 'novira-academy' ) ),
					array( 'n' => 6, 'i' => 'file',    't' => __( 'التسليم النهائي', 'novira-academy' ), 's' => __( 'تسليم الملفات PDF وأصل مطبوع عند الحاجة', 'novira-academy' ) ),
				);
				foreach ( $tl_steps as $tl_si => $tl_st ) : ?>
					<div class="tl-step" data-reveal style="--i:<?php echo (int) $tl_si; ?>">
						<span class="tl-step__num"><?php echo (int) $tl_st['n']; ?></span>
						<span class="tl-step__ico"><?php echo novira_tl_icon( $tl_st['i'] ); // phpcs:ignore ?></span>
						<h3 class="tl-step__t"><?php echo esc_html( $tl_st['t'] ); ?></h3>
						<p class="tl-step__s"><?php echo esc_html( $tl_st['s'] ); ?></p>
						<?php if ( $tl_si < count( $tl_steps ) - 1 ) : ?>
							<span class="tl-step__arrow" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg></span>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="tl-delivery" data-reveal>
				<span class="tl-delivery__ico"><?php echo novira_tl_icon( 'truck', 30 ); // phpcs:ignore ?></span>
				<p class="tl-delivery__txt">
					<?php
					echo wp_kses(
						__( 'يوجد لدينا <strong>خدمة مدفوعة</strong> لتوصيل المستندات المترجمة حتى <strong>باب بيتك</strong>', 'novira-academy' ),
						array( 'strong' => array() )
					);
					?>
				</p>
			</div>
		</div>
	</section>

	<?php // ===================== 6. PEACE OF MIND ===================== ?>
	<section class="tl-peace tl-section">
		<div class="tl-container">
			<div class="tl-peace__panel" data-reveal>
				<div class="tl-peace__left">
					<h2 class="tl-peace__title">
						<span class="tl-peace__eyebrow"><?php esc_html_e( 'مع نوفيرا أنت مش بتشتري ترجمة فقط...', 'novira-academy' ); ?></span>
						<span class="tl-peace__big"><span class="tl-peace__shield"><?php echo novira_tl_icon( 'shield' ); // phpcs:ignore ?></span> <?php esc_html_e( 'بل بتشتري راحة بال', 'novira-academy' ); ?></span>
					</h2>
					<div class="tl-peace__grid">
						<?php
						$tl_checks = array(
							__( 'مراجعة الأسماء مطابقة لجواز السفر', 'novira-academy' ),
							__( 'مراجعة التواريخ والأرقام والبيانات', 'novira-academy' ),
							__( 'مراجعة الأختام والتوقيعات', 'novira-academy' ),
							__( 'مطابقة الصياغة الرسمية', 'novira-academy' ),
							__( 'إمكانية التعديل بعد التسليم', 'novira-academy' ),
							__( 'سرية كاملة للمستندات', 'novira-academy' ),
							__( 'دعم مستمر قبل وبعد التسليم', 'novira-academy' ),
							__( 'تسليم في الموعد المتفق عليه', 'novira-academy' ),
						);
						foreach ( $tl_checks as $tl_ci => $tl_c ) : ?>
							<div class="tl-check" data-reveal style="--i:<?php echo (int) $tl_ci; ?>">
								<span class="tl-check__ico"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg></span>
								<?php echo esc_html( $tl_c ); ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="tl-peace__right">
					<div class="tl-peace__cert" aria-hidden="true"><?php echo novira_tl_doc_art( 'consult' ); // phpcs:ignore ?></div>
					<h3><?php esc_html_e( 'استشارة مجانية قبل الترجمة', 'novira-academy' ); ?></h3>
					<p class="tl-peace__lead"><?php esc_html_e( 'لأن مستنداتك تستحق الأفضل', 'novira-academy' ); ?></p>
					<p class="tl-peace__p"><?php esc_html_e( 'أرسل مستندك الآن ليتم تقييمه وتحصل على سعر مجاني خلال دقائق.', 'novira-academy' ); ?></p>
					<a href="<?php echo esc_url( $tl_wa ); ?>" class="tl-btn tl-btn--white tl-btn--lg tl-btn--block" target="_blank" rel="noopener noreferrer">
						<?php echo novira_tl_icon( 'upload' ); // phpcs:ignore ?> <?php esc_html_e( 'أرسل مستندك الآن', 'novira-academy' ); ?>
					</a>
					<a href="<?php echo esc_url( $tl_wa ); ?>" class="tl-peace__wa" target="_blank" rel="noopener noreferrer">
						<?php echo novira_tl_icon( 'whatsapp' ); // phpcs:ignore ?> <?php esc_html_e( 'أو تحدث مع مترجم عبر واتساب', 'novira-academy' ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>

	<?php // ===================== 7. TESTIMONIALS ===================== ?>
	<section class="tl-testi tl-section tl-section--alt">
		<div class="tl-container">
			<h2 class="tl-h2" data-reveal><?php esc_html_e( 'ماذا يقول عملاؤنا؟', 'novira-academy' ); ?></h2>
			<div class="tl-testi__track" id="tl-testi-track">
				<?php
				$tl_reviews = array(
					array( 'q' => __( 'المكان الوحيد المعتمد في بني مزار في ترجمة الأوراق للسفر', 'novira-academy' ), 'n' => __( 'Karem Alsarea', 'novira-academy' ), 'r' => __( 'ترجمة للسفارة الأمريكية', 'novira-academy' ) ),
					array( 'q' => __( 'افضل مكان يتولي المنح الدراسية وترجمة الورق وكل حاجة وتعامل فوق الممتاز ✅', 'novira-academy' ), 'n' => __( 'Kerolles Sobhy', 'novira-academy' ), 'r' => __( 'ترجمة دراسية لألمانيا', 'novira-academy' ) ),
					array( 'q' => __( 'أفضل مكتب ترجمة تعاملت معه، مراجعة دقيقة ودعم ممتاز بعد التسليم.', 'novira-academy' ), 'n' => __( 'أ. أحمد خالد', 'novira-academy' ), 'r' => __( 'ترجمة عقد عمل', 'novira-academy' ) ),
				);
				foreach ( $tl_reviews as $tl_vi => $tl_v ) : ?>
					<article class="tl-review" data-reveal style="--i:<?php echo (int) $tl_vi; ?>">
						<span class="tl-review__quote">”</span>
						<div class="tl-review__stars" aria-label="<?php esc_attr_e( '5 من 5', 'novira-academy' ); ?>">
							<?php for ( $s = 0; $s < 5; $s++ ) { echo novira_tl_icon( 'star' ); } // phpcs:ignore ?>
						</div>
						<p class="tl-review__q"><?php echo esc_html( $tl_v['q'] ); ?></p>
						<div class="tl-review__who">
							<span class="tl-review__avatar"><?php echo esc_html( mb_substr( $tl_v['n'], 3, 1 ) ); ?></span>
							<span class="tl-review__meta"><strong><?php echo esc_html( $tl_v['n'] ); ?></strong><em><?php echo esc_html( $tl_v['r'] ); ?></em></span>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
			<div class="tl-dots" id="tl-testi-dots" aria-hidden="true">
				<button class="is-active" data-idx="0"></button>
				<button data-idx="1"></button>
				<button data-idx="2"></button>
			</div>
		</div>
	</section>

	<?php // ===================== 8. FAQ + ARTICLES ===================== ?>
	<section class="tl-bottom tl-section" id="tl-faq">
		<div class="tl-container tl-bottom__grid">
			<div class="tl-faq" data-reveal>
				<h2 class="tl-h2 tl-h2--start"><?php esc_html_e( 'الأسئلة الشائعة', 'novira-academy' ); ?></h2>
				<?php
				$tl_faqs = array(
					array( 'q' => __( 'هل الترجمة معتمدة من السفارات والجهات الرسمية؟', 'novira-academy' ), 'a' => __( 'نعم، جميع ترجماتنا معتمدة رسمياً ومختومة، ومقبولة لدى السفارات والقنصليات والجامعات والجهات الحكومية.', 'novira-academy' ) ),
					array( 'q' => __( 'كم يستغرق إنجاز الترجمة؟', 'novira-academy' ), 'a' => __( 'يعتمد على عدد الصفحات ونوع المستند، ونحدد لك المدة الدقيقة مع عرض السعر قبل البدء — ولدينا خدمة تسليم سريع عند الحاجة.', 'novira-academy' ) ),
					array( 'q' => __( 'هل أرسل صور فقط أم الأصل مطلوب؟', 'novira-academy' ), 'a' => __( 'صورة واضحة للمستند تكفي لبدء الترجمة، وبعض الجهات قد تطلب الأصل عند الاستلام — ونوضح لك ذلك مسبقاً.', 'novira-academy' ) ),
					array( 'q' => __( 'هل يوجد خدمة توصيل للمستندات؟', 'novira-academy' ), 'a' => __( 'نعم، نسلّم نسخة إلكترونية PDF، وتتوفر النسخة المطبوعة والتوصيل حسب موقعك.', 'novira-academy' ) ),
					array( 'q' => __( 'هل يمكن تعديل الترجمة بعد التسليم؟', 'novira-academy' ), 'a' => __( 'بالتأكيد، نراجع أي ملاحظة على الأسماء أو البيانات ونعدّلها لضمان مطابقتها الكاملة لمستنداتك الرسمية.', 'novira-academy' ) ),
				);
				foreach ( $tl_faqs as $tl_qi => $tl_q ) : ?>
					<div class="tl-acc<?php echo 0 === $tl_qi ? ' is-open' : ''; ?>">
						<button class="tl-acc__q" aria-expanded="<?php echo 0 === $tl_qi ? 'true' : 'false'; ?>">
							<span><?php echo esc_html( $tl_q['q'] ); ?></span>
							<span class="tl-acc__sign" aria-hidden="true"></span>
						</button>
						<div class="tl-acc__a"><p><?php echo esc_html( $tl_q['a'] ); ?></p></div>
					</div>
				<?php endforeach; ?>
				<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="tl-btn tl-btn--primary tl-btn--block"><?php esc_html_e( 'عرض كل الأسئلة', 'novira-academy' ); ?></a>
			</div>

			<div class="tl-articles" data-reveal>
				<h2 class="tl-h2 tl-h2--start"><?php esc_html_e( 'مقالات قد تهمك', 'novira-academy' ); ?></h2>
				<div class="tl-articles__grid">
					<?php
					$tl_arts = array(
						array( 't' => __( 'الفرق بين الترجمة المعتمدة والترجمة العادية', 'novira-academy' ), 'k' => 'a' ),
						array( 't' => __( 'هل السفارة تقبل أي ترجمة؟ إليك الحقيقة', 'novira-academy' ), 'k' => 'b' ),
						array( 't' => __( 'أفضل 10 مستندات تحتاج ترجمة معتمدة', 'novira-academy' ), 'k' => 'c' ),
						array( 't' => __( 'كم سعر الترجمة المعتمدة؟ دليل شامل', 'novira-academy' ), 'k' => 'd' ),
					);
					foreach ( $tl_arts as $tl_ai => $tl_a ) : ?>
						<article class="tl-art" data-reveal style="--i:<?php echo (int) $tl_ai; ?>">
							<div class="tl-art__thumb tl-art__thumb--<?php echo esc_attr( $tl_a['k'] ); ?>"><?php echo novira_tl_icon( 'doc' ); // phpcs:ignore ?></div>
							<div class="tl-art__body">
								<h3><?php echo esc_html( $tl_a['t'] ); ?></h3>
								<a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="tl-art__more"><?php esc_html_e( 'اقرأ المزيد', 'novira-academy' ); ?> <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg></a>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<?php // ===================== 9. CTA BAND ===================== ?>
	<section class="tl-band tl-section">
		<div class="tl-container">
			<div class="tl-band__inner" data-reveal>
				<div class="tl-band__gift" aria-hidden="true"><?php echo novira_tl_doc_art( 'gift' ); // phpcs:ignore ?></div>
				<div class="tl-band__copy">
					<h2><?php esc_html_e( 'لا تخاطر بمستنداتك ومستقبلك...', 'novira-academy' ); ?></h2>
					<p><?php esc_html_e( 'ورقة واحدة فيها خطأ قد تؤخر سفرك أو قبولك الجامعي. ابدأ الآن واحصل على مراجعة مجانية لملفاتك قبل الترجمة.', 'novira-academy' ); ?></p>
				</div>
				<div class="tl-band__cta">
					<a href="<?php echo esc_url( $tl_wa ); ?>" class="tl-btn tl-btn--white tl-btn--lg" target="_blank" rel="noopener noreferrer"><?php echo novira_tl_icon( 'tag' ); // phpcs:ignore ?> <?php esc_html_e( 'احصل على مراجعة مجانية الآن', 'novira-academy' ); ?></a>
					<a href="<?php echo esc_url( $tl_wa ); ?>" class="tl-btn tl-btn--outline-w tl-btn--lg" target="_blank" rel="noopener noreferrer"><?php echo novira_tl_icon( 'whatsapp' ); // phpcs:ignore ?> <?php esc_html_e( 'تواصل واتساب', 'novira-academy' ); ?></a>
				</div>
			</div>
		</div>
	</section>

</div>

<?php get_footer(); ?>
