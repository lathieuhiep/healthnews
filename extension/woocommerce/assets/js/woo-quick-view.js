/**
 * Quick view product
 */

(function ($) {
    "use strict";

    // quick view product
    let mode_quick_view_product = $('.mode-quick-view-product'),
        btn_quick_view_product = $('.btn-quick-view-product'),
        loading_body = $('.loading-body'),
        quick_view_product_body = $('.quick-view-product-body');

    btn_quick_view_product.on('click', function (e) {
        e.preventDefault();

        let product_id = $(this).data('id-product');

        $.ajax({
            url: woo_quick_view_product.url,
            type: 'POST',
            data: ({
                action: 'healthnews_get_quick_view_product',
                product_id: product_id
            }),

            success: function (data) {
                if (data) {
                    quick_view_product_body.empty().append(data);
                    loading_body.fadeOut();
                }
            },

            complete: function(){
                addToCartAjax(product_id);
            },
        });

        return false;
    });

    // add to cart ajax quick view
    let addToCartAjax = function (product_id) {
        let quickViewBox = $("#et-quickview"),
            childrenProductId = quickViewBox.children("#product-" + product_id),
            formCart = childrenProductId.find("form.cart"),
            hasProductVariable = childrenProductId.hasClass("product-type-variable"),
            quickViewSlider = $("#et-quickview-slider"),
            quickViewOwl = childrenProductId.find('.et-quickview-owl');

        quickViewOwl.owlCarousel({
            items: 1,
            loop: true,
            nav: false,
            autoplaySpeed: 800,
            navSpeed: 800,
            dotsSpeed: 800,
        });

        if ( hasProductVariable ) {
            formCart.wc_variation_form().find(".variations select:eq(0)").change();

            if ( quickViewSlider.length ) {
                if ( quickViewSlider.hasClass("owl-carousel") ) {
                    quickViewSlider = $(".owl-item:not(.cloned)", quickViewSlider).eq(0);
                }

                const itemImage = $(".item-image", quickViewSlider).eq(0).find("img");
                childrenProductId = itemImage.attr("src");

                if ( itemImage.attr("data-src") ) {
                    childrenProductId = itemImage.attr("data-src");
                }

                formCart.on("show_variation", function (e, t) {
                    const urlImage = t.image.url;

                    if ( t.hasOwnProperty("image") && urlImage ) {
                        const indexItem = $('.et-quickview-owl').find('.owl-item:not(.cloned) img[src="'+ urlImage +'"]').closest('.item-image').data('index');

                        if ( indexItem !== undefined ) {
                            quickViewOwl.trigger('to.owl.carousel', indexItem, [800]);
                        } else {
                            if ( urlImage !== itemImage.attr("src") ) {
                                itemImage.attr("src", urlImage).attr("srcset", "");
                                quickViewOwl.trigger('to.owl.carousel', 0, [800]);
                            }
                        }
                    }

                }).on("reset_image", function () {
                    itemImage.attr("src", childrenProductId).attr("srcset", "");
                    quickViewOwl.trigger('to.owl.carousel', 0, [800]);
                })
            }
        }
    }

    // method hidden modal
    mode_quick_view_product.on('hidden.bs.modal', function () {

        loading_body.fadeIn();
        quick_view_product_body.empty();

    })

    // add product quick view
    quick_view_product_body.on('click', '.single_add_to_cart_button', function (e) {
        e.preventDefault();
        const content_product_detail = $('.content_product_detail');
        content_product_detail.find('.notice').addClass('d-none');

        let $thisButton = $(this),
            $form = $thisButton.closest('form.cart'),
            hasClassGroupedForm = $form.hasClass('grouped_form'),
            id = '',
            product_qty = '',
            product_id = '',
            variation_id = '',
            data;

        if ( hasClassGroupedForm ) {
            const dataForm = $form.serializeArray();
            let keys = [];
            let values = [];

            if ( dataForm.length ) {

                dataForm.map( function ( item ) {
                    if ( item.name === 'add-to-cart' ) {
                        product_id = item.value;
                    } else {
                        const product_id = parseInt(item.name.replace(/[^0-9.]/g, ""));
                        const quantity = item.value;

                        keys.push(product_id);
                        values.push(quantity);
                    }
                } )

            }

            let items = {};

            for( let i = 0; i < keys.length; i++ ) {
                items[keys[i]] = values[i];
            }

            data = {
                action: 'healthnews_woo_ajax_add_to_cart',
                product_id: product_id,
                product_sku: '',
                items: items,
                type_product: 'grouped'
            };

        } else {
            id = $thisButton.val();
            product_qty = $form.find('input[name=quantity]').val() || 1;
            product_id = $form.find('input[name=product_id]').val() || id;
            variation_id = $form.find('input[name=variation_id]').val() || 0;

            data = {
                action: 'healthnews_woo_ajax_add_to_cart',
                product_id: product_id,
                product_sku: '',
                quantity: product_qty,
                variation_id: variation_id,
                type_product: ''
            };
        }

        $(document.body).trigger('adding_to_cart', [$thisButton, data]);

        $.ajax({
            url: woo_quick_view_product.url,
            type: 'POST',
            data: data,
            beforeSend: function () {
                $thisButton.removeClass('added').addClass('loading');
            },

            complete: function () {
                $thisButton.addClass('added').removeClass('loading');
            },

            success: function ( response ) {

                if ( response.error && response.product_url ) {
                    window.location = response.product_url;
                } else if ( response === '' ) {
                    content_product_detail.find('.notice').removeClass('d-none');
                } else {
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisButton]);
                }

            },

        });

        return false;
    })

})(jQuery);