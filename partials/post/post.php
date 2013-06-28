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
			<a href="#"><?php the_title(); ?></a>
		</h1>
		<?php the_content(); ?>
	</div><!--
	--><aside class="col-one-sixth"> 
		<time datetime="2013-06-17T16:44:32+01:00"><?php echo get_the_date(); ?></time>
		<p><a href="http://gd3.gdnm.org/2013/06/17/health-propaganda-competition/#respond" title="Comment on Health Propaganda Competition">No comments</a></p>
		<p><a href="#" class="author"><?php the_author(); ?></a></p> 
	</aside>	
</article>