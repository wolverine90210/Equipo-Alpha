<?php
	
	session_start();
	
	//Cargar el archivo de funciones
	require_once("funciones.php");

	//Limpiar las entradas
	$id = $_REQUEST["id"];

	//Si el id no es valido, no hago la busqueda

	//Ejecutar la función que obtiene
	//los datos de los usuarios
	$_SESSION["datos"] = buscarPorId($id);
	//var_dump($_SESSION["datos"]);
	
	//Me voy a la página del formulario para editar
	header("Location: ../concurso_edita.php");

?>
