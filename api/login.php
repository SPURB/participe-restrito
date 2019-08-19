<?php
require_once 'classes/Headers.php';
require_once 'classes/APIKey.php';

Headers::generate();
Headers::setAppPath();

$validation = array(
	"status" => false,
	"message" => "admin inválido"
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
			"message" => "usuário inválido"
		);
	}
}
echo json_encode($validation);

?>