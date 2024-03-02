<?php
// Register Category Elementor Addon
use Elementor\Plugin;

// create category
add_action( 'elementor/elements/categories_registered', 'healthnews_add_elementor_widget_categories' );
function healthnews_add_elementor_widget_categories( $elements_manager ): void {
	$elements_manager->add_category(
		'my-theme',
		[
			'title' => esc_html__( 'My Theme', 'healthnews' ),
			'icon'  => 'icon-goes-here',
		]
	);
}

// Register widgets
add_action( 'elementor/widgets/register', 'healthnews_register_widget_elementor_addon' );
function healthnews_register_widget_elementor_addon( $widgets_manager ): void {
	// include add on
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/slides.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/about-text.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/post-carousel.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/post-grid.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/testimonial-slider.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/carousel-images.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/contact-form-7.php' );
	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/info-box.php' );

	// register add on
	$widgets_manager->register( new \BasicTheme_Elementor_Slides() );
	$widgets_manager->register( new \BasicTheme_Elementor_About_Text() );
	$widgets_manager->register( new \BasicTheme_Elementor_Post_Carousel() );
	$widgets_manager->register( new \BasicTheme_Elementor_Post_Grid() );
	$widgets_manager->register( new \BasicTheme_Elementor_Testimonial_Slider() );
	$widgets_manager->register( new \BasicTheme_Elementor_Carousel_Images() );
	$widgets_manager->register( new \BasicTheme_Elementor_Contact_Form_7() );
	$widgets_manager->register( new \BasicTheme_Elementor_Info_Box() );
}

// Register scripts
add_action( 'wp_enqueue_scripts', 'healthnews_elementor_scripts', 11 );
function healthnews_elementor_scripts(): void {
	$healthnews_check_elementor = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

	if ( $healthnews_check_elementor == 'builder' ) {
		// style
		wp_enqueue_style( 'owl.carousel', get_theme_file_uri( '/assets/libs/owl.carousel/owl.carousel.min.css' ), array(), '2.3.4' );

		wp_enqueue_style( 'healthnews-elementor-style', get_theme_file_uri( '/extension/elementor-addon/css/elementor-addon.min.css' ), array(), healthnews_get_version_theme() );

		// js
		wp_enqueue_script( 'owl.carousel', get_theme_file_uri( '/assets/libs/owl.carousel/owl.carousel.min.js' ), array( 'jquery' ), '2.3.4', true );

		wp_enqueue_script( 'healthnews-elementor-script', get_theme_file_uri( '/extension/elementor-addon/js/elementor-addon.js' ), array( 'jquery' ), '1.0.0', true );
	}
}