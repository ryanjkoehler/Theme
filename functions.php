<?php 
/**
 * Functions file, imports
 * and sets up all the dependencies
 * for the theme.
 * 
 * @package SOCD
 */



function socd_setup() {
	//require( get_stylesheet_directory() . '/partials/comments/comments.php' );
	require( get_stylesheet_directory() . '/inc/customizer.php' );
	require( get_stylesheet_directory() . '/inc/extras.php' );
	require( get_stylesheet_directory() . '/inc/template-tags.php' );

	add_theme_support( 'post-thumbnails', 'customizer' );
}

add_action('init', 'socd_setup');

/**
 * Manually hook in the webink stylesheet as it uses some characters '&' that 
 * get escaped by the 'wp_enqueue_style'
 */
function socd_webink() { ?>
	<link rel="stylesheet" href="http://fnt.webink.com/wfs/webink.css/?project=02A1E400-855B-411C-A4F5-7EC50DAC8A77&fonts=602BD939-0B36-207C-56E5-E3E6434C3273:f=Theinhardt-HairlineIta,BF522E13-B921-2C59-5FD3-9D3C689FC32B:f=Theinhardt-LightIta,864889ED-8E73-7E19-00E2-BBE0F997E58C:f=Theinhardt-Thin,2A04CF10-789B-A5BB-9721-E19ACED96EEB:f=Theinhardt-Black,8B459781-89CC-B7EA-6A87-7EC561303F45:f=Theinhardt-BoldIta,82DA4627-8191-9CE4-706C-58F3C2615A95:f=Theinhardt-Bold,BFE4A44E-8D1D-66D8-BBF8-42F52771F0D3:f=Theinhardt-ThinIta,DC84A178-A66C-DB8D-5140-7E5BF64AB28F:f=Theinhardt-RegularIta,F77BBDE3-5270-5846-90AD-5529C2FFDA57:f=Theinhardt-Medium,008579D7-00D8-1E34-1306-843EC6BC82EA:f=Theinhardt-Light,70F8A7D9-BDFF-D029-E465-E7FC928A5994:f=Theinhardt-MediumIta,9773ABFB-EF93-0C1B-AE14-35A7DD420754:f=Theinhardt-UltraLight,BA766C3D-9F83-4950-AFCD-AD9F2BF5CEAB:f=Theinhardt-Regular"/>
	<?php 
}

add_action( 'wp_head', 'socd_webink');


function socd_assets () {
	wp_enqueue_style( 'socd_base', get_stylesheet_directory_uri() . '/assets/stylesheets/screen.css' );

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_stylesheet_directory_uri(). '/assets/javascript/libs/jquery-1.9.1.min.js', false, false, true );

	wp_enqueue_script( 'socd_hogan', get_stylesheet_directory_uri() . '/assets/javascript/libs/hogan.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'socd_typeahead', get_stylesheet_directory_uri() . '/assets/javascript/libs/typeahead.min.js', array( 'jquery', 'socd_hogan' ), false, true );
	wp_enqueue_script( 'socd_states', get_stylesheet_directory_uri() . '/assets/javascript/states.js', array( 'jquery'  ), false, true );	
	wp_enqueue_script( 'socd_main-navigation', get_stylesheet_directory_uri() . '/assets/javascript/main-navigation.js', array( 'jquery', 'socd_typeahead', 'socd_states' ), false, true );
	
}

add_action('wp_enqueue_scripts', 'socd_assets' );


/**
 * Removes WP Admin bar
 */
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
	show_admin_bar(false);
}



/**
 * Register our sidebars and widetized areas
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

add_action('widgets_init', 'socd_widets_init');

