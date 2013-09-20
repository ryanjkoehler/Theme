<?php 
/**
 * Post Template
 * 
 * Basic Post Template
 * 
 * @package SOCD
 */ ?>
<article <?php post_class( 'gw stream--article article' ); ?>>
	<?php socd_post_thumbnail(); ?>
	<aside class="col desk--one-fifth article--meta"> 
		<?php socd_posted_on(); ?>
		<?php if ( comments_open() && !is_single() ) : ?>
		<strong><?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'socd' ) . '</span>', __( '1 comment', 'socd' ), __( '% comments', 'socd' ) ); ?></strong>
		<?php endif; ?>
		<?php edit_post_link( 'Edit', '<span class="admin">', '</span>' ); ?>
	</aside><!-- 
 --><div class="col desk--four-fifths">
		<header class="article--header">
			<h1 class="h2">
				<?php if( get_post_format() == 'link' && $href = get_post_meta( get_the_ID(), 'href', true ) ): ?>
					<a href="<?php echo $href; ?>">
				<?php else: ?>
					<a href="<?php the_permalink(); ?>">
				<?php endif; ?>
					<?php the_title(); ?>
				</a>
			</h1>
		</header>
		<div class="wysiwyg">
			<?php the_content( 'Read more' ); ?>
		</div>
	</div>
</article>
<?php do_action( 'socd_after_content' ); ?>
<?php comments_template('/templates/comments/comments.php'); ?>