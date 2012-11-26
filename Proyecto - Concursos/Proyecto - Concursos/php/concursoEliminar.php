<?php	
	require_once("funciones.php");
    eliminarConcurso($_REQUEST["id"]);
    header("Location: http://localhost/Proyecto2012/listaConcursos.php");
	exit;
?>

