<?php
	
	//Nos conectamos a la base de datos y obtenemos el usuario
	require_once('bd.inc');
	$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

	if($conexion->connect_error){

		die("Por el momento no se puede acceder al gestor de la BD");

	}
	
	
	$nombreConcurso = $_REQUEST["nombreCon"];
	
	$query = "select status from concurso where nombreConcurso='$nombreConcurso'";
				
	$result = $conexion -> query($query);
				
	if($result -> num_rows == 1){

		$datos = $result -> fetch_array(MYSQLI_ASSOC);
	
	}
	
	echo $datos['status'];
	
	//$_SESSION["dato"] = $nombreConcurso;
	
	//var_dump($_SESSION["dato"]);
	
	//header('Location: ../adminConcursos.php');
	//header('refresh: 5; url=javascript: history.go(-1)');

?>
