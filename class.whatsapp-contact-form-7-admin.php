<?php

class WhatsAppContactForm7_Admin {
	
	private static $initiated = false;
	
	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}	
	}
	
	public static function init_hooks() {
		add_action( 'admin_menu', array( 'WhatsAppContactForm7_Admin', 'admin_menu' ) );
		add_action( 'admin_init', array( 'WhatsAppContactForm7_Admin', 'register_admin_settings') );
		add_action( 'admin_head', array( 'WhatsAppContactForm7_Admin', 'css' ) );		
		self::$initiated = true;

	}
	public static function register_admin_settings() {	
		register_setting( 'whatsapp_contact_form_7', 'wacf7_msisdn' ); 
		register_setting( 'whatsapp_contact_form_7', 'wacf7_password' ); 
		register_setting( 'whatsapp_contact_form_7', 'wacf7_id' ); 
		register_setting( 'whatsapp_contact_form_7', 'wacf7_display_name' ); 
		register_setting( 'whatsapp_contact_form_7', 'wacf7_send_to' ); 
		register_setting( 'whatsapp_contact_form_7', 'wacf7_installed' ); 
	} 
	
	public static function css(){
		?>
		<style type="text/css">
		.wacf7-success, .wacf7-danger, .wacf7-warning{
			background-color: #dff0d8;
			border-color: #d6e9c6;
			color: #3c763d;
			padding: 15px;
			margin-bottom: 20px;
			border: 1px solid #B8E3B9;
			border-radius: 4px;
			font-size:16px;
			box-sizing: border-box; margin-top:20px;
		}
		.wacf7-warning{
			background-color: #fcf8e3;
			border-color: #faebcc;
			color: #8a6d3b;
			border: 1px solid #E6D4B5;
		}
		.wacf7-danger{
			background-color: #f2dede;
			border-color: #ebccd1;
			color: #a94442;
			border: 1px solid #F1B8B6;
		}
		.wacf7-input{
			padding:5px; width:500px;
		}
		.bg{
			background:url('<?=WACF7__PLUGIN_URL?>assets/bg.png') repeat;
		}
		.wame_checkbox(){
			float:left; padding:10px;
		}
		.boot-content {
		  	position: relative;
			width:100%;
			 height:auto;
		}
		.boot-clear{
			width:100%; height:1px; clear:both;
		}
		.row {
			width:100%;
		  	margin-bottom: 20px;
			height:auto;
			margin-top:15px;
		}
		.boot-contpad{
			margin-right:20px; width:auto; height:auto;
		}
		.boot-allpadd{
			padding:15px;
		}
		.boot-right{
			float:right;
		}
		.boot-box{
			background: #fbfbfb;
			padding: 20px 20px 30px;
			margin-right:10px;
			border-radius: 6px;
			-moz-border-radius: 6px;
			-webkit-border-radius: 6px;
			-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
			-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
		}
		.boot-box a{
			color:#8fc04e!important;
		}
		.boot-plugin{
			padding:20px; position:relative;
		}
		.btn-color {
			border: 1px solid #8fc04e;
			background: #8fc04e;
		}
		.btn {
			outline: 0;
			-webkit-border-radius: 4px;
			-moz-border-radius: 4px;
			border-radius: 4px;
		}
		.btn {
			color:white;
			font-size: 14px;
			font-weight: 600;
			text-shadow: none;
			background-image: none;
			border-color: none;
			border-bottom-color: none;
			-webkit-box-shadow: none;
			-moz-box-shadow: none;
			box-shadow: none;
			display: inline-block;
			padding: 6px 12px;
			margin-bottom: 0;
			font-size: 14px;
			font-weight: normal;
			line-height: 1.42857143;
			text-align: center;
			white-space: nowrap;
			vertical-align: middle;
			cursor: pointer;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			background-image: none;
			border: 1px solid transparent;
			border-radius: 4px;
		}
		
		.boot-type{
			background: #8fc04e;
			position: absolute;
			width: auto;
			height: auto;
			right: 10px;
			top: 10px;
			color: white;
			padding: 10px;
			font-size:18px;
			padding-top: 12px;
			z-index: 9;
			border-radius: 10px
		}
		.boot-installed{
			width:80%; height:auto; padding:10%; background:#8fc04e; color:white; left:0px; right:0px; bottom:20px; position:absolute; text-align:center; opacity:0.6;
		}
		.btn-color:hover{
		  	background: #4b5056!important;
		   	color:#fff!important;
		  	border:1px solid #4b5056;
		}
	  	.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
	    	float: left;
			position: relative;
			min-height: 1px;
	  	}
	  	.col-md-12 {
	   	 	width: 100%;
	  	}
	  	.col-md-11 {
	    	width: 91.66666667%;
	  	}
	  	.col-md-10 {
	   	 	width: 83.33333333%;
	  	}
	  	.col-md-9 {
	    	width: 75%;
	  	}
	  	.col-md-8 {
	    	width: 66.66666667%;
	  	}
	  	.col-md-7 {
	    	width: 58.33333333%;
	  	}
		.col-md-6 {
			width: 50%;
		}
		.col-md-5 {
			width: 41.66666667%;
		}
		.col-md-4 {
			width: 33.33333333%;
		}
		.col-md-3 {
			width: 25%;
		}
		.col-md-2 {
			width: 16.66666667%;
		}
		.col-md-1 {
			width: 8.33333333%;
		}
	  
	  
		.container .jumbotron,
		.container-fluid .jumbotron {
			border-radius: 6px;
		}
		.jumbotron .container {
			max-width: 100%;
		}
	  
	    .form-inline .form-group {
	     	display: inline-block;
	      	margin-bottom: 0;
	      	vertical-align: middle;
	    }
		.form-control {
			display: block;
			width: 100%;
			height: 34px;
			padding: 6px 12px;
			font-size: 14px;
			line-height: 1.42857143;
			color: #555;
			background-color: #fff;
			background-image: none;
			border: 1px solid #ccc;
			border-radius: 4px;
			-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
			box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
			-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
			-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
			transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
		}
		hr {
			display: block;
			width: 100%;
			height: 1px;
			border: 0;
			border-top: 1px solid #eceae6;
			margin: 1em 0;
			padding: 0;
		}
		@media screen and (min-width: 768px) {
			.jumbotron {
				padding: 48px 0;
			}
			.container .jumbotron,
			.container-fluid .jumbotron {
				padding-right: 60px;
				padding-left: 60px;
			}
			.jumbotron h1,
			.jumbotron .h1 {
				font-size: 63px;
			}
		}
		.boot-nomar{
			margin:0px;
		}
		.list-group-item {
			position: relative;
			display: block;
			padding: 10px 15px;
			margin-bottom: -1px;
			background-color: #fff;
			border: 1px solid #ddd;
			color:#8fc04e!important;
		}	
		.alert{
			width:100%; margin:auto; text-align:center; border:1px solid #bb3d3d; background:#df5959; font-size:16px; color:white; margin-bottom:15px; border-radius: 4px;
		}
		.success{
			width:100%; margin:auto; text-align:center; border:1px solid #4BBB3D!important; background:#78C36B!important; font-size:16px; color:white; margin-bottom:15px;border-radius: 4px; padding:15px;
		}
		
		</style>
		<?php
	}
	public static function settings(){
		
		$installed = get_option('wacf7_installed');
		if($installed === false){
	       	update_option( 'wacf7_msisdn', '');
			update_option( 'wacf7_password', '');
			update_option( 'wacf7_id', '');
			update_option( 'wacf7_display_name', '');
			update_option( 'wacf7_send_to', '');
			update_option( 'wacf7_installed', 1);
		}
		?>
		<div class="wrap">			
			<form method="post" action="options.php">
				<div class="boot-content">
					<div class="boot-contpad">
			          	<div class="row">
							<div class="col-md-8">
								<div class="row">
					                <div class="col-md-6">
					  				   	<div class="boot-box">
					  				   	 	<h3><!--<img style="width:30px; height:auto;" src="<?php echo WACF7__PLUGIN_URL; ?>assets/plug-anonymous.png">--> WhatsApp Contact Form 7 Integration</h3>
											<?php echo settings_fields( 'whatsapp_contact_form_7' ); ?>
											<?php do_settings_sections( 'whatsapp_contact_form_7' ); ?>
											<div class="form-group wame-label" style="margin-bottom:10px;">
											    <label for="mobile-number"><?php echo __( 'WhatsApp Mobile number' , 'whatsapp_contact_form_7'); ?></label>
												    <input type="text" class="form-control" name="wacf7_msisdn" placeholder="<?php echo __( 'WhatsApp number' , 'whatsapp_contact_form_7'); ?>" data-emoji_font="true" value="<?php echo get_option('wacf7_msisdn'); ?>">
													<span style="color:gray; font-size:12px;"><?php echo __( 'The mobile number, including country code and without "+", example: 34659572846 (Spain) or 447230399814 (UK)' , 'whatsapp_contact_form_7'); ?></span>
											</div>
											<hr>
											<div class="form-group" style="margin-bottom:10px;">
											    <label class="wame-label" for="mobile-number"><?php echo __( 'WhatsApp password' , 'whatsapp_contact_form_7'); ?></label>
											    <input type="text" class="form-control" name="wacf7_password" placeholder="<?php echo __( 'WhatsApp password' , 'whatsapp_contact_form_7'); ?>" value="<?php echo get_option('wacf7_password'); ?>">
												<span style="color:gray; font-size:12px;"><?php echo __( 'The WhatsApp password obtained through the' , 'whatsapp_contact_form_7'); ?> <a target="_blank" href="http://wassame.com/tool/register-whatsapp-account/"><?php echo __( 'WhatsApp registration tool' , 'whatsapp_contact_form_7'); ?></a></span>
											</div>
											<hr>
											<div class="form-group" style="margin-bottom:10px;">
											    <label class="wame-label" for="mobile-number"><?php echo __( 'WhatsApp ID' , 'whatsapp_contact_form_7'); ?></label>
											    <input type="text" class="form-control" name="wacf7_id" placeholder="<?php echo __( 'WhatsApp ID' , 'whatsapp_contact_form_7'); ?>" value="<?php echo get_option('wacf7_id'); ?>">
												<span style="color:gray; font-size:12px;"><?php echo __( 'The WhatsApp ID obtained through the' , 'whatsapp_contact_form_7'); ?> <a target="_blank" href="http://wassame.com/tool/create-whatsapp-id/"><?php echo __( 'WhatsApp ID creation tool' , 'whatsapp_contact_form_7'); ?></a></span>
											</div>
											<hr>
											<div class="form-group" style="margin-bottom:10px;">
											    <label  class="wame-label" for="mobile-number"><?php echo __( 'Display Name' , 'whatsapp_contact_form_7'); ?></label>
											    <input type="text" class="form-control" name="wacf7_display_name" placeholder="<?php echo __( 'Display name' , 'whatsapp_contact_form_7'); ?>" value="<?php echo get_option('wacf7_display_name'); ?>">
												<span style="color:gray; font-size:12px;"><?php echo __( 'This is the name that show when the messages arrives (notifiaction)' , 'whatsapp_contact_form_7'); ?></span>
											</div>
											<hr>
											<div class="form-group" style="margin-bottom:10px;">
											    <label  class="wame-label" for="mobile-number"><?php echo __( 'Send to' , 'whatsapp_contact_form_7'); ?></label>
											    <input type="text" class="form-control" name="wacf7_send_to" placeholder="<?php echo __( 'Send to' , 'whatsapp_contact_form_7'); ?>" value="<?php echo get_option('wacf7_send_to'); ?>">
												<span style="color:gray; font-size:12px;"><?php echo __( 'The mobile number you want the messages sent to, including country code and without "+", example: 34659572846 (Spain) or 447230399814 (UK)' , 'whatsapp_contact_form_7'); ?></span>
											</div>
					  				   	</div>     
					                </div>
					                <div class="col-md-6">
					   				  	<div class="boot-box">
											<img style="width:100%; height:auto;" src="<?php echo WACF7__PLUGIN_URL; ?>assets/wassamelogo.png">
					   				   	 	<h3><?php echo __( 'Important information' , 'whatsapp_contact_form_7'); ?></h3>
											<p style="color:red;"><?php echo __( 'If you do not own your WhatsApp credentials, you may obtain them by using the <a target="_blank" href="http://wassame.com/tool/register-whatsapp-account/">registration tool</a>, (Please be aware that trying to obtain your WhatsApp password with an already existing account on mobile could permanently break your mobile version WhatsApp, If you would like to<b>, if you are lost </b>, contact us at <a target="_blank" href="http://wassame.com/contact-us/">Wassame.com</a>' , 'whatsapp_contact_form_7'); ?></p>
											<hr>
											<p><?php echo __( 'Once you have set up your WhatsApp account on the left and placed a number the message should get sent to you can start using the plugin!' , 'whatsapp_contact_form_7'); ?></p>
											
					   				   	</div>
					                </div>
								</div>
							</div>
			                <div class="col-md-4">
								<div class="widget list-group">
									<h3><?php echo __( 'Wassame\'s Free WhatsApp Tools', 'whatsapp_contact_form_7'); ?></h3>
										<a target="_blank" href="http://wassame.com/tool/create-whatsapp-id/" class="list-group-item active"><?php echo __( 'Create WhatsApp ID' , 'whatsapp_contact_form_7'); ?></a>
										<a target="_blank" href="http://wassame.com/tool/whatsapp-account-login-checker/" class="list-group-item "><?php echo __( 'WhatsApp account login checker', 'whatsapp_contact_form_7'); ?></a>
										<a target="_blank" href="http://wassame.com/tool/whatsapp-account-block-checker/" class="list-group-item "><?php echo __( 'WhatsApp account block checker', 'whatsapp_contact_form_7'); ?></a>
										<a target="_blank" href="http://wassame.com/tool/register-whatsapp-account/" class="list-group-item "><?php echo __( 'Register WhatsApp account', 'whatsapp_contact_form_7'); ?></a>
										<a target="_blank" href="http://wassame.com/tool/view-last-whatsapp-connection/" class="list-group-item "><?php echo __( 'View last WhatsApp connection', 'whatsapp_contact_form_7'); ?></a>
										<a target="_blank" href="http://wassame.com/tool/view-whatsapp-profile-picture/" class="list-group-item "><?php echo __( 'View WhatsApp profile picture', 'whatsapp_contact_form_7'); ?></a>
										<a target="_blank" href="http://wassame.com/tool/update-whatsapp-status/" class="list-group-item "><?php echo __( 'Update WhatsApp status', 'whatsapp_contact_form_7'); ?></a>
										<a target="_blank" href="http://wassame.com/tool/update-whatsapp-profile-picture/" class="list-group-item "><?php echo __( 'Update WhatsApp profile picture', 'whatsapp_contact_form_7'); ?></a>
								</div>
			   				   	<h3><?php echo __( 'Free WhatsApp plugins', 'whatsapp_contact_form_7'); ?></h3>
								<div class="row">
									<div class="col-md-6">
										<div class="boot-plugin">
											<div class="boot-installed"><?php echo __( 'Installed', 'whatsapp_contact_form_7'); ?></div>
											<a target="_blank" href=""><img style="width:100%; height:auto;" src="<?php echo WACF7__PLUGIN_URL; ?>assets/plugin-cf7.png"></a>
										</div>
									</div>
									<div class="col-md-6">
		
									</div>
								</div>
								<hr>
								<h3><?php echo __( 'Paid WhatsApp plugin', 'whatsapp_contact_form_7'); ?></h3>
								<div class="row">
									<div class="col-md-6">
										<div class="boot-plugin">
											<?php
												if( !get_option('wame_active') ) {
													echo '<div class="boot-type">'.__( 'Buy', 'whatsapp_contact_form_7').'</div>';
												}
												else{
													echo '<div class="boot-installed">'.__( 'Installed', 'whatsapp_contact_form_7').'!</div>';
												}
											?>
											<a target="_blank" href=""><img style="width:100%; height:auto;" src="<?php echo WACF7__PLUGIN_URL; ?>assets/plugin-anonymous.png"></a>
										</div>
									</div>
									<div class="col-md-6">
		
									</div>
								</div>
			                </div>
							<div class="boot-clear"></div>
			            </div>
						<div class="row">
							<div class="col-md-12">
								<?php submit_button(); ?>
							</div>
						</div>
					</div>
					<div class="boot-clear"></div>
			  	</div>
			</form>											
		</div>
		<?php
	}
	public static function admin_menu() {
		add_options_page(__('Whatsapp contact form 7 Settings', 'whatsapp_contact_form_7'),__('Whatsapp CF7 integration', 'whatsapp_contact_form_7'), 'read', 'whatsapp-contact-form-7-settings', array(  'WhatsAppContactForm7_Admin', 'settings' ) );
	}
}


?>