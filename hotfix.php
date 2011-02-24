<?php
/*
Plugin Name: Hotfix
Description: Provides "hotfixes" for selected WordPress bugs, so you don't have to wait for the next WordPress core release. Keep the plugin updated!
Version: 0.4
Author: Mark Jaquith
Author URI: http://coveredwebservices.com/
*/

function wp_hotfix_init() {
	global $wp_version;

	$hotfixes = array();

	switch ( $wp_version ) {
		case '3.1' :
			$hotfixes = array( '310_parsed_tax_query' );
			break;
		case '3.0.5' :
			$hotfixes = array( '305_comment_text_kses' );
			break;
	}

	$hotfixes = apply_filters( 'wp_hotfixes', $hotfixes );

	foreach ( (array) $hotfixes as $hotfix ) {
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

function wp_hotfix_310_parsed_tax_query() {
	add_filter( 'pre_get_posts', 'wp_hotfix_310_parsed_tax_query_pre_get_posts' );
}

	function wp_hotfix_310_parsed_tax_query_pre_get_posts( $q ) {
		@$q->parsed_tax_query = false; // Force it to be re-parsed.
		return $q;
	}
