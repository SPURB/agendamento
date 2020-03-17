<?php
require_once "GenericDAO.php";

class Agendamento extends GenericDAO{

	private $id;
	private $usuario;
  	private $processo;
	private $opUrbana;
	private $horario;
	private $data;

	public function __construct(){	
	
		$tableName = "dbo.TB_AGENDAMENTO";
		
		/*
			key = nome da coluna no banco => value = propriedade da classe
			A primeira deve ser a Primary Key da tabela
		*/
		$columns = array(
			"ID_AGENDAMENTO" => "id",
			"NM_EMAIL" => "usuario",
			"NM_PROCESSO" => "processo",
			"ID_OP_URBANA" => "opUrbana",
			"ID_FAIXA_HORARIO" => "horario",
			"DT_DATA" => "data"
		);
      
		$oneMany = array(
			"opUrbana" => "OpUrbana",
			"horario" => "FaixaHorario"
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