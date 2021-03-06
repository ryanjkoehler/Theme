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
	<div class="stream">
		<section class="col--stream">
			<?php if ( apply_filters( 'socd_is_network', false ) ) do_action( 'socd_year_taxonomy' ); ?>
			<div class="cell colour--white">
				<div id="posts-container">
					<?php while( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'templates/post/post'); ?>
					<?php endwhile; ?>
				</div>
				<?php socd_paging_nav(); ?>
			</div>
		</section><!-- 
	 --><section class="col--side col--side__left">
			<?php if( is_active_sidebar( 'left_sidebar' ) || is_noticeboard() ): ?> 
				<div class="cell widget colour--blue">
					
					<h2 class="widget--title heading--ruled">Filter By</h2>
					<?php socd_blog_filter(); ?>
					
					<?php if ( ! dynamic_sidebar( 'left_sidebar' )  ) : ?>
						<h2 class="h2 heading--ruled">About</h2>
						<div class="wysiwyg">
							<?php bloginfo( 'description' ); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</section><!--
	 --><aside class="sidebar col--side col--side__right">
			<?php if( is_active_sidebar( 'blog_sidebar' ) ): ?> 
				<div class="cell colour--light-grey">
					<?php if ( dynamic_sidebar( 'blog_sidebar' ) ) : else : endif; ?>
				</div><!-- .cell.colour-0grey -->
			<?php endif; ?>
		</aside>
	</div>
</section><!-- .gw -->

<?php get_footer(); ?>