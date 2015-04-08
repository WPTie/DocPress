<?php
/**
 * DocPress functions and definitions
 *
 * @package DocPress
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'docpress_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function docpress_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on DocPress, use a find and replace
	 * to change 'docpress' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'docpress', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'docpress' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// /*
	//  * Enable support for Post Formats.
	//  * See http://codex.wordpress.org/Post_Formats
	//  */
	// add_theme_support( 'post-formats', array(
	// 	'aside', 'image', 'video', 'quote', 'link',
	// ) );

	// // Set up the WordPress core custom background feature.
	// add_theme_support( 'custom-background', apply_filters( 'docpress_custom_background_args', array(
	// 	'default-color' => 'ffffff',
	// 	'default-image' => '',
	// ) ) );
}
endif; // docpress_setup
add_action( 'after_setup_theme', 'docpress_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function docpress_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'docpress' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'docpress_widgets_init' );



/**
 *
 * Frontend with no conditions, Add Custom styles to wp_head
 *
 * @since  1.0
 *
 */
add_action('wp_enqueue_scripts', 'aa_styles'); // Add Theme Stylesheet
function aa_styles()
{
	wp_register_style( 'docpress-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css' );
	wp_enqueue_style( 'docpress-bootstrap');

	wp_register_style( 'docpress-lightbox', get_template_directory_uri() . '/assets/css/lightbox.css' );
	wp_enqueue_style( 'docpress-lightbox');

	wp_register_style( 'docpress-main', get_template_directory_uri() . '/assets/css/main.css' );
	wp_enqueue_style( 'docpress-main');
	/**
	 *
	 * Enqueue HTML5Shiv and Respond.js and video fallback for IE
	 *
	 * @since 1.0
	 *
	 */
	wp_register_style( 'docpress-html5shiv', get_template_directory_uri() . 'assets/js/html5.js' );
	wp_enqueue_style( 'docpress-html5shiv');
	wp_style_add_data( 'docpress-html5shiv', 'conditional', 'lt IE 9' );
}

/**
 *
 * Frontend with no conditions, Add Custom Scripts to wp_head
 *
 * @since  1.0
 *
 */
add_action('wp_enqueue_scripts', 'aa_docpress_scripts');
function aa_docpress_scripts(){




	wp_enqueue_script('jquery'); // Enqueue it!
	wp_enqueue_script( 'docpress-lightboxjs', get_template_directory_uri() . '/assets/js/lightbox.min.js', array( 'jquery' ), '2013011', true );
	wp_enqueue_script( 'docpress-bootstrapjs', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '2013012', true );
	wp_enqueue_script( 'docpress-purljs', get_template_directory_uri() . '/assets/js/purl.js', array( 'jquery' ), '2013013', true );
	wp_enqueue_script( 'docpress-customjs', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), '2013014', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}


/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
//require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
//require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';
//
//
//
//

/**
 * Custom stuff
 */

// Load the TGM init if it exists
if (file_exists(dirname(__FILE__).'/assets/tgm/tgm-init.php')) {
    require_once( dirname(__FILE__).'/assets/tgm/tgm-init.php' );
}

/**
 * Disable EBS Stuff
 *
 * If returned true, then the following components will be disabled:
 * The Admin Menu (EBS Settings).
 * Frontend enqueue. No CSS and/or JS will be included on the front-end. The Shortcode Generator will continue to work as expected and admin enqueues will still be performed on New/Edit posts screen.
 *
 * @since 1.0.0
 */
function dp_apply_ebs_custom_option( $prevent ) {
    return true;
}
add_filter( 'ebs_custom_option', 'dp_apply_ebs_custom_option' );


