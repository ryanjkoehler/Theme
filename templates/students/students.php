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
			<h1 class="h1 header__title"><?php _e('Course Students', 'socd'); ?></h1>
		</header>
		
		<div class="col col-one-sixth">
			<div class="cell colour--blue">
				<h1 class="h2 h2--ruled">Filter by</h1>
				<ul>
					<li>
						Year of Study
						<?php socd_filter_years_of_study(); ?>
					</li>
					<li>
						Course
						<?php socd_filter_course(); ?>
					</li>
					<li>Campus
						<?php socd_filter_campus(); ?>
					</li>
				</ul>
			</div>
		</div><!-- 
	--><ul class="col col-five-sixths listing__students">
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

				?><li itemscope itemtype="http://schema.org/Person" class="listing--profile profile__student col col-one-fifth">
					<a href="<?php profile_url(); ?>">
						<img class="thumb" itemprop="image" src="http://placehold.it/60x60" alt="Staff Name"/>
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