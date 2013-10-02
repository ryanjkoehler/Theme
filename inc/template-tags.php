<?php 
/**
 * Template Specific Tags
 * 
 * @package  socd
 */

function socd_body_class( $classes ) {
	$options = get_option('socd_theme_options');

	if ($options['blog_type']) {
		$classes[] = 'template__' . $options['blog_type'];
	}

	if ( $f = get_post_format() )
		$classes[] = 'article__format-' . $f;

	return $classes;
} 
add_filter( 'body_class', 'socd_body_class' );

function socd_post_class( $classes ) {
	global $post;
	
	if ( has_post_thumbnail() )
		$classes[] = 'article__w-thumbnail';
	
	return $classes;
}
add_filter( 'post_class', 'socd_post_class' );

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

function socd_get_subdomain() {
	$subdomain = preg_replace( '/https?:\/\//', '', get_bloginfo( 'url' ) );

	$parts = explode('.', $subdomain);


	$subdomain = array_shift( $parts );
	if ( in_array( $subdomain, array( 'www', 'socd' ) ) ) {
		return false;
	}

	return $subdomain;
}

function socd_get_excerpt(){
	$excerpt = get_the_excerpt();	
	return str_replace( '[&hellip;]', '<a href="' . get_permalink() . '">&rarr;</a>', $excerpt );
}

function socd_excerpt(){
	echo socd_get_excerpt();
}

function socd_staff_display_name( $user_id ) {
	$user = get_userdata( $user_id );
	return $author_display = socd_is_staff( $user->ID ) ? get_user_meta( $user->ID, 'nickname', true ) : $user->display_name;
}

function socd_posted_on() {

	$user_id = get_the_author_meta( 'ID' );

	printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate><span class="date">%5$s</span> <span class="time">%4$s</span></time></a>%7$s<span class="byline">Author <span class="author vcard"><a class="url fn n" href="%8$s" title="%9$s" rel="author">%10$s</a></span></span>', 'socd' ), esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'H:i' ) ),
		esc_html( get_the_date( 'j M y') ),
		esc_html( get_the_date( 'Y') ),
		socd_get_post_format_icon(),
		esc_url( get_author_posts_url( $user_id ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'socd' ), get_the_author() ) ),
		socd_staff_display_name( $user_id )
	);
}

