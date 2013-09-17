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

							socd_template_part( 'profile', 'listing' );

					endforeach;

				endif;
				
				?>
			</ul>
		</div>
	</section>
</div>
<?php get_footer();