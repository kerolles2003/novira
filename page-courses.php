<?php
/**
 * Template: Courses Register
 *
 * The dedicated /courses page: every academy course, organised as five fields
 * of study. Force-routed for the `courses` page via
 * novira_force_courses_template() (template_include, inc/courses-landing.php).
 * Uses the site's global header/footer so the navbar and footer match every
 * other page.
 *
 * All markup is scoped under `.crs`; data comes from novira_crs_catalog() /
 * novira_crs_spec() / novira_crs_enrollment(), styles from
 * assets/css/courses-landing.css and behaviour from
 * assets/js/courses-landing.js — both enqueued only here.
 *
 * Structure: every course follows the same study system, so the system is
 * stated once (the hero timetable figure) and each register entry carries only
 * what actually differs — its name and what it is for.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$crs_whatsapp = get_theme_mod( 'novira_whatsapp', '201090600927' );
$crs_wa       = 'https://wa.me/' . $crs_whatsapp;
$crs_contact  = home_url( '/contact' );
$crs_images   = NOVIRA_URI . '/assets/images/courses/';

$crs_catalog = function_exists( 'novira_crs_catalog' ) ? novira_crs_catalog() : array();
$crs_spec    = function_exists( 'novira_crs_spec' ) ? novira_crs_spec() : array();
$crs_steps   = function_exists( 'novira_crs_enrollment' ) ? novira_crs_enrollment() : array();

// Real counts, straight from the register (drive the index and the hero).
$crs_total  = 0;
$crs_fields = count( $crs_catalog );
foreach ( $crs_catalog as $crs_c ) {
	$crs_total += count( $crs_c['courses'] );
}
?>

<div class="crs">

	<?php
	// The reveal styles start hidden and are switched on by the IntersectionObserver
	// in courses-landing.js. Without JS nothing would ever switch them on, so the
	// register would render blank — undo the hiding when scripting is off.
	?>
	<noscript>
		<style>
			.crs [data-reveal],
			.crs-month__cell { opacity: 1 !important; transform: none !important; }
		</style>
	</noscript>

	<?php // ===================== 1. HERO ===================== ?>
	<section class="crs-hero" aria-labelledby="crs-hero-h">
		<div class="crs-container crs-hero__grid">

			<div class="crs-hero__lede">
				<p class="crs-label crs-label--mark" data-reveal>
					<?php esc_html_e( 'دليل الكورسات', 'novira-academy' ); ?>
				</p>
				<h1 class="crs-hero__title" id="crs-hero-h" data-reveal style="--i:1">
					<?php esc_html_e( 'مجالات مختلفة،', 'novira-academy' ); ?>
					<span><?php esc_html_e( 'ونظام دراسة واحد.', 'novira-academy' ); ?></span>
				</h1>
				<p class="crs-hero__desc" data-reveal style="--i:2">
					<?php esc_html_e( 'يبدأ كل طالب من المستوى الأول ويتقدّم مستوى كل شهر، بعد إتقان ما قبله. النظام أدناه واحد لكل كورس في هذا الدليل — لذلك نذكره مرة واحدة، ثم نترك لكل كورس ما يختلف فيه.', 'novira-academy' ); ?>
				</p>

				<?php // The study system, stated once for the whole register. ?>
				<ul class="crs-facts" data-reveal style="--i:3">
					<?php foreach ( $crs_spec as $crs_s ) : ?>
						<li class="crs-fact">
							<?php echo novira_crs_icon( $crs_s['icon'], 17 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php echo esc_html( $crs_s['label'] ); ?>
						</li>
					<?php endforeach; ?>
				</ul>

				<div class="crs-hero__cta" data-reveal style="--i:4">
					<a href="#crs-register" class="crs-btn crs-btn--solid">
						<?php echo novira_crs_icon( 'list', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php
						echo esc_html(
							sprintf(
								/* translators: 1: number of courses, 2: number of fields of study. */
								__( 'تصفّح %1$s كورساً في %2$s مجالات', 'novira-academy' ),
								number_format_i18n( $crs_total ),
								number_format_i18n( $crs_fields )
							)
						);
						?>
					</a>
					<a href="<?php echo esc_url( $crs_wa ); ?>" class="crs-btn crs-btn--quiet" target="_blank" rel="noopener noreferrer">
						<?php echo novira_crs_icon( 'whatsapp', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php esc_html_e( 'اسأل عن كورس', 'novira-academy' ); ?>
					</a>
				</div>
			</div>

			<?php // Signature: one level, drawn as the timetable it actually is. ?>
			<figure class="crs-month" data-reveal style="--i:2">
				<div class="crs-month__frame">
					<div class="crs-month__head">
						<span class="crs-month__level"><?php esc_html_e( 'مستوى 1', 'novira-academy' ); ?></span>
						<span class="crs-month__col"><?php esc_html_e( 'الحصة الأولى', 'novira-academy' ); ?></span>
						<span class="crs-month__col"><?php esc_html_e( 'الحصة الثانية', 'novira-academy' ); ?></span>
					</div>

					<?php for ( $crs_w = 1; $crs_w <= 4; $crs_w++ ) : ?>
						<div class="crs-month__row">
							<span class="crs-month__wk">
								<?php
								/* translators: %s: week number within the level. */
								echo esc_html( sprintf( __( 'الأسبوع %s', 'novira-academy' ), number_format_i18n( $crs_w ) ) );
								?>
							</span>
							<?php for ( $crs_i = 0; $crs_i < 2; $crs_i++ ) : ?>
								<?php $crs_n = ( $crs_w - 1 ) * 2 + $crs_i + 1; ?>
								<span class="crs-month__cell" style="--n:<?php echo (int) $crs_n; ?>">
									<?php echo esc_html( number_format_i18n( $crs_n ) ); ?>
								</span>
							<?php endfor; ?>
						</div>
					<?php endfor; ?>

					<div class="crs-month__foot">
						<span><?php esc_html_e( '8 حصص · ساعة لكل حصة', 'novira-academy' ); ?></span>
						<span class="crs-month__next">
							<?php esc_html_e( 'مستوى 2', 'novira-academy' ); ?>
							<?php echo novira_crs_icon( 'arrow', 15 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</span>
					</div>
				</div>
				<figcaption>
					<?php esc_html_e( 'شكل 1 — مستوى واحد: شهر، أربعة أسابيع، ثماني حصص.', 'novira-academy' ); ?>
				</figcaption>
			</figure>

		</div>
	</section>

	<?php // ===================== 2. INDEX ===================== ?>
	<nav class="crs-index" aria-label="<?php esc_attr_e( 'فهرس مجالات الدراسة', 'novira-academy' ); ?>">
		<div class="crs-container crs-index__wrap">
			<span class="crs-index__label"><?php esc_html_e( 'الفهرس', 'novira-academy' ); ?></span>
			<div class="crs-index__chips">
				<button type="button" class="crs-chip" data-filter="all" aria-pressed="true">
					<?php esc_html_e( 'كل المجالات', 'novira-academy' ); ?>
					<span class="crs-chip__n"><?php echo esc_html( number_format_i18n( $crs_total ) ); ?></span>
				</button>
				<?php foreach ( $crs_catalog as $crs_c ) : ?>
					<button type="button" class="crs-chip" data-filter="<?php echo esc_attr( $crs_c['key'] ); ?>" aria-pressed="false">
						<?php echo esc_html( $crs_c['label'] ); ?>
						<span class="crs-chip__n"><?php echo esc_html( number_format_i18n( count( $crs_c['courses'] ) ) ); ?></span>
					</button>
				<?php endforeach; ?>
			</div>
		</div>
	</nav>

	<?php // ===================== 3. REGISTER ===================== ?>
	<div class="crs-register" id="crs-register">
		<div class="crs-container">

			<p class="crs-status" role="status" aria-live="polite"></p>

			<?php foreach ( $crs_catalog as $crs_k => $crs_c ) : ?>
				<?php $crs_count = count( $crs_c['courses'] ); ?>
				<section class="crs-field" data-field="<?php echo esc_attr( $crs_c['key'] ); ?>"
					id="field-<?php echo esc_attr( $crs_c['key'] ); ?>"
					aria-labelledby="field-<?php echo esc_attr( $crs_c['key'] ); ?>-h">

					<div class="crs-field__head">
						<figure class="crs-field__plate" data-reveal>
							<?php // Every plate ships at 1080x720 (3:2) — stated so the box is reserved before load. ?>
							<img src="<?php echo esc_url( $crs_images . $crs_c['plate'] ); ?>"
								width="1080" height="720" loading="lazy" decoding="async"
								alt="<?php echo esc_attr( $crs_c['plate_alt'] ); ?>">
						</figure>

						<div class="crs-field__meta" data-reveal style="--i:1">
							<p class="crs-label">
								<?php
								/* translators: %s: plate number, matching the field's position in the register. */
								echo esc_html( sprintf( __( 'لوحة %s', 'novira-academy' ), number_format_i18n( $crs_k + 1 ) ) );
								?>
							</p>
							<h2 class="crs-h2" id="field-<?php echo esc_attr( $crs_c['key'] ); ?>-h">
								<?php echo esc_html( $crs_c['label'] ); ?>
							</h2>
							<p class="crs-field__note"><?php echo esc_html( $crs_c['note'] ); ?></p>
						</div>

						<span class="crs-field__leader" aria-hidden="true"></span>

						<p class="crs-field__tally" data-reveal style="--i:2">
							<?php
							/* translators: %s: number of courses in this field of study. */
							echo esc_html( sprintf( _n( '%s كورس', '%s كورسات', $crs_count, 'novira-academy' ), number_format_i18n( $crs_count ) ) );
							?>
						</p>
					</div>

					<ul class="crs-entries">
						<?php foreach ( $crs_c['courses'] as $crs_n => $crs_course ) : ?>
							<li class="crs-entry" data-reveal style="--i:<?php echo (int) min( $crs_n, 5 ); ?>">
								<h3 class="crs-entry__name"><?php echo esc_html( $crs_course['name'] ); ?></h3>
								<p class="crs-entry__desc"><?php echo esc_html( $crs_course['desc'] ); ?></p>
								<a class="crs-entry__cta"
									href="<?php echo esc_url( novira_crs_wa_url( $crs_whatsapp, $crs_course['name'] ) ); ?>"
									target="_blank" rel="noopener noreferrer"
									aria-label="<?php
									echo esc_attr(
										sprintf(
											/* translators: %s: course name. */
											__( 'سجّل في كورس %s عبر واتساب', 'novira-academy' ),
											$crs_course['name']
										)
									);
									?>">
									<?php echo novira_crs_icon( 'whatsapp', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<span><?php esc_html_e( 'سجّل في الكورس', 'novira-academy' ); ?></span>
									<?php echo novira_crs_icon( 'arrow', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</section>
			<?php endforeach; ?>

		</div>
	</div>

	<?php // ===================== 4. ENROLMENT + CLOSE ===================== ?>
	<section class="crs-enroll" aria-labelledby="crs-enroll-h">
		<div class="crs-container">
			<div class="crs-enroll__inner">
				<p class="crs-label crs-label--invert" data-reveal><?php esc_html_e( 'التسجيل', 'novira-academy' ); ?></p>
				<h2 class="crs-enroll__title" id="crs-enroll-h" data-reveal style="--i:1">
					<?php esc_html_e( 'ثلاث خطوات من هنا إلى المستوى الأول.', 'novira-academy' ); ?>
				</h2>

				<ol class="crs-steps">
					<?php foreach ( $crs_steps as $crs_i => $crs_step ) : ?>
						<li class="crs-step" data-reveal style="--i:<?php echo (int) ( $crs_i + 2 ); ?>">
							<span class="crs-step__n" aria-hidden="true"><?php echo esc_html( number_format_i18n( $crs_i + 1 ) ); ?></span>
							<h3 class="crs-step__t"><?php echo esc_html( $crs_step['title'] ); ?></h3>
							<p class="crs-step__b"><?php echo esc_html( $crs_step['body'] ); ?></p>
							<?php if ( ! empty( $crs_step['link'] ) ) : ?>
								<a class="crs-step__link" href="<?php echo esc_url( $crs_step['link'] ); ?>">
									<?php echo esc_html( $crs_step['link_label'] ); ?>
									<?php echo novira_crs_icon( 'arrow', 15 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</a>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ol>

				<div class="crs-enroll__actions" data-reveal style="--i:5">
					<a href="<?php echo esc_url( $crs_wa ); ?>" class="crs-btn crs-btn--white" target="_blank" rel="noopener noreferrer">
						<?php echo novira_crs_icon( 'whatsapp', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php esc_html_e( 'اختر كورساً عبر واتساب', 'novira-academy' ); ?>
					</a>
					<a href="<?php echo esc_url( $crs_contact ); ?>" class="crs-btn crs-btn--ghost">
						<?php echo novira_crs_icon( 'phone', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php esc_html_e( 'تواصل معنا', 'novira-academy' ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>

</div><!-- .crs -->

<?php get_footer(); ?>
