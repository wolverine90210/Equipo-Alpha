<?php	

	//Nos conectamos a la base de datos y obtenemos el usuario
	require_once('bd.inc');
	$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

	if($conexion->connect_error){

		die("Por el momento no se puede acceder al gestor de la BD");

	}
	
	
	$query = "select idConcurso as 'ID de concurso', nombreConcurso as 'Nombre', hashtag as 'Hashtag de Twitter', dificultad as 'Dificultad', categoria as 'Categoria',fechaDeAlta as 'Fecha de Alta', fechaDeInicio as 'Fecha de inicio', descripcion as 'Descripcion', fechaDeFin as 'Fecha de fin', motivos as 'Motivos de cancelacion', usuarioGanador as 'Usuario ganador', usuarioOrganizador as 'Usuario creador' from concurso where status=3";
	
	$resultados = $conexion -> query($query);
	
	$query = "select * from categoria";
	
	$categorias = $conexion -> query($query);
	
	$query = "select * from usuario";
	
	$usuarios = $conexion -> query($query);
	
	//Convierto el resultado de mi consulta a un arreglo
	if($categorias -> num_rows >= 1){
		//Por cada fila obtengo un arreglo
		while($filaCat = $categorias -> fetch_assoc())
			$datosCat[] = $filaCat;
	}
	
	//Convierto el resultado de mi consulta a un arreglo
	if($usuarios -> num_rows >= 1){
		//Por cada fila obtengo un arreglo
		while($filaUsers = $usuarios -> fetch_assoc())
			$datosUsers[] = $filaUsers;
	}
	
	//Convierto el resultado de mi consulta a un arreglo
	if($resultados -> num_rows >= 1){
		//Por cada fila obtengo un arreglo
		while($fila = $resultados -> fetch_assoc())
			$datos[] = $fila;	

	
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
		if($campo == 'ID de concurso'){
		
	//Una opción es generar un link y mandar el id por get
	//La otra opción es un form
	/*<a href="php/editarConcurso.php?id=',$valor,'">
	<img src="images/edit.gif" />
	</a>
	<form action="editarConcurso.php" method="post">
	<input type="hidden" name="idUsuario" value="',$valor,'" />
	<input type="image" src="../images/edit.gif" />
	<input type="image" src="../images/delete.png" />
	</form>*/
	
	echo '<td>
	<a href="concursoEditar.php?id=',$valor,'">
	<img src="../images/edit.gif" />
	</a>
	<a href="eliminarConcurso.php?id=',$valor,'">
	<img src="../images/delete.png" />
	</a>
	</td>';
	
	//En lugar de brincar dos veces para editar como en la linea de abajo,
	//puedo buscar directo en el archivo del formulario como en la linea de arriba
	//<form action="php/usuarioEditar.php" method="post">
	
	}else if($campo == 'Dificultad'){
		if($valor == 1)
				echo '<td>','B&aacutesica','</td>';
		if($valor == 2)
				echo '<td>','Intermedia','</td>';
		if($valor == 3)
				echo '<td>','Alta','</td>';
		
	//Una opción es generar un link y mandar el id por get
	//La otra opción es un form
	
	//En lugar de brincar dos veces para editar como en la linea de abajo,
	//puedo buscar directo en el archivo del formulario como en la linea de arriba
	//<form action="php/usuarioEditar.php" method="post">
	}
	else if($campo == "Categoria"){
		for($i=0; $i < count($datosCat);$i++){
			if($datosCat[$i]['idCategoria'] == $valor)
				echo '<td>',$datosCat[$i]['nom_Categoria'],'</td>';
		}
	}
	else if($campo == 'Usuario ganador'){
		for($i=0; $i < count($datosUsers);$i++){
			if($datosUsers[$i]['idUsuario'] == $valor)
				echo '<td>',$datosUsers[$i]['arrobaUsuario'],'</td>';
		}
	}
	else if($campo == 'Usuario creador'){
		for($i=0; $i < count($datosUsers);$i++){
			if($datosUsers[$i]['idUsuario'] == $valor)
				echo '<td>',$datosUsers[$i]['arrobaUsuario'],'</td>';
		}
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
	<input type='button' value='Regresar a vista de administrador' onClick=\"location.href='../adminConcursos.php'\" style='font-size:1.1 em; font-weight: bold;'>
	</div>
	
	</body>";

	}
	else{
		echo "<body style='background-color:#727272;'>";
	
		echo "<br /><div style='clear:both;
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
		
		echo "<p style='text-align:center;font-weight:bold;font-size:1.3em;'>No hay resultados para mostrar.</p>";
		echo "<p style='text-align:center'><img src='../images/empty_folder.png' width='128px' height='128px' 
				alt='empty_folder_icon' /></p>";
		echo "</div>
	
		<div style='text-align:center;'><br />
		<input type='button' value='Regresar a vista de administrador' onClick=\"location.href='../adminConcursos.php'\" style='font-size:1.1 em; font-weight: bold;'>
		</div>
	
		</body>";

	}
	
	$conexion -> close();
	


?>
