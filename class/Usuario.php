<?php

	class Usuario {
		//colocar colunas que estão no banco de dados
		private $idusuario;
		private $deslogin;
		private $dessenha;		
		private $dtcadastro;
		private $numero;

		public function getNumero(){
			return $this->numero;
		}

		public function setNumero($value){
			$this->numero = $value;
		}

		public function getIdusuario(){
			return $this->idusuario;
		}

		public function setIdusuario($value){
			$this->idusuario = $value;
		}

		public function getDeslogin(){
			return $this->deslogin;
		}
		public function setDeslogin($value){
			$this->deslogin = $value;
		}
		public function getDessenha(){
			return $this->dessenha;
		}
		public function setDessenha($value){
			$this->dessenha = $value;
		}
		public function getDtcadastro(){
			return $this->dtcadastro;
		}
		public function setDtcadastro($value){
			$this->dtcadastro = $value;
		}





		//carregue pelo ID traz o id do usuario apenas 1
		public function loadByid($id){
			$sql = new Sql();
			//results é para guardar o resultado
			$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
				//aqui são os parametros = $parameters
				":ID"=>$id
			));
			//isset se isso aqui existe...
			//validar
			if (count($results) > 0) {
				$this->setData($results[0]);
			}
		}







		//trazer lista de todos os usuarios que estão na tabela do mysql
		//static nao precisa instanciar esse objeto NEW... pois nao foi usado o $THIS->
		public static function getList(){
			$sql = new Sql();
			return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
		}










		//fazer busca por login ou pelo nome de usuario
		//carrega uma lista de usuarios buscando pelo login
		public static function search($login){
			$sql = new Sql();
			return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(

				':SEARCH'=>"%".$login."%"
			));
		}










		//chamar dados da tabela que tem o numero 1

		public static function numero1($numeros){
			$sql = new Sql();
			return $sql->select("SELECT * FROM tb_usuarios WHERE numero LIKE :NUMERO1 ORDER BY numero", array(

				':NUMERO1'=>"%".$numeros."%"
			));
		}









		//acessar usuario autenticado
		//carrega um usuario usando o login e senha
		public function login($login, $pass){
			$sql = new Sql();
			//results é para guardar o resultado
			$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASS", array(
				//aqui são os parametros = $parameters
				":LOGIN"=>$login,
				":PASS"=>$pass
			));
			
			if (count($results) > 0) {
				
				//enivar dados associativos pelo meu setters
				
				$this->data($results[0]);
			}else{

				throw new Exception("login ou senha invalidos");
				
			}

		}











		//atribuir todos os dados do usuario
		public function setData($data){
				$this->setIdusuario($data['idusuario']);
				$this->setDeslogin($data['deslogin']);
				$this->setDessenha($data['dessenha']);
				$this->setNumero($data['numero']);
				$this->setDtcadastro(new DateTime($data['dtcadastro']));
		}














		//criando um novo usuario pelo INSERT
		//pdeslogin = parametro que eu envie parametro/parameters
		//vdeslogin = Variavel que eu uso para armanezar variable
		//USAMOS sp_usuarios_insert pq dentro da tabela o LAST_INSERT_ID retorna qual foi o ultimo id inserido que vai retorna o id na tabela

		public function insert(){
			$sql = new Sql();
			//select sempre vai trazer um results
			$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASS)", array(

				":LOGIN"=>$this->getDeslogin(),
				":PASS"=>$this->getDessenha()
			));

			if (count($results) > 0) {
				$this->setData($results[0]);
			}

		}
		
		//metodo construct para 
		//se nao foi preenchido fica vazio por padrao
		public function __construct($login = "", $pass = ""){
			$this->setDeslogin($login);
			$this->setDessenha($pass);
		}





		//metodo para atualizar um cadastro no banco

		public function update($login, $pass){
			//definir valores objetos
			//joga as informacoes para dentro das classes GET e no set pega os atributos e passa na minha query;;;;;

			$this->setDeslogin($login);
			$this->setDessenha($pass);

			//instancia da class sql
			$sql = new Sql();
			$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASS WHERE idusuario = :ID", array(
				':LOGIN'=>$this->getDeslogin(),
				':PASS'=>$this->getDessenha(),
				':ID'=>$this->getIdusuario()


			));
		}








		public function __toString(){
			return json_encode(array(
				//set para alimentar/valor e getters para trazer infos...
				"idusuario"=>$this->getIdusuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"numero"=>$this->getNumero(),
				"dtcadastro"=>$this->getDtcadastro()
		

			));
		}
	}

?>