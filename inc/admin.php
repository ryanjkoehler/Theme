<?php 
/**
 * 
 * Handles modifications to the WordPress dashboard and some of it's
 * quirky pages.
 * 
 * @package  socd
 */

function socd_signup_style() {
	global $wp_filter;
	remove_action( 'wp_head', 'wpmu_signup_stylesheet' );
	remove_action( 'wp_head', 'wpmu_activate_stylesheet' );
}
add_action( 'wp_head', 'socd_signup_style', 1 );

function socd_signup_page() {
	require_once get_stylesheet_directory() . "/templates/signup/signup.php";
}
add_action('before_signup_form', 'socd_signup_page');

/**
 * Customisations to the Login form
 * 
 */

function socd_login_url() {
	return get_bloginfo( 'wpurl' );
}
add_filter( 'login_headerurl', 'socd_login_url' );

function socd_admin_styles() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/assets/stylesheets/admin.css' );
}
add_filter( 'admin_head', 'socd_admin_styles' );
add_filter( 'login_head', 'socd_admin_styles' );

function socd_admin_footer() {
	printf(
		'&copy; %d<a href="%s">School of Communication Design</a>',
		date( 'Y' ),
		get_bloginfo( 'wpurl' )
	);
}

function socd_dashboard_tidy() {
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
}
add_action( 'wp_dashboard_setup', 'socd_dashboard_tidy' );

function socd_dashboard_commits() {

	global $wp_meta_boxes;

	wp_add_dashboard_widget( 'socd_commit_widget', 'Latest Commits to the School of Communication Design', 'socd_dashboard_commits_widget' );

	$widget = $wp_meta_boxes['dashboard']['normal']['core']['socd_commit_widget'];

	unset( $wp_meta_boxes['dashboard']['normal']['core']['socd_commit_widget'] );

	$wp_meta_boxes['dashboard']['side']['core']['socd_commit_widget'] = $widget;
}
add_action( 'wp_dashboard_setup', 'socd_dashboard_commits');

function socd_dashboard_commits_widget() { ?>
	<div class="github-widget">
		<?php socd_widget_rss_output( array(
			'url' => "https://github.com/socd-io/Theme/commits/master.atom",
			'items' => 3,
			'show_data' => 1,
			'show_author' => 1
		) ); ?>
	</div>
	<?php 
}


/**
 * Display the RSS entries in a list.
 *
 * @since 2.5.0
 *
 * @param string|array|object $rss RSS url.
 * @param array $args Widget arguments.
 */
function socd_widget_rss_output( $rss, $args = array() ) {
	if ( is_string( $rss ) ) {
		$rss = fetch_feed($rss);
	} elseif ( is_array($rss) && isset($rss['url']) ) {
		$args = $rss;
		$rss = fetch_feed($rss['url']);
	} elseif ( !is_object($rss) ) {
		return;
	}

	if ( is_wp_error($rss) ) {
		if ( is_admin() || current_user_can('manage_options') )
			echo '<p>' . sprintf( __('<strong>RSS Error</strong>: %s'), $rss->get_error_message() ) . '</p>';
		return;
	}

	$default_args = array( 'show_author' => 0, 'show_date' => 0, 'show_summary' => 0 );
	$args = wp_parse_args( $args, $default_args );
	extract( $args, EXTR_SKIP );

	$items = (int) $items;
	if ( $items < 1 || 20 < $items )
		$items = 10;
	$show_summary  = (int) $show_summary;
	$show_author   = (int) $show_author;
	$show_date     = (int) $show_date;

	if ( !$rss->get_item_quantity() ) {
		echo '<ul><li>' . __( 'An error has occurred, which probably means the feed is down. Try again later.' ) . '</li></ul>';
		$rss->__destruct();
		unset($rss);
		return;
	}

	echo '<ul>';
	foreach ( $rss->get_items(0, $items) as $item ) {
		$link = $item->get_link();
		while ( stristr($link, 'http') != $link )
			$link = substr($link, 1);
		$link = esc_url(strip_tags($link));
		$title = esc_attr(strip_tags($item->get_title()));
		if ( empty($title) )
			$title = __('Untitled');

		$desc = str_replace( array("\n", "\r"), ' ', esc_attr( strip_tags( @html_entity_decode( $item->get_description(), ENT_QUOTES, get_option('blog_charset') ) ) ) );
		$excerpt = wp_html_excerpt( $desc, 360 );

		// Append ellipsis. Change existing [...] to [&hellip;].
		if ( '[...]' == substr( $excerpt, -5 ) )
			$excerpt = substr( $excerpt, 0, -5 ) . '[&hellip;]';
		elseif ( '[&hellip;]' != substr( $excerpt, -10 ) && $desc != $excerpt )
			$excerpt .= ' [&hellip;]';

		$excerpt = esc_html( $excerpt );

		if ( $show_summary ) {
			$summary = "<div class='rssSummary'>$excerpt</div>";
		} else {
			$summary = '';
		}

		$date = '';
		if ( $show_date ) {
			$date = $item->get_date( 'U' );

			if ( $date ) {
				$date = ' <span class="rss-date">' . date_i18n( get_option( 'date_format' ), $date ) . '</span>';
			}
		}

		$author = '';
		if ( $show_author ) {
			$author = $item->get_author();
			$email = $author->email;
			if ( is_object($author) ) {
				$author = $author->get_name();
				$author = ' <cite>' . esc_html( strip_tags( $author ) ) . '</cite>';
			}
		}

		if ( $link == '' ) {
			echo "<li>$title{$date}{$summary}{$author}</li>";
		} else {
			echo "<li>" . get_avatar( $email, 50 ) . "<a class='rsswidget' href='$link' title='$desc'>$title</a>{$date}{$summary}{$author}</li>";
		}
	}
	echo '</ul>';
	$rss->__destruct();
	unset($rss);
}
