<?php

	//session_start();
	ob_start();
	//Nos conectamos a la base de datos y obtenemos el usuario
	require_once('bd.inc');
	$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

	if($conexion->connect_error){

		die("Por el momento no se puede acceder al gestor de la BD");

	}
	
	
	//Obtengo mis variables a utilizar
	$usuario = $_REQUEST['user'];
	$nombreConcurso = $_REQUEST["inNombre"];
	$hashTwitter = $_REQUEST["field_hashtag"];
	//$categoria = $_REQUEST["categoria"];
	//sacar la categoria del arreglo
if (isset($_REQUEST['categoria'])){
	$categorias = $_REQUEST['categoria'];
	$n        = count($categorias);
	$i        = 0;
	while ($i < $n)
	{
		$categoria =$categorias[$i];
		$i++;
	}
}

	$dificultad = $_REQUEST["dificultad"];
	$fechaInicial = $_REQUEST["fini"];
	$fechaFinal = $_REQUEST["ffinal"];
	$fechaCreacion = $_REQUEST["fcreacion"];
	$img = $_REQUEST["imagen"];
	$contenido = $_REQUEST['dataEdit'];
	
	
	$fechaInicial = date('Y-m-d', strtotime($fechaInicial));
	$fechaFinal = date('Y-m-d', strtotime($fechaFinal));
	$fechaCreacion = date('Y-m-d', strtotime($fechaCreacion));


	//Limpiar variables a utilizar
	$nombreConcurso = $conexion -> real_escape_string($nombreConcurso);
	$hashTwitter = $conexion -> real_escape_string($hashTwitter);
	$dificultad = $conexion -> real_escape_string($dificultad);
	$categoria = $conexion -> real_escape_string($categoria);
	$fechaInicial = $conexion -> real_escape_string($fechaInicial);
	$fechaFinal = $conexion -> real_escape_string($fechaFinal);
	$fechaCreacion = $conexion -> real_escape_string($fechaCreacion);
	$img = $conexion -> real_escape_string($img);
	$usuario = $conexion -> real_escape_string($usuario);
	$contenido = $conexion -> real_escape_string($contenido);
	
	if(stristr($contenido, '\r') || stristr($contenido, '\n')){
		$contenido = str_replace('\r',"",$contenido);
		$contenido = str_replace('\n',"",$contenido);
		$contenido = str_replace('\t',"",$contenido);
	}
		
	
	if($dificultad == "Basica")
		$dif = 1;
	if($dificultad == "Intermedia")
		$dif = 2;
	if($dificultad == "Alta")
		$dif = 3;
		
		
	
	$query = "SET FOREIGN_KEY_CHECKS=0";
	$conexion -> query($query);
	
	$query = "update concurso set nombreConcurso='$nombreConcurso', hashtag='$hashTwitter', dificultad=$dif, categoria=$categoria, 
	fechaDeAlta='$fechaCreacion', fechaDeInicio='$fechaInicial', descripcion='$contenido', fechaDeFin='$fechaFinal' where
	nombreConcurso='$nombreConcurso'";
	$conexion -> query($query);
	
	
	$query = "SET FOREIGN_KEY_CHECKS=1";
	$conexion -> query($query);
	
	//subir las imagenes y agregarlas a la base de datos
require_once("funciones.php");
$uploaded = 0;
$message = array();
$idConcurso = dameIdDeConcurso($nombreConcurso,$hashTwitter);
echo 'my id is:', $idConcurso;

 
function mkdir_recursive($pathname, $mode)
{
	is_dir(dirname($pathname)) || mkdir_recursive(dirname($pathname), $mode);
	return is_dir($pathname) || @mkdir($pathname, $mode);
}

