<?php
/**
 * SVG Icons class
 */

/**
 * This class is in charge of displaying SVG icons across the site.
 *
 * Place each <svg> source on its own array key, without adding either
 * the `width` or `height` attributes, since these are added dynamically,
 * before rendering the SVG code.
 *
 * All icons are assumed to have equal width and height, hence the option
 * to only specify a `$size` parameter in the svg methods.
 *
 * @since 1.0.0
 */
class ATVP_SVG_Icons {

	/**
	 * User Interface icons – svg sources.
	 *
	 * @access protected
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	protected static $icons = array(
		'arrow_right' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="m4 13v-2h12l-4-4 1-2 7 7-7 7-1-2 4-4z" fill="currentColor"/></svg>',
		'arrow_left'  => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M20 13v-2H8l4-4-1-2-7 7 7 7 1-2-4-4z" fill="currentColor"/></svg>',
		'close'       => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 10.9394L5.53033 4.46973L4.46967 5.53039L10.9393 12.0001L4.46967 18.4697L5.53033 19.5304L12 13.0607L18.4697 19.5304L19.5303 18.4697L13.0607 12.0001L19.5303 5.53039L18.4697 4.46973L12 10.9394Z" fill="currentColor"/></svg>',
		'menu'        => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 6H19.5V7.5H4.5V6ZM4.5 12H19.5V13.5H4.5V12ZM19.5 18H4.5V19.5H19.5V18Z" fill="currentColor"/></svg>',
		'plus'        => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M18 11.2h-5.2V6h-1.6v5.2H6v1.6h5.2V18h1.6v-5.2H18z" fill="currentColor"/></svg>',
		'minus'       => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M6 11h12v2H6z" fill="currentColor"/></svg>',
	);

	/**
	 * Social Icons – svg sources.
	 *
	 * @access protected
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	protected static $social_icons = array(
		'facebook'  => '<svg width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.5 2 2 6.5 2 12c0 5 3.7 9.1 8.4 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.3v7C18.3 21.1 22 17 22 12c0-5.5-4.5-10-10-10z"></path></svg>',
		'instagram' => '<svg width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M12,4.622c2.403,0,2.688,0.009,3.637,0.052c0.877,0.04,1.354,0.187,1.671,0.31c0.42,0.163,0.72,0.358,1.035,0.673 c0.315,0.315,0.51,0.615,0.673,1.035c0.123,0.317,0.27,0.794,0.31,1.671c0.043,0.949,0.052,1.234,0.052,3.637 s-0.009,2.688-0.052,3.637c-0.04,0.877-0.187,1.354-0.31,1.671c-0.163,0.42-0.358,0.72-0.673,1.035 c-0.315,0.315-0.615,0.51-1.035,0.673c-0.317,0.123-0.794,0.27-1.671,0.31c-0.949,0.043-1.233,0.052-3.637,0.052 s-2.688-0.009-3.637-0.052c-0.877-0.04-1.354-0.187-1.671-0.31c-0.42-0.163-0.72-0.358-1.035-0.673 c-0.315-0.315-0.51-0.615-0.673-1.035c-0.123-0.317-0.27-0.794-0.31-1.671C4.631,14.688,4.622,14.403,4.622,12 s0.009-2.688,0.052-3.637c0.04-0.877,0.187-1.354,0.31-1.671c0.163-0.42,0.358-0.72,0.673-1.035 c0.315-0.315,0.615-0.51,1.035-0.673c0.317-0.123,0.794-0.27,1.671-0.31C9.312,4.631,9.597,4.622,12,4.622 M12,3 C9.556,3,9.249,3.01,8.289,3.054C7.331,3.098,6.677,3.25,6.105,3.472C5.513,3.702,5.011,4.01,4.511,4.511 c-0.5,0.5-0.808,1.002-1.038,1.594C3.25,6.677,3.098,7.331,3.054,8.289C3.01,9.249,3,9.556,3,12c0,2.444,0.01,2.751,0.054,3.711 c0.044,0.958,0.196,1.612,0.418,2.185c0.23,0.592,0.538,1.094,1.038,1.594c0.5,0.5,1.002,0.808,1.594,1.038 c0.572,0.222,1.227,0.375,2.185,0.418C9.249,20.99,9.556,21,12,21s2.751-0.01,3.711-0.054c0.958-0.044,1.612-0.196,2.185-0.418 c0.592-0.23,1.094-0.538,1.594-1.038c0.5-0.5,0.808-1.002,1.038-1.594c0.222-0.572,0.375-1.227,0.418-2.185 C20.99,14.751,21,14.444,21,12s-0.01-2.751-0.054-3.711c-0.044-0.958-0.196-1.612-0.418-2.185c-0.23-0.592-0.538-1.094-1.038-1.594 c-0.5-0.5-1.002-0.808-1.594-1.038c-0.572-0.222-1.227-0.375-2.185-0.418C14.751,3.01,14.444,3,12,3L12,3z M12,7.378 c-2.552,0-4.622,2.069-4.622,4.622S9.448,16.622,12,16.622s4.622-2.069,4.622-4.622S14.552,7.378,12,7.378z M12,15 c-1.657,0-3-1.343-3-3s1.343-3,3-3s3,1.343,3,3S13.657,15,12,15z M16.804,6.116c-0.596,0-1.08,0.484-1.08,1.08 s0.484,1.08,1.08,1.08c0.596,0,1.08-0.484,1.08-1.08S17.401,6.116,16.804,6.116z"></path></svg>',
		'twitter'   => '<svg width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M22.23,5.924c-0.736,0.326-1.527,0.547-2.357,0.646c0.847-0.508,1.498-1.312,1.804-2.27 c-0.793,0.47-1.671,0.812-2.606,0.996C18.324,4.498,17.257,4,16.077,4c-2.266,0-4.103,1.837-4.103,4.103 c0,0.322,0.036,0.635,0.106,0.935C8.67,8.867,5.647,7.234,3.623,4.751C3.27,5.357,3.067,6.062,3.067,6.814 c0,1.424,0.724,2.679,1.825,3.415c-0.673-0.021-1.305-0.206-1.859-0.513c0,0.017,0,0.034,0,0.052c0,1.988,1.414,3.647,3.292,4.023 c-0.344,0.094-0.707,0.144-1.081,0.144c-0.264,0-0.521-0.026-0.772-0.074c0.522,1.63,2.038,2.816,3.833,2.85 c-1.404,1.1-3.174,1.756-5.096,1.756c-0.331,0-0.658-0.019-0.979-0.057c1.816,1.164,3.973,1.843,6.29,1.843 c7.547,0,11.675-6.252,11.675-11.675c0-0.178-0.004-0.355-0.012-0.531C20.985,7.47,21.68,6.747,22.23,5.924z"></path></svg>',
		'vimeo'     => '<svg width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M22.396,7.164c-0.093,2.026-1.507,4.799-4.245,8.32C15.322,19.161,12.928,21,10.97,21c-1.214,0-2.24-1.119-3.079-3.359 c-0.56-2.053-1.119-4.106-1.68-6.159C5.588,9.243,4.921,8.122,4.206,8.122c-0.156,0-0.701,0.328-1.634,0.98L1.594,7.841 c1.027-0.902,2.04-1.805,3.037-2.708C6.001,3.95,7.03,3.327,7.715,3.264c1.619-0.156,2.616,0.951,2.99,3.321 c0.404,2.557,0.685,4.147,0.841,4.769c0.467,2.121,0.981,3.181,1.542,3.181c0.435,0,1.09-0.688,1.963-2.065 c0.871-1.376,1.338-2.422,1.401-3.142c0.125-1.187-0.343-1.782-1.401-1.782c-0.498,0-1.012,0.115-1.541,0.341 c1.023-3.35,2.977-4.977,5.862-4.884C21.511,3.066,22.52,4.453,22.396,7.164z"></path></svg>',
		'youtube'   => '<svg width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M21.8,8.001c0,0-0.195-1.378-0.795-1.985c-0.76-0.797-1.613-0.801-2.004-0.847c-2.799-0.202-6.997-0.202-6.997-0.202 h-0.009c0,0-4.198,0-6.997,0.202C4.608,5.216,3.756,5.22,2.995,6.016C2.395,6.623,2.2,8.001,2.2,8.001S2,9.62,2,11.238v1.517 c0,1.618,0.2,3.237,0.2,3.237s0.195,1.378,0.795,1.985c0.761,0.797,1.76,0.771,2.205,0.855c1.6,0.153,6.8,0.201,6.8,0.201 s4.203-0.006,7.001-0.209c0.391-0.047,1.243-0.051,2.004-0.847c0.6-0.607,0.795-1.985,0.795-1.985s0.2-1.618,0.2-3.237v-1.517 C22,9.62,21.8,8.001,21.8,8.001z M9.935,14.594l-0.001-5.62l5.404,2.82L9.935,14.594z"></path></svg>',
	);

	/**
	 * Social Icons – domain mappings.
	 *
	 * By default, each Icon ID is matched against a .com TLD. To override this behavior,
	 * specify all the domains it covers (including the .com TLD too, if applicable).
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	protected static $social_icons_map = array(
		'facebook' => array(
			'facebook.com',
			'fb.me',
		),
	);

	/**
	 * Gets the SVG code for a given icon.
	 *
	 * @static
	 *
	 * @access public
	 *
	 * @param string $group the icon group.
	 * @param string $icon The icon.
	 * @param int    $size The icon-size in pixels.
	 *
	 * @return string
	 */
	public static function get_svg( $group, $icon, $size ) {
		if ( 'ui' === $group ) {
			$arr = self::$icons;
		} elseif ( 'social' === $group ) {
			$arr = self::$social_icons;
		} else {
			$arr = array();
		}

		/**
		 * Filters ATVP's array of icons.
		 *
		 * The dynamic portion of the hook name, `$group`, refers to
		 * the name of the group of icons, either "ui" or "social".
		 *
		 * @param array $arr Array of icons.
		 */
		$arr = apply_filters( "atvp_svg_icons_{$group}", $arr );

		$svg = '';

		if ( array_key_exists( $icon, $arr ) ) {
			$repl = sprintf( '<svg class="svg-icon" width="%d" height="%d" aria-hidden="true" role="img" focusable="false" ', $size, $size );

			$svg = preg_replace( '/^<svg /', $repl, trim( $arr[ $icon ] ) ); // Add extra attributes to SVG code.
		}

		return $svg;
	}

