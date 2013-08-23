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
		
		<ul class="col col-two-thirds h-center listing__profiles">
			<?php

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

				foreach ( $staff as $staff_member ) :

					?><li itemscope itemtype="http://schema.org/Person" class="profile col col-one-quarter filter--course-<?php echo socd_course_code_to_course_name( get_user_meta( $staff_member->ID, 'course', true ) ) ?>">
						<a href="<?php echo socd_profile_url( $staff_member ); ?>"><?php socd_user_thumbnail( $staff_member ); ?></a>
						<div class="profile--info">
							<h1 class="name" itemprop="name"><?php echo $staff_member->display_name; ?></h1>
							<h2 class="role" itemprop="jobTitle"><?php echo get_user_meta( $staff_member->ID, 'socd_role', true ); ?></h2>
	
							<p><?php echo socd_course_code_to_course_name( get_user_meta( $staff_member->ID, 'course', true ) ); ?></p>
						</div>
						<!-- <?php var_dump($staff_member); ?> -->
					</li><?php

				endforeach;

			endif;

			?>
		</ul>
	</section>
</div>
<?php get_footer();