<?php
require_once 'classes/Headers.php';
Headers::generate();
Headers::setAppPath(); // define 'APP_PATH'

require_once 'classes/Base.php';
require_once 'classes/Percursos.php';

function getResponse($params) {
	$geoType = 'unset'; // "blocos" ou "percursos" vem de request "/?geo=blocos"
 
	if(isset($params['geo'])) {
		$geoType = $params['geo'];
	}

	switch($geoType){
		case 'percursos': return Percursos::getAll(); break; // "/?geo=percuros"
		default: return Base::defaultResponse(); // "/" ou parâmetros infinidos
	}
}

echo json_encode(getResponse($_GET));