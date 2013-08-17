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
	socd_template_part( 'comments', 'comment' );
}	

function socd_comment_end() {
	echo '</ol>';
}