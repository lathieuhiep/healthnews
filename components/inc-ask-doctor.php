<?php
$link_chat = healthnews_get_option('opt_general_link_chat');
$title = healthnews_get_option('opt_ask_doctor_title');
$content = healthnews_get_option('opt_ask_doctor_content');

if ( $link_chat ) :
?>

<div class="ask-doctor">
	<div class="thumbnail">
		<img alt="zalo" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/bs-trong.jpg' ) ) ?>" width="50" height="" />
	</div>

	<div class="content">
		<h4 class="title">
			<?php echo esc_html( $title ); ?>
		</h4>

		<div class="desc">
			<?php echo wpautop( $content ); ?>
		</div>

		<div class="action">
			<a href="<?php echo esc_url( $link_chat ); ?>" target="_blank">
				<?php esc_html_e( 'Hỏi bác sĩ', 'healthnews' ); ?>
			</a>
		</div>
	</div>
</div>

<?php
endif;