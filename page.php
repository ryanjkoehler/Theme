<?php 
/**
 * Default Page template
 * 
 * @package  socd
 */
 get_header(); ?>
<div class="gw">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class("page h-center"); ?>>

			<header class="header">
				<h1 class="h1 site--title">
					<?php the_title(); ?>
				</h1><!-- .h1.header__title -->
			</header><!-- .header -->

			<figure class="page--thumbnail">
				<?php the_post_thumbnail( 'large' ); ?>
			</figure>

			<div class="page--main">
				<div class="cell colour--white">
					<?php the_content(); ?>
				</div>
			</div><!-- .col--page --><?php 

			/**
			 * Subpages menu
			 */
			
			$subpages = wp_list_pages( array (
				'child_of' => get_post_parent_id(),
				'echo'	   => 0
			) );

			if ( $subpages ) :

				?><div class="page--aside">
					<div class="cell colour--blue">
						<?php echo $subpages ?>
					</div>
				</div><!-- .page--aside -->
			<?php endif; ?>
		</article><!-- #post<?php the_ID(); ?> -->
	<?php endwhile; ?>
</div>
<?php get_footer(); ?>