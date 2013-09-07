<?php 
/**
 * Post Template
 * 
 * Basic Post Template
 * 
 * @package SOCD
 */
?><article class="gw gw--rtl stream--article article">
	<?php socd_post_thumbnail(); ?>
	<div class="col five-sixths">
		<header class="article--header">
			<h1 class="h2">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h1>
		</header>
		<div class="wysiwyg">
			<?php the_content( 'Read more' ); ?>
		</div>
	</div><!--
	--><aside class="col one-sixth article--meta"> 
		<?php socd_posted_on(); ?>
		<?php edit_post_link( 'Edit', '<span class="admin">', '</span>' ); ?>
	</aside>
</article>
<?php do_action( 'socd_after_content' ); ?>
<?php comments_template('/templates/comments/comments.php'); ?>