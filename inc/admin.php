<?php 
/**
 * 
 * Handles modifications to the WordPress dashboard and some of it's
 * quirky pages. Such as 
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