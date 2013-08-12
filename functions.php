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
	require( get_stylesheet_directory() . '/inc/template-tags.php' );
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
	wp_enqueue_style( 'socd_base', get_stylesheet_directory_uri() . '/assets/stylesheets/screen.css' );

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_stylesheet_directory_uri(). '/assets/javascript/libs/jquery-1.9.1.min.js', false, false, true );

	wp_enqueue_script( 'socd_inline_attach', get_stylesheet_directory_uri() . '/assets/javascript/libs/jquery.inline-attach.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'socd_hogan', get_stylesheet_directory_uri() . '/assets/javascript/libs/hogan.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'socd_hogan_templates', get_stylesheet_directory_uri() . '/assets/javascript/socd-hogan-templates.js', array( 'socd_hogan' ), false, true );
	wp_enqueue_script( 'socd_typeahead', get_stylesheet_directory_uri() . '/assets/javascript/libs/typeahead.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'socd_states', get_stylesheet_directory_uri() . '/assets/javascript/states.js', array( 'jquery'  ), false, true );	
	wp_enqueue_script( 'socd_main_navigation', get_stylesheet_directory_uri() . '/assets/javascript/main-navigation.js', array( 'jquery', 'socd_typeahead', 'socd_states', 'socd_hogan', 'socd_hogan_templates' ), false, true );
	wp_enqueue_script( 'socd_notification_center', get_stylesheet_directory_uri() . '/assets/javascript/notification-center.js', array( 'jquery', 'socd_hogan', 'socd_hogan_templates' ), false, true );
	wp_enqueue_script( 'socd_comments', get_stylesheet_directory_uri() . '/assets/javascript/comments.js', array( 'jquery', 'socd_inline_attach'  ), false, true );	
}

add_action( 'wp_enqueue_scripts', 'socd_assets' );

/**
 * Removes WP Admin bar
 */
function remove_admin_bar() {
	if ( is_admin() ) {
		show_admin_bar(false);
	}
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
	register_nav_menus( array( 
		'socd_network_menu' => 'Network Menu',
		'socd_network_footer' => 'Network Footer'
	) );
}
add_action( 'init', 'socd_menus' );

//////////////////////////////////////////////////////////////////////////////////////////////
// QUICKPOST /////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Enqueue script and adding localisation
 */
function socd_qp_enqueue_scripts() {
	if ( ! is_admin() ) {		
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
			'nonce' => wp_create_nonce( 'socd_qp' ),
			'post_formats' => $post_formats
		) );
	}
}
add_action( 'wp_enqueue_scripts', 'socd_qp_enqueue_scripts' );

/**
 * AJAX Endpoint for QuickPost
 */
function socd_qp_ajax_post() {
	if ( ! empty( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'socd_qp' ) ) {

		$output = array();
		
		// Process serialised form data from jQuery
		parse_str( $_POST['formdata'], $data );

		// Switch to correct blog
		if ( ! empty( $data['blog_id'] ) && switch_to_blog( $data['blog_id'], true ) ) {
	
			// Check user can post to current blog
			if ( current_user_can( 'publish_posts' ) ) {
	
				// Prepare Content
				switch ( $data['post_format'] ) {
					
					case 'blog':
						$title = htmlspecialchars( $data['title'] );
						$content = $data['content'];
					break;
					
					default: 
						$output['status'] = 'error';
						$output['message'] = 'Invalid posttype Specified.';
					break;
					
				}
				
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
					$slug = wp_unique_post_slug( sanitize_title_with_dashes( $title, '', 'save' ), 0, 'publish', 'post', '' );
					
					wp_update_post( array( 
						'ID' => $post_id,
						'post_name' => $slug
					) );					
					
					// Set post format
					$post_formats = get_theme_support( 'post-formats' );
					if ( in_array( $data['post_format'], $post_formats[0] ) )
						set_post_format( $post_id, $data['post_format'] );
		
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

//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////









































