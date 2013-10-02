<?php
/**
 * Template Name: Student
 * 
 * Archive of the students
 * 
 */
get_header(); ?>
<div class="gw">
	<section>
		<header class="header">
			<h1 class="h1 site--title"><?php _e('Course Students', 'socd'); ?></h1>
		</header>
		
		<div class="col lap--one-third desk--one-sixth">
			<div class="cell colour--blue listing-filter">
				<h1 class="h2 h2--ruled">Filter by</h1>
				<ul>
					<li class="listing-filter--section col" data-section="year">
						<h2 class="strong">Year of Study</h2>
						<ul class="listing__filter section-options">
							<?php socd_filter_years_of_study(); ?>
						</ul>
					</li><!-- 
				 --><li class="listing-filter--section col" data-section="course">
						<h2 class="strong">Course</h2>
						<ul class="listing__filter section-options">
							<?php socd_filter_course(); ?>
						</ul>
					</li>
					<!-- 
					<li class="listing-filter--section" data-section="campus">
						<h2 class="strong">Campus</h2>
						<ul class="section-options">
							<?php socd_filter_campus(); ?>
						</ul>
					</li> -->
				</ul>

				<footer class="listing-filter--display">
					<a href="#" data-class="listing__students" class="dashicons dashicons-screenoptions"></a>
					<a href="#" data-class="listing__linear" class="dashicons dashicons-menu"></a>					
				</footer>
			</div>
		</div><!-- 
	--><ul class="col lap--two-thirds desk--five-sixths listing__students">
			<?php

			$students = socd_get_students();

			global $user;

			if ( is_array( $students ) ) :

				foreach ( $students as $user ) :

					socd_template_part( 'profile', 'listing' );

				endforeach;

			endif; ?>
		</ul>
	</section>
</div>
<?php get_footer();