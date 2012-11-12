<?php

	 session_start();
	//Cargar el archivo de funciones
	require_once("funciones.php");

	//Limpiar las entradas
	var_dump($_REQUEST);
	
	$fechaInicio = date('Y-m-d', strtotime($_REQUEST['fechaInicio']));
	$fechaFin = date('Y-m-d', strtotime($_REQUEST['fechaFin']));

	//Ejecutar la función que obtiene
	//los concursos por rango de fechas
	$_SESSION["datos"] = buscarPorfechas($fechaInicio, $fechaFin);
	var_dump($_SESSION["datos"]);
	
	//Me voy a la página del formulario para mostrar los concursos
	header("Location: ../../listarConcursos.php");
		
?>
