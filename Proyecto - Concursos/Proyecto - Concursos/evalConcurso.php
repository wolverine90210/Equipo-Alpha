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
	<link rel="SHORTCUT ICON" href="favicon.ico" />
	<script type="text/javascript" src='js/altaConcursoJS.js'></script>
	<link href="css/general.css" type="text/css" rel="stylesheet" />
	<link href="css/estiloAltaConcurso.css" type="text/css" rel="stylesheet" />
	<link href="css/estiloTabla.css" type="text/css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
	<script src="jquery/jquery-1.7.2.min.js" type="text/javascript" ></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	
	<script src="jquery/jquery.effects.core.js" type="text/javascript" ></script>
	
	<script type="text/javascript" src="js/adminConcursosJS.js"></script>


	<!-- load jQuery -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>

        <!-- load Galleria -->
        <script src="js/galleria-1.2.8.min.js"></script>
	
	<script type="text/javascript" >
			 $(document).ready(function(e) {
				$('#site-name h1').show('fast')
			$('#menu-r li a').hover(function(){$(this).stop(false,true).animate({'color':'#F33'},500)},function(){$(this).stop
			(false,true).animate({'color':'#FFF'},200)});	

			// Load the classic theme
			Galleria.loadTheme('js/galleria.classic.min.js');
	
			// Initialize Galleria
			Galleria.run('#galleria');
			});
		
	</script>	
	
	
	<!-- Script Javascript que invoca el plugin jQuery para hacer que el campo de texto se convierta en un calendario.  -->
	
	<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
    <link type="text/css" href="css/ui-darkness/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery.purr.js"></script>

	 <style>
            .content{color:#777;font:12px/1.4 "helvetica neue",arial,sans-serif;width:620px;margin:20px auto;}
            a {color:#22BCB9;text-decoration:none;}
            .cred{margin-top:20px;font-size:11px;}

            /* This rule is read by Galleria to define the gallery height: */
            #galleria{height:620px}

        </style>
	
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
	
	<!-- Para el Cross-Browser Rich Text Editor -->
	
	<script  type="text/javascript" src="cbrte/html2xhtml.min.js"></script>
	<script  type="text/javascript" src="cbrte/richtext_compressed.js"></script>
	
	<!-- Para el select2 3.2 -->
	
	<script src="js/select2.js"></script>
    	<script src="js/select2.min.js"></script>
	
	<link href="css/select2.css" rel="stylesheet"/>
	
	<!-- AJAX -->
	<script type="text/Javascript" src="js/ajax.js"></script>
	

	
	<title>Concursos de Programación</title>		
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
		
	   </nav>

	
	<h1>Administración de concursos</h1>
	
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
		
			<?php
				require_once('bd.inc');
				require_once('php/funciones.php');
				$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

				if($conexion->connect_error){

					die("Por el momento no se puede acceder al gestor de la BD");

				}
				
				$idConcurso = $_REQUEST['id'];
	
				//Limpiar variables a utilizar
				$idConcurso = $conexion -> real_escape_string($idConcurso);
	
	
				$query = "select * from concurso where idConcurso=$idConcurso";
				
				$resultado = $conexion -> query($query);
				
				if($resultado -> num_rows == 1){

					$datos = $resultado -> fetch_array(MYSQLI_ASSOC);
	
				}
	
				/* CATEGORÍAS */
				$query = "select * from categoria";
	
				$categorias = $conexion -> query($query);
	
				if($categorias -> num_rows >= 1){
					while	($filaCat = $categorias -> fetch_assoc())
						$datosCat[] = $filaCat;}
						
				/* USUARIOS */
				$query = "select * from usuario";
	
				$usuarios = $conexion -> query($query);
	
				if($usuarios -> num_rows >= 1){
					while	($filaUser = $usuarios -> fetch_assoc())
						$datosUser[] = $filaUser;}
			
			
				/* IMÁGENES */
				$query = "select * from imagenes";
	
				$imagenes = $conexion -> query($query);
	
				if($imagenes -> num_rows >= 1){
					while	($filaImg = $imagenes -> fetch_assoc())
						$datosImg[] = $filaImg;}
	
						
				echo "<div class='concurso' id='div_name'><p id='concurso_name'>".$datos['nombreConcurso']."</p></div>";
						
				for($k=0; $k<count($datosCat); $k++)
					if($datosCat[$k]['idCategoria'] == $datos['categoria'])
						$categoria = $datosCat[$k]['nom_Categoria'];
				
				for($k=0; $k<count($datosUser); $k++)
					if($datosUser[$k]['idUsuario'] == $datos['usuarioOrganizador'])
						$creador = $datosUser[$k]['arrobaUsuario'];
				
								
				if($datos['dificultad'] == 1)
					$dificultad = "B&aacutesica";
				if($datos['dificultad'] == 2)
					$dificultad = "Intermedia";
				if($datos['dificultad'] == 3)
					$dificultad = "Alta";			
			
		
				for($k=0; $k<count($datosImg); $k++)
					if($datosImg[$k]['CONCURSO_idConcurso'] == $datos['idConcurso']){
						$imagen = $datosImg[$k]['url_imagen'];
							
				$imagen = (string)$imagen;
		
				if($dbpass == "root"){		
					$numFolder = (string)$datos['idConcurso'];
					$string1 = "/var/www/Proyecto - Concursos/php/uploads/".$numFolder."/";
					$string2 = "php/uploads/".$numFolder."/";
					$imagen = str_replace($string1, $string2, $imagen);
				}
		
				$numFolder = (string)$datos['idConcurso'];
				$string1 = "/home/cc409/equipo-alpha/www/php/uploads/".$numFolder."/";
				$string2 = "http://alanturing.cucei.udg.mx/equipo-alpha/php/uploads/".$numFolder."/";
				$imagen = str_replace($string1, $string2, $imagen);
				}
				
				echo "<div class='features'><div class='spec'>Categoría: </div><div class='spec_content'>".$categoria.
				"</div> <div class='spec'> Dificultad: </div> <div class='spec_content'>".$dificultad.
				"</div><div class='spec'> Inicia: </div> <div class='spec_content'>".$datos['fechaDeInicio'].
				"</div> <div class='spec'> Termina: </div> <div class='spec_content'>".$datos['fechaDeFin'].
				"</div> </div>";
				
				echo "<a href='http://www.google.com' id='hashtag'><p id='pHash'>".$datos['hashtag']."</p></a>
				<br /><br /><br />";

		
				if(isset($imagen)){
					echo "<div id=\"galleria\">";
						 $misUrls = dameUrlsDeImagenesSubidas($idConcurso);
							foreach ($misUrls as $fila => $arr) {
								foreach ($arr as $campo => $valor) {
									$findme   = 'php';
									$pos = strpos($valor, $findme);
									$valorUrl = substr($valor, $pos,strlen($valor));
									echo "<div class='image'><img src='".$valorUrl."' alt='Poster'/></div>
					<p>";	

					echo "</div>";
				echo "<div id='div_content'>";
								}

							}

				
			
				}
	
				
			
				$idUser = $datos['usuarioOrganizador'];
			
				/* ENTRADAS */
				$query = "select count(*) as num from entrada where USUARIO_idUsuario = $idUser";
				$entradas = $conexion -> query($query);
				$numEntradas = $entradas -> fetch_array(MYSQLI_ASSOC);
				
								
				echo "<div class=\"entrada\"><b>Entradas:</b> ". $numEntradas['num'] ." </div><div class=\"ver_mas\"><b><a href=\"vista-detalle.php?id='".$idConcurso."'\">Ver más...</a></b></div><br />";	
				
				echo "<div class='features'><div class='spec_envia'> Enviado por: </div><div class='remitente'>
				<p id='pEnvia'>".$creador."</p></div></div>
				<div class='clear'></div>";

			?>

			<br />
	

			
			<!-- Si el status del concurso es "pendiente" ( igual a 1 ) -->
			
			<fieldset id="fpendiente" style="display:none;"><legend>Evaluación del concurso: </legend>
			<div>
				<div style="float:left;">
				<form method="GET" action="php/aceptarConcurso.php">
					<input type="hidden" id="nombreConcA" name="nombreConcA" />
					<input type="submit" id="bAceptar" name="bAceptar" value="Aceptar concurso" class="button"/>
				</form>
				</div>
				
				<div style="float:left;">
				<form method="GET" action="php/cancelarConcurso.php">
					<input type="hidden" id="nombreConcC" name="nombreConcC" />
					<input type="button" id="bCancelar" name="bCancelar" value="Cancelar concurso" onClick="cancelContest()"
					 class="button"/>
				</form>
				</div>
				
				<div style="float:left;">
				<form method="GET" action="php/concursoPendiente.php">
					<input type="hidden" id="nombreConcP" name="nombreConcP" />			
					<input type="submit" id="bPendiente" name="bPendiente" value="Dejar pendiente" class="button"/>
				</form>
				</div>
			
				<input type="button" id="bEditar" name="bEditar" value="Editar" onClick="location.href='php/concursoEditar.php?id=<?=$idConcurso?>'" class="button"/>
			</div>
			<div class="clear"></div>
			</fieldset>
			
					
			
			<!-- Si el status del concurso es "aceptado" ( igual a 2 ) -->
			
			<fieldset id="faceptado" style="display:none;"><legend>Evaluación del concurso: </legend>
			<div>
				<div style="float:left;">
				<form method="GET" action="php/cancelarConcurso.php">
					<input type="hidden" id="nombreConcC" name="nombreConcC" />				
					<input type="button" id="bCancelar" name="bCancelar" value="Cancelar concurso" onClick="cancelContest()" 
					class="button"/>
				</form>
				</div>
				
				<div style="float:left;">
				<form method="GET" action="php/concursoPendiente.php">
					<input type="hidden" id="nombreConcP" name="nombreConcP" />				
					<input type="submit" id="bPendiente" name="bPendiente" value="Dejar pendiente" class="button"/>
				</form>
				</div>
			
				<input type="button" id="bEditar" name="editar" value="Editar" onClick="location.href='php/concursoEditar.php?id=<?=$idConcurso?>'" class="button"/>
				
				
				<!-- Formulario para registrar ganador -->
			
				<input type="button"id="regGanador"name="regGanador"value="Registrar ganador"onClick="registrarGanador()" class="button"/>
				
				<div class="clear"></div>
				
				<div id="div_ganador"><br /><br />
				<fieldset><legend>Registrar ganador</legend>
					<form name="form_ganador" method="GET" action="php/registroGanador.php"><br />
			
						<input type="hidden" id="nombreConcurso" name="nombreConcurso" />

						<label for="idGanador">Arroba del suario ganador: </label>						
						<select id="e1" selected="selected" name="ganador[]">
						<option value="SeleccioneUna">Seleccione un usuario</option>
				
			
			
						<?php
						//Cargar el archivo de funciones
						require_once("php/funciones.php");
						$usuarios = buscarUsuarios();
						$fila = $usuarios[0];
						foreach($usuarios as $fila => $arr){
							//Todos los campos de cada fila
						    foreach($arr as $campo => $valor){
							if($campo == 'idUsuario')
							$cad1 = "<option value=".$valor.">";
							else if($campo == 'arrobaUsuario')
							echo $cad1.$valor.'</option>';
							}
						     }
						?>
						</select>
										
						<input style="float:right;margin-right:50%" type="submit" value="Registrar" /><br /><br />
			
					</form>
				</fieldset>
				</div>
				
			</div>

			
			<div class="clear"></div>
			</fieldset>
			
			
			
			<!-- Si el status del concurso es "cancelado" ( igual a 3 ) -->
			
			<fieldset id="fcancelado" style="display:none;"><legend>Evaluación del concurso: </legend>
			<div>
				<div style="float:left;">
				<form method="GET" action="php/aceptarConcurso.php">
					<input type="hidden" id="nombreConcA" name="nombreConcA" />			
					<input type="submit" id="bAceptar" name="bAceptar" value="Aceptar concurso" class="button"/>
				</form>
				</div>
				
				<div style="float:left;">
				<form method="GET" action="php/concursoPendiente.php">
					<input type="hidden" id="nombreConcP" name="nombreConcP" />				
					<input type="submit" id="bPendiente" name="bPendiente" value="Dejar pendiente" class="button"/>
				</form>
				</div>
			
				<input type="button" id="bEditar" name="editar" value="Editar" onClick="location.href='php/concursoEditar.php?id=<?=$idConcurso?>'" class="button"/>
			</div>
			<div class="clear"></div>
			</fieldset>



			<!-- Botón para evaluar concurso -->
			<input type="hidden" id="nombreCon" name="nombreCon" />
			
			<script type="text/javascript">
				document.getElementById('nombreCon').value = document.getElementById('concurso_name').innerHTML;
			</script>
			
			<input type="button" id="botonEval" name="botonEval" value="Evaluar concurso" class="button" onClick="checkStatus()" />

			
			<script type="text/javascript">
						var pending = document.getElementsByName('nombreConcP');
						for(i in pending)
							pending[i].value = document.getElementById('concurso_name').innerHTML;
						var accepted = document.getElementsByName('nombreConcA');
						for(i in accepted)
							accepted[i].value = document.getElementById('concurso_name').innerHTML;	
						var canceled = document.getElementsByName('nombreConcC');
						for(i in canceled)
							canceled[i].value = document.getElementById('concurso_name').innerHTML;			
			</script>	
					
			
			<!-- Botones de administrador -->
			
			<div class="clear"></div>
			
			<div id="div_eval">
				<input type="button" id="bAceptado" name="aceptado" value="Aceptar concurso" onClick="acceptContest()" class="button"/>
			
				<input type="button" id="bRechazado" name="rechazado" value="Cancelar concurso" onClick="cancelContest()" class="button"/>
			
				<input type="button" id="bCancelDec" name="cancelado" value="Cancelar decisión" onClick="cancelDecision()"class="button"/>
			
				<input type="button" id="bEditar" name="editar" value="Editar" onClick="editContest()" class="button"/>
			
				
			</div>
			
			</form>

			
			<div class="clear"></div>
			
			
			
			<!-- Mensajes y divs de aprobación o rechazo -->
			
			<form name="validacion" method="GET" action="">
			
				<div id="mensaje_aceptado" class="div_mensaje">
					<p class="msg">¡Concurso aceptado!</p>
					<img src="images/aprobar.png" alt="aceptar_icon" />
				</div>
				
				<div id="mensaje_rechazado" class="div_mensaje">
					<p class="msg">¡Está por cancelar el concurso!</p>
					<img src="images/rechazar.png" alt="cancelar_icon" />
				</div>
			
				<div id="comments" class="div_comments">
					<br /><label for="textarea">Razones de rechazo (campo no obligatorio): </label><br />
					<textarea id="textarea" rows="7" cols="75" maxlength="750"  resizable="false" placeholder="Escriba aquí" ></textarea><br />
					<input type="button" id="bComments" name="bComments" value="Aceptar" onClick="sendReasons()"/>
				</div>
			
				<div id="error_comment" class="div_mensaje">
					<p>¡Escriba una razón de rechazo válida (entre 10 y 750 caracteres)!</p>
				</div>
			
			</form>
			
			<div id="div_r"></div>
			
			<!-- Edición de concursos -->
			
			<div id="div_edit">
			
				<form name="form_edit" method="GET" action="php/editarConcurso.php">
				<fieldset>
				<legend><strong>Editar concurso</strong></legend><br />
				
				<label for="user">Enviado por: </label>
				<input type="text" id="user" name="user"/>
				
				<br /><br />
				
				<label for="nombre">Nombre del concurso: </label>
				<input type="text" id="inNombre" name="inNombre" required />
				
				<div id="error_nombre" class="div_error">
					<p>¡Introduzca un nombre para el concurso y que sea válido (entre 5 y 20 caracteres)!</p>
				</div>
				
				<br /><br />
				
				<label for="field_hashtag">Hashtag para Twitter: </label>
				<input type="text" id="field_hashtag" name="field_hashtag" required />
				
				<div id="error_hashtag" class="div_error">
				<p>¡Introduzca un hashtag del concurso para Twitter y que sea válido (entre 5 y 20 caracteres)! Comienza con '#'.</p>
				</div>
				
				<br /><br /><br />
				
				<div style="width:350px;float:left;">
				
				<label for="categoria">Categoría: </label>
				
				<!-- CATEGORÍAS -->
					<div id="catego">
						<select id="sel" onChange="fillSelect()">
							<option value="select" selected>Select one</option>
							<option>CARGAR CATEGORÍAS</option>
						</select>
					</div>
					
				</div><br />
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
					<input type="radio" id="radio-1-1" name="dificultad" value="Basica" class="regular-radio" />
					<label for="radio-1-1"> </label><label class="labelRadios"> Básica</label>
					<br />
					<input type="radio" id="radio-1-2" name="dificultad" value="Intermedia" class="regular-radio" />
					<label for="radio-1-2"> </label><label class="labelRadios"> Intermedia</label>
					<br />
					<input type="radio" id="radio-1-3" name="dificultad" value="Alta" class="regular-radio" />
					<label for="radio-1-3"> </label><label class="labelRadios"> Alta</label>
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
				<input type="file" id="imagen1" name="imagen" accept="image/*" required/>
				
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
				<input type="text" id="datepicker" name="fini" class="campofecha" size="12" required>
				
				&nbsp &nbsp &nbsp &nbsp
				
				<label for="datepicker2" >Fecha de finalización: </label>
				<input type="text" id="datepicker2" name="ffinal" class="campofecha" size="12" required>
				
				<br /><br /><br />
					
				<label for="fcreacion" >Fecha de creación: </label>
				<input type="text" id="fcreacion" name="fcreacion" size="12" />
				
				
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
					rte1.html = document.getElementById("pCont").innerHTML;
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
			<input class="button" type="button" id="bCancelEdit" name="bCancelEdit" value="Cancelar" onClick="cancelEdit()" />
			<input class="button" type="button" id="bEdit" name="bEdit" value="Aceptar" onClick="makeChanges()" />
			
			
			
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