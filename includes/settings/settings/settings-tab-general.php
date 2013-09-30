<?php			
/**
 * This is the code that will create a new tab of settings for your page.
 * To create a new tab and set up this page:
 * Step 1. Duplicate this page and include it in the "class initialization function".
 * Step 1. Do a find-and-replace for the term 'mp_repo_mirror_settings' and replace it with the slug you set when initializing this class
 * Step 2. Do a find and replace for 'general' and replace it with your desired tab slug
 * Step 3. Go to line 17 and set the title for this tab.
 * Step 4. Begin creating your custom options on line 30
 * Go here for full setup instructions: 
 * http://moveplugins.com/doc/settings-class/
 */


/**
* Create new tab
*/
function mp_repo_mirror_settings_general_new_tab( $active_tab ){
	
	//Create array containing the title and slug for this new tab
	$tab_info = array( 'title' => __('MP Repo Mirror Settings' , 'mp_repo_mirror'), 'slug' => 'general' );
	
	global $mp_repo_mirror_settings; $mp_repo_mirror_settings->new_tab( $active_tab, $tab_info );
		
}
//Hook into the new tab hook filter contained in the settings class in the Move Plugins Core
add_action('mp_repo_mirror_settings_new_tab_hook', 'mp_repo_mirror_settings_general_new_tab');

/**
* Create settings
*/
function mp_repo_mirror_settings_general_create(){
	
	
	register_setting(
		'mp_repo_mirror_settings_general',
		'mp_repo_mirror_settings_general',
		'mp_core_settings_validate'
	);
	
	add_settings_section(
		'general_settings',
		__( 'General Settings', 'mp_repo_mirror' ),
		'__return_false',
		'mp_repo_mirror_settings_general'
	);
	
	add_settings_field(
		'url_to_search',
		__( 'URL To Search and Replace', 'mp_repo_mirror' ), 
		'mp_core_textbox',
		'mp_repo_mirror_settings_general',
		'general_settings',
		array(
			'name'        => 'url_to_search',
			'value'       => mp_core_get_option( 'mp_repo_mirror_settings_general',  'url_to_search' ),
			'preset_value'       => "popup",
			'description' => __( 'Enter the URL you want to search for and replace.', 'mp_repo_mirror' ),
			'registration'=> 'mp_repo_mirror_settings_general',
		)
	);
	
	add_settings_field(
		'replacement_url',
		__( 'URL To Use As Replacement', 'mp_repo_mirror' ), 
		'mp_core_textbox',
		'mp_repo_mirror_settings_general',
		'general_settings',
		array(
			'name'        => 'replacement_url',
			'value'       => mp_core_get_option( 'mp_repo_mirror_settings_general',  'replacement_url' ),
			'preset_value'       => "popup",
			'description' => __( 'Enter the URL you want to use in place of the above one.', 'mp_repo_mirror' ),
			'registration'=> 'mp_repo_mirror_settings_general',
		)
	);
		
	//additional general settings
	do_action('mp_repo_mirror_additional_general_settings_hook');
}
add_action( 'admin_init', 'mp_repo_mirror_settings_general_create' );