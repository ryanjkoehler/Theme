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
 * wraps requested template in a header & footer
 * 
 * @return [type] [description]
 */
function socd_template( $template ) {
	global $wp_query;

	if ( $wp_query->is_404 ) {
		$wp_query->is_404 = false;
		header("HTTP/1.1 200 OK");
	}
	get_header();
	require_once get_stylesheet_directory() . "/templates/{$template['slug']}/{$template['slug']}.php";
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
			socd_template( $page );
		}
	}
}
add_action('template_redirect', 'socd_faux_pages');
