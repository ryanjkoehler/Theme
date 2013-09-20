<?php 
/**
 * Enqueues all of the theme's assets, this
 * allows for cache busting via Grunt task
 * 
 * @package  socd
 */

function socd_css_assets() {

	global $blog_id, $wp_styles;

	/**
	 * Styles
	 */
	
	if ( preg_match('/\.loc/', get_bloginfo('wpurl') ) ) {
		wp_enqueue_style( 'socd_base', get_stylesheet_directory_uri() . '/assets/screen.css' );
		wp_register_style( 'socd_ie', get_stylesheet_directory_uri() . '/assets/ie.css' );

	} else {
		$screen_css = "dist/975caee4043c117d826fcf837cfcc80f.css";
		wp_enqueue_style( 'socd_base', get_stylesheet_directory_uri() . '/assets/' . $screen_css );
		$ie_css = "dist/381af6d1948fa0c2aba16c972624c14f.css";
		wp_register_style( 'socd_ie', get_stylesheet_directory_uri() . '/assets/' . $ie_css );
	}

	$wp_styles->add_data( 'socd_ie', 'conditional', 'IE' );
	wp_enqueue_style( 'socd_ie' );

	if ( ! is_admin() )
		wp_deregister_style( 'admin-bar' );


}

add_action('wp_enqueue_scripts', 'socd_css_assets' );

/**
 * Load in the scripts and styles
 */
function socd_javascript_assets () {

	/**
	 * Scripts
	 */
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_stylesheet_directory_uri(). '/assets/javascript/libs/jquery-1.9.1.min.js', false, false, true );
	
	wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/assets/javascript/libs/modernizr.js', null, false, false );
	wp_enqueue_script( 'fitvids', get_stylesheet_directory_uri() . '/assets/javascript/libs/jquery.fitvids.js', array( 'jquery' ), false, false );

	// Tested Code
	wp_enqueue_script( 'socd', get_stylesheet_directory_uri() . '/assets/javascript/socd.js', false, false, true );
	wp_enqueue_script( 'socd_viewport', get_stylesheet_directory_uri() . '/assets/javascript/viewport.js', false, false, true );

	// Untested Code
	wp_enqueue_script( 'socd_inline_attach', get_stylesheet_directory_uri() . '/assets/javascript/libs/jquery.inline-attach.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'socd_hogan', get_stylesheet_directory_uri() . '/assets/javascript/libs/hogan.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'socd_hogan_templates', get_stylesheet_directory_uri() . '/assets/javascript/socd-hogan-templates.js', array( 'socd_hogan' ), false, true );
	wp_enqueue_script( 'socd_typeahead', get_stylesheet_directory_uri() . '/assets/javascript/libs/typeahead.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'socd_states', get_stylesheet_directory_uri() . '/assets/javascript/states.js', array( 'jquery'  ), false, true );	
	wp_enqueue_script( 'socd_notification_center', get_stylesheet_directory_uri() . '/assets/javascript/notification-center.js', array( 'jquery', 'socd_hogan', 'socd_hogan_templates' ), false, true );
	wp_enqueue_script( 'socd_comments', get_stylesheet_directory_uri() . '/assets/javascript/comments.js', array( 'jquery', 'socd_inline_attach'  ), false, true );
	wp_enqueue_script( 'socd_listing_filters', get_stylesheet_directory_uri() . '/assets/javascript/listing-filter.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'socd_blog_filters', get_stylesheet_directory_uri() . '/assets/javascript/blog-filter.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'socd_search_form', get_stylesheet_directory_uri() . '/assets/javascript/search-form.js', array( 'jquery' ), false, true );	

	if ( ! is_admin_bar_showing() ) {
		wp_enqueue_script( 'socd_main_navigation', get_stylesheet_directory_uri() . '/assets/javascript/main-navigation.js', array( 'jquery', 'socd_typeahead', 'socd_states', 'socd_hogan', 'socd_hogan_templates', 'socd_search_form', 'modernizr' ), false, true );
	}

	wp_enqueue_script( 'socd_main', get_stylesheet_directory_uri() . '/assets/javascript/main.js', array( 'jquery', 'modernizr', 'fitvids', 'socd', 'socd_viewport', 'socd_inline_attach', 'socd_hogan', 'socd_hogan_templates', 'socd_typeahead', 'socd_states', 'socd_notification_center', 'socd_comments', 'socd_listing_filters', 'socd_blog_filters', 'socd_search_form' ), false, true );

	// Only used in the registration form
	// 
	wp_enqueue_script( 'socd_register', get_stylesheet_directory_uri() . '/assets/javascript/register.js', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'socd_javascript_assets' );

function socd_javascript_config() {

	global $blog_id;

	$config = array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'typeahead_local' => socd_get_navigation_data(),
		'current_site' => get_network_name(),
		'site_root_url' => get_bloginfo( 'wpurl' ),
		'sites' => socd_network_names_by_domain()
	);

	if (is_front_page() && $blog_id == 1 ) {
		global $post;

		$locations = get_field('locations', $post->ID );

		if ( is_array( $locations ) ) {
			$temp = array();

			for ($i=0; $i < count( $locations ); $i++) { 
				$location = $locations[ $i ];

				$temp = array_merge( $location, array(
					'html' => socd_get_vcard( $location )
				) );

				$locations[$i] = $temp;
			}


		} else {
			$locations = array();
		}

		$config = array_merge( $config, array(
			'places' => $locations,
			'center' => get_field( 'center_point', $post->ID )
		) );
	}

	wp_localize_script( 'socd', 'SOCD', array(
		'Config' => $config
	) );
}
add_action( 'wp_enqueue_scripts', 'socd_javascript_config' );
