<?php
/**
 * stevesandco functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package stevesandco
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'stevesandco_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function stevesandco_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on stevesandco, use a find and replace
		 * to change 'stevesandco' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'stevesandco', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'stevesandco' ),
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
				'stevesandco_custom_background_args',
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
	}
endif;
add_action( 'after_setup_theme', 'stevesandco_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function stevesandco_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'stevesandco_content_width', 640 );
}
add_action( 'after_setup_theme', 'stevesandco_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function stevesandco_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'stevesandco' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'stevesandco' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'stevesandco_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function stevesandco_scripts() {
	wp_enqueue_style( 'stevesandco-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_enqueue_script( 'stevesandco-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'stevesandco-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'stevesandco_scripts' );

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

function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');	

add_action('after_setup_theme', 'remove_admin_bar');

//Remove wordpress admin bar for logged in users
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	show_admin_bar(false);
	}
}

// Register Widgets
function custom_home_sidebar() {

	$args = array(
		'id' => 'homepage-search',
		'name' => __( 'Home Page Search', 'text_domain' ),
		'description' => __( 'This widget is the property search functionality for the homepage search function.', 'text_domain' ),
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
	);
	register_sidebar( $args );
	
}
add_action( 'widgets_init', 'custom_home_sidebar' );

function custom_properties_sidebar() {

	$args = array(
		'id' => 'properties-search',
		'name' => __( 'Properties Page Search', 'text_domain' ),
		'description' => __( 'This widget is the property search functionality for the properties page.', 'text_domain' ),
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
	);
	register_sidebar( $args );
	
}
add_action( 'widgets_init', 'custom_properties_sidebar' );

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
    <table class="form-table">
		<tr>
			<th><label for="phonenumber"><?php _e("Phone Number"); ?></label></th>
			<td>
				<input type="text" name="phonenumber" id="phonenumber" value="<?php echo esc_attr( get_the_author_meta( 'phonenumber', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
    </table>
<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'phonenumber', $_POST['phonenumber'] );
}

/**
 * Get user's first and last name, else just their first name, else their
 * display name. Defalts to the current user if $user_id is not provided.
 *
 * @param mixed $user_id The user ID or object. Default is current user.
 * @return string The user's name.
 */
function get_user_name( $user_id = null ) {

	$user_info = $user_id ? new WP_User( $user_id ) : wp_get_current_user();
   
	if ( $user_info->first_name ) {
   
		if ( $user_info->last_name ) {
			return $user_info->first_name . ' ' . $user_info->last_name;
		}
   
		return $user_info->first_name;
	}
   
	return $user_info->display_name;
}

//Removal of styling set my plugins and wp-head
add_action( 'wp_enqueue_scripts', '_remove_style', PHP_INT_MAX );

function _remove_style() {
	wp_dequeue_style('pp-flat-ui');
	wp_dequeue_style('contact-form-7');
	wp_dequeue_style('ppcore');
}

//Styling for wp-login page
add_action( 'login_enqueue_scripts', 'wpb_login' );

function wpb_login() { ?>
    <style type="text/css">
        body.login{
			background-image: url('/wp-content/themes/stevesandco/resources/sco-background.jpg');
			background-position: center;
			background-size: cover;
			background-repeat: no-repeat;
		}
		body.login #login h1{
			padding-bottom: 20px;
			background: #f9e9e6;
			padding-top: 20px;
		}
		body.login #login h1 a{
			background-image: url('/wp-content/themes/stevesandco/resources/wp-login-logo.svg');
			width: 100%;
			background-size: contain;
			background-position: center;
			height: 100px;
			margin: 0px;
		}
		body.login #login form{
			background: #f9e9e6;
			display: grid;
			grid-row-gap: 10px;
			padding: 30px 30px;
			margin: 0px;
			border: 0px;
		}
		body.login #login form .submit{
			width: fit-content;
			margin: 0 auto;
		}
		body.login #login #nav a, body.login #login #nav, body.login #login #backtoblog a{
			text-decoration: none;
			color: white;
		}
		body.login #login form .submit #wp-submit{
			width: 150px;
			text-transform: uppercase;
			border-radius: 0px;
			background-color: transparent;
			color: black;
			border: 1px solid black;
			transition: 0.5s all;
		}
		body.login #login form .submit #wp-submit:hover{
			background-color: black;
			color:white;
		}
		body.login #login form p #user_login, body.login #login form .user-pass-wrap .wp-pwd #user_pass{
			border-radius: 0px;
		}
		body.login #login form .user-pass-wrap .wp-pwd .button span{
			color: black;
		}
    </style>
<?php }

//Change url of wp-login logo
add_filter( 'login_headerurl', 'custom_loginlogo_url' );

function custom_loginlogo_url($url) {

     return '/';

}

//Change text of property pages from Draft status to On Hold/Sold
foreach( array( 'post', 'property' ) as $hook ){
	add_filter(  'gettext',  'wps_translate_words_array'  );
	add_filter(  'ngettext',  'wps_translate_words_array'  );
}

function wps_translate_words_array( $translated ) {
 
     $words = array(
            'Draft' => 'On Hold/Sold',
            );
 
     $translated = str_ireplace(  array_keys($words),  $words,  $translated );
     return $translated;
}