<?php	

	//Nos conectamos a la base de datos y obtenemos el usuario
	require_once('bd.inc');
	$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

	if($conexion->connect_error){

		die("Por el momento no se puede acceder al gestor de la BD");

	}
	
	
	$idganador = $_REQUEST["idGanador"];
	$nombreConcurso = $_REQUEST["nombreConcurso"];
	
	//Limpiar variables a utilizar
	$idganador = $conexion -> real_escape_string($idganador);
	$nombreConcurso = $conexion -> real_escape_string($nombreConcurso);
	
	$query = "select idUsuario from usuario";
	
	$resultados = $conexion -> query($query);

	//Convierto el resultado de mi consulta a un arreglo
	if($resultados -> num_rows >= 1){
		//Por cada fila obtengo un arreglo
		while($fila = $resultados -> fetch_assoc())
			$datos[] = $fila;
	}
	
	$flag = false;
	
	for($i=0; $i<count($datos); $i++){
	
		if($datos[$i]['idUsuario'] == $idganador){
			$flag = true;
			break;
			}
	
	}

	
	if($flag != false){
		
	$query = "SET FOREIGN_KEY_CHECKS=0";
	$conexion -> query($query);
	
	$query = "update concurso set usuarioGanador = $idganador where nombreConcurso='$nombreConcurso'";
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
	
		<h3><strong><p style='text-align:center'>Usuario ganador asignado exitosamente.</p></strong></h3>
		<img src='http://a.dryicons.com/images/icon_sets/coquette_part_3_icons_set/png/128x128/prize_winner.png' alt='ganador_icon' />
		</div>
		<br /><h2><strong><p style='color: white; text-align:center;'>En un momento será redirigido a la página anterior...</p></strong></h2>
		</body>
		</html>
		";
		
		header('refresh: 7; url=javascript: history.go(-1)');
	
	
	
	}
	else{
		echo "<!DOCTYPE html><html lang='es'><body style='background-color:#727272;'>
		<head>
		<meta charset='UTF-8' />
		</head>
		﻿<br /><br /><br /><br />
		<h1><strong><p style='color: white; text-align:center;'>Ha ocurrido un error: </p></strong></h1>
		<div style='clear:both;
		background-color: #D5D7C6;
		color: #BA1111;
		font-weight: bold;
		font-size: 1.7em;
		text-align: center;
		border-style: solid;
		margin-top: 20px;
		border-radius:7px;
		-moz-border-radius:7px;
		-webkit-border-radius:7px;'>
	
		<h3><strong><p style='text-align:center'>El ID del usuario que asign&oacute como ganador no existe.</p></strong></h3>
		</div>
		<br /><h2><strong><p style='color: white; text-align:center;'>En un momento será redirigido a la página anterior...</p></strong></h2>
		</body>
		</html>
		";
		
		header('refresh: 4; url=javascript: history.go(-1)');
	
	}
	
	$conexion -> close();
	


?>
