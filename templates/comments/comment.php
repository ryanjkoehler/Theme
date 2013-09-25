<?php
/**
 * Individual Comments
 * 
 * @package socd
 */

global $comment, $depth, $args;

if ( ! is_array( $args ) ) $args = array();

?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( array( empty( $args['has_children'] ) ? '' : 'parent', 'comment') ); ?>>
		
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body palm-cell gw <?php echo $depth > 1 ? 'push--one-sixth' : ''; ?>">
			<div class="comment-body--avatar col <?php echo ( $depth <= 1 ) ? 'one-sixth' : 'one-sixth'; ?>">
				<?php echo get_avatar( $comment, 150 ); ?>
				<div class="button button__action-button">
					<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => isset( $args['max_depth'] ) ? $args['max_depth'] : 0 ) ) ); ?>
				</div>
			</div><!--
			--><div class="col <?php if( $depth > 1 ): ?>two-thirds<?php else: ?>five-sixths<?php endif; ?>">
				<header class="comment-body--header">
					<h5 class="h5 comment-body--author"><?php echo get_comment_author_link(); ?></h5>
					<div class="comment-body--comment-meta">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php echo get_comment_date(); ?> 
								<?php echo get_comment_time(); ?>
							</time>
						</a>
						<?php edit_comment_link( 'Edit', '<span class="edit-link">&nbsp; ', '</span>' ); ?> 
					</div>
				</header>
				<div class="col comment-body--comment-content wysiwyg">				
					<?php comment_text(); ?>
					<?php if ( get_comment_meta( $comment->comment_ID, 'image', true ) ): ?>
						<?php echo wp_get_attachment_link( get_comment_meta( $comment->comment_ID, 'image', true ) ) ?>
					<?php endif ?>
				</div><!-- 
				 --><?php if ( '0' == $comment->comment_approved ) :
					?><div class="comment-body--moderation col col-two-thirds">
						<p class="comment-awaiting-moderation">Your comment is awaiting moderation.</p>
					</div>
				<?php endif; ?>
				
			</div>	
		</article>
