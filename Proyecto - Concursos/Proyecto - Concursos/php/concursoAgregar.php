<?php
/**
 *
 *
 *
 */
session_start();

//Nos conectamos a la base de datos
require_once("bd.inc");
$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

//Verificar que la conexión no haya generado error
if ($conexion->connect_error) {
	die('Error de Conexión (' . $conexion->connect_errno . ') '
	. $conexion->connect_error);
}

print_r($_REQUEST);

//Obtener mis variables del formulario
$nomConcurso = $_REQUEST['nombreConcurso'];
$hashtag = $_REQUEST['hashtagTwitter'];

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

$dificultad = $_REQUEST['dificultad'];
date_default_timezone_set('UTC');
$fechaAlta = date('Y-m-d', strtotime($_REQUEST['fechaAlta']));
$fechaInicio = date('Y-m-d', strtotime($_REQUEST['fechaInicio']));
$fechaFin = date('Y-m-d', strtotime($_REQUEST['fechaFin']));
$organizador = $_REQUEST['organizador'];
$descripConcurso = $_REQUEST['descripcion'];


//Validar las entradas para evitar inyecciones de sql
//Usar expresiones regulares y la función de mysqli
$nomConcurso = $conexion -> real_escape_string($nomConcurso);
$hashtag = $conexion -> real_escape_string($hashtag);
$categoria = $conexion -> real_escape_string($categoria);
$dificultad = $conexion -> real_escape_string($dificultad);
$fechaAlta = $conexion -> real_escape_string($fechaAlta);
$fechaInicio = $conexion -> real_escape_string($fechaInicio);
$fechaFin = $conexion -> real_escape_string($fechaFin);
$organizador = $conexion -> real_escape_string($organizador);
$descripConcurso = $conexion -> real_escape_string($descripConcurso);


//buscar el id del usuario organizador
$query = "select * from usuario where arrobaUsuario = '$organizador'";

//Ejecutar el query
$result = $conexion -> query($query);


//Convierto el resultado de mi consulta a una matriz
if($result -> num_rows == 1)
$datos= $result -> fetch_assoc();

//este es el id del usuarioOrganizador
$idUsuario = $datos['idUsuario'];


//Si ya existe el concurso entonces hacer update sino hacer insert
if(isset($_REQUEST['idConcurso'])){
	$idConcurso = $_REQUEST['idConcurso'];
	$query = "UPDATE `concurso` SET `idConcurso` = $idConcurso,`nombreConcurso` = '$nomConcurso',
			`hashtag` = '$hashtag',`dificultad` = $dificultad,`categoria` = $categoria,`fechaDeAlta` = '$fechaAlta',
			`fechaDeInicio` = '$fechaInicio',
			`descripcion` = '$descripConcurso',`fechaDeFin` = '$fechaFin',
			`status` = 1,`motivos` = 'falta aprobar',`usuarioGanador` = 1,
			`usuarioOrganizador` = $idUsuario 
				WHERE `concurso`.`idConcurso` = $idConcurso
 				AND `concurso`.`categoria` = 1 AND `concurso`.`usuarioOrganizador` = $idUsuario;";

}
else{

	//insertar el concurso con todos lo datos
	$query = "INSERT INTO `concurso` (`nombreConcurso`, `hashtag`, `dificultad`, `categoria`, `fechaDeAlta`, `fechaDeInicio`, `descripcion`, `fechaDeFin`, `status`, `motivos`, `usuarioGanador`, `usuarioOrganizador`)
			  VALUES ('$nomConcurso', '$hashtag', $dificultad, $categoria, '$fechaAlta', '$fechaInicio', '$descripConcurso', '$fechaFin', 1, 'falta revisar', 1, $idUsuario)";
}


//Ejecutar el query
$result = $conexion -> query($query);
if($conexion -> error)
printf("Errormessage: %s\n", $conexion->error);




//subir las imagenes y agregarlas a la base de datos
require_once("funciones.php");
$uploaded = 0;
$message = array();
$idConcurso = dameIdDeConcurso($nomConcurso,$hashtag);
echo 'my id is:', $idConcurso;

 
function mkdir_recursive($pathname, $mode)
{
	is_dir(dirname($pathname)) || mkdir_recursive(dirname($pathname), $mode);
	return is_dir($pathname) || @mkdir($pathname, $mode);
}
 
foreach ($_FILES['file']['name'] as $i => $name) {

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
					if(mkdir_recursive($nombre_fichero, 0755,true))
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


//Cerrar la conexion
$conexion -> close();



//mostrar un mensaje de confirmacion
 /*echo "<!DOCTYPE html><html lang='es'><body style='background-color:#727272;'>
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

 <h3><strong><p style='text-align:center'>Concurso agregado exitosamente.</p></strong></h3>
 </div>
 <br /><h2><strong><p style='color: white; text-align:center;'>En un momento será redirigido a la página anterior...</p></strong></h2>
 </body>
 </html>
 ";
 header('refresh: 2; url=http://localhost/Proyecto2012/listaConcursos.php');
*/
?>
