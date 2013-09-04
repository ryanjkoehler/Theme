<?php 
/**
 * Handles our Administration
 * 
 * @package  socd
 */

function socd_get_navigation_data(){
	if ( !function_exists('switch_to_blog') ) return false;

	if ( false === ( $data = get_site_transient( 'site__socd_typeahead_data' ) ) || false ) {
		switch_to_blog( 1 );

		$data = array();

		$all_menus = get_nav_menu_locations();
		$menu_id = $all_menus['socd_network_menu'];

		if( ! is_nav_menu( $menu_id ) ) return json_encode(array());

		$menu = wp_get_nav_menu_object( $menu_id );
		$mnu_items = array();
		if( $menu && ! is_wp_error( $menu ) && !isset( $menu_items ) ){
			$menu_items = wp_get_nav_menu_items( $menu );
		}

		foreach( $menu_items as $item ){
			$group = $item->attr_title;
			$tokens = explode( ',', $item->description );
			$clean_tokens = array();
			foreach( $tokens as $token ){
				$clean_tokens[] = trim( $token );
			}
			$clean_tokens[] = trim( strtolower( $item->title ) );
			$item_data = array(
				'url' => $item->url,
				'title' => $item->title,
				'tokens' => $clean_tokens
			);
			if( $group ){
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

function get_socd_site_menu() {
	//just so we've got something coming out
	$current_site_id = get_current_site()->id;

	if ( false === ( $output = json_decode( get_site_transient( 'site__socd_site_' . $current_site_id . '_menu_raw' ) ) ) || true ) {
		switch_to_blog( $current_site_id );
	
		$menu_id = socd_get_menu_id_by_location( 'socd_site_menu' );

		$output = wp_get_nav_menu_items( $menu_id );

		restore_current_blog();

		set_site_transient( 'site__socd_site_' . $current_site_id . '_menu_raw' , json_encode( $output ), 1 * HOUR_IN_SECONDS );
	}

	return $output;
}

function socd_site_menu() {
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

function get_socd_blog_menu(){
	//just so we've got something coming out
	$menu_id = socd_get_menu_id_by_location( 'socd_site_menu' );
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

	socd_reorder_admin_bar();

	$wp_admin_bar->remove_menu( 'debug-bar' );
	$wp_admin_bar->remove_menu( 'wp-logo' );
	$wp_admin_bar->remove_menu( 'updates' );
	$wp_admin_bar->remove_menu( 'site-name' );
}

function socd_nav_menu_into_admin_bar( $id, $title, $menu_object ) {
	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array(
		'href'   => get_bloginfo( 'wpurl' ),
		'parent' => false,
		'id'	 => $id,
		'title'  => $title
	) );

	if (!$menu_object) return;

	foreach ( $menu_object as $menu_item ) {
		$wp_admin_bar->add_node( array(
			'id' => 'socd-menu-' . $menu_item->ID,
			'parent' => $menu_item->menu_item_parent > 0 ? 'socd-menu-' . $menu_item->menu_item_parent : $id,
			'title' => $menu_item->title,
			'href' => $menu_item->url
		) );
	}
}

function socd_add_custom_menus() {
	$menu = get_socd_network_menu();
	socd_nav_menu_into_admin_bar( 'socd-menu-network', __( 'SOCD.io', 'socd' ), $menu );

	$menu = get_socd_site_menu();
	socd_nav_menu_into_admin_bar( 'socd-menu-site', socd_menu_course_title(), $menu );
}

function socd_reorder_admin_bar() {
	global $wp_admin_bar;

	socd_add_custom_menus();

	// Elements to Move around
	$nodes = array(
		'socd-menu-network',
		'socd-menu-site',
		'site-name',
		'search',
		'edit',
		'new-content',
		'comments',
		'my-account',
		'my-sites'
		//'user-info',
	);

	foreach ( $nodes as $node ) {
		$temp = $wp_admin_bar->get_node( $node );
		$wp_admin_bar->remove_menu( $node );
		$temp->parent = false;
		$wp_admin_bar->add_node( $temp );
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

}

add_action( 'wp_before_admin_bar_render', 'socd_alter_admin_bar' );

function socd_after_admin_bar() {
	?>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/javascript/main-navigation.js'; ?>"></script>
<?php 
}

add_action( 'wp_after_admin_bar_render', 'socd_after_admin_bar' );