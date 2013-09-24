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
	<div class="col desk--two-thirds h-center">
		<ul class="cell colour--white listing__search-results">
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
				 				if( count( $images ) ):
				 					$src = $images[0]->guid;
				 			?>
								<img src="<?php echo $src; ?>" />
				 			<?php 
				 				endif;
				 			endif; 
				 			?>

							<?php 
								if( has_post_format( array( 'quote', 'link' ) ) ){
									the_content();
								} else {
									the_excerpt();
								}
							?>
						</div>
					</div>
					
				</li>
			<?php endwhile; ?>
		</ul>
		<footer class="cell colour--white pagination">
		<?php
			//see: http://codex.wordpress.org/Function_Reference/paginate_links#examples
			global $wp_query;

			$big = 999999999; // need an unlikely integer

			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages
			) );
		?>
		</footer>
	</div><!-- .col.desk--two-thirds -->
</section><!-- .gw -->
<?php get_footer(); ?>