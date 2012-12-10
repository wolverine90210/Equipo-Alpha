<?php	
	require_once("funciones.php");
    eliminarEntrada($_REQUEST["id"]);
    header("Location: http://localhost/Proyecto2012/listaConcursos.php");
?>
