<?php
/*
Plugin Name: Hotfix
Description: Provides "hotfixes" for selected WordPress bugs, so you don't have to wait for the next WordPress core release. Keep the plugin updated!
Version: 0.5-beta
Author: Mark Jaquith
Author URI: http://coveredwebservices.com/
*/

function wp_hotfix_init() {
	global $wp_version;

	$hotfixes = array();

	add_option( 'hotfix_version', '1' );

	switch ( $wp_version ) {
		case '3.1' :
			$hotfixes = array( '310_parsed_tax_query', '310_pathinfo_custom_tax_rules' );
			break;
		case '3.0.5' :
			$hotfixes = array( '305_comment_text_kses' );
			break;
	}

	$hotfixes = apply_filters( 'wp_hotfixes', $hotfixes );

	foreach ( (array) $hotfixes as $hotfix ) {
		call_user_func( 'wp_hotfix_' . $hotfix );
	}

	register_deactivation_hook( __FILE__, 'wp_hotfix_deactivate' );
	register_uninstall_hook( __FILE__, 'wp_hotfix_uninstall' );
}

add_action( 'init', 'wp_hotfix_init' );

function wp_hotfix_deactivate() {
	delete_option( 'hotfix_version' );
}

function wp_hotfix_uninstall() {
	wp_hotfix_deactivate(); // The same, for now
}

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

function wp_hotfix_310_pathinfo_custom_tax_rules() {
	add_filter( 'rewrite_rules_array', 'wp_hotfix_310_pathinfo_custom_tax_rules_filter' );
	add_filter( 'term_link', 'wp_hotfix_310_pathinfo_custom_tax_rules_replace' );
	if ( is_admin() && version_compare( '2', get_option( 'hotfix_version' ), '>' ) )
		add_action( 'admin_head', 'wp_hotfix_310_pathinfo_custom_tax_rules_upgrade' );
}

	function wp_hotfix_310_pathinfo_custom_tax_rules_filter( $rules ) {
		$newrules = array();
		foreach ( $rules as $k => $v ) {
			$newrules[wp_hotfix_310_pathinfo_custom_tax_rules_replace($k)] = $v;
		}
		return $newrules;
	}

	function wp_hotfix_310_pathinfo_custom_tax_rules_replace( $string ) {
		global $wp_rewrite;
		$front = substr( $wp_rewrite->front, 1 );
		return str_replace( $front . $wp_rewrite->root, $front, $string );
	}

	function wp_hotfix_310_pathinfo_custom_tax_rules_upgrade() {
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
		update_option( 'hotfix_version', 2 );
	}
