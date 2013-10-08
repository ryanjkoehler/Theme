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
			<?php if ( has_post_thumbnail() ) : ?>
			<figure class="page--thumbnail">
				<?php the_post_thumbnail( 'large' ); ?>
			</figure><?php endif; ?><!-- 
		 --><div class="col lap--two-thirds push--desk--one-sixth desk--two-thirds">
				<div class="cell colour--white wysiwyg">
					<?php the_content(); ?>
					<?php wp_link_pages( array(
							'before' => '<p></p>',
							'after'  => '',
							'next_or_number' => 'next'
						) ); ?>
				</div>
			</div><!-- .col--page --><?php 

			/**
			 * Subpages menu
			 */
			
			$subpages = wp_list_pages( array (
				'child_of' => get_post_parent_id(),
				'echo'	   => 0,
				'title_li' => get_the_title( get_post_parent_id() )
			) );

			if ( $subpages ) :
				?><div class="col lap--one-third push--desk--one-sixth desk--one-sixth">
					<div class="cell colour--blue">
						<?php echo $subpages; ?>
					</div>
				</div><!-- .page--aside -->
			<?php endif; ?>
		</article><!-- #post<?php the_ID(); ?> -->
	<?php endwhile; ?>
</div>
<?php get_footer(); ?>