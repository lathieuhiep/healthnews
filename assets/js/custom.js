/**
 * Custom js v1.0.0
 * Copyright 2017-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    let timer_clear;

    $( document ).ready( function () {

        /* Start back top */
        $('.btn-back-top').on( 'click', function (e) {
            e.preventDefault();
            $('html').scrollTop(0)
        } )
        /* End back top */

        /* btn mobile Start*/
        let subMenuToggle  =   $('.sub-menu-toggle')

        if ( subMenuToggle.length ) {

            subMenuToggle.each(function () {
                $(this).on( 'click', function () {
                    const widthScreen = $(window).width();

                    if ( widthScreen < 992 ) {
                        $(this).toggleClass('active');
                        $(this).closest( '.menu-item-has-children' ).siblings().find( subMenuToggle ).removeClass( 'active' );
                        $(this).parent().children( '.sub-menu' ).slideToggle();
                        $(this).parents( '.menu-item-has-children' ).siblings().find( '.sub-menu' ).slideUp();
                    }

                } )
            })

        }
        /* btn mobile End */

        /* Start Gallery Single */
        $( document ).general_owlCarousel_custom( '.site-post-slides' )
        /* End Gallery Single */

        // Update the clock every second
        setInterval(updateClock, 1000);
        updateClock();

        // handle zalo click
        handleZaLoClick()
    });

    // loading
    $( window ).on( "load", function() {
        $( '#site-loading' ).remove();
    });

    // scroll event
    $( window ).scroll( function() {
        if ( timer_clear ) clearTimeout(timer_clear);

        timer_clear = setTimeout( function() {

            /* Start scroll back top */
            let $scrollTop = $(this).scrollTop();

            if ( $scrollTop > 200 ) {
                $('#back-top').addClass('active_top');
            }else {
                $('#back-top').removeClass('active_top');
            }
            /* End scroll back top */

        }, 100 );

    });

    // function call owlCarousel
    $.fn.general_owlCarousel_custom = function ( class_item ) {

        let class_item_owlCarousel   =   $( class_item );

        if ( class_item_owlCarousel.length ) {

            class_item_owlCarousel.each( function () {

                let slider = $(this);

                if ( !slider.hasClass('owl-carousel-init') ) {

                    let defaults = {
                        autoplaySpeed: 800,
                        navSpeed: 800,
                        dotsSpeed: 800,
                        autoHeight: false,
                        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                    };

                    let config = $.extend( defaults, slider.data( 'settings-owl') );

                    slider.owlCarousel( config ).addClass( 'owl-carousel-init' );

                }

            } )

        }

    }

    const updateClock = () => {
        const daysOfWeek = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'];

        const now = new Date();
        const dayOfWeek = daysOfWeek[now.getDay()];
        const day = now.getDate().toString().padStart(2, '0');
        const month = (now.getMonth() + 1).toString().padStart(2, '0'); // Tháng bắt đầu từ 0
        const year = now.getFullYear();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');

        // Lấy thông tin về múi giờ (GMT)
        const gmtOffset = now.getTimezoneOffset() / 60;
        const gmtSign = gmtOffset > 0 ? '-' : '+ ';
        const gmtString = `GMT ${gmtSign}${Math.abs(gmtOffset).toString().padStart(2, '0')}:00`;

        const clockElement = document.getElementById('clock');
        clockElement.textContent = `${dayOfWeek}, ${day}/${month}/${year}, ${hours}:${minutes}:${seconds} [${gmtString}]`;
    }

    // handle check mobile device
    const isMobileDevice = () => {
        return /iPhone|iPad|iPod|Android/i.test(navigator.userAgent)
    }

    // handle click zalo
    const handleZaLoClick = () => {
        const chatWithUsZalo = $('.chat-with-us__zalo')

        if ( chatWithUsZalo.length ) {
            chatWithUsZalo.on('click', function (e) {
                e.preventDefault()

                let link;
                const phone = $(this).data('phone')
                const qrCode = $(this).data('qr-code')

                if ( isMobileDevice() ) {
                    if (navigator.userAgent.includes('Android')) {
                        // android
                        link = `https://zaloapp.com/qr/p/${qrCode}`;
                    } else {
                        // ios
                        link = `zalo://qr/p/${qrCode}`;
                    }
                } else {
                    // pc
                    link = `zalo://conversation?phone=${phone}`
                }

                window.open(link, '_parent');
            })
        }
    }

} )( jQuery );