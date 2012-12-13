<?php	
	require_once("funciones.php");
    eliminarConcurso($_REQUEST["id"]);
    header("Location: ../listaConcursos.php");
?>

