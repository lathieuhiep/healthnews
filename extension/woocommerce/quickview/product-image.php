<?php
defined( 'ABSPATH' ) || exit;

global $post, $product;

$attachment_ids = $product->get_gallery_image_ids();
$slider_disabled_class = ( count( $attachment_ids ) == 0 ) ? 'et-carousel-disabled' : 'et-quickview-owl owl-carousel owl-theme';

?>

<div class="item-product-img">
    <div id="et-quickview-slider" class="et-quickview-gallery-slider product-images <?php echo esc_attr( $slider_disabled_class ); ?>">
        <?php if ( has_post_thumbnail() ) : ?>

            <div class="woocommerce-product-gallery__image item-image" data-index="0">
                <?php the_post_thumbnail('full'); ?>
            </div>

        <?php else: ?>

            <div class="woocommerce-product-gallery__image--placeholder item-image" data-index="0">
                <img src="<?php echo wc_placeholder_img_src('full') ?>" alt="" />
            </div>

        <?php
        endif;

        if ( $attachment_ids ) :
            $index = 1;
            foreach ( $attachment_ids as $attachment_id ) :
                $image_link = wp_get_attachment_url( $attachment_id );

                if ( ! $image_link ) {
                    continue;
                }

        ?>
                <div class="woocommerce-product-gallery__image item-image" data-index="<?php echo esc_attr($index); ?>">
                    <?php echo wp_get_attachment_image($attachment_id, 'full'); ?>
                </div>
        <?php
	            $index++;
            endforeach;
        endif;
        ?>
    </div>
</div>
