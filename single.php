<?php
/**
 * 
 * @package SOCD
 */

get_header();
	if( get_post_type() == 'gallery' ){
		get_template_part( 'templates/gallery/gallery' );	
	} else {
		get_template_part( 'templates/post/single' );
	}
get_footer(); 

?>