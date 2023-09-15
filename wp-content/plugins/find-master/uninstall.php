<?php
/**
 * Uninstall the plugin
 *
 * @package Find Master Plugin
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

global $wpdb;

$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name = 'FindMaster'" );
