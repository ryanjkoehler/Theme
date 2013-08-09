<?php
/**
 * The Header for our theme.
 *
 * @package SOCD
 */
 global $page, $paged;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0" />
	<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); echo ( $paged >= 2 || $page >= 2 ? ' - Page ' . max( $paged, $page ) : null ) ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<section class="site-wrap h-animate-transform">
	
<?php require 'templates/main-navigation/main-navigation.php'; ?>
