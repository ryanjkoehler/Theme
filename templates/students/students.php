<?php
/**
 * Template Name: Student
 * 
 * Archive of the students
 * 
 */
get_header(); ?>
<div class="gw">
	<section>
		<header class="header">
			<h1 class="h1 header__title"><?php _e('Course Students', 'socd'); ?></h1>
		</header>
		
		<div class="col col-one-sixth">
			<div class="cell colour--blue">
				<h1 class="h2 h2--ruled">Filter by</h1>
				Year of Study
			</div>
		</div><!-- 
	--><ul class="col col-five-sixths listing__students">
			<?php

			for ($i=0; $i < 25; $i++) :

				?><li itemscope itemtype="http://schema.org/Person" class="listing--profile profile__student col col-one-fifth">
					<img class="thumb" itemprop="image" src="http://placehold.it/60x60" alt="Staff Name"/>
					
					<div class="profile--info">
						<h1 class="name" itemprop="name">Staff Name</h1>
						
						<p>Course Name</p>
						<p class="year">20xx</p>
					</div>
				</li><?php

			endfor; ?>
		</ul>
	</section>
</div>
<?php get_footer();