<?php
require_once "GenericDAO.php";

class Analista extends GenericDAO{

	private $id;
	private $login;
  	private $nome;

	public function __construct(){	
	
		$tableName = "dbo.TB_ANALISTA";
		
		/*
			key = nome da coluna no banco => value = propriedade da classe
			A primeira deve ser a Primary Key da tabela
		*/
		$columns = array(
			"ID_ANALISTA" => "id",
			"NM_LOGIN" => "login",
			"NM_NOME" => "nome"
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