<?php
/**
 * lightpress functions and definitions
 *
 * @package lightpress
 */

if ( ! function_exists( 'lightpress_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lightpress_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on lightpress, use a find and replace
	 * to change 'lightpress' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'lightpress', get_template_directory() . '/languages' );

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
	  add_theme_support( 'post-thumbnails' );
	 // set_post_thumbnail_size( 571, 373, true );
	 // add_image_size( 'slider-thumb', 492, 318, array( 'center', 'center') ); // Homepage blog Images
	 // add_image_size( 'home-thumb', 360, 240, array( 'center', 'center') ); // Homepage blog Images
	 // add_image_size( 'portfolio-thumb', 860, 620, false ); // Archive Pages
	 // add_image_size( 'single-thumb', 860, 620, false ); // Single Pages


	

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'lightpress' ),
		'secondary' => esc_html__( 'Footer Menu', 'lightpress' ),
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

	add_theme_support( 'custom-logo', array(
		'height'      => 55,
		'width'       => 150,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'lightpress_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_theme_support( "custom-header", 
		array(
		'default-color' => 'ffffff',
		'default-image' => '',
			)  
		);
	/*
	 * Enable support for Selective Refresh for Widgets.
	 * See https://make.wordpress.org/core/2016/11/10/visible-edit-shortcuts-in-the-customizer-preview/
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_editor_style() ;
}
endif; // lightpress_setup
add_action( 'after_setup_theme', 'lightpress_setup' );




/**
 * Enqueue scripts and styles.
 */
function lightpress_scripts() {
	wp_enqueue_style( 'lightpress-bootstrap', get_template_directory_uri().'/css/bootstrap.min.css' );
	$query_args = array('family' => 'Raleway:400,700');
	wp_register_style( 'google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
	wp_enqueue_style( 'google-fonts' );	
	wp_enqueue_style( 'lightpress-style', get_stylesheet_uri() );

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'lightpress-nav', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true );
	wp_enqueue_script( 'lightpress-bootstrap-min', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'lightpress-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lightpress_scripts' );





/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! isset( $content_width ) ) $content_width = 900;
function lightpress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lightpress_content_width', 640 );

}
add_action( 'after_setup_theme', 'lightpress_content_width', 0 );


function lightpress_filter_front_page_template( $template ) {
    return is_home() ? '' : $template;
}
add_filter( 'front_page_template', 'lightpress_filter_front_page_template' );





/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lightpress_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'lightpress' ),
		'id'            => 'footer',
		'description'   => __('Footer Widget', 'lightpress'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'lightpress_widgets_init' );


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
 * Load TGM plugin 
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';


/* Recommended plugin using TGM */
add_action( 'tgmpa_register', 'lightpress_register_plugins');
if( !function_exists('lightpress_register_plugins') ) {
	function lightpress_register_plugins() {
       /**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(

			array(
				'name'     => 'One Click Demo Import', // The plugin name.
				'slug'     => 'one-click-demo-import', // The plugin slug (typically the folder name).
				'required' => false, // If false, the plugin is only 'recommended' instead of required.
			),
			array(
				'name'               => 'Contact Form 7', // The plugin name.
				'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
				'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			),
		);
		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'tgmpa',
			// Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',
			// Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins',
			// Menu slug.
			'parent_slug'  => 'themes.php',
			// Parent menu slug.
			'capability'   => 'edit_theme_options',
			// Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,
			// Show admin notices or not.
			'dismissable'  => true,
			// If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',
			// If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,
			// Automatically activate plugins after installation or not.
			'message'      => '',
			// Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}

/* LightPress Demo importer */
add_filter( 'pt-ocdi/import_files', 'lightpress_import_demo_data' );
if ( ! function_exists( 'lightpress_import_demo_data' ) ) {
	function lightpress_import_demo_data() {
	  return array(
	    array(   
			'import_file_name'             => __('Default Demo','lightpress'),
			'categories'                   => array( 'Default', 'Blog' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo/default/demo-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo/default/widgets.json',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo/default/customizer.dat',
			'import_preview_image_url'     => 'https://phantomthemes.com/demo/lightpress/wp-content/themes/lightpress/screenshot.png',
			'preview_url'                  => 'https://phantomthemes.com/view?theme=LightPress',
		),
	  ); 
	}
}


add_action( 'pt-ocdi/after_import', 'lightpress_after_import' );
if ( ! function_exists( 'lightpress_after_import' ) ) {
	function lightpress_after_import( $selected_import ) { 
		$importer_name  = __('Default Demo','lightpress');
	 
	    if ( $importer_name === $selected_import['import_file_name'] ) {
	        //Set Menu
			$top_menu = get_term_by('name', 'Primary Menu', 'nav_menu'); 
			$footer_menu= get_term_by('name', 'Footer Menu', 'nav_menu');
	        set_theme_mod( 'nav_menu_locations' , array( 				  
				'primary' => $top_menu->term_id,
				'secondary' => $footer_menu->term_id,				
	             ) 
	        );
	    }
	     
	}
}

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );



/* Check whether the One Click Import Plugin is installed or not */
/*
function lightpress_is_plugin_installed($plugin_title)
{
    // get all the plugins
    $installed_plugins = get_plugins();

    foreach ($installed_plugins as $installed_plugin => $data) {

        // check for the plugin title
        if ($data['Title'] == $plugin_title) {

            // return true if plugin is installed
            return true;
        }
    }

    return false;
}
*/