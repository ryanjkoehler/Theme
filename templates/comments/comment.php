<?php
/**
 * Individual Comments
 * 
 * @package socd
 */

global $comment;

if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'modernshows' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'modernshows' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else :

	?><li id="comment-<?php comment_ID(); ?>" <?php comment_class( array( empty( $args['has_children'] ) ? '' : 'parent', 'comment') ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body palm-cell gw">	
			<?php if( $depth > 1 ): //is a child comment ?>
			<div class="col col-one-sixth">
				&nbsp;
			</div><?php endif; ?><!--
		 --><div class="comment-body--avatar col <?php if( $depth <= 1 ): ?>col-one-sixth<?php endif; ?>">
					<?php echo get_avatar( $comment, 150 ); ?>
			</div><!--
			--><div class="col <?php if( $depth > 1 ): ?>col-two-thirds<?php else: ?>col-five-sixths<?php endif; ?>">
				<header class="comment-body--header">
					<h5 class="h5 comment-body--author"><?php echo get_comment_author_link(); ?></h5>
					<div class="comment-body--comment-meta">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php echo get_comment_date(); ?> 
								<?php echo get_comment_time(); ?>
							</time>
						</a>
					</div>
				</header>
				<div class="col comment-body--comment-content wysiwyg">				
					<?php comment_text(  ); ?>
					<?php if ( get_comment_meta( $comment->comment_ID, 'image', true ) ): ?>
						<?php echo wp_get_attachment_link( get_comment_meta( $comment->comment_ID, 'image', true ) ) ?>
					<?php endif ?>
				</div>
			 	<div class="comment-body--edit col col-one-sixth">
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
			</div>
		</article>

	<?php
	endif;