<?php
$call_phone = healthnews_get_option('opt_general_phone');
$chat_zalo = healthnews_get_option('opt_general_chat_zalo');
?>

<div class="chat-with-us">
	<?php
	if ( !empty( $chat_zalo ) ) :
		$zalo_phone = $chat_zalo['phone'];
		$zalo_qr_code = $chat_zalo['qr_code'];
		?>
        <a class="link chat-with-us__zalo" href="https://zalo.me/<?php echo esc_attr( healthnews_preg_replace_ony_number($zalo_phone) ) ?>" data-phone="<?php echo esc_attr($zalo_phone); ?>" data-qr-code="<?php echo esc_attr($zalo_qr_code); ?>">
            <img alt="zalo" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/zalo-icon-contact.png' ) ) ?>" width="50" height="" />
        </a>
	<?php endif; ?>

	<?php if ($call_phone) : ?>
        <a class="link chat-with-us__phone" href="tel:<?php echo esc_attr(healthnews_preg_replace_ony_number($call_phone)); ?>">
            <img alt="phone" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/phone-icon-contact.png' ) ) ?>" width="50" height="" />
        </a>
	<?php endif; ?>
</div>