<?php
$phone = healthnews_get_option('opt_general_phone');
$link_chat = healthnews_get_option('opt_general_link_chat');
?>

<div class="contact-us-mobile d-lg-none">
    <div class="warp">
        <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/chan-trang-pkdk.gif' ) ) ?>" alt="">

	    <?php if ( $phone ) : ?>
            <a class="item phone" href="tel:<?php echo esc_attr(healthnews_preg_replace_ony_number($phone)); ?>"></a>
	    <?php endif; ?>

        <?php if ( $link_chat ) : ?>
            <a class="item chat" href="<?php echo esc_url( $link_chat ); ?>" target="_blank"></a>
        <?php endif; ?>
    </div>
</div>