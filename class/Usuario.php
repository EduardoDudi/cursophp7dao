<?php

	class Sql extends PDO{
		
		private $conn;
		//__construct vai conectar automaticamente no banco de dados quando usar o NEW
		public function __construct(){
			//conectar com o banco de dados mysql
			$this->conn = new PDO("mysql:host=localhost:3308; dbname=dbphp7", "root", "");
		}

		//$statment = Representa uma instrução preparada e, após a instrução ser executada, um conjunto de resultados associado responsável por preparar a query SQL 

		private function setParams($statment, $parameters = array()){
			//ASSOCIAR PARAMETROS
			foreach ($parameters as $key => $value) {
				
				//AQUI mesma coisa como era feito: na aula pdo ex: 5 / $stmt->bindParam(":LOGIN", $login);
				$this->setParam($key, $value);
			}
		}
						//parametro só 
		private function setParam($statment, $key, $value ){
			//(bindParam) informar valores dinamicamente para uma requisição SQL usando PHP
			$statment->bindParam($key, $value); 
		}
		//parte de executar comandos
		//rawQuery é uma query bruta que vc vai usar ela mais tarde
		//Params parametros ou dados que vamos puxar do banco
		public function query($rawQuery, $params = array()){
			//stmt n precisa usar $this para chamar ela ela so funciona dentro desse metodo/funcao
			//PREPARE prepara uma operação no banco de dados, logo se faz necessário a utilização de outros métodos como execute por exemplo
			$stmt = $this->conn->prepare($rawQuery);


			$this->setParams($stmt, $params);

			$stmt->execute();
			return $stmt;
		}
		//metodo para o select mysql 
		public function select($rawQuery, $params = array()):array{
			$stmt = $this->query($rawQuery, $params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}

?>