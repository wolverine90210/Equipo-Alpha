<?php
/**
 * @return array $datos
 * Esta función busca TODOS los concursos
 */
function listarConcursos(){
	//Conectarse a la base de datos
	require("bd.inc");

	$con = new mysqli($dbhost, $dbuser, $dbpass, $db);
	
	//Validar que no genere error la conexión
	if($con -> connect_error)
		die("Por el momento no se puede acceder al gestor de la base de datos");

	//Creo la consulta
	$mi_query = "select * from concurso";

	//Ejecuto mi consulta
	$result = $con -> query($mi_query);

	//Cierro la conexión
	$con -> close();

	//Convierto el resultado de mi consulta a una matriz
	if($result -> num_rows >= 1){
		//Por cada fila obtengo un arreglo
		while($fila = $result -> fetch_assoc())
			$datos[] = $fila;
	}
	
	//Regreso la matriz
	return $datos;
}

/**
 * 
 * @return array $datos
 * @param  $status
 * Esta función busca  los concursos 
 * que tenga en el status seleccionado
 */
function listarConcursosPorStatus($status){
	
	//Conectarse a la base de datos
	require("bd.inc");

	$con = new mysqli($dbhost, $dbuser, $dbpass, $db);
	
	//Validar que no genere error la conexión
	if($con -> connect_error)
		die("Por el momento no se puede acceder al gestor de la base de datos");

	//Creo la consulta
	$mi_query = "select * from concurso where status = $status";

	//Ejecuto mi consulta
	$result = $con -> query($mi_query);

	//Cierro la conexión
	$con -> close();

	//Convierto el resultado de mi consulta a una matriz
	if($result -> num_rows >= 1){
		//Por cada fila obtengo un arreglo
		while($fila = $result -> fetch_assoc())
			$datos[] = $fila;
	}
	
	//Regreso la matriz
	return $datos;
	
}




/*
 * 
 * Funciones de buscar
 */

/**
 * 
 * 
 * @return $datos
 * @param $id
 * Busca un concurso por su id de alta
 * y regresa los datos de ese concurso
 */

function buscarPorId($id){


	//Conectarse a la base de datos
	require("bd.inc");
	$con = new mysqli($dbhost, $dbuser, $dbpass, $db);
	
	//Validar que no genere error la conexión
	if($con -> connect_error)
		die("Por el momento no se puede acceder al gestor de la base de datos");

	//Creo la consulta
	$mi_query = "select * from concurso where idConcurso=$id";

	//Ejecuto mi consulta
	$result = $con -> query($mi_query);

	//Convierto el resultado de mi consulta a un arreglo
	if($result -> num_rows == 1)
		$datos = $result -> fetch_array(MYSQLI_ASSOC);

	return $datos;

}

function dameIdDeConcurso($nomConcurso,$hashtag){
	
		//Conectarse a la base de datos
	require("bd.inc");
	$con = new mysqli($dbhost, $dbuser, $dbpass, $db);
	
	//Validar que no genere error la conexión
	if($con -> connect_error)
		die("Por el momento no se puede acceder al gestor de la base de datos");

	//Creo la consulta
	$mi_query = "select * from concurso  as c where c.nombreConcurso LIKE '$nomConcurso' and c.hashtag LIKE '$hashtag'";
	

	//Ejecuto mi consulta
	$result = $con -> query($mi_query);

	//Convierto el resultado de mi consulta a un arreglo
	if($result -> num_rows == 1)
		$datos = $result -> fetch_array(MYSQLI_ASSOC);
		var_dump($datos);
	
	if($con -> error)
	printf("Errormessage: %s\n", $con->error);

	return $datos["idConcurso"];
	
}

function buscarPorDificultad($dificultad){
	
		//Conectarse a la base de datos
	require("bd.inc");
	$con = new mysqli($dbhost, $dbuser, $dbpass, $db);
	
	//Validar que no genere error la conexión
	if($con -> connect_error)
		die("Por el momento no se puede acceder al gestor de la base de datos");

	//Creo la consulta
	$mi_query = "select * from concurso where dificultad = $dificultad";

	//Ejecuto mi consulta
	$result = $con -> query($mi_query);

//Convierto el resultado de mi consulta a una matriz
	if($result -> num_rows >= 1){
		//Por cada fila obtengo un arreglo
		while($fila = $result -> fetch_assoc())
			
			$datos[] = $fila;
	}

	return $datos;
	
	
	
}

function buscarConcursosPorCategoria($categoria){
	
	//Conectarse a la base de datos
	require("bd.inc");
	$con = new mysqli($dbhost, $dbuser, $dbpass, $db);
	
	//Validar que no genere error la conexión
	if($con -> connect_error)
		die("Por el momento no se puede acceder al gestor de la base de datos");

	//Creo la consulta
	$mi_query = "select * from concurso where categoria = $categoria";

	//Ejecuto mi consulta
	$result = $con -> query($mi_query);

//Convierto el resultado de mi consulta a una matriz
	if($result -> num_rows >= 1){
		//Por cada fila obtengo un arreglo
		while($fila = $result -> fetch_assoc())
			
			$datos[] = $fila;
	}

	return $datos;
	
}

