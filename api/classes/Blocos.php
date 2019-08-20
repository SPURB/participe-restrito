<?php
require_once 'classes/Helpers.php';

class Blocos {
	private static $url = APP_PATH . '/data/blocos.dev.json'; // path to your JSON file

	/**
	 * Retorna todas os blocos menos informações pessoais (email)
	 * @return Array
	 */
	public function getAll(){
		$features = Helpers::getFeatures(self::$url);
		return array_map(array('Helpers', 'removePersonalInfoFromFeatures'), $features);
	}
}
?>