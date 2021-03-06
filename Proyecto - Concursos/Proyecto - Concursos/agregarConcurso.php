﻿<?php @session_start();?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<meta name="description" content="Index - Maquetado Vista de Blog" />
	<meta name="keywords" content="Concursos, programacion, enviar, categoria" />
	<meta name="author" content="Equipo Alpha" />
	<title>Concursos de Programación</title>
	<script type="text/javascript" src='js/altaConcursoJS.js'></script>
	<link href="css/general.css" type="text/css" rel="stylesheet" />
	<link href="css/estiloAltaConcurso.css" type="text/css" rel="stylesheet" />
	<link href="css/estiloTablaImagenes.css" type="text/css" rel="stylesheet" />
	<link href="css/select2.css" type="text/css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
	<link rel="icon" href="hackergarage_32.png" sizes="32x32">
	<link rel="icon" media="screen" type="image/png" href="hackergarage_16.png">
	<link rel="icon" href="hackergarage_48.png" sizes="48x48">
	<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
	<link type="text/css" href="css/ui-darkness/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
	<script src="js/select2.js"></script>
	<script src="js/select2.min.js"></script>
	<script src="jquery/jquery.effects.core.js" type="text/javascript" ></script> 
	<script type="text/javascript" src="cbrte/html2xhtml.min.js"></script>
	<script type="text/javascript" src="cbrte/richtext_compressed.js"></script>
    <script src="js/jquery.form.js"></script> 
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
		
		//para la subida de imagenes con ajax
			var bar = $('.bar');
			var percent = $('.percent');
			var status = $('#linksDeTabla');
			$('form').ajaxForm({
			    beforeSend: function() {
				var percentVal = '0%';
				status.empty();
				bar.width(percentVal)
				percent.html(percentVal);
			    },
			    uploadProgress: function(event, position, total, percentComplete) {
				var percentVal = percentComplete + '%';
				bar.width(percentVal)
				percent.html(percentVal);
			    },
				complete: function(xhr) {
					//$('#status').html = (xhr.responseText);
					status.val(xhr.responseText);
					mostrarTablaDeLinks(xhr.responseText);
				}
			}); 
	});
		</script>
		
		<!-- AJAX -->
		<script type="text/Javascript" src="js/ajax.js"></script>
		
		<noscript>Tu navegador no soporta Javascript</noscript>	
		<script> function dameFecha(){ return new Date();}</script>
</head>

