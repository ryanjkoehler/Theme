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
	printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate><span class="date">%5$s %6$s</span><span class="time">%4$s</span></time></a><span class="byline">Posted by <span class="author vcard"><a class="url fn n" href="%7$s" title="%8$s" rel="author">%9$s</a></span></span>', 'dj' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'g:ia' ) ),
		esc_html( get_the_date( 'jS M') ),
		esc_html( get_the_date( 'Y') ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'dj' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}



function socd_network_menu() {
	if ( false === ( $output = get_site_transient( 'site__socd_menu' ) ) || false ) {
		switch_to_blog( 1 );
		$output = wp_nav_menu( array(
			'theme_location' => 'socd_network_menu',
			'container_class' => 'drop',
			'echo' => false
		) );
		restore_current_blog();
		set_site_transient( 'site__socd_menu', $output, 1 * HOUR_IN_SECONDS );
	}

	echo $output;
} 

function socd_network_footer() {

	if ( false === ( $output = get_site_transient( 'site__socd_network_footer' ) ) || true ) {
		switch_to_blog( 1 );
		$output = wp_nav_menu( array(
			'theme_location' => 'socd_network_footer',
			'menu_class' => 'ul footer--menu',
			'echo' => false
		) );
		restore_current_blog();
		set_site_transient( 'site__socd_network_footer', $output, 1 * HOUR_IN_SECONDS );
	}

	echo $output;
}