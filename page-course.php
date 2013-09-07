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
				<h1 class="h1 header__title">
					<?php bloginfo('name'); ?>
				</h1><!-- .h1.header__title -->
			</header><!-- .header -->

			<figure class="page--thumbnail">
				<?php the_post_thumbnail( 'large' ); ?>
			</figure>

			<div class="gw">
				<div class="one-half">
					<div class="cell colour--dark">
						<p class="h2"><?php the_field('introduction_text'); ?>
					</div>
				</div><!-- 
			 --><div class="one-half">
				 	<div class="cell about--gallery">
				 		<a href="/gallery" class="h2 h2--ruled">View Gallery</a>
				 		<img src="<?php echo get_stylesheet_directory_uri(); ?>/demo/surf.jpeg" alt="">
				 	</div>
				</div>
			 	<div class="col">
				 	<div class="gw">
					 	<div class="col one-third">
							<div class="cell colour--white">
								<h1 class="h2 h2--ruled"><?php the_title(); ?></h1>
								<div class="wysiwyg">
									<?php the_content(); ?>
								</div><!-- .wysiwyg -->
							</div>	
						</div><!-- 
					 --><div class="col one-third push--one-sixth">
					 	<?php 
					 		$news_slug =  ( $get_slug = get_category( get_field('news_category') )->slug ) ? $get_slug->slug : 'news';
					 	?>					 	
							<div class="cell colour--blue about--news-feed">
								<h1 class="h2 h2--ruled"><a href="<?php bloginfo('url') ?>/category/<?php echo $news_slug; ?>">Course News</a></h1>
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
					 --><div class="col one-sixth push--one-sixth">
							<div class="cell colour--yellow">
								<h1 class="h2 h2--ruled">Apply to this course</h1>
								<p>UCAS Code<br/>
								<b><?php the_field( 'ucas_code' ) ?></b>
								</p>
								<p>For more info on how to apply, visit our <a href="<?php the_field( 'ucreative_course_page' ); ?>" target="_blank">UCA&nbsp;site</a></p>
							</div>
							<div class="cell colour--red course--listing">
								<h1 class="h2 h2--ruled">Other Courses</h1>
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