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

<h1>Typography</h1>

<section>
	
	<div class="cell">
		<h1 class="h2 h2--ruled">Sample Heading</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse feugiat, felis eget eleifend porta, mi mi iaculis quam, sit amet pharetra ante massa sed magna. Morbi vulputate augue quis nibh cursus sed accumsan massa sodales. Aenean nec aliquet leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi eget pharetra tellus. Donec vitae rutrum justo. Curabitur semper, diam id congue dapibus, dolor nulla hendrerit urna, vitae commodo nulla orci eu neque. Sed eros lacus, sollicitudin ut ornare vitae, fermentum eget orci. Morbi dictum nibh et lectus suscipit pharetra vitae et ipsum.</p>
	</div>
</section>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/javascript/libs/fixie/fixie.js"></script>
<?php get_footer();