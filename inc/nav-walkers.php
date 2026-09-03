<?php
/**
 * Custom navigation walkers (Sprint: navbar dropdowns)
 *
 * Render WordPress-managed `primary` menus with the SAME markup and class names
 * the hand-coded fallback in template-parts/layout/header.php uses, so a single
 * set of CSS (assets/css/main.css) and JS (assets/js/navigation.js) drives both
 * paths. Any menu item that has children becomes a dropdown:
 *
 *   - Desktop  -> hover/focus flyout  (.has-dropdown > .nav-dropdown-trigger + .nav-dropdown)
 *   - Mobile   -> tap accordion       (.has-dropdown > .mobile-nav__row + .mobile-subnav)
 *
 * Children are detected via $args->has_children, which core's
 * Walker_Nav_Menu::display_element() sets on the shared args object before each
 * element is rendered. A per-parent submenu id is stamped in start_el() and
 * consumed by the immediately-following start_lvl(), keeping aria-controls and
 * the sub-list id in sync without relying on the item id twice.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Caret SVG shared by both walkers (matches the fallback markup exactly).
 *
 * @return string
 */
function novira_nav_caret_svg() {
	return '<svg class="nav-dropdown-caret" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>';
}

/**
 * Build the shared <li> class string (preserves WordPress state classes such as
 * current-menu-item / current_page_item so active styling keeps working) and
 * adds `has-dropdown` for parents.
 *
 * @param object $item         Menu item.
 * @param object $args         wp_nav_menu args.
 * @param int    $depth        Depth.
 * @param bool   $has_children Whether this item has children.
 * @return string
 */
function novira_nav_li_classes( $item, $args, $depth, $has_children ) {
	$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
	$classes[] = 'menu-item-' . $item->ID;
	if ( $has_children ) {
		$classes[] = 'has-dropdown';
	}
	/** This filter is documented in wp-includes/nav-menu-template.php */
	$classes = apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth );
	return trim( implode( ' ', array_map( 'sanitize_html_class', $classes ) ) );
}

/**
 * Build a menu item's <a> tag.
 *
 * @param object $item Menu item.
 * @param object $args wp_nav_menu args.
 * @return string
 */
function novira_nav_link( $item, $args ) {
	$url    = ! empty( $item->url ) ? $item->url : '';
	$title  = apply_filters( 'the_title', $item->title, $item->ID );
	$target = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
	$rel    = ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
	$before = isset( $args->link_before ) ? $args->link_before : '';
	$after  = isset( $args->link_after ) ? $args->link_after : '';

	return '<a href="' . esc_url( $url ) . '"' . $target . $rel . '>' . $before . esc_html( $title ) . $after . '</a>';
}

if ( ! class_exists( 'Novira_Walker_Nav_Desktop' ) ) :
	/**
	 * Desktop walker — hover/focus flyout.
	 */
	class Novira_Walker_Nav_Desktop extends Walker_Nav_Menu {

		/** @var string Pending submenu id stamped by start_el, used by start_lvl. */
		protected $pending_submenu_id = '';

		public function start_lvl( &$output, $depth = 0, $args = null ) {
			$id     = '' !== $this->pending_submenu_id ? ' id="' . esc_attr( $this->pending_submenu_id ) . '"' : '';
			$output .= '<ul class="nav-dropdown" role="list"' . $id . '>';
			$this->pending_submenu_id = '';
		}

		public function end_lvl( &$output, $depth = 0, $args = null ) {
			$output .= '</ul>';
		}

		public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
			$has_children = ! empty( $args->has_children );
			$li_class     = novira_nav_li_classes( $item, $args, $depth, $has_children );
			$output      .= '<li class="' . esc_attr( $li_class ) . '">';

			if ( $has_children ) {
				$submenu_id               = 'novira-submenu-' . $item->ID;
				$this->pending_submenu_id = $submenu_id;
				$label                    = sprintf(
					/* translators: %s: parent menu item title */
					__( 'عرض القائمة الفرعية لـ %s', 'novira-academy' ),
					wp_strip_all_tags( $item->title )
				);

				$output .= '<div class="nav-dropdown-trigger">';
				$output .= novira_nav_link( $item, $args );
				$output .= '<button type="button" class="nav-dropdown-toggle" aria-expanded="false" aria-controls="' . esc_attr( $submenu_id ) . '" aria-label="' . esc_attr( $label ) . '">';
				$output .= novira_nav_caret_svg();
				$output .= '</button>';
				$output .= '</div>';
			} else {
				$output .= novira_nav_link( $item, $args );
			}
		}

		public function end_el( &$output, $item, $depth = 0, $args = null ) {
			$output .= '</li>';
		}
	}
endif;

if ( ! class_exists( 'Novira_Walker_Nav_Mobile' ) ) :
	/**
	 * Mobile walker — tap accordion inside the slide-in panel.
	 */
	class Novira_Walker_Nav_Mobile extends Walker_Nav_Menu {

		/** @var string Pending submenu id stamped by start_el, used by start_lvl. */
		protected $pending_submenu_id = '';

		public function start_lvl( &$output, $depth = 0, $args = null ) {
			$id     = '' !== $this->pending_submenu_id ? ' id="' . esc_attr( $this->pending_submenu_id ) . '"' : '';
			$output .= '<ul class="mobile-subnav" role="list"' . $id . '>';
			$this->pending_submenu_id = '';
		}

		public function end_lvl( &$output, $depth = 0, $args = null ) {
			$output .= '</ul>';
		}

		public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
			$has_children = ! empty( $args->has_children );
			$li_class     = novira_nav_li_classes( $item, $args, $depth, $has_children );
			$output      .= '<li class="' . esc_attr( $li_class ) . '">';

			if ( $has_children ) {
				$submenu_id               = 'novira-m-submenu-' . $item->ID;
				$this->pending_submenu_id = $submenu_id;
				$label                    = sprintf(
					/* translators: %s: parent menu item title */
					__( 'عرض القائمة الفرعية لـ %s', 'novira-academy' ),
					wp_strip_all_tags( $item->title )
				);

				$output .= '<div class="mobile-nav__row">';
				$output .= novira_nav_link( $item, $args );
				$output .= '<button type="button" class="mobile-subnav-toggle" aria-expanded="false" aria-controls="' . esc_attr( $submenu_id ) . '" aria-label="' . esc_attr( $label ) . '">';
				$output .= novira_nav_caret_svg();
				$output .= '</button>';
				$output .= '</div>';
			} else {
				$output .= novira_nav_link( $item, $args );
			}
		}

		public function end_el( &$output, $item, $depth = 0, $args = null ) {
			$output .= '</li>';
		}
	}
endif;
