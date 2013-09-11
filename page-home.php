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
		<div class="col one-half palm--one-whole" style="position: relative; z-index: 1;">
			<div class="gw">
				<div class="col homepage--introduction">
					<div class="cell colour--dark">
						<?php 

						$page = get_post( get_option('page_on_front') );

						echo apply_filters( 'the_content', $page->post_content ); ?>
					</div>
				</div>
				<div class="col two-thirds palm--one-whole">
					<a href="/gallery" class="homepage--gallery">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Joanna_Louise_Bird__BA_(Hons)_Graphic_Design__UCA_Epsom_image.jpg" alt=""/>
						<div class="cell colour--green">
							<h2 class="h2 h3--ruled"><?php _e( 'View the Gallery', 'socd' ); ?></h2>
						</div>
					</a>
				</div>

			</div>
		</div><!-- 
		--><div class="col two-thirds palm--bigger-than homepage--map-container">
			<figure id="homepage--map"></figure>
		</div>
	</div><div class="gw gw--rtl">
		<div class="col one-third push--desk--one-sixth lap--one-half palm--one-whole">
			<div class="cell colour--red">
				<h1 class="h2 h2--ruled"><a href="<?php echo get_permalink( get_option( 'page_for_posts') ) ?>">School News</a></h1>
				<?php 

				/**
				 * Query Latest News Posts
				 */
				
				$news = get_posts(  array(
					'numberposts' => 5,
					'category_name' => 'news'
				) );

				if ( count( $news ) ) : ?>

					<ol>
						<?php foreach ( $news as $key => $post ) : setup_postdata( $post ); ?>
							<li>
								<article class="gw">
									<time class="col one-fifth">
										<?php echo get_the_date("d.m"); ?>
									</time><!-- 
								 --><div class="col four-fifths">
								 		<h2 class="h4 post--title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
								 		<?php the_excerpt(); ?>
								 		<a href="<?php the_permalink(); ?>" class="more-link">Read More</a>
									</div><!-- .col.four-fifths -->
								</article>
							</li>
						<?php endforeach; ?>
					</ol>

					<a href="<?php echo get_permalink( get_option( 'page_for_posts') ); ?>">Archives &rarr;</a>
				
				<?php endif; ?>
			</div>
		</div><!-- 
		--><div class="col one-third lap--one-half palm--one-whole">
			<div class="cell colour--blue">
				<h1 class="h2 h2--ruled">School Events</h1>
				<ul>
					<li>Coming Soon&hellip;</li>
				</ul>
			</div>
		</div><!-- 
		--><div class="col one-sixth lap--one-half palm--one-whole homepage--staff">
			<div class="cell colour--dark">
				<h1 class="h2 h2--ruled"><a href="<?php socd_staff_page_url(); ?>">School Staff</a></h1>
				<?php socd_get_random_staff(); ?>
			</div>
		</div><!-- 
		--><?php

		if ( $locations = get_field( 'locations', $post->ID ) ) {

			echo '<ol class="homepage--vcard">';
		
			foreach ( $locations as $location ) { ?>
				<li class="cell colour--white">
					<?php socd_vcard(); ?>
				</li>
				<?php 
			}

			echo '</ol>';
		} ?>
		</div>
	</div><!-- .gw -->
</section>
<?php get_footer();