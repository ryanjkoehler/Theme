<?php
/**
 * Template Name: Staff
 * 
 * Archive of the staff
 * 
 */
get_header(); ?>
<div class="gw">
	<section>
		<header class="header">
			<h1 class="h1 header__title">Staff Profiles</h1>
		</header>
		
		<ul class="col col-two-thirds h-center listing__profiles">
			<?php

			for ($i=0; $i < 12; $i++) :

				?><li itemscope itemtype="http://schema.org/Person" class="profile col col-one-quarter">
					<img class="thumb" itemprop="image" src="http://placehold.it/150x150" alt="Staff Name"/>
					
					<div class="profile--info">
						<h1 class="name" itemprop="name">Staff Name</h1>
						<h2 class="role" itemprop="jobTitle">Role</h2>

						<p>Year of Teaching</p>
					</div>
				</li><?php

			endfor; ?>
		</ul>
	</section>
</div>
<?php get_footer();