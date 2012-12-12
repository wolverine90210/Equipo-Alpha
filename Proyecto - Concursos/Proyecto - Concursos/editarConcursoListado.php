<?php

//Porque la maestra dijo

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
	
	//Nos conectamos a la base de datos y obtenemos el usuario
	require_once('php/bd.inc');
	$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

	if($conexion->connect_error){

		die("Por el momento no se puede acceder al gestor de la BD");

	}
	
	$query = "select arrobaUsuario from usuario where idUsuario='$usuarioOrganizador'";
	
	$resultado = $conexion -> query($query);
	
	if($resultado -> num_rows == 1){

	while($filaUser = $resultado -> fetch_assoc())
			$datosCreador[] = $filaUser;
	
	}

	$creador = $datosCreador[0]["arrobaUsuario"];
	
	
	
	$query = "select nom_Categoria from categoria where idCategoria='$categoria'";
	
	$resultadoCat = $conexion -> query($query);
	
	if($resultadoCat -> num_rows == 1){

	while($filaCat = $resultadoCat -> fetch_assoc())
			$datosCat[] = $filaCat;
	
	}

	$catego = $datosCat[0]["nom_Categoria"];

//Borrar los datos para que no esten en la sesión
unset($_SESSION["datos"]);

?>
<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta name="description" content="Index - Maquetado Vista de Blog" />
	<meta name="keywords" content="Concursos, programacion, enviar, categoria" />
	<meta name="author" content="Equipo Alpha" />
	<link href="css/general.css" type="text/css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
	<script src="jquery/jquery-1.7.2.min.js" type="text/javascript" ></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	
	<script src="jquery/jquery.effects.core.js" type="text/javascript" ></script>
	
	<script type="text/javascript" src="js/adminConcursosJS.js"></script>
	
	<script type="text/javascript" >
			 $(document).ready(function(e) {
				$('#site-name h1').show('fast')
			$('#menu-r li a').hover(function(){$(this).stop(false,true).animate({'color':'#F33'},500)},function(){$(this).stop
			(false,true).animate({'color':'#FFF'},200)});	
			});
		
	</script>	
	
	
	<!-- Script Javascript que invoca el plugin jQuery para hacer que el campo de texto se convierta en un calendario.  -->
	
	<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
    <link type="text/css" href="css/ui-darkness/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
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
			$("#datepicker3").datepicker({
				changeMonth : true,
				changeYear : true,
				onSelect : function(dateText, inst) {
				}
			});

		});
	});
		</script>
	
	<!-- Para el Cross-Browser Rich Text Editor -->
	
	<script  type="text/javascript" src="cbrte/html2xhtml.min.js"></script>
	<script  type="text/javascript" src="cbrte/richtext_compressed.js"></script>
	
	<!-- Para el select2 3.2 -->
	
	<script src="js/select2.js"></script>
    	<script src="js/select2.min.js"></script>
	
	<link href="css/select2.css" rel="stylesheet"/>
	
	<!-- AJAX -->
	<script type="text/Javascript" src="js/ajax.js"></script>
	

	
	<title>Edidición de concurso</title>		
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
	   
	<h1>Edición de concurso</h1>
	
	</header>
	
	
	<article class="articulo">
		<div class="cont"><a class="boton1" href="agregarConcurso.php"><span>enviar</span></a></div>
		
		<form method="GET" action="php/mostrarConcursosCancelados.php" style="float:right;">
		<input type="submit" value="Listar concursos cancelados" class="button" style="font-size:1.2em;"/>
		</form>
		<form method="GET" action="php/mostrarConcursosSinAceptar.php" style="float:right;">
		<input type="submit" value="Listar concursos sin aceptar" class="button" style="font-size:1.2em;"/>
		</form>
		
		<div class="clear"></div><br />
		
		<section class="seccion">
			
			
			
			<div id="div_r"></div>
			
			<!-- Edición de concursos -->
			
			<div id="edicion">
			
				<form name="form_edit" method="GET" action="php/editarConcurso.php">
				<fieldset>
				<legend><strong>Editar concurso</strong></legend><br />
				
				<label for="user">Enviado por: </label>
				<input type="text" id="user" name="user" value="<?= $creador; ?>" disabled/>
				
				<br /><br />
				
				<label for="nombre">Nombre del concurso: </label>
				<input type="text" id="inNombre" name="inNombre" value="<?= $nombreConcurso ?>" required />
				
				<div id="error_nombre" class="div_error">
					<p>¡Introduzca un nombre para el concurso y que sea válido (entre 5 y 20 caracteres)!</p>
				</div>
				
				<br /><br />
				
				<label for="field_hashtag">Hashtag para Twitter: </label>
				<input type="text" id="field_hashtag" name="field_hashtag" value="<?= $hashtag ?>" required />
				
				<div id="error_hashtag" class="div_error">
				<p>¡Introduzca un hashtag del concurso para Twitter y que sea válido (entre 5 y 20 caracteres)! Comienza con '#'.</p>
				</div>
				
				<br /><br /><br />
				
				<label for="categoria">Categoría: </label>
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
				&nbsp &nbsp &nbsp &nbsp
				<div style="float:right">
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
				
				<br /><br /><br /><br />
				
				<label for="diff">Dificultad: </label><br /><br />
				<div id="radios">
					<?php if($dificultad == '1'): ?>
					<input type="radio" id="radio-1-1" name="dificultad" value="Basica" class="regular-radio" checked />
					<label for="radio-1-1"> </label><label class="labelRadios"> Básica</label>
					<br />
					<input type="radio" id="radio-1-2" name="dificultad" value="Intermedia" class="regular-radio" />
					<label for="radio-1-2"> </label><label class="labelRadios"> Intermedia</label>
					<br />
					<input type="radio" id="radio-1-3" name="dificultad" value="Alta" class="regular-radio" />
					<label for="radio-1-3"> </label><label class="labelRadios"> Alta</label>
					<?php elseif($dificultad == '2'): ?>
					<input type="radio" id="radio-1-1" name="dificultad" value="Basica" class="regular-radio" />
					<label for="radio-1-1"> </label><label class="labelRadios"> Básica</label>
					<br />
					<input type="radio" id="radio-1-2" name="dificultad" value="Intermedia" class="regular-radio" checked />
					<label for="radio-1-2"> </label><label class="labelRadios"> Intermedia</label>
					<br />
					<input type="radio" id="radio-1-3" name="dificultad" value="Alta" class="regular-radio" />
					<label for="radio-1-3"> </label><label class="labelRadios"> Alta</label>
					<?php elseif($dificultad == '3'): ?>
					<input type="radio" id="radio-1-1" name="dificultad" value="Basica" class="regular-radio" />
					<label for="radio-1-1"> </label><label class="labelRadios"> Básica</label>
					<br />
					<input type="radio" id="radio-1-2" name="dificultad" value="Intermedia" class="regular-radio" />
					<label for="radio-1-2"> </label><label class="labelRadios"> Intermedia</label>
					<br />
					<input type="radio" id="radio-1-3" name="dificultad" value="Alta" class="regular-radio" checked />
					<label for="radio-1-3"> </label><label class="labelRadios"> Alta</label>
					<?php endif; ?>
					<br />
				</div>
				
				<div id="error_dificultad" class="div_error">
					<p>¡Seleccione una dificultad para el concurso!</p>
				</div>
				
				<br /><br /><br />
				
				<label for="images">Imagen(es) del concurso: </label>
				<div id="images"></div>
				
				<br /><br />
				
				<label for="imagen1">Subir imagen(es): </label><br /><br / >
				<input type="file" id="imagen1" name="file[]" accept="image/*" required/>
				
				<div id="error_imagen" class="div_error">
					<p>¡Seleccione una imagen de sus archivos para el concurso! El archivo debe ser una imagen.</p>
				</div>
				
				<br /><br />				
				
				<label for="botra_img" id="lotra">Otra imagen: </label>
				<input type="button" id="botra_img" name="botra_img" value="Otra imagen" onClick="otherImage()"/>
				
				<div id="error_otraimg" class="div_error">
					<p>¡Seleccione otra(s) imagen(es) de sus archivos para el concurso! El archivo debe ser una imagen.</p>
				</div>
				
				<br /><br />							
				
				<br /><br />
				<!--
				<label for="content_area">Contenido: </label>
				<textarea id="content_area" name="content_area" rows="20" cols="100" maxlength="10000"></textarea>
				-->
								
				<input type="hidden" id="dataEdit" name="dataEdit" />
				
				
				
				<label for="datepicker" >Fecha de inicio: </label>
				<input type="text" id="datepicker" name="fini" class="campofecha" size="12" value="<?= $fechaInicio ?>" required>
				
				&nbsp &nbsp &nbsp &nbsp
				
				<label for="datepicker2" >Fecha de finalización: </label>
				<input type="text" id="datepicker2" name="ffinal" class="campofecha" size="12" value="<?= $fechaFin ?>" required>
				
				<br /><br /><br />
					
				<label for="datepicker3" >Fecha de creación: </label>
				<input type="text" id="datepicker3" name="fcreacion" size="12" value="<?= $fechaAlta ?>" required />
				
				
				<div id="error_fechas" class="div_error">
					<p>¡Seleccione las fechas que se piden!</p>
				</div>
			
				<div id="error_fechaAct" class="div_error">
					<p>¡La fecha de inicio debe ser mayor o igual a la fecha actual!</p>
				</div>
				
				<div id="error_fechasIF" class="div_error">
					<p>¡La fecha de finalización debe ser mayor a la fecha de inicio!</p>
				</div>
				
				<div id="error_fechasIC" class="div_error">
					<p>¡La fecha de inicio debe ser mayor a la fecha de creación!</p>
				</div>
				
				
							
				</form>
				
				<br /><br /><br /><br />
				
				<!-- RTE -->
				<form name="RTEDemo" id="RTEDemo" method="POST" onsubmit="return submitForm();">
				
				<script  type="text/javascript">
					function submitForm() {
						//make sure hidden and iframe values are in sync for all rtes before submitting form
						updateRTEs();
						var datosEditor = document.RTEDemo.rte1.value;
						document.getElementById('dataEdit').value = datosEditor;
						
						$('#edit-done').fadeIn("slow").fadeOut(2000);
						
						//document.RTEDemo.style.display = 'none';
						/******/

					
					/******/
						//document.getElementById('descConcurso').value = datosEditor;
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
					rte1.html = "<?= $descripcion; ?>";
					//document.getElementById("dataEdit").value = rte1.html;
					//rte1.toggleSrc = false;
					//document.write("<input type='hidden' id='richContent' name='richContent' / >");
					//document.write("<script type='text/javascript'>document.getElementById('richContent').value = rte1.html" + "</" + "script>");
						
		
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
				
				<div style="margin-top: 1em;">
					<label for="guardarRTE">Debe guardar cambios en la descripción: </label>
					<input type="submit" name="guardarRTE" value="Guardar" /> 
				</div>
				
				<div id="done-icon"><img id="edit-done" src="images/done-icon.png" alt="Hecho!" style="display: none;"/></div>
				
				
				<div id="error_contenido" class="div_error">
					<p>Debe escribir una descripción para el concurso y guardar los cambios.</p>
				</div>
				
				
			</form>
			
			
			
			<br /><br />
			<input class="button" type="button" id="bCancelEdit" name="bCancelEdit" value="Cancelar" onClick="cancelEdit2()" />
			<input class="button" type="button" id="bEdit" name="bEdit" value="Aceptar" onClick="makeChanges2()" />
			
			
			
			</fieldset>
			
			</div>
			
			<div id="div_editado" class="div_mensaje">
				<p class="msg">¡Concurso editado correctamente!</p>
				<img src="images/edit.png" alt="edit_icon" />
			</div>
			
			<br />

		</section>
		<div class="sombra_seccion"></div>
		
	</article>
	<div class="clear"></div>
	
	
	
	<footer id="paginacion">
		
			<?php
				include('php/secciones/antSig.html');
			?>
		<div class="clear"></div>
		
	</footer>
	
</body>

</html>
