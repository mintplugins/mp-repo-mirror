<?php
/**
 * This file contains the function hooks for the MP Repo Mirror Plugin
 *
 * @link http://moveplugins.com/doc/mp-repo-mirror/
 * @since 1.0.0
 *
 * @package    MP Repo Mirror
 * @subpackage Classes
 *
 * @copyright  Copyright (c) 2013, Move Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */
 
/**
 * This function attaches to the theme filter (mp_core_theme_update_package_url) and replaces the API URL with another API URL defined in settings
 *
 * @access   public
 * @since    1.0.0
 * @see      mp_core_get_option()
 * @param    string $api_url Passed to this function by the 'mp_core_theme_update_package_url' filter.
 * @return   void
 */
function mp_repo_mirror_theme_api_change( $api_url ){
	
	//If the URL we want to replace is found in this plugin's api URL
	if ( strpos( $api_url, mp_core_get_option( 'mp_repo_mirror_settings_general',  'url_to_search') !== false ) ){
		
		//Replace the URL with the one we defined in our settings
		$api_url = str_replace( mp_core_get_option( 'mp_repo_mirror_settings_general',  'url_to_search'), mp_core_get_option( 'mp_repo_mirror_settings_general',  'replacement_url') );
	}
	
	return $api_url;
	
}
add_filter( 'mp_core_theme_update_package_url', 'mp_repo_mirror_theme_api_change' );

/**
 * This function attaches to the plugin filter (mp_core_plugin_update_package_url) and replaces the API URL with another API URL defined in settings
 *
 * @access   public
 * @since    1.0.0
 * @see      mp_core_get_option()
 * @param    string $api_url Passed to this function by the 'mp_core_theme_update_package_url' filter.
 * @return   void
 */
function mp_repo_mirror_plugin_api_change( $api_url ){
	
	//If the URL we want to replace is found in this plugin's api URL
	if ( strpos( $api_url, mp_core_get_option( 'mp_repo_mirror_settings_general',  'url_to_search') !== false ) ){
		
		//Replace the URL with the one we defined in our settings
		$api_url = str_replace( mp_core_get_option( 'mp_repo_mirror_settings_general',  'url_to_search'), mp_core_get_option( 'mp_repo_mirror_settings_general',  'replacement_url') );
	}
	
	return $api_url;
	
}
add_filter( 'mp_core_plugin_update_package_url', 'mp_repo_mirror_plugin_api_change' );