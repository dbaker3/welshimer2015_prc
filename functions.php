<?php
/**
 * welshimer2013 functions and definitions
 *
 * @package welshimer2013
 * @since welshimer2013 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since welshimer2013 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'welshimer2013_setup' ) ):

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since welshimer2013 1.0
 */
function welshimer2013_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * WordPress.com-specific functions and definitions
	 */
	//require( get_template_directory() . '/inc/wpcom.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on welshimer2013, use a find and replace
	 * to change 'welshimer2013' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'welshimer2013', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'welshimer2013' ),
		'secondary' => __( 'Secondary Menu', 'welshimer2013' ),
      'kb' => __( 'KB', 'welshimer2013' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );

}
endif; // welshimer2013_setup
add_action( 'after_setup_theme', 'welshimer2013_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since welshimer2013 1.0
 */
function welshimer2013_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'welshimer2013' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'welshimer2013_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function welshimer2013_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri(), false, filemtime(get_template_directory() . '/style.css'), 'all' );
	wp_enqueue_script( 'js-min', get_template_directory_uri() . '/js/js-min.js', array( 'jquery' ), filemtime(get_template_directory() . '/js/js-min.js'), true );

// These are included in js-min.js but are retained for testing purposes
	//wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120626', true );
	//wp_enqueue_script( 'timeago', get_template_directory_uri() . '/js/timeago.js', array( 'jquery' ), '20120904', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'welshimer2013_scripts' );

function welshimer2013_before_sidebar() {
	echo '<a class="side-expand"></a>';
}
add_action('before_sidebar', 'welshimer2013_before_sidebar');


// Stop WP from inserting <p>'s and <br>'s (dbaker)
remove_filter('the_content', 'wpautop');

// Add <p>'s back to blog posts (1/2/15)
function keep_wpautop_on_posts($content) {
	if(get_post_type()=='post')
	    return wpautop($content);
	else
	 return $content;
}
add_filter('the_content','keep_wpautop_on_posts');


// Convert 'Website' field on comment form to a honeypot - 1/9/15 dbaker
function comment_honeypot_check() {
   if(trim($_POST['url']) !== '') {
			wp_die('You may not be human, please try again without entering text into the <strong>Website</strong> field.', 400);
		}
}
function comment_honeypot_field_mod($fields) {
   $fields['url'] = '<p class="comment-form-url"><label for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
                    '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
                    '" size="30" tabindex="999" /></p>';
    return $fields;
}
add_action('pre_comment_on_post', 'comment_honeypot_check');
add_filter('comment_form_default_fields', 'comment_honeypot_field_mod');


// redirect logins to homepage
add_filter( 'login_redirect', create_function( '$url,$query,$user', 'return home_url();' ), 10, 3 );

?>