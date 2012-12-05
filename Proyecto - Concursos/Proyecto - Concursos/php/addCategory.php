<?php

	//Nos conectamos a la base de datos y obtenemos el usuario
	require_once('bd.inc');
	$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

	if($conexion->connect_error){

		die("Por el momento no se puede acceder al gestor de la BD");

	}
	
	$new_cat = $_REQUEST["new_cat"];
	
	$new_cat = $conexion -> real_escape_string($new_cat);
	
	$query = "select nom_Categoria from categoria";
	
	$categorias = $conexion -> query($query);
	
	//Convierto el resultado de mi consulta a un arreglo
	if($categorias -> num_rows >= 1){
		//Por cada fila obtengo un arreglo
		while($filaCat = $categorias -> fetch_assoc())
			$datosCat[] = $filaCat;
	}
	
	$flag = false;
	
	foreach($datosCat as $filaCat){
		
		if($filaCat["nom_Categoria"] == $new_cat)
			$flag = true;
	}
	
	if($flag == false){
	
	$query = "SET FOREIGN_KEY_CHECKS=0";
	$conexion -> query($query);
	
	$query = "insert into categoria values(null, '$new_cat')";
	$conexion -> query($query);
	
	$query = "SET FOREIGN_KEY_CHECKS=1";
	$conexion -> query($query);
	
	
	
	echo "Right";
	
	}else{
	
		echo "Wrong";
	
	}
	
	$conexion -> close();

?>
