<?php
// get hotline theme option general
function healthnews_get_opt_contact_hotline()
{
    return healthnews_get_option('opt_general_contact_hotline');
}

function healthnews_get_opt_contact_email()
{
    return healthnews_get_option('opt_general_contact_email');
}

function healthnews_get_opt_link_facebook() {
	return healthnews_get_option('opt_general_link_facebook');
}

// get medical appointment theme option general
function healthnews_get_opt_medical_appointment()
{
	return healthnews_get_option('opt_general_medical_appointment_form');
}
