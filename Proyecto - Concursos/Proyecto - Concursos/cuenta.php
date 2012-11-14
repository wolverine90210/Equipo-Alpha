<!DOCTYPE html>
<html lang="es">
	
<head>
		<meta charset="UTF-8" />
		<meta name="description" content="Index - Maquetado Vista de Blog" />
		<meta name="keywords" content="Concursos, programacion, enviar, categoria" />
		<meta name="author" content="Equipo Alpha" />
		<meta http-equiv="refresh" content="160" />
		<link href="css/general.css" type="text/css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
		<script src="jquery/jquery-1.7.2.min.js" type="text/javascript" language="javascript"></script>
		<script src="jquery/jquery.effects.core.js" type="text/javascript" language="javascript"></script>
		<script type="text/javascript" language="javascript">
			$(document).ready(function(e) {
				$('#site-name h1').show('slow')
			$('#menu-l li a').hover(function(){$(this).stop(false,true).animate({'color':'#F33'},500)},function(){$(this).stop(false,true).animate({'color':'#FFF'},200)});	
			});
		</script>	
		<script type="text/javascript">
    		 var disqus_developer = 1; // this would set it to developer mode
     	</script>
     	<script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'equipoalpha'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function () {
            var s = document.createElement('script'); s.async = true;
            s.type = 'text/javascript';
            s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
            (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
        }());
        </script>
         
   		<title>Cuenta de Usuario</title>
</head>

<body id="container">
		
		<header id="header">
		<!--	<nav id="menu-l">
				  	<ul>
				  		<li class="boton"><a href="" target="_self">Enviar Entrada</a></li>
						<li class="boton"><a href="index.html" target="_self">Inicio</a></li>
					</ul>	
  				</nav> -->
  				<div id="site-name">
	   				<h1 style="display:none; ">Cuenta</h1>
   				</div>
  
  				 <nav id="menu-r">
				<?php
						include('php/secciones/menu.html');
				?>
					
	   			</nav>
	   	
   		</header>	
	
	 	<article class="articulo">
			<div class="cont"><a class="boton1" href="404.shtml"><span>enviar</span></a></div>
    			<h2>Aceptados</h2>
	  			<div id="aceptados">
    			<section id="evento1" class="seccion">
					<?php
						include('php/secciones/cuentaSec.html');
					?>
    		
    			</section>
    			<div id="sombra1" class="sombra_seccion"></div>
    			 				
    			<section id="evento2" class="seccion"><br />
    				<?php
						include('php/secciones/cuentaSec.html');
					?>
				</script>
    			
    			</section>
    			<div id="sombra2" class="sombra_seccion"></div>
    			
			</div>
		<h2>Rechazados</h2>
	  			<div id="rechazados">
	  				
    			<section id="evento3" class="seccion">
    				<?php
						include('php/secciones/cuentaSec.html');
					?>
    			</section>
    			<div id="sombra3" class="sombra_seccion"></div>
    			
    		
    			<section id="evento4" class="seccion">
    				<?php
						include('php/secciones/cuentaSec.html');
					?>
    			</section>
    			<div id="sombra4" class="sombra_seccion"></div>
    			
		</div>
		<h2>Pendientes</h2>
		<div id="pendientes">
    			<section id="evento5" class="seccion">
    				<?php
						include('php/secciones/cuentaSec.html');
					?>
    			</section>
    			<div id="sombra5" class="sombra_seccion"></div>
    			
    		
    			<section id="evento6" class="seccion">
    				<?php
						include('php/secciones/cuentaSec.html');
					?>
    			</section>
    			<div id="sombra6" class="sombra_seccion"></div>
    			
		</div>
   		</article>
    	
</body>
</html>