<body id="container">
	<header id="header">
		
		<a id="loginButton" class="btn-auth btn-twitter" style="float:right; margin-top: 38px; margin-left: 10px;" 
	  	href="loginWithTwitter.php?authenticate=1">
		    Iniciar sesión con <b>Twitter</b>
		</a>
	
		<script type="text/javascript">$('#loginButton').hide();</script> 
	   
		<?php
		include('php/secciones/signIn.php');
		?>
		
		<div id="site-name2">
			<h1 class="site-name2">Agregar Concurso</h1>
		</div>
	    <nav id="menu-r">
			<?php
						include('php/secciones/menu.html');
			?>	 
			
			<script type="text/javascript">
			$('#adminButton').hide();
			$('#accountButton').hide();
			</script>
	    </nav>
	</header>
	
	
	<?php if(isset($_SESSION['access_token']['id'])): ?>
	
	<article class="articulo">
		<section class="seccion">
		<form name="addConcurso"  action="php/concursoAgregar.php" method="post" enctype="multipart/form-data">			
			<div id="nombre-concurso">
					<label class="div_error" id="adv_nombre" style="display: none">Escriba un nombre valido para el concurso(min 5 carac. sin incluir caracteres especiales)</label>
			      	<a class="subtitulos" id="TituloConcurso">Nombre del Concurso:</a>
					<input  type="text"  id="nombreConcurso" name="nombreConcurso"/>
			</div>
			<div id='hashtagDiv'>
					<label class="div_error" id="adv_hashtag" style="display: none">Teclee un hashtag para Twitter(#mihashtag)</label>
					<label id="hashtagLabel">hashtag:</label>
					<input  type="text" id="hashTwitter" name="hashtagTwitter" placeholder="#nombreConcurso"onfocus="this.value='';"/>
			</div>
			<section id="datosBasicos"> 
			<div id="radiosWrapper">
				<label class="div_error" id="adv_radio" style="display: none">No se ha seleccionado dificultad</label>
				<label class="subtitulos" id="dificultad">Seleccione un nivel de dificultad</label>
				<div id="radios"class="button-holder">
					<input type="radio" id="radio-1-1" name="dificultad" value="1" class="regular-radio" />
					<label for="radio-1-1"> </label><label class="labelRadios">Básica</label>
					<br />
					<input type="radio" id="radio-1-2" name="dificultad" value="2" class="regular-radio" />
					<label for="radio-1-2"> </label><label class="labelRadios">Intermedia</label>
					<br />
					<input type="radio" id="radio-1-3" name="dificultad" value="3"class="regular-radio" />
					<label for="radio-1-3"> </label><label class="labelRadios">Alta</label>
					<br />
				</div>
			</div>
			
			<?php if ($_SESSION['access_token']['id'] == 960498032 || $_SESSION['access_token']['id'] == 984327331 || $_SESSION['access_token']['id'] == 302412674 || $_SESSION['access_token']['id'] == 199881655) : ?>
				<label class="div_error" id="adv_categoria" style="display: none">Seleccione una categoría</label>
				<!-- CATEGORÍAS -->
				<label for="categoria">Categoría: </label>
					<div id="catego" style="display:inline">
						<select id="sel" onChange="fillSelect()">
							<option value="select" selected>Seleccione una:</option>
							<option>CARGAR CATEGORÍAS</option>
						</select>
					</div><input type="button" value="Recargar categorías" onClick="fillSelect()">
					
				</div><br />	
				&nbsp &nbsp &nbsp &nbsp
				<div style="">
				<label for="nueva_cat">Nueva categoría: </label>
				<input type="text" id="new_cat" name="new_cat" />
				<input type="button" id="acceptCat" name="acceptCat" value="Aceptar" onClick="addCat()" />
				</div>
				
				<div id="error_categoria" class="div_error">
					<p>¡Seleccione una categoría para el concurso!</p>
				</div>
				
				<div id="error_nueva_categoria" class="div_error">
					<p>¡Escriba una categoría nueva y válida para el concurso (menor a 20 caracteres)! Procure no repetirlas. </p>
				</div>
								
				<?php elseif ($_SESSION['access_token']['id'] != 960498032 && $_SESSION['access_token']['id'] != 984327331 && $_SESSION['access_token']['id'] != 302412674 && $_SESSION['access_token']['id'] != 199881655): ?>
			
			<div id="categoriaWrapper">
				<label class="div_error" id="adv_categoria" style="display: none">Seleccione una categoría</label>
				<label  class="subtitulos" id="categoria">Seleccione una categoría</label>
				
				<select id="e1" selected="selected" name="categoria[]">
				<option value="SeleccioneUna">Seleccione una</option>
				
				<?php
				//Cargar el archivo de funciones
				require_once("php/funciones.php");
				$categorias = buscarCategorias();
				if(isset($categorias)){
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
				}else{
					
					echo '<select>
						  <option selected=selected>No hay categorías</option>
						</select>';
				}
				
				?>
				</select>
			</div>
			<?php endif; ?>
			
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
 				
			</div>
			
			</section>
			
			<div style="clear:both;height:50px;"> </div>
			
		   	<p class = "titulos">Este concurso es organizado por: </p>
		    <div class="organizadorConcurso">
			    <div id="imgAroba"><img  src = "<?=$_SESSION['access_token']['avatar']?>" alt="Poster" width="120" height="120" /></div>	
			    <a href="https://twitter.com/<?= $_SESSION['access_token']['screen_name'] ?>" target="_blank" id = "aroba" name = "organizador"  ><?= '@'.$_SESSION['access_token']['screen_name'] ?> </a> 
			    <!--Para pasarlo por post el id del usuario organizador-->
			    <input  type="hidden" id="organizador" name ="organizador" value="<?= $_SESSION['access_token']['id']; ?>"/>  
			    <div style="clear:both"> </div>
		    </div>
			
			<div style="clear:both"> </div>	
			<!--Aqui agarro la tabla de links -->
			<input  type="text" id="linksDeTabla" style="display:none" name ="linksDeTabla"  />
			
			<!-- Aqui pongo el valor del RTE para mandarlo por post -->
			<input  type="hidden"  id="valorRTE" name ="descripcion"/>
	</form>
	
		

<!-- MODULO DE IMAGENES-->	
			<p class="titulos">Agregar imagen(es)</p>
			<label class="subtitulos">Seleccione los archivos que desea subir, al final haga clic en subir imágenes 
				para obtener la ruta de donde se encuentran almacenadas.</label>
			<label class="div_error" id="adv_imagen1" style="display: none">Suba una archivo de imagen</label>
			<form action="php/imagenesAgregar.php" method="post" enctype="multipart/form-data"> 
				<fieldset id="campoField" style="margin:0 auto">
					<label class="subtitulos" for="imagen">IMAGEN&nbsp;</label>
					<input id="imagenUp1"  type="file" name="file[]" accept="image/*" required="required" />
					<input type="button" id="img1" value="Agregar +" onclick="crearCampos(this)" />
					<button type="submit" class="botonSimg">Subir imágenes</button> 
				</fieldset>
			</form>
			
			<!--Poner las url de las imagenes subidas al servidor -->
			<br />
			<div style="clear:both"> </div>
			
			<table id="tablaDeRutas"  style="display:none" width="100%" border="1">
						<caption style="color:#FFFFFF">Imágenes agregadas</caption>
						<tr>
							<th>Imagen</th>
							<th>Ruta</th>
						</tr>
			</table>
		<div style="clear:both"> </div>	
			
<!-- TERMINA MODULO DE IMAGENES-->
			
<!-- Comienza modulo de descripcion -->
		<div id="richText">
			<p class="titulos">Agregue una descripción para el concurso</p>
			<p id="tit-proposito"class="subtitulos" style="text-align: center">(de que se va a tratar)</p>
			<label class="div_error" id="adv_rteEditor" style="display: none">Ingrese una descripción para el concurso</label>
			
			<form name="RTEDemo" method="post" onsubmit="return submitForm();">
				<script  type="text/javascript">
					function submitForm() {
						//make sure hidden and iframe values are in sync for all rtes before submitting form
						updateRTEs();
						var datosEditor = document.RTEDemo.rte1.value;
						
						var botonGuardar = document.getElementById("botonSubmit");
						botonGuardar.style.display = 'block';
						//alert(document.RTEDemo.rte1.value);
						//change the following line to true to submit form
						return false;
					}
					//Usage: initRTE(imagesPath, includesPath, cssFile, genXHTML, encHTML)
					initRTE("cbrte/images/", "cbrte/", "", true);
					//-->
				 </script>
				<script  type="text/javascript">
					//build new richTextEditor
					var rte1 = new richTextEditor('rte1');
					rte1.html = '';
		
					//enable all commands 
					rte1.cmdFormatBlock = true;
					rte1.cmdFontName = true;
					rte1.cmdFontSize = true;
					rte1.cmdIncreaseFontSize = true;
					rte1.cmdDecreaseFontSize = true;
		
					rte1.cmdBold = true;
					rte1.cmdItalic = true;
					rte1.cmdUnderline = true;
					rte1.cmdStrikethrough = true;
					rte1.cmdSuperscript = true;
					rte1.cmdSubscript = true;
		
					rte1.cmdJustifyLeft = true;
					rte1.cmdJustifyCenter = true;
					rte1.cmdJustifyRight = true;
					rte1.cmdJustifyFull = true;
		
					rte1.cmdInsertHorizontalRule = true;
					rte1.cmdInsertOrderedList = true;
					rte1.cmdInsertUnorderedList = true;
		
					rte1.cmdOutdent = true;
					rte1.cmdIndent = true;
					rte1.cmdForeColor = true;
					rte1.cmdHiliteColor = true;
					rte1.cmdInsertLink = true;
					rte1.cmdInsertImage = true;
					rte1.cmdInsertSpecialChars = true;
					rte1.cmdInsertTable = true;
					rte1.cmdSpellcheck = true;
		
					rte1.cmdCut = true;
					rte1.cmdCopy = true;
					rte1.cmdPaste = true;
					rte1.cmdUndo = true;
					rte1.cmdRedo = true;
					rte1.cmdRemoveFormat = true;
					rte1.cmdUnlink = true;
		
					rte1.toggleSrc = false;
		
					rte1.build();
				</script>
				<div style="clear:both"> </div>	
			<input class="botonGuardar" type="submit" id="guardarRT" name="submit"  style="display: none"value="Guardar" />
			<br />
			<a class="botonSubmit" id="botonSubmit" onclick="valida_envia()"> </a>
		</form>
	  </div>	
	<div style="clear:both"> </div>	
	</section>
	<div class="sombra_seccion"> </div>
	</article>
	
<!--Termina modulo de descripcion -->
	<footer > 
		
	</footer>
	
	
	<?php endif; ?>
	
	<?php if(!isset($_SESSION['access_token']['id'])): ?>	
	<div class="clear"></div>
	<section class='seccion' style='text-align:center'><p><h2>NO TIENES LOS PERMISOS PARA ESTAR AQUÍ, INICIA SESIÓN PRIMERO...<h2></p></section>
		<div class='sombra_seccion'></div>
	<?php endif; ?>
		
	
	
</body>
</html>
