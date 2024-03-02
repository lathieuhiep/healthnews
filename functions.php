<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Required: Theme Helper
require get_parent_theme_file_path( '/includes/theme-helper.php' );

// Setup Theme
add_action( 'after_setup_theme', 'healthnews_setup' );
function healthnews_setup(): void {
	// Set the content width based on the theme's design and stylesheet.
	global $content_width;

	if ( ! isset( $content_width ) ) {
		$content_width = 1200;
	}

	// Required: options theme
	require get_theme_file_path( '/configurations/theme-options.php' );

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'healthnews', get_parent_theme_file_path( '/languages' ) );

	/**
	 * Set up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support post thumbnails.
	 *
	 */
	add_theme_support( 'custom-header' );

	add_theme_support( 'custom-background' );

	//Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in two locations.
    register_nav_menus(
        array(
            'primary'   => esc_html__('Primary Menu', 'healthnews'),
        )
    );

    // add theme support title-tag
	add_theme_support( 'title-tag' );
}

// Required: Plugin Activation
require get_parent_theme_file_path( '/includes/class-tgm-plugin-activation.php' );
require get_parent_theme_file_path( '/includes/plugin-activation.php' );

// Require Widgets
foreach ( glob( get_parent_theme_file_path( '/extension/widgets/*.php' ) ) as $file_widgets ) {
	require $file_widgets;
}

// Required: theme add_action
require get_parent_theme_file_path( '/includes/theme-add-action.php' );

// Required: theme add_filter
require get_parent_theme_file_path( '/includes/theme-add-filter.php' );

// Required: CMB2
if ( !class_exists('CMB2') ) {
    require get_parent_theme_file_path( '/configurations/meta-box/cmb_post.php' );
}

// Required: Elementor
if ( did_action( 'elementor/loaded' ) ) :
    require get_parent_theme_file_path( '/extension/elementor-addon/elementor-addon.php' );
endif;

// Require Register Sidebar
require get_parent_theme_file_path( '/includes/register-sidebar.php' );

// Require Theme Scripts
require get_parent_theme_file_path( '/includes/theme-scripts.php' );

// Require Woocommerce
if ( class_exists( 'Woocommerce' ) ) :
	require get_parent_theme_file_path( '/extension/woocommerce/woo-scripts.php' );
	require get_parent_theme_file_path( '/extension/woocommerce/woo-quick-view.php' );
	require get_parent_theme_file_path( '/extension/woocommerce/woo-template-hooks.php' );
	require get_parent_theme_file_path( '/extension/woocommerce/woo-template-functions.php' );
endif;