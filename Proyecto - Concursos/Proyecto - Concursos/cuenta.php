<?php
	session_start();
	if (!isset($_GET["op"])) { $op = ""; } else { $op = trim($_GET["op"]); } 
	

	if ($op=="pdf") {
				// generamos PDF
				require_once("./dompdf-0.5.1/dompdf_config.inc.php");
				
				$dompdf = new DOMPDF();
				$dompdf->load_html_file('listaConcursos2.php');
				$dompdf->render();
				$dompdf->stream("Concursos.pdf");
				exit(0);
	
	}
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
	<script type="text/javascript" src='js/ajax.js'></script>
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
	<style type="text/css">
 	body table{
	font:12px Arial, Tahoma, Verdana, Helvetica, sans-serif;
	background-color:#BECEDC;
	color:#000;
	}
	
	a h1{
	font-size:35px;	
	color:#FFF;
	}
	
	table{
	width:100%;
	height:auto;
	margin:10px 0 10px 0;
	border-collapse:collapse;
	text-align:center;
	background-color:#365985;
	color:#FFF;
	}
	
	table td,th{
	border:1px solid black;
	}
	
	table th{
	color:#FC0;	
	}
	
	.menu{
	background-color:#69C;
	color:#FFF;
	}
	
	.menu a{
	color:#FFF;	
	}
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
		
		<noscript>Tu navegador no soporta Javascript</noscript>
		<title>Cuenta</title>	
</head>

<body id="container">
	<header id="header">
	
		<a id="loginButton" style="float:right; margin-top: 36px; margin-left: 10px;" href="loginWithTwitter.php?authenticate=1">
	  	<img src="images/sign-in-with-twitter-gray.png" alt="Sign-In-With-Twitter" />
	  	</a>
	
		<script type="text/javascript">$('#loginButton').hide();</script> 
	   
		<?php
		include('php/secciones/signIn.php');
		?>
		
		<div id="site-name">
	   				<h1>Cuenta</h1>
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
			<form name="addConcurso" method="get" action="php/concursoAgregar.php">	
			<h2>Seleccione el tipo de concursos que desea ver</h2>
			<select name="statusConcurso" id="statusConcurso" onChange="buscarCuenta(<?= $_SESSION['access_token']['id']; ?>)">
				<option value="0">Selecciona...</option>
				<option value="1">Pendiente</option>
				<option value="2">Aceptado</option>
				<option value="3">Rechazado</option>
			</select>
			</form>
			<a href="misConcursos.php">Ver más detalles de mis concursos</a>
			
	 </div>
	<div id="extra"></div>
	<div class="ver_mas"><b><a href="excel.php">Bajar archivo de excel con la tabla completa</a></b></div>
	  <form name='formFactura' id='formFactura' method='post' action="cuenta.php?op=pdf">  
			    <input type="submit" id="btnAceptar" name="btnAceptar" title="crear PDF" value="crear PDF"/>   
	  </form>
		<br />
</section>
	<div class="sombra_seccion"> </div>
	</article>
	<footer > 
		
	</footer>
</body>
</html>
