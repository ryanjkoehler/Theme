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
		
		<div class="col one-sixth">
			<div class="cell colour--blue listing-filter">
				<h1 class="h2 h2--ruled">Filter by</h1>
				<ul>
					<li class="listing-filter--section" data-section="year">
						<h2 class="section-title">Year of Study</h2>
						<ul class="listing__filter section-options">
							<?php socd_filter_years_of_study(); ?>
						</ul>
					</li>
					<li class="listing-filter--section" data-section="course">
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
	--><ul class="col five-sixths listing__students">
			<?php

			$students = get_users( array(
				'blog_id'	 => 1,
				'number'	 => 999,
				'meta_query' => array(
					array(
						'key'	  => 'group',
						'value'   => 'staff',
						'compare' => 'NOT LIKE'
					)
				)
			) );

			global $user;

			foreach ( $students as $user ) :

				?><li itemscope itemtype="http://schema.org/Person" data-year="<?php socd_year_code(); ?>" data-course="<?php socd_course_code(); ?>" data-campus="" class="listing--profile profile__student col one-fifth" <?php socd_user_match_current_course(); ?>>
					<!--
						<?php print_r( get_user_meta( $user->data->ID ) ); ?>
					-->
					<a href="<?php profile_url(); ?>">
						<?php echo socd_get_profile_thumbnail(); ?>
					</a>
					
					<div class="profile--info">
						<h1 class="name" itemprop="name"><?php echo $user->display_name; ?></h1>
						
						<p><?php socd_course(); ?></p>
						<p class="year"><?php socd_enrolment_year(); ?></p>
					</div>
				</li><?php

			endforeach; ?>
		</ul>
	</section>
</div>
<?php get_footer();