function buscarPorCategoria($cat){
	

	//Conectarse a la base de datos
	require("bd.inc");
	$con = new mysqli($dbhost, $dbuser, $dbpass, $db);
	
	//Validar que no genere error la conexión
	if($con -> connect_error)
		die("Por el momento no se puede acceder al gestor de la base de datos");

	//Creo la consulta
	$mi_query = "select * from categoria where idCategoria=$cat";

	//Ejecuto mi consulta
	$result = $con -> query($mi_query);

	//Cierro la conexión
	$con -> close();
	
	//Convierto el resultado de mi consulta a un arreglo
	if($result -> num_rows == 1)
		$datos = $result -> fetch_array(MYSQLI_ASSOC);

	return $datos;
}



function buscarPorIdGanador($id){


	//Conectarse a la base de datos
	require("bd.inc");
	$con = new mysqli($dbhost, $dbuser, $dbpass, $db);
	
	//Validar que no genere error la conexión
	if($con -> connect_error)
		die("Por el momento no se puede acceder al gestor de la base de datos");

	//Creo la consulta
	$mi_query = "select * from usuario where idUsuario=$id";

	//Ejecuto mi consulta
	$result = $con -> query($mi_query);

	//Cierro la conexión
	$con -> close();
	
	//Convierto el resultado de mi consulta a un arreglo
	if($result -> num_rows == 1)
		$datos = $result -> fetch_array(MYSQLI_ASSOC);

	return $datos;
}



function buscarPorIdOrganizador($id){


	//Conectarse a la base de datos
	require("bd.inc");
	$con = new mysqli($dbhost, $dbuser, $dbpass, $db);
	
	//Validar que no genere error la conexión
	if($con -> connect_error)
		die("Por el momento no se puede acceder al gestor de la base de datos");

	//Creo la consulta
	$mi_query = "select * from usuario where idUsuario=$id";

	//Ejecuto mi consulta
	$result = $con -> query($mi_query);

	//Cierro la conexión
	$con -> close();
	
	//Convierto el resultado de mi consulta a un arreglo
	if($result -> num_rows == 1)
		$datos = $result -> fetch_array(MYSQLI_ASSOC);

	return $datos;
}

function eliminarUsuario($id){

	//Conectarse a la base de datos
	require("bd.inc");
	$con = new mysqli($dbhost, $dbuser, $dbpass, $db);
	
	//Validar que no genere error la conexión
	if($con -> connect_error)
		die("Por el momento no se puede acceder al gestor de la base de datos");

	//Creo la consulta
	$mi_query = "delete  from concurso where idConcurso=$id";

	//Ejecuto mi consulta
	$result = $con -> query($mi_query);

	//Cierro la conexión
	$con -> close();
}

function buscarPorFechas($fechaInicio,$fechaFin){


	//Nos conectamos a la base de datos
	require("bd.inc");
	$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

	//Verificar que la conexión no haya generado error
	if ($conexion->connect_error) {
		die('Error de Conexión (' . $conexion->connect_errno . ') '
		        . $conexion->connect_error);
	}

	//Validar las entradas para evitar inyecciones de sql
	//Usar expresiones regulares y la función de mysqli	
	$fechaInicio = date('Y-m-d', strtotime($fechaInicio));
	$fechaFin = date('Y-m-d', strtotime($fechaFin));

	$fechaInicio = $conexion -> real_escape_string($fechaInicio);
	$fechaFin = $conexion -> real_escape_string($fechaFin);


	//buscar en el rango de fechas
	$query = "select * from concurso where fechaDeInicio >= '$fechaInicio' and fechaDeFin<= '$fechaFin'";
	
	
	//Ejecutar el query
	$result = $conexion -> query($query);
	if($conexion -> error)
		printf("Errormessage: %s\n", $conexion->error);

	//Cerrar la conexion
	$conexion -> close();

	//Convierto el resultado de mi consulta a una matriz
	if($result -> num_rows >= 1){
		//Por cada fila obtengo un arreglo
		while($fila = $result -> fetch_assoc())
			
			$datos[] = $fila;
	}
	
	//var_dump($datos);
	
	//Regreso la matriz
	return $datos;
	
}

function buscarCategorias(){
//


//Nos conectamos a la base de datos
	require("bd.inc");
	$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

	//Verificar que la conexión no haya generado error
	if ($conexion->connect_error) {
		die('Error de Conexión (' . $conexion->connect_errno . ') '
		        . $conexion->connect_error);
	}
	

	//buscar todas las categorias y ordernarlas por nombre
	$query = "select * from categoria order By nom_Categoria";
	//$query = "select * from concurso";
	
	//Ejecutar el query
	$result = $conexion -> query($query);

	//Cerrar la conexion
	$conexion -> close();

	//Convierto el resultado de mi consulta a una matriz
	if($result -> num_rows >= 1){
		//Por cada fila obtengo un arreglo
		while($fila = $result -> fetch_assoc())
			
			$datos[] = $fila;
	}
	
	//var_dump($datos);
	
	//Regreso la matriz
	return $datos;
	

}
/*
 * 
 * 
 * FUNCIONES DE ELIMINAR
 */

/**
 * @param ID
 * esta funcion elimina 
 * el concurso con ese id
 */

function eliminarConcurso($id){

	//Conectarse a la base de datos
	require("bd.inc");
	$con = new mysqli($dbhost, $dbuser, $dbpass, $db);

	//Validar que no genere error la conexión
	if($con -> connect_error)
		die("Por el momento no se puede acceder al gestor de la base de datos");

	//Creo la consulta
	$mi_query = "delete  from concurso where idConcurso = $id";

	//Ejecuto mi consulta
	 $con -> query($mi_query);

	//Cierro la conexión
	$con -> close();
}

?>
