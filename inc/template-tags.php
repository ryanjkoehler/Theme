<?php 
/**
 * Template Specific Tags
 * 
 * @package  socd
 */

function socd_body_class($classes) {
	$options = get_option('socd_theme_options');

	if ($options['blog_type']) {
		$classes[] = 'template__' . $options['blog_type'];
	}

	return $classes;
} 
add_filter('body_class', 'socd_body_class');


function socdinfo($key) {
	$options = get_option('socd_theme_options');

	echo isset( $options[$key] ) ? $options[$key] : '';
}