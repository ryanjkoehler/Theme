<?php 
/**
 * Handles functions tied to the Commenting
 * 
 * 
 * @package socd
 */

function socd_comment_images( ){
	
}

function socd_comment( $comment, $args, $depth ) {
	// these need to be defined in order that our template part has 
	// access to the necessary arguments to function
	$GLOBALS['comment'] = $comment;
	$GLOBALS['depth'] = $depth;
	$GLOBALS['args'] = $args;
	
	socd_template_part( 'comments', 'comment' );
}	

function socd_comment_end() {
	echo "</ol>";
}