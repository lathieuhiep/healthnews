<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;
?>

<div id="et-quickview">
    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'item-product', $product ); ?>>
        <div class="row">
            <div class="col-12 col-md-6">
                <?php
                woocommerce_show_product_sale_flash();

                basictheme_quick_view_product_image();
                ?>
            </div>

            <div class="col-12 col-md-6">
                <div class="content_product_detail">
                    <h1 class="title-product">
                        <?php the_title(); ?>
                    </h1>

                    <div class="item-rating">
                        <?php woocommerce_template_loop_rating(); ?>
                    </div>

                    <?php woocommerce_template_single_excerpt(); ?>

                    <div class="item-price">
                        <?php woocommerce_template_loop_price(); ?>
                    </div>

                    <?php woocommerce_template_single_add_to_cart(); ?>

                    <div class="notice d-none">
                        <?php esc_html_e( 'Please choose the quantity of items you wish to add to your cart…', 'basictheme' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>