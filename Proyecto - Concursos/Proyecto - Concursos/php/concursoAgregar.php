<?php

	//Nos conectamos a la base de datos
	require_once("bd.inc");
	$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

	//Verificar que la conexión no haya generado error
	if ($conexion->connect_error) {
		die('Error de Conexión (' . $conexion->connect_errno . ') '
		        . $conexion->connect_error);
	}
	
	print_r($_REQUEST);
	
	//Obtener mis variables del formulario
	$nomConcurso = $_REQUEST['nombreConcurso'];
	$hashtag = $_REQUEST['hashtagTwitter'];
	
	//sacar la categoria del array 
	if (isset($_REQUEST['categoria'])){
	   $categoria = $_REQUEST['categoria'];
	   $n        = count($categoria);
	   $i        = 0;
	   while ($i < $n)
	   {
	      $categoria =$categoria[$i];
	      $i++;
	   }
	}

	$dificultad = $_REQUEST['dificultad'];
	$fechaAlta = date('Y-m-d', strtotime($_REQUEST['fechaAlta']));
	$fechaInicio = date('Y-m-d', strtotime($_REQUEST['fechaInicio']));
	$fechaFin = date('Y-m-d', strtotime($_REQUEST['fechaFin']));
	$urlImagenes = $_REQUEST['cargarImagen'];
	$organizador = $_REQUEST['organizador'];
	$descripConcurso = $_REQUEST['descripcion'];
	

	//Validar las entradas para evitar inyecciones de sql
	//Usar expresiones regulares y la función de mysqli	
	$nomConcurso = $conexion -> real_escape_string($nomConcurso);
	$hashtag = $conexion -> real_escape_string($hashtag);
	$categoria = $conexion -> real_escape_string($categoria);
	$dificultad = $conexion -> real_escape_string($dificultad);
	$fechaAlta = $conexion -> real_escape_string($fechaAlta);
	$fechaInicio = $conexion -> real_escape_string($fechaInicio);
	$fechaFin = $conexion -> real_escape_string($fechaFin);
	$urlImagen = $conexion -> real_escape_string($urlImagen);
	$organizador = $conexion -> real_escape_string($organizador);
	$descripConcurso = $conexion -> real_escape_string($descripConcurso);
	
	
	//buscar el id del usuario organizador
	$query = "select * from usuario where arrobaUsuario = '$organizador'";
	
	//Ejecutar el query
	$result = $conexion -> query($query);
	

	//Convierto el resultado de mi consulta a una matriz
	if($result -> num_rows == 1){
		$datos= $result -> fetch_assoc();
	}
	

	$idUsuario = $datos['idUsuario'];//este es el id del usuarioOrganizador
	
	
	
	//insertar el concurso con todos lo datos
	
	$query = "INSERT INTO `concurso` (`nombreConcurso`, `hashtag`, `dificultad`, `categoria`, `fechaDeAlta`, `fechaDeInicio`, `descripcion`, `fechaDeFin`, `status`, `motivos`, `usuarioGanador`, `usuarioOrganizador`) VALUES ('$nomConcurso', '$hashtag', $categoria, $dificultad, '$fechaAlta', '$fechaInicio', '$descripConcurso', '$fechaFin', 1, 'falta revisar', 1, $idUsuario)";
	

	//Ejecutar el query
	$conexion -> query($query);
	 
	
	//insertar la path de la imagen
	
	
	
	//Cerrar la conexion
	$conexion -> close();
	
	//mostrar un mensaje de confirmacion
	
		echo "<!DOCTYPE html><html lang='es'><body style='background-color:#727272;'>
	<head>
	<meta charset='UTF-8' />
	</head>
	﻿<br /><br /><br /><br />
	<h1><strong><p style='color: white; text-align:center;'>Acción exitosa:</p></strong></h1>
	<div style='clear:both;
	background-color: #D5D7C6;
	color: #1739AB;
	font-weight: bold;
	font-size: 1.7em;
	text-align: center;
	border-style: solid;
	margin-top: 20px;
	border-radius:7px;
	-moz-border-radius:7px;
	-webkit-border-radius:7px;'>

	<h3><strong><p style='text-align:center'>Concurso agregado exitosamente.</p></strong></h3>
	</div>
	<br /><h2><strong><p style='color: white; text-align:center;'>En un momento será redirigido a la página anterior...</p></strong></h2>
	</body>
	</html>
	";
	header('refresh: 2; url=javascript: history.go(-1)');
	
?>
