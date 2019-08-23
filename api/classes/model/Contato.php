<?php
require_once "GenericDAO.php";

class Contato extends GenericDAO{
	
	private $cpf_cnpj_coresponsavel;
	private $cpf_cnpj_responsavel;
	private $email_coresponsavel;
	private $email_responsavel;
	private $id;
    private $nome_coresponsavel;
    private $nome_responsavel;
    private $telefone_coresponsavel;
    private $telefone_responsavel;
 
	public function __construct(){

		$tableName = "contato";
		$classProps =  get_class_vars(get_class($this));
		/*
			key = coluna do banco => value = property da classe
		*/
		$columns = array();
        foreach($classProps as $name => $val){
            $columns[$name] = $name;
        }

		parent::__construct($tableName, $columns);
	}
	
	public function __get($campo) {
		return $this -> $campo;
	}

	public function __set($campo, $valor) {
		$this -> $campo = $valor;
	}
	
}
