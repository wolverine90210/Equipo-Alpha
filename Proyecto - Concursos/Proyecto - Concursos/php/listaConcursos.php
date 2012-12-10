<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8" />
</head>
<body>
<?php
/**
 *
 *
 *
 */


//Cargar el archivo de funciones
require_once("funciones.php");

//Ejecutar la función que obtiene
//los datos de los usuarios

//Para la funcion que mando llamar con Ajax
if(isset($_REQUEST["status"]))

	$concursos  = listarConcursosPorStatus($_REQUEST["status"]);

else if(isset($_REQUEST["status2"]))

	$concursos  = listarConcursosCuenta($_REQUEST["status2"]);
	
else if(isset($_REQUEST["fi"]) && isset($_REQUEST["ff"]) )

	
	$concursos = buscarPorFechas($_REQUEST["fi"] , $_REQUEST["ff"]);
	
else if(isset($_REQUEST["dificultad"]))

	
	$concursos = buscarPorDificultad($_REQUEST["dificultad"]);	
	
else if(isset($_REQUEST["categoria"]))

	
	$concursos = buscarConcursosPorCategoria($_REQUEST["categoria"]);	
	
else 
	$concursos = listarConcursos();
	
	if(isset($concursos)){
		
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

				echo '<td>
					  <form action="php/concursoEliminar.php" method="post">
						<input type="hidden" name="id" value="',$valor,'" />
						<input type="image" src="images/eliminar2.png" />
					  </form>
					  <form action="php/concursoEditar.php" method="post">
						<input type="hidden" name="id" value="',$valor,'" />
						<input type="image" src="images/edit2.png" />
					  </form>
					  </td>';	
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
		
		
		
	}

else {
	echo 'no hay concursos que mostrar';
}

?>
</body>
</html>
