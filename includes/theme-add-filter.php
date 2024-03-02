<?php
// add async file scrip
add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
function add_async_attribute($tag, $handle) {
	$async_scripts = array(
		'bootstrap.min.js',
		'owl.carousel.min.js',
		'custom.min.js',
		'elementor-addon.js'
	);

	$src = wp_scripts()->registered[$handle]->src;

	foreach ($async_scripts as $async_script) {
		if ( str_contains( $src, $async_script ) ) {
			return str_replace(' src', ' async="async" src', $tag);
		}
	}

	return $tag;
}