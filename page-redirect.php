<?php 
/**
 * Template Name: Redirect
 */


$networks = socd_get_networks();

global $post;

$slug = $post->post_name;


foreach ( $networks as $network ) {

	$domain = explode('.', $network->domain);
	$subdomain = array_shift($domain);
	
	if ( $subdomain == $slug ) {
		wp_redirect( "http://" . $network->domain. '/about' );
	}
}

wp_redirect( get_bloginfo('wpurl') );
exit;
