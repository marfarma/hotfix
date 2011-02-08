<?php
/*
Plugin Name: Hotfix
Description: Provides "hotfixes" for annoying WordPress bugs, so you don't have to wait for the next WordPress core release. Keep the plugin updated!
Version: 0.2-beta
Author: Mark Jaquith
Author URI: http://coveredwebservices.com/
*/

function wp_hotfix_init() {
	global $wp_version;

	switch ( $wp_version ) {
		case '3.0.5' :
			$hotfixes = array( '305_comment_text_kses' );
			break;
	}

	foreach ( $hotfixes as $hotfix ) {
		call_user_func( 'wp_hotfix_' . $hotfix );
	}
}

add_action( 'init', 'wp_hotfix_init' );

/* And now, the hotfixes */

function wp_hotfix_305_comment_text_kses() {
	remove_filter( 'comment_text', 'wp_kses_data' );
	if ( is_admin() )
		add_filter( 'comment_text', 'wp_kses_post' );
}
