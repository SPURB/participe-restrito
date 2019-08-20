<?php
class Base {
	public function defaultResponse () {
		return array(
			"message" => "Nenuma feição encontrada",
			"status" => false,
			"endpoints" => array(
				"/?geo=blocos" => "retorna todos os blocos (sem email e dados pessoais)",
				"/?geo=percursos" => "retorna todos os percursos (sem email e dados pessoais)",
				"/?email=teste@teste.com" => "retorna blocos e percursos assoaciadoa ao email email@teste.com",
				"/?email=teste@teste.com&geo=blocos" => "retorna blocos e percursos assoaciadoa ao email email@teste.com",
				"/?email=teste@teste.com&geo=percursos" => "retorna blocos e percursos assoaciadoa ao email email@teste.com"
			)
		);
	}
}
?>