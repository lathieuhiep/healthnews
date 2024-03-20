<?php
$medical_appointment_form = healthnews_get_opt_medical_appointment();
if ( $medical_appointment_form ) :
?>

	<!-- Modal medical appointment -->
	<div class="modal fade modal-appointment-form" id="modal-appointment-form" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">
						<?php esc_html_e('Đặt hẹn khám', 'clinic'); ?>
					</h3>

					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<div class="modal-body">
					<?php echo do_shortcode('[contact-form-7 id="' . $medical_appointment_form . '" ]'); ?>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>