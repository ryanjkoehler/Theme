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
		
		<div class="col desk--one-sixth">
			<div class="cell colour--blue listing-filter">
				<h1 class="h2 h2--ruled">Filter by</h1>
				<ul>
					<li class="listing-filter--section col lap--one-half" data-section="year">
						<h2 class="section-title">Year of Study</h2>
						<ul class="listing__filter section-options">
							<?php socd_filter_years_of_study(); ?>
						</ul>
					</li><!-- 
				 --><li class="listing-filter--section col lap--one-half" data-section="course">
						<h2 class="section-title">Course</h2>
						<ul class="listing__filter section-options">
							<?php socd_filter_course(); ?>
						</ul>
					</li>
					<!-- 
					<li class="listing-filter--section" data-section="campus">
						<h2 class="section-title">Campus</h2>
						<ul class="section-options">
							<?php socd_filter_campus(); ?>
						</ul>
					</li> -->
				</ul>
			</div>
		</div><!-- 
	--><ul class="col desk--five-sixths listing__students">
			<?php

			$students = socd_get_students();

			global $user;

			foreach ( $students as $user ) :

				socd_template_part( 'profile', 'listing' );

			endforeach; ?>
		</ul>
	</section>
</div>
<?php get_footer();