<?php 
/**
 * 
 * @package socd
 */

require( get_stylesheet_directory() . '/inc/comments.php' );

if ( post_password_required() )
	return;
?>
<section id="comments">
	<?php if ( have_comments() ) : ?>
		<h1>
		<?php
			printf( _nx( 'One comment', '%1$s comments', get_comments_number(), 'comments title', 'socd' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>'); ?>
		</h1>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="navigation-comment" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'modernshows' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'modernshows' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'modernshows' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
	<?php endif; // check for comment navigation ?>

	<ol class="comments-listing">
		<?php
			/* Loop through and list the comments. Tell wp_list_comments()
			 * to use modernshows_comment() to format the comments.
			 * If you want to overload this in a child theme then you can
			 * define modernshows_comment() and that will be used instead.
			 * See modernshows_comment() in inc/template-tags.php for more.
			 */
			wp_list_comments( array(
				'callback' => 'socd_comment',
				'format'   => 'html5'
			) );
		?>
	</ol><!-- .comment-list -->
	<?php endif; ?>

</section>