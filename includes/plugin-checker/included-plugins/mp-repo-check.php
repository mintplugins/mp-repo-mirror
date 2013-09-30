<?php
/**
 * This file contains a function which checks if the MP Repo plugin is installed.
 *
 * @since 1.0.0
 *
 * @package    MP Repo Mirror
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2013, Move Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */
 
/**
* Check to make sure the MP Repo Plugin is installed.
*
* @since    1.0.0
* @link     http://moveplugins.com/doc/plugin-checker-class/
* @return   array $plugins An array of plugins to be installed. This is passed in through the mp_core_check_plugins filter.
* @return   array $plugins An array of plugins to be installed. This is passed to the mp_core_check_plugins filter. (see link).
*/
if (!function_exists('mp_repo_plugin_check')){
	function mp_repo_plugin_check( $plugins ) {
		
		$add_plugins = array(
			array(
				'plugin_name' => 'MP Repo',
				'plugin_message' => __('You require the MP Repo plugin. Install it here.', 'mp_repo_mirror'),
				'plugin_filename' => 'mp-repo.php',
				'plugin_download_link' => 'http://moveplugins.com/repo/mp-repo/?downloadfile=true',
				'plugin_info_link' => 'http://moveplugins.com/plugins/mp-repo',
				'plugin_group_install' => true,
				'plugin_required' => true,
				'plugin_wp_repo' => true,
			)
		);
		
		return array_merge( $plugins, $add_plugins );
	}
}
add_filter( 'mp_core_check_plugins', 'mp_repo_plugin_check' );