<?php

	//Nos conectamos a la base de datos y obtenemos el usuario
	require_once('bd.inc');
	$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

	if($conexion->connect_error){

		die("Por el momento no se puede acceder al gestor de la BD");

	}
	
	
	//Obtengo mis variables a utilizar
	$usuario = $_REQUEST['user'];
	$nombreConcurso = $_REQUEST["inNombre"];
	$hashTwitter = $_REQUEST["field_hashtag"];
	$categoria = $_REQUEST["categoria"];
	$dificultad = $_REQUEST["dificultad"];
	$fechaInicial = $_REQUEST["fini"];
	$fechaFinal = $_REQUEST["ffinal"];
	$fechaCreacion = $_REQUEST["fcreacion"];
	$img = $_REQUEST["imagen"];
	$contenido = $_REQUEST['dataEdit'];
	
	
	$fechaInicial = date('Y-m-d', strtotime($fechaInicial));
	$fechaFinal = date('Y-m-d', strtotime($fechaFinal));
	$fechaCreacion = date('Y-m-d', strtotime($fechaCreacion));


	//Limpiar variables a utilizar
	$nombreConcurso = $conexion -> real_escape_string($nombreConcurso);
	$hashTwitter = $conexion -> real_escape_string($hashTwitter);
	$dificultad = $conexion -> real_escape_string($dificultad);
	$categoria = $conexion -> real_escape_string($categoria);
	$fechaInicial = $conexion -> real_escape_string($fechaInicial);
	$fechaFinal = $conexion -> real_escape_string($fechaFinal);
	$fechaCreacion = $conexion -> real_escape_string($fechaCreacion);
	$img = $conexion -> real_escape_string($img);
	$usuario = $conexion -> real_escape_string($usuario);
	$contenido = $conexion -> real_escape_string($contenido);
	
	if(stristr($contenido, '\r') || stristr($contenido, '\n')){echo "FUUUUUUCK!";
		$contenido = str_replace('\r',"",$contenido);
		$contenido = str_replace('\n',"",$contenido);
		$contenido = str_replace('\t',"",$contenido);
	}
		
	echo "5".$contenido."5";
	if($dificultad == "Basica")
		$dif = 1;
	if($dificultad == "Intermedia")
		$dif = 2;
	if($dificultad == "Alta")
		$dif = 3;
		
		
	
	$query = "SET FOREIGN_KEY_CHECKS=0";
	$conexion -> query($query);
	
	$query = "update concurso set nombreConcurso='$nombreConcurso', hashtag='$hashTwitter', dificultad=$dif, categoria=$categoria, 
	fechaDeAlta='$fechaCreacion', fechaDeInicio='$fechaInicial', descripcion='$contenido', fechaDeFin='$fechaFinal' where
	nombreConcurso='$nombreConcurso'";
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
		color: #1739AB;
		font-weight: bold;
		font-size: 1.7em;
		text-align: center;
		border-style: solid;
		margin-top: 20px;
		border-radius:7px;
		-moz-border-radius:7px;
		-webkit-border-radius:7px;'>
	
		<h3><strong><p style='text-align:center'>Concurso editado correctamente.</p></strong></h3>
		<img src='http://b.dryicons.com/images/icon_sets/classy_icons_set/png/128x128/notebook_edit.png' alt='ganador_icon' />
		</div>
		<br /><h2><strong><p style='color: white; text-align:center;'>En un momento será redirigido a la página anterior...</p></strong></h2>
		</body>
		</html>
		";
		
		header('refresh: 4; url=../adminConcursos.php');

	
	$conexion -> close();


?>
