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
	<link rel="icon" href="hackergarage_32.png" sizes="32x32">
	<link rel="icon" media="screen" type="image/png" href="hackergarage_16.png">
	<link rel="icon" href="hackergarage_48.png" sizes="48x48">
	<link href="css/general.css" type="text/css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
	<script src="js/ajaxPaginator.js" type="text/javascript" ></script>
	<script src="jquery/jquery-1.7.2.min.js" type="text/javascript" ></script>
	<script src="jquery/jquery.effects.core.js" type="text/javascript" ></script>
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

		<a id="loginButton" style="float:right; margin-top: 36px; margin-left: 10px;" href="loginWithTwitter.php?authenticate=1">
	  	<img src="images/sign-in-with-twitter-gray.png" alt="Sign-In-With-Twitter" />
	  	</a>
	
		<script type="text/javascript">$('#loginButton').hide();</script> 
	   
		<?php
		include('php/secciones/signIn.php');
		?>
	
		<div id="site-name">
			<h1 style="display:none; ">Lista de Concursos</h1>
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
	

	<article class="articulo" id="contenidoTabla">
		
		<?php include('php/paginator.php')?>
	
	</article>
	
	<article class="articulo">
		
	
		<div class="sombra_seccion"></div>
	</article>
	
	
</body>

</html>


