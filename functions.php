<?php 
/**
 * Functions file, imports
 * and sets up all the dependencies
 * for the theme.
 * 
 * @package SOCD
 */

function socd_assets () {
	wp_enqueue_style( 'socd_fonts', "http://fnt.webink.com/wfs/webink.css/?project=02A1E400-855B-411C-A4F5-7EC50DAC8A77&fonts=602BD939-0B36-207C-56E5-E3E6434C3273:f=Theinhardt-HairlineIta,2272E54A-6BEF-79F6-B479-9FB26CE41DD7:f=Theinhardt-BlackIta,5F278FF9-E581-1824-0F92-F6D72B137A6A:f=Theinhardt-HeavyIta,F1909AAE-4087-F011-EEAD-AB047C3C6A43:f=Theinhardt-Hairline,FED7BA4D-9940-546C-184F-B8A8B98DE86B:f=HermesOptimoTypewriter,BF522E13-B921-2C59-5FD3-9D3C689FC32B:f=Theinhardt-LightIta,864889ED-8E73-7E19-00E2-BBE0F997E58C:f=Theinhardt-Thin,2A04CF10-789B-A5BB-9721-E19ACED96EEB:f=Theinhardt-Black,8B459781-89CC-B7EA-6A87-7EC561303F45:f=Theinhardt-BoldIta,BFE4A44E-8D1D-66D8-BBF8-42F52771F0D3:f=Theinhardt-ThinIta,82DA4627-8191-9CE4-706C-58F3C2615A95:f=Theinhardt-Bold,DC84A178-A66C-DB8D-5140-7E5BF64AB28F:f=Theinhardt-RegularIta,F77BBDE3-5270-5846-90AD-5529C2FFDA57:f=Theinhardt-Medium,9773ABFB-EF93-0C1B-AE14-35A7DD420754:f=Theinhardt-UltraLight,008579D7-00D8-1E34-1306-843EC6BC82EA:f=Theinhardt-Light,70F8A7D9-BDFF-D029-E465-E7FC928A5994:f=Theinhardt-MediumIta,0684BC34-8E92-BE61-25F1-D15CB377C180:f=Theinhardt-UltraLightIta,A7E06AF3-FA3A-4B28-764F-AC325B3529DA:f=Theinhardt-Heavy,BA766C3D-9F83-4950-AFCD-AD9F2BF5CEAB:f=Theinhardt-Regular" );
	wp_enqueue_style( 'socd_base', get_stylesheet_directory_uri() . '/assets/stylesheets/screen.css' );


	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_stylesheet_directory_uri(). '/assets/javascript/libs/jquery-1.9.1.min.js');

	wp_enqueue_script( 'socd_typeahead', get_stylesheet_directory_uri() . '/assets/javascript/libs/typeahead.min.js', array('jquery') );
	wp_enqueue_script( 'socd_main-navigation', get_stylesheet_directory_uri() . '/assets/javascript/main-navigation.js', array( 'jquery', 'socd_typeahead' ) );
	
}

add_action('wp_enqueue_scripts', 'socd_assets' );


/**
 * Removes WP Admin bar
 */
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
	show_admin_bar(false);
}