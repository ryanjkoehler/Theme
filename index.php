<?php
/**
 * 
 * @package SOCD
 */

get_header(); ?>
<section class="gw">
	<header class="header">
		<h1 class="h1 site--title"><a href="<?php bloginfo( 'wpurl' ); ?>"><?php bloginfo('name'); ?></a></h1>
		<h2 class="blog--title"><?php socdinfo('blog_type'); ?></h2>
	</header><!-- .header -->
	<section class="col--side col--side__left">
		<div class="cell colour--blue">
			<?php if (!dynamic_sidebar( 'left_sidebar' ) ) : ?>
	
				<h2 class="h2 h2--ruled">About</h2>
				<?php bloginfo( 'description' ); ?>

			<?php endif; ?>
		</div>
	</section><!-- 
	--><section class="col--stream stream">
		<div class="stream--filters">
			<ul>
				<li><a href="#" class="s-active">Year 1</a></li><!-- 
				--><li><a href="#">Year 2</a></li><!-- 
				--><li><a href="#">Year 3</a></li>
			</ul>
		</div>
		<div class="cell colour--white">

			<div id="posts-container">
				<?php while( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'partials/post/post'); ?>
				<?php endwhile; ?>
			</div>

			<?php wp_link_pages(); ?>
		</div>
	</section><!--
	--><aside class="sidebar col--side col--side__right">
		<div class="cell colour--light-grey">
			
			<?php if ( dynamic_sidebar( 'blog_sidebar' ) ) : else : endif; ?>
			
		</div><!-- .cell.colour-0grey -->
	</aside>
</section><!-- .gw -->

<?php get_footer(); ?>