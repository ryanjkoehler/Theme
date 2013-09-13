<?php
/**
 * The Header for our theme.
 *
 * @package SOCD
 */
 global $page, $paged;
?>
<!DOCTYPE html>
<!--[if lt IE 9 ]> <html <?php language_attributes(); ?> class="no-js lt-ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
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
<!--[if lt IE 9]>
<div class="site-wrap notifications-message notifications-message__ambivalent">
	<p>Note: The browser you're using is at least <a href="http://www.w3.org/People/Berners-Lee/FAQ.html#standards"><?php echo (date("Y") - 2008) * 4.6; ?></a> years old. As a result you are missing out on enhanced functionality available to modern browsers.</p>
	<p>Please visit <a href="http://browsehappy.com/">Browse Happy</a> for information about the latest browsers.</p>
</div>
<![endif]  -->
<section class="site-wrap h-animate-transform">
<?php

	if ( !is_user_logged_in() ) socd_template_part( 'main-navigation' );
