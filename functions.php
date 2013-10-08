<?php 

/**
 * Functions file, imports
 * and sets up all the dependencies
 * for the theme.
 * 
 * @package SOCD
 */
require( get_stylesheet_directory() . '/inc/templates.php' );

add_image_size( 'gdnm-size-1', 650, 650, false );
add_image_size( 'gdnm-size-2', 560, 560, false );

/**
 * 
 * @since  1.0.1
 */
function socd_is_registration_disabled() {
	global $current_site;
	$active_signup = apply_filters( 'wpmu_active_signup', get_site_option( 'registration' ) );
	return ( $current_site->id === 1 && $active_signup === "none" );
}

/**
 * 
 * @since  1.0.1
 */
function socd_registration_disabled() {
	if ( socd_is_registration_disabled() ) {
		socd_template_part( 'signup', 'registration-disabled' );
	}
}
add_action( 'after_signup_form', 'socd_registration_disabled' );

/**
 * Basic setup
 */
function socd_setup() {
	require( get_stylesheet_directory() . '/inc/admin.php' );
	require( get_stylesheet_directory() . '/inc/assets.php' );
	require( get_stylesheet_directory() . '/inc/customizer.php' );
	require( get_stylesheet_directory() . '/inc/extras.php' );
	require( get_stylesheet_directory() . '/inc/filters.php' );	
	require( get_stylesheet_directory() . '/inc/template-tags.php' );
	require( get_stylesheet_directory() . '/inc/blog-filter.php' );
	require( get_stylesheet_directory() . '/inc/main-navigation.php' );
	require( get_stylesheet_directory() . '/inc/quickpost.php' );
	//acf
	require( get_stylesheet_directory() . '/inc/fields/about-course.php' );
}
add_action( 'init', 'socd_setup' );

/**
 * Add theme post thumbnail support
 */
function socd_after_theme_setup() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'image', 'video', 'link', 'quote' ) );
}
add_action( 'after_setup_theme', 'socd_after_theme_setup' );

/**
 * Manually hook in the webink stylesheet as it uses some characters '&' that 
 * get escaped by the 'wp_enqueue_style'
 */
function socd_webink() {
	
	?><link rel="stylesheet" href="http://fnt.webink.com/wfs/webink.css/?project=02A1E400-855B-411C-A4F5-7EC50DAC8A77&fonts=602BD939-0B36-207C-56E5-E3E6434C3273:f=Theinhardt-HairlineIta,BF522E13-B921-2C59-5FD3-9D3C689FC32B:f=Theinhardt-LightIta,864889ED-8E73-7E19-00E2-BBE0F997E58C:f=Theinhardt-Thin,2A04CF10-789B-A5BB-9721-E19ACED96EEB:f=Theinhardt-Black,8B459781-89CC-B7EA-6A87-7EC561303F45:f=Theinhardt-BoldIta,82DA4627-8191-9CE4-706C-58F3C2615A95:f=Theinhardt-Bold,BFE4A44E-8D1D-66D8-BBF8-42F52771F0D3:f=Theinhardt-ThinIta,DC84A178-A66C-DB8D-5140-7E5BF64AB28F:f=Theinhardt-RegularIta,F77BBDE3-5270-5846-90AD-5529C2FFDA57:f=Theinhardt-Medium,008579D7-00D8-1E34-1306-843EC6BC82EA:f=Theinhardt-Light,70F8A7D9-BDFF-D029-E465-E7FC928A5994:f=Theinhardt-MediumIta,9773ABFB-EF93-0C1B-AE14-35A7DD420754:f=Theinhardt-UltraLight,BA766C3D-9F83-4950-AFCD-AD9F2BF5CEAB:f=Theinhardt-Regular"/><?php 
}
add_action( 'wp_head', 'socd_webink' );

/**
 * Removes WP Admin bar
 */
function remove_admin_bar_styling() {
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
	remove_action( 'wp_head', 'wp_admin_bar_header' );
}
add_action( 'wp_head', 'remove_admin_bar_styling', 1 );

/**
 * Register our sidebars and widetized areas
 * 
 */
function socd_widets_init() {
	register_sidebar( array(
		'name' => 'Left Sidebar',
		'id'   => 'left_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget--title">',
		'after_title'  => '</h2>'
	) );	
	register_sidebar( array(
		'name' => 'Right Sidebar',
		'id'   => 'blog_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget--title">',
		'after_title'  => '</h2>'
	) );
}
add_action( 'widgets_init', 'socd_widets_init' );

/**
 * Remove widgets we deem useless
 */
function socd_unregister_widgets(){
	// Default WP widgets
	unregister_widget( 'WP_Widget_Search' );
	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
	// Plugin Widgets
	unregister_widget( 'Akismet_Widget' ); //note: uses the name of the Class, not the string name/id of the widget
	// wpengine widget does not extend WP_Widget, is registered as
	// a sidebar widget so we have to do this. 
	// (the argument - ID is the first arg passed to register_sidebar_widget() )
	wp_unregister_sidebar_widget( 'wpe_widget_powered_by' );
}

add_action( 'widgets_init', 'socd_unregister_widgets' );

