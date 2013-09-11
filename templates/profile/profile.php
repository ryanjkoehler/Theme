<?php 
/**
 * 
 * Profile page
 * 
 * Used to render staff and student profiles
 * 
 * @package  socd
 */

global $current_site, $user;


?><div class="gw">
	<article class="profile h-center">
		<header class="header">
			<h1 class="h1 site--title"><?php echo $user->data->display_name; ?></h1>
		</header>
		<div class="profile--wrap">
			<div class="col one-whole lap--one-half desk--one-third push--desk--one-sixth">
				<div class="cell colour--white">
					<header>
						<h2 class="h2 heading--ruled"><?php profile_field('socd_role'); ?></h2>
						<h3 class="h4"><?php echo socd_course_code_to_course_name( get_user_meta( $user->ID, 'course', true ) ); ?></h3>
						<h4 class="h3"><?php profile_field('socd_campus'); ?></h4>
					</header>
					<?php echo apply_filters( 'the_content', socd_get_profile_field('description') ); ?>
					<?php 

						function validate_social_links($input, $service) {
							if ( ! preg_match( '/' . $service . '/', $input) ) {
								return "http://" . preg_replace('/-/', '.', $service ) . ".com/" . $input;
							}
							return $input;
						}

						$fields = array(
							'website'	 => 'Website',
							'facebook'   => 'Facebook',
							'instagram'  => 'Instagram',
							'pinterest'  => 'Pinterest',
							'tumblr' 	 => 'Tumblr',
							'twitter' 	 => 'Twitter'
						);

						$output = array();

						if ( $user->user_url != "" )
							$output[] = sprintf(
								'<li><a href="%1$s">%2$s</a></li>',
								$user->user_url,
								preg_replace('/http:\/\//', '', $user->user_url )
							);


						foreach ( $fields as $key=>$label ) {

							$value = socd_get_profile_field( $key );

							if ( $value == "" || !$value ) continue;

							$output[] = sprintf(
								'<li><a href="%2$s" target="_blank">%1$s</a></li>',
								$label,
								validate_social_links( $value, $key )
							);
						};

						echo "<ul>" . implode('', $output) . "</ul>";

					 ?>
				</div><!-- .cell -->
			</div><?php if ( 1 !== $current_site->id ) : ?><aside class="col one-quarter profile--quick">
				<div class="cell colour--blue">
					<h2 class="h2 h2--ruled">Quick links</h2>
					<?php socd_site_menu(); ?>
				</div>
			</aside><?php endif; ?><!-- 
			--><?php socd_headshot('col lap--one-half'); ?>
		</div><!-- .page--wrap -->
	</article>
</div>