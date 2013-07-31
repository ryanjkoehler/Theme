<?php 
/**
 * Handles functions tied to the Commenting
 * 
 * 
 * @package socd
 */

function socd_comment($comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	require_once(get_stylesheet_directory() . '/partials/comments/comment.php');
}