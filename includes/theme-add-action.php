<?php
// setting favicon
add_action('wp_head', 'healthnews_favicon', 1);
function healthnews_favicon(): void {
    $opt_favicon = healthnews_get_option( 'opt_general_favicon' );

    if ( empty( $opt_favicon['url'] ) ) :
        $favicon_url = get_theme_file_uri('/assets/images/favicon.png' );
    else:
	    $favicon_url = $opt_favicon['url'];
    endif;

    echo '<link rel="shortcut icon" href="' . esc_url( $favicon_url ) . '" type="image/x-icon" sizes="16x16" />';
}

// add property
add_action( 'wp_head', 'healthnews_opengraph', 5 );
function healthnews_opengraph(): void {
	global $post;

	if ( is_single() ) :
		if ( has_post_thumbnail( $post->ID ) ) :
			$img_src = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		else :
			$img_src = get_theme_file_uri( '/images/no-image.png' );
		endif;

		$excerpt = $post->post_excerpt;

		if ( $excerpt ) :
			$excerpt = strip_tags( $post->post_excerpt );
			$excerpt = str_replace( "", "'", $excerpt );
		else :
			$excerpt = get_bloginfo( 'description' );
		endif;

		?>
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="<?php the_title(); ?>" />
		<meta property="og:description" content="<?php echo esc_attr( $excerpt ); ?>" />
		<meta property="og:image" content="<?php echo esc_url( $img_src ); ?>" />
	<?php
	endif;
}

// Sanitize Pagination
add_action( 'navigation_markup_template', 'healthnews_sanitize_pagination' );
function healthnews_sanitize_pagination( $healthnews_content ): string {
	// Remove role attribute
	$healthnews_content = str_replace( 'role="navigation"', '', $healthnews_content );

	// Remove h2 tag
	return preg_replace( '#<h2.*?>(.*?)<\/h2>#si', '', $healthnews_content );
}

// Walker for the main menu
add_filter( 'walker_nav_menu_start_el', 'healthnews_add_arrow',10,4);
function healthnews_add_arrow( $output, $item, $depth, $args ){
	if('primary' == $args->theme_location && $depth >= 0 ){
		if (in_array("menu-item-has-children", $item->classes)) {
			$output .='<span class="sub-menu-toggle"></span>';
		}
	}

	return $output;
}

// Custom Search Post
add_action( 'pre_get_posts', 'healthnews_include_custom_post_types_in_search_results' );
function healthnews_include_custom_post_types_in_search_results( $query ): void {
	if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
		$query->set( 'post_type', array( 'post' ) );
	}
}

//Disable emojis in WordPress
add_action( 'init', 'healthnews_disable_emojis' );
function healthnews_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'healthnews_disable_emojis_tinymce' );
}

function healthnews_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

// javascript footer
add_action('wp_footer', 'healthnews_add_script_footer');
function healthnews_add_script_footer(): void {
	$add_script = healthnews_get_option( 'opt_footer_add_javascript' );

	if ( $add_script ) {
		echo $add_script;
	}
}