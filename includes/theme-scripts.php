<?php
// Register Back-End script
add_action('admin_enqueue_scripts', 'healthnews_register_back_end_scripts');
function healthnews_register_back_end_scripts(){
	/* Start Get CSS Admin */
	wp_enqueue_style( 'admin', get_theme_file_uri( '/assets/css/admin.css' ) );
}

// Remove jquery migrate
add_action( 'wp_default_scripts', 'healthnews_remove_jquery_migrate' );
function healthnews_remove_jquery_migrate( $scripts ) {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) {
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
}

// Register Front-End Styles
add_action('wp_enqueue_scripts', 'healthnews_register_front_end');
function healthnews_register_front_end() {
	// remove style gutenberg
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style( 'classic-theme-styles' );

	wp_dequeue_style('wc-blocks-style');
	wp_dequeue_style('storefront-gutenberg-blocks'); // disable storefront frontend block styles

	/** Load css **/

	// font google
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap', array(), null );

	// fontawesome
	wp_enqueue_style( 'fontawesome', get_theme_file_uri( '/assets/libs/fontawesome/css/fontawesome.min.css' ), array(), '6.5.1' );

	// bootstrap css
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/libs/bootstrap/bootstrap.min.css' ), array(), '5.2.3' );

	// style theme
	wp_enqueue_style( 'healthnews-style', get_theme_file_uri( '/assets/css/style-theme.min.css' ), array(), healthnews_get_version_theme() );

	// page template home
	if ( is_page_template('templates/home.php') ) {
		wp_enqueue_style( 'scrollbar', get_theme_file_uri( '/assets/libs/scrollbar/jquery.scrollbar.css' ), array(), '' );
		wp_enqueue_style( 'tpl-home', get_theme_file_uri( '/assets/css/templates/tpl-home.min.css' ), array(), healthnews_get_version_theme() );
	}

	// style post
	if ( healthnews_is_blog() ) {
		wp_enqueue_style( 'category-post', get_theme_file_uri( '/assets/css/post-type/post/archive.min.css' ), array(), healthnews_get_version_theme() );
	}

	if (is_singular('post')) {
		wp_enqueue_style( 'single-post', get_theme_file_uri( '/assets/css/post-type/post/single.min.css' ), array(), healthnews_get_version_theme() );
	}

	// style page 404
	if ( is_404() ) {
		wp_enqueue_style( 'page-404', get_theme_file_uri( '/assets/css/page-templates/page-404.min.css' ), array(), healthnews_get_version_theme() );
	}

	/** Load js **/

	// bootstrap js
	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/assets/libs/bootstrap/bootstrap.min.js' ), array('jquery'), '5.2.3', true );

	// page template home
	if ( is_page_template('templates/home.php') ) {
		wp_enqueue_script( 'scrollbar', get_theme_file_uri( '/assets/libs/scrollbar/jquery.scrollbar.min.js' ), array('jquery'), '', true );
		wp_enqueue_script( 'tpl-home', get_theme_file_uri( '/assets/js/template-home.min.js' ), array('jquery'), healthnews_get_version_theme(), true );
	}

	// comment reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// custom js
	wp_enqueue_script( 'healthnews-custom', get_theme_file_uri( '/assets/js/custom.min.js' ), array('jquery'), healthnews_get_version_theme(), true );
}