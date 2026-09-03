<?php
/**
 * Template Part: Student Case Study ("Has someone like my child succeeded here?")
 *
 * A DOCUMENTED case study — not a testimonial. Built around a vertical reel
 * (YouTube Shorts, 9:16) beside a documentary "case file" of verified facts.
 *
 * RULES:
 * - The SECTION always renders. Each FIELD is independent and hides on its own
 *   when empty.
 * - Verified facts + real media only. Documentary tone — no "أفضل طالب",
 *   "أعلى نتيجة", "نجاح مضمون".
 * - Written consent (parental for minors). Redact personal data on certificates.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Temporary documentary placeholders — replace with verified data later.
$case = array(
	'name'        => __( 'طالب من برنامج الدبلومة الأمريكية', 'novira-academy' ),
	'program'     => __( 'الدبلومة الأمريكية', 'novira-academy' ),
	'timeline'    => __( 'ثلاثة سنين دراسية', 'novira-academy' ),
	'achievement' => __( 'جاهز للتقديم الجامعي وبالفعل التحق بجامعة احلامه', 'novira-academy' ),
	'before'      => __( 'المستوى التأسيسي', 'novira-academy' ),
	'after'       => __( 'جاهز للتقديم الجامعي', 'novira-academy' ),
	'video'       => 'CVsc0ANfmJE', // placeholder YouTube ID — replace with the real one
	// 'poster'      => get_template_directory_uri() . '/assets/placeholders/student-story-poster.jpg',
	'certificate' => get_template_directory_uri() . '/assets/images/gallery/certificate.webp',
	'quote'       => __( 'نص توضيحي مؤقت لرسالة الطالب يعرض التنسيق النهائي للقسم — يُستبدل بالشهادة الحقيقية بعد التوثيق.', 'novira-academy' ),
	'outcome'     => __( 'التحق بالجامعة المستهدفة', 'novira-academy' ),
);

$case = apply_filters( 'novira_student_case', $case );

// The section always exists as long as a case array is present.
if ( empty( $case ) ) {
	return;
}

// Certificate: render the image only when it actually resolves.
$cert_ok = false;
if ( ! empty( $case['certificate'] ) ) {
	$theme_uri = get_template_directory_uri();
	if ( 0 === strpos( $case['certificate'], $theme_uri ) ) {
		$cert_ok = file_exists( get_template_directory() . substr( $case['certificate'], strlen( $theme_uri ) ) );
	} else {
		$cert_ok = true;
	}
}
?>
<section class="student-case reveal" aria-label="<?php esc_attr_e( 'دراسة حالة موثقة', 'novira-academy' ); ?>">
	<div class="student-case__inner">

		<header class="student-case__head">
			<span class="student-case__eyebrow">
				<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 12l2 2 4-4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9"/></svg>
				<?php esc_html_e( 'دراسة حالة موثقة', 'novira-academy' ); ?>
			</span>
			<h2 class="student-case__title"><?php esc_html_e( 'رحلة أحد طلابنا في برنامج', 'novira-academy' ); ?> <span class="student-case__title-accent"><?php esc_html_e( 'الدبلومة الأمريكية', 'novira-academy' ); ?></span></h2>
			<p class="student-case__lead"><?php esc_html_e( 'موثقة بالفيديو والنتائج الأكاديمية.', 'novira-academy' ); ?></p>
		</header>

		<div class="student-case__body">

			<?php if ( ! empty( $case['video'] ) ) : ?>
			<div class="student-case__reel">
				<div class="student-case__reel-frame">
					<button type="button" class="video-facade student-case__play" data-video-id="<?php echo esc_attr( $case['video'] ); ?>" aria-label="<?php esc_attr_e( 'تشغيل الفيديو التوثيقي', 'novira-academy' ); ?>">
						<img src="<?php echo esc_url( ! empty( $case['poster'] ) ? $case['poster'] : 'https://i.ytimg.com/vi/' . $case['video'] . '/hqdefault.jpg' ); ?>" alt="" loading="lazy" decoding="async" class="student-case__poster">
						<span class="student-case__play-icon" aria-hidden="true">
							<svg viewBox="0 0 24 24" width="30" height="30" fill="#ffffff"><path d="M8 5v14l11-7z"/></svg>
						</span>
					</button>
				</div>
				<span class="student-case__reel-tag">
					<svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor" aria-hidden="true"><path d="M17 10.5V7a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h12a1 1 0 001-1v-3.5l4 4v-11l-4 4z"/></svg>
					<?php esc_html_e( 'فيديو توثيقي', 'novira-academy' ); ?>
				</span>
			</div>
			<?php endif; ?>

			<div class="student-case__file">
				<div class="student-case__file-head"><?php esc_html_e( 'ملف الحالة', 'novira-academy' ); ?></div>
				<dl class="student-case__rows">
					<?php if ( ! empty( $case['program'] ) ) : ?>
					<div class="student-case__row"><dt><?php esc_html_e( 'البرنامج', 'novira-academy' ); ?></dt><dd><?php echo esc_html( $case['program'] ); ?></dd></div>
					<?php endif; ?>
					<?php if ( ! empty( $case['timeline'] ) ) : ?>
					<div class="student-case__row"><dt><?php esc_html_e( 'المدة', 'novira-academy' ); ?></dt><dd><?php echo esc_html( $case['timeline'] ); ?></dd></div>
					<?php endif; ?>
					<?php if ( ! empty( $case['achievement'] ) ) : ?>
					<div class="student-case__row"><dt><?php esc_html_e( 'النتيجة الموثقة', 'novira-academy' ); ?></dt><dd><?php echo esc_html( $case['achievement'] ); ?></dd></div>
					<?php endif; ?>
					<?php if ( ! empty( $case['before'] ) || ! empty( $case['after'] ) ) : ?>
					<div class="student-case__row"><dt><?php esc_html_e( 'قبل / بعد', 'novira-academy' ); ?></dt>
						<dd class="student-case__beforeafter">
							<?php if ( ! empty( $case['before'] ) ) : ?><span><?php echo esc_html( $case['before'] ); ?></span><?php endif; ?>
							<?php if ( ! empty( $case['before'] ) && ! empty( $case['after'] ) ) : ?><span class="student-case__arrow" aria-hidden="true">←</span><?php endif; ?>
							<?php if ( ! empty( $case['after'] ) ) : ?><span><?php echo esc_html( $case['after'] ); ?></span><?php endif; ?>
						</dd>
					</div>
					<?php endif; ?>
					<?php if ( ! empty( $case['outcome'] ) ) : ?>
					<div class="student-case__row"><dt><?php esc_html_e( 'العائد', 'novira-academy' ); ?></dt><dd><?php echo esc_html( $case['outcome'] ); ?></dd></div>
					<?php endif; ?>
				</dl>

				<?php if ( ! empty( $case['quote'] ) ) : ?>
				<blockquote class="student-case__quote"><?php echo esc_html( $case['quote'] ); ?></blockquote>
				<?php endif; ?>

				<?php if ( $cert_ok ) : ?>
				<figure class="student-case__cert">
					<img src="<?php echo esc_url( $case['certificate'] ); ?>" alt="<?php echo esc_attr( sprintf( __( 'إثبات نتيجة %s', 'novira-academy' ), $case['name'] ) ); ?>" loading="lazy" decoding="async">
					<figcaption><?php esc_html_e( 'إثبات النتيجة (مع إخفاء البيانات الشخصية).', 'novira-academy' ); ?></figcaption>
				</figure>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>

<style>
.student-case { background: #faf9ff; }
.student-case__inner { max-width: 1280px; margin: 0 auto; }
.student-case__head { text-align: center; margin-bottom: 48px; }
.student-case__eyebrow {
	display: inline-flex; align-items: center; gap: 8px;
	background: rgba(91,20,230,0.08); color: #5B14E6;
	font-family: var(--ff-display, 'Noto Kufi Arabic', sans-serif);
	font-weight: 700; font-size: 14px;
	padding: 7px 18px; border-radius: 999px; margin-bottom: 18px;
}
.student-case__title {
	font-family: var(--ff-display, 'Noto Kufi Arabic', sans-serif);
	font-size: clamp(26px, 4vw, 40px); font-weight: 800; line-height: 1.25;
	color: #1E1B4B; margin: 0 0 14px;
}
.student-case__title-accent { color: #5B14E6; }
.student-case__lead { font-size: 17px; line-height: 1.7; color: #5b5772; max-width: 560px; margin: 0 auto; }

.student-case__body {
	display: flex; flex-wrap: wrap; gap: 40px;
	align-items: center; justify-content: center;
}

/* Vertical reel (9:16) */
.student-case__reel { width: 320px; max-width: 100%; flex-shrink: 0; text-align: center; }
.student-case__reel-frame {
	position: relative; padding-bottom: 177.77%; height: 0;
	border-radius: 24px; overflow: hidden; background: #000;
	box-shadow: 0 28px 64px -22px rgba(91,20,230,0.55);
	border: 1px solid rgba(255,255,255,0.08);
}
.student-case__play {
	position: absolute; inset: 0; width: 100%; height: 100%;
	padding: 0; border: none; cursor: pointer; background: #000;
}
.student-case__poster { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
.student-case__play-icon {
	position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);
	width: 68px; height: 68px; display: flex; align-items: center; justify-content: center;
	background: rgba(91,20,230,0.85); border-radius: 9999px;
	box-shadow: 0 8px 24px rgba(0,0,0,0.45); transition: transform 0.2s ease, background 0.2s ease;
}
.student-case__play:hover .student-case__play-icon { transform: translate(-50%,-50%) scale(1.08); background: #5B14E6; }
.student-case__reel-tag {
	display: inline-flex; align-items: center; gap: 6px; margin-top: 14px;
	font-size: 13px; font-weight: 700; color: #6b6580;
}

/* Case file */
.student-case__file {
	flex: 1; min-width: 280px; max-width: 460px;
	background: #ffffff; border: 1px solid rgba(91,20,230,0.1);
	border-radius: 20px; padding: 28px 28px 30px;
	box-shadow: 0 20px 50px -28px rgba(91,20,230,0.3);
}
.student-case__file-head {
	font-weight: 800; color: #1E1B4B; font-size: 15px;
	padding-bottom: 14px; margin-bottom: 6px; border-bottom: 2px solid rgba(91,20,230,0.1);
	font-family: var(--ff-display, 'Noto Kufi Arabic', sans-serif);
}
.student-case__rows { margin: 0; }
.student-case__row {
	display: flex; gap: 14px; align-items: baseline;
	padding: 13px 0; border-bottom: 1px solid rgba(91,20,230,0.07);
}
.student-case__row dt { flex: 0 0 96px; color: #8a86a0; font-size: 13px; font-weight: 600; margin: 0; }
.student-case__row dd { margin: 0; color: #1E1B4B; font-weight: 700; }
.student-case__beforeafter { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.student-case__arrow { color: #5B14E6; font-weight: 800; }
.student-case__quote {
	margin: 18px 0 0; padding: 4px 0 4px 14px;
	border-inline-start: 3px solid rgba(91,20,230,0.35);
	color: #4a4660; font-size: 15px; line-height: 1.8;
}
.student-case__cert { margin: 20px 0 0; }
.student-case__cert img { width: 100%; height: auto; border-radius: 12px; border: 1px solid rgba(91,20,230,0.1); }
.student-case__cert figcaption { font-size: 12.5px; color: #8a86a0; margin-top: 8px; }

@media (max-width: 600px) {
	.student-case__reel { width: 260px; }
	.student-case__file { padding: 22px; }
}
/* LTR activation (inert under RTL): flip the before→after arrow glyph. */
[dir="ltr"] .student-case__arrow { display: inline-block; transform: scaleX(-1); }
</style>

<script>
(function () {
	var section = document.querySelector('.student-case');
	if (!section) { return; }
	section.addEventListener('click', function (e) {
		var btn = e.target.closest('.video-facade');
		if (!btn) { return; }
		var id = btn.getAttribute('data-video-id');
		var frame = btn.parentNode;
		var iframe = document.createElement('iframe');
		iframe.src = 'https://www.youtube.com/embed/' + id + '?autoplay=1';
		iframe.title = 'YouTube video';
		iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
		iframe.allowFullscreen = true;
		iframe.style.cssText = 'position:absolute; top:0; left:0; width:100%; height:100%; border:none;';
		frame.replaceChild(iframe, btn);
	});
})();
</script>
