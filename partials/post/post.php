<?php 
/**
 * Post Template
 * 
 * Basic Post Template
 * 
 * @package SOCD
 */
?><article class="gw gw--rtl stream--article">
	<div class="col col-five-sixths">
		<?php the_post_thumbnail(); ?>
		<h1 class="h2">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h1>
		<div class="wysiwyg">
			<?php the_content(); ?>
		</div>
	</div><!--
	--><aside class="col-one-sixth"> 
		<?php socd_posted_on(); ?>
	</aside>
</article>
<?php comments_template('/partials/comments/comments.php'); ?>