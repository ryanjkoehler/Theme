<?php 
/**
 * Handles the Navigation bar
 * 
 * @package  socd
 */

function socd_get_navigation_data() {
	if ( !function_exists('switch_to_blog') ) return false;
	
	if ( false === ( $data = get_site_transient( 'site__socd_typeahead_data' ) ) || false ) {
		switch_to_blog( 1 );
		
		$data = array();
		
		$all_menus = get_nav_menu_locations();
		$menu_id = isset( $all_menus['socd_network_menu'] ) ? $all_menus['socd_network_menu'] : false;
		
		if ( ! is_nav_menu( $menu_id ) ) return json_encode( array() );
		
		$menu = wp_get_nav_menu_object( $menu_id );

		if ( $menu && ! is_wp_error( $menu ) && !isset( $menu_items ) ){
			$menu_items = wp_get_nav_menu_items( $menu );
		}
		
		foreach ( $menu_items as $item ) {
			$group = $item->attr_title;
			$tokens = explode( ',', $item->description );
			$clean_tokens = array();
			foreach ( $tokens as $token ){
				$clean_tokens[] = trim( $token );
			}
			$clean_tokens[] = trim( strtolower( $item->title ) );
			$item_data = array(
				'url' => $item->url,
				'title' => $item->title,
				'tokens' => $clean_tokens
			);
			if ( $group ){
				$data[ $group ][] = $item_data;
			} else {
				$data[ 'other' ][] = $item_data;
			}
		}
		
		restore_current_blog();
		set_site_transient( 'site__socd_typeahead_data', $data, 1 * HOUR_IN_SECONDS );
	}

	return $data;
}

function socd_clear_transient() {
	delete_site_transient( 'site__socd_typeahead_data' );
}
add_action( 'wp_update_nav_menu', 'socd_clear_transient' );

/**
 *  Network/Site wide Menus
 * 
 */

function socd_get_menu_id_by_location( $location_slug ) {
	$locations = get_nav_menu_locations();
	return isset( $locations[ $location_slug ] ) ? $locations[ $location_slug ] : false;
}

function get_socd_network_menu() {
	if ( !function_exists('switch_to_blog') ) return false;

	if ( false === ( $output = json_decode( get_site_transient( 'site__socd_menu_raw' ) ) ) || true ) {
		switch_to_blog( 1 );

		$menu_id = socd_get_menu_id_by_location('socd_network_menu');

		$output = wp_get_nav_menu_items( $menu_id );

		restore_current_blog();
		set_site_transient( 'site__socd_menu_raw', json_encode( $output ), 1 * HOUR_IN_SECONDS );
	}

	return $output;
}

/**
 * Network wide navigation menu, this is controlled via the primary Network Appearance > Menus
 * @return [type] [description]
 */