echo "AQUI EMPIEZA: U_U";
foreach ($_FILES['file']['name'] as $i => $name) {echo "PTM!";

	if ($_FILES['file']['error'][$i] == 4) {
		continue;
	}
	if ($_FILES['file']['error'][$i] == 0) {

		if ($_FILES['file']['size'][$i] > 99999999) {
			$message[] = "usted ha excedido el limite de archivos.";
			continue;
		}
		 
		//Se define el tamaño que se permitirá (en KB por eso lo multiplicamos por 1024)
		$tamanioPermitido = 1000 * 1024;

		//Tenemos una lista con las extensiones que aceptaremos
		$extensionesPermitidas = array("jpg", "jpeg", "gif", "png");

		//Obtenemos la extensión del archivo
		$temp = explode(".", $_FILES["file"]["name"][$i]);
		$extension = end($temp);


		//Validamos el tipo de archivo, el tamaño en bytes y que la extensión sea válida
		if ((($_FILES["file"]["type"][$i] == "image/gif")
		|| ($_FILES["file"]["type"][$i] == "image/jpeg")
		|| ($_FILES["file"]["type"][$i] == "image/png")
		|| ($_FILES["file"]["type"][$i] == "image/pjpeg"))
		&& ($_FILES["file"]["size"][$i] < $tamanioPermitido)
		&& in_array($extension, $extensionesPermitidas)){
				
			//Si no hubo un error al subir el archivo temporalmente
			if ($_FILES["file"]["error"][$i] > 0)
			{
				echo "Código de error: " . $_FILES["file"]["error"][$i] . "<br />";
			}
			else{

				$nombre_fichero="./uploads/$idConcurso";
				//checo si existe la carpeta donde guardaré las imagenes
				//sino la creo
				if (file_exists($nombre_fichero)) {
					echo "El fichero $nombre_fichero existe";
				} else {
					//si no existe la carpeta la creo y le doy permisos
					if(mkdir_recursive($nombre_fichero, 0775,true))
					echo 'ahora ya existe';
					else
					echo 'hubo problemas al crear el archivo';
				}
					
				//donde voy a guardar la imagen
				$rutaDestino = getcwd()."/uploads/$idConcurso/".$_FILES["file"]["name"][$i];
				echo $rutaDestino;
					
				//Si el archivo ya existe se muestra el mensaje de error
				if (file_exists($rutaDestino)){
					echo $_FILES["file"]["name"][$i] . " ya existese. ";
				}
				else{
						
					//Cargo en memoria la imagen que quiero redimensionar
					$ruta_imagen = $_FILES["file"]["tmp_name"][$i];

					//veo que extension tiene la imagen que subo para llamar a la funcion createimage adecuada

					if($_FILES["file"]["type"][$i] == "image/gif")
					$imagen_original = imagecreatefromgif($ruta_imagen);
					else if($_FILES["file"]["type"][$i] == "image/jpeg" || $_FILES["file"]["type"][$i] == "image/pjpeg")
					$imagen_original = imagecreatefromjpeg($ruta_imagen);
					else if($_FILES["file"]["type"][$i] == "image/png")
					$imagen_original = imagecreatefrompng($ruta_imagen);


					//Obtengo el ancho de la imagen que cargue
					$ancho_original = imagesx($imagen_original);

					//Obtengo el alto de la imagen que cargue
					$alto_original = imagesy($imagen_original);
					/*
						//SI QUEREMOS UN ANCHO FINAL FIJO, calculamos el ALTO de forma proporcionada
						$ancho_final = 250;

						//Ancho final en pixeles
						$alto_final = ($ancho_final / $ancho_original) * $alto_original;*/

					//SI CONOCEMOS UN ALTO FINAL FIJO, calculamos el ANCHO de forma proporcionada

					//Para usar este caso, comentar las dos lineas anteriores, y descomentar las dos siguientes a este comentario

					$alto_final = 250; //Alto final en pixeles
					$ancho_final = ($alto_final / $alto_original) * $ancho_original;

					//Creo una imagen vacia, con el alto y el ancho que tendrá la imagen redimensionada
					$imagen_redimensionada = imagecreatetruecolor($ancho_final, $alto_final);

					//Copio la imagen original con las nuevas dimensiones a la imagen en blanco que creamos en la linea anterior
					imagecopyresampled($imagen_redimensionada, $imagen_original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho_original, $alto_original);

					//Guardo la imagen ya redimensionada
					if(imagepng($imagen_redimensionada, $rutaDestino)){
							
						$uploaded++;
						
						
						//Guardar ruta en la base de datos
						
						$query = "INSERT INTO `imagenes` ( `url_imagen`, `CONCURSO_idConcurso`) VALUES ('$rutaDestino', '$idConcurso')";
					
						//Ejecutar el query
							$result = $conexion -> query($query);
							if($conexion -> error)
								printf("Errormessage: %s\n", $conexion->error);
							
							else 
								echo "Archivo guardado y redimensionado";
							
					}
						
					else
					echo 'Problema con la movida';
						
					//Libero recursos, destruyendo las imágenes que estaban en memoria
					imagedestroy($imagen_original);
					imagedestroy($imagen_redimensionada);
				}
			}
		}
		else
		{
			echo "Archivo inválido";
		}
	}
}
 
echo $uploaded . ' imágenes subidas.';

foreach ($message as $error) {
	echo $error;
}
	
	
	echo "<!DOCTYPE html><html lang='es'><body style='background-color:#727272;'>
		<head>
		<meta charset='UTF-8' />
		</head>
		﻿<br /><br /><br /><br />
		<h1><strong><p style='color: white; text-align:center;'>Acción exitosa:</p></strong></h1>
		<div style='clear:both;
		background-color: #D5D7C6;
		color: #1739AB;
		font-weight: bold;
		font-size: 1.7em;
		text-align: center;
		border-style: solid;
		margin-top: 20px;
		border-radius:7px;
		-moz-border-radius:7px;
		-webkit-border-radius:7px;'>
	
		<h3><strong><p style='text-align:center'>Concurso editado correctamente.</p></strong></h3>
		<img src='../images/notebook_edit.png' alt='ganador_icon' />
		</div>
		<br /><h2><strong><p style='color: white; text-align:center;'>En un momento será redirigido a la página anterior...</p></strong></h2>
		</body>
		</html>
		";
		
		@header('refresh: 4; url=../adminConcursos.php');

	
	$conexion -> close();


?>
