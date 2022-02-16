<?php
// exit if uninstall constant is not defined
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// delete the plugin options.
global $wpdb;

$sql_query = "DELETE FROM {$wpdb->prefix}postmeta WHERE meta_key LIKE 'rwpp_%'";
$wpdb->query( $sql_query ); // phpcs:ignore 