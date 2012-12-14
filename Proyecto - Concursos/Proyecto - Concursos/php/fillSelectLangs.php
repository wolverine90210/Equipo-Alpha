<?php

	//Nos conectamos a la base de datos y obtenemos el usuario
	require_once('bd.inc');
	$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

	if($conexion->connect_error){

		die("Por el momento no se puede acceder al gestor de la BD");

	}
	
	if(isset($_REQUEST["selectLangs"])){
	$selectLangs = $_REQUEST["selectLangs"];
	
	$selectLangs = $conexion -> real_escape_string($selectLangs);
	}
	
	$query = "select idCategoria, nom_Categoria from categoria";
	
	$categorias = $conexion -> query($query);
	
	//Convierto el resultado de mi consulta a un arreglo
	if($categorias -> num_rows >= 1){
		//Por cada fila obtengo un arreglo
		while($filaCat = $categorias -> fetch_assoc())
			$datosCat[] = $filaCat;
	}
	
	echo	"<select name='categoria' id='categoria' style='background-color: #ececec;border: none;color: #454545;font-size: 18px;
	border: 2px solid transparent;border-radius: 5px;font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight: bold;
	box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box;' >";
	if (!$datosCat)
	echo '<option value="0">No hay categorias</option>';
	else{		
		foreach($datosCat as $filaCat)
		echo '<option value=',$filaCat["idCategoria"],">",$filaCat["nom_Categoria"],'</option>';		
	}
	echo "</select>";
	
	$conexion -> close();


?>


