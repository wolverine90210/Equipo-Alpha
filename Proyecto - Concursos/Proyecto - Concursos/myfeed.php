<?php

	session_start();

	//Conectarse a la base de datos
	require_once("bd.inc");
	$con = new mysqli($dbhost, $dbuser, $dbpass, $db);
	
	//Validar que no genere error la conexión
	if($con -> connect_error)
		die("Por el momento no se puede acceder al gestor de la base de datos");


	//Creo la consulta
	$mi_query = "select idConcurso as id, NombreConcurso as title, FechaDeInicio as start, FechaDeFin as end, '' as url  
				 from concurso";
	//Ejecuto mi consulta
	$result = $con -> query($mi_query);

	$datos = array();

	//Convierto el resultado de mi consulta a una matriz
	if($result -> num_rows >= 1){
		//Por cada fila obtengo un arreglo
		while($fila = $result -> fetch_assoc())
			$datos[] = $fila;
	}
	
	//Porque la maestra dijo
	$_SESSION["datos"] = $datos;
	//Cierro la conexión
	
	$con -> close();
	
	echo json_encode($datos);

?>
