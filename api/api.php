<?php
require_once 'classes/Headers.php';
Headers::generate();
echo json_encode(array("Nota" =>"Alterar url no http.conf no spurbsp163 para habilitar os serviços 'login.php' e 'geo.php'"));
