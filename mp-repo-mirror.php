<?php
/*
Plugin Name: MP Repo Mirror
Plugin URI: http://moveplugins.com
Description: You can update your API site (running MP Repo) when this plugin is installed. 
Version: 1.4.02
Author: Move Plugins
Author URI: http://moveplugins.com
Text Domain: mp_repo_mirror
Domain Path: languages
License: GPL2
*/

/*  Copyright 2012  Phil Johnston  (email : phil@moveplugins.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Move Plugins Core.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Move Plugins Core, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/
// Plugin version
if( !defined( 'MP_REPO_MIRROR_VERSION' ) )
	define( 'MP_REPO_MIRROR_VERSION', '1.0.0.0' );

// Plugin Folder URL
if( !defined( 'MP_REPO_MIRROR_PLUGIN_URL' ) )
	define( 'MP_REPO_MIRROR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Plugin Folder Path
if( !defined( 'MP_REPO_MIRROR_PLUGIN_DIR' ) )
	define( 'MP_REPO_MIRROR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Plugin Root File
if( !defined( 'MP_REPO_MIRROR_PLUGIN_FILE' ) )
	define( 'MP_REPO_MIRROR_PLUGIN_FILE', __FILE__ );

/*
|--------------------------------------------------------------------------
| GLOBALS
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| INTERNATIONALIZATION
|--------------------------------------------------------------------------
*/

function mp_repo_mirror_textdomain() {

	// Set filter for plugin's languages directory
	$mp_repo_mirror_lang_dir = dirname( plugin_basename( MP_REPO_MIRROR_PLUGIN_FILE ) ) . '/languages/';
	$mp_repo_mirror_lang_dir = apply_filters( 'mp_repo_mirror_languages_directory', $mp_repo_mirror_lang_dir );


	// Traditional WordPress plugin locale filter
	$locale        = apply_filters( 'plugin_locale',  get_locale(), 'mp-repo-mirror' );
	$mofile        = sprintf( '%1$s-%2$s.mo', 'mp-repo-mirror', $locale );

	// Setup paths to current locale file
	$mofile_local  = $mp_repo_mirror_lang_dir . $mofile;
	$mofile_global = WP_LANG_DIR . '/mp-repo-mirror/' . $mofile;

	if ( file_exists( $mofile_global ) ) {
		// Look in global /wp-content/languages/mp_repo_mirror folder
		load_textdomain( 'mp_repo_mirror', $mofile_global );
	} elseif ( file_exists( $mofile_local ) ) {
		// Look in local /wp-content/plugins/message_bar/languages/ folder
		load_textdomain( 'mp_repo_mirror', $mofile_local );
	} else {
		// Load the default language files
		load_plugin_textdomain( 'mp_repo_mirror', false, $mp_repo_mirror_lang_dir );
	}

}
add_action( 'init', 'mp_repo_mirror_textdomain', 1 );

/*
|--------------------------------------------------------------------------
| INCLUDES
|--------------------------------------------------------------------------
*/
function mp_repo_mirror_include_files(){
	/**
	 * If mp_core isn't active, stop and install it now
	 */
	if (!function_exists('mp_core_textdomain')){
		
		/**
		 * Include Plugin Checker
		 */
		require( MP_REPO_MIRROR_PLUGIN_DIR . '/includes/plugin-checker/class-plugin-checker.php' );
		
		/**
		 * Include Plugin Installer
		 */
		require( MP_REPO_MIRROR_PLUGIN_DIR . '/includes/plugin-checker/class-plugin-installer.php' );
		
		/**
		 * Check if mp_core in installed
		 */
		require( MP_REPO_MIRROR_PLUGIN_DIR . 'includes/plugin-checker/included-plugins/mp-core-check.php' );
		
	}
	/**
	 * If mp_core is active but mp_repo isn't, stop and install it now
	 */
	elseif(!function_exists('mp_repo_textdomain')){
		
		/**
		 * Check if mp_repo and other plugins are installed
		 */
		include_once( MP_REPO_MIRROR_PLUGIN_DIR . 'includes/plugin-checker/included-plugins/mp-repo-check.php' );
	}
	/**
	 * Otherwise, if mp_core is active, carry out the plugin's functions
	 */
	else{
		
		/**
		 * Update script - keeps this plugin up to date
		 */
		require( MP_REPO_MIRROR_PLUGIN_DIR . 'includes/updater/mp-repo-mirror-update.php' );
		
		/**
		 * Hook for mp_repo license check to include mirror checking
		 */
		require( MP_REPO_MIRROR_PLUGIN_DIR . 'includes/misc-functions/update-hooks.php' );
		
		/**
		 * Hook for mp_repo license check to include mirror checking
		 */
		require( MP_REPO_MIRROR_PLUGIN_DIR . 'includes/settings/settings/settings-options.php' );
						
	}
}
add_action('plugins_loaded', 'mp_repo_mirror_include_files', 9);