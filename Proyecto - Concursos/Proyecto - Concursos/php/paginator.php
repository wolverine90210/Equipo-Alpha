<?php
//Cargar el archivo de funciones




require_once("funciones.php");
echo "<link rel=\"stylesheet\" href=\"css/estiloTabla.css\" type=\"text/css\" >"; 

//Para la funcion que mando llamar con Ajax
if(isset($_REQUEST["status"]))
	//echo 'Entro';
	$concursos  = listarConcursosPorStatus($_REQUEST["status"]);	

else 
	$concursos = listarConcursos();


//Recorro mi arreglo para dibujar la tabla
echo '<table border="1" class="imagetable">';
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
				echo '<th>','Nombre ','</th>';
			break;
		case 'hashtag':
				echo '<th>','Hashtag ','</th>';
			
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

echo '<th>',' más detalles','</th>';
echo '</tr></thead>';

echo '<tbody>';
$contador = 0;
//Por cada fila
foreach($concursos as $fila => $arr){
	echo '<tr>';
	$contador++;
	//Todos los campos de cada fila
	foreach($arr as $campo => $valor){
		switch($campo){

			case 'idConcurso':
			
				if($contador %2 == 0)
					$clase = 'even';
				else
					$clase = 'odd';
					 
				echo '<td class ='.$clase.'> 
					  <form action="php/concursoEliminar.php" method="post">
						<input type="hidden" name="id" value="',$valor,'" />
						<input type="image" src="images/eliminar.png" width="30" height="30" />
					  </form>
					  <form action="php/concursoEditar.php" method="post">
						<input type="hidden" name="id" value="',$valor,'" />
						<input type="image" src="images/edit.png" width="30" height="30"/>
					  </form>
					  </td>';	
					 $idConcurso = $valor;
				break;
				
			case 'nombreConcurso':
			echo '<td class ='.$clase.'> ',$valor,'</td>';
			break;
			
			case 'hashtag':
			echo '<td class ='.$clase.'> ',$valor,'</td>';
			break;
					
			case 'categoria':
				$valor = buscarPorCategoria($valor);
				echo '<td class ='.$clase.'> ',$valor["nom_Categoria"],'</td>';
				break;
					
					
			case 'dificultad':
				if($valor == 1) $valor = 'Básica';
				else if($valor == 2)  $valor = 'Intermedia';
				else if($valor == 3)  $valor = 'Avanzada';
				echo '<td class ='.$clase.'> ',$valor,'</td>';
				break;
				
			case 'fechaDeInicio':
				
			$fechaIni = $valor;
			
			
			break;
			
			case 'fechaDeFin':
				$fechaInicio = date('d-m-Y', strtotime($fechaIni));
				echo '<td class ='.$clase.'> ','Del: ',"$fechaInicio";
				$fechaFin = date('d-m-Y', strtotime($valor));
				echo "<br>".'Al: ',"$fechaFin","",'</td>';
				break;
				
			case 'usuarioOrganizador':
				
				$valor = buscarPorIdOrganizador($valor);
				echo '<td class ='.$clase.'> '.$valor["arrobaUsuario"].'</td>';
			
			break;
			

		}

	}
	echo '<td class ='.$clase.'> 
					  <form action="vista-detalle.php" method="post">
						<input type="hidden" name="id" value="'.$idConcurso.'" />
						<input type="image" src="images/magni.png" width="30" height="30" />
					  </form>
			</td>';
	
	
	echo '</tr>';
}
echo '</tbody>';
echo '</table>';
?>



	