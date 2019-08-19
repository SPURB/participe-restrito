<?php
class Headers {

	private static $headers = array(
		"Access-Control-Allow-Origin: *",
		"Access-Control-Allow-Headers: Content-Type, Current",
		"Access-Control-Allow-Credentials: false",
		"Access-Control-Allow-Methods: GET, POST, OPTIONS",
		"Content-type: application/json"
	);

	public static function generate() {
		foreach (self::$headers as $header) {
			header($header);
		}
	}

	public static function setAppPath() {
		// define('APP_PATH', realpath(dirname(__FILE__)));
		define('APP_PATH', realpath(dirname('..')));
	}
}
?>