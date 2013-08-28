<?php
/**
 * 
 * @package SOCD
 */

get_header(); ?>
<section class="gw">
	<header class="header">
		<h1 class="h1 header--title">Search Results</h1>
		<h2 class="blog--title">
			<?php echo $wp_query->found_posts; ?> found for '<?php echo $wp_query->query_vars['s']; ?>'
		</h2>
	</header><!-- .header -->
	<ul class="col two-thirds h-center listing__search-results">
		<?php while( have_posts() ) : the_post(); ?>
			<li class="gw listing--result<?php
				echo ( has_post_thumbnail() ) ? ' listing--result__thumbnail' : '' ;
				if( get_post_format() ): ?> listing--result__format-<?php echo get_post_format() ?><?php endif; 
			?>">				
				<div class="col one-third">
					<div class="result--heading">
						<h2 class="result--title h2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php if( has_post_thumbnail() ): ?>
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail(  array( 300, 300 ), $attr = '' ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div><!--
			 --><div class="col two-thirds last">
			 <!--
			 				<?php print_r( the_content() ); ?>
			 			-->
			 		<div class="result--excerpt wysiwyg">
			 			<?php if( has_post_format( 'image' ) ):
			 				$images = get_posts( 
			 					array(
				 					'numberposts' => 1,								
									'post_mime_type' => 'image',
									'post_parent' => $post->ID,
									'post_type' => 'attachment'
				 				),
				 				ARRAY_N
			 				);
			 				$src = $images[0]->guid;
			 			?>
							<img src="<?php echo $src; ?>" />
			 			<?php endif; ?>

						<?php the_excerpt(); ?>
					</div>
				</div>
				
			</li>
		<?php endwhile; ?>
	</ul>
</section><!-- .gw -->

<?php get_footer(); ?>