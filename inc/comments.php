<?php 
/**
 * Handles functions tied to the Commenting
 * 
 * 
 * @package socd
 */

if ( !function_exists('socd_comment_images') ) {

	function socd_comment_images( ){
		
	}
}

if ( !function_exists('socd_comment') ) {
	
	function socd_comment($comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		socd_template( 'comments', 'comment' );
	}	
}
