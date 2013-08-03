<?php 
/**
 * 
 * @package socd
 */

require( get_stylesheet_directory() . '/inc/comments.php' );

if ( post_password_required() )
	return;
?>
<section id="comments" class="comments-section">
	<?php if ( have_comments() ) : ?>
	<header class="comments-section--header">	
		<h1 class="comments-section--count">
			<?php
				printf( _nx( 'One comment', '%1$s comments', get_comments_number(), 'comments title', 'socd' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>'); 
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
				<!-- <a href="#" class="pagintation-links--previous nav-previous">Older</a>
				<a href="#" class="pagintation-links--next nav-next">Newer</a> -->
				<?php paginate_comments_links('prev_text=Older&next_text=Newer'); ?>
			</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="comments-section--nocomments">Comments are closed.</p>
		<?php endif; ?>
	</header>
	<ol class="comments-listing">
		<?php
			/* Loop through and list the comments. Tell wp_list_comments()
			 * to use modernshows_comment() to format the comments.
			 * If you want to overload this in a child theme then you can
			 * define modernshows_comment() and that will be used instead.
			 * See modernshows_comment() in inc/template-tags.php for more.
			 */
			wp_list_comments( array(
				'callback' 	=> 'socd_comment',
				'format'   	=> 'html5',
				'style' 	=> 'ol'
			) );
		?>
	</ol><!-- .comment-list -->
	<footer class="comments-section--header comments-section--header__footer">	
			<h1 class="comments-section--count">
				<?php
					printf( _nx( 'One comment', '%1$s comments', get_comments_number(), 'comments title', 'socd' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>'); 
				?>
				<?php 
					$pages = get_comment_pages_count();	
					if( $pages > 1 && false ):
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
			<nav id="comment-nav-below" class="comments-section--navigation pagination-links" role="navigation">			
				<!-- <a href="#" class="pagintation-links--previous nav-previous">Older</a>
				<a href="#" class="pagintation-links--next nav-next">Newer</a> -->
				<?php paginate_comments_links('prev_text=Older&next_text=Newer'); ?>
			</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>	
	</footer>
	<?php endif; ?>
	<section class="comments-section--add-comment">
		<?php comment_form(); ?>
	</section>
</section>