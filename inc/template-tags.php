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



/**
 * Helper function to get values out of the themes'
 * serialised array of options.
 * 
 * @return [type]      [description]
 */
function socdinfo($key) {
	$options = get_option('socd_theme_options');

	echo isset( $options[$key] ) ? $options[$key] : '';
}

function is_noticeboard() {
	$options = get_option('socd_theme_options');
	return "noticeboard" == $options['blog_type'];
}

function is_sketchbook() {
	$options = get_option('socd_theme_options');
	return "sketchbook" == $options['blog_type'];
}

function socd_posted_on() {
	printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"><span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'dj' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'dj' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
