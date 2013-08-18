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

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-43247794-1', 'socd.io');
	  ga('send', 'pageview');
	</script>
</head>
<body <?php body_class(); ?>>
<section class="site-wrap h-animate-transform">
	
<?php socd_template_part('main-navigation'); ?>
