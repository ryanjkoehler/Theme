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
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body palm-cell gw">			
			<div class="comment-body--actions col col-one-sixth">
				<?php echo get_avatar( $comment, 50 ); ?>				
				<div class="comment-actions">
					<?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->
			</div><!--
		--><div class="comment-body--main col col-five-sixths">
				<footer class="comment-body--comment-meta">
					<div class="vcard col col-five-sixths">
							<h5 class="h5"><?php echo get_comment_author_link(); ?> </h5>
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php echo get_comment_date(); ?> 
									<?php echo get_comment_time(); ?>
								</time>
							</a>
					</div><!--
				--><div class="comment-body--reply h5 col col-one-sixth">
						<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation">Your comment is awaiting moderation.</p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->
				<div class="col comment-body--comment-content wysiwyg">
					<?php comment_text(  ); ?>
				</div><!-- .comment-content -->
			</div>			
		</article><!-- .comment-body -->

	<?php
	endif;