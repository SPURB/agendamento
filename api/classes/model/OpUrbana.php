<?php
require_once "GenericDAO.php";

class Opurbana extends GenericDAO{

	private $id;
	private $sigla;
  	private $descricao;
	private $analista;

	public function __construct(){	
	
		$tableName = "dbo.TB_OP_URBANA";
		
		/*
			key = nome da coluna no banco => value = propriedade da classe
			A primeira deve ser a Primary Key da tabela
		*/
		$columns = array(
			"ID_OP_URBANA" => "id",
			"NM_SIGLA" => "sigla",
			"NM_DESCRICAO" => "descricao",
			"ID_ANALISTA" => "analista"
		);
      
		$oneMany = array(
			"analista" => "Analista"
		);

      
        parent::__construct($tableName, $columns, $oneMany);
	}

	public function __get($campo) {
		return $this -> $campo;
	}

	public function __set($campo, $valor) {
		$this -> $campo = $valor;
	}
    
	public function select($conditions = NULL, $orderColumns = NULL, $orderType = NULL, $selectColumns = NULL){
        $orderColumns = array("data");
        return parent::select($conditions, $orderColumns);
	}


}