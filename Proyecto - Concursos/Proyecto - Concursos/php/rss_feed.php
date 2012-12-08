<?php

// Elimina caracteres extraños que me pueden molestar en las cadenas que meto en los item de los RSS
function clrAll($str) {
   $str=str_replace("&","&",$str);
   $str=str_replace("\"","\"",$str);
   $str=str_replace("'","'",$str);
   $str=str_replace(">",">",$str);
   $str=str_replace("<","<",$str);
   return $str;
}

//creo cabeceras desde PHP para decir que devuelvo un XML
header("Content-type: text/xml");

//comienzo a escribir el código del RSS
echo "<?xml version='1.0'"." encoding='ISO-8859-1'?>";

//conecto con la base de datos
/*
$Servidor = "localhost";
$usuario = "root";
$clave = "";
$bbdd = "aplicacionarticulos";
$connectid = mysql_connect($Servidor, $usuario, $clave);
mysql_select_db($bbdd);
*/

require_once('bd.inc');
	$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

	if($conexion->connect_error){

		die("Por el momento no se puede acceder al gestor de la BD");

	}

//sentencia SQL para acceder a los últimos 20 artículos publicados
$ssql = "select nombreConcurso,fechaDeInicio from concurso limit 10";
$result = $conexion -> query($ssql);

	//Convierto el resultado de mi consulta a un arreglo
	if($result -> num_rows >= 1){
		//Por cada fila obtengo un arreglo
		while($fila = $result -> fetch_assoc())
			$datos[] = $fila;
	}

//Cabeceras del RSS
echo '<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd">';
//Datos generales del Canal. Edítalos conforme a tus necesidades
echo "<channel>\n";
echo "<title>Novedades de Proyecto-Concursos</title>";
echo "<link>http://alanturing.cucei.udg.mx/equipo-alpha</link>";
echo "<description>Canal RSS para la página del proyecto</description>";
echo "<language>es-es</language>";
echo "<copyright>Equipo-Alpha</copyright>\n";

//para cada registro encontrado en la base de datos
//tengo que crear la entrada RSS en un item
for($i=0; $i<count($datos); $i++)
{
   //elimino caracteres extraños en campos susceptibles de tenerlos
   $nombreConcurso=clrAll($datos[$i]["nombreConcurso"]);         
   $fechaDeInicio=clrAll($datos[$i]["fechaDeInicio"]);

   echo "<item>\n";
   echo "<title>$nombreConcurso</title>\n";
   echo "<pubDate>$fechaDeInicio</pubDate>\n";
   echo "</item>\n";
}

//cierro las etiquetas del XML
echo "</channel>";
echo "</rss>";

?>
