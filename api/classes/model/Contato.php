<?php
require_once "GenericDAO.php";
require_once "Restrict.php";

class Contato extends GenericDAO implements Restrict{
	
    private $id;
	private $cpf_cnpj_coresponsavel;
	private $cpf_cnpj_responsavel;
	private $email_coresponsavel;
	private $email_responsavel;
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
    
    /*
    * Dados sensiveis de contato devem ser revelados somente a usuario com chave de autoriz
    */
    private function generateKey($obj){
        return md5($obj->email_responsavel.$obj->cpf_cnpj_responsavel);
    }
    
    public function getRestrictProps(){
        return array("cpf", "email", "telefone");
    }
    
    public function checkRestrictKey($key, $obj){
        if($key == NULL)
            return FALSE;
        
        return self::generateKey($obj) == $key;
    }
	
}
