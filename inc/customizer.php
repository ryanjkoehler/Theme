<?php 
/**
 * Adds support for WordPress' Customizer
 * 
 * @package socd
 */


function socd_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'socd_settings', array(
		'title'    => __('Settings', 'socd'),
		'priority' => 120,
	) );

	$wp_customize->add_setting( 'socd_theme_options[blog_type]', array(
		'default' 	 => 'sketcbook',
		'capability' => 'edit_theme_options',
		'type'    	 => 'option'
	) );

	$wp_customize->add_control( 'socd_blog_type', array(
		'label' 	=> __('Blog Type', 'socd'),
		'section' 	=> 'title_tagline',
		'settings' 	=> 'socd_theme_options[blog_type]',
		'type'	 	=> 'radio',
		'choices' 	=> array(
			'noticeboard' => 'Noticeboard',
			'sketchbook'  => 'Sketchbook'
	) ) );

	$wp_customize->remove_section( 'static_front_page' );
}
add_action( 'customize_register', 'socd_customize_register' );

function socd_customize_menu() {
	add_theme_page( 'customize.php', __( 'Customize', 'socd' ), 'edit_theme_options', 'customize.php' );
}
add_action('admin_menu', 'socd_customize_menu');