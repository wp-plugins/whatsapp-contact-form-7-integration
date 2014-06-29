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
		add_action( 'admin_init', array( 'WhatsAppContactForm7_Admin','register_admin_settings') );
		add_action( 'admin_head', array( 'WhatsAppContactForm7_Admin', 'css' ) );		
		self::$initiated = true;

	}
	function register_admin_settings() {
		register_setting( 'whatsapp-contact-form-7', 'wacf7-wassame-key' ); 
		register_setting( 'whatsapp-contact-form-7', 'wacf7-wassame-active' ); 
		register_setting( 'whatsapp-contact-form-7', 'wacf7-wassame-mobile' ); 		
		register_setting( 'whatsapp-contact-form-7', 'wacf7-msisdn' ); 
		register_setting( 'whatsapp-contact-form-7', 'wacf7-password' ); 
		register_setting( 'whatsapp-contact-form-7', 'wacf7-id' ); 
		register_setting( 'whatsapp-contact-form-7', 'wacf7-display-name' ); 
		register_setting( 'whatsapp-contact-form-7', 'wacf7-send-pro' ); 
	} 
	
	function css(){
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
		</style>
		<?php
	}
	function settings(){
		?>
		<div class="wrap">
			<?php

			if(isset($_POST['free-submit'])){
				$wacf7_msisdn = $_POST['wacf7-msisdn'];
				$wacf7_password = $_POST['wacf7-password'];
				$wacf7_id = $_POST['wacf7-id'];
				$wacf7_display_name = $_POST['wacf7-display-name'];
				update_option( 'wacf7-msisdn', $wacf7_msisdn );
				update_option( 'wacf7-password', $wacf7_password );
				update_option( 'wacf7-id', $wacf7_id );
				update_option( 'wacf7-display-name', $wacf7_display_name );
			}
			if(isset($_POST['pro-submit'])){
				$wacf7_key = $_POST['wacf7-wassame-key'];			
				$wacf7_mobile = $_POST['wacf7-wassame-mobile'];	
				$wacf7_pro = $_POST['wacf7-send-pro'];
				update_option( 'wacf7-wassame-key', $wacf7_key );
				update_option( 'wacf7-wassame-mobile', $wacf7_mobile );	
				update_option( 'wacf7-send-pro', $wacf7_pro );				
			}
			
			if(isset($_POST['verify'])){
				$wame = new WhatsAppContactForm7();
				$number = trim($_POST['number']);
				$number = str_replace(' ', '', $number);
				$v_obj = $wame->http_verify($number);
				$v_result = json_decode($v_obj['body'], true);
				if($v_result['res'] == 1){
					update_option( 'wacf7-wassame-active', 1 );
					update_option( 'wacf7-wassame-mobile', $number );
					echo '<div class="wacf7-success"><b>'.__('Success', 'whatsapp-contact-form-7').'</b> '.$v_result['msg'].'</div>';	
				}
				else{
					update_option( 'wacf7-wassame-active', 0 );
					echo '<div class="wacf7-danger"><b>'.__('Error', 'whatsapp-contact-form-7').'</b> '.$v_result['msg'].'</div>';
				}
			}
			if(isset($_POST['update'])){
				$wame = new WhatsAppContactForm7();
				$number = trim($_POST['number']);
				$number = str_replace(' ', '', $number);
				$v_obj = $wame->http_update($number);
				$v_result = json_decode($v_obj['body'], true);
				if($v_result['res'] == 1){
					update_option( 'wacf7-wassame-mobile', $number );
					echo '<div class="wacf7-success"><b>'.__('Success', 'whatsapp-contact-form-7').'</b> '.$v_result['msg'].'</div>';	
				}
				else{
					echo '<div class="wacf7-danger"><b>'.__('Error', 'whatsapp-contact-form-7').'</b> '.$v_result['msg'].'</div>';
				}
			}
			$option2 = get_option('wacf7-wassame-active');
			
			
			function ilc_admin_tabs( $current ) {
			    $tabs = array( 'free-version' => 'Free version Settings', 'pro-version' => 'Pro version settings');
			    echo '<div id="icon-themes" class="icon32"><br></div>';
			    echo '<h2 class="nav-tab-wrapper">';
			    foreach( $tabs as $tab => $name ){
			        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
			        echo "<a class='nav-tab$class' href='?page=whatsapp-contact-form-7-settings&tab=$tab'>$name</a>";

			    }
			    echo '</h2>';
			}
			
			
			if(isset($_GET['tab'])){
				$tab = $_GET['tab'];
			}
			else{
				$tab = 'free-version';
			}
			
			echo ilc_admin_tabs($tab);
			if($tab == 'pro-version'){
				if($option2 == 0){
					?>
					<div class="update-nag"><b><?php echo __('Warning', 'whatsapp-contact-form-7'); ?>:</b> <?php echo __('To make the pro version functional you must purchase a key at', 'whatsapp-contact-form-7'); ?> <a href="http://wassame.com/plugins/whatsapp-contact-form-7/?source=wacf7">Wassame.com</a></br><b><?php echo __('Important', 'whatsapp-contact-form-7'); ?>:</b> <?php echo __('The pro version will forward your contact form 7 form to your WhatsApp account', 'whatsapp-contact-form-7'); ?></div>
					<?php
				}
				$pro = get_option('wacf7-send-pro');
			?>			
			<div class="update-nag"><span style="font-size:12px; color:gray;"><?php echo __('With our pro service you can forward all your contact form 7 messages to your WhatsApp account instantly, the messages will appear to come from one of our numbers and will have the full name, subject, email and message included! to purchase a key or buy credits click', 'whatsapp-contact-form-7'); ?> <a href="http://wassame.com/plugins/whatsapp-contact-form-7/?source=wacf7"><?php echo __('here', 'whatsapp-contact-form-7'); ?></a></span></span></div>
			<form method="post" action="">
				<h2><?php echo __('Enable Pro?', 'whatsapp-contact-form-7'); ?></h2>
				<input type="checkbox" <?php if($pro == 'on'){ echo 'checked';} ?> name="wacf7-send-pro"/> <?php echo __('Pro version enabled? (This will disable the free version)', 'whatsapp-contact-form-7'); ?>
				<h2>1. <?php echo __('Type in your key', 'whatsapp-contact-form-7'); ?></h2>
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><label for="mailserver_url"><?php echo __('Activation key', 'whatsapp-contact-form-7'); ?></label></th>
							<td><input class="wacf7-input" type="text" name="wacf7-wassame-key" value="<?php echo get_option('wacf7-wassame-key'); ?>" placeholder="Activation key"></br>
								<span style="font-size:12px; color:black;"><?php echo __('Please do not lose this key, if you wish to transfer the domain you must', 'whatsapp-contact-form-7'); ?> <a href="mailto:sales@wassame.com" target="_top"><?php echo __('contact me directly', 'whatsapp-contact-form-7'); ?></a>, <?php echo __('providing your name, current domain & key along with the new domain you would like to install the plugin on!', 'whatsapp-contact-form-7'); ?></span>
							</td>
						</tr>
					</body>
				</table>
				<input type="hidden" name="wacf7-wassame-mobile" value="<?php echo get_option('wacf7-wassame-mobile'); ?>">
				<h2>2. <?php echo __('Save your settings', 'whatsapp-contact-form-7'); ?></h2>
				<input type="submit" name="pro-submit" id="submit" class="button button-primary" value="<?php echo __('Save Changes', 'whatsapp-contact-form-7'); ?>">
				
			</form>
			<form method="post" action="">
				<?php
					$option1 = get_option('wacf7-wassame-key');
				 	if(!empty($option1)){ ?>
						<h2>3. <?php echo __('Link your key with this Wordpress installation', 'whatsapp-contact-form-7'); ?></h2>
						<div class="update-nag"><span style="font-size:12px; color:gray;"><?php echo __('Link your key with this Wordpress installation providing your mobile number where you want us to send the WhatsApp messages to.', 'whatsapp-contact-form-7'); ?> <span style="color:red;"><?php echo __('This cannot be undone!', 'whatsapp-contact-form-7'); ?></span></span></div>
						<table class="form-table">
							<tbody>
								<tr>
									<th scope="row"><label for="mailserver_url">Mobile</label></th>
									<td><input type="text" name="number" value="<?php echo get_option('wacf7-wassame-mobile'); ?>" placeholder="<?php echo __('Mobile phone', 'whatsapp-contact-form-7'); ?>"> 
										<?php 
										if($option2 == 0){ 
											echo '<button name="verify" class="button button-primary" type="submit">'.__('Link!', 'whatsapp-contact-form-7').'</button>'; 
										}else{ 
											echo '<button name="update" class="button button-primary" type="submit">'.__('Update mobile!', 'whatsapp-contact-form-7').'</button>'; 
										} 
										?> 
									</td>
								</tr>
							</body>
						</table>
						<div class="update-nag" style="margin-top:0;"><span style="font-size:12px; color:gray;"><b><?php echo __('Be sure to include your country code, example', 'whatsapp-contact-form-7'); ?>:</b> </br>- (<?php echo __('Spain', 'whatsapp-contact-form-7'); ?>) "<b style="color:red;">+34 650 873 629</b>" <?php echo __('would become', 'whatsapp-contact-form-7'); ?> "<b style="color:green;">34650873629</b>"</br>- (UK) "<b style="color:red;">+07771574114</b>" <?php echo __('would become', 'whatsapp-contact-form-7'); ?> "<b style="color:green;">447771574114</b>"</br><?php echo __('Note: You can change the mobile number at any time once linked!', 'whatsapp-contact-form-7'); ?></span></div>
						
				<?php 
					}
					if(!empty($option1) && $option2 == 1 && $pro == 'on'){
						echo '<div class="wacf7-success"><b>'.__('Successfully linked & enabled!', 'whatsapp-contact-form-7').'</b> '.__('Now go and try your contact form out!', 'whatsapp-contact-form-7').'</div>';	
					}
					elseif(!$pro && !empty($option1) && $option2 == 1){
						echo '<div class="wacf7-warning"><b>'.__('Disabled!', 'whatsapp-contact-form-7').'</b> '.__('The pro version is currently disabled', 'whatsapp-contact-form-7').'</div>';
					}
				 ?>
			</form>
			<?php 
				}else{
					?>
					<form method="post" action="">
						<div class="update-nag"><span style="font-size:12px; color:gray;"><?php echo __('In the free version you can send yourself a WhatsApp message (Contact form filled in notice) by inserting your credentials below, be aware that using WART to retrieve credentials could block your mobile phone\'s WhatsApp version, this is why we offer a', 'whatsapp-contact-form-7'); ?> <a href="?page=whatsapp-contact-form-7-settings&tab=pro-version"><?php echo __('pro service', 'whatsapp-contact-form-7'); ?></a> <?php echo __('for those who only wish to get the message forwarded to they\'re mobile WhatsApp account!', 'whatsapp-contact-form-7'); ?></span></span></div>
						<h3><?php echo __('Enter your sender WhatsApp account credentials', 'whatsapp-contact-form-7'); ?></h3>
						<div class="form-group wame-label" style="margin-bottom:10px;">
						    <label style="width:400px; display:block;" for="mobile-number"><?php echo __('WhatsApp Mobile number', 'whatsapp-contact-form-7'); ?></label>
							    <input style="width:200px;" type="text" class="form-control" name="wacf7-msisdn" placeholder="<?php echo __('Enter WhatsApp msisdn', 'whatsapp-contact-form-7'); ?>" data-emoji_font="true" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif, 'Segoe UI Emoji', 'Segoe UI Symbol', Symbola, EmojiSymbols !important;" value="<?php echo get_option('wacf7-msisdn'); ?>"></br>
								<span style="color:gray; font-size:12px;"><?php echo __('Your mobile number, including country code, example: 34659572846 (Spain) or 447230399814 (UK)', 'whatsapp-contact-form-7'); ?></span>
						</div>
						<div class="form-group" style="margin-bottom:10px;">
						    <label style="width:400px; display:block;" class="wame-label" for="mobile-number"><?php echo __('WhatsApp password', 'whatsapp-contact-form-7'); ?></label>
						    <input style="width:300px;" type="text" class="form-control" name="wacf7-password" placeholder="<?php echo __('Enter WhatsApp password', 'whatsapp-contact-form-7'); ?>" value="<?php echo get_option('wacf7-password'); ?>"></br>
							<span style="color:gray; font-size:12px;"><?php echo __('Youre WhatsApp password obtained through WART', 'whatsapp-contact-form-7'); ?></span>
						</div>
						<div class="form-group" style="margin-bottom:10px;">
						    <label style="width:400px; display:block;" class="wame-label" for="mobile-number"><?php echo __('WhatsApp ID', 'whatsapp-contact-form-7'); ?></label>
						    <input style="width:500px;" type="text" class="form-control" name="wacf7-id" placeholder="<?php echo __('Enter WhatsApp ID', 'whatsapp-contact-form-7'); ?>" value="<?php echo get_option('wacf7-id'); ?>"></br>
							<span style="color:gray; font-size:12px;"><?php echo __('Your WhatsApp ID obtained through WART', 'whatsapp-contact-form-7'); ?></span>
						</div>
						<div class="form-group" style="margin-bottom:10px;">
						    <label style="width:400px; display:block;" class="wame-label" for="mobile-number"><?php echo __('Display Name', 'whatsapp-contact-form-7'); ?></label>
						    <input type="text" class="form-control" name="wacf7-display-name" placeholder="<?php echo __('Enter display name', 'whatsapp-contact-form-7'); ?>" value="<?php echo get_option('wacf7-display-name'); ?>"></br>
							<span style="color:gray; font-size:12px;"><?php echo __('This is the name that show when the messages arrives (In notifiactions)', 'whatsapp-contact-form-7'); ?></span>
						</div>
						<input type="submit" name="free-submit" id="submit" class="button button-primary" value="<?php echo __('Save Changes', 'whatsapp-contact-form-7'); ?>">
					</form>
					<?php
				}
			?>
		</div>
		<?php
	}
	function admin_menu () {
		add_options_page(__('Whatsapp contact form 7 Settings', 'whatsapp-contact-form-7'),__('Whatsapp Contact settings', 'whatsapp-contact-form-7'),'read','whatsapp-contact-form-7-settings', array(  'WhatsAppContactForm7_Admin', 'settings' ) );
	}
}


?>