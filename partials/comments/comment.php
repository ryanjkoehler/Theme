<?php
/**
 * Individual Comments
 * 
 * @package socd
 */
if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'modernshows' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'modernshows' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else :

	?><li id="comment-<?php comment_ID(); ?>" <?php comment_class( array( empty( $args['has_children'] ) ? '' : 'parent', 'comment') ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body palm-cell">
			<footer class="comment-meta">
				<div class="vcard h5">
					<?php printf( __( '%s', 'modernshows' ), sprintf( '<cite class="fn comment--author">%s</cite>', get_comment_author_link() ) ); ?>
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'modernshows' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
				
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<?php edit_comment_link( __( 'Edit', 'modernshows' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'modernshows' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<div class="reply h5">
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- .comment-body -->

	<?php
	endif;