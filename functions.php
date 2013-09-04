<?php 

/**
 * Functions file, imports
 * and sets up all the dependencies
 * for the theme.
 * 
 * @package SOCD
 */
require( get_stylesheet_directory() . '/inc/templates.php' );

/**
 * Basic setup
 */
function socd_setup() {
	require( get_stylesheet_directory() . '/inc/admin.php' );
	require( get_stylesheet_directory() . '/inc/customizer.php' );
	require( get_stylesheet_directory() . '/inc/extras.php' );
	require( get_stylesheet_directory() . '/inc/filters.php' );
	require( get_stylesheet_directory() . '/inc/template-tags.php' );
	require( get_stylesheet_directory() . '/inc/main-navigation.php' );
}
add_action( 'init', 'socd_setup' );

/**
 * Add theme post thumbnail support
 */
function socd_after_theme_setup() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'image', 'video', 'link', 'quote' ) );
}
add_action( 'after_setup_theme', 'socd_after_theme_setup' );

/**
 * Manually hook in the webink stylesheet as it uses some characters '&' that 
 * get escaped by the 'wp_enqueue_style'
 */
function socd_webink() { ?>
	<link rel="stylesheet" href="http://fnt.webink.com/wfs/webink.css/?project=02A1E400-855B-411C-A4F5-7EC50DAC8A77&fonts=602BD939-0B36-207C-56E5-E3E6434C3273:f=Theinhardt-HairlineIta,BF522E13-B921-2C59-5FD3-9D3C689FC32B:f=Theinhardt-LightIta,864889ED-8E73-7E19-00E2-BBE0F997E58C:f=Theinhardt-Thin,2A04CF10-789B-A5BB-9721-E19ACED96EEB:f=Theinhardt-Black,8B459781-89CC-B7EA-6A87-7EC561303F45:f=Theinhardt-BoldIta,82DA4627-8191-9CE4-706C-58F3C2615A95:f=Theinhardt-Bold,BFE4A44E-8D1D-66D8-BBF8-42F52771F0D3:f=Theinhardt-ThinIta,DC84A178-A66C-DB8D-5140-7E5BF64AB28F:f=Theinhardt-RegularIta,F77BBDE3-5270-5846-90AD-5529C2FFDA57:f=Theinhardt-Medium,008579D7-00D8-1E34-1306-843EC6BC82EA:f=Theinhardt-Light,70F8A7D9-BDFF-D029-E465-E7FC928A5994:f=Theinhardt-MediumIta,9773ABFB-EF93-0C1B-AE14-35A7DD420754:f=Theinhardt-UltraLight,BA766C3D-9F83-4950-AFCD-AD9F2BF5CEAB:f=Theinhardt-Regular"/>
	<?php 
}
add_action( 'wp_head', 'socd_webink' );

/**
 * Load in the scripts and styles
 */
