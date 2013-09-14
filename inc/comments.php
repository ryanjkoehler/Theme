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


//////////////////////////////////////////////////////////////////////////////////////////////
// COMMENT IMAGE UPLOAD //////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Enqueue script and adding localisation
 */
function socd_ci_enqueue_scripts() {
	if ( ! is_admin() ) {		
		// Include javascript
		wp_enqueue_script( 'socd_ci', get_stylesheet_directory_uri() . '/assets/javascript/comment_upload.js', array( 'jquery' ), false, true );
	
		// Send important values to client browser
		wp_localize_script( 'socd_ci', 'SOCD_CI_CONFIG', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'upload_nonce' => wp_create_nonce( 'socd_upload' ),
			'delete_nonce' => wp_create_nonce( 'socd_delete' )
		) );
	}
}
add_action( 'wp_enqueue_scripts', 'socd_ci_enqueue_scripts' );

/**
 * AJAX Endpoint for Comment Image Uploading
 */
function socd_ci_ajax_upload() {
	if ( ! empty( $_POST['upload_nonce'] ) && wp_verify_nonce( $_POST['upload_nonce'], 'socd_upload' ) && ! empty( $_POST['post_id'] ) && ! empty( $_POST['comment_id'] ) && ! empty( $_FILES['image'] ) ) {
		$output = array();
		
		$post_id = absint( $_POST['post_id'] );
		$comment_id = absint( $_POST['comment_id'] );
		$file = $_FILES['image'];
		
		// If user can upload to this comment
		if ( is_user_logged_in() && comments_open( $post_id ) && get_comment( $comment_id )->user_id == get_current_user_id() ) {
			header( 'Content-Type: text/json' );
			
			// Check comment has no image attached
			if ( ! get_comment_meta( $comment_id, 'image', true ) ) {
				
				// Include WordPress file handling
				require_once( ABSPATH . "wp-admin" . '/includes/file.php' );
				
				$overrides = array( 'test_form' => false );
				$uploaded_file = wp_handle_upload( $file, $overrides );
				
				// If the file was uploaded, then save the details
				if ( isset( $uploaded_file['file'] ) ) {
					$wp_upload_dir = wp_upload_dir();
					
					// Generate attachment meta data
					$attachment = array(
						'post_mime_type' => $file['type'],
						'post_title' => addslashes( $file['name'] ),
						'post_content' => '',
						'guid' => $wp_upload_dir['url'] . '/' . basename( $uploaded_file['file'] ),
						'post_status' => 'inherit',
					);
					
					// Add attachment to database, and generate thumbnails
					$attach_id = wp_insert_attachment( $attachment, $uploaded_file['file'], absint( $_POST['post_id'] ) );
					$attach_data = wp_generate_attachment_metadata( $attach_id, $uploaded_file['file'] );
					wp_update_attachment_metadata( $attach_id, $attach_data );
					
					// Store attachment ID
					update_comment_meta( $comment_id, 'image', $attach_id );
					
					// Ouput image URL
					$output['url'] = $wp_upload_dir['url'] . '/' . basename( $uploaded_file['file'] );
					
					// Output the result of the upload
					echo json_encode( $output );
					
					// Exit before the echo zero
					exit;
				}
			}
		}
	}
}
add_action( 'wp_ajax_socd_upload', 'socd_ci_ajax_upload' );

/**
 * AJAX Endpoint for Comment Image Deleting
 */
function socd_ci_ajax_delete() {
	if ( ! empty( $_POST['delete_nonce'] ) && wp_verify_nonce( $_POST['delete_nonce'], 'socd_delete' ) && ! empty( $_POST['post_id'] ) && ! empty( $_POST['comment_id'] ) ) {
		$output = array();
		
		$post_id = absint( $_POST['post_id'] );
		$comment_id = absint( $_POST['comment_id'] );
		
		// If user can upload to this comment
		if ( is_user_logged_in() && ( ( comments_open( $post_id ) && get_comment( $comment_id )->user_id == get_current_user_id() ) || current_user_can( 'moderate_comments' ) ) ) {
			header( 'Content-Type: text/json' );
			
			// Get attachment ID
			$attach_id = get_comment_meta( $comment_id, 'image', true );
			
			// If there is an attachment ID proceed
			if ( ! empty( $attach_id ) ) {
				
				// Delete Attachment, immediately
				wp_delete_attachment( $attach_id, true );
				
				// Delete comment meta
				delete_comment_meta( $comment_id, 'image' );
				
				// Ouput where result
				$output['deleted'] = true;
				
				// Output the result of the posting
				echo json_encode( $output );
				
				// Exit before the echo zero
				exit;
			}
		}
	}
}
add_action( 'wp_ajax_socd_delete', 'socd_ci_ajax_delete' );
