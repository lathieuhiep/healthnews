<?php

/**
 * Shop WooCommerce Hooks
 */

/**
 * Layout
 *
 * @see healthnews_get_cart()
 * @see healthnews_button_quick_view()
 * @see healthnews_woo_before_main_content()
 * @see healthnews_woo_before_shop_loop_open()
 * @see healthnews_woo_before_shop_loop_close()
 * @see healthnews_woo_before_shop_loop_item()
 * @see healthnews_woo_after_shop_loop_item()
 * @see healthnews_woo_product_thumbnail_open()
 * @see healthnews_woo_product_thumbnail_close()
 * @see healthnews_woo_get_product_title()
 * @see healthnews_woo_after_shop_loop_item_title()
 * @see healthnews_woo_loop_add_to_cart_open()
 * @see healthnews_woo_loop_add_to_cart_close()
 * @see healthnews_woo_get_sidebar()
 * @see healthnews_woo_after_main_content()
 * @see healthnews_popup_quick_view_product()
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_action( 'healthnews_woo_shopping_cart', 'healthnews_get_cart', 5 );

add_action( 'healthnews_woo_button_quick_view', 'healthnews_button_quick_view', 5 );

add_action( 'woocommerce_before_main_content', 'healthnews_woo_before_main_content', 10 );

add_action( 'woocommerce_before_shop_loop', 'healthnews_woo_before_shop_loop_open',  15 );
add_action( 'woocommerce_before_shop_loop', 'healthnews_woo_before_shop_loop_close',  35 );

add_action( 'woocommerce_before_shop_loop_item_title', 'healthnews_woo_product_thumbnail_open', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'healthnews_woo_product_thumbnail_close', 15 );

add_action( 'woocommerce_shop_loop_item_title', 'healthnews_woo_get_product_title', 10 );

add_action( 'woocommerce_after_shop_loop_item_title', 'healthnews_woo_after_shop_loop_item_title', 15 );

add_action( 'woocommerce_after_shop_loop_item', 'healthnews_woo_loop_add_to_cart_open', 4 );
add_action( 'woocommerce_after_shop_loop_item', 'healthnews_woo_loop_add_to_cart_close', 12 );

add_action ( 'woocommerce_before_shop_loop_item', 'healthnews_woo_before_shop_loop_item', 5 );
add_action ( 'woocommerce_after_shop_loop_item', 'healthnews_woo_after_shop_loop_item', 15 );

add_action( 'healthnews_woo_sidebar', 'healthnews_woo_get_sidebar', 10 );

add_action( 'woocommerce_after_main_content', 'healthnews_woo_after_main_content', 10 );

add_action( 'woocommerce_after_main_content', 'healthnews_popup_quick_view_product', 12 );

/**
 * Single Product
 *
 * @see healthnews_woo_before_single_product()
 * @see healthnews_woo_before_single_product_summary_open_warp()
 * @see healthnews_woo_before_single_product_summary_open()
 * @see healthnews_woo_before_single_product_summary_close()
 * @see healthnews_woo_after_single_product_summary_close_warp()
 * @see healthnews_woo_after_single_product()
 *
 */

add_action( 'woocommerce_before_single_product', 'healthnews_woo_before_single_product', 5 );

add_action( 'woocommerce_before_single_product_summary', 'healthnews_woo_before_single_product_summary_open_warp',  1 );

add_action( 'woocommerce_before_single_product_summary', 'healthnews_woo_before_single_product_summary_open', 5 );
add_action( 'woocommerce_before_single_product_summary', 'healthnews_woo_before_single_product_summary_close', 30 );

add_action( 'woocommerce_after_single_product_summary', 'healthnews_woo_after_single_product_summary_close_warp', 5 );

add_action( 'woocommerce_after_single_product', 'healthnews_woo_after_single_product', 30 );

