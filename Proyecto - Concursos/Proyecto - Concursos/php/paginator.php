<?php
//Cargar el archivo de funciones




require_once("funciones.php");
//echo "<link rel=\"stylesheet\" href=\"css/estiloTabla.css\" type=\"text/css\" >"; 

//Para la funcion que mando llamar con Ajax
if(isset($_REQUEST["status"]))
	//echo 'Entro';
	$concursos  = listarConcursosPorStatus($_REQUEST["status"]);	

else 
	$concursos = listarConcursos();


//Recorro mi arreglo para dibujar la tabla
echo '<table border="1">';
echo '<caption>Concursos agregados</caption>';

//Obtener los titulos
$fila = $concursos[0];
$titulos = array_keys($fila);
echo '<thead><tr>';
foreach($titulos as $th){
	
	switch ($th) {
		case 'idConcurso':
			echo '<th>','Acciones','</th>';
			
			break;
		case 'nombreConcurso':
				echo '<th>','Nombre del concurso','</th>';
			
			break;
		case 'dificultad':
				echo '<th>','Dificultad','</th>';
			
			break;
		case 'categoria':
				echo '<th>','Categoría','</th>';
			
			break;
		case 'fechaDeInicio':
				echo '<th>','Fechas','</th>';
			
			break;
			
		
		case 'usuarioOrganizador':
			
				echo '<th>','Organizado por','</th>';
			
			break;
	}
}

echo '<th>','Detalles','</th>';
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
						<input type="image" src="images/eliminar.png" width="30" height="30" />
					  </form>
					  <form action="php/concursoEditar.php" method="post">
						<input type="hidden" name="id" value="',$valor,'" />
						<input type="image" src="images/edit.png" width="30" height="30"/>
					  </form>
					  </td>';	
					 
				break;
				
			case 'nombreConcurso':
			echo '<td>',$valor,'</td>';
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
				
			case 'fechaDeInicio':
				
			$fechaIni = $valor;
			break;
			
			case 'fechaDeFin':
				echo '<td>','del ',"$fechaIni";
				echo "<br>".'al ',"$valor","",'</td>';
				break;
				
			case 'usuarioOrganizador':
				
				$valor = buscarPorIdOrganizador($valor);
				echo '<td>',$valor["arrobaUsuario"],'</td>';
			
			break;
			
			//src="" width="30" height="30"

		}

	}
	echo '<td><img src="images/magni.png" width="50" height="50"></td>';	
	echo '</tr>';
}
echo '</tbody>';
echo '</table>';
?>



	