<?php

	session_start();
	
	//var_dump($_SESSION["datos"]);

	//Obtener los datos
	$idConcurso = $_SESSION["datos"]["idConcurso"];
	$nombreConcurso = $_SESSION["datos"]["nombreConcurso"];
	$hashtag = $_SESSION["datos"]["hashtag"];
	$dificultad = $_SESSION["datos"]["dificultad"];
	$categoria = $_SESSION["datos"]["categoria"];
	$fechaAlta = $_SESSION["datos"]["fechaDeAlta"];
	$fechaInicio = $_SESSION["datos"]["fechaDeInicio"];
	$descripcion = $_SESSION["datos"]["descripcion"];
	$fechaFin = $_SESSION["datos"]["fechaDeFin"];
	$status = $_SESSION["datos"]["status"];
	$motivos = $_SESSION["datos"]["motivos"];
	$usuarioGanador = $_SESSION["datos"]["usuarioGanador"];
	$usuarioOrganizador = $_SESSION["datos"]["usuarioOrganizador"];
	//echo $usuarioOrganizador;
	require("php/funciones.php");
	$organizador = buscarPorIdOrganizador($usuarioOrganizador);
	//echo $usuarioOrganizador = $organizador["arrobaUsuario"];

	//Borrar los datos para que no esten en la sesi�n
	unset($_SESSION["datos"]);
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta name="description" content="Index - Maquetado Vista de Blog" />
	<meta name="keywords" content="Concursos, programacion, enviar, categoria" />
	<meta name="author" content="Equipo Alpha" />
	<link rel="SHORTCUT ICON" href="favicon.ico" />
	<link rel="icon" href="hackergarage_32.png" sizes="32x32">
	<link rel="icon" media="screen" type="image/png" href="hackergarage_16.png">
	<link rel="icon" href="hackergarage_48.png" sizes="48x48">
	<title>Concursos de Programación</title>
	<script type="text/javascript" src='js/altaConcursoJS.js'></script>
	<link href="css/general.css" type="text/css" rel="stylesheet" />
	<link href="css/estiloAltaConcurso.css" type="text/css" rel="stylesheet" />
	<link href="css/estiloTablaImagenes.css" type="text/css" rel="stylesheet" />
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
			dayNames : ['Domingo', 'Lunes', 'Martes', 'Mi�rcoles', 'Jueves', 'Viernes', 'S�bado'],
			dayNamesShort : ['Dom', 'Lun', 'Mar', 'Mi�', 'Juv', 'Vie', 'S�b'],
			dayNamesMin : ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S�'],
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
		
		<!-- AJAX -->
		<script type="text/Javascript" src="js/ajax.js"></script>
		
		<noscript>Tu navegador no soporta Javascript</noscript>	
		<script> function dameFecha(){ return new Date();}</script>
</head>

<body id="container">
	<header id="header">
		<header id="header">	
	  	
	  	<a id="loginButton" class="btn-auth btn-twitter" style="float:right; margin-top: 38px; margin-left: 10px;" 
	  	href="loginWithTwitter.php?authenticate=1">
		    Iniciar sesión con <b>Twitter</b>
		</a>
	
		<script type="text/javascript">$('#loginButton').hide();</script> 
	   
		<?php
		include('php/secciones/signIn.php');
		?>
	
		<div id="site-name">
			<h1 style="display:none; ">Concursos</h1>
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
	<article class="articulo">
		<section class="seccion">
			<form name="addConcurso" method="post" action="php/concursoAgregar.php">			
			<div id="nombre-concurso">
					<label class="div_error" id="adv_nombre" style="display: none">Escriba un nombre para el concurso(min 5 carac.)</label>
			      	<a class="subtitulos" id="TituloConcurso">Nombre del Concurso:</a>