function socd_get_post_format_icon(){
	if( get_post_format() ){
		return sprintf( '<span class="post_format post_format__%1$s">%1$s</span>', get_post_format() );
	}
}
function socd_post_format_icon(){
	echo socd_get_post_format(); 
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

	$output = '';

	if( is_noticeboard() ){
		$output = "Noticeboard";
	} else if( is_sketchbook() ){
		$output = "Sketchbook";
	}

	if( is_page() || is_single() ){
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

	if ( socd_back_url_invalid( $url ) )
		return socd_blog_url();
	
	return $url;
}

function socd_back_url_invalid( $url ) {
	$blog_url = socd_blog_url();
	return (
		!strstr( $url, $blog_url )
		|| "" == $url
		|| $_SERVER['HTTP_REFERER'] == "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
		|| preg_match( '/wp-admin/', $url )
	);
}

function socd_blog_url() {
	return get_option('page_on_front') > 0 ? get_permalink( get_bloginfo('page_for_posts') ) : get_bloginfo( 'wpurl' );
}

function socd_staff_page_url(){
	echo get_bloginfo( 'wpurl' ) . '/staff';
}

function socd_get_profile_url( $user = false ) {
	if ( !$user ) {
		global $user;
		$user = $user;
	}

	$group = 'students';
	if ( 'staff' == get_user_meta( $user->ID, 'group', true ) ) {
		$group = 'staff';
	}

	return get_bloginfo( 'wpurl' ) . "/$group/" . $user->data->user_login;
}

function profile_url() {
	echo socd_get_profile_url();
}

function socd_get_profile_thumbnail( $size = 'thumb', $user_id = false ) {
	
	global $user;

	if (!$user_id) $user_id = $user->data->ID;

	$src = get_user_meta( $user_id, 'user_headshot_' . $size, true );
	
	// No source found
	if ( $src ) {
		return sprintf(
			'<img class="avatar thumb" itemprop="image" src="%s" />',
			$src
		);
	}

	return preg_replace("/[a-z]+='[0-9]+'/", '', get_avatar( $user_id, 150 ) );
}

function socd_filter_sites( $sites ) {
	$not_course_sites = array();
	$course_sites = array(
		1, // socd
		3, // dcd
		5, // gc
		6, // cga
		7, // gc
		8, // illustration
		9, // advertising brand
		10, // gdvc
		11, // ma gd
		12, // ma design innovation
		13, // ma illustration
	);

	foreach ( $sites as $site ) {
		if ( ! in_array( (int) $site->userblog_id, $course_sites ) ) {
			$not_course_sites[] = $site;
		}
			
	}
	
	return $not_course_sites;
}

function socd_wpdb_root_prefix() {
	global $wpdb;
	return array_shift( explode('_', $wpdb->prefix ) ) . "_";
}

function socd_is_user_blog_admin( $user_id, $blog_id ) {
	global $wpdb;

	$query = $wpdb->prepare( "SELECT user_id, meta_value FROM $wpdb->usermeta WHERE meta_key = %s",
		socd_wpdb_root_prefix() . $blog_id . '_capabilities'
	);


	$role = $wpdb->get_results( $query, ARRAY_A );
	
	// clean the role
	$all_user = array_map( array( 'BPDevLimitBlogsPerUser', 'serialize_roles' ), $role ); // we are unserializing the role to make that as an array
	
	foreach( $all_user as $key => $user_info )
		if( isset($user_info['meta_value']['administrator']) && $user_info['meta_value']['administrator'] == 1 && $user_info['user_id'] == $user_id ) // if the role is admin
			return true;
	return false;
}

function socd_get_user_blog( $user_id ) {
	$blogs = socd_filter_sites( get_blogs_of_user( $user_id ) );

	foreach ( $blogs as $blog ) {
		if ( socd_is_user_blog_admin( $user_id, $blog->userblog_id ) )	{
			return $blog;
		}
	}
}

function socd_user_blog_link( $user_id ) {

	$blog = socd_get_user_blog( $user_id );
	
	if ( is_null( $blog ) || empty( $blog->siteurl ) ) {
		return false;
	}

	printf(
		'<a href="%1$s" class="blogurl">View %2$s</a>', 
		$blog->siteurl,
		$blog->blogname
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

function socd_get_profile_field( $fieldname, $user_id = false ) {
	global $user;

	$user_id = $user_id ? $user_id : $user->data->ID;

	return get_user_meta( $user_id, $fieldname, true );
}

if ( ! function_exists('profile_field') ) {

	/**
	 * Profile field fetcher
	 * 
	 * @uses socd_get_profile_field
	 * @return [type] [description]
	 */
	function profile_field( $fieldname, $user_id = false ) {

		echo socd_get_profile_field( $fieldname, $user_id );
	}
}

/**
 * Profile Specific Fields
 */

function socd_headshot( $class = "" ) {
	$attachment_id = socd_get_profile_field('user_headshot');

	if (!$attachment_id) return;

	echo wp_get_attachment_image( $attachment_id, 'original', false, array(
		'class' => $class . " profile--headshot"
	) );
}

/**
 * @uses socd_get_profile_field, socd_get_subdomain
 * @return [type] [description]
 */
function socd_user_match_current_course() {
	global $user, $current_site;

	echo socd_get_profile_field('course') !== socd_get_subdomain() && $current_site->blog_id !== 1 ? 'style="display: none;"' : '';
}

/**
 * Takes a current user and get's their current course
 * @return String
 */
function socd_course() {
	global $user;
	echo socd_course_code_to_course_name( socd_get_profile_field('course') );
}

function socd_year_code(){
	echo socd_get_profile_field( 'group' );
}
function socd_course_code(){
	echo socd_get_profile_field( 'course' );
}

/**
 * Prints the user's year of enrolment, if that's not found
 * then it will attempt to calculate that using their group/year number
 * 
 * @uses socd_get_profile_field
 */
function socd_enrolment_year() {
	$enrolment = socd_get_profile_field( 'socd_enrolment_year' );
	
	if ( "" != $enrolment ) echo $enrolment;

	$year_of_study = socd_get_profile_field('group');

	if ( $year_of_study > 0 ) echo date("Y") - $year_of_study;
}


/**
 * Filters used on the Student listing page
 * 
 * @param  [string] $column [description]
 * @return [array]         [description]
 */
function get_filters( $column = false ) {
	global $wpdb;
	
	// If no column specify then return an empty array
	if (!$column) return array();

	$q = "SELECT `meta_value` FROM {$wpdb->base_prefix}usermeta WHERE `meta_key` = '$column' AND `meta_value` NOT LIKE 'staff' GROUP BY `meta_value`";	
	return $wpdb->get_col( $q , 0);
}

/**
 * 
 * 
 * @uses get_filters
 */
function socd_filter_years_of_study() {
	$filters = get_filters('group');

	$output = array();

	foreach ( $filters as $filter ) {

		if ( $filter !== "student")
			$output[] = sprintf(
				'<li><a href="#%1$s">%2$s</a></li>',
				$filter,
				preg_match('/alumni/', $filter) ? ucfirst( $filter ) : 'Year ' . $filter
			);
	}

	echo implode( ' ', $output );
}

/**
 * 
 * 
 * @uses get_filters
 */
function socd_filter_course() {
	$filters = get_filters('course');
	
	$output = array();

	foreach ( $filters as $filter ) {

		if ( $course_name = socd_course_code_to_course_name( $filter ) )
			$output[] = sprintf(
				'<li class="%3$s"><a href="#%1$s">%2$s</a></li>',
				$filter,
				preg_replace('/(BA|MA|Hons|\(|\))/', '', $course_name ),
				$filter == socd_get_subdomain() ? 's__active' : ''
			);
	}

	echo implode( ' ', $output );
}

/**
 * 
 * 
 * @uses get_filters
 */
function socd_filter_campus() {
	$filters = get_filters('socd_campus');
	
	$output = array();
	foreach ( $filters as $filter ) {
		$output[] = sprintf(
			'<li><a href="#">%1$s</a></li>',
			$filter
		);
	}

	echo implode( ' ', $output );
}

function socd_get_vcard( $location = false ) {
	global $location;

	$output = '<div itemscope itemtype="http://schema.org/EducationalOrganization">';
		$output .= '<h2 class="h4 heading--ruled" itemprop="name">' . $location['name'] . '</h2>';
		$output .= '<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';
			$output .= '<span itemprop="streetAddress">' . $location['street_address'] . '</span>';
			$output .= '<span itemprop="addressLocality">' . $location['address_locality'] . '</span>, ';
			$output .= '<span itemprop="addressRegion">' . $location['address_region'] . '</span><br/>';
			$output .= '<span itemprop="postalCode">' . $location['postal_code'] . '</span>';
		$output .= '</div>';
		$output .= '<a href="tel:' . $location['telephone'] . '" itemprop="telephone">' . $location['telephone'] . '</a>';

		$geo = socd_get_coordinates( $location['locations']['coordinates'] );

		if ( count( $geo ) == 2 )
			$output .='<div itemprop="location" itemscope itemtype="http://schema.org/GeoCordinates"><meta itemprop="latitude" content="' . $geo[0] . '"/><meta itemprop="longitude" content="' . $geo[1] . '"/></div>';

	$output .= '</div>';


	return $output;
}

function socd_get_coordinates( $str ) {
	if ( !preg_match( '/,/', $str ) ) return array();
	return explode( ',', $str );
}


function socd_vcard() {
	echo socd_get_vcard();
}


/**
 * Randomly Load Four staff members
 */

function socd_get_random_staff( $no_of_staff = 4 ) {

	global $user;

	$staff = get_users( array(
		'number' 	 => 999,
		'meta_query' => array(
			array(
				'key'  	  => 'group',
				'value'   => 'staff',
				'compare' => '='
	) ) ) );

	$output = array();

	if ( $staff ) {

		shuffle( $staff );

		for ( $i = 0, $max = $no_of_staff; $i < $max; $i++ ) {

			$user = $staff[$i];
			
			$output[] = sprintf(
				'<div class="col one-half" itemscope itemtype="http://schema.org/Person"><a href="%1$s">%2$s</a><span itemprop="name" class="name">%3$s</span></div>',
				socd_get_profile_url(),
				socd_get_profile_thumbnail(),
				$user->display_name
			);
		} 
	}

	echo implode( '', $output );
}



/**
 * @uses socd_get_grouped_networks
 * @return HTML Output
 */
function socd_network_listing() {
		
	$listing = socd_get_grouped_networks();

	$titles = array(
		'MA' => 'MA',
		'BA' => 'BA (Hons)'
	);

	foreach ( $listing as $label => $list ) { ?>
		<h3 class="h4"><?php echo $titles[ $label ]; ?></h3>
		<ul class="listing__courses">
			<?php


			foreach ( $list as $course ) {

				if ( $course->domain != preg_replace('/https?:\/\//', '', get_bloginfo('wpurl') ) )
					printf('<li><a href="%1$s">%2$s</a></li>',
						'http://' . $course->domain,
						str_replace( $titles[ $label ], '', $course->site_name )
					);
			} ?>
		</ul><?php 
	}

	return $listing;
}

function socd_user_blogs(){
	echo socd_get_user_blogs();
}

function socd_get_user_blogs(){
	global $user;
	$blogs = get_blogs_of_user( $user->ID );
	$valid_blogs = 0;
	echo '<!--';
	var_dump( $blogs );
	echo '-->';
	$output = '<ul>';
	foreach ( $blogs as $blog) {
		if( 1 != $blog->userblog_id ){
			$output .= sprintf( 
				'<li><a href="%1$s">%2$s</a></li>', 
				$blog->siteurl,
				$blog->blogname				
			);
			$valid_blogs++;
		}
	}
	$output .= '</ul>';

	if( $valid_blogs > 0 ) return $output;
	
	return false;
}


function socd_post_thumbnail() {
	global $post;

	if ( ! has_post_thumbnail() ) return false;

	?><figure class="article--thumbnail">
		<?php the_post_thumbnail( false, array( 'class' => '' ) ); ?>
	</figure><?php 
}

function socd_beta_link() {
	echo "mailto:admin@socd.io?subject=Beta Issue/Question&body=Hello All,%0D%0A%0D%0ALoving the site so far, but%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D------------------------------------%0ADebugger Details%0A------------------------------------%0D%0AURL: http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . "%0D%0AUser Agent: " . $_SERVER['HTTP_USER_AGENT'];
}


function is_student() {
	global $user;
	$group = get_user_meta( $user->ID, 'group', true );
	return "staff" !== $group;
}

function socd_is_staff( $user_id ) {
	return 'staff' == get_user_meta( $user_id, 'group', true );
}

function socd_register_link() {
	$site = get_current_site();

	echo '//' . $site->domain . '/register';
}