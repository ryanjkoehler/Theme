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
function socdinfo( $key ) {
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

if ( !function_exists('is_network') ) {

	/**
	 * Checks whether the current blog is a Network. Currently
	 * this is reliant on the 'Networks for WordPress' plugin being available
	 * 
	 * @return boolean [description]
	 */
	function is_network( $blog_id = false ) {
		
		global $current_blog, $table_prefix, $wpdb;

		if (!$blog_id ) $blog_id = $current_blog->blog_id;

		$url_no_prototcal = preg_replace('/https?:\/\//', '', get_bloginfo( 'wpurl' ) );

		// Query sites table
		// 
		if ( !isset($wpdb->sites) ) {
			$wpdb->sites = $wpdb->base_prefix . 'site';
		}
		$res = $wpdb->get_results("SELECT * FROM $wpdb->sites WHERE `domain` = '" . $url_no_prototcal . "'");


		if ( ! $res ) return false;
		
		return count($res) == 1;
	}
}

function socd_get_subdomain() {
	$subdomain = preg_replace( '/https?:\/\//', '', get_bloginfo( 'url' ) );

	$parts = explode('.', $subdomain);

	$subdomain = array_shift( $parts );
	if ( in_array( $subdomain, array( 'www', 'socd' ) ) ) {
		return false;
	}

	return $subdomain;
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

/**
 * Network wide navigation menu, this is controlled via the primary Network Appearance > Menus
 * @return [type] [description]
 */
function socd_network_menu() {
	if ( !function_exists('switch_to_blog') ) return false;

	if ( false === ( $output = get_site_transient( 'site__socd_menu' ) ) || false ) {
		switch_to_blog( 1 );
		$output = wp_nav_menu( array(
			'theme_location' => 'socd_network_menu',
			'container' => '',
			'menu_class' => 'drop',
			'echo' => false
		) );
		restore_current_blog();
		set_site_transient( 'site__socd_menu', $output, 1 * HOUR_IN_SECONDS );
	}

	echo $output;
}

function socd_site_menu(){
	//just so we've got something coming out
	$current_site_id = get_current_site()->id;

	if ( false === ( $output = get_site_transient( 'site__socd_site_' . $current_site_id . '_menu' ) ) || false ) {
		switch_to_blog( $current_site_id );
	
		$output = wp_nav_menu( array(
			'theme_location' => 'socd_site_menu',
			'container' 	 => '',
			'menu_class' 	 => 'drop',
			'echo'		 	 => false
		) );

		restore_current_blog();
		set_site_transient( 'site__socd_site_' . $current_site_id . '_menu' , $output, 1 * HOUR_IN_SECONDS );
	}

	echo $output;
}

function socd_blog_menu(){
	//just so we've got something coming out
    $output = wp_nav_menu( array(
		'theme_location' => 'socd_blog_menu',
		'container' 	 => '',
		'menu_class' 	 => 'drop',
		'echo'		 	 => false
	) );

	echo $output;
}

function socd_menu_course_title() {
	global $current_site;
	$course_code = strtolower( $current_site->site_name );
	return socd_course_code_to_course_name( $course_code );
}

function socd_menu_has_blog_crumb() {
	global $current_blog;
	if( $current_blog->blog_id != $current_blog->site_id ){
		return true;
	}
}

function socd_menu_has_course_crumb() {
	global $current_site;
	if( $current_site->id == 1 ){
		return false;
	}
	return true;
}

function socd_menu_page_title() {
	if( is_noticeboard() ){
		$output = "Noticeboard";
	} else if( is_sketchbook() ){
		$output = "Sketchbook";
	}

	if( is_page() ){
		$output = get_the_title();
	}

	if( is_front_page() ){
		if( is_noticeboard() ){
			$output = "Noticeboard";
		} else if( is_sketchbook() ){
			$output = "Sketchbook";
		} else {
			$output = false;
		}
	}

	return $output;
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

function socd_back_url() {
	$url = isset( $_SERVER['HTTP_REFERER'] ) ? htmlspecialchars( $_SERVER['HTTP_REFERER'] ) : '';

	if ( ! preg_match( '/socd/', $url ) ) return get_bloginfo( 'wpurl' );
	
	return $url;
}

function socd_profile_url( $user = false ) {
	if ( !$user ) {
		global $user;
		$user = $user;
	}

	$group = 'students';
	if ( 'staff' == get_user_meta( $user->ID, 'group', true ) ) {
		$group = 'staff';
	}

	return get_bloginfo( 'wpurl' ) . "/$group/$user->data->user_login";
	die();
}

function socd_user_thumbnail( $user, $size = 'thumbnail' ) {
	$src = wp_get_attachment_image_src( get_the_author_meta( 'user_headshot', $user->ID ), $size );
	
	if (!$src) {
		$src = 'http://placehold.it/150x150';
	} else {
		$src = array_shift($src);
	}

	printf(
		'<img class="thumb" itemprop="image" src="%s" />',
		$src
	);
}

function socd_course_code_to_course_name( $course_slug ) {

	$courses = array(
		'dcd'	 => "BA (Hons) Digital Communication Design",
		'gd'	 => "BA (Hons) Graphic Design",
		'cga'	 => "BA (Hons) Computer Games Arts",
		'gc'	 => "BA (Hons) Graphic Communication",
		'i'	 	 => "BA (Hons) Illustration",
		'abc'	 => "BA (Hons) Advertising Brand Communication",
		'gdvc'	 => "BA (Hons) Graphic Design: Visual Communication",
		'magd'	 => "MA Graphic Design",
		'madibm' => "MA Design Innovation and Brand Management",
		'mai'	 => "MA Illustration"
	);

	if ("" == $course_slug || !$course_slug) return;
	
	return isset( $courses[ $course_slug ] ) ? $courses[ $course_slug ] : false;
}

function socd_get_profile_field( $fieldname ) {
	global $user;



	return get_user_meta( $user->data->ID, $fieldname, true );
}

if ( ! function_exists('profile_field') ) {

	/**
	 * Profile field fetcher
	 * 
	 * @uses socd_get_profile_field
	 * @return [type] [description]
	 */
	function profile_field( $fieldname ) {

		echo socd_get_profile_field( $fieldname );
	}
}

function socd_headshot() {
	$attachment_id = socd_get_profile_field('user_headshot');

	if (!$attachment_id) return;

	echo wp_get_attachment_image( $attachment_id, 'original', false, array(
		'class' => "profile--headshot"
	) );
}