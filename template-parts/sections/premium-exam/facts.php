<?php
/**
 * Premium Exam — S6 Program facts ledger + features (shared component, Sprint 5.0).
 * Mirrors page-est.php S6. Numeric marks with data-count animate via behavior.php.
 *
 * @param array $args {
 *   @type string $eyebrow,$title,$desc,$big_num,$big_unit,$big_sub,$span_from,$span_to,$note,$rule_label
 *   @type array  $side_facts each [ 'mark_type'=>'num'|'icon', 'mark'=>'3'|iconKey, 'title', 'sub' ]
 *   @type array  $feats      each [ 'i'=>iconKey, 't'=>label ]
 * }
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$a    = wp_parse_args( isset( $args ) ? $args : array(), array(
	'eyebrow'    => '',
	'title'      => '',
	'desc'       => '',
	'big_num'    => '3',
	'big_unit'   => '',
	'big_sub'    => '',
	'span_from'  => 'Grade 10',
	'span_to'    => 'Grade 12',
	'note'       => '',
	'side_facts' => array(),
	'rule_label' => '',
	'feats'      => array(),
) );
$icon = novira_premium_exam_icons();
?>
<section class="est-results" aria-labelledby="pex-results-title">
	<div class="est-wrap">
		<div class="est-section-head est-reveal">
			<span class="est-eyebrow"><?php echo $icon['cap']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_html( $a['eyebrow'] ); ?></span>
			<h2 id="pex-results-title"><?php echo esc_html( $a['title'] ); ?></h2>
			<p><?php echo esc_html( $a['desc'] ); ?></p>
		</div>

			<div class="est-ledger">
				<article class="est-ledger__hero est-reveal est-reveal--scale">
					<div class="est-ledger__headline">
						<span class="est-stat__num est-ledger__big" data-count="<?php echo esc_attr( $a['big_num'] ); ?>"><?php echo esc_html( $a['big_num'] ); ?></span>
						<span class="est-ledger__unit"><?php echo esc_html( $a['big_unit'] ); ?><small><?php echo esc_html( $a['big_sub'] ); ?></small></span>
					</div>
					<div class="est-span" aria-hidden="true">
						<span class="est-span__cap"><?php echo esc_html( $a['span_from'] ); ?></span>
						<span class="est-span__track"><span class="est-span__fill"><span class="est-span__dot"></span></span></span>
						<span class="est-span__cap"><?php echo esc_html( $a['span_to'] ); ?></span>
					</div>
					<p class="est-ledger__note"><?php echo esc_html( $a['note'] ); ?></p>
				</article>
				<div class="est-ledger__side">
					<?php foreach ( $a['side_facts'] as $f ) : ?>
						<article class="est-fact est-reveal">
							<?php if ( 'num' === $f['mark_type'] ) : ?>
								<span class="est-fact__mark"><span class="est-stat__num" data-count="<?php echo esc_attr( $f['mark'] ); ?>"><?php echo esc_html( $f['mark'] ); ?></span></span>
							<?php else : ?>
								<span class="est-fact__mark est-fact__mark--icon"><?php echo $icon[ $f['mark'] ]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							<?php endif; ?>
							<span class="est-fact__body">
								<b><?php echo esc_html( $f['title'] ); ?></b>
								<span><?php echo esc_html( $f['sub'] ); ?></span>
							</span>
						</article>
					<?php endforeach; ?>
				</div>
			</div>

			<?php if ( $a['rule_label'] ) : ?>
				<div class="est-results__rule est-reveal"><span><?php echo esc_html( $a['rule_label'] ); ?></span></div>
			<?php endif; ?>

		<div class="est-feats">
			<?php foreach ( $a['feats'] as $f ) : ?>
				<div class="est-feat est-reveal">
					<span class="est-feat__icon"><?php echo $icon[ $f['i'] ]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<span><?php echo esc_html( $f['t'] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
