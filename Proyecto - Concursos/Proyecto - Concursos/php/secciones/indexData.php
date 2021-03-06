<?php

//Nos conectamos a la base de datos y obtenemos el usuario
	require_once('bd.inc');
	echo "<script type=\"text/javascript\" src=\"js/ajax.js\"></script>";
	echo "<link href=\"css/general.css\" type=\"text/css\" rel=\"stylesheet\" />";
	$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

	if($conexion->connect_error){

		die("Por el momento no se puede acceder al gestor de la BD");

	}

	$RegistrosAMostrar=5;

	//estos valores los recibo por GET
	if(isset($_GET['pag'])){
		$RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
		$PagAct=$_GET['pag'];
	//caso contrario los iniciamos
	}else{
		$RegistrosAEmpezar=0;
		$PagAct=1;
	
	}

	
	
	$query = "select * from concurso order by `fechaDeAlta` desc LIMIT $RegistrosAEmpezar, $RegistrosAMostrar";
				
	$resultados = $conexion -> query($query);
				
	if($resultados -> num_rows >= 1){

		while($fila = $resultados -> fetch_assoc())
			$datos[] = $fila;
				
	}
	
	/* CATEGORÍAS */
	$query = "select * from categoria";
	
	$categorias = $conexion -> query($query);
	
	if($categorias -> num_rows >= 1){
		while	($filaCat = $categorias -> fetch_assoc())
			$datosCat[] = $filaCat;}
			
			
	/* IMÁGENES */
	$query = "select * from imagenes";
	
	$imagenes = $conexion -> query($query);
	
	if($imagenes -> num_rows >= 1){
		while	($filaImg = $imagenes -> fetch_assoc())
			$datosImg[] = $filaImg;}
					
	
	
	if(isset($datosImg) && isset($datos)){
		for($i=0; $i<count($datos); $i++){
	
	
			echo "<section class='seccion'>";
		
			echo "<div class='concurso'>".$datos[$i]['nombreConcurso']."</div>";
		
			for($k=0; $k<count($datosCat); $k++)
				if($datosCat[$k]['idCategoria'] == $datos[$i]['categoria'])
					$categoria = $datosCat[$k]['nom_Categoria'];
				
			if($datos[$i]['dificultad'] == 1)
				$dificultad = "B&aacutesica";
			if($datos[$i]['dificultad'] == 2)
				$dificultad = "Intermedia";
			if($datos[$i]['dificultad'] == 3)
				$dificultad = "Alta";			
			
		
			for($k=0; $k<count($datosImg); $k++)
				if($datosImg[$k]['CONCURSO_idConcurso'] == $datos[$i]['idConcurso'])
					$imagen = $datosImg[$k]['url_imagen'];
			
			if(isset($imagen)){
			
			$imagen = (string)$imagen;

		
			if($dbuser == "root"){
				$numFolder = (string)$datos[$i]['idConcurso'];
				$string1 = "/var/www/Proyecto - Concursos/php/uploads/".$numFolder."/";
				$string2 = "php/uploads/".$numFolder."/";
				$imagen = str_replace($string1, $string2, $imagen);
			}
		
			$numFolder = (string)$datos[$i]['idConcurso'];
			$string1 = "/home/cc409/equipo-alpha/www/php/uploads/".$numFolder."/";
			$string2 = "http://alanturing.cucei.udg.mx/equipo-alpha/php/uploads/".$numFolder."/";
			$imagen = str_replace($string1, $string2, $imagen);
			}
				
			echo "<div class='features'><div class='spec'>Categoría: </div><div class='spec_content'>".$categoria.
			"</div> <div class='spec'> Dificultad: </div> <div class='spec_content'>".$dificultad.
			"</div><div class='spec'> Inicia: </div> <div class='spec_content'>".$datos[$i]['fechaDeInicio'].
			"</div> <div class='spec'> Termina: </div> <div class='spec_content'>".$datos[$i]['fechaDeFin'].
			"</div> </div><br /><br /><br />";

		
			if(isset($imagen)){
			echo "<div class='image'><img src='".$imagen."' alt='Poster'/></div>
				<p>".$datos[$i]['descripcion']."</p><br />";	
			
			}
		
			$idConc = $datos[$i]['idConcurso'];
			$idUser = $datos[$i]['usuarioOrganizador'];
			
			/* ENTRADAS */
			$query = "select count(*) as num from entrada where USUARIO_idUsuario = $idUser";
			$entradas = $conexion -> query($query);
			$numEntradas = $entradas -> fetch_array(MYSQLI_ASSOC);
			
			$query = "select arrobaUsuario as arroba from usuario where idUsuario = $idUser";
			$usuario = $conexion -> query($query);
			$arrobaUser = $usuario -> fetch_array(MYSQLI_ASSOC);
		
			
			echo "<p><strong>Enviado por:  ".$arrobaUser['arroba']."</strong></p>";
			echo "<div class=\"entrada\"><b>Entradas:</b> ". $numEntradas['num'] ." </div><div class=\"ver_mas\"><b><a href=\"vista-detalle.php?id='".$idConc."'\">Ver más...</a></b></div><br />";
	
			echo "</section>
			<div class='sombra_seccion'></div>";		
		
		}

			//Creo la consulta
			$mi_query = "select * from concurso";
		
			//Ejecuto mi consulta
			$result = $conexion -> query($mi_query);
			
			$NroRegistros = $result -> num_rows;

			$PagAnt=$PagAct-1;
			$PagSig=$PagAct+1;
			$PagUlt=$NroRegistros/$RegistrosAMostrar;

			//verificamos residuo para ver si llevar� decimales
			$Res=$NroRegistros%$RegistrosAMostrar;
			// si hay residuo usamos funcion floor para que me
			// devuelva la parte entera, SIN REDONDEAR, y le sumamos
			// una unidad para obtener la ultima pagina
			if($Res>0) $PagUlt=floor($PagUlt)+1;

			//desplazamiento
			
			echo "<footer id=\"paginacion\">";
			echo "<a onclick=\"PaginaIndex('1')\">Primero</a> ";
			if($PagAct>1) echo "<a id=\"anterior\"  onclick=\"PaginaIndex('$PagAnt')\">Anterior</a> ";
			echo "<strong>Página ".$PagAct." de ".$PagUlt."</strong>";
			if($PagAct<$PagUlt)  echo " <a id=\"siguiente\" onclick=\"PaginaIndex('$PagSig')\">Siguiente</a> ";
			echo "<a onclick=\"PaginaIndex('$PagUlt')\">Ultimo</a>";
			echo "</footer>";
	}
	else{
		
		echo "<section class='seccion' style='text-align:center'><p><h2>NO HAY CONCURSOS PARA MOSTRAR<h2></p></section>
			<div class='sombra_seccion'></div>";
	
	}

?>
