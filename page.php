<?php 
/**
 * Default Page template
 * 
 */
 get_header(); ?>
<div class="gw">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>

			<?php 
			/**
			 * Subpages menu
			 */
			
			$subpages = wp_list_pages( array (
				'child_of' => get_post_parent_id(),
				'echo'	   => 0
			) );

			if ( $subpages ) : ?>
			<div class="col--side">
				<div class="cell colour--blue">
					<?php echo $subpages ?>
				</div>
			<?php endif; ?>
			<footer>
				<?php edit_post_link( __('Edit', 'socd') ); ?>
			</footer>
		</article>
	<?php endwhile; ?>
</div>
<?php get_footer(); ?>