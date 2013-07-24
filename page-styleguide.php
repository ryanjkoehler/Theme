<?php
/**
 * Template Name: Styleguide
 */
get_header(); ?>

<div class="wysiwyg">
	<p data-fixie class="fixie"></p>
	<ul data-fixie class="fixie">
		<li data-fixie class="fixie"></li>
		<ul data-fixie class="fixie"></ul>
	</ul>
	<ol data-fixie></ol>
	<ul class="listing__navigation" data-fixie></ul>

	<p data-fixie data-fixie-clone="2"></p>
</div>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/javascript/libs/fixie/fixie.js"></script>
<?php get_footer();