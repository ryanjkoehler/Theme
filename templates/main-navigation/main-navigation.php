<nav class="main-navigation-container">
	<section class="navigation-notifications notifications main-navigation-container__openable">				
		<div class="notifications-center-display">
			<!-- populated with content formatted by the template /assets/templates/notifications/message.html -->
		</div>
	</section>
	<section class="navigation-quickpost quickpost main-navigation-container__openable">				
		<div class="quickpost--interface">
			
		</div>
	</section>	
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
	 			<h1 class="title"><a href="#"><?php echo socd_menu_course_title(); ?></a></h1>
	 		</div>
	 		<?php socd_site_menu(); ?>
	 	</li><!--
	 	<?php endif; ?>
	 	<?php if( socd_menu_has_blog_crumb() ): ?>
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
	 		<form role="search" method="get" action="http://test.socd.loc/">
				<input class="site-search__input" type="text" placeholder="Search" name="s">
				<input type="submit">
			</form>
		</li><!--
	 --><li class="main-navigation__menu-item main-navigation__menu-item--dropdown main-navigation__menu-item--profile <?php echo ( is_user_logged_in()) ? 'logged-in' : 'logged-out'; ?> ">
	 		<?php $user_info = get_userdata( get_current_user_id() ); ?>
			<div class="tab">
				<?php if( is_user_logged_in(  ) ): ?>
					<h1 class="title"><a href="wp-admin"><?php echo $user_info->display_name; ?></a></h1>
					<ul class="drop">
						<li class="drop__option"><a href="<?php echo wp_logout_url( get_permalink() ); ?>">Log Out</a></li>
					</ul>
				<?php else: ?>
					<h1 class="title"><a href="<?php echo wp_login_url( get_permalink() ); ?>">Login</a></h1>
					<div class="drop">
						<?php wp_login_form( array( 'form_id' => 'main-navigation--login-form' ) ); ?>
					</div>
				<?php endif; ?>
			</div>				
		</li>
		<!--<li class="main-navigation__menu-item main-navigation__menu-item--button main-navigation__menu-item--quickpost avoid-menu">
			<a href="#" class="title quickpost-activate">
				<span>+</span>
			</a>
		</li>-->
	</ul>
	<a href="#" class="main-navigation-container__mobile-toggle"></a>
</nav>