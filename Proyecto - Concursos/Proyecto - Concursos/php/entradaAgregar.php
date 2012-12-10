<?php
session_start();
//Nos conectamos a la base de datos
require_once("bd.inc");
require_once("funciones.php");
$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

//Verificar que la conexión no haya generado error
if ($conexion->connect_error) {
	die('Error de Conexión (' . $conexion->connect_errno . ') '
	. $conexion->connect_error);
}

//print_r($_REQUEST);

//Obtener mis variables del formulario
$entrada = $_REQUEST['entrada'];
date_default_timezone_set('UTC');
$idUsuario = $_SESSION['access_token']['id'];
$fecha = date('Y-m-d', strtotime($_REQUEST['fecha']));
$idConcurso = $_REQUEST['idConcurso'];

//Validar las entradas para evitar inyecciones de sql
//Usar expresiones regulares y la función de mysqli
$entrada = $conexion -> real_escape_string($entrada);
$fecha = $conexion -> real_escape_string($fecha);


//insertar la entrada en la base de datos
$query = "INSERT INTO `entrada`(`fechaDeEnvio`, `descripEntrada`, `USUARIO_idUsuario`) VALUES ('$fecha','$entrada','$idUsuario')";

//Ejecutar el query
$result = $conexion -> query($query);



if($conexion -> error)
	printf("Errormessage: %s\n", $conexion->error);

$idEntrada = dameidDeLaUltimaEntrada();


//insertar la entrada en la base de datos
$query = "INSERT INTO `concurso_has_entrada`(`concurso_idConcurso`, `entrada_idEntrada`) VALUES ($idConcurso,$idEntrada)";
//Ejecutar el query
$result = $conexion -> query($query);


if($conexion -> error)
	printf("Errormessage: %s\n", $conexion->error);

//Cerrar la conexion
$conexion -> close();
?>