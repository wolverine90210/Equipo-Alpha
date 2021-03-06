﻿<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
</head>
<body>
<?php
	//Cargar el archivo de funciones
	require_once("funciones.php");

	//Ejecutar la función que obtiene
	//los datos de los usuarios
	//Limpiar las entradas
	//var_dump($_REQUEST);
	
	$fechaInicio = date('Y-m-d', strtotime($_REQUEST['fechaInicio']));
	$fechaFin = date('Y-m-d', strtotime($_REQUEST['fechaFin']));
	//var_dump($fechaInicio);
	//var_dump($fechaFin);

	//Ejecutar la función que obtiene
	//los concursos por rango de fechas
	$concursos = buscarPorfechas($fechaInicio, $fechaFin);
	$categorias = buscarCategorias();
	var_dump($categorias);
	
	//Recorro mi arreglo para dibujar la tabla
	echo '<table border="1">';
	echo '<caption>Concursos agregados</caption>';
	
	//Obtener los titulos
	$fila = $concursos[0];
	$titulos = array_keys($fila);
	echo '<thead><tr>';
	foreach($titulos as $th){
	
		if($th == 'idConcurso')
			echo '<th>','Acciones','</th>';
	

		else
			echo '<th>',$th,'</th>';
	
	}
		
	echo '</tr></thead>';
		
	echo '<tbody>';
	
	//Por cada fila
	foreach($concursos as $fila => $arr){
		echo '<tr>';
		//Todos los campos de cada fila
		foreach($arr as $campo => $valor){
			switch($campo){
			
			case 'idConcurso':
			//Una opción es generar un link y mandar el id por get			
				//La otra opción es un form				
				echo '<td>
					  <form action="php/CRUDConcurso/concursoEliminar.php" method="post">
						<input type="hidden" name="id" value="',$valor,'" />
						<input type="image" src="img/eliminar.png" />
					  </form>
					  <form action="php/CRUDConcurso/concursoEditar.php" method="post">
						<input type="hidden" name="id" value="',$valor,'" />
						<input type="image" src="img/editar.png" />
					  </form>
					  </td>';
				//En lugar de brincar dos veces para editar como en la linea de abajo,
				//puedo buscar directo en el archivo del formulario como en la linea de arriba
				//<form action="php/usuarioEditar.php" method="post">
			
			break;
			
			case 'categoria':
				$valor = buscarPorCategoria($valor);
				echo '<td>',$valor["nom_Categoria"],'</td>'; 
			break;
			
			
			case 'dificultad':
				if($valor == 1) $valor = 'Básica';
				else if($valor == 2)  $valor = 'Intermedia';
				else if($valor == 3)  $valor = 'Avanzada';
				echo '<td>',$valor,'</td>';
			break;
			
			case 'status':
				if($valor == 1) $valor = 'Pendiente';
				else if($valor == 2)  $valor = 'Aceptado';
				else if($valor == 3)  $valor = 'Rechazado';
				echo '<td>',$valor,'</td>'; 
			
			break;
			
			case 'usuarioGanador':
				$valor = buscarPorIdGanador($valor);
				echo '<td>',$valor["arrobaUsuario"],'</td>'; 
			break;
			
			case 'usuarioOrganizador':
				$valor = buscarPorIdOrganizador($valor);
				echo '<td>',$valor["arrobaUsuario"],'</td>'; 
			
			break;
			
			default: echo '<td>',$valor,'</td>'; 
			
			
			}

		}
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	
	echo 'Poner un link que lo redireccione hacia atras';

?>


</body>
</html>	




