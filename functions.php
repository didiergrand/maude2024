<?php
/**
 * Niremont V0 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Niremont_V0
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.1.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function maude_2024_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Niremont V0, use a find and replace
		* to change 'maude-2024' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'maude-2024', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'maude-2024' ),
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
			'maude_2024_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

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
}
add_action( 'after_setup_theme', 'maude_2024_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function maude_2024_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'maude_2024_content_width', 640 );
}
add_action( 'after_setup_theme', 'maude_2024_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function maude_2024_scripts() {
	wp_enqueue_style( 'maude-2024-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'maude-2024-style', 'rtl', 'replace' );

	wp_enqueue_script( 'maude-2024-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'maude-2024-custom', get_template_directory_uri() . '/js/custom.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'maude_2024_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function enqueue_custom_js() {
    wp_enqueue_script( 'cf7-redirect', get_stylesheet_directory_uri() . '/js/cf7-redirect.js', array( 'jquery' ), '', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_js' );

function enqueue_custom_css() {
    wp_enqueue_style( 'custom-css', get_stylesheet_directory_uri() . '/css/sunshine.css', array(), _S_VERSION );
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_css', 20 );


function my_theme_widget_init() {
    register_sidebar( array(
        'name'          => 'Footer Widget Zone',
        'id'            => 'footer-widget-zone',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'my_theme_widget_init' );


add_filter( 'wpcf7_form_tag', function( $tag ) {
    if ( 'your-email' == $tag['name'] && isset( $_GET['email'] ) && is_email( $_GET['email'] ) ) {
        $tag['values'] = array( $_GET['email'] );
    }

    return $tag;
});

// Désactiver les mises à jour d'Amelia Booking
function disable_amelia_updates($value) {
    if (isset($value->response['ameliabooking/ameliabooking.php'])) {
        unset($value->response['ameliabooking/ameliabooking.php']);
    }
    return $value;
}

// Appliquer les filtres pour bloquer les mises à jour d'Amelia
add_filter('site_transient_update_plugins', 'disable_amelia_updates');
add_filter('pre_site_transient_update_plugins', 'disable_amelia_updates');
add_filter('auto_update_plugin', 'disable_amelia_auto_updates', 10, 2);

function disable_amelia_auto_updates($update, $item) {
    if (isset($item->plugin) && $item->plugin === 'ameliabooking/ameliabooking.php') {
        return false;
    }
    return $update;
} 