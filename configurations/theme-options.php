<?php
// A Custom function for get an option
if ( ! function_exists( 'basictheme_get_option' ) ) {
	function basictheme_get_option( $option = '', $default = null ) {
		$options = get_option( 'options' );

		return ( isset( $options[ $option ] ) ) ? $options[ $option ] : $default;
	}
}

// Control core classes for avoid errors
if ( class_exists( 'CSF' ) ) {
// Set a unique slug-like ID
	$basictheme_prefix   = 'options';
	$basictheme_my_theme = wp_get_theme();

	// Create options
	CSF::createOptions( $basictheme_prefix, array(
		'menu_title'          => esc_html__( 'Theme Options', 'basictheme' ),
		'menu_slug'           => 'theme-options',
		'menu_position'       => 2,
		'admin_bar_menu_icon' => 'dashicons-admin-generic',
		'framework_title'     => $basictheme_my_theme->get( 'Name' ) . ' ' . esc_html__( 'Options', 'basictheme' ),
		'footer_text'         => esc_html__( 'Thank you for using my theme', 'basictheme' ),
		'footer_after'        => '<pre>Contact me:<br />Zalo/Phone: 0975458209 - Skype: lathieuhiep - facebook: <a href="https://www.facebook.com/lathieuhiep" target="_blank">lathieuhiep</a></pre>',
	) );

	// Create a section general
	CSF::createSection( $basictheme_prefix, array(
		'title'  => esc_html__( 'General', 'basictheme' ),
		'icon'   => 'fas fa-cog',
		'fields' => array(
			// favicon
			array(
				'id'      => 'opt_general_favicon',
				'type'    => 'media',
				'title'   => esc_html__( 'Upload Image Favicon', 'basictheme' ),
				'library' => 'image',
				'url'     => false
			),

			// logo
			array(
				'id'      => 'opt_general_logo',
				'type'    => 'media',
				'title'   => esc_html__( 'Upload Image Logo', 'basictheme' ),
				'library' => 'image',
				'url'     => false
			),

			// show loading
			array(
				'id'         => 'opt_general_loading',
				'type'       => 'switcher',
				'title'      => esc_html__( 'website loader', 'basictheme' ),
				'text_on'    => esc_html__( 'Yes', 'basictheme' ),
				'text_off'   => esc_html__( 'No', 'basictheme' ),
				'text_width' => 80,
				'default'    => false
			),

			array(
				'id'         => 'opt_general_image_loading',
				'type'       => 'media',
				'title'      => esc_html__( 'Upload Image Loading', 'basictheme' ),
				'subtitle'   => esc_html__( 'Use file .git', 'basictheme' ) . ' <a href="https://loading.io/" target="_blank">loading.io</a>',
				'dependency' => array( 'opt_general_loading', '==', 'true' ),
				'url'        => false
			),

			// show back to top
			array(
				'id'         => 'opt_general_back_to_top',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Use Back To Top', 'basictheme' ),
				'text_on'    => esc_html__( 'Yes', 'basictheme' ),
				'text_off'   => esc_html__( 'No', 'basictheme' ),
				'text_width' => 80,
				'default'    => true
			),
		)
	) );

	//
	// Create a section menu
	CSF::createSection( $basictheme_prefix, array(
		'title'  => esc_html__( 'Menu', 'basictheme' ),
		'icon'   => 'fas fa-bars',
		'fields' => array(
			// Sticky menu
			array(
				'id'         => 'opt_menu_sticky',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Sticky menu', 'basictheme' ),
				'text_on'    => esc_html__( 'Yes', 'basictheme' ),
				'text_off'   => esc_html__( 'No', 'basictheme' ),
				'text_width' => 80,
				'default'    => true
			),

			// Show cart
			array(
				'id'         => 'opt_menu_cart',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Cart', 'basictheme' ),
				'text_on'    => esc_html__( 'Yes', 'basictheme' ),
				'text_off'   => esc_html__( 'No', 'basictheme' ),
				'text_width' => 80,
				'default'    => true
			),
		)
	) );

	//
	// -> Create a section blog
	CSF::createSection( $basictheme_prefix, array(
		'id'    => 'opt_post_section',
		'icon'  => 'fas fa-blog',
		'title' => esc_html__( 'Post', 'basictheme' ),
	) );

	// Category Post
	CSF::createSection( $basictheme_prefix, array(
		'parent' => 'opt_post_section',
		'title'  => esc_html__( 'Category', 'basictheme' ),
		'description' => esc_html__( 'Use for archive, index, page search', 'basictheme' ),
		'fields' => array(
			// Sidebar
			array(
				'id'      => 'opt_post_cat_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar position', 'basictheme' ),
				'options' => array(
					'hide'  => esc_html__( 'Hide', 'basictheme' ),
					'left'  => esc_html__( 'Left', 'basictheme' ),
					'right' => esc_html__( 'Right', 'basictheme' ),
				),
				'default' => 'right'
			),

			// Per Row
			array(
				'id'      => 'opt_post_cat_per_row',
				'type'    => 'select',
				'title'   => esc_html__( 'Blog Per Row', 'basictheme' ),
				'options' => array(
					'3' => esc_html__( '3 Column', 'basictheme' ),
					'4' => esc_html__( '4 Column', 'basictheme' ),
				),
				'default' => '3'
			),
		)
	) );

	// Single Post
	CSF::createSection( $basictheme_prefix, array(
		'parent' => 'opt_post_section',
		'title'  => esc_html__( 'Single', 'basictheme' ),
		'fields' => array(
			array(
				'id'      => 'opt_post_single_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar position', 'basictheme' ),
				'options' => array(
					'hide'  => esc_html__( 'Hide', 'basictheme' ),
					'left'  => esc_html__( 'Left', 'basictheme' ),
					'right' => esc_html__( 'Right', 'basictheme' ),
				),
				'default' => 'right'
			),

			// Show related post
			array(
				'id'         => 'opt_post_single_related',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Show related post', 'basictheme' ),
				'text_on'    => esc_html__( 'Yes', 'basictheme' ),
				'text_off'   => esc_html__( 'No', 'basictheme' ),
				'default'    => true,
				'text_width' => 80
			),

			// Limit related post
			array(
				'id'      => 'opt_post_single_related_limit',
				'type'    => 'number',
				'title'   => esc_html__( 'Limit related post', 'basictheme' ),
				'default' => 3,
			),
		)
	) );

	//
	// Create a section social network
	CSF::createSection( $basictheme_prefix, array(
		'title'  => esc_html__( 'Social Network', 'basictheme' ),
		'icon'   => 'fab fa-hive',
		'fields' => array(
			array(
				'id'      => 'opt_social_network',
				'type'    => 'repeater',
				'title'   => esc_html__( 'Social Network', 'basictheme' ),
				'fields'  => array(
					array(
						'id'      => 'icon',
						'type'    => 'icon',
						'title'   => esc_html__( 'Icon', 'basictheme' ),
						'default' => 'fab fa-facebook-f'
					),

					array(
						'id'    => 'url',
						'type'  => 'text',
						'title' => esc_html__('URL', 'basictheme'),
						'default' => '#'
					),
				),
				'default' => array(
					array(
						'icon' => 'fab fa-facebook-f',
						'url' => '#',
					),

					array(
						'icon' => 'fab fa-youtube',
						'url' => '#',
					),
				)
			),
		)
	) );

	//
	//  Create a section shop
	CSF::createSection( $basictheme_prefix, array(
		'id'    => 'opt_shop_section',
		'title'  => esc_html__( 'Shop', 'basictheme' ),
		'icon'   => 'fas fa-shopping-cart',
	) );

	// Category product
	CSF::createSection( $basictheme_prefix, array(
		'parent' => 'opt_shop_section',
		'title'  => esc_html__( 'Category', 'basictheme' ),
		'description' => esc_html__( 'Use for shop category and tag', 'basictheme' ),
		'fields' => array(
			// Sidebar
			array(
				'id'      => 'opt_shop_cat_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar position', 'basictheme' ),
				'options' => array(
					'hide'  => esc_html__( 'Hide', 'basictheme' ),
					'left'  => esc_html__( 'Left', 'basictheme' ),
					'right' => esc_html__( 'Right', 'basictheme' ),
				),
				'default' => 'left'
			),

			// Limit
			array(
				'id'      => 'opt_shop_cat_limit',
				'type'    => 'number',
				'title'   => esc_html__( 'Limit Product', 'basictheme' ),
				'default' => 12,
			),

			// Per Row
			array(
				'id'      => 'opt_shop_cat_per_row',
				'type'    => 'select',
				'title'   => esc_html__( 'Products Per Row', 'basictheme' ),
				'options' => array(
					'3' => esc_html__( '3 Column', 'basictheme' ),
					'4' => esc_html__( '4 Column', 'basictheme' ),
					'5' => esc_html__( '5 Column', 'basictheme' ),
				),
				'default' => '4'
			),
		)
	) );

	// Single product
	CSF::createSection( $basictheme_prefix, array(
		'parent' => 'opt_shop_section',
		'title'  => esc_html__( 'Single', 'basictheme' ),
		'description' => esc_html__( 'Use for single product', 'basictheme' ),
		'fields' => array(
			// Sidebar
			array(
				'id'      => 'opt_shop_single_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar position', 'basictheme' ),
				'options' => array(
					'hide'  => esc_html__( 'Hide', 'basictheme' ),
					'left'  => esc_html__( 'Left', 'basictheme' ),
					'right' => esc_html__( 'Right', 'basictheme' ),
				),
				'default' => 'left'
			)
		)
	) );

	//
	// -> Create a section footer
	CSF::createSection( $basictheme_prefix, array(
		'id'    => 'opt_footer_section',
		'icon'  => 'fas fa-stream',
		'title' => esc_html__( 'Footer', 'basictheme' ),
	) );

	// footer columns
	CSF::createSection( $basictheme_prefix, array(
		'parent' => 'opt_footer_section',
		'title'  => esc_html__( 'Columns Sidebar', 'basictheme' ),
		'fields' => array(
			// select columns
			array(
				'id'      => 'opt_footer_columns',
				'type'    => 'select',
				'title'   => esc_html__( 'Number of footer columns', 'basictheme' ),
				'options' => array(
					'0' => esc_html__( 'Hide', 'basictheme' ),
					'1' => 1,
					'2' => 2,
					'3' => 3,
					'4' => 4,
				),
				'default' => '4'
			),

			// column width 1
			array(
				'id'         => 'opt_footer_column_width_1',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 1', 'basictheme' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', '!=', '0' )
			),

			// column width 2
			array(
				'id'         => 'opt_footer_column_width_2',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 2', 'basictheme' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1' )
			),

			// column width 3
			array(
				'id'         => 'opt_footer_column_width_3',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 3', 'basictheme' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2' )
			),

			// column width 4
			array(
				'id'         => 'opt_footer_column_width_4',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 4', 'basictheme' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2,3' )
			),
		)
	) );

	// Copyright
	CSF::createSection( $basictheme_prefix, array(
		'parent' => 'opt_footer_section',
		'title'  => esc_html__( 'Copyright', 'basictheme' ),
		'fields' => array(
			// show
			array(
				'id'         => 'opt_footer_copyright_show',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Show copyright', 'basictheme' ),
				'text_on'    => esc_html__( 'Yes', 'basictheme' ),
				'text_off'   => esc_html__( 'No', 'basictheme' ),
				'text_width' => 80,
				'default'    => true
			),

			// content
			array(
				'id'      => 'opt_footer_copyright_content',
				'type'    => 'wp_editor',
				'title'   => esc_html__( 'Content', 'basictheme' ),
				'media_buttons' => false,
				'default' => esc_html__( 'Copyright &copy; DiepLK', 'basictheme' )
			),
		)
	) );
}