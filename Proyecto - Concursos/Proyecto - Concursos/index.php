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
	
		<div id="site-name">
			<h1 style="display:none; ">Concursos</h1>
		</div>
		
	   <nav id="menu-r">
			<?php
						include('php/secciones/menu.html');
			?>
			
			<script type="text/javascript">$('#adminButton').hide();</script>	  
			<script type="text/javascript">$('#accountButton').hide();</script>	
			
			<a id="loginButton" style="float:right;" href="loginWithTwitter.php?authenticate=1">
	  		<img src="images/sign-in-with-twitter-gray.png" alt="Sign-In-With-Twitter" />
	  		</a>
	 
	   </nav>
	   
	   <script type="text/javascript">$('#loginButton').hide();</script> 
	   
	<?php
	include('php/secciones/signIn.php');
	?>
	
	</header>
	
	
	<article class="articulo">
		<?php
						include('php/secciones/enviar.html');
		?>
		<section class="seccion">
		
			<?php
						include('php/secciones/incat.html');
			?>
			
		</section>
		<div class="sombra_seccion"></div>
		
		<section class="seccion">
			
			<?php
						include('php/secciones/incat2.html');
			?>

		</section>
		<div class="sombra_seccion"></div>
		
		<section class="seccion">
			
			<?php
						include('php/secciones/incat3.html');
			?>
			
		</section>
		<div class="sombra_seccion"></div>
	</article>
	
	
	
	<footer id="paginacion">
		
			<?php
						include('php/secciones/antSig.html');
						include('php/secciones/copyright.html');
			?>
	</footer>

	
</body>

</html>
