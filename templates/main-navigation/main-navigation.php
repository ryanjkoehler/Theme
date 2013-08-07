<nav class="main-navigation-container">
	<ul class="main-navigation-container__fixed-size main-navigation no-style">
		<li class="main-navigation__menu-item main-navigation__menu-item--dropdown main-navigation__menu-item--breadcrumb main-navigation__menu-item--root">
			<div class="tab">
				<h1 class="title"><a href="/">SOCD.io</a></h1>
			</div>
			<ul class="drop">
				<li class="drop__option"><a href="#">Courses</a></li>
				<li class="drop__option"><a href="#">School Gallery</a></li>
				<li class="drop__option"><a href="#">All Staff</a></li>
				<li class="drop__option"><a href="#">All Students</a></li>
				<li class="drop__option"><a href="#">All Events</a></li>
				<li class="drop__option"><a href="#">Research</a></li>
			</ul>
		</li><!-- 
	 --><li class="main-navigation__menu-item main-navigation__menu-item--dropdown main-navigation__menu-item--breadcrumb">
			<div class="tab">
				<h1 class="title"><a href="#">Prototype</a></h1>
			</div>
			<ul class="drop">
				<li class="drop__option"><a href="/styleguide">Styleguide</a></li>
			</ul>
		</li><!--
	 --><li class="main-navigation__menu-item main-navigation__menu-item--dropdown main-navigation__menu-item--breadcrumb">
			<div class="tab">
				<h1 class="title"><a href="#">BA (Hons) Graphic Design</a></h1>
			</div>
			<ul class="drop">
				<li class="drop__option"><a href="#">Gallery</a></li>
				<li class="drop__option"><a href="#">Staff</a></li>
				<li class="drop__option"><a href="#">Students</a></li>
				<li class="drop__option"><a href="#">Event</a></li>
			</ul>
		</li><!--
	 --><li class="site-search main-navigation__menu-item main-navigation__menu-item--flexible main-navigation__menu-item--search avoid-menu">
			<input class="site-search__input" type="text" placeholder="Search">
		</li><!--
	 --><li class="main-navigation__menu-item main-navigation__menu-item--dropdown main-navigation__menu-item--profile">
	 		<?php $user_info = get_userdata( get_current_user_id() ); ?>
			<div class="tab">
				<?php if( is_user_logged_in(  ) ): ?>
					<h1 class="title"><a href="wp-admin"><?php echo $user_info->display_name; ?></a></h1>
					<ul class="drop">
						<li class="drop__option"><a href="<?php echo wp_logout_url( get_permalink() ); ?>">Log Out</a></li>
					</ul>
				<?php else: ?>
					<h1 class="title"><a href="wp-login.php">Login</a></h1>
					<div class="drop">
						<?php wp_login_form( array( 'form_id' => 'main-navigation--login-form' ) ); ?>
					</div>
				<?php endif; ?>
			</div>				
		</li>
		<li class="main-navigation__menu-item main-navigation__menu-item--button main-navigation__menu-item--quickpost avoid-menu">
			<a href="#" class="title quickpost-activate">
				<span>+</span>
			</a>
		</li>
	</ul>
	<section class="quickpost main-navigation-container__openable">				
		<h1>QUICKPOST</h1>
	</section>
	<a href="#" class="main-navigation-container__mobile-toggle"></a>
</nav>