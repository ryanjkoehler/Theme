<?php 
/**
 * 
 * @package  socd
 */

global $user;


?><li itemscope itemtype="http://schema.org/Person" class="profile--listing profile__<?php echo is_student() ? "student" : "staff"; ?> col lap--one-third desk--one-fifth" <?php socd_user_match_current_course(); ?> data-year="<?php socd_year_code(); ?>" data-course="<?php socd_course_code(); ?>" data-campus="">
	<a href="<?php profile_url(); ?>" class="thumbnail col one-whole palm--one-third">
		<?php echo socd_get_profile_thumbnail(); ?>
	</a>

	<div class="col palm--two-thirds profile--info">
		<h1 class="name" itemprop="name"><a href="<?php profile_url(); ?>"><?php echo $user->display_name; ?></a></h1>
		<?php if ( $role = get_user_meta( $user->ID, 'socd_role', true ) ) : ?>
		<h2 class="role" itemprop="jobTitle"><?php echo $role; ?></h2>
		<?php endif; ?>
		
		<p><?php socd_course(); ?><br/>
		<?php if ( $url = socd_user_blog_link( $user->ID ) ) : ?>
			<a href="<?php echo $url; ?>">View blog</a>
		<?php endif; ?>
		</p>
		<p class="year"><?php socd_enrolment_year(); ?></p>
	</div>
</li><?php 
