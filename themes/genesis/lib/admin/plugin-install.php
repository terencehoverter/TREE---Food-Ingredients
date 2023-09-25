<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Admin
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

add_filter( 'plugins_api_result', 'genesis_admin_plugins_api_result', 10, 3 );
/**
 * Filter the results of the plugin api results.
 *
 * Only sort the results if users are searching for StudioPress plugins.
 *
 * @since 2.10.0
 *
 * @param object $res    Plugins API result object.
 * @param string $action The type of information being requested from the Plugin Installation API.
 * @param object $args   Plugin API arguments.
 *
 * @return object $res The plugin api result.
 */
function genesis_admin_plugins_api_result( $res, $action, $args ) {
	if ( isset( $args->author ) && 'studiopress' === $args->author ) {
		usort( $res->plugins, 'genesis_admin_plugins_sort_callback' );

		// Bring Genesis Blocks to the top.
		foreach ( $res->plugins as $key => $plugin ) {
			$plugin_data = (array) $plugin;
			if ( 'genesis-blocks' === $plugin_data['slug'] ) {
				unset( $res->plugins[ $key ] );
				array_unshift( $res->plugins, $plugin );
			}
		}
	}

	return $res;
}

/**
 * Sort Genesis plugins returned by plugins api by install count.
 *
 * @since 2.10.0
 *
 * @param array|object $a First plugin info to compare.
 * @param array|object $b Second plugin info to compare.
 */
function genesis_admin_plugins_sort_callback( $a, $b ) {
	$a = (array) $a;
	$b = (array) $b;

	if ( $a['active_installs'] === $b['active_installs'] ) {
		return 0;
	}

	return $a['active_installs'] > $b['active_installs'] ? -1 : 1;
}
