<?php
// Remove gutenberg widgets
add_filter('use_widgets_block_editor', '__return_false');

/* Better way to add multiple widgets areas */
function healthnews_widget_registration($name, $id, $description = ''): void {
	register_sidebar( array(
		'name' => $name,
		'id' => $id,
		'description' => $description,
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	));
}

function healthnews_multiple_widget_init(): void {
	healthnews_widget_registration( esc_html__('Sidebar Main', 'healthnews'), 'sidebar-main' );

	healthnews_widget_registration( esc_html__('Sidebar Single', 'healthnews'), 'sidebar-single', esc_html__('Display sidebar on single post.', 'healthnews') );

	healthnews_widget_registration( esc_html__('Sidebar Footer Column 1', 'healthnews'), 'sidebar-footer-column-1' );
	healthnews_widget_registration( esc_html__('Sidebar Footer Column 2', 'healthnews'), 'sidebar-footer-column-2' );
	healthnews_widget_registration( esc_html__('Sidebar Footer Column 3', 'healthnews'), 'sidebar-footer-column-3' );
	healthnews_widget_registration( esc_html__('Sidebar Footer Column 4', 'healthnews'), 'sidebar-footer-column-4' );
}

add_action('widgets_init', 'healthnews_multiple_widget_init');