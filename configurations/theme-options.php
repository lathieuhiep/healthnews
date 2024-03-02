<?php
// A Custom function for get an option
if ( ! function_exists( 'healthnews_get_option' ) ) {
	function healthnews_get_option( $option = '', $default = null ) {
		$options = get_option( 'options' );

		return ( isset( $options[ $option ] ) ) ? $options[ $option ] : $default;
	}
}

// Control core classes for avoid errors
if ( class_exists( 'CSF' ) ) {
// Set a unique slug-like ID
	$healthnews_prefix   = 'options';
	$healthnews_my_theme = wp_get_theme();

	// Create options
	CSF::createOptions( $healthnews_prefix, array(
		'menu_title'          => esc_html__( 'Theme Options', 'healthnews' ),
		'menu_slug'           => 'theme-options',
		'menu_position'       => 2,
		'admin_bar_menu_icon' => 'dashicons-admin-generic',
		'framework_title'     => $healthnews_my_theme->get( 'Name' ) . ' ' . esc_html__( 'Options', 'healthnews' ),
		'footer_text'         => esc_html__( 'Thank you for using my theme', 'healthnews' ),
		'footer_after'        => '<pre>Contact me:<br />Zalo/Phone: 0975458209 - Skype: lathieuhiep - facebook: <a href="https://www.facebook.com/lathieuhiep" target="_blank">lathieuhiep</a></pre>',
	) );

    //
	// Create a section general
	CSF::createSection( $healthnews_prefix, array(
        'id'    => 'opt_general_section',
		'title'  => esc_html__( 'General', 'healthnews' ),
		'icon'   => 'fas fa-cog',
	) );

    // Global
    CSF::createSection( $healthnews_prefix, array(
        'parent' => 'opt_general_section',
        'title'  => esc_html__( 'Toàn cục', 'healthnews' ),
        'fields' => array(
            // favicon
            array(
                'id'      => 'opt_general_favicon',
                'type'    => 'media',
                'title'   => esc_html__( 'Upload Image Favicon', 'healthnews' ),
                'library' => 'image',
                'url'     => false
            ),

            // logo
            array(
                'id'      => 'opt_general_logo',
                'type'    => 'media',
                'title'   => esc_html__( 'Logo Header', 'healthnews' ),
                'library' => 'image',
                'url'     => false
            ),

            // show loading
            array(
                'id'         => 'opt_general_loading',
                'type'       => 'switcher',
                'title'      => esc_html__( 'website loader', 'healthnews' ),
                'text_on'    => esc_html__( 'Yes', 'healthnews' ),
                'text_off'   => esc_html__( 'No', 'healthnews' ),
                'text_width' => 80,
                'default'    => false
            ),

            array(
                'id'         => 'opt_general_image_loading',
                'type'       => 'media',
                'title'      => esc_html__( 'Upload Image Loading', 'healthnews' ),
                'subtitle'   => esc_html__( 'Use file .git', 'healthnews' ) . ' <a href="https://loading.io/" target="_blank">loading.io</a>',
                'dependency' => array( 'opt_general_loading', '==', 'true' ),
                'url'        => false
            ),

            // show back to top
            array(
                'id'         => 'opt_general_back_to_top',
                'type'       => 'switcher',
                'title'      => esc_html__( 'Use Back To Top', 'healthnews' ),
                'text_on'    => esc_html__( 'Yes', 'healthnews' ),
                'text_off'   => esc_html__( 'No', 'healthnews' ),
                'text_width' => 80,
                'default'    => true
            ),
        )
    ) );

    // Contact
    CSF::createSection( $healthnews_prefix, array(
        'parent' => 'opt_general_section',
        'title'  => esc_html__( 'Liên hệ', 'healthnews' ),
        'fields' => array(
            array(
                'id'      => 'opt_general_contact_hotline',
                'type'    => 'text',
                'title'   => esc_html__( 'Hotline', 'healthnews' ),
                'default' => '1900.115'
            ),

            array(
                'id'      => 'opt_general_contact_email',
                'type'    => 'text',
                'title'   => esc_html__( 'Email', 'healthnews' ),
                'default' => 'mail@suckhoedanang.com'
            ),
        )
    ) );

	//
	// Create a section menu
	CSF::createSection( $healthnews_prefix, array(
		'title'  => esc_html__( 'Menu', 'healthnews' ),
		'icon'   => 'fas fa-bars',
		'fields' => array(
			// Sticky menu
			array(
				'id'         => 'opt_menu_sticky',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Sticky menu', 'healthnews' ),
				'text_on'    => esc_html__( 'Yes', 'healthnews' ),
				'text_off'   => esc_html__( 'No', 'healthnews' ),
				'text_width' => 80,
				'default'    => true
			),
		)
	) );

	//
	// -> Create a section blog
	CSF::createSection( $healthnews_prefix, array(
		'id'    => 'opt_post_section',
		'icon'  => 'fas fa-blog',
		'title' => esc_html__( 'Post', 'healthnews' ),
	) );

	// Category Post
	CSF::createSection( $healthnews_prefix, array(
		'parent' => 'opt_post_section',
		'title'  => esc_html__( 'Category', 'healthnews' ),
		'description' => esc_html__( 'Use for archive, index, page search', 'healthnews' ),
		'fields' => array(
			// Sidebar
			array(
				'id'      => 'opt_post_cat_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar position', 'healthnews' ),
				'options' => array(
					'hide'  => esc_html__( 'Hide', 'healthnews' ),
					'left'  => esc_html__( 'Left', 'healthnews' ),
					'right' => esc_html__( 'Right', 'healthnews' ),
				),
				'default' => 'right'
			),

			// Per Row
			array(
				'id'      => 'opt_post_cat_per_row',
				'type'    => 'select',
				'title'   => esc_html__( 'Blog Per Row', 'healthnews' ),
				'options' => array(
					'3' => esc_html__( '3 Column', 'healthnews' ),
					'4' => esc_html__( '4 Column', 'healthnews' ),
				),
				'default' => '3'
			),
		)
	) );

	// Single Post
	CSF::createSection( $healthnews_prefix, array(
		'parent' => 'opt_post_section',
		'title'  => esc_html__( 'Single', 'healthnews' ),
		'fields' => array(
			array(
				'id'      => 'opt_post_single_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar position', 'healthnews' ),
				'options' => array(
					'hide'  => esc_html__( 'Hide', 'healthnews' ),
					'left'  => esc_html__( 'Left', 'healthnews' ),
					'right' => esc_html__( 'Right', 'healthnews' ),
				),
				'default' => 'right'
			),

			// Show related post
			array(
				'id'         => 'opt_post_single_related',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Show related post', 'healthnews' ),
				'text_on'    => esc_html__( 'Yes', 'healthnews' ),
				'text_off'   => esc_html__( 'No', 'healthnews' ),
				'default'    => true,
				'text_width' => 80
			),

			// Limit related post
			array(
				'id'      => 'opt_post_single_related_limit',
				'type'    => 'number',
				'title'   => esc_html__( 'Limit related post', 'healthnews' ),
				'default' => 3,
			),
		)
	) );

	//
	// Create a section social network
	CSF::createSection( $healthnews_prefix, array(
		'title'  => esc_html__( 'Social Network', 'healthnews' ),
		'icon'   => 'fab fa-hive',
		'fields' => array(
			array(
				'id'      => 'opt_social_network',
				'type'    => 'repeater',
				'title'   => esc_html__( 'Social Network', 'healthnews' ),
				'fields'  => array(
					array(
						'id'      => 'icon',
						'type'    => 'icon',
						'title'   => esc_html__( 'Icon', 'healthnews' ),
						'default' => 'fab fa-facebook-f'
					),

					array(
						'id'    => 'url',
						'type'  => 'text',
						'title' => esc_html__('URL', 'healthnews'),
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
	// -> Create a section footer
	CSF::createSection( $healthnews_prefix, array(
		'id'    => 'opt_footer_section',
		'icon'  => 'fas fa-stream',
		'title' => esc_html__( 'Footer', 'healthnews' ),
	) );

	// footer columns
	CSF::createSection( $healthnews_prefix, array(
		'parent' => 'opt_footer_section',
		'title'  => esc_html__( 'Columns Sidebar', 'healthnews' ),
		'fields' => array(
			// select columns
			array(
				'id'      => 'opt_footer_columns',
				'type'    => 'select',
				'title'   => esc_html__( 'Number of footer columns', 'healthnews' ),
				'options' => array(
					'0' => esc_html__( 'Hide', 'healthnews' ),
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
				'title'      => esc_html__( 'Column width 1', 'healthnews' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', '!=', '0' )
			),

			// column width 2
			array(
				'id'         => 'opt_footer_column_width_2',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 2', 'healthnews' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1' )
			),

			// column width 3
			array(
				'id'         => 'opt_footer_column_width_3',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 3', 'healthnews' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2' )
			),

			// column width 4
			array(
				'id'         => 'opt_footer_column_width_4',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 4', 'healthnews' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2,3' )
			),
		)
	) );
}