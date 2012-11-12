<?php

	//Porque la maestra dijo :P
	session_start();
	
	
	//Nos conectamos a la base de datos y obtenemos el usuario
	require_once('BD_Concursos.inc');
	$conexion = new mysqli($host, $user, $pass, $bd);

	if($conexion->connect_error){

		die("Por el momento no se puede acceder al gestor de la BD");

	}
	
	
	$nombreConcurso = $_REQUEST["nombreConc"];
	
	$_SESSION["dato"] = $nombreConcurso;
	
	var_dump($_SESSION["dato"]);
	
	header('Location: ../adminConcursos.php');
	//header('refresh: 5; url=javascript: history.go(-1)');

?>
