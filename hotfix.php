<?php
/*
Plugin Name: Hotfix
Description: Provides "hotfixes" for WordPress bugs, in between WordPress updates. Keep the plugin updated!
Version: 0.1
Author: Mark Jaquith
Author URI: http://coveredwebservices.com/
*/

function cws_hotfix_init() {
	global $wp_version;

	switch ( $wp_version ) {
		case '3.0.5' :
			$hotfixes = array( '305_comment_text_kses' );
			break;
	}

	foreach ( $hotfixes as $hotfix ) {
		call_user_func( 'cws_hotfix_' . $hotfix );
	}
}

add_action( 'init', 'cws_hotfix_init' );

/* And now, the hotfixes */

function cws_hotfix_305_comment_text_kses() {
	if ( !is_admin() )
		remove_filter( 'comment_text', 'wp_kses_data' );
}
