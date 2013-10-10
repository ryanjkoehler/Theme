<?php 
/**
 * Template Name: Course
 * 
 * Used for showing an overview of the Course
 * 
 */
 get_header(); ?>
<div class="gw">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" class="page h-center">

			<header class="header">
				<h1 class="h1 site--title">
					<?php bloginfo('name'); ?>
				</h1><!-- .h1.header__title -->
			</header><!-- .header -->

			<figure class="page--thumbnail">
				<?php the_post_thumbnail( 'large' ); ?>
			</figure>

			<div class="gw">
				<div class="col one-half palm--one-whole">
					<div class="cell colour--dark">
						<p class="h2"><?php the_field('introduction_text'); ?>
					</div>
				</div><!-- 
			 --><?php /* <div class="col one-half palm--one-whole">
				 	<div class="cell about--gallery">
				 		<a href="/gallery" class="h2 heading--ruled"><?php _e('View Gallery', 'socd'); ?></a>
				 		<img src="<?php echo get_stylesheet_directory_uri(); ?>/demo/surf.jpeg" alt="">
				 	</div>
				</div> */ ?>
			 	<div class="col">
				 	<div class="gw">
					 	<div class="col one-third palm--one-whole">
							<div class="cell colour--white">
								<h1 class="h2 heading--ruled"><?php the_title(); ?></h1>
								<div class="wysiwyg">
									<?php the_content(); ?>
								</div><!-- .wysiwyg -->
							</div>	
						</div><!-- 
					 --><div class="col one-third palm--one-whole push--desk--one-sixth">
							<div class="cell colour--blue about--news-feed">
							<?php 

								$get_slug = get_category( get_field('news_category') );
						 		$news_slug = isset( $get_slug->slug ) ? $get_slug->slug : 'news';
								
								 ?>
								<h1 class="h2 heading--ruled"><?php printf('<a href="/category/%1$s">%2$s</a>', $news_slug, __('Course News','socd') ); ?></h1>
								<?php 

								/**
								 * 
								 *  Load Contents from the Blog's Feed
								 * 
								 */

						 		$news = new WP_Query( array(
									'post_type' => 'post',
									'category_name' => $news_slug
								) );

								if ( $news->have_posts() ) : ?>
									<ul>
										<?php while ( $news->have_posts() ) : $news->the_post(); ?>
											<li>
												<article class="news-feed--article gw">
													<aside class="news-feed--meta col one-quarter">
														<?php echo esc_html( get_the_date( 'j.m.y') ); ?>
													</aside><!--
												 --><header class="news-feed--title col three-quarters">
														<h1 class="h2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
													</header>
													<section class="news-feed--content wysiwyg col three-quarters push--one-quarter">
														<?php the_excerpt(); ?>
													</section>
												</article>
											</li>
										<?php endwhile; ?>
									</ul>
									<?php wp_reset_postdata(); ?>
								<?php endif; ?>
							</div>			 	
						</div><!-- 
					 --><div class="col one-sixth palm--one-whole lap--one-third push--desk--one-sixth">
							<?php

								$children = get_children( array(
									'post_parent' 	=> $post->ID,
									'post_type' 	=> 'page'
								) );
								?>
								<div class="cell colour--white">
						 			<h2 class="h2 heading--ruled">Explore</h2>
									<ul class="listing__navigation">
										<li><a href="/staff"><?php _e('Course Staff', 'socd' ); ?></a></li>
										<li><a href="/students"><?php _e('Course Students', 'socd' ); ?></a></li>
									<?php 
	
									if ( is_array( $children ) && count( $children ) ) :
										foreach ( $children as $child ) {
											printf('<li><a href="%1$s">%2$s</a></li>', get_permalink( $child->ID ),$child->post_title );
										}
									endif;
									 ?>
									</ul>
								</div>
							<div class="cell colour--yellow">
								<h1 class="h2 heading--ruled">Apply to this course</h1>
								<?php if ( $ucas_code = get_field( 'ucas_code' ) ) printf( '<p>UCAS Code<br/><b>%1$s</b></p>', $ucas_code ); ?>
								<p>For more info on how to apply, visit our <a href="<?php the_field( 'ucreative_course_page' ); ?>" target="_blank">UCA&nbsp;site</a></p>
							</div>
							<div class="cell colour--red course--listing">
								<h1 class="h2 heading--ruled"><?php _e( 'Other Courses', 'socd' ); ?></h1>
								<?php socd_network_listing(); ?>
							</div>
						</div><!-- .col.one-sixth -->
			 		</div><!-- .gw -->
			 	</div>
			</div><!-- .col -->
		</article><!-- #post<?php the_ID(); ?> -->
	<?php endwhile; ?>
</div>
<?php get_footer(); ?>