<?php
/**
 * Template Name: Staff
 * 
 * Archive of the staff
 * 
 */
get_header(); ?>
<div class="gw">
	<section>
		<header class="header">
			<h1 class="h1 header__title"><?php _e('Staff Profiles', 'socd'); ?></h1>
		</header>
		<div>
			<ul class="col two-thirds h-center listing__profiles">
				<?php

				$courses_represented = array();

				$meta_query = array(
					array(
						'key'   => 'group',
						'value' => 'staff',
						'compare' => '='
				) );

				if ( is_main_site() && $course = socd_get_subdomain() ) {
					$meta_query[] = array(
						'key'     => 'course',
						'value'	  => $course,
						'compare' => '='
					);
				}

				$staff = get_users( array(
					'blog_id'	 => 1,
					'meta_query' => $meta_query
				) );

				
				if ( $staff ) : 

					global $user;

					foreach ( $staff as $user ) :
						if( !in_array( get_user_meta( $user->ID, 'course', true ), $courses_represented) ){
							$courses_represented[] = get_user_meta( $user->ID, 'course', true );
						}
						?><li itemscope itemtype="http://schema.org/Person" class="listing--profile col one-quarter filter--course-<?php echo get_user_meta( $user->ID, 'course', true ) ?>">
							<a href="<?php echo socd_get_profile_url( $user ); ?>"><?php echo socd_get_profile_thumbnail(); ?></a>
							<div class="profile--info">
								<h1 class="name" itemprop="name"><?php echo $user->display_name; ?></h1>
								<h2 class="role" itemprop="jobTitle"><?php echo get_user_meta( $user->ID, 'socd_role', true ); ?></h2>
		
								<p><?php echo socd_course_code_to_course_name( get_user_meta( $user->ID, 'course', true ) ); ?></p>
							</div>
						</li><?php

					endforeach;

				endif;
				
				?>
			</ul>
			<div class="col one-sixth">
				<div class="cell colour--blue">
					<h2 class="h2 h2--ruled">Filter By</h2>	
					<h3>Course</h3>
					<!-- <select name="course">
						<?php foreach( $courses_represented as $course ): 
							$code = $course;
							$name = socd_course_code_to_course_name( $code );
						?>
							<option value="<?php echo $code ?>"><?php echo $name ?></option>
						<?php endforeach;?>
					</select> -->
					<!-- 
					<?php print_r( socd_filter_course() ); ?> -->
				</div>
			</div>
		</div>
	</section>
</div>
<?php get_footer();