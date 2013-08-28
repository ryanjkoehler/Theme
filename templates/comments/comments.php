<?php 
/**
 * 
 * @package socd
 */

require_once get_stylesheet_directory() . '/inc/comments.php';

global $wp_query, $post, $wpdb;

// Prevent unauthorised commenting
if ( post_password_required() ) return; ?>
<section id="comments" class="comments-section">
	<?php if ( have_comments() ) : ?>
	
	<header class="comments-section--header">	
		<h1 class="comments-section--count">
			<?php

				/**
				 *  Check comments amount..
				 * 
				 * Requires page reload as the $post item is cached, a hacky fix for something which is 
				 * likely a result of garbled importers.
				 */
				if ( count($wp_query->comments) > $post->comment_count ) {
					$post->comment_count = count( $wp_query->comments );
					$wpdb->query( $wpdb->prepare("UPDATE $wpdb->posts SET `comment_count` = %d WHERE `id` = %d", count($wp_query->comments), $post->ID ) );
				}
				
				comments_number();

			?>
			<?php 
				$pages = get_comment_pages_count();	
				if( $pages > 1 && false):
			?>
			over 
			<?php 
				printf( _nx( 'one page', '%1$s pages', $pages, 'comments title', 'socd' ), number_format_i18n( $pages ) ); 
			?>
			<?php 
				endif; 
			?>
		</h1>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-above" class="comments-section--navigation pagination-links" role="navigation">			
				<div class="pagination-links--links">
					<?php paginate_comments_links('prev_text=&nbsp;&next_text=&nbsp;'); ?>
				</div>
			</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="comments-section--nocomments">Comments are closed.</p>
		<?php endif; ?>
	</header>
	<ol class="comments-listing">
		<?php
			/* Loop through and list the comments. Tell wp_list_comments()
			 * to use socd_comment() to format the comments.
			 * If you want to overload this in a child theme then you can
			 * define socd_comment() and that will be used instead.
			 */
			wp_list_comments( array(
				'callback' 		=> 'socd_comment',
				'format'   		=> 'html5',
				'style' 		=> 'ol'
			) );


		?>
	</ol><!-- .comment-list -->
	<footer class="comments-section--header comments-section--header__footer">
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
				<nav id="comment-nav-below" class="comments-section--navigation pagination-links" role="navigation">
					<div class="pagination-links--links">
						<?php paginate_comments_links('prev_text=&nbsp;&next_text=&nbsp;'); ?>
					</div>
				</nav><!-- #comment-nav-above -->			
		<?php endif; // check for comment navigation ?>	
	</footer>

	<?php endif; ?>
	<div class="comments-section--add-comment">
		<?php comment_form(); ?>
	</div>
</section><!-- #comments.comments-section -->