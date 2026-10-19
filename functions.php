<?php
/**
 * WebArt01 Theme Functions
 *
 * @package WebArt01
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

/**
 * Theme setup: title tag, featured images, nav menus, etc.
 */
function webart01_setup() {
	// Let WordPress manage the <title> tag instead of hardcoding it.
	add_theme_support( 'title-tag' );

	// Enable featured images (e.g. for portfolio/work items later).
	add_theme_support( 'post-thumbnails' );

	// Enable HTML5 markup for common template parts.
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);

	// Basic responsive embed support.
	add_theme_support( 'responsive-embeds' );

	// Register the main navigation menu location.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'webart01' ),
			'footer'  => __( 'Footer Menu', 'webart01' ),
		)
	);
}
add_action( 'after_setup_theme', 'webart01_setup' );

/**
 * Enqueue the built Tailwind stylesheet (and any JS) on the front end.
 *
 * NOTE: assets/css/style.css is the Tailwind BUILD OUTPUT.
 * Run your Tailwind CLI/watch command to generate it from src/input.css.
 * This is separate from the theme's root style.css, which only holds
 * the required WordPress theme header comment.
 */
function webart01_enqueue_assets() {
	$css_path = get_theme_file_path( 'assets/css/style.css' );
	$css_uri  = get_theme_file_uri( 'assets/css/style.css' );

	if ( file_exists( $css_path ) ) {
		wp_enqueue_style(
			'webart01-style',
			$css_uri,
			array(),
			filemtime( $css_path ) // Cache-busts on every rebuild.
		);
	}

	$js_path = get_theme_file_path( 'assets/js/main.js' );
	$js_uri  = get_theme_file_uri( 'assets/js/main.js' );

	if ( file_exists( $js_path ) ) {
		wp_enqueue_script(
			'webart01-main',
			$js_uri,
			array(),
			filemtime( $js_path ),
			true // Load in footer.
		);
	}
}
add_action( 'wp_enqueue_scripts', 'webart01_enqueue_assets' );

add_action('wp_enqueue_scripts', function () {
	$rel  = './main.js'; // change if yours is elsewhere
	$path = get_theme_file_path($rel);
	wp_enqueue_script(
		'webart-main',
		get_theme_file_uri($rel),
		array(),
		file_exists($path) ? filemtime($path) : '1.0',
		true
	);
});

/**
 * Register a widget area for the footer (optional, remove if unused).
 */
function webart01_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'webart01' ),
			'id'            => 'footer-1',
			'description'   => __( 'Widgets added here will appear in the footer.', 'webart01' ),
			'before_widget' => '<div class="footer-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="text-lg font-bold text-white">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'webart01_widgets_init' );

add_action('after_setup_theme', function () {
	register_nav_menus(array(
		'primary'         => __('Primary Menu', 'webart01'),
		'footer_services' => __('Footer: Services', 'webart01'),
		'footer_pages'    => __('Footer: Pages', 'webart01'),
	));
});

require_once get_theme_file_path('inc/class-webart-walker-nav.php');
require_once get_theme_file_path('inc/customizer.php');

function my_theme_setup() {
	add_theme_support('custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
	));
}
add_action('after_setup_theme', 'my_theme_setup');
