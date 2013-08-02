<?php 
/**
 * Handles functions tied to the Commenting
 * 
 * 
 * @package socd
 */

function socd_comment_images( ){
	

}

function socd_comment($comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	include( get_stylesheet_directory() . '/partials/comments/comment.php' );
}