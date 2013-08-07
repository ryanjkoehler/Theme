<?php
/**
 * Template Name: Home
 * 
 */
get_header(); ?>
<div class="gw">
	<header class="header">
		<h1 class="h1 site--title"><?php bloginfo('description'); ?></h1>
	</header>
	<div class="col col-half" style="position: relative; z-index: 1;">
		<div class="gw">
			<div class="col">
				<div class="cell colour--dark">
					<p class="h3 h3--ruled">
						Welcome to the School of Communication Design at University for the Creative Arts. The School is made up up thirteen courses and spread over three campus sites in Surrey and Kent.
					</p>
					<p>This is our new site, it's not set to launch until September, so consider this an early preview. Bit's are missing and undoubtedly there will be bugs. But we believe there's some value in building this out in the open.</p>
					<a href="http://make.socd.io">Read More &rarr;</a>
				</div>
			</div>
			<div class="col col-two-thirds">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Joanna_Louise_Bird__BA_(Hons)_Graphic_Design__UCA_Epsom_image.jpg" alt=""/>
				<div class="cell colour--green">
					<h2 class="h2 h3--ruled">View the Gallery</h2>
				</div>
			</div>

		</div>
	</div><!-- 
	--><div class="col col-two-thirds homepage--map">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/map.png" alt="">
	</div>
</div><div class="gw gw--rtl">
	<div class="col col-third push--col-one-sixth">
		<div class="cell colour--red">
			<h1 class="h2 h2--ruled">School News</h1>
			<ol>
				<li>
					<article class="gw">
						<time class="col col-one-fifth">03.06</time><!-- 
						--><div class="col col-four-fifths">
							<h2 class="h4">TEDx comes to Farnham &amp; UCA</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse feugiat, felis eget eleifend porta, mi mi iaculis quam, sit amet pharetra ante massa sed magna. Morbi vulputate augue quis nibh cursus sed accumsan massa sodales.</p>
							<a href="#">Read More</a>
						</div>
					</article>
				</li>
				<li>
					<article class="gw">
						<time class="col col-one-fifth">03.06</time><!-- 
						--><div class="col col-four-fifths">
							<h2 class="h4">TEDx comes to Farnham &amp; UCA</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse feugiat, felis eget eleifend porta, mi mi iaculis quam, sit amet pharetra ante massa sed magna. Morbi vulputate augue quis nibh cursus sed accumsan massa sodales.</p>
							<a href="#">Read More</a>
						</div>
					</article>
				</li>
			</ol>

		</div>
	</div><!-- 
	--><div class="col col-third">
		<div class="cell colour--blue">
			<h1 class="h2 h2--ruled">School Events</h1>
			<ul>
				<li>
					<div class="gw">
						<div class="col-one-quarter">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/white.png" class="avatar" alt=""/>
						</div><!--
						--><div class="col-three-quarters">
							<h2 class="h4">Research Conference:</h2>
							<p>Creative Responses to a Changing&nbsp;World</p>
						</div>
					</div>
				</li>
				<li>
					<div class="gw">
						<div class="col-one-quarter">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/white.png" class="avatar" alt=""/>
						</div><!--
						--><div class="col-three-quarters">
							<h2 class="h4">Lecture Series: Developing Narrative</h2>
							<p>We’re lucky to have the prolific speaker Lucy Davis at Farnham to talk about her process when developing...</p>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div><!-- 
	--><div class="col col-sixth">
		<div class="cell colour--dark">
			<h1 class="h2 h2--ruled">School Staff</h1>
			<a href="#" class="col-half">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/white.png" class="avatar" alt=""/>
			</a><!-- 
			--><a href="#" class="col-half">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/white.png" class="avatar" alt=""/>
			</a><!-- 
			--><a href="#" class="col-half">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/white.png" class="avatar" alt=""/>
			</a><!-- 
			--><a href="#" class="col-half">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/white.png" class="avatar" alt=""/>
			</a><!-- 
			-->
		</div>
	</div><!-- 
	-->
</div><!-- .gw -->
<?php get_footer();