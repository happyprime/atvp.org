<?php
/**
 * Functions and filters related to the menus.
 */

namespace ATVP\Menus;

add_filter( 'walker_nav_menu_start_el', __NAMESPACE__ . '\nav_menu_social_icons', 10, 4 );
add_filter( 'nav_menu_css_class', __NAMESPACE__ . '\filter_primary_menu_css_class', 10, 3 );
add_filter( 'nav_menu_item_id', __NAMESPACE__ . '\remove_nav_menu_item_id' );

/**
 * Display SVG icons in the social media menu.
 *
 * @param string   $item_output The menu item's starting HTML output.
 * @param WP_Post  $item        Menu item data object.
 * @param int      $depth       Depth of the menu. Used for padding.
 * @param stdClass $args        An object of wp_nav_menu() arguments.
 * @return string The menu item output with SVG icon.
 */
function nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	if ( 'social' === $args->theme_location ) {
		$svg = \ATVP_SVG_Icons::get_social_link_svg( $item->url, 24 );

		if ( ! empty( $svg ) ) {
			$item_output = str_replace( $args->link_before, $svg, $item_output );
		}
	}

	return $item_output;
}

/**
 * Remove all but a list of allowed classes from the primary menu <li> elements.
 *
 * @param string[] $classes CSS classes applied to the menu item's <li> element.
 * @param WP_Post  $item    The current menu item.
 * @param stdClass $args    An object of wp_nav_menu() arguments.
 */
function filter_primary_menu_css_class( $classes, $item, $args ) {
	if ( 'primary-menu' === $args->menu_id ) {
		$allowed_classes = array(
			'current-menu-ancestor',
			'current-menu-item',
			'menu-item-has-children',
		);

		$classes = array_filter(
			$classes,
			function ( $class ) use ( $allowed_classes ) {
				return in_array( $class, $allowed_classes, true );
			}
		);

	}

	return $classes;
}

/**
 * Remove the id attribute from the menu <li> elements.
 */
function remove_nav_menu_item_id() {
	return '';
}
