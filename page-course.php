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
				<div class="col-half">
					<div class="cell colour--dark">
						<p class="h2"><?php the_field('introduction_text'); ?>
					</div>
				</div><!-- 
			 --><div class="col-half">
				 	<div class="cell about--gallery">
				 		<a href="/gallery" class="h2 h2--ruled">View Gallery</a>
				 		<img src="<?php echo get_stylesheet_directory_uri(); ?>/demo/surf.jpeg" alt="">
				 	</div>
				</div>
			 	<div class="col">
				 	<div class="gw">
					 	<div class="col col-one-third">
							<div class="cell colour--white">
								<h1 class="h2 h2--ruled"><?php the_title(); ?></h1>
								<div class="wysiwyg">
									<?php the_content(); ?>
								</div><!-- .wysiwyg -->
							</div>	
						</div><!-- 
					 --><div class="col col-one-third push--col-one-sixth">
							<div class="cell colour--blue">
								<h1 class="h2 h2--ruled">Course News</h1>
								<?php 

								/**
								 * 
								 *  Load Contents from the Blog's Feed
								 * 
								 */
								
								$news = new WP_Query( array(
									'post_type' => 'post',
									'category__in' => get_field('course_newsas')
								) );

								if ( $news->have_posts() ) : ?>
									<ul>
										<?php while ( $news->have_posts() ) : $news->the_post(); ?>
											<li>
												<?php get_template_part( 'templates/post/post'); ?>
											</li>
										<?php endwhile; ?>
									</ul>
								<?php endif; ?>
							</div>			 	
						</div><!-- 
					 --><div class="col col-one-sixth">
							<div class="cell colour--yellow">
								<h1 class="h2 h2--ruled">Apply to this course</h1>
								<p>UCAS Code<br/>
								<b><?php the_field('apply_code') ?></b>
								</p>
								<p>For more information on how to apply, visit our <a href="http://www.ucreative.ac.uk/" target="_blank">UCA&nbsp;site</a></p>
							</div>
							<div class="cell colour--red">
								<h1 class="h2 h2--ruled">Related Courses</h1>
								<ul class="listing__navigation">
									<li><a href="#">Course 1</a></li>
									<li><a href="#">Course 2</a></li>
									<li><a href="#">Course 3</a></li>
								</ul>
							</div>
						</div><!-- .col.col-one-sixth -->
			 		</div><!-- .gw -->
			 	</div>
			</div><!-- .col -->
		</article><!-- #post<?php the_ID(); ?> -->
	<?php endwhile; ?>
</div>
<?php get_footer(); ?>