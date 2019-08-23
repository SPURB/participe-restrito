<?php

class PDOQueryException extends Exception{
	
	public function __construct($errorInfo = NULL){
		$msg = "Erro de query.";
		$code = 0;
		if($errorInfo != NULL){
			if(isset($errorInfo[1])){
				$code = $errorInfo[1];
			}
			if(isset($errorInfo[2])){
				$msg = $errorInfo[2];
			}
		}
		parent::__construct($msg, $code);
	}
	
}

?>