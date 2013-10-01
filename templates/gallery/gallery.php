<section class="gw gallery-page">
	<?php while( have_posts() ) : the_post(); ?>
		<header class="header">
			<h1 class="h1 site--title"><?php the_title(); ?></h1>
		</header>
		<div class="col">
			<ul class="gallery-page--media">
				<li class="gallery-page--media-item">
					<img src="http://placekitten.com/1280/800" width="1280" height="800"/>	
				</li>
				<li class="gallery-page--media-item">
					<img src="http://placekitten.com/1280/800" width="1280" height="800"/>	
				</li>
				<li class="gallery-page--media-item">
					<img src="http://placekitten.com/1280/800" width="1280" height="800"/>	
				</li>
			</ul>		
		</div>
		<div class="col one-quarter">
			<div class="cell colour--blue">				
				<ul class="gallery-page--meta">
					<li>By: <a href="">This person</a></li>
					<li>More: <a href="">Information</a></li>
					<li>Or: <a href="">Links</a></li>
				</ul>
			</div>			
		</div><!--
		--><div class="col one-half">
			<div class="cell gallery-page--info wysiwyg colour--white">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, harum, veniam ad voluptate aperiam cumque itaque iusto sit alias excepturi sequi ratione cum magni modi enim nihil minus quis facere!</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, harum, veniam ad voluptate aperiam cumque itaque iusto sit alias excepturi sequi ratione cum magni modi enim nihil minus quis facere!</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, harum, veniam ad voluptate aperiam cumque itaque iusto sit alias excepturi sequi ratione cum magni modi enim nihil minus quis facere!</p>
			</div>
			<div class="cell gallery-page--back">
				<a href="#back">&larr; Back to Gallery</a>
			</div>	
		</div><!--
		--><div class="col one-quarter">
			<div class="cell colour--red gallery-page--controls">
				<p class="h2--ruled">
					<a href="">1</a>
					<a href="">2</a>
					<a href="">3</a>
					<a href="">4</a>
					<a href="">5</a>
				</p>
			</div>
		</div>
	</div>
	<?php endwhile; ?>
</section>
	