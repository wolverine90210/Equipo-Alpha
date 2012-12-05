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
	<script type="text/javascript" src='js/altaConcursoJS.js'></script>
	<link href="css/general.css" type="text/css" rel="stylesheet" />
	<link href="css/estiloAltaConcurso.css" type="text/css" rel="stylesheet" />
	<link href="css/select2.css" type="text/css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
	<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
	<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
    	<link type="text/css" href="css/ui-darkness/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
    	<script src="js/select2.js"></script>
    	<script src="js/select2.min.js"></script>
    	<script src="jquery/jquery.effects.core.js" type="text/javascript" ></script> 
    	<script  type="text/javascript" src="cbrte/html2xhtml.min.js"></script>
	<script  type="text/javascript" src="cbrte/richtext_compressed.js"></script>
	<script type="text/javascript" src="js/jquery.purr.js"></script>
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
		$('.show-example').click( function (){
						var notice = '<div class="notice">'
								  + '<div class="notice-body">' 
									  + '<img src="images/purr-example/info.png" alt="" />'
									  + '<h3>Purr Example</h3>'
									  + '<p>This a normal Purr. It will fade out on its own.</p>'
								  + '</div>'
								  + '<div class="notice-bottom">'
								  + '</div>'
							  + '</div>';
							  
						$( notice ).purr(
							{
								usingTransparentPNG: true
							}
						);
						 
						return false;
						
					}
				);
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
		<script> function dameFecha(){ return new Date();}</script>
</head>

<body id="container">
	<header id="header">
		<div id="site-name2">
			<h1>Agregar Concurso</h1>
		</div>
	    <nav id="menu-r">
			<ul>
				<li class="boton"><a href="index.html" target="_self">Inicio</a></li>
				<li class="boton"><a href="calendario.html" target="_self">Calendario</a></li>
				<li class="boton"><a href="404.shtml" target="_self">RSS</a></li>
			</ul>
	    </nav>
	</header>
	<article class="articulo">
		<section class="seccion">
			<form name="addConcurso"  action="php/concursoAgregar.php" method="post" enctype="multipart/form-data">			
			<div id="nombre-concurso">
					<label class="div_error" id="adv_nombre" style="display: none">Escriba un nombre para el concurso(min 5 carac.)</label>
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
			<div id="categoriaWrapper">
				<label class="div_error" id="adv_categoria" style="display: none">Seleccione una categoría</label>
				<label  class="subtitulos" id="categoria">Seleccione una categoría</label>
				
				<select id="e1" selected="selected" name="categoria[]">
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
 				
			</div>
			
			</section>
			
			<div style="clear:both;height:50px;"> </div>
			
		    <p class = "titulos">Este concurso es organizado por: </p>
		    <div class="organizadorConcurso">
		    	<div id="imgAroba"><img  src="http://lorempixel.com/120/120" alt="Poster"/></div>
		    	
<!-- checar con el loguin de TWITTER  -->
		    	<a href="http://www.google.com" id="aroba" name="organizador">@levhita</a> 
		    	<input  type="text"  id="organizador" name ="organizador" value="@levhita" style="display:none"/>
		    	 
		    	<div style="clear:both"> </div>
		    </div>"
		    
			<div style="clear:both"> </div>	
			
			<p class="titulos">Agregar imagen(es)</p>
			<label class="div_error" id="adv_imagen1" style="display: none">Suba una archivo de imagen</label>
			<fieldset id="campoField">
				<label class="subtitulos" for="imagen">IMAGEN&nbsp;</label>
				<input id="imagenUp1"  type="file" name="file[]" accept="image/*" required="required" />
				<input type="button" id="img1" value="Agregar +" onclick="crearCampos(this)" />
			</fieldset>
		
			
			
			<!-- Aqui pongo el valor del RTE para mandarlo por post -->
			<input  type="text"  id="valorRTE" name ="descripcion" value="" style="display:none" />
			
			<button type="submit" value="enviar" hidden="hidden" class="show-example">Enviar</button>
			</form>
			
			<p class="titulos">Agregue una descripción para el concurso</p>
			<p id="tit-proposito"class="subtitulos" style="text-align: center">(de que se va a tratar)</p>
			<label class="div_error" id="adv_rteEditor" style="display: none">Ingrese una descripción para el concurso</label>
			<div id="richText">
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
			<label>No olvide guardar los cambios y enviar</label>
			<input class="botonGuardar" type="submit" name="submit"  value="Guardar" />
			<br />
			<a class="botonSubmit" id="botonSubmit" class="show-example" style="display:none"onclick="valida_envia()"> </a>
			
		</form>
	  </div>	
	<div style="clear:both"> </div>	
	</section>
	<div class="sombra_seccion"> </div>
	</article>
	<footer > 
		
	</footer>
</body>
</html>