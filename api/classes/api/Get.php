<?php
require_once 'APIMethod.php';

/*
* Classe que trata requisiçoes HTTP GET
*/
class Get extends APIMethod{
    
    private static $authKey = NULL;

	public static function load($request){

		$result = NULL;
        
        //Formato esperado: host/table/id (id opcional)
		$table = preg_replace('/[^a-z0-9_]+/i','', array_shift($request));
		$id = intval(array_shift($request));
        
        //Transforma a query string em um array de filtros
        $filtros = isset($_GET) ? $_GET : array();
        $conditions = array();
        foreach ($filtros as $value) {
			$key = array_search ($value, $filtros);
            if($key == "key"){
                self::$authKey = $value;
                continue;
            }
            $conditions[$key] = "=".$value;
		}
        
		$DAO = parent::getTable($table);
        
        $result = ($id > 0) ? $DAO->get($id) : $DAO->getList($conditions);

		if (!$result || $result == NULL){ throw new APIException("Nada encontrado.", 204); }
        
		Get::cleanRestrictData($result, get_class($DAO));
        
        //Encode UTF-8 (corrigir problema de acentuação nos dados vindos do banco)
		$result = GenericDAO::encodeObject($result);
        
		http_response_code(200);

		return $result;
	}

	private function cleanRestrictData($obj, $type){
		if(is_array($obj)){
			foreach($obj as $item){
				$item = Get::cleanRestrictData($item, $type);
			}
		}else{
            $DAO = new $type();
            if(is_object($obj) && $DAO instanceof Restrict && !$DAO->checkRestrictKey(self::$authKey, $obj)){
                foreach($DAO->getRestrictProps() as $rProp){
                    foreach($obj as $prop => $value){
                        if(strpos($prop, $rProp) !== FALSE){
                            $obj->$prop = "";
                        }
                    }
                }
            }
        }
		return $obj;
	}

}

?>
