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
			<?php if ( ! socd_get_subdomain() ): ?>
				<div class="col lap--one-third desk--one-sixth">
					<div class="cell colour--blue listing-filter">
						<h1 class="h2 h2--ruled">Filter By</h1>	
						<ul>
							<li class="listing-filter--section" data-section="course">
								<h2 class="section-title">Course</h2>
								<ul class="section-options listing__filter">
									<?php socd_filter_course(); ?>
								</ul>
							</li>
						</ul>
					</div>
				</div><?php

				endif; ?><!--
		 --><div class="col lap--two-thirds desk--two-thirds listing__profiles <?php echo socd_get_subdomain() ? "push--desk--one-sixth" : "" ; ?>">
		 	<ul class="gw">
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
						?><li itemscope itemtype="http://schema.org/Person" class="listing--profile col lap--one-half desk--one-quarter" data-course="<?php socd_course_code(); ?>">
							<a href="<?php echo socd_get_profile_url( $user ); ?>" class="thumbnail col palm--one-third"><?php echo socd_get_profile_thumbnail(); ?></a>
							<div class="profile--info col palm--two-thirds">
								<h1 class="name" itemprop="name"><?php echo $user->display_name; ?></h1>
								<h2 class="role" itemprop="jobTitle"><?php echo get_user_meta( $user->ID, 'socd_role', true ); ?></h2>
		
								<p><?php echo socd_course_code_to_course_name( get_user_meta( $user->ID, 'course', true ) ); ?></p>
							</div>
						</li><?php

					endforeach;

				endif;
				
				?>
			</ul>
		</div>
	</section>
</div>
<?php get_footer();