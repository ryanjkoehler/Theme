<?php 
/**
 * Quickpost
 * 
 * @package socd
 */

/**
 * Enqueue script and adding localisation
 */
function socd_qp_enqueue_scripts() {
	if ( ! is_admin() && is_user_logged_in() && !is_front_page() && false ) {		
		// Include javascript
		wp_enqueue_script( 'socd_qp', get_stylesheet_directory_uri() . '/assets/javascript/quickpost.js', array( 'jquery' ), false, true );
	
		// Prepare a list of user blogs
		$blogs = get_blogs_of_user( get_current_user_id() );
		$user_blogs = array();
		
		if ( count( $blogs ) > 0 )
			foreach ( $blogs as $blog )
				if ( current_user_can_for_blog( $blog->userblog_id, 'publish_posts' ) )
					$user_blogs[] = array( 'id' => $blog->userblog_id, 'title' => $blog->blogname );
		
		// Prepare a list of post formats
		$post_formats = get_theme_support( 'post-formats' );
		$post_formats = $post_formats[0];
		$post_formats[] = 'blog';
		
		// Send important values to client browser
		wp_localize_script( 'socd_qp', 'SOCD_QP_CONFIG', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'user_blogs' => $user_blogs,
			'user_primary_blog' => get_user_meta( get_current_user_id(), 'primary_blog', true ),
			'current_blog' => get_current_blog_id(),
			'qp_nonce' => wp_create_nonce( 'socd_qp' ),
			'tax_nonce' => wp_create_nonce( 'socd_tax' ),
			'oembed_nonce' => wp_create_nonce( 'socd_oembed' ),
			'post_formats' => $post_formats
		) );
	}
}
add_action( 'wp_enqueue_scripts', 'socd_qp_enqueue_scripts' );

/**
 * AJAX Endpoint for QuickPost
 */
function socd_qp_ajax_post() {
	if ( ! empty( $_POST['qp_nonce'] ) && wp_verify_nonce( $_POST['qp_nonce'], 'socd_qp' ) && ! empty( $_POST['formdata'] ) ) {
		$output = array();
		
		// Process serialised form data from jQuery
		parse_str( $_POST['formdata'], $data );
		
		// Switch to correct blog
		if ( ! empty( $data['blog_id'] ) && switch_to_blog( $data['blog_id'], true ) ) {
			
			// Check user can post to current blog
			if ( current_user_can( 'publish_posts' ) ) {
				
				header( 'Content-Type: text/json' );
				
				if ( ! empty( $data['title'] ) )
					$title = esc_html( $data['title'] );
				
				// Prepare Content
				switch ( $data['post_format'] ) {
					
					case 'blog':
						$content = wp_kses_post( $data['content'] );
					break;
					
					case 'video':
						$content = esc_url( $data['url'] ) . "\n\n" . wp_kses_post( $data['caption'] );
					break;
					
					case 'link':
						$content = wp_kses_post( $data['caption'] );
						$href = esc_url( $data['url'] );
					break;
					
					case 'quote':
						$content = '<blockquote>' . esc_html( $data['quote'] ) . '</blockquote>' . "\n" . '<cite>' . esc_html( $data['source'] ) . '</cite>' . "\n" . wp_kses_post( $data['caption'] );
					break;
					
					case 'image':
						global $content_width;
						if ( ! empty( $data['url'] ) ) {
							$image_info = getimagesize( esc_url( $data['url'] ) );
							$mimes = array( 'image/jpg', 'image/jpeg', 'image/gif', 'image/png', 'image/pjpeg' );
							if ( in_array( $image_info['mime'], $mimes ) ) {
								$target_width = $content_width;
						    	$old_width = $image_info[0];
								$old_height = $image_info[1];
								if ( $old_width > $target_width ) {
									$ratio = $old_height / $old_width;
									$new_width = $target_width;
									$new_height = $target_width * $ratio;
								} else {
									$new_width = $old_width;
									$new_height = $old_height;
								}
								$html = '<img src="' . esc_url( $data['url'] ) . '" width="' . $new_width . '" height="' . $new_height . '" />' . "\n\n";
								$content = $html . "\n\n" . wp_kses_post( $data['caption'] );
							} else if ( wp_oembed_get( esc_url( $data['url'] ) ) != '' ) {
								$content = esc_url( $data['url'] ) . "\n\n" . wp_kses_post( $data['caption'] );
							}
						}
						
						if ( empty( $content ) )
							$content = wp_kses_post( $data['caption'] );
					break;
					
					default: 
						$output['status'] = 'error';
						$output['message'] = 'Invalid posttype Specified.';
					break;
					
				}
				
				if ( empty( $title ) )
					$title = '';
				
				// If content ready
				if ( empty( $output['status'] ) ) {
					
					// Create post array
					$post = array(
					    'post_title' => $title,
						'post_name' => $title,
					    'post_content' => $content,
						'post_author' => get_current_user_id(),
						'post_date_gmt' => gmdate( 'Y-m-d H:i:s' )
					);
					
					// Insert post
					$post_id = wp_insert_post( $post );
					
					// Create a slug
					wp_update_post( array( 
						'ID' => $post_id,
						'post_name' => wp_unique_post_slug( sanitize_title_with_dashes( $title, '', 'save' ), 0, 'publish', 'post', '' )
					) );
					
					// Set post format
					$post_formats = get_theme_support( 'post-formats' );
					if ( in_array( $data['post_format'], $post_formats[0] ) )
						set_post_format( $post_id, $data['post_format'] );
					
					// Attach href
					if ( ! empty( $href ) )
						update_post_meta( $post_id, 'href', $href );
					
					// If user can upload files and there is an upload
					if ( current_user_can( 'upload_files' ) && isset( $_FILES['image'] ) ) {
						// Include WordPress file handling
						require_once( ABSPATH . "wp-admin" . '/includes/file.php' );
						$file = $_FILES['image'];
						$overrides = array( 'test_form' => false );
						$uploaded_file = wp_handle_upload( $file, $overrides );
						// If the file was uploaded attach it to the post
						if ( isset( $uploaded_file['file'] ) ) {
							// Generate attachment meta data	
							$attachment = array(
								'post_mime_type' => $file['type'],
								'post_title' => addslashes( $file['name'] ),
								'post_content' => '',
								'guid' => $wp_upload_dir['url'] . '/' . basename( $uploaded_file['file'] ),
								'post_status' => 'inherit',
							);
							// Add attachment to database
							$attach_id = wp_insert_attachment( $attachment, $uploaded_file['file'], $post_id );
							$attach_data = wp_generate_attachment_metadata( $attach_id, $uploaded_file['file'] );
							wp_update_attachment_metadata( $attach_id, $attach_data );
							// Set image as featured image
							update_post_meta( $post_id, '_thumbnail_id', $attach_id );
						}
					}
					
					// Attach tags/categories/terms
					if ( ! empty( $_POST['terms'] ) ) {
						$taxes = json_decode( $_POST['terms'] );
						foreach ( $taxes as $id => $tax ) {
							wp_set_object_terms( $post_id, $tax, $id );
						}
					}
					
					// Publish post
					wp_publish_post( $post_id );
					
					// Ouput where the post is
					$output['post_id'] = $post_id;
					$output['permalink'] = get_permalink( $post_id );
					$output['status'] = 'published';
				}
				
				// Output the result of the posting
				echo json_encode( $output );
				
				// Go back to the original blog
				restore_current_blog();
				
				// Exit before the echo zero
				exit;
			}
		}
	}
}
add_action( 'wp_ajax_socd_post', 'socd_qp_ajax_post' );
