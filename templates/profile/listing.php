<?php 
/**
 * 
 * @package  socd
 */

global $user;

?><li itemscope itemtype="http://schema.org/Person" class="listing--profile profile__<?php echo is_student() ? "student" : "staff"; ?> col lap--one-third desk--one-fifth" <?php socd_user_match_current_course(); ?> data-year="<?php socd_year_code(); ?>" data-course="<?php socd_course_code(); ?>" data-campus="">
	<a href="<?php profile_url(); ?>" class="thumbnail col palm--one-third">
		<?php echo socd_get_profile_thumbnail(); ?>
	</a>
	<div class="col palm--two-thirds profile--info">
		<h1 class="name" itemprop="name"><?php echo $user->display_name; ?></h1>
		<?php if ( $role = get_user_meta( $user->ID, 'socd_role', true ) ) : ?>
		<h2 class="role" itemprop="jobTitle"><?php echo $role; ?></h2>
		<?php endif; ?>
		
		<p><?php socd_course(); ?></p>
		<p class="year"><?php socd_enrolment_year(); ?></p>
	</div>
</li><?php 