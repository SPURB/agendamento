<?php

require_once 'exceptions/APIException.php';
require_once APP_PATH.'/classes/model/APICallableModel.php';

abstract class APIMethod {
	abstract static function load($request);
    
    protected static function getFunctionClass(){
        /*
            key = nome da função na url
            val = nome da classe
        */
		$functions = array(
            "agendamento" => "Agendamento",
            "analista" => "Analista",
		);
        return $functions;
    }
    
    /*
    *   Headers customizados devem ser informados aqui para que sejam tratados antes do nginx
    */
    protected static function getCustomHeaders(){
        return array(
            "Current"
        );
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
        
        if(!$model instanceof Winauth && !$model instanceof APICallableModel){
            throw new Exception("APIMethod Classe inválida! $className", 500);
        }

        return $model;
	}

    /*
    * getallheaders nao funciona no nginx/fpm
    */
    protected static function getAllHeaders(){
        if (!function_exists('getallheaders')) {
            if (!is_array($_SERVER)) {
                return array();
            }
            $headers = [];
            foreach ($_SERVER as $name => $value) {
                if (substr($name, 0, 5) == 'HTTP_') {
                    $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                }else if(in_array($name, self::getCustomHeaders())){
                    $headers[$name] = $value;
                }
            }
            return $headers;
        }
        return getallheaders();
    }

}

?>
