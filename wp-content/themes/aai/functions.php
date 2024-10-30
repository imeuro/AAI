<?php
/**
 * AAI_gazzetta functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AAI_gazzetta
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function aai_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on AAI_gazzetta, use a find and replace
		* to change 'aai' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'aai', get_template_directory() . '/languages' );

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
	add_theme_support( 'align-wide' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'aai' ),
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

}
add_action( 'after_setup_theme', 'aai_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aai_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'aai' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'aai' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'aai_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function add_async_forscript($url)
{
    if (strpos($url, '#asyncload')===false)
        return $url;
    else
        return str_replace('#asyncload', '', $url)."' async='async";
}
add_filter('clean_url', 'add_async_forscript', 11, 1);

function add_defer_forscript( $tag, $handle, $src ) {
  $defer = array( 
  	'caw_2024-navigation',
    'caw_2024-mapbox'
  );
  if ( in_array( $handle, $defer ) ) {
     return '<script src="' . $src . '" defer type="text/javascript"></script>' . "\n";
  }
    
    return $tag;
} 
add_filter( 'script_loader_tag', 'add_defer_forscript', 10, 3 );

function aai_scripts() {
	wp_enqueue_style( 'aai-base-style', get_template_directory_uri() . '/style.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'aai-style', get_template_directory_uri() . '/assets/aai.css', array('aai-base-style'), _S_VERSION );
	wp_style_add_data( 'aai-style', 'rtl', 'replace' );

	wp_enqueue_script( 'aai-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'aai-interact', 'https://cdnjs.cloudflare.com/ajax/libs/interact.js/1.10.21/interact.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'aai-scripts', get_template_directory_uri() . '/assets/aai.js', array('aai-interact'), _S_VERSION, true );

	if ( !is_admin() ) wp_deregister_script('jquery');

}
add_action( 'wp_enqueue_scripts', 'aai_scripts' );

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
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	
	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

function remove_block_library_css() {
wp_dequeue_style( 'wp-block-library' ); 
wp_dequeue_style( 'validate-engine-css' ); 
}
add_action( 'wp_enqueue_scripts', 'remove_block_library_css' );

function disable_wpembedJS(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'disable_wpembedJS' );

// rimuove stupide immagini scaled:
// https://hollypryce.com/disable-image-scaling-wordpress/
add_filter( 'big_image_size_threshold', '__return_false' );
add_filter('jpeg_quality', function($arg){return 100;});

// Remove Global Styles and SVG Filters from WP 5.9.1 - 2022-02-27
function remove_global_styles_and_svg_filters() {
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
}
add_action('init', 'remove_global_styles_and_svg_filters');

// Remove admin bar
add_filter('show_admin_bar', '__return_false');


// remove 'category: ' from the_archive_title()
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) { //for custom post types
        $title = sprintf(__('%1$s'), single_term_title('', false));
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }
    return $title;
});


// prints meta description
function print_meta_description() {
    global $post;
    if ( is_singular() && ( !is_home() && !is_front_page() ) ) {
        echo '<meta name="description" content="' .  htmlspecialchars(get_the_excerpt(), ENT_QUOTES, 'UTF-8') . '" />' . "\n";
    }
    if ( is_home() || is_front_page() ) {
        echo '<meta name="description" content="' . htmlspecialchars(get_bloginfo( "description" ), ENT_QUOTES, 'UTF-8') . '" />' . "\n";
    }
    if ( is_category() ) {
        $des_cat = strip_tags(category_description());
        echo '<meta name="description" content="' . htmlspecialchars($des_cat, ENT_QUOTES, 'UTF-8') . '" />' . "\n";
    }
}
add_action( 'wp_head', 'print_meta_description');

