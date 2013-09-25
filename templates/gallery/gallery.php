<section class="gw">
	<?php while( have_posts() ) : the_post(); ?>
	<header class="header">
		<h1 class="h1 site--title"><?php the_title(); ?></h1>		
		<h2 class="blog--title"><a href="<?php bloginfo( 'wpurl' ); ?>"><?php bloginfo('name'); ?></a></h2>
	</header><!-- .header -->
	<div class="col">
		<img src="vjnkefv/e/er.jpg" width="1280" height="800"/>
	</div>
	<?php endwhile; ?>
</section>
	