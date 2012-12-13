<?php

ob_start();

//Nos conectamos a la base de datos
require_once("bd.inc");
$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

//Verificar que la conexión no haya generado error
if ($conexion->connect_error) {
	die('Error de Conexión (' . $conexion->connect_errno . ') '
	. $conexion->connect_error);
}

//print_r($_REQUEST);

//Obtener mis variables del formulario
$nomConcurso = $_REQUEST['nombreConcurso'];
$hashtag = $_REQUEST['hashtagTwitter'];

//sacar la categoria del arreglo
if (isset($_REQUEST['categoria'])){
	$categorias = $_REQUEST['categoria'];
	$n        = count($categorias);
	$i        = 0;
	while ($i < $n)
	{
		$categoria =$categorias[$i];
		$i++;
	}
}

$dificultad = $_REQUEST['dificultad'];
date_default_timezone_set('UTC');
$fechaAlta = date('Y-m-d', strtotime($_REQUEST['fechaAlta']));
$fechaInicio = date('Y-m-d', strtotime($_REQUEST['fechaInicio']));
$fechaFin = date('Y-m-d', strtotime($_REQUEST['fechaFin']));
$organizador = $_REQUEST['organizador'];
$descripConcurso = $_REQUEST['descripcion'];
//$idUsuario = $datos['usuarioOrganizador'];


//Validar las entradas para evitar inyecciones de sql
//Usar expresiones regulares y la función de mysqli
$nomConcurso = $conexion -> real_escape_string($nomConcurso);
$hashtag = $conexion -> real_escape_string($hashtag);
$categoria = $conexion -> real_escape_string($categoria);
$dificultad = $conexion -> real_escape_string($dificultad);
$fechaAlta = $conexion -> real_escape_string($fechaAlta);
$fechaInicio = $conexion -> real_escape_string($fechaInicio);
$fechaFin = $conexion -> real_escape_string($fechaFin);
$organizador = $conexion -> real_escape_string($organizador);
$descripConcurso = $conexion -> real_escape_string($descripConcurso);


$idUsuario = $organizador;
//Bandera indicadora de adición o edición
$flag = false;

$query = "SET FOREIGN_KEY_CHECKS=0";
$conexion -> query($query);


//Si ya existe el concurso entonces hacer update sino hacer insert
if(isset($_REQUEST['idConcurso'])){ 
	
	$flag = true;
	$idConcurso = $_REQUEST['idConcurso'];
	
	$query = "UPDATE concurso SET idConcurso = $idConcurso, nombreConcurso = '$nomConcurso', hashtag = '$hashtag', dificultad = $dificultad, categoria = $categoria, fechaDeAlta = '$fechaAlta', fechaDeInicio = '$fechaInicio', descripcion = '$descripConcurso', fechaDeFin = '$fechaFin', status = 1, motivos = 'falta aprobar', usuarioGanador = 960498034, usuarioOrganizador = '$idUsuario' where idConcurso=$idConcurso";

}
else{

	//insertar el concurso con todos lo datos
	$query = "INSERT INTO concurso VALUES ( null ,'$nomConcurso', '$hashtag', '$dificultad', '$categoria', '$fechaAlta', '$fechaInicio', '$descripConcurso', '$fechaFin', 1, 'falta revisar', 960498034, $idUsuario)";
	
}


//Ejecutar el query
$result = $conexion -> query($query);
if($conexion -> error)
printf("Errormessage: %s\n", $conexion->error);


//agregar las rutas de las imagenes a la base de datos
require_once("funciones.php");
 //una vez que tengo agregado el concurso lo busco para agregarle las imagenes asociadas a el
$idConcurso = dameIdDeConcurso($nomConcurso,$hashtag);
//Si obtengo por request todas las imagenes agregadas de esta manera:

//guardar.png@/vaw/www/php/uploads/3/guardar.png|eliminar.png@/vaw/www/php/uploads/3/eliminar.png|

//el | separa el nom_imagen y ruta de cada linea
//el @ separa la ruta de la imagen del nom_imagen

$delimiters = Array("|","@");
$rutas = multiexplode($delimiters,$_REQUEST['linksDeTabla']);
$tamanio = count($rutas);
for ($x=0;$x<$tamanio-1; $x++){
		$mirutaAGuardar= $rutas[$x][1];
   		$query = "INSERT INTO `imagenes` ( `url_imagen`, `CONCURSO_idConcurso`) VALUES ('$mirutaAGuardar', '$idConcurso')";				
						//Ejecutar el query
							$result = $conexion -> query($query);
							if($conexion -> error)
								printf("Errormessage: %s\n", $conexion->error);
}


$query = "SET FOREIGN_KEY_CHECKS=1";
$conexion -> query($query);

//Cerrar la conexion
$conexion -> close();


function multiexplode ($delimiters,$string) {
    $ary = explode($delimiters[0],$string);
    array_shift($delimiters);
    if($delimiters != NULL) {
        foreach($ary as $key => $val) {
             $ary[$key] = multiexplode($delimiters, $val);
        }
    }
    return  $ary;
}


//mostrar un mensaje de confirmacion
if($flag == false){
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
 <p style='text-align:center'><img src='images/addIcon.png' width='128px' height='128px' 
				alt='empty_folder_icon' /></p>
 </div>
 <br /><h2><strong><p style='color: white; text-align:center;'>En un momento será redirigido a la página anterior...</p></strong></h2>
 </body>
 </html>
 ";
 }
 else{
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

 <h3><strong><p style='text-align:center'>Concurso editado exitosamente.</p></strong></h3>
 <p style='text-align:center'><img src='images/editConc.png' width='128px' height='128px' 
				alt='empty_folder_icon' /></p>
 </div>
 <br /><h2><strong><p style='color: white; text-align:center;'>En un momento será redirigido a la página anterior...</p></strong></h2>
 </body>
 </html>
 ";
 }
 @header('refresh: 4; url=javascript: history.go(-1)');
?>
