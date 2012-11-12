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
         
   		<title>Vista de Detalle</title>
</head>

<body id="container">
		
		<header id="header">
		<!--	<nav id="menu-l">
				  	<ul>
				  		<li class="boton"><a href="" target="_self">Enviar Entrada</a></li>
						<li class="boton"><a href="index.html" target="_self">Inicio</a></li>
					</ul>	
  				</nav> -->
  
  				 <nav id="menu-r">
				<?php
						include('php/secciones/menu.html');
				?>
	   			</nav>
	   	
   		</header>	
	
	 	<article class="articulo">
    			
	  			<?php
						include('php/secciones/enviar.html');
				?>
	  			<div id="letras">
	   					<ul>
   	   						<li class="topic">Categoría:</li>
      	   					<li>PHP</li>
         					<li class="topic">Dificultad:</li>
	         				<li>Avanzada</li>
	        				<li class="topic">Inicia:</li>
	         				<li>20-05-12</li>
	         				<li class="topic">Termina:</li>
	         				<li>20-07-12</li>
   	  					 </ul>
	  				 </div>	
    			<section class="seccion">
    				<a id="TituloConcurso">Grafos XKCDMX</a>
   					<a href="http://www.google.com" id="hashtagTwitter">#XKCDMX</a>
   					<p id="textIntroduccion">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the rel</p>
	 				<p style="text-align:center;"><img src="images/template/poster.png" width="700" height="800" alt="Poster"/></p>    
    				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>    
    				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>    
    				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>        
    			</section>
    			<div class="sombra_seccion"></div>
    	
    			<p id="titleGanador">Ganador: </p>
    			<section id="enviarEntrada">
    				<a href="http://www.google.com" class="aroba">@levhita</a>  
					<div class="fechaEnvio"><p class="tituloEnvio">Enviado:</p><a href="http://www.google.com" > 23/09/12</a></div>
    				<p class="imageDeAroba"><img  src="http://lorempixel.com/80/80" alt="Poster"/></p>  
					<p id="texto">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took ae Aldus PageMaker including versions of Lorem Ipsum.</p>             
    			</section>
    			<div class="sombra_seccion"></div>	

				<a id="titleEntrada">Entradas: </a>
				
  				<section class="seccion-g">
    				<a href="http://www.google.com" class="aroba">@levhita</a>  
					<div class="fechaEnvio"><p class="tituloEnvio">Enviado:</p><a href="http://www.google.com" > 23/09/12</a></div>
    				<p class="imageDeAroba"><img  src="http://lorempixel.com/80/80" alt="Poster"/></p>  
					<p class="comentarioEntrada">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took ae Aldus PageMaker including versions of Lorem Ipsum.</p>             
   				</section>
    
 				<section class="seccion-g">
    				<a href="http://www.google.com" class="aroba">@levhita</a>  
					<div class="fechaEnvio"><p class="tituloEnvio">Enviado:</p><a href="http://www.google.com" > 23/09/12</a></div>
    				<p class="imageDeAroba"><img  src="http://lorempixel.com/80/80" alt="Poster"/></p>  
					<p class="comentarioEntrada">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took ae Aldus PageMaker including versions of Lorem Ipsum.</p>             
    			</section>

   				<section class="seccion-g">
    				<a href="http://www.google.com" class="aroba">@levhita</a>  
					<div class="fechaEnvio"><p class="tituloEnvio">Enviado:</p><a href="http://www.google.com" > 23/09/12</a></div>
    				<p class="imageDeAroba"><img  src="http://lorempixel.com/80/80" alt="Poster"/></p>  
					<p class="comentarioEntrada">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took ae Aldus PageMaker including versions of Lorem Ipsum.</p>             
    			</section>
    	


   		</article>
     
        
        <footer id="disqus_thread"></div>
    	<div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'equipoalpha'; // required: replace example with your forum shortname

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
        </footer>
</body>
</html>