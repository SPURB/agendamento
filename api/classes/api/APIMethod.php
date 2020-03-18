<?php

require_once 'exceptions/APIException.php';
require_once APP_PATH.'/classes/model/APICallableModel.php';
require_once APP_PATH.'/classes/base/main/Logger.php';

abstract class APIMethod {
	abstract static function load($request);
    
    protected static function getFunctionClass(){
        /*
            key = nome da função na url
            val = nome da classe
        */
		$functions = array(
          "analista"=>"Analista",
          "agenda"=>"Agendamento",
          "status"=>"StatusHorario"
		);
        return $functions;
    }
    
    
    /*
    * Obter instancia da classe correspondente a tabela requisitada
    */
	protected static function getTable($function){
        $functions = self::getFunctionClass();
		if(!array_key_exists($function, $functions)){
			throw new Exception("Erro! $function - Requisicao incorreta.", 400);
		}
        $className = $functions[$function];
        $classPath = APP_PATH.'/classes/model/'.$className.'.php';
        if(!file_exists($classPath)){
            throw new Exception("APIMethod Classe não encontrada! $className", 500);
        }
        require_once $classPath;
		$model = new $className();
        
        if(!$model instanceof APICallableModel){
            throw new Exception("APIMethod Classe inválida! $className", 500);
        }
        
        return $model;
	}

}

?>