function socd_network_menu() {
	if ( !function_exists('switch_to_blog') ) return false;

	if ( false === ( $output = get_site_transient( 'site__socd_menu' ) ) || true ) {
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

function get_socd_site_menu() {
	global $current_site, $blog_id;

	if ( false == ( $output = json_decode( get_site_transient( 'site__socd_site_' . $current_site->blog_id . '_menu_raw' ) ) ) || true ) {
		
		if ( ! is_network() ) switch_to_blog( $current_site->blog_id );
		
		$menu_id = socd_get_menu_id_by_location( 'socd_site_menu' );

		$output = wp_get_nav_menu_items( $menu_id );

		if ( ! is_network() ) restore_current_blog();

		set_site_transient( 'site__socd_site_' . $current_site->blog_id . '_menu_raw' , json_encode( $output ), 1 * HOUR_IN_SECONDS );
	}

	return $output;
}

function socd_site_menu() {
	global $current_site, $blog_id;

	if ( false === ( $output = get_site_transient( 'site__socd_site_' . $current_site->id . '_menu' ) ) || true ) {
		
		if ( ! is_network() ) switch_to_blog( $current_site->id );

		$output = wp_nav_menu( array(
			'theme_location' => 'socd_site_menu',
			'container' 	 => '',
			'menu_class' 	 => 'drop',
			'echo'		 	 => false
		) );

		if ( ! is_network() ) restore_current_blog();

		set_site_transient( 'site__socd_site_' . $current_site->id . '_menu' , $output, 1 * HOUR_IN_SECONDS );
	}

	echo $output;
}

function get_socd_blog_menu(){
	//just so we've got something coming out
	$menu_id = socd_get_menu_id_by_location( 'socd_blog_menu' );

	return wp_get_nav_menu_items( $menu_id );
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


/**
 * 
 * WordPress Admin Bar re-ordering
 * 
 */

function socd_alter_admin_bar( ) {
	global $wp_admin_bar;

	if ( is_admin() ) return;

	socd_reorder_admin_bar();

	$wp_admin_bar->remove_menu( 'wp-logo' );
	$wp_admin_bar->remove_menu( 'updates' );
	$wp_admin_bar->remove_menu( 'site-name' );
	$wp_admin_bar->remove_menu( 'comments' );
}

function socd_nav_menu_into_admin_bar( $id, $title, $href = '#', $menu_object = false ) {
	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array(
		'href'   => $href,
		'parent' => false,
		'id'	 => $id,
		'title'  => $title
	) );

	if ( ! $menu_object ) return;

	foreach ( $menu_object as $menu_item ) {
		$wp_admin_bar->add_node( array(
			'id' => 'socd-menu-' . $menu_item->ID,
			'parent' => $menu_item->menu_item_parent > 0 ? 'socd-menu-' . $menu_item->menu_item_parent : $id,
			'title' => $menu_item->title,
			'href' => $menu_item->url
		) );
	}
	add_action( 'wp_update_nav_menu', 'socd_clear_transient' );
}

function socd_add_custom_menus() {
	global $current_site;

	$menu = get_socd_network_menu();
	socd_nav_menu_into_admin_bar( 'socd-menu-network', __( 'SOCD.io', 'socd' ), 'http://socd.io/', $menu );

	if ( ! is_network() ) {
		$blog_menu = get_socd_blog_menu();
		$name = ( strlen( get_bloginfo( 'name' ) ) > 10 ) ? substr( get_bloginfo( 'name' ), 0, 7 ) . '&hellip;' : get_bloginfo( 'name' );
		socd_nav_menu_into_admin_bar( 'socd-menu-blog',  $name , '#', $blog_menu );
	}
	
	if ( $current_site->blog_id > 1 ) {
		$course_menu = get_socd_site_menu();
		socd_nav_menu_into_admin_bar( 'socd-menu-site', get_network_name(), get_bloginfo( 'wpurl' ), $course_menu );
	}
	
	if ( ( is_page() || is_single() ) && !is_front_page() ){
		$name = ( strlen( socd_menu_page_title() ) > 10 ) ? substr( socd_menu_page_title(), 0, 7 ) . '&hellip;' : socd_menu_page_title();
		socd_nav_menu_into_admin_bar( 'socd-menu-current', $name, '#' );
	}
}

function socd_reorder_admin_bar() {
	global $wp_admin_bar;

	socd_add_custom_menus();

	// Elements to Move around
	$nodes = array(
		array(
			'id' 	=> 'socd-menu-network',
			'class' => ''
		),
		array(
			'id' 	=> 'socd-menu-site',
			'class' => 'navigation--breadcrumb'
		),
		array(
			'id' 	=> 'socd-menu-blog',
			'class' => 'navigation--breadcrumb'
		),
		array(
			'id' 	=> 'socd-menu-current',
			'class' => 'navigation--breadcrumb'
		),
		array(
			'id' 	=> 'site-name',
			'class' => 'navigation--breadcrumb'
		),
		array(
			'id' 	=> 'search',
			'class' => ''
		),
		array(
			'id' 	=> 'edit',
			'class' => ''
		),
		array(
			'id' 	=> 'new-content',
			'class' => ''
		),
		array(
			'id' 	=> 'my-account',
			'class' => ''
		),
		array(
			'id' 	=> 'my-sites',
			'class' => ''
		),
	);

	
	foreach ( $nodes as $node ) {
		$temp = $wp_admin_bar->get_node( $node['id'] );
		$wp_admin_bar->remove_menu( $node['id'] );
		
		$temp->meta = array(
			'class' => $node['class']
		);

		if ( !is_admin() ) $temp->parent = false;
		
		$wp_admin_bar->add_node( apply_filters( 'socd_alter_admin_bar', $temp ) );
	}

	// Take contents of 'site-name' and append to 'socd-menu-site'
	// 
	$nodes = $wp_admin_bar->get_nodes();

	foreach ( $nodes as $node ) {
		if ( in_array(  $node->parent, array( "site-name", "appearance" ) ) ) {

			$wp_admin_bar->add_node( array(
				'id' => 'socd-' . $node->id,
				'parent' => 'socd-menu-site',
				'title' => $node->title,
				'href' => $node->href
			) );
		}
	}

	$wp_admin_bar->remove_node( 'user-info' );
}

add_action( 'wp_before_admin_bar_render', 'socd_alter_admin_bar' );

function socd_alter_admin_bar_nodes( $node ) {
	if ( ! isset( $node->id ) ) return $node;

	if ( $node->id === "search" && isset( $node->title ) ) {
		$node->title = preg_replace( '/text"/', 'search" placeholder="Search"', $node->title );
	}

	if ( $node->id === "my-account" ) {
		$node->title = preg_replace( '/Howdy,/', __( '', 'socd' ), $node->title );
	}

	if ( $node->id === "edit" ) {
		$node->title = 'Edit';
	}

	return $node;
}
add_filter( 'socd_alter_admin_bar', 'socd_alter_admin_bar_nodes' );



function socd_after_admin_bar() {
	if( !is_admin() ){
		printf('<script src="%1$s"></script>',
			get_stylesheet_directory_uri() . '/assets/javascript/main-navigation.js'
		);
	}
}

add_action( 'wp_after_admin_bar_render', 'socd_after_admin_bar' );
