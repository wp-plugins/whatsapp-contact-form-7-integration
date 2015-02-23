<?php
/*
Plugin Name: WhatsApp - Contact Form 7 Integration
Plugin URI: http://www.wassame.com/plugins/whatsapp-contact-form-7/
Description: Send a message directly to your WhatsApp account through Contact Form 7 forms
Author: Ben Van Nimmen
Author URI: http://www.vnbenny.com/
Version: 1.1
*/

define( 'WACF7__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WACF7__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if(!class_exists('WhatsProt')){
	require_once(WACF7__PLUGIN_DIR.'whatsapp/whatsprot.class.php');
}

define( 'WHATSPROT', true );
require_once(WACF7__PLUGIN_DIR.'whatsapp-contact-form-7-send.php');

if(is_admin()){
	require_once('class.whatsapp-contact-form-7-admin.php');
	add_action( 'init', array( 'WhatsAppContactForm7_Admin', 'init' ) );
}
