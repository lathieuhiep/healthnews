<?php
/**
 * Include the TGM_Plugin_Activation class.
 */

add_action( 'tgmpa_register', 'healthnews_register_required_plugins' );
function healthnews_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$healthnews_plugins = array(
		// This is an example of how to include a plugin from the WordPress Plugin Repository
		array(
			'name'      =>  'Codestar Framework',
			'slug'      =>  'codestar-framework',
			'required'  =>  true,
			'source' => 'https://github.com/Codestar/codestar-framework/archive/refs/heads/master.zip'
		),
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$healthnews_config = array(
		'id'           => 'healthnews',          // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $healthnews_plugins, $healthnews_config );
}
