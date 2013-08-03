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
			<h5 class="h5 comment-body--author"><?php echo get_comment_author_link(); ?></h5>
			<div class="col comment-body--comment-content wysiwyg">				
				<?php comment_text(  ); ?>
			</div>
			<footer class="comment-body--comment-meta col col-two-thirds">
				<div class="vcard">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php echo get_comment_date(); ?> 
							<?php echo get_comment_time(); ?>
						</time>
					</a>
				</div>
			</footer><!--
		 --><div class="comment-body--edit col col-one-sixth">
		 		<div class="button button__edit-button">
					<?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?> 
				</div>
			</div><!--
		 --><div class="comment-body--reply col col-one-sixth">
				<div class="button button__action-button">
					<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>
			</div>
			<div class="comment-body--reply">
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation">Your comment is awaiting moderation.</p>
				<?php endif; ?>
			</div>
		</article>

	<?php
	endif;