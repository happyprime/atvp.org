<?php
/**
 * Functions and filters related to the menus.
 */

namespace ATVP\Menus;

add_filter( 'walker_nav_menu_start_el', __NAMESPACE__ . '\nav_menu_social_icons', 10, 4 );

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
