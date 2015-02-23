<?php

add_action( 'wpcf7_before_send_mail', 'wpcf7_whatsapp_before_send_mail');

function wpcf7_whatsapp_before_send_mail( $contactform ) {
	
	$submission = WPCF7_Submission::get_instance();
	$data =& $submission->get_posted_data();

	$wacf7_number = get_option('wacf7_msisdn');
	$wacf7_pass = get_option('wacf7_password');
	$wacf7_id = get_option('wacf7_id');
	$wacf7_display_name = get_option('wacf7_display_name');
	$wacf7_send_to = get_option('wacf7_send_to');
	
	if(empty($wacf7_number)){
		error_log('Number empty');
	}
	if(empty($wacf7_pass)){
		error_log('Password empty');
	}
	if(empty($wacf7_id)){
		error_log('Id empty');
	}
	if(empty($wacf7_display_name)){
		error_log('Display name empty');
	}
	if(empty($wacf7_send_to)){
		error_log('Sent to number is empty');
	}

	
	$wpcf7_email = $data['your-email'];
	$wpcf7_subject = $data['your-subject'];
	$wpcf7_message = $data['your-message'];
	$wpcf7_name = $data['your-name'];
	
	if(!empty($wacf7_number) && !empty($wacf7_pass) && !empty($wacf7_id) && !empty($wacf7_display_name) && !empty($wacf7_send_to)){
		$wa = new WhatsProt($wacf7_number, $wacf7_id, $wacf7_display_name, false);
        $connect = $wa->connect();
		if($connect){
	        $login = $wa->loginWithPassword($wacf7_pass);
			if($login){
				$wa->sendMessageComposing($wacf7_number);
				$result = $wa->sendMessage($wacf7_send_to, 'Somebody has contacted you on your Contact form 7!');
				if(!$result){
					error_log('Failed send the message to '.$wacf7_number);
				}
			}
			else{
				error_log('Failed to log in with '.$wacf7_number);
			}
		}else{
			error_log('Failed to connect with '.$wacf7_number);
		}
	}
	else{
		error_log('Not all data set!');
	}	
	
}
?>