<?php
/**
 * General functions used to integrate this theme with WooCommerce.
 */

add_action( 'after_setup_theme', 'healthnews_shop_setup' );

function healthnews_shop_setup(): void {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}

/* Start limit product */
add_filter('loop_shop_per_page', 'healthnews_show_products_per_page');

function healthnews_show_products_per_page() {
    return healthnews_get_option('opt_shop_cat_limit', 12);
}
/* End limit product */

/* Start Change number of products per row */
add_filter('loop_shop_columns', 'healthnews_loop_columns_product');

function healthnews_loop_columns_product() {
    return healthnews_get_option('opt_shop_cat_per_row', '4');
}
/* End Change number of products per row */

/* Start get cart */

function healthnews_get_cart(): void {
?>
    <div class="cart-box">
        <div class="cart-customlocation">
            <i class="fas fa-shopping-cart"></i>

            <span class="number-cart-product">
                 <?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?>
            </span>
        </div>
    </div>
<?php
}

/* To ajaxify your cart viewer */
add_filter( 'woocommerce_add_to_cart_fragments', 'healthnews_add_to_cart_fragment' );

if ( ! function_exists( 'healthnews_add_to_cart_fragment' ) ) :

    function healthnews_add_to_cart_fragment( $healthnews_fragments ) {

        ob_start();

        do_action( 'healthnews_woo_shopping_cart' );

        $healthnews_fragments['.cart-box'] = ob_get_clean();

        return $healthnews_fragments;

    }

endif;
/* End get cart */

// get sidebar active
function healthnews_woo_get_sidebar_active(): array {
    $sidebar = [];

	if ( is_product() ) :
		$sidebar['active'] = 'sidebar-wc-product';
		$sidebar['position'] = healthnews_get_option('opt_shop_single_sidebar_position');
	else:
		$sidebar['active'] = 'sidebar-wc';
		$sidebar['position'] = healthnews_get_option('opt_shop_cat_sidebar_position');
	endif;

    return $sidebar;
}

/* Start Sidebar Shop */
if ( ! function_exists( 'healthnews_woo_get_sidebar' ) ) :
    function healthnews_woo_get_sidebar(): void {
	    $sidebar = healthnews_woo_get_sidebar_active();

	    if( !empty( $sidebar ) && $sidebar['position'] != 'hide' && is_active_sidebar( $sidebar['active'] ) ):
	        if ( $sidebar['position'] == 'left' ) :
		        $class_order = 'order-md-1';
	        else:
		        $class_order = 'order-md-2';
	        endif;
    ?>
        <aside class="col-12 col-md-4 col-lg-3 order-2 <?php echo esc_attr( $class_order ); ?>">
            <?php dynamic_sidebar( $sidebar['active'] ); ?>
        </aside>
    <?php
        endif;
    }
endif;
/* End Sidebar Shop */

/*
* Lay Out Shop
*/

if ( ! function_exists( 'healthnews_woo_before_main_content' ) ) :
    /**
     * Before Content
     * Wraps all WooCommerce content in wrappers which match the theme markup
     */
    function healthnews_woo_before_main_content(): void {
	    $sidebar = healthnews_woo_get_sidebar_active();
    ?>
        <div class="site-shop">
            <div class="container">
                <div class="row">

                <?php
                    /**
                     * woocommerce_sidebar hook.
                     *
                     * @hooked healthnews_woo_sidebar - 10
                     */
                    do_action( 'healthnews_woo_sidebar' );
                ?>
                    <div class="<?php echo !empty( $sidebar ) && is_active_sidebar( $sidebar['active'] ) && $sidebar['position'] != 'hide' ? 'col-12 col-md-8 col-lg-9 order-1 has-sidebar' : 'col-md-12'; ?>">

    <?php

    }

endif;

if ( ! function_exists( 'healthnews_woo_after_main_content' ) ) :
    /**
     * After Content
     * Closes the wrapping divs
     */
    function healthnews_woo_after_main_content(): void {
    ?>
                    </div><!-- .col-md-9 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .site-shop -->
    <?php
    }

endif;

