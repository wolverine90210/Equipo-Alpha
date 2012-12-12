<?php 
session_start();

$idConcurso = $_REQUEST['id'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="UTF-8" />
		<meta name="description" content="Index - Maquetado Vista de Blog" />
		<meta name="keywords" content="Concursos, programacion, enviar, categoria" />
		<meta name="author" content="Equipo Alpha" />
		<meta http-equiv="refresh" content="160" />
		<link rel="icon" href="hackergarage_32.png" sizes="32x32">
		<link rel="icon" media="screen" type="image/png" href="hackergarage_16.png">
		<link rel="icon" href="hackergarage_48.png" sizes="48x48">
		<link href="css/general.css" type="text/css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
		<script src="jquery/jquery-1.7.2.min.js" type="text/javascript" language="javascript"></script>
		<script src="jquery/jquery.effects.core.js" type="text/javascript" language="javascript"></script>
		<link href="css/auth-buttons.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="cbrte/html2xhtml.min.js"></script>
		<script type="text/javascript" src="cbrte/richtext_compressed.js"></script>
		<script type="text/javascript" src="js/vista-detalleJS.js"></script>
		<script type="text/javascript" language="javascript">
			$(document).ready(function(e) {
				$('#site-name h1').show('fast')
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
						require_once("php/funciones.php");
						$datosConcurso = buscarPorId($idConcurso);//poner por request
						if(strcmp($datosConcurso['dificultad'], "1") == 0) 
							$dificultad = "Básica";
						else if($datosConcurso['dificultad'] == "2" )
							$dificultad = "Intermedia";
						else
							 $dificultad = "Avanzada";
							 
						$categoria = buscarPorIdCategoria($datosConcurso['categoria']);
						//$imagenPrincial = dameImagenDeConcurso('2');//poner por request
				?>
	  			<div id="letras">
	   					<ul>
   	   					<li class="topic">Categoría:</li>
      	   					<li><?=$categoria?></li>
         					<li class="topic">Dificultad:</li>
	         				<li><?=$dificultad?></li>
	        				<li class="topic">Inicia:</li>
	         				<li><?=date('d-m-Y', strtotime($datosConcurso['fechaDeInicio']));?></li>
	         				<li class="topic">Termina:</li>
	         				<li><?=date('d-m-Y', strtotime($datosConcurso['fechaDeFin']));?></li>
   	  					 </ul>
	  				 </div>	
    			<section class="seccion">
    				<a id="TituloConcurso"><?=$datosConcurso['nombreConcurso']?></a>
   					<a href="https://twitter.com/" id="hashtagTwitter"><?=$datosConcurso['hashtag']?></a>
	 				<p style="text-align:center;"><img src="images/template/poster.png" width="700" height="800" alt="Poster"/></p>    
    				<p><?=$datosConcurso['descripcion']?></p>    
    			</section>
    			<div class="sombra_seccion"></div>
    			
				<section class="seccion">
					
					<label>Agregar nueva entrada</label>
					<label class="div_error" id="adv_rteEditor" style="display: none">Escriba una entrada</label>
					<label id="ok_rteEditor" style="display: none">Entrada agregada correctamente</label>
					<div style="margin-left:20%">
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
							rte1.html = '';
				
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
							rte1.toggleSrc = false;
							rte1.build();
						</script>
						<div style="clear:both"> </div>	
						<input id="guardarRT" class="botonGuardar" type="submit" style="display:none" name="submit"  value="Guardar" />
					</form>
					<a  id="botonSubmit" class="button" style="float:right" onclick="valida_envia()">Guardar</a>
		    		<div style="clear:both"> </div>		
		    		</div>	
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
				
			<?php 
				require_once("php/funciones.php");
			$idConcurso = 2;
			$entradas = dameEntradasDelConcurso($idConcurso);
			
			//Obtener los titulos
			$fila = $entradas[0];
			$titulos = array_keys($fila);
			echo '<thead><tr>';
			foreach($titulos as $th){
				switch ($th) {
					case 'idEntrada':
					echo '<th> </th>';
					break;
				}
			}
			echo '</tr></thead>';
			echo '<tbody>';

			//Por cada fila
			foreach($entradas as $fila => $arr){
				echo '<tr>';
				//Todos los campos de cada fila
				foreach($arr as $campo => $valor){
					switch($campo){
			
						case 'fechaDeEnvio':
						$fecha = $valor;
						date_default_timezone_set('UTC');
						$fechaNueva = date('d-m-Y', strtotime($fecha));
						break;
						case 'descripEntrada':
						$descripcion = $valor;
						break;
						case 'usuario_IdUsuario':
						$usuarioId = $valor;
						$arroba = dameArrobaDeUsuario($usuarioId);
						break;
					}
			
				}
					echo 
					"<section class=\"seccion-g\">
	    				<a href=\"https://twitter.com/$arroba\" target=\"_blank\" class=\"aroba\">$arroba</a>  
						<div class=\"fechaEnvio\"><p class=\"tituloEnvio\">Enviado:</p><a href=\"http://alanturing.cucei.udg.mx/equipo-alpha/calendario.php\" > $fechaNueva</a></div>
	    				<p class=\"imageDeAroba\"><img  src=\"http://lorempixel.com/80/80\" alt=\"Poster\"/></p>  
						<p class=\"comentarioEntrada\">$descripcion</p>             
   					</section>";
				echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';
				
		?>	
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
