<?php
/**
 * Diploma Hub — S6 Program Ecosystem (hub → spokes)
 *
 * OWNS: the program map only. Reads ONLY novira_diploma_programs() and renders
 * the offered programs (EST · Digital SAT · ACT). Non-offered programs (AP) are
 * hidden automatically via the 'offered' flag — no hardcoded lists, no second
 * array. The hub links to each spoke; the spoke owns the exam mechanics.
 *
 * Spoke URLs are derived from the data layer's page_slug. The spoke pages are
 * built in a later sprint; until then these links point to their canonical
 * future locations (see Technical Risks).
 *
 * Rendering only.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$novira_programs = function_exists( 'novira_diploma_programs' ) ? novira_diploma_programs() : array();
?>
<section id="ecosystem" class="section diploma-ecosystem" aria-label="<?php esc_attr_e( 'منظومة البرامج', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'البرامج', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'منظومة البرامج', 'novira-academy' ); ?></h2>
			<p class="section-desc"><?php esc_html_e( 'لكل اختبار صفحته الخاصة بتفاصيله. هنا نقطة الانطلاق.', 'novira-academy' ); ?></p>
		</div>

		<div class="diploma-ecosystem__grid">
			<?php
			foreach ( $novira_programs as $novira_program ) :
				// Hide anything not actually offered (e.g. AP) — single source of truth.
				if ( empty( $novira_program['offered'] ) ) {
					continue;
				}
				$novira_spoke_url = home_url( '/american-diploma/' . $novira_program['page_slug'] . '/' );
				?>
				<article class="value-card diploma-ecosystem__program">
					<h4><?php echo esc_html( $novira_program['name'] ); ?></h4>
					<p class="diploma-ecosystem__link">
						<a href="<?php echo esc_url( $novira_spoke_url ); ?>">
							<?php
							/* translators: %s: program name (e.g. EST). */
							printf( esc_html__( 'تعرّف على %s', 'novira-academy' ), esc_html( $novira_program['name'] ) );
							?>
						</a>
					</p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
