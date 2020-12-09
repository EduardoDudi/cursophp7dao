<?php

	require_once ("config.php");




	$usuario = new Usuario();
	//carregamos o usuario id 8 
	$usuario->loadByid(8);
	//agora vamos atualizar suas infos
	$usuario->update("novousuario", "novaSenha");

	echo $usuario;

	//foi usado metodo construc sendo assim pode passar os dados no dentro USAURIO()
	//Inserindo um novo aluno 	

	//$aluno = new Usuario("aluno", "aluno123");

	//$aluno->insert();
	//echo $aluno;





	//carrega soment usuario que tenha tabela com o valor 1 inserido

	//$numero1 = Usuario::numero1("1");
	//echo json_encode($numero1);




	//carrega um usuario usando o login e senha
	//$usuario = new Usuario();
	//$usuario->login("user1", "7412");
	//echo $usuario;




	//carrega uma lista de usuarios buscando pelo login
	//$search = Usuario::search("user1");
	//echo json_encode($search);




	//lista inteira de usuarios
	//nao foi instnaciado o objeto static...
	//$lista = Usuario::getList();
	//echo json_encode($lista);





	//traz apenas 1 usuario por vez
	//$user1 = new Usuario();
	//$user1->loadByid(29);
	//echo $user1;






	/*
	$sql = new Sql();
	$usuarios = $sql->select("SELECT * FROM tb_usuarios");
	echo json_encode($usuarios);
	*/
?>