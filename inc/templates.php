<?php 
/**
 * Supports some template specific pages which don't need to exist within Wordpress
 * 
 * @package  socd
 */

function socd_page_title( $wp_title ) {
	global $wp_query;

	$socd_page = $wp_query->get('socd_title');

	if ( $socd_page ) {

		$wp_title = ucfirst( $socd_page ) . $wp_title;
	}

	return $wp_title;
}
add_filter('wp_title', 'socd_page_title');

/**
 * In the spirit of DRY just
 * wraps requested template in a header & footer.
 * 
 * This will load a template partial from templates/ with the convention being;
 * 
 * socd_template('example');
 * Would load: templates/example/example.php
 * 
 * An optional second parameter allows:
 * 
 * socd_template('example', 'ie');
 * Would load: templates/example/ie.php
 * 
 * 
 */
function socd_template( $template_directory, $template_name=false ) {
	global $wp_query;

	if (!$template_name) $template_name = $template_directory;

	if ( $wp_query->is_404 ) {
		$wp_query->is_404 = false;
		header("HTTP/1.1 200 OK");
	} else if ( $template_name === "404" ) {
		header("HTTP/1.1 404 Not Found");
	}
	get_header();
	require_once get_stylesheet_directory() . "/templates/{$template_directory}/{$template_name}.php";
	get_footer();
	
	exit;
}

function socd_faux_pages() {

	global $wp_query;

	$socd_pages = array(
		array(
			'slug' => 'students',
			'title' => __('Student Directory', 'socd')
		),
		array(
			'slug' => 'staff',
			'title' => __('Staff Directory', 'socd')
			),
		array(
			'slug' => 'styleguide',
			'title' => __('Styleguide', 'socd')
	) );

	foreach ( $socd_pages as $page ) {
		if ( $_SERVER['REQUEST_URI'] == "/{$page['slug']}" || $_SERVER['REQUEST_URI'] == "/{$page['slug']}/" ) {
			$wp_query->set( 'socd_title', $page['title'] );
			socd_template( $page['slug'] );
		}
	}

	// Load our Student/Staff Listings
	if ( 'profile' === $wp_query->get('socd_template') ) {
	
		$user = get_user_by( 'slug', $wp_query->get('user_slug') );

		// No User found
		// 
		if ( !$user ) {
			socd_template( 'profile', '404' );
			exit;
		};
		
		socd_template( 'profile' );
		exit;
	}
}
add_action('template_redirect', 'socd_faux_pages');

/**
 * 
 * 
 */
function socd_rewrite_urls() {
	add_rewrite_rule(
		'(students?|staff)/([a-z0-9\-]+)/?$',
		'index.php?socd_template=profile&user_slug=$matches[2]',
		'top' );
}
add_action( 'init', 'socd_rewrite_urls' );

function socd_query_vars( $query_vars ) {
	$query_vars[] = 'socd_template';
	$query_vars[] = 'user_slug';
	return $query_vars;
}
add_filter( 'query_vars', 'socd_query_vars' );

/**
 * Building Only - Flush cache
 */

function flushRules(){
	global $wp_rewrite;

	$wp_rewrite->flush_rules();
}

// add_filter('init','flushRules');