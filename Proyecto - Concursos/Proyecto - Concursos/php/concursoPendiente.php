<?php

	//Nos conectamos a la base de datos y obtenemos el usuario
	require_once('bd.inc');
	$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

	if($conexion->connect_error){

		die("Por el momento no se puede acceder al gestor de la BD");

	}
	
	
	$nombreConcurso = $_REQUEST["nombreConcP"];
	
	//Limpiar variables a utilizar
	$nombreConcurso = $conexion -> real_escape_string($nombreConcurso);
	
	$query = "SET FOREIGN_KEY_CHECKS=0";
	$conexion -> query($query);
	
	$query = "update concurso set status=1, motivos='' where nombreConcurso='$nombreConcurso'";
	$conexion -> query($query);
	
	
	$query = "SET FOREIGN_KEY_CHECKS=1";
	$conexion -> query($query);
	
	echo "<!DOCTYPE html><html lang='es'><body style='background-color:#727272;'>
		<head>
		<meta charset='UTF-8' />
		</head>
		﻿<br /><br /><br /><br />
		<h1><strong><p style='color: white; text-align:center;'>Acción exitosa:</p></strong></h1>
		<div style='clear:both;
		background-color: #D5D7C6;
		color: #1B5919;
		font-weight: bold;
		font-size: 1.7em;
		text-align: center;
		border-style: solid;
		margin-top: 20px;
		border-radius:7px;
		-moz-border-radius:7px;
		-webkit-border-radius:7px;'>
	
		<h3><strong><p style='text-align:center'>Estado del concurso: pendiente.</p></strong></h3>
		<img src='http://icons.iconarchive.com/icons/enhancedlabs/lha-objects/128/Clock-icon.png' alt='pendiente_icon' />
		</div>
		<br /><h2><strong><p style='color: white; text-align:center;'>En un momento será redirigido a la página anterior...</p></strong></h2>
		</body>
		</html>
		";
		
		header('refresh: 4; url=javascript: history.go(-1)');
	
	
	$conexion -> close();

?>
