<?php

//Register front end woo
add_action('wp_enqueue_scripts', 'healthnews_register_front_end_woo');

function healthnews_register_front_end_woo() {
	if ( is_woocommerce() || is_cart() || is_checkout()  ) {
		wp_enqueue_style( 'shop', get_theme_file_uri( '/extension/woocommerce/assets/css/shop.min.css' ), array(), healthnews_get_version_theme() );
	}

    if ( is_shop() || is_product_category() || is_product_tag() ) :
	    // load css owl
	    wp_enqueue_style( 'owl.carousel', get_theme_file_uri( 'assets/libs/owl.carousel/owl.carousel.min.css' ), array(), '2.3.4' );

	    // load js owl
	    wp_enqueue_script( 'owl.carousel', get_theme_file_uri( 'assets/libs/owl.carousel/owl.carousel.min.js' ), array( 'jquery' ), '2.3.4', true );

        wp_enqueue_script( 'woo-quick-view', get_theme_file_uri( '/extension/woocommerce/assets/js/woo-quick-view.js' ), array('jquery', 'wc-add-to-cart-variation'), '', true );
        $healthnews_woo_quick_view_admin_url    =   admin_url( 'admin-ajax.php' );
        $healthnews_woo_quick_view_ajax         =   array( 'url' => $healthnews_woo_quick_view_admin_url );
        wp_localize_script( 'woo-quick-view', 'woo_quick_view_product', $healthnews_woo_quick_view_ajax );
    endif;
}