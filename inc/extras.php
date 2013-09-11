<?php
/**
 * Some extra bits and pieces, perhaps one day 
 * they will exist in core roll them into 
 * 
 * 
 * @package  socd
 */

/**
 * Recursively drills down to find the root parent.
 * If there is no root it will return the current page id.
 * 
 * 
 * @param  int $post_id
 * @return int
 */
function get_post_parent_id ( $post_id = false ) {
	global $post;

	if ($post_id) $post = get_post($post_id);

	return $post->post_parent ? get_post_parent_id( $post->post_parent ) : $post->ID;
}


function socd_get_networks() {
	global $wpdb;

	$query = "SELECT {$wpdb->site}.*,
			sm1.meta_value as site_name,
			sm2.meta_value as site_admins,
			COUNT({$wpdb->blogs}.blog_id) as blogs,
			{$wpdb->blogs}.path as blog_path
		FROM
			{$wpdb->site}
		LEFT JOIN
			{$wpdb->blogs}
		ON
			{$wpdb->blogs}.site_id = {$wpdb->site}.id
		LEFT JOIN
			{$wpdb->sitemeta} as sm1
		ON
			sm1.meta_key = 'site_name' AND
			sm1.site_id = {$wpdb->site}.id
		LEFT JOIN
			{$wpdb->sitemeta} as sm2
		ON
			sm2.meta_key = 'site_admins' AND
			sm2.site_id = {$wpdb->site}.id
		GROUP BY {$wpdb->site}.id";

	$networks = $wpdb->get_results( $query );

	return $networks;
}

/**
 * 
 * @uses  socd_get_networks
 * @return [type] [description]
 */
function socd_get_grouped_networks() {

	$networks = socd_get_networks();

	$lists = array(
		'BA' => array(),
		'MA' => array()
	);

	foreach ( $networks as $network ) {
		if ( preg_match( '/^(BA|MA)/', $network->site_name, $matches ) ) {
			array_push( $lists[ $matches[0] ], $network );
		}
	}

	return $lists;
}

function socd_content_filter( $content ) {
	return preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '\1', $content);
}

add_filter( 'the_content', 'socd_content_filter' );