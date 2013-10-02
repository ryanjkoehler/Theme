<?php 
/**
 * 
 */

$networks = socd_get_networks();

 ?><section class="widecolumn cell">
	<p>You're not far from being signed up, just let us know what course you're on below and we can get you signed up.</p>
	<ul>
		<?php foreach ( $networks as $network  ) {

			if ( $network->id == 1 || is_null( $network->site_name ) )
				continue;

			printf(
					'<li><a href="//%2$s" class="button">%1$s</a></li>',
					$network->site_name,
					$network->domain . '/register'
				);
		} ?>
	</ul>
</section>