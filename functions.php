<?php
/**
 * Mustang functions and definitions.
 * @package Mustang
 */

if ( ! function_exists( 'mustang_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function mustang_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'mustang', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );

	// Add Mustang theme custom image sizes.
	add_image_size ( 'mustang-banner', 2000, 698, true );
	add_image_size ( 'mustang-team-thumb', 263, 321, true );
	add_image_size ( 'mustang-post-thumb', 50, 50, true );
	add_image_size ( 'mustang-single-post-image', 240, 450, true );
	add_image_size ( 'mustang-partner-thumb', 130, 95, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'mustang' ),
		'secondary' => esc_html__( 'Secondary', 'mustang' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mustang_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'mustang_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * @global int $content_width
 */
function mustang_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mustang_content_width', 1440 );
}
add_action( 'after_setup_theme', 'mustang_content_width', 0 );

/**
 * Register widget area.
 */
function mustang_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mustang' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar widget area.', 'mustang' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Mustang Home', 'mustang' ),
		'id'            => 'sidebar-homepage',
		'description'   => __( 'Mustang theme homepage widget area.', 'mustang' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Col#1', 'mustang' ),
		'id'            => 'sidebar-footer-col1',
		'description'   => __( 'Footer column one.', 'mustang' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Col#2', 'mustang' ),
		'id'            => 'sidebar-footer-col2',
		'description'   => __( 'Footer column two.', 'mustang' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Test Sidebar', 'mustang' ),
		'id'            => 'sidebar-test',
		'description'   => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do.', 'mustang' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mustang_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mustang_scripts() {

	// Google fonts.
	wp_enqueue_style(
		'lato-fonts',
		'//fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,300,400italic,700,700italic,900,900italic',
		array(),
		false
	);
	wp_enqueue_style(
		'roboto-fonts',
		'//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,900,700italic,900italic',
		array(),
		false
	);
	wp_enqueue_style(
		'roboto-condensed-fonts',
		'//fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,700,700italic,300,300italic',
		array(),
		false
	);

	// Styles.
	wp_enqueue_style(
		'bootstrap',
		get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css',
		array(),
		false
	);
	wp_enqueue_style(
		'font-awesome',
		get_template_directory_uri() . '/assets/font-awesome/font-awesome.css',
		array(),
		false
	);
	wp_enqueue_style(
		'slick',
		get_template_directory_uri() . '/assets/slick/slick.css',
		array(),
		false
	);
	wp_enqueue_style(
		'slick-theme',
		get_template_directory_uri() . '/assets/slick/slick-theme.css',
		array(),
		false
	);
	wp_enqueue_style(
		'progressbar',
		get_template_directory_uri() . '/assets/progressbar/progressbar.css',
		array(),
		false
	);
	wp_enqueue_style( 'mustang-style', get_stylesheet_uri() );
	wp_enqueue_style(
		'm-media',
		get_template_directory_uri() . '/assets/css/media.css',
		array(),
		false
	);

	// Scripts.
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'm-jquery' ), false, true );
	wp_enqueue_script( 'waypoints', '//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js', array(), false, true );
	wp_enqueue_script( 'counterup', get_template_directory_uri() . '/assets/js/jquery.counterup.js', array(), false, true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/slick/slick.min.js', array(), false, true );
	wp_enqueue_script( 'progressbar', get_template_directory_uri() . '/assets/progressbar/progressbar.js', array(), false, true );
	wp_enqueue_script( 'm-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), false, true );
	
	wp_enqueue_script( 'mustang-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'mustang-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'mustang_scripts' );

/**
 * Load meta-box framework.
 */
define( 'RWMB_DIR', get_template_directory() . '/inc/lib/meta-box/' );
define( 'RWMB_URL', get_template_directory_uri() . '/inc/lib/meta-box/' );
require_once RWMB_DIR . 'meta-box.php';

/**
 * Load the widgets for the theme.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom hooks for this theme.
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Loads - TGM Plugin Activation library class.
 */
require get_template_directory() . '/inc/tgmpa-mustang.php';

/**
 * Loads - mustang theme customizer.
 */
require get_template_directory() . '/inc/theme-customizer.php';

/**
 * Loads - menu walker for Mustang Theme.
 */
require get_template_directory() . '/inc/menu-walker.php';

// Remove admin bar.
add_filter( 'show_admin_bar', '__return_false' );

// Custom post types.
require_once get_template_directory() . '/inc/lib/post-types/banners-cpt.php';
require_once get_template_directory() . '/inc/lib/post-types/news-cpt.php';
require_once get_template_directory() . '/inc/lib/post-types/services-cpt.php';
require_once get_template_directory() . '/inc/lib/post-types/members-cpt.php';

// Meta boxes.
require_once get_template_directory() . '/inc/lib/metaboxes.php';