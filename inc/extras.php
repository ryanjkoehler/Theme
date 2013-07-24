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
