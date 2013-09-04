<?php

/*
	Functionality for post filters (in sidebar on noticeboard)
	Includes 
		- listing of filterable options
		- ajax hook to query
*/

function socd_filter_post_formats(){
	$output = array();
	$post_formats =  get_theme_support( 'post-formats' );
	$post_formats = $post_formats[0];
	foreach ($post_formats as $format ): 
		$output[] = sprintf( '<li class="post-format__%1$s" ><a href="#%1$s" data-type="post-format">%1$s</a></li>', $format );
	endforeach;
	echo implode( ' ', $output );
}

// ajax

function socd_filter_post_query( $args ){
	$posts_filter_query = new WP_Query( $args );
	$output = array();
	if( $posts_filter_query->have_posts() ): 
		$output['count'] = $posts_filter_query->found_posts;
		ob_start();
		while( $posts_filter_query->have_posts() ):
			$posts_filter_query->the_post();
			get_template_part( 'templates/post/post');
		endwhile;
		$output['posts'] = ob_get_contents();
		ob_end_clean();
	endif;

	return $output;
}

function socd_filter_post_ajax() {
	$available_formats = get_theme_support( 'post-formats' );
	$available_formats = $available_formats[0]; //is a nested array...
	$args = array(
		'numberposts' => 5
	);

	if( empty( $_POST['post_format'] ) && empty( $_POST['post_type'] ) ){
		return;
	}
		
	if( ! empty( $_POST[ 'post_format' ] ) ){
		if( !in_array( $_POST[ 'post_format' ], $available_formats ) ){
			return;
		} 
		$args['tax_query'] = array(
			array( 
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array( 'post-format-' . $_POST[ 'post_format' ] )
			)
		);
	}

	if( ! empty( $_POST[ 'post_type' ] ) ){
		$args['post_type'] = $_POST[ 'post_type' ];
	}
	
	$args['offset'] = ( ! empty( $_POST['filter_offset'] ) ) ? $_POST['filter_offset'] : 0;

	$output = socd_filter_post_query( $args );

	echo json_encode( $output );

	exit; //exit before we echo 0
}

add_action( 'wp_ajax_socd_post_filter', 'socd_filter_post_ajax' );

?>