if ( ! function_exists( 'healthnews_woo_product_thumbnail_open' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked healthnews_woo_product_thumbnail_open - 5
     */

    function healthnews_woo_product_thumbnail_open(): void {

?>
    <div class="site-shop__product--item-image">
<?php

    }

endif;

if ( ! function_exists( 'healthnews_woo_product_thumbnail_close' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked healthnews_woo_product_thumbnail_close - 15
     */

    function healthnews_woo_product_thumbnail_close(): void {
        do_action( 'healthnews_woo_button_quick_view' );
?>
        </div><!-- .site-shop__product--item-image -->

        <div class="site-shop__product--item-content">
<?php
    }
endif;

if ( ! function_exists( 'healthnews_woo_get_product_title' ) ) :
    /**
     * Hook: woocommerce_shop_loop_item_title.
     *
     * @hooked healthnews_woo_get_product_title - 10
     */

    function healthnews_woo_get_product_title(): void {
    ?>
        <h2 class="woocommerce-loop-product__title">
            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
    <?php
    }
endif;

if ( ! function_exists( 'healthnews_woo_after_shop_loop_item_title' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item_title.
     *
     * @hooked healthnews_woo_after_shop_loop_item_title - 15
     */
    function healthnews_woo_after_shop_loop_item_title(): void {
    ?>
        </div><!-- .site-shop__product--item-content -->
    <?php
    }
endif;

if ( ! function_exists( 'healthnews_woo_loop_add_to_cart_open' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked healthnews_woo_loop_add_to_cart_open - 4
     */

    function healthnews_woo_loop_add_to_cart_open(): void {
    ?>
        <div class="site-shop__product-add-to-cart">
    <?php
    }

endif;

if ( ! function_exists( 'healthnews_woo_loop_add_to_cart_close' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked healthnews_woo_loop_add_to_cart_close - 12
     */

    function healthnews_woo_loop_add_to_cart_close(): void {
    ?>
        </div><!-- .site-shop__product-add-to-cart -->
    <?php
    }

endif;

if ( ! function_exists( 'healthnews_woo_before_shop_loop_item' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked healthnews_woo_before_shop_loop_item - 5
     */
    function healthnews_woo_before_shop_loop_item(): void {
    ?>

        <div class="site-shop__product--item">

    <?php
    }
endif;

if ( ! function_exists( 'healthnews_woo_after_shop_loop_item' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked healthnews_woo_after_shop_loop_item - 15
     */
    function healthnews_woo_after_shop_loop_item(): void {
    ?>

        </div><!-- .site-shop__product--item -->

    <?php
    }
endif;

if ( ! function_exists( 'healthnews_woo_before_shop_loop_open' ) ) :
    /**
     * Before Shop Loop
     * woocommerce_before_shop_loop hook.
     *
     * @hooked healthnews_woo_before_shop_loop_open - 5
     */
    function healthnews_woo_before_shop_loop_open(): void {

    ?>
        <div class="site-shop__result-count-ordering d-flex align-items-center justify-content-between">
    <?php

    }
endif;

if ( ! function_exists( 'healthnews_woo_before_shop_loop_close' ) ) :
    /**
     * Before Shop Loop
     * woocommerce_before_shop_loop hook.
     *
     * @hooked healthnews_woo_before_shop_loop_close - 35
     */
    function healthnews_woo_before_shop_loop_close(): void {

    ?>
        </div><!-- .site-shop__result-count-ordering -->
    <?php
    }

endif;

/*
* Single Shop
*/

if ( ! function_exists( 'healthnews_woo_before_single_product' ) ) :

    /**
     * Before Content Single  product
     *
     * woocommerce_before_single_product hook.
     *
     * @hooked healthnews_woo_before_single_product - 5
     */

    function healthnews_woo_before_single_product(): void {

    ?>
        <div class="site-shop-single">
    <?php

    }

endif;

if ( ! function_exists( 'healthnews_woo_after_single_product' ) ) :
    /**
     * After Content Single  product
     *
     * woocommerce_after_single_product hook.
     *
     * @hooked healthnews_woo_after_single_product - 30
     */

    function healthnews_woo_after_single_product(): void {

    ?>
        </div><!-- .site-shop-single -->
    <?php

    }

endif;

if ( !function_exists( 'healthnews_woo_before_single_product_summary_open_warp' ) ) :

    /**
     * Before single product summary
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked healthnews_woo_before_single_product_summary_open_warp - 1
     */

    function healthnews_woo_before_single_product_summary_open_warp(): void {

    ?>
        <div class="site-shop-single__warp">
    <?php

    }

endif;

if ( !function_exists( 'healthnews_woo_after_single_product_summary_close_warp' ) ) :

    /**
     * After single product summary
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked healthnews_woo_after_single_product_summary_close_warp - 5
     */

    function healthnews_woo_after_single_product_summary_close_warp(): void {

    ?>
        </div><!-- .site-shop-single__warp -->
    <?php

    }

endif;

if ( ! function_exists( 'healthnews_woo_before_single_product_summary_open' ) ) :
    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked healthnews_woo_before_single_product_summary_open - 5
     */

    function healthnews_woo_before_single_product_summary_open(): void {

    ?>
        <div class="site-shop-single__gallery-box">
    <?php

    }
endif;

if ( ! function_exists( 'healthnews_woo_before_single_product_summary_close' ) ) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked healthnews_woo_before_single_product_summary_close - 30
     */

    function healthnews_woo_before_single_product_summary_close(): void {

    ?>
        </div><!-- .site-shop-single__gallery-box -->
    <?php

    }
endif;