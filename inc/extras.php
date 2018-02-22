<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package lightpress
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function lightpress_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'lightpress_body_classes' );

/**
 * Enqueue scripts for customizer
 */
//customizer Pro

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.1.1
 * @access public
 */
final class lightpress_Customize {
  /**
   * Returns the instance.
   *
   * @since  1.1.1
   * @access public
   * @return object
   */
  public static function get_instance() {
    static $instance = null;
    if ( is_null( $instance ) ) {
      $instance = new self;
      $instance->setup_actions();
    }
    return $instance;
  }
  /**
   * Constructor method.
   *
   * @since  1.1.1
   * @access private
   * @return void
   */
  private function __construct() {}
  /**
   * Sets up initial actions.
   *
   * @since  1.1.1
   * @access private
   * @return void
   */
  private function setup_actions() {
    // Register panels, sections, settings, controls, and partials.
    add_action( 'customize_register', array( $this, 'sections' ) );
    // Register scripts and styles for the controls.
    add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
  }
  /**
   * Sets up the customizer sections.
   *
   * @since  1.1.1
   * @access public
   * @param  object  $manager
   * @return void
   */
  public function sections( $manager ) {
    // Load custom sections.
    require_once locate_template( 'inc/lightpress-pro.php' );
    // Register custom section types.
    $manager->register_section_type( 'lightpress_Customize_Section_Pro' );
    // Register sections.
    $manager->add_section(
      new lightpress_Customize_Section_Pro(
        $manager,
        'lightpress',
        array(
          'title'    => esc_html__( 'Lightpress Pro', 'lightpress' ),
          'pro_text' => esc_html__( 'Buy Pro',         'lightpress' ),
          'pro_url'  => 'http://phantomthemes.com/downloads/lightpress-pro-wordpress-theme/'
        )
      )
    );
  }
  /**
   * Loads theme customizer CSS.
   *
   * @since  1.1.1
   * @access public
   * @return void
   */
  public function enqueue_control_scripts() {
    wp_enqueue_script( 'lightpress-customize-controls', trailingslashit( get_template_directory_uri() ) . 'js/lightpress-customizer.js', array( 'customize-controls' ) );
    wp_enqueue_style( 'lightpress-customize-controls', trailingslashit( get_template_directory_uri() ) . 'css/lightpress-customizer.css' );
  }
}
// Doing this customizer thang!
lightpress_Customize::get_instance();