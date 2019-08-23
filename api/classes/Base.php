<?php
class Base {
	public function defaultResponse () {
		return array(
			"message" => "Nenuma feição encontrada",
			"status" => false,
			"endpoints" => array(
				"/?geo=percursos" => "retorna todos os percursos",
				"/?geo=percursos&id=:id" => "retorna percurso de id === :id")
		);
	}
}
?>