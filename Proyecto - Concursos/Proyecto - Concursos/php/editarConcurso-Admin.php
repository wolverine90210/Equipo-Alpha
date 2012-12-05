<?php

	session_start();
	
	//Nos conectamos a la base de datos y obtenemos el usuario
	require_once('bd.inc');
	$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

	if($conexion->connect_error){

		die("Por el momento no se puede acceder al gestor de la BD");

	}
	
	
	//Obtengo mis variables a utilizar
	$idConcurso = $_REQUEST['id'];
	

	//Limpiar variables a utilizar
	$idConcurso = $conexion -> real_escape_string($idConcurso);
	
	
	$query = "select nombreConcurso, hashtag, dificultad, categoria, fechaDeAlta, fechaDeInicio, descripcion, fechaDeFin, status, usuarioOrganizador from concurso where idConcurso=$idConcurso";
	
	$resultado = $conexion -> query($query);

	$conexion -> close();
	
	
	if($resultado -> num_rows == 1){

	$datos = $resultado -> fetch_array(MYSQLI_ASSOC);
	
	}

	
	$_SESSION["datos"] = $datos;
	//var_dump($_SESSION["datos"]);
	
	//header('refresh: 4; url=../editarConcursoListado.php');
		
	header('Location: ../editarConcursoListado.php');


?>
