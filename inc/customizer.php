<?php
/**
 * lightpress Theme Customizer
 *
 * @package lightpress
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


function lightpress_customize_register( $wp_customize ) {
  $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'lightpress_customize_register' );



function lightpress_default_thumbnail_register($wp_customize) {

    $wp_customize->add_section('default_thumbnail_section', array(
        "title" => 'Default Post Thumbnail',
        "description" => __('Set default post thumbnail', 'lightpress')
    ));

    $wp_customize->add_setting('default_thumbnail', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        new WP_Customize_Image_Control($wp_customize, 'default_thumbnail', array(
    'label' => __('Default Post Thumbnail', 'lightpress'),
    'section' => 'default_thumbnail_section',
    'settings' => 'default_thumbnail',
    ))
    );
}

add_action('customize_register', 'lightpress_default_thumbnail_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lightpress_theme_customize_preview_js() {
	wp_enqueue_script( 'lightpress_theme_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'lightpress_theme_customize_preview_js' );

function lightpress_customize_css()
{
    ?>
        <style type="text/css">
       
        	h1.site-title a,
		p.site-description,
		.main-navigation ul>li>a {
			color: #<?php echo esc_attr(get_header_textcolor()); ?>;
		}
   		 
          </style>        
    <?php
}
add_action( 'wp_head', 'lightpress_customize_css');