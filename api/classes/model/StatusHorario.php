<?php
require_once "GenericDAO.php";

class StatusHorario extends GenericDAO{

	private $id;
	private $data;
	private $opUrbana;
    private $livre;

	public function __construct(){	
	
		$tableName = "dbo.VW_STATUS_HORARIO";
		
		/*
			key = nome da coluna no banco => value = propriedade da classe
			A primeira deve ser a Primary Key da tabela
		*/
		$columns = array(
			"ID_FAIXA_HORARIO" => "id",
			"DT_DATA" => "data",
			"ID_OP_URBANA" => "opUrbana",
			"BL_STATUS" => "livre"
		);

      
        parent::__construct($tableName, $columns);
	}

	public function __get($campo) {
		return $this -> $campo;
	}

	public function __set($campo, $valor) {
		$this -> $campo = $valor;
	}
  
    //@Override
  
    public function getList($filtro = NULL, $limite = 0, $pagina = 1, $orderColumns = NULL, $orderType = "ASC", $selectColumns = NULL){
      $result = parent::getList($filtro, $limite, $pagina, $orderColumns, $orderType, $selectColumns);
      for($horario=1;$horario<=5;$horario++){
        $livre = TRUE;
        foreach($result as $row){
          $livre = !($horario == @$row->id);
          if($livre == FALSE){
            break;
          }
        }
        if($livre === TRUE){
          $newObj = array();
          $newObj["id"] = "$horario";
          $newObj["livre"] = "true";
          array_push($result, $newObj);
        }
      }

      return $result;
    }
  
  

}