<input  type="text"  id="nombreConcurso" value="<?= $nombreConcurso; ?>" name="nombreConcurso" />
			</div>
			<div id='hashtagDiv'>
					<label class="div_error" id="adv_hashtag" style="display: none">Teclee un hashtag para Twitter(#mihashtag)</label>
					<label id="hashtagLabel">hashtag:</label>
					<input  type="text" id="hashTwitter" value="<?= $hashtag; ?>" name="hashtagTwitter" placeholder="#nombreConcurso"onfocus="this.value='';"/>
			</div>
			<section id="datosBasicos"> 
			<div id="radiosWrapper">
				<label class="div_error" id="adv_radio" style="display: none">No se ha seleccionado dificultad</label>
				<label class="subtitulos" id="dificultad">Seleccione un nivel de dificultad</label>
				
				<div id="radios"class="button-holder">
				
				<?php if(strcmp($dificultad, "1") == 0) { ?>
				<input type="radio" id="radio-1-1" checked="checked" value = "1" name="dificultad" class="regular-radio" />
					<label for="radio-1-1"> </label><label class="labelRadios">Básica</label>
					<br />
					<input type="radio" id="radio-1-2"  name="dificultad" class="regular-radio" />
					<label for="radio-1-2"> </label><label class="labelRadios">Intermedia</label>
					<br />
					<input type="radio" id="radio-1-3"  name="dificultad" class="regular-radio" />
					<label for="radio-1-3"> </label><label class="labelRadios">Alta</label>
					<br />
				<?php } else if($dificultad == "2" ) { ?>
				<input type="radio" id="radio-1-1"  name="dificultad" class="regular-radio" />
					<label for="radio-1-1"> </label><label class="labelRadios">Básica</label>
					<br />
				<input type="radio" id="radio-1-2" checked="checked" value = "2" name="dificultad" class="regular-radio" />
					<label for="radio-1-2"> </label><label class="labelRadios">Intermedia</label>
					<br />
					<input type="radio" id="radio-1-3"  name="dificultad" class="regular-radio" />
					<label for="radio-1-3"> </label><label class="labelRadios">Alta</label>
					<br />
				<?php } else { ?>
				<input type="radio" id="radio-1-1"  name="dificultad" class="regular-radio" />
					<label for="radio-1-1"> </label><label class="labelRadios">Básica</label>
					<br />
					<input type="radio" id="radio-1-2"  name="dificultad" class="regular-radio" />
					<label for="radio-1-2"> </label><label class="labelRadios">Intermedia</label>
					<br />
				<input type="radio" id="radio-1-3" checked="checked" name="dificultad" value = "3"  class="regular-radio" />
					<label for="radio-1-3"> </label><label class="labelRadios">Alta</label>
					<br />
				<? } ?>
					
				</div>
			</div>
			
			<!-- PARA AGREGAR UNA CATEGORÍA SOLO SI SE ES ADMINISTRADOR -->
			
			<?php if ($_SESSION['access_token']['id'] == 960498032 || $_SESSION['access_token']['id'] == 984327331 || $_SESSION['access_token']['id'] == 302412674 || $_SESSION['access_token']['id'] == 199881655) : ?>
				<label class="div_error" id="adv_categoria" style="display: none">Seleccione una categoría</label>			
				<!-- CATEGORÍAS -->
				<label for="categoria">Categoría: </label>
					<div id="categoria" style="display:inline">
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
				
				<select id="e1" name="categoria[]">
				<option value="SeleccioneUna">Seleccione una</option>
				
				<?php
				//Cargar el archivo de funciones
				require_once("php/funciones.php");
				$categorias = buscarCategorias();
				$fila = $categorias[0];
				foreach($categorias as $fila => $arr){
					//Todos los campos de cada fila
				    foreach($arr as $campo => $valor){
					if($campo == 'idCategoria'){
						
					if(strcmp($valor, $categoria) == 0)
						$cad1 = "<option value=".$valor." selected=selected>"; 
					
					else
					$cad1 = "<option value=".$valor.">"; 
					
					}
					
					else if($campo == 'nom_Categoria')
					echo $cad1.$valor.'</option>';
					}
				     }
				?>
				</select>
	
        				
			</div>
			
			<?php endif; ?>
			
			<div id="fechaInicial">
				<label class="div_error" id="adv_fechaInicio" style="display: none">Seleccione un fecha</label>
				<label class="div_error" id="adv_fechaInicioMal" style="display: none">Inserta una fecha de inicio a partir del dia de mañana</label>
				<p class="subtitulos">Fecha Inicio:</p>	
<input type="text" id="datepicker" value="<?= date('d-m-Y', strtotime($fechaInicio)); ?>" name="fechaInicio" class="calendario">
 				<p class="subtitulos">Fecha Fin:</p>
				<label class="div_error" id="adv_fechaFin" style="display: none">Seleccione un fecha</label>
				<label class="div_error" id="adv_fechaFinMal" style="display: none">Inserta una fecha de fin partir del dia de mañana</label>				
<input type="text" id="datepicker2" value="<?= date('d-m-Y', strtotime($fechaFin));?>" name="fechaFin" class="calendario">

 				<!--Fecha de creacion hidden -->
 				<input type="text" id="datepicker3" style="display:none" name="fechaAlta">
			</div>
			
			</section>
			
			<div style="clear:both;height:50px;"> </div>
			
		    <p class = "titulos">Este concurso es organizado por: </p>
		    <div class="organizadorConcurso">
		    	<?php 
					$arrobaUsuario = dameArrobaDeUsuario($usuarioOrganizador);
					$avatar = dameAvatarDeUsuario($usuarioOrganizador);
				
				?>
		    	<div id="imgAroba"><img  src="<?=$avatar?>" alt="Poster" width="120" height="120" /></div>
		    	
					    	
		    	<a href="" id="aroba" name ="organizador"><?= $arrobaUsuario; ?></a> 
			<!--  para llevarme el id del concurso por POST -->
				<input  type="hidden"  id="idConcurso" name ="idConcurso" value="<?= $idConcurso; ?>"/>
		    	<input  type="hidden"  id="organizador" name ="organizador" value="<?= $usuarioOrganizador; ?>"/>
 				<!-- Aqui pongo el valor del RTE para mandarlo por post -->
					<input  type="hidden"  id="valorRTE" name ="descripcion" style="display:none" />
		    	<div style="clear:both"> </div>
		    </div>
		    
			<div style="clear:both"> </div>	
			
			
			
			</form>
						
			<!--listar todas la imagenes Ponerlas en una tabla-->

				
			<!-- termina el listar todas las imagenes subidas al servidor
			
<!-- MODULO DE IMAGENES-->	
<table id="tablaDeRutas"  width="100%" border="1">
						<caption style="color:#FFFFFF">Imágenes agregadas</caption>
						<tr>
							<th>Ruta</th>
						</tr>
						<?php $misUrls = dameUrlsDeImagenesSubidas($idConcurso);

				foreach ($misUrls as $fila => $arr) {
					foreach ($arr as $campo => $valor) {
						$findme   = 'php';
						$pos = strpos($valor, $findme);
						$valorUrl = substr($valor, $pos,strlen($valor));
						echo $valorUrl;
						/*echo "<tr class=\"even\"><td>
						$valor
						</td> </tr>
						";*/
					}

				}
			?>
			</table>
			<p class="titulos">Agregar imagen(es)</p>
			<label class="div_error" id="adv_imagen1" style="display: none">Suba una archivo de imagen</label>
			<form action="php/imagenesAgregar.php" method="post" enctype="multipart/form-data"> 
				<fieldset id="campoField" style="width:50">
					<label class="subtitulos" for="imagen">IMAGEN&nbsp;</label>
					<input id="imagenUp1"  type="file" name="file[]" accept="image/*" required="required" />
					<input type="button" id="img1" value="Agregar +" onclick="crearCampos(this)" />
					<button type="submit" class="botonSimg">Subir imágenes</button> 
				</fieldset>
			</form>
			
			<br />

			<div style="clear:both"> </div>
			
			
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
					rte1.html = '<?= $descripcion; ?>';
		
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
		
			
			
</body>
</html>

