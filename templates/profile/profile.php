<?php 
/**
 * 
 * Profile page
 * 
 * Used to render staff and student profiles
 * 
 * @package  socd
 */

global $user;


?><div class="gw">
	<article class="type-page page h-center">
		<header class="header">
			<h1 class="h1 site--title"><?php echo $user->data->display_name; ?></h1>
		</header>
		<div class="page--main">
			<div class="cell colour--white">
				<h2 class="h2 h2--ruled"><?php profile_field('socd_role'); ?></h2>
				<h2><?php profile_field('socd_campus'); ?></h2>
				<?php get_user_meta( $user->data->ID, $key = '', $single = false ) ?>
				<?php echo apply_filters( 'the_content', socd_get_profile_field('description') ); ?>

				<?php 



					function validate_social_links($input, $service) {
						if ( ! preg_match( '/' . $service . '/', $input) ) {
							return "http://" . preg_replace('/-/', '.', $service ) . ".com/" . $input;
						}
						return $input;
					}

					$fields = array(
						'facebook'   => 'Facebook',
						'instagram'  => 'Instagram',
						'pinterest'  => 'Pinterest',
						'tumblr' 	 => 'Tumblr',
						'twitter' 	 => 'Twitter'
					);

					$output = array();

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
			</div>
		</div><div>
			<div class="cell colour--blue">
				<h2 class="h2 h2--ruled">Quick links</h2>

			</div>
		</div>

	</article>
</div>