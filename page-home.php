<?php
/**
 * Template Name: Home
 * 
 */
get_header(); ?>
<section class="homepage">
	<div class="gw">
		<header class="header homepage--header">
			<h1 class="h1 site--title"><?php bloginfo( 'description' ); ?></h1>
		</header>
		<div class="col col-half" style="position: relative; z-index: 1;">
			<div class="gw">
				<div class="col">
					<div class="cell colour--dark">
						<p class="h3 h3--ruled">
							Welcome to the School of Communication Design at University for the Creative Arts. The School is made up up thirteen courses and spread over three campus sites in Surrey and Kent.
						</p>
						<p>This is our new site, it's not set to launch until September, so consider this an early preview. Bit's are missing and undoubtedly there will be bugs. But we believe there's some value in building this out in the open.</p>
						<a href="http://make.socd.io">Read More &rarr;</a>
					</div>
				</div>
				<div class="col col-two-thirds">
					<a href="/gallery" class="homepage--gallery">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Joanna_Louise_Bird__BA_(Hons)_Graphic_Design__UCA_Epsom_image.jpg" alt=""/>
						<div class="cell colour--green">
							<h2 class="h2 h3--ruled"><?php _e( 'View the Gallery', 'socd' ); ?></h2>
						</div>
					</a>
				</div>

			</div>
		</div><!-- 
		--><div class="col col-two-thirds homepage--map-container">
			<figure id="homepage--map"></figure>
		</div>
	</div><div class="gw gw--rtl">
		<div class="col col-third push--col-one-sixth">
			<div class="cell colour--red">
				<h1 class="h2 h2--ruled"><a href="<?php echo get_permalink( get_option( 'page_for_posts') ) ?>">School News</a></h1>
				<?php 

				/**
				 * Query Latest News Posts
				 */
				
				$news = get_posts(  array(
					'numberposts' => 5,
				) );

				if ( count( $news ) ) : ?>

					<ol>
						<?php foreach ( $news as $key => $post ) : setup_postdata( $post ); ?>
							<li>
								<article class="gw">
									<time class="col col-one-fifth">
										<?php echo get_the_date("d.m"); ?>
									</time><!-- 
								 --><div class="col col-four-fifths">
								 		<h2 class="h4 post--title"><?php the_title(); ?></h2>
								 		<?php the_excerpt(); ?>
								 		<a href="<?php the_permalink(); ?>">Read More</a>
									</div><!-- .col.col-four-fifths -->
								</article>
							</li>
						<?php endforeach; ?>
					</ol>

					<a href="<?php echo get_permalink( get_option( 'page_for_posts') ); ?>">Archives &rarr;</a>
				
				<?php endif; ?>
			</div>
		</div><!-- 
		--><div class="col col-third">
			<div class="cell colour--blue">
				<h1 class="h2 h2--ruled">School Events</h1>
				<ul>
					<li>
						<div class="gw">
							<div class="col-one-quarter">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/white.png" class="avatar" alt=""/>
							</div><!--
							--><div class="col-three-quarters">
								<h2 class="h4">Research Conference:</h2>
								<p>Creative Responses to a Changing&nbsp;World</p>
							</div>
						</div>
					</li>
					<li>
						<div class="gw">
							<div class="col-one-quarter">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/white.png" class="avatar" alt=""/>
							</div><!--
							--><div class="col-three-quarters">
								<h2 class="h4">Lecture Series: Developing Narrative</h2>
								<p>We’re lucky to have the prolific speaker Lucy Davis at Farnham to talk about her process when developing...</p>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div><!-- 
		--><div class="col col-sixth">
			<div class="cell colour--dark">
				<h1 class="h2 h2--ruled">School Staff</h1>
				<?php

				/**
				 * Randomly Load Four staff members
				 */

				function socd_get_random_staff( $no_of_staff = 4 ) {

					global $user;

					$staff = get_users( array(
						'number' 	 => 999,
						'order_by'   => 'RAND()',
						'meta_query' => array(
							array(
								'key'  	  => 'group',
								'value'   => 'staff',
								'compare' => '='
					) ) ) );

					$output = array();

					if ($staff) {

						shuffle( $staff );

						for ( $i = 0, $max = $no_of_staff; $i < $max; $i++ ) {

							$user = $staff[$i];
							
							$output[] = sprintf(
								'<a href="%1$s" class="col-half">%2$s</a>',
								socd_get_profile_url(),
								socd_get_profile_thumbnail()
							);
						} 
					}

					echo implode( "", $output );
				}

				socd_get_random_staff();

				?>
			</div>
		</div><!-- 
		-->
	</div><!-- .gw -->
</section>
<?php get_footer();