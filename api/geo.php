<?php
require_once 'classes/Headers.php';
Headers::generate();
Headers::setAppPath();

$features = array(
	"message" => "Nenuma feição encontrada",
	"status" => false,
	"features" => array(),
	"params" => $_GET
);

echo json_encode($features);