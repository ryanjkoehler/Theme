<?php
/**
 * @package SOCD
 */

get_header(); ?>

<section class="gw">
	<section class="col--side">
		<div class="cell colour--blue">
			<h2 class="h2 h2--ruled">About</h2>
			<?php bloginfo( 'description' ); ?>
		</div>
	</section><!-- 
	--><section class="col--stream stream">
		<div class="cell colour--white">

			<div id="posts-container">
				<?php while( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'partials/post/post'); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</section><!--
	--><aside class="sidebar col--side">
		<div class="cell colour--light-grey">
			
			<?php if ( dynamic_sidebar( 'blog_sidebar' ) ) : else : endif; ?>
			
		</div><!-- .cell.colour-0grey -->
	</aside>
</section><!-- .gw -->

<?php get_footer(); ?>