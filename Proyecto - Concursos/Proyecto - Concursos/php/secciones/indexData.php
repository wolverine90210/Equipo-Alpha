<?php

//Nos conectamos a la base de datos y obtenemos el usuario
	require_once('bd.inc');
	$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

	if($conexion->connect_error){

		die("Por el momento no se puede acceder al gestor de la BD");

	}
	
	
	$query = "select * from concurso limit 10";
				
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

		$imagen = (string)$imagen;
		
		if($dbpass == "root"){		
			$numFolder = (string)$datos[$i]['idConcurso'];
			$string1 = "/var/www/Proyecto - Concursos/php/uploads/".$numFolder."/";
			$string2 = "php/uploads/".$numFolder."/";
			$imagen = str_replace($string1, $string2, $imagen);
		}
		
		$numFolder = (string)$datos[$i]['idConcurso'];
		$string1 = "/home/cc409/equipo-alpha/www/php/uploads/".$numFolder."/";
		$string2 = "http://alanturing.cucei.udg.mx/equipo-alpha/php/uploads/".$numFolder."/";
		$imagen = str_replace($string1, $string2, $imagen);
			
				
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
								
		echo "<div class=\"entrada\"><b>Entradas:</b> 6 </div><div class=\"ver_mas\"><b><a href=\"vista-detalle.php?id='".$idConc."'\">Ver más...</a></b></div><br />";
	
		echo "</section>
		<div class='sombra_seccion'></div>";		
		
	}

?>
