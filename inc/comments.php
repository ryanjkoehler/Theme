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
	$GLOBALS['comment'] = $comment;
	$GLOBALS['depth'] = $depth;
	$GLOBALS['args'] = $args;
	socd_template_part( 'comments', 'comment' );
}	

function socd_comment_end() {
	echo "</ol>";
}