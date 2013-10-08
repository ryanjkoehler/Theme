<?php 
/**
 * 
 * @package  socd
 */

global $user;


?><li itemscope itemtype="http://schema.org/Person" class="profile--listing profile__<?php echo is_student() ? "student" : "staff" ?> col lap--one-third desk--one-fifth" <?php socd_user_match_current_course(); ?> data-year="<?php socd_year_code(); ?>" data-course="<?php socd_course_code(); ?>" data-campus="">

	<?php if ( is_student() ): ?>
		<?php if ( socd_user_has_blog( $user->ID ) ): ?>
			<a href="<?php socd_user_blog_url( $user->ID ) ?>" class="thumbnail col one-whole palm--one-third">
				<?php echo socd_get_profile_thumbnail() ?>
			</a>
		<?php else: ?>
			<?php echo socd_get_profile_thumbnail() ?>
		<?php endif ?>
	<?php else: ?>
		<a href="<?php profile_url() ?>" class="thumbnail col one-whole palm--one-third">
			<?php echo socd_get_profile_thumbnail() ?>
		</a>
	<?php endif ?>

	<div class="col palm--two-thirds profile--info">
		<?php if ( is_student() ): ?>
			<?php if ( socd_user_has_blog( $user->ID ) ): ?>
				<h1 class="name" itemprop="name"><a href="<?php socd_user_blog_url( $user->ID ) ?>"><?php echo $user->display_name ?> - <span>Blog</span></a></h1>
			<?php else: ?>
				<h1 class="name" itemprop="name"><?php echo $user->display_name ?></h1>
			<?php endif ?>
		<?php else: ?>
			<h1 class="name" itemprop="name"><a href="<?php profile_url() ?>"><?php echo $user->display_name ?></a></h1>
		<?php endif ?>
		
		<?php if ( $role = get_user_meta( $user->ID, 'socd_role', true ) ) : ?>
			<h2 class="role" itemprop="jobTitle"><?php echo $role ?></h2>
		<?php endif ?>
		
		<p><?php socd_course() ?></p>
	</div>
</li><?php 
