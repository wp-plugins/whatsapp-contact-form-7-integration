<?php
class WhatsAppContactForm7 {
	
	const API_HOST = 'wassame.com';
	const API_VER = '1.1';
	
	private static $initiated = false;
	
	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}
	
	private static function init_hooks() {
		self::$initiated = true;
	}
	public static function getDomain(){
		$domain = get_option('siteurl');
		$domain = str_replace('http://', '', $domain);
		$domain = str_replace('https://', '', $domain);
		return $domain = str_replace('www.', '', $domain);
	}
	public static function http_verify($number){
		$domain = self::getDomain();
		$api_key = get_option('wacf7-wassame-key');
		$arr = array('verify' => $api_key, 'data' => $domain, 'number' => $number);
		return self::http_post($arr);
	}
	public static function http_update($number){
		$domain = self::getDomain();
		$api_key = get_option('wacf7-wassame-key');
		$arr = array('update' => $api_key, 'data' => $domain, 'number' => $number);
		return self::http_post($arr);
	}
	public static function http_send($posted_data) {
		$domain = self::getDomain();
		$posted_data['host'] = $domain;
		$api_key = get_option('wacf7-wassame-key');
		$arr = array('key' => $api_key, 'data' => json_encode($posted_data));
		return self::http_post($arr);
	}	
	public static function http_post($arr){
		$wame_ua = sprintf( 'WordPress/%s | Wame/%s', $GLOBALS['wp_version'], '1.0' );
		
		$http_args = array(
			'method' => 'POST',
			'body' => $arr,
			'headers' => array(
				'Content-Type' => 'application/x-www-form-urlencoded; charset=' . get_option( 'blog_charset' ),
				'Host' => self::API_HOST,
				'User-Agent' => $wame_ua,
			),
			'httpversion' => '1.0',
			'timeout' => 15
		);

		$wame_url = "http://".self::API_HOST."/api/".self::API_VER."/index.php";
		return wp_remote_post( $wame_url, $http_args );
	}
}
?>