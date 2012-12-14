<?php
session_start();

require_once ("funciones.php");
require_once ("bd.inc");
$uploaded = 0;
$message = array();

$idConcurso = dameIdDelUltimoConcursoAgregado();
$misRutas;
$contador = 1;
function mkdir_recursive($pathname, $mode) {
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
		$tamanioPermitido = 10000 * 1024;

		//Tenemos una lista con las extensiones que aceptaremos
		$extensionesPermitidas = array("jpg", "jpeg", "gif", "png");

		//Obtenemos la extensión del archivo
		$temp = explode(".", $_FILES["file"]["name"][$i]);
		$extension = end($temp);

		//Validamos el tipo de archivo, el tamaño en bytes y que la extensión sea válida
		if ((($_FILES["file"]["type"][$i] == "image/gif") || ($_FILES["file"]["type"][$i] == "image/jpeg") || ($_FILES["file"]["type"][$i] == "image/png") || ($_FILES["file"]["type"][$i] == "image/pjpeg")) && ($_FILES["file"]["size"][$i] < $tamanioPermitido) && in_array($extension, $extensionesPermitidas)) {

			//Si no hubo un error al subir el archivo temporalmente
			if ($_FILES["file"]["error"][$i] > 0) {
				//echo "Código de error: " . $_FILES["file"]["error"][$i] . "<br />";
			} else {

				$nombre_fichero = "./uploads/$idConcurso";
				//checo si existe la carpeta donde guardaré las imagenes
				//sino la creo
				if (file_exists($nombre_fichero)) {
					//echo "El fichero $nombre_fichero existe";
				} else {
					//si no existe la carpeta la creo y le doy permisos
					if (!mkdir_recursive($nombre_fichero, 0777, true)) {
						$mens = $_FILES["file"]["name"][$i] . 'hubo problemas al crear el archivo';

						if (isset($misRutas))
							$misRutas = $misRutas . $_FILES["file"]["name"][$i] . '@' . $mens . '|';
						else
							$misRutas = $_FILES["file"]["name"][$i] . '@' . $rutaDestino . '|';
						$contador++;
					}
				}

				//donde voy a guardar la imagen
				$rutaDestino = getcwd() . "/uploads/$idConcurso/" . $_FILES["file"]["name"][$i];
				//echo $rutaDestino;

				//Si el archivo ya existe se muestra el mensaje de error
				if (file_exists($rutaDestino)) {
					//echo $_FILES["file"]["name"][$i] . " ya existe. ";
					$mens = $_FILES["file"]["name"][$i];
					$misRutas = $misRutas . $_FILES["file"]["name"][$i] . '@' . $mens . '|';
					$contador++;

				} else {

					//creo una bandera para saber que tipo de imagen es '$tipoImagen'

					//Cargo en memoria la imagen que quiero redimensionar
					$ruta_imagen = $_FILES["file"]["tmp_name"][$i];

					//veo que extension tiene la imagen que subo para llamar a la funcion createimage adecuada

					if ($_FILES["file"]["type"][$i] == "image/gif") {

						$tipoImagen = 'gif';
						$imagen_original = imagecreatefromgif($ruta_imagen);

					} else if ($_FILES["file"]["type"][$i] == "image/jpeg" || $_FILES["file"]["type"][$i] == "image/pjpeg") {
						$tipoImagen = 'jpeg';
						$imagen_original = imagecreatefromjpeg($ruta_imagen);
					} else if ($_FILES["file"]["type"][$i] == "image/png") {
						$tipoImagen = 'png';
						$imagen_original = imagecreatefrompng($ruta_imagen);

					}

					//Obtengo el ancho de la imagen que cargue
					$ancho_original = imagesx($imagen_original);

					//Obtengo el alto de la imagen que cargue
					$alto_original = imagesy($imagen_original);
					
					 //SI QUEREMOS UN ANCHO FINAL FIJO, calculamos el ALTO de forma proporcionada
					 $ancho_final = 250;

					 //Ancho final en pixeles
					 $alto_final = ($ancho_final / $ancho_original) * $alto_original;

					//SI CONOCEMOS UN ALTO FINAL FIJO, calculamos el ANCHO de forma proporcionada

					//Para usar este caso, comentar las dos lineas anteriores, y descomentar las dos siguientes a este comentario

				/*	$alto_final = 450;
					//Alto final en pixeles
					$ancho_final = ($alto_final / $alto_original) * $ancho_original;*/

					//Creo una imagen vacia, con el alto y el ancho que tendrá la imagen redimensionada
					$imagen_redimensionada = imagecreatetruecolor($ancho_final, $alto_final);

					//Copio la imagen original con las nuevas dimensiones a la imagen en blanco que creamos en la linea anterior
					imagecopyresampled($imagen_redimensionada, $imagen_original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho_original, $alto_original);

					switch($tipoImagen) {

						case 'png' :

							//Guardo la imagen ya redimensionada
							if (imagepng($imagen_redimensionada, $rutaDestino)) {

								$uploaded++;
								$rutaServidor = "http://alanturing.cucei.udg.mx/equipo-alpha/php/uploads/" . $idConcurso . '/' . $_FILES["file"]["name"][$i];
								if (isset($misRutas)) {
									if ($dbuser == 'root') {
										$misRutas = $misRutas . $_FILES["file"]["name"][$i] . '@' . $rutaDestino . '|';

									} else {
										$misRutas = $misRutas . $_FILES["file"]["name"][$i] . '@' . $rutaServidor . '|';
									}
									
								} else {

									if ($dbuser == 'root') {
										$misRutas = $_FILES["file"]["name"][$i] . '@' . $rutaServidor . '|';
									} else {
										$misRutas = $_FILES["file"]["name"][$i] . '@' . $rutaDestino . '|';
									}

								}

								$contador++;

							} else {
								//echo 'Problema con la movida';
							}
							break;

						case 'gif' :
							//Guardo la imagen ya redimensionada
							if (imagegif($imagen_redimensionada, $rutaDestino)) {

								$uploaded++;
								$rutaServidor = "http://alanturing.cucei.udg.mx/equipo-alpha/php/uploads/" . $idConcurso . '/' . $_FILES["file"]["name"][$i];
								if (isset($misRutas)) {

									if ($dbuser == 'root') {
										$misRutas = $misRutas . $_FILES["file"]["name"][$i] . '@' . $rutaDestino . '|';

									} else {

										$misRutas = $misRutas . $_FILES["file"]["name"][$i] . '@' . $rutaServidor . '|';

									}

								} else {

									if ($dbuser == 'root') {
										$misRutas = $_FILES["file"]["name"][$i] . '@' . $rutaDestino . '|';
									} else {

										$misRutas = $_FILES["file"]["name"][$i] . '@' . $rutaServidor . '|';

									}

								}

								$contador++;

							} else {
								//echo 'Problema con la movida';
							}

						default :

							//Guardo la imagen ya redimensionada
							if (imagejpeg($imagen_redimensionada, $rutaDestino)) {

								$uploaded++;
								$rutaServidor = "http://alanturing.cucei.udg.mx/equipo-alpha/php/uploads/" . $idConcurso . '/' . $_FILES["file"]["name"][$i];
								if (isset($misRutas)) {

									if ($dbuser == 'root') {
										$misRutas = $misRutas . $_FILES["file"]["name"][$i] . '@' . $rutaDestino . '|';
									} else {
										$misRutas = $misRutas . $_FILES["file"]["name"][$i] . '@' . $rutaServidor . '|';

									}

								} else {

									if ($dbuser == 'root') {
										$misRutas = $_FILES["file"]["name"][$i] . '@' . $rutaDestino . '|';
									} else {
										$misRutas = $_FILES["file"]["name"][$i] . '@' . $rutaServidor . '|';

									}

								}

								$contador++;

							} else {
								//echo 'Problema con la movida';
							}
							break;
					}

					//Libero recursos, destruyendo las imágenes que estaban en memoria
					imagedestroy($imagen_original);
					imagedestroy($imagen_redimensionada);
				}
			}
		} else {
			//echo "Archivo inválido";
		}
	}
}

//echo $uploaded . ' imágenes subidas.';
echo $misRutas;
?>