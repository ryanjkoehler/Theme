<?php
/**
 * 
 * @package SOCD
 */

get_header(); ?>
<section class="gw gallery">
	<header class="header gallery--header">
		<h1 class="h1 site--title"><a href="<?php bloginfo( 'wpurl' ); ?>"><?php bloginfo('name'); ?></a></h1>
		<h2 class="blog--title">Gallery</h2>
	</header><!-- .header -->
	<section class="gw gallery--listing gallery-listing"><!--
		<?php while( have_posts() ) : the_post(); ?>
			--><?php get_template_part( 'templates/gallery/gallery-listing-item'); ?><!--
			--><?php get_template_part( 'templates/gallery/gallery-listing-item'); ?><!--
			--><?php get_template_part( 'templates/gallery/gallery-listing-item'); ?><!--
			--><?php get_template_part( 'templates/gallery/gallery-listing-item'); ?><!--
			--><?php get_template_part( 'templates/gallery/gallery-listing-item'); ?><!--
		<?php endwhile; ?>
 --></section>
</section><!-- .gw -->

<?php get_footer(); ?>