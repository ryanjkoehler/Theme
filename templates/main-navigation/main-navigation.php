
	<?php // socd_template_part('notifications'); ?>
	<?php // socd_template_part('quickpost'); ?>
	<ul class="main-navigation-container__fixed-size main-navigation no-style">
		<li class="main-navigation__menu-item main-navigation__menu-item--dropdown main-navigation__menu-item--breadcrumb main-navigation__menu-item--root">
			<div class="tab">
				<h1 class="title"><a href="http://socd.io">SOCD.io</a></h1>
				<?php socd_network_menu(); ?>
			</div>
		</li><!-- 
	 	<?php if( socd_menu_has_course_crumb() ): ?>
	 --><li class="main-navigation__menu-item main-navigation__menu-item--breadcrumb main-navigation__menu-item--dropdown">
	 		<div class="tab">
	 			<h1 class="title"><a href="#"><?php echo get_network_name(); ?></a></h1>
	 		</div>
	 		<?php socd_site_menu(); ?>
	 	</li><!--
	 	<?php endif; ?>
	 	<?php if( socd_menu_has_blog_crumb() && !is_network() ): ?>
	 --><li class="main-navigation__menu-item main-navigation__menu-item--breadcrumb main-navigation__menu-item--dropdown">
	 		<div class="tab">
	 			<h1 class="title"><a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'title' ); ?></a></h1>
	 		</div>
	 		<?php socd_blog_menu(); ?>
	 	</li><!--
	 	<?php endif; ?>
	 	<?php if( socd_menu_page_title() ): ?>
	 --><li class="main-navigation__menu-item main-navigation__menu-item--breadcrumb">
	 		<div class="tab">
	 			<h1 class="title"><a href="#"><?php echo socd_menu_page_title(); ?></a></h1>
	 		</div>
	 	</li><!--
	 	<?php endif; ?>
	 --><li class="site-search main-navigation__menu-item main-navigation__menu-item--flexible main-navigation__menu-item--search avoid-menu">
	 		<form role="search" method="get" action="http://test.socd.loc/" class="search-form">
				<input class="site-search__input search-form--input" type="text" placeholder="Search" name="s"><!--
			 --><span class="search-form--clear">
					<a href="#" class="search__clear"></a>
				</span><!--
			 --><span class="search-form--submit search__submit">
					<input type="submit" class="search-submit" value="Search" />
				</span>
			</form>
		</li><!-- 
	 --><li class="main-navigation__menu-item">
			<a href="/register" class="title"><?php _e('Register', 'socd'); ?></a>
		</li><!--
	 --><li class="main-navigation__menu-item main-navigation__menu-item--dropdown main-navigation__menu-item--profile <?php echo ( is_user_logged_in()) ? 'logged-in' : 'logged-out'; ?> ">
	 		<?php $user_info = get_userdata( get_current_user_id() ); ?>
			<div class="tab">
				<a class="title" href="<?php echo site_url( 'wp-login.php', 'login_post' ); ?>">Login</a></h1>
				<div class="drop">
					<?php wp_login_form( array( 'form_id' => 'main-navigation--login-form' ) ); ?>
				</div>
			</div>				
		</li>
	</ul>
	<a href="#" class="main-navigation-container__mobile-toggle"></a>
</nav>