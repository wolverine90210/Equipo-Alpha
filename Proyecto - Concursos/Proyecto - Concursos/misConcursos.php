<?php 
/**
 * 
 * 
 * 
 * 
 */
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta name="description" content="Index - Maquetado Vista de Blog" />
	<meta name="keywords" content="Concursos, programacion, enviar, categoria" />
	<meta name="author" content="Equipo Alpha" />
	<title>Concursos de Programación</title>
	<link rel="icon" href="hackergarage_32.png" sizes="32x32">
	<link rel="icon" media="screen" type="image/png" href="hackergarage_16.png">
	<link rel="icon" href="hackergarage_48.png" sizes="48x48">
	<script type="text/javascript" src='js/altaConcursoJS.js'></script>
	<link href="css/general.css" type="text/css" rel="stylesheet" />
	<link href="css/estiloAltaConcurso.css" type="text/css" rel="stylesheet" />
	<link href="css/select2.css" type="text/css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
    <link type="text/css" href="css/ui-darkness/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
    <script src="js/select2.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="jquery/jquery.effects.core.js" type="text/javascript" ></script> 
    <script  type="text/javascript" src="cbrte/html2xhtml.min.js"></script>
	<script  type="text/javascript" src="cbrte/richtext_compressed.js"></script>
 	<script type="text/javascript" >
	 jQuery(function($) {
		$.datepicker.regional['es'] = {
			closeText : 'Cerrar',
			prevText : 'Anterior',
			nextText : 'Siguiente',
			currentText : 'Hoy',
			monthNames : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			monthNamesShort : ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
			dayNames : ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			dayNamesShort : ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
			dayNamesMin : ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
			weekHeader : 'Sm',
			dateFormat : 'dd-mm-yy',
			firstDay : 1,
			numberOfMonths : 1,
			isRTL : false,
			yearSuffix : ''
		};
		$.datepicker.setDefaults($.datepicker.regional['es']);
	});
	$(document).ready(function(e) {
		$("#e1").select2();
		$(function() {
			$("#datepicker").datepicker({
				changeMonth : true,
				changeYear : true,
				onSelect : function(dateText, inst) {
					var lockDate = new Date($('#txtStartDate').datepicker('getDate'));
					lockDate.setDate(lockDate.getDate() + 1);
					
					
				}
			});
			$("#datepicker2").datepicker({
				changeMonth : true,
				changeYear : true,
				onSelect : function(dateText, inst) {
				}
			});

		});
	});
		</script>
		
		<noscript>Tu navegador no soporta Javascript</noscript>
		<title>Mis concursos</title>	
</head>

<body id="container">
	<header id="header">
		<div id="site-name">
	   				<h1>Concursos</h1>
   				</div>
  
  				 <nav id="menu-r">
				<?php
						include('php/secciones/menu.html');
				?>
					
	   			</nav>
	</header>
	<article class="articulo">
		<section class="seccion">
			<form name="addConcurso" method="get" action="php/concursoAgregar.php">	
			<h2>Seleccione uno o más criterios de búsqueda</h2>		
			<section id="datosBasicos"> 
			
			<div id="radiosWrapper">
				<label class="div_error" id="adv_radio" style="display: none">No se ha seleccionado dificultad</label>
				<label class="subtitulos" id="dificultad">Seleccione un nivel de dificultad</label>
				<div id="radios"class="button-holder">
					<input type="radio" id="radio-1-1" name="dificultad" value="1" class="regular-radio" onClick="buscarConcursosPorDificultad(1)"/>
					<label for="radio-1-1"> </label><label class="labelRadios">Básica</label>
					<br />
					<input type="radio" id="radio-1-2" name="dificultad" value="2" class="regular-radio" onClick="buscarConcursosPorDificultad(2)"/>
					<label for="radio-1-2"> </label><label class="labelRadios">Intermedia</label>
					<br />
					<input type="radio" id="radio-1-3" name="dificultad" value="3"class="regular-radio" onClick="buscarConcursosPorDificultad(3)"/>
					<label for="radio-1-3"> </label><label class="labelRadios">Alta</label>
					<br />
				</div>
			</div>
			<div id="categoriaWrapper">
				<label class="div_error" id="adv_categoria" style="display: none">Seleccione una categoría</label>
				<label  class="subtitulos" id="categoria">Seleccione una categoría</label>
				
				<select id="e1"  name="categoria[]"  onChange="buscarConcursosPorCategoria()">
				<option value="SeleccioneUna">Seleccione una</option>
				
				<?php
				//Cargar el archivo de funciones
				require_once("php/funciones.php");
				$categorias = buscarCategorias();
				$fila = $categorias[0];
				foreach($categorias as $fila => $arr){
					//Todos los campos de cada fila
				    foreach($arr as $campo => $valor){
					if($campo == 'idCategoria')
					$cad1 = "<option value=".$valor.">";
					else if($campo == 'nom_Categoria')
					echo $cad1.$valor.'</option>';
					}
				     }
				?>
				</select>
			</div>
			
			<div id="fechaInicial">
				<label class="div_error" id="adv_fechaInicio" style="display: none">Seleccione un fecha</label>
				<label class="div_error" id="adv_fechaInicioMal" style="display: none">Inserta una fecha de inicio a partir del dia de mañana</label>
				<p class="subtitulos">Fecha Inicio:</p>	
    				<input type="text" id="datepicker" name="fechaInicio" class="calendario">
 				<p class="subtitulos">Fecha Fin:</p>
				<label class="div_error" id="adv_fechaFin" style="display: none">Seleccione un fecha</label>
				<label class="div_error" id="adv_fechaFinMal" style="display: none">Inserta una fecha de fin partir del dia de mañana</label>				
 				<input type="text" id="datepicker2" name="fechaFin" class="calendario">
 				<!--Fecha de creacion hidden -->
 				<input type="text" id="datepicker3" style="display:none" name="fechaAlta">
 				<a class="botonSubmit" id="botonSubmit" class="show-example" onclick="buscarConcursosPorFechas()"> </a>
			</div>
	<!-- Entonces en cuanto a status del concurso: 1 para pendiente, 2 para aceptado y 3 para cancelado :B -->
			<label  class="subtitulos" id="sta">Seleccione un status</label><br />
			<select name="statusConcurso" id="statusConcurso" onChange="buscarConcursosPorStatus()">
				<option value="0">Selecciona...</option>
				<option value="1">Pendiente</option>
				<option value="2">Aceptado</option>
				<option value="3">Rechazado</option>
			</select>
			
			</section>
			
			<div style="clear:both;height:50px;"> </div>
			

		    
			<div style="clear:both"> </div>	
				
			<button type="submit" value="enviar" style="display:none" class="show-example">Enviar</button>
			</form>

	  </div>	
	<div style="clear:both"> </div>	
	</section>
	<section class="seccion">
		<div id="extra"></div>

</section>
	<div class="sombra_seccion"> </div>
	</article>
	<footer > 
		
	</footer>
</body>
</html>