function socd_assets () {

	global $blog_id, $wp_styles;

	/**
	 * Styles
	 */
	wp_enqueue_style( 'socd_base', get_stylesheet_directory_uri() . '/assets/stylesheets/screen.css' );
	wp_register_style( 'socd_ie', get_stylesheet_directory_uri() . '/assets/stylesheets/ie.css' );
	$wp_styles->add_data('socd_ie', 'conditional', 'IE');
	wp_enqueue_style( 'socd_ie' );


	/**
	 * Scripts
	 */
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_stylesheet_directory_uri(). '/assets/javascript/libs/jquery-1.9.1.min.js', false, false, true );
	
	wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/assets/javascript/libs/modernizr.js', null, false, false );

	// Tested Code
	wp_enqueue_script( 'socd', get_stylesheet_directory_uri() . '/assets/javascript/socd.js', false, false, true );
	wp_enqueue_script( 'socd_viewport', get_stylesheet_directory_uri() . '/assets/javascript/viewport.js', false, false, true );

	// Untested Code
	wp_enqueue_script( 'socd_inline_attach', get_stylesheet_directory_uri() . '/assets/javascript/libs/jquery.inline-attach.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'socd_hogan', get_stylesheet_directory_uri() . '/assets/javascript/libs/hogan.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'socd_hogan_templates', get_stylesheet_directory_uri() . '/assets/javascript/socd-hogan-templates.js', array( 'socd_hogan' ), false, true );
	wp_enqueue_script( 'socd_typeahead', get_stylesheet_directory_uri() . '/assets/javascript/libs/typeahead.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'socd_states', get_stylesheet_directory_uri() . '/assets/javascript/states.js', array( 'jquery'  ), false, true );	
	wp_enqueue_script( 'socd_main_navigation', get_stylesheet_directory_uri() . '/assets/javascript/main-navigation.js', array( 'jquery', 'socd_typeahead', 'socd_states', 'socd_hogan', 'socd_hogan_templates' ), false, true );
	wp_enqueue_script( 'socd_notification_center', get_stylesheet_directory_uri() . '/assets/javascript/notification-center.js', array( 'jquery', 'socd_hogan', 'socd_hogan_templates' ), false, true );
	wp_enqueue_script( 'socd_comments', get_stylesheet_directory_uri() . '/assets/javascript/comments.js', array( 'jquery', 'socd_inline_attach'  ), false, true );
	wp_enqueue_script( 'socd_listing_filters', get_stylesheet_directory_uri() . '/assets/javascript/listing-filter.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'socd_main', get_stylesheet_directory_uri() . '/assets/javascript/main.js', array( 'jquery', 'modernizr', 'socd', 'socd_viewport', 'socd_inline_attach', 'socd_hogan', 'socd_hogan_templates', 'socd_typeahead', 'socd_states', 'socd_main_navigation', 'socd_notification_center', 'socd_comments', 'socd_listing_filters',  ), false, true );

	// Only used in the registration form
	// 
	wp_enqueue_script( 'socd_register', get_stylesheet_directory_uri() . '/assets/javascript/register.js', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'socd_assets' );

function socd_javascript_config() {

	global $blog_id;

	$config = array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'typeahead_local' => socd_get_navigation_data()
	);

	if (is_front_page() && $blog_id == 1 ) {
		global $post;

		$locations = get_field('locations', $post->ID );

		$config = array_merge( $config, array(
			'places' => is_array( $locations ) ? $locations : array(),
			'center' => get_field( 'center_point', $post->ID )
		) );
	}

	wp_localize_script( 'socd', 'SOCD', array(
		'Config' => $config
	) );
}
add_action( 'wp_enqueue_scripts', 'socd_javascript_config' );

/**
 * Removes WP Admin bar
 */
function remove_admin_bar() {
	if ( is_admin() )
		show_admin_bar(false);
}
add_action( 'after_setup_theme', 'remove_admin_bar' );

/**
 * Register our sidebars and widetized areas
 * 
 */
function socd_widets_init() {
	register_sidebar( array(
		'name' => 'Left Sidebar',
		'id'   => 'left_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="h2 h2--ruled">',
		'after_title'  => '</h2>'
	) );

	register_sidebar( array(
		'name' => 'Right Sidebar',
		'id'   => 'blog_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="h2 h2--ruled">',
		'after_title'  => '</h2>'
	) );
}
add_action( 'widgets_init', 'socd_widets_init' );

/**
 * Create various menus
 */
function socd_menus() {
	global $current_blog;
	if ( is_main_site() && 1 == $current_blog->blog_id ) {
		register_nav_menus( array( 
			'socd_network_menu' => 'Network Menu',
			'socd_network_footer' => 'Network Footer'
		) );

	} elseif ( is_network() ){
		register_nav_menus( array(
			'socd_site_menu' => 'Site Menu'
		) );
	} else {
		register_nav_menus( array(
			'socd_blog_menu' => 'Menu'
		) );
	}
}
add_action( 'init', 'socd_menus' );

/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 *
 * @return void
 */
function socd_paging_nav() {
	global $current_blog, $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation stream--paging" role="navigation">
		<h1 class="h-screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">
			<?php
			
			if ( $prev = get_previous_posts_link( _('&uarr; Newer') ) )
				echo preg_replace('/(http:\/\/)socd\.(io|loc)/', '$1' . $current_blog->domain, $prev );

			if ( $next = get_next_posts_link( __( '&darr; Older' ) ) )
				echo preg_replace('/(http:\/\/)socd\.(io|loc)/', '$1' . $current_blog->domain, $next );

			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}



//////////////////////////////////////////////////////////////////////////////////////////////
// QUICKPOST /////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Enqueue script and adding localisation
 */
function socd_qp_enqueue_scripts() {
	if ( ! is_admin() && is_user_logged_in() && !is_front_page() ) {		
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

/**
 * AJAX Endpoint for getting Taxonomy Terms
 */
function socd_qp_ajax_tax() {
	if ( ! empty( $_POST['tax_nonce'] ) && wp_verify_nonce( $_POST['tax_nonce'], 'socd_tax' ) ) {
		
		$output = array();
		
		// Switch to correct blog
		if ( ! empty( $_POST['blog_id'] ) && switch_to_blog( absint( $_POST['blog_id'] ), true ) ) {
			
			// Check user can post to current blog
			if ( current_user_can( 'publish_posts' ) ) {
				
				// Return JSON Header
				header( 'Content-Type: text/json' );
				
				// Make a list of taxonomies to get the terms for
				$taxonomies = array( 'post_tag', 'category' );
				
				// Course Taxonomy
				if ( taxonomy_exists( 'socd_year_taxonomy' ) )
					$taxonomies[] = 'socd_year_taxonomy';
					
				// For future use
				if ( taxonomy_exists( 'socd_project_taxonomy' ) )
					$taxonomies[] = 'socd_project_taxonomy';
				
				// Format a nice list of terms
				foreach ( get_terms( $taxonomies, array( 'hide_empty' => false ) ) as $term ) {
					$tidy_term['id'] = $term->term_id;
					$tidy_term['name'] = $term->name;
					$tidy_term['slug'] = $term->slug;
					$output['terms'][$term->taxonomy][] = $tidy_term;
				}
				
				// Output info about each taxonomy
				foreach ( get_taxonomies( '', 'objects' ) as $id => $tax ) {
					if ( in_array( $id, $taxonomies ) ) {
						$tidy_tax['name'] = $tax->labels->name;
						$tidy_tax['singular_name'] = $tax->labels->singular_name;
						$output['taxes'][$id] = $tidy_tax;
					}
				}
				
				// Output the result
				echo json_encode( $output );
				
				// Go back to the original blog
				restore_current_blog();
				
				// Exit before the echo zero
				exit;
			}
		}
	}
}
add_action( 'wp_ajax_socd_tax', 'socd_qp_ajax_tax' );

/**
 * AJAX Endpoint for getting oEmbeds
 */
function socd_qp_ajax_oembed() {
	if ( ! empty( $_POST['oembed_nonce'] ) && wp_verify_nonce( $_POST['oembed_nonce'], 'socd_oembed' ) ) {
		
		$output = array();
		
		// Check user is logged in
		if ( is_user_logged_in() ) {
			
			// Return JSON Header
			header( 'Content-Type: text/json' );
			
			$output['html'] = wp_oembed_get( esc_url( $_POST['url'] ) );
			
			// Output the result
			echo json_encode( $output );
			
			// Exit before the echo zero
			exit;
		}
	}
}
add_action( 'wp_ajax_socd_oembed', 'socd_qp_ajax_oembed' );

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

//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////


/**
 * Fallback if ACF has not be defined
 * 
 * 
 */
if ( !function_exists('get_field') ) {
	function get_field( $field_label = false, $post_id = false ) {
		return false;
	}

	function the_field( $field_label = false, $post_id = false ) {
		return false;
	}
}