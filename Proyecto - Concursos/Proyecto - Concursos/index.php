<?php
	session_start();
?>
﻿<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta name="description" content="Index - Maquetado Vista de Blog" />
	<meta name="keywords" content="Concursos, programacion, enviar, categoria" />
	<meta name="author" content="Equipo Alpha" />
	<link rel="icon" href="hackergarage_32.png" sizes="32x32">
	<link rel="icon" media="screen" type="image/png" href="hackergarage_16.png">
	<link rel="icon" href="hackergarage_48.png" sizes="48x48">
	<link href="css/general.css" type="text/css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
	<link href="css/auth-buttons.css" type="text/css" rel="stylesheet" />
	<script src="jquery/jquery-1.7.2.min.js" type="text/javascript" ></script>
	<script src="jquery/jquery.effects.core.js" type="text/javascript" ></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" >
			 $(document).ready(function(e) {
				$('#site-name h1').show('fast')
			$('#menu-r li a').hover(function(){$(this).stop(false,true).animate({'color':'#F33'},500)},function(){$(this).stop(false,true).animate({'color':'#FFF'},200)});	
			});
	</script>	
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
			
			<script type="text/javascript">
			$('#adminButton').hide();
			$('#accountButton').hide();
			</script>
	   </nav>
	   

	
	</header>
	
	
	<article class="articulo">
		<?php
						include('php/secciones/enviar.html');
		?>			
			
			
		<div id="contenido">
		<?php
						include('php/secciones/indexData.php');
		?>
			</div>					
		

	</article>
	
	
	
	<footer id="paginacion">
		
			<?php
						//include('php/secciones/antSig.html');
						include('php/secciones/copyright.html');
			?>
	</footer>

	
</body>

</html>
