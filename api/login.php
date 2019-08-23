<?php
require_once 'classes/Headers.php';
require_once 'classes/api/APIKey.php';


Headers::generate();
//Headers::setAppPath();
define('APP_PATH', realpath(dirname(__FILE__)));
require_once APP_PATH.'/classes/api/APIFactory.php';

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
            'desfiles' => getDesfilesUsr($_POST['usr'])
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

function getDesfilesUsr($usr){
    $contato = getContatoUsr($usr);
    if(!$contato || !is_object($contato)){
        return null;
    }
    $_GET['id_contato'] = $contato->id;
    $desfiles = APIFactory::executeRequest('GET', array('desfile'), FALSE);
    $result = array();
    foreach($desfiles as $desfile){
        array_push($result, array(
            'id' => $desfile->id,
            'nome_do_bloco' => $desfile->nome_do_bloco,
            'endereco_concentracao' => $desfile->endereco_concentracao
        ));
    }
    return $result;
}

function getContatoUsr($usr){
    $campoBusca = "email_responsavel";
    $_GET[$campoBusca] = $usr;
    $contato = APIFactory::executeRequest('GET', array('contato'), FALSE);
    unset($_GET[$campoBusca]);
    return is_array($contato) ? $contato[0] : NULL;
}

?>