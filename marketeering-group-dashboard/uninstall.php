<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://marketeeringgroup.com
 * @since      1.0.0
 *
 * @package    Marketeering_Group_Dashboard
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// function remove_editor_capability() {
// 	/**
// 	 * Removes access to the appearance menu for the Editor role
// 	 */
	$role = get_role( 'editor' );
	if ($role->capabilities["edit_theme_options"]) {
		$role->remove_cap('edit_theme_options');
	}
// }
// add_action('init', 'remove_editor_capability', 11);