<?php
/*
Plugin Name: WhatsApp - Contact Form 7 Integration
Plugin URI: http://www.wassame.com/plugins/whatsapp-contact-form-7/
Description: Send a message directly to your WhatsApp account through Contact Form 7 forms
Author: Ben Van Nimmen
Author URI: http://www.vnbenny.com/
Version: 1.0
*/

// require the mailpoet signup field module
include('whatsapp/whatsprot.class.php');
include('whatsapp-contact-form-7-send.php');
include('class.whatsapp-contact-form-7.php');

if(is_admin()){
	include('class.whatsapp-contact-form-7-admin.php');
	add_action( 'init', array( 'WhatsAppContactForm7_Admin', 'init' ) );
}
