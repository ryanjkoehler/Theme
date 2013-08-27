<?php 
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
?>