<?php
// short code contact us
add_shortcode('ask_doctor' , 'clinic_shortcode_ask_doctor');
function clinic_shortcode_ask_doctor(): bool|string {
	ob_start();

	get_template_part( 'components/inc','ask-doctor' );

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}