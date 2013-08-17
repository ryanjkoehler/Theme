<?php 
/**
 * 
 * Handles modifications to the WordPress dashboard and some of it's
 * quirky pages.
 * 
 * @package  socd
 */

function socd_signup_style() {
	global $wp_filter;
	remove_action( 'wp_head', 'wpmu_signup_stylesheet' );
}

add_action('wp_head', 'socd_signup_style', 1);

function socd_signup_page() {
	require_once get_stylesheet_directory() . "/templates/signup/signup.php";;
}

add_action('before_signup_form', 'socd_signup_page');


/**
 * Customisations to the Login form
 * 
 */

function socd_login_url() {
	return get_bloginfo( 'wpurl' );
}
add_filter( 'login_headerurl', 'socd_login_url' );

function socd_login_styles() {
	wp_enqueue_style('admin_css', get_template_directory_uri() . '/assets/stylesheets/admin.css' );
}

add_filter('login_head', 'socd_login_styles');


function socd_admin_footer() {
	printf(
		"&copy; %d<a href=\"%s\">School of Communication Design</a>",
		date("Y"),
		get_bloginfo('wpurl')
	);
}