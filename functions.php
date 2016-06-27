<?php
/**
 * Since I Left You functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Since_I_Left_You
 */

/**
 * Timber.
 */
if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
	} );
	return;
}

if ( ! function_exists( 'sinceileftyou_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sinceileftyou_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Since I Left You, use a find and replace
	 * to change 'sinceileftyou' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'sinceileftyou', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'sinceileftyou' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sinceileftyou_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_image_size( 'entry-header', 1280, 480, true);

	add_image_size( 'article-card', 260, 280, true );
}
endif;
add_action( 'after_setup_theme', 'sinceileftyou_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sinceileftyou_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sinceileftyou_content_width', 640 );
}
add_action( 'after_setup_theme', 'sinceileftyou_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sinceileftyou_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sinceileftyou' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'sinceileftyou_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sinceileftyou_scripts() {

	// Fixed Sticky.
	wp_enqueue_style( 'fieldsticky', get_template_directory_uri() . '/inc/fixed-sticky/fixedsticky.css' );
	wp_enqueue_script( 'fieldsticky', get_template_directory_uri() . '/inc/fixed-sticky/fixedsticky.js', array('jquery') );

	wp_enqueue_style( 'pt-sans-narrow', 'https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700', false );


	wp_enqueue_style( 'sinceileftyou-style', get_stylesheet_uri() );

	wp_enqueue_script( 'sinceileftyou-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'sinceileftyou-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'slideout', 'https://cdnjs.cloudflare.com/ajax/libs/slideout/0.1.12/slideout.min.js');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


	// Custom script
	wp_enqueue_script( 'sinceileftyou', get_template_directory_uri() . '/js/sinceileftyou.js', array('jquery') );

	// PhotoSwipe
	wp_enqueue_script( 'photoswipe', get_template_directory_uri() . '/js/PhotoSwipe/dist/photoswipe.min.js', array() );
	wp_enqueue_script( 'photoswipe-ui-default', get_template_directory_uri() . '/js/PhotoSwipe/dist/photoswipe-ui-default.min.js', array() );
	wp_enqueue_style( 'photoswipe', get_template_directory_uri() . '/js/PhotoSwipe/dist/photoswipe.css', array() );
	wp_enqueue_style( 'default-skin', get_template_directory_uri() . '/js/PhotoSwipe/dist/default-skin/default-skin.css', array() );



}
add_action( 'wp_enqueue_scripts', 'sinceileftyou_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


//function wp_image_wrap_init( $html, $id, $caption, $title, $align, $url, $size, $alt ) {
//	return '<div class="">'. $html .'</div>';
//}
//add_filter( 'image_send_to_editor', 'wp_image_wrap_init', 10, 8 );


add_action( 'init', 'shortcode_ui_detection' );
/**
 * If Shortcake isn't active, then add an administration notice.
 *
 * This check is optional. The addition of the shortcode UI is via an action hook that is only called in Shortcake.
 * So if Shortcake isn't active, you won't be presented with errors.
 *
 * Here, we choose to tell users that Shortcake isn't active, but equally you could let it be silent.
 *
 * Why not just self-deactivate this plugin? Because then the shortcodes would not be registered either.
 *
 * @since 1.0.0
 */
function shortcode_ui_detection() {
	if ( ! function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
		add_action( 'admin_notices', 'shortcode_ui_dev_example_notices' );
	}
}

/**
 * Display an administration notice if the user can activate plugins.
 *
 * If the user can't activate plugins, then it's poor UX to show a notice they can't do anything to fix.
 *
 * @since 1.0.0
 */
function shortcode_ui_dev_example_notices() {
	if ( current_user_can( 'activate_plugins' ) ) {
		?>
		<div class="error message">
			<p><?php esc_html_e( 'Shortcode UI plugin must be active for Shortcode UI Example plugin to function.', 'shortcode-ui-example' ); ?></p>
		</div>
		<?php
	}
}

/*
 * 1. Register the shortcodes.
 */
add_action( 'init', 'shortcode_ui_dev_register_shortcodes' );
/**
 * Register two shortcodes, shortcake_dev and shortcake-no-attributes.
 *
 * This registration is done independently of any UI that might be associated with them, so it always happens, even if
 * Shortcake is not active.
 *
 * @since 1.0.0
 */
function shortcode_ui_dev_register_shortcodes() {
	add_shortcode( 'sily-image-single', 'sinceileftyou_sily_image_single_shortcode' );
	add_shortcode( 'sily-image-double', 'sinceileftyou_sily_image_double_shortcode' );
}

require_once('shortcodes/sily-image-single.php');
require_once('shortcodes/sily-image-double.php');