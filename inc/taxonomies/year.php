<?php

function year_init() {
	register_taxonomy( 'year', array( 'post' ), array(
		'hierarchical'            => true,
		'public'                  => true,
		'show_in_nav_menus'       => true,
		'show_ui'                 => true,
		'query_var'               => true,
		'rewrite'                 => true,
		'capabilities'            => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts'
		),
		'labels'                  => array(
			'name'                       =>  __( 'Years', 'socd' ),
			'singular_name'              =>  __( 'Year', 'socd' ),
			'search_items'               =>  __( 'Search years', 'socd' ),
			'popular_items'              =>  __( 'Popular years', 'socd' ),
			'all_items'                  =>  __( 'All years', 'socd' ),
			'parent_item'                =>  __( 'Parent year', 'socd' ),
			'parent_item_colon'          =>  __( 'Parent year:', 'socd' ),
			'edit_item'                  =>  __( 'Edit year', 'socd' ),
			'update_item'                =>  __( 'Update year', 'socd' ),
			'add_new_item'               =>  __( 'New year', 'socd' ),
			'new_item_name'              =>  __( 'New year', 'socd' ),
			'separate_items_with_commas' =>  __( 'Years separated by comma', 'socd' ),
			'add_or_remove_items'        =>  __( 'Add or remove years', 'socd' ),
			'choose_from_most_used'      =>  __( 'Choose from the most used years', 'socd' ),
			'menu_name'                  =>  __( 'Years', 'socd' ),
		),
	) );

}
add_action( 'init', 'year_init' );
