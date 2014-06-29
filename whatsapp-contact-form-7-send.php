<?php

add_action( 'wpcf7_before_send_mail', 'wpcf7_whatsapp_before_send_mail');

function wpcf7_whatsapp_before_send_mail( $contactform ) {
	
	// make sure they have something in their contact form
	if ( empty( $contactform->posted_data ) || ! empty( $contactform->skip_mail ) ) {
		return;
	}

	// send form data
	$pro = get_option('wacf7-send-pro');
	if($pro == 'on'){
		$wame = new WhatsAppContactForm7();
		$wame->http_send($contactform->posted_data);
	}
	else{
		$wacf7_number = get_option('wacf7-msisdn');
		$wacf7_pass = get_option('wacf7-password');
		$wacf7_id = get_option('wacf7-id');
		$wacf7_display_name = get_option('wacf7-display-name');
		
		if(!empty($wacf7_number) && !empty($wacf7_pass) && !empty($wacf7_id) && !empty($wacf7_display_name)){
			$wa = new WhatsProt($wacf7_number, $wacf7_id, $wacf7_display_name, false);
	        $wa->connect();
	        $wa->loginWithPassword($wacf7_pass);
	       	$wa->sendMessageComposing($wacf7_number);
	        $result = $wa->sendMessage($wacf7_number, 'Somebody has contacted you on your Contact form 7!');
		}	
	}
	
	//$form_id = $contactform->id;
}
?>