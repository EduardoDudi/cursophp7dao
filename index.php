<?php

	require_once ("config.php");

	$user1 = new Usuario();
	$user1->loadByid(1);
	echo $user1;






	/*
	$sql = new Sql();
	$usuarios = $sql->select("SELECT * FROM tb_usuarios");
	echo json_encode($usuarios);
	*/
?>