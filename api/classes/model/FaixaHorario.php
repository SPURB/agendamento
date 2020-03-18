<?php
require_once "GenericDAO.php";

class FaixaHorario extends GenericDAO{

	private $id;
	private $descricao;

	public function __construct(){	
	
		$tableName = "dbo.TB_FAIXA_HORARIO";
		
		/*
			key = nome da coluna no banco => value = propriedade da classe
			A primeira deve ser a Primary Key da tabela
		*/
		$columns = array(
			"ID_FAIXA_HORARIO" => "id",
			"NM_DESCRICAO" => "descricao"
		);

      
        parent::__construct($tableName, $columns);
	}

	public function __get($campo) {
		return $this -> $campo;
	}

	public function __set($campo, $valor) {
		$this -> $campo = $valor;
	}

}