<!DOCTYPE html>
<html lang="es">
<head>
	<title>Calendario</title>
	<meta name="description" content="Pagina principal de la practica 1" />
	<meta name="keywords" content="HTML5,Practica_1" />
	<meta name="author" content="Oliver Castellanos" />
	<meta charset="UTF-8" />
	<link rel="SHORTCUT ICON" href="favicon.ico" />
	<link href="css/general.css" rel="stylesheet" type="text/css"/>
	<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.css' />
	<script type='text/javascript' src='jquery/jquery-1.8.1.min.js'></script>
	<script src="jquery/jquery-1.7.2.min.js" type="text/javascript" language="javascript"></script>
	<script src="jquery/jquery.effects.core.js" type="text/javascript" language="javascript"></script>

	<script type='text/javascript' src='fullcalendar/fullcalendar.js'></script>
	<script>
	var eventos = new Array;
		$(document).ready(function() {
		
		$.ajax(
		{
		url:'myfeed.php',
		dataType:'json',
		type: 'POST',
		success:function(data)
		{
			
			eventos=data;
			$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: true,
			events: eventos
		});
			
		},
		error:function(data)
		{
		alert('fallo')
		}
		});
		
		
			$('#site-name h1').show('fast')
			$('#menu-r li a').hover(function(){$(this).stop(false,true).animate({'color':'#F33'},500)},function(){$(this).stop(false,true).animate({'color':'#FFF'},200)});

		});
	</script>
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
	   		<h1 style="display:none; ">Calendario</h1>
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
			<div class="cont"><a class="boton1" href="agregarConcurso.php"><span>enviar</span></a></div>
	 		<section class="seccion">
				<div id='calendar'></div>
			</section>	
			<div class="sombra_seccion"></div>
	</article>
	
</body>
</html>