	/**
	 * Detects the social network from a URL and returns the SVG code for its icon.
	 *
	 * @static
	 *
	 * @access public
	 *
	 * @param string $uri Social link.
	 * @param int    $size The icon-size in pixels.
	 *
	 * @return string|null
	 */
	public static function get_social_link_svg( $uri, $size ) {
		static $regex_map; // Only compute regex map once, for performance.

		if ( ! isset( $regex_map ) ) {
			$regex_map = array();

			/**
			 * Filters ATVP's array of domain mappings for social icons.
			 *
			 * By default, each Icon ID is matched against a .com TLD. To override this behavior,
			 * specify all the domains it covers (including the .com TLD too, if applicable).
			 *
			 * @param array $social_icons_map Array of default social icons.
			 */
			$map = apply_filters( 'atvp_social_icons_map', self::$social_icons_map );

			/**
			 * Filters ATVP's array of social icons.
			 *
			 * @since 1.0.0
			 *
			 * @param array $social_icons Array of default social icons.
			 */
			$social_icons = apply_filters( 'atvp_svg_icons_social', self::$social_icons );

			foreach ( array_keys( $social_icons ) as $icon ) {
				$domains            = array_key_exists( $icon, $map ) ? $map[ $icon ] : array( sprintf( '%s.com', $icon ) );
				$domains            = array_map( 'trim', $domains ); // Remove leading/trailing spaces, to prevent regex from failing to match.
				$domains            = array_map( 'preg_quote', $domains );
				$regex_map[ $icon ] = sprintf( '/(%s)/i', implode( '|', $domains ) );
			}
		}

		foreach ( $regex_map as $icon => $regex ) {
			if ( preg_match( $regex, $uri ) ) {

				return self::get_svg( 'social', $icon, $size ) . '<span class="screen-reader-text">';
			}
		}

		return null;
	}
}
