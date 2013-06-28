<?php
/**
 * The Header for our theme.
 *
 * @package SOCD
 */
?><html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<section class="site-wrap">
	
<?php require 'partials/main-navigation/main-navigation.php'; ?>

<header class="header">
	<h1 class="h1 header__title">School of Communication&nbsp;Design</h1>
</header>
