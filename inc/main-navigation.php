<?php 
	function socd_get_navigation_data(){
		if ( !function_exists('switch_to_blog') ) return false;
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
			$item_data = array(
				'url' => $item->url,
				'title' => $item->title,
				'tokens' => explode( ',', $item->description )
			);
			if( $group ){
				$data[ $group ][] = $item_data;
			} else {
				$data[ 'other' ][] = $item_data;
			}
		}

		restore_current_blog();

		return $data;
	}	

	function socd_navigation_ajax(){
		header( 'Content-Type: text/json' );
		echo socd_get_navigation_data();
	}

	add_action( 'wp_ajax_socd_navigation_data', 'socd_navigation_ajax' );
?>