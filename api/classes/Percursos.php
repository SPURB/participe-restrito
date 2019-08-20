<?php
require_once 'classes/Helpers.php';

class Percursos {
	private static $url = APP_PATH . '/data/percursos.dev.json'; // path to your JSON file

	/**
	 * Retorna todas os percursos menos informações pessoais (email)
	 * @return Array
	 */
	public function getAll(){
		$features = Helpers::getFeatures(self::$url);
		return array_map(array('Helpers', 'removePersonalInfoFromFeatures'), Helpers::getFeatures(self::$url));
	}
}
?>