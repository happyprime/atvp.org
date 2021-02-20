<?php
/**
 * General theme setup.
 */

namespace ATVP\ThemeSetup;

add_action( 'after_setup_theme', __NAMESPACE__ . '\setup' );
add_action( 'after_setup_theme', __NAMESPACE__ . '\set_content_width', 0 );
add_action( 'widgets_init', __NAMESPACE__ . '\widgets_init' );
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\remove_core_block_library_styles', 9999 );
add_filter( 'nav_menu_css_class', __NAMESPACE__ . '\filter_primary_menu_css_class', 10, 3 );
add_filter( 'nav_menu_item_id', __NAMESPACE__ . '\remove_nav_menu_item_id' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	/*
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'atvp' ),
		)
	);

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'atvp_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Add support for color palettes.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Primary', 'atvp' ),
				'slug'  => 'color-primary',
				'color' => 'hsl(246, 55%, 30%)',
			),
			array(
				'name'  => __( 'Primary Light', 'atvp' ),
				'slug'  => 'color-primary-light',
				'color' => 'hsl(246, 55%, 95%)',
			),
			array(
				'name'  => __( 'Secondary', 'atvp' ),
				'slug'  => 'color-secondary',
				'color' => 'hsl(177, 31%, 30%)',
			),
			array(
				'name'  => __( 'Secondary Light', 'atvp' ),
				'slug'  => 'color-secondary-light',
				'color' => 'hsl(177, 31%, 95%)',
			),
			array(
				'name'  => __( 'Accent', 'atvp' ),
				'slug'  => 'color-accent',
				'color' => 'hsl(36, 71%, 51%)',
			),
			array(
				'name'  => __( 'Alert', 'atvp' ),
				'slug'  => 'color-alert',
				'color' => 'hsl(3, 75%, 43%)',
			),
			array(
				'name'  => __( 'Gray Dark', 'atvp' ),
				'slug'  => 'color-gray-dark',
				'color' => 'hsl(30, 7%, 11%)',
			),
			array(
				'name'  => __( 'Gray', 'atvp' ),
				'slug'  => 'color-gray',
				'color' => 'hsl(30, 7%, 34%)',
			),
			array(
				'name'  => __( 'Gray Light', 'atvp' ),
				'slug'  => 'color-gray-light',
				'color' => 'hsl(30, 7%, 95%)',
			),
			array(
				'name'  => __( 'White', 'atvp' ),
				'slug'  => 'color-white',
				'color' => '#ffffff',
			),
			array(
				'name'  => __( 'Black', 'atvp' ),
				'slug'  => 'color-black',
				'color' => '#000000',
			),
		)
	);

	// Disable custom colors in color palettes.
	add_theme_support( 'disable-custom-colors' );

	// Add support for font sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => __( 'small', 'atvp' ),
				'shortName' => __( 'S', 'atvp' ),
				'size'      => 16,
				'slug'      => 'small',
			),
			array(
				'name'      => __( 'regular', 'atvp' ),
				'shortName' => __( 'R', 'atvp' ),
				'size'      => 21,
				'slug'      => 'regular',
			),
			array(
				'name'      => __( 'medium', 'atvp' ),
				'shortName' => __( 'M', 'atvp' ),
				'size'      => 24,
				'slug'      => 'medium',
			),
			array(
				'name'      => __( 'large', 'atvp' ),
				'shortName' => __( 'L', 'atvp' ),
				'size'      => 36,
				'slug'      => 'large',
			),
			array(
				'name'      => __( 'larger', 'atvp' ),
				'shortName' => __( 'XL', 'atvp' ),
				'size'      => 44,
				'slug'      => 'larger',
			),
			array(
				'name'      => __( 'huge', 'atvp' ),
				'shortName' => __( 'H', 'atvp' ),
				'size'      => 60,
				'slug'      => 'huge',
			),
		)
	);

	// Disable custom font sizes.
	add_theme_support( 'disable-custom-font-sizes' );

	// Enable alignwide and alignfull support.
	add_theme_support( 'align-wide' );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'editor-style.css' );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function set_content_width() {
	$GLOBALS['content_width'] = 640;
}

/**
 * Register widget area.
 */
function widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'atvp' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'atvp' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

/**
 * Enqueue scripts and styles.
 */
function enqueue_assets() {
	wp_enqueue_style(
		'atvp-style',
		get_stylesheet_uri(),
		array(),
		\ATVP\Utilities\get_version()
	);
	wp_style_add_data( 'atvp-style', 'rtl', 'replace' );

	wp_enqueue_script(
		'atvp-navigation',
		get_template_directory_uri() . '/js/navigation.js',
		array(),
		\ATVP\Utilities\get_version(),
		true
	);

	wp_add_inline_script(
		'atvp-navigation',
		"navigation.init( {
			menu: document.getElementById( 'primary-menu' ),
			toggle: document.querySelector( '.menu-toggle' ),
		} );",
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Enqueue variable fonts via Google.
	wp_enqueue_style( // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NoExplicitVersion
		'google-variable-fonts',
		'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap',
		array(),
		null // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	);
}

/**
 * Disable the default block library styles provided by WordPress and/or
 * the Gutenberg plugin.
 *
 * Instead, these styles are included as part of the theme to allow for a
 * bit of pick and choose. See css/wp-block-library-5.5.1.css in this repo.
 */
function remove_core_block_library_styles() {
	wp_dequeue_style( 'wp-block-library' );
	wp_deregister_style( 'wp-block-library' );
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
