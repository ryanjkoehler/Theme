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
		<h1 class="h2">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h1>
		<div class="wysiwyg">
			<?php the_content(); ?>
		</div>
	</div><!--
	--><aside class="col-one-sixth"> 
		<time datetime="2013-06-17T16:44:32+01:00"><?php echo get_the_date(); ?></time>
		
		<?php  echo comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'socd' ) . '</span>', __( '1 Reply', 'socd' ), __( '% Replies', 'socd' ) ); ?>
		<p>Posted by<a href="#" class="author"><?php the_author(); ?></a></p> 
	</aside>	
</article>