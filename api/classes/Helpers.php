<?php
class Helpers {
	/**
	 * Converte arquivo json definido no parâmetro $url em um objeto php
	 * @param String
	 * @return Array
	 */
	public static function getFeatures ($url) {
		$file = array(json_decode(file_get_contents($url)));
		$features = $file[0]->features;
		return $features;
	}

	/**
	 * Remove item 'email' de um objeto
	 * @param Object
	 * @return Object
	 */
	public static function removePersonalInfoFromFeatures ($featureObject) {
		$id = $featureObject->properties->id;
		$name =	$featureObject->properties->Name;

		unset($featureObject->properties);

		$result = new stdClass();
		$result = (object) array(
			'properties'=>array(
				'id'=> $id,
				'Name'=> $name
			), 
			'feature'=>$featureObject
		);

		return $result;
	}
}
