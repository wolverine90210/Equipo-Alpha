<?php	

	//Nos conectamos a la base de datos y obtenemos el usuario
	require_once('BD_Concursos.inc');
	$conexion = new mysqli($host, $user, $pass, $bd);

	if($conexion->connect_error){

		die("Por el momento no se puede acceder al gestor de la BD");

	}
	
	
	$query = "select nombreConcurso as 'Nombre', hashtag as 'Hashtag de Twitter', dificultad as 'Dificultad', categoria as 'Categoria',
	 fechaDeAlta as 'Fecha de Alta', fechaDeInicio as 'Fecha de inicio', descripcion as 'Descripcion', fechaDeFin as 'Fecha de fin', motivos as 
	 'Motivos de cancelacion', usuarioGanador as 'Usuario ganador', usuarioOrganizador as 'ID Creador' from concurso where status = 3";
	
	$resultados = $conexion -> query($query);

	//Convierto el resultado de mi consulta a un arreglo
	if($resultados -> num_rows >= 1){
		//Por cada fila obtengo un arreglo
		while($fila = $resultados -> fetch_assoc())
			$datos[] = $fila;
	}

	
	//Recorro mi arreglo para dibujar la tabla
	
	
	echo "<body style='background-color:#727272;'>";
	
	echo "<br /><h1><strong><p style='color: white; text-align:center;'>Concursos cancelados:</p></strong></h1>";
	
	echo "<div style='clear:both;
		background-color: #D5D7C6;
		color: #1739AB;
		font-weight: bold;
		font-size: 1.7em;
		text-align: center;
		border-style: solid;
		margin-top: 20px;
		border-radius:7px;
		-moz-border-radius:7px;
		-webkit-border-radius:7px;'>";
	
	echo "<table border='1' style='text-align:center;'>";
	echo '<caption>Datos de los concursos</caption>';

	//Obtener los titulos
	$fila = $datos[0];
	$titulos = array_keys($fila);
	echo '<thead><tr>';
	foreach($titulos as $th)
	echo '<th>',$th,'</th>';
	echo '</tr></thead>';

	echo '<tbody>';

	//Por cada fila
	foreach($datos as $fila => $arr){
	echo '<tr>';
	//Todos los campos de cada fila
	foreach($arr as $campo => $valor){
	if($campo == 'idusuario'){
	//Una opción es generar un link y mandar el id por get
	//La otra opción es un form
	
	//En lugar de brincar dos veces para editar como en la linea de abajo,
	//puedo buscar directo en el archivo del formulario como en la linea de arriba
	//<form action="php/usuarioEditar.php" method="post">
	}
	else
	echo '<td>',$valor,'</td>';
	}
	echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';	
	
	echo "</div>
	
	<div style='text-align:center;'><br />
	<input type='button' value='Regresar' onClick='history.back()' style='font-size:1.1 em; font-weight: bold;'>
	</div>
	
	</body>";

	
	$conexion -> close();
	


?>
