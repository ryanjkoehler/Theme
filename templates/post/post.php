<?php 
/**
 * Post Template
 * 
 * Basic Post Template
 * 
 * @package SOCD
 */
?><article class="gw gw--rtl stream--article article">
	<div class="col five-sixths">
		<header class="article--header">
			<?php the_post_thumbnail(); ?>
			<h1 class="h2">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h1>
		</header>
		<div class="wysiwyg">
			<?php the_content( 'Read more' ); ?>
		</div>
	</div><!--
	--><aside class="one-sixth article--meta"> 
		<?php socd_posted_on(); ?>
	</aside>
</article>
<?php do_action( 'socd_after_content' ); ?>
<?php comments_template('/templates/comments/comments.php'); ?>