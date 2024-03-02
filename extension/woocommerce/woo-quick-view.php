<?php

/*
* Quick view product
*/
function healthnews_button_quick_view() {

?>

    <a class="btn-quick-view-product" href="#" title="<?php esc_attr_e( 'Quick view product', 'healthnews' ); ?>" data-id-product="<?php echo esc_attr( get_the_ID() ); ?>" data-bs-toggle="modal" data-bs-target="#mode-quick-view-product">
        <?php esc_html_e('Xem nhanh'); ?>
    </a>

<?php

}

function healthnews_popup_quick_view_product() {

?>

    <div class="modal fade mode-quick-view-product" id="mode-quick-view-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="loading-body">
                        <div class="icon-loading"></div>
                    </div>
                    <div class="quick-view-product-body"></div>
                </div>
            </div>
        </div>
    </div>

<?php

}

/* Ajax quick view product */
add_action( 'wp_ajax_nopriv_healthnews_get_quick_view_product', 'healthnews_get_quick_view_product' );
add_action( 'wp_ajax_healthnews_get_quick_view_product', 'healthnews_get_quick_view_product' );

function healthnews_get_quick_view_product() {

    $product_id   =   $_POST['product_id'];

    $args = array(
	    'post_type' =>  'product',
        'post__in'  =>  array( $product_id )
    );

	$query = new WP_Query( $args );

	while ( $query->have_posts() ): $query->the_post();

        get_template_part( 'extension/woocommerce/quickview/content', 'quickview' );

	endwhile; wp_reset_postdata();
    wp_die();
}

/* Quick view product image */
function healthnews_quick_view_product_image() {
    get_template_part( 'extension/woocommerce/quickview/product', 'image' );
}


/* Add to cart quick view */
add_action('wp_ajax_healthnews_woo_ajax_add_to_cart', 'healthnews_woo_ajax_add_to_cart');
add_action('wp_ajax_nopriv_healthnews_woo_ajax_add_to_cart', 'healthnews_woo_ajax_add_to_cart');

function healthnews_woo_ajax_add_to_cart() {

    $type_product = $_POST['type_product'];

    if ( $type_product ) {
        $was_added_to_cart = false;
        $items = $_POST['items'];

        if ( !empty( $items ) ) {
            $quantity_set = false;

            foreach ( $items as $item => $quantity ) {
                $quantity = wc_stock_amount( $quantity );

                if ( $quantity <= 0 ) {
                    continue;
                }

                $quantity_set = true;
                $product_status = get_post_status($item);
                // Add to cart validation.
                $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $item, $quantity );

                if ( $passed_validation && WC()->cart->add_to_cart($item, $quantity ) && 'publish' === $product_status ) {

                    do_action('woocommerce_ajax_added_to_cart', $item);

                    if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
                        wc_add_to_cart_message(array($item => $quantity), true);
                    }

                    $was_added_to_cart = true;

                } else {

                    $data = array(
                        'error' => true,
                        'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($item), $item)
                    );

                    wp_send_json($data);
                }

            }

            if ( $was_added_to_cart ) {
                WC_AJAX :: get_refreshed_fragments();
            }

        }

    } else {

	    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ));
	    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
	    $variation_id = absint($_POST['variation_id']);
	    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
	    $product_status = get_post_status($product_id);

	    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

		    do_action('woocommerce_ajax_added_to_cart', $product_id);

		    if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
			    wc_add_to_cart_message(array($product_id => $quantity), true);
		    }

		    WC_AJAX :: get_refreshed_fragments();
	    } else {

		    $data = array(
			    'error' => true,
			    'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id));

		    wp_send_json($data);
	    }

    }

	wp_die();
}