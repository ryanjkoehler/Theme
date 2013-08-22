<?php 
/**
 * 
 * Profile page
 * 
 * Used to render staff and student profiles
 * 
 * @package  socd
 */

global $user;

?><header class="header">
	<h1 class="h1 site--title"><?php echo $user->data->display_name; ?></h1>
</header>