function socd_default_widgets(){
	$id = rand( 20, 100 );

 	$categories_args = array(
		 $id => array(
			'title' => '',
			'count'	=> 0,
			'hierarchical' => 0,
			'dropdown'	=> 0
		),
		 '_multiwidget' => true
	);
 	
 	$widgets_args = array( 
 		'left_sidebar' => array(
 			'categories-' . $id
 		)
 	);

 	update_option( 'widget_categories', $categories_args );
 	update_option( 'sidebars_widgets', $widgets_args );
}

add_action( 'after_switch_theme', 'socd_default_widgets' );

/**
 * Create various menus
 */
function socd_menus() {
	global $current_blog;
	if ( is_main_site() && 1 == $current_blog->blog_id ) {
		register_nav_menus( array( 
			'socd_network_menu' => 'Network Menu',
			'socd_network_footer' => 'Network Footer'
		) );

	} elseif ( is_network() ){
		register_nav_menus( array(
			'socd_site_menu' => 'Site Menu'
		) );
	} else {
		register_nav_menus( array(
			'socd_blog_menu' => 'Menu'
		) );
	}
}
add_action( 'init', 'socd_menus' );

/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 *
 * @return void
 */
function socd_paging_nav() {
	global $current_blog, $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation stream--paging" role="navigation">
		<h1 class="h-screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">
			<?php
			
			if ( $prev = get_previous_posts_link( _( '&uarr; Newer' ) ) )
				echo preg_replace( '/(http:\/\/)socd\.(io|loc)/', '$1' . $current_blog->domain, $prev );

			if ( $next = get_next_posts_link( __( '&darr; Older' ) ) )
				echo preg_replace( '/(http:\/\/)socd\.(io|loc)/', '$1' . $current_blog->domain, $next );

			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}



/**
 * AJAX Endpoint for getting Taxonomy Terms
 */
function socd_qp_ajax_tax() {
	if ( ! empty( $_POST['tax_nonce'] ) && wp_verify_nonce( $_POST['tax_nonce'], 'socd_tax' ) ) {
		
		$output = array();
		
		// Switch to correct blog
		if ( ! empty( $_POST['blog_id'] ) && switch_to_blog( absint( $_POST['blog_id'] ), true ) ) {
			
			// Check user can post to current blog
			if ( current_user_can( 'publish_posts' ) ) {
				
				// Return JSON Header
				header( 'Content-Type: text/json' );
				
				// Make a list of taxonomies to get the terms for
				$taxonomies = array( 'post_tag', 'category' );
				
				// Course Taxonomy
				if ( taxonomy_exists( 'socd_year_taxonomy' ) )
					$taxonomies[] = 'socd_year_taxonomy';
					
				// For future use
				if ( taxonomy_exists( 'socd_project_taxonomy' ) )
					$taxonomies[] = 'socd_project_taxonomy';
				
				// Format a nice list of terms
				foreach ( get_terms( $taxonomies, array( 'hide_empty' => false ) ) as $term ) {
					$tidy_term['id'] = $term->term_id;
					$tidy_term['name'] = $term->name;
					$tidy_term['slug'] = $term->slug;
					$output['terms'][$term->taxonomy][] = $tidy_term;
				}
				
				// Output info about each taxonomy
				foreach ( get_taxonomies( '', 'objects' ) as $id => $tax ) {
					if ( in_array( $id, $taxonomies ) ) {
						$tidy_tax['name'] = $tax->labels->name;
						$tidy_tax['singular_name'] = $tax->labels->singular_name;
						$output['taxes'][$id] = $tidy_tax;
					}
				}
				
				// Output the result
				echo json_encode( $output );
				
				// Go back to the original blog
				restore_current_blog();
				
				// Exit before the echo zero
				exit;
			}
		}
	}
}
add_action( 'wp_ajax_socd_tax', 'socd_qp_ajax_tax' );

/**
 * AJAX Endpoint for getting oEmbeds
 */
function socd_qp_ajax_oembed() {
	if ( ! empty( $_POST['oembed_nonce'] ) && wp_verify_nonce( $_POST['oembed_nonce'], 'socd_oembed' ) ) {
		
		$output = array();
		
		// Check user is logged in
		if ( is_user_logged_in() ) {
			
			// Return JSON Header
			header( 'Content-Type: text/json' );
			
			$output['html'] = wp_oembed_get( esc_url( $_POST['url'] ) );
			
			// Output the result
			echo json_encode( $output );
			
			// Exit before the echo zero
			exit;
		}
	}
}
add_action( 'wp_ajax_socd_oembed', 'socd_qp_ajax_oembed' );


function pre( $msg ) {
	echo '<pre>';
	if ( is_array( $msg ) ) {
		foreach ( $msg as $str ) {
			var_dump( $str );
		}
	} else {
		var_dump( $msg );
	}
	echo '</pre>';
}

function dre($msg) {
	pre($msg);
	die();
}

/**
 * [socd_breaking_wpengine_aggressive_caching description]
 * @return [type] [description]
 * @since 1.0.1
 */
function socd_breaking_wpengine_aggressive_caching() {
	setcookie( 'wordpress_socd_io', 1, time() + ( 60 * 60 * 24 * 365 ), '/', '.' . $_SERVER['HTTP_HOST'] );
}
add_action( 'init', 'socd_breaking_wpengine_aggressive_caching' );
