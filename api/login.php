<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Current");
header('Access-Control-Allow-Credentials: false');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Content-type: application/x-www-form-urlencoded");

define('APP_PATH', realpath(dirname(__FILE__)));

require_once 'classes/APIKey.php';

$validation = array(
	"status" => false,
	"message" => "admin inválido",
	// "post" => json_encode($_POST)
);

if ($e = isset($_POST['usr']) and isset($_POST['usrk'])) {

	$token = getallheaders()['Current'];
	$tokenCheck = APIKey::check($token);

	$e = md5($_POST['usr']);
	$p = $_POST['usrk'];

	if ($e === $p and $tokenCheck) {
		$validation = array(
			'status' => true,
			'message' => 'usuário válido',
		);
	}

	else {
		$validation = array(
			"status" => false,
			"message" => "usuário inválido",
			// 'usr' => $_POST['usr'],
			// 'basePath' => APP_PATH,
			// 'Current' => $token,
			// 'tokenCheck' => $tokenCheck
		);
	}
}
echo json_encode($validation);
?>