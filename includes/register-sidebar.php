<?php
// Remove gutenberg widgets
add_filter('use_widgets_block_editor', '__return_false');

/* Better way to add multiple widgets areas */
function basictheme_widget_registration($name, $id, $description = ''): void {
	register_sidebar( array(
		'name' => $name,
		'id' => $id,
		'description' => $description,
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}

function basictheme_multiple_widget_init(): void {
	basictheme_widget_registration( esc_html__('Sidebar Main', 'basictheme'), 'sidebar-main' );
	basictheme_widget_registration( esc_html__('Sidebar Shop', 'basictheme'), 'sidebar-wc', esc_html__('Display sidebar on page shop.', 'basictheme') );
	basictheme_widget_registration( esc_html__('Sidebar Product', 'basictheme'), 'sidebar-wc-product', esc_html__('Display sidebar on page single product.', 'basictheme') );

	basictheme_widget_registration( esc_html__('Sidebar Footer Column 1', 'basictheme'), 'sidebar-footer-column-1' );
	basictheme_widget_registration( esc_html__('Sidebar Footer Column 2', 'basictheme'), 'sidebar-footer-column-2' );
	basictheme_widget_registration( esc_html__('Sidebar Footer Column 3', 'basictheme'), 'sidebar-footer-column-3' );
	basictheme_widget_registration( esc_html__('Sidebar Footer Column 4', 'basictheme'), 'sidebar-footer-column-4' );
}

add_action('widgets_init', 'basictheme_multiple_widget_init');