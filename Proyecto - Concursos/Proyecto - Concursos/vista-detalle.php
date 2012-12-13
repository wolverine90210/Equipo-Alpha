<?php 
session_start();
if(isset($_REQUEST['id']))
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
		<script src="jquery/jquery-1.8.1.min.js" type="text/javascript" language="javascript"></script>
		<script src="jquery/jquery.effects.core.js" type="text/javascript" language="javascript"></script>
		<link href="css/auth-buttons.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="cbrte/html2xhtml.min.js"></script>
		<script type="text/javascript" src="cbrte/richtext_compressed.js"></script>
		<script type="text/javascript" src="js/vista-detalleJS.js"></script>
		
		<!-- load jQuery -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>

        <!-- load Galleria -->
        <script src="js/galleria-1.2.8.min.js"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.purr.js"></script>
		<script type="text/javascript" src="js/ajax.js"></script>
		<script type="text/javascript">
		
			$(document).ready(function(e) {
				
				$('#site-name h1').show('fast')
				$('#menu-l li a').hover(function(){$(this).stop(false,true).animate({'color':'#F33'},500)},function(){$(this).stop(false,true).animate({'color':'#FFF'},200)});
				
				// Load the classic theme
				Galleria.loadTheme('js/galleria.classic.min.js');
		
				// Initialize Galleria
				Galleria.run('#galleria');
					
				
			});
		</script>	
		
		<script type="text/javascript" src="./purr-example/jquery.js"></script>
   	<script type="text/javascript" src="./purr-example/jquery.purr.js"></script>
			<script type="text/javascript">
   		$( document ).ready( function ()
			{
				$( '#confirm' ).click( function () 
					{
						var notice = '<div class="notice">'
								  + '<div class="notice-body">' 
									  + '<img src="./purr-example/info.png" alt="" />'
									  + '<h3>Entrada Agregada</h3>'
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
				
		$("paginate").live("click", function(){
		$("#content").html("<div align='center'><img src='images/cargando.gif'/></div>");
			
			var pagina=$(this).attr("data");
			var idConcurso="<?php echo $_REQUEST['id']; ?>"
			var cadena="page="+pagina+"idConcurso="+idConcurso;
	
			$.ajax({
            			type:"GET",
            			url:"php/paginacionEntradas.php",
            			data:cadena,
            			success:function(data)
            			{
                				$("#content").fadeIn(1000).html(data);
            			}
        			});
    		});
	}); 

			}
		);
   	</script>
   	
   	<style type=”text/css”>
.paginate {
font-family: Arial, Helvetica, sans-serif;
font-size: .7em;
}
a.paginate {
border: 1px solid #000080;
padding: 2px 6px 2px 6px;
text-decoration: none;
color: #000080;
}
a.paginate:hover {
background-color: #000080;
color: #FFF;
text-decoration: underline;
}
a.current {
border: 1px solid #000080;
font: bold .7em Arial,Helvetica,sans-serif;
padding: 2px 6px 2px 6px;
cursor: default;
background:#000080;
color: #FFF;
text-decoration: none;
}
span.inactive {
border: 1px solid #999;
font-family: Arial, Helvetica, sans-serif;
font-size: .7em;
padding: 2px 6px 2px 6px;
color: #999;
cursor: default;
}

a:hover {
cursor:move;
color: #0000FF;
text-decoration:none;
}
</style>
	
	<style type="text/css">
	
		
		#purr-container {
			position: fixed;
			top: 0;
			right: 0;
		}
		
		.notice {
			position: relative;
			width: 324px;
		}
			.notice .close	{position: absolute; top: 12px; right: 12px; display: block; width: 18px; height: 17px; text-indent: -9999px; background: url(./purr-example/purrClose.png) no-repeat 0 10px;}
		
		.notice-body {
			min-height: 50px;
			padding: 22px 22px 0 22px;
			background: url(./purr-example/purrTop.png) no-repeat left top;
			color: #f9f9f9;
		}
			.notice-body img	{width: 50px; margin: 0 10px 0 0; float: left;}
			.notice-body h3	{margin: 0; font-size: 1.1em;}
			.notice-body p		{margin: 5px 0 0 60px; font-size: 0.8em; line-height: 1.4em;}
		
		.notice-bottom {
			height: 22px;
			background: url(./purr-example/purrBottom.png) no-repeat left top;
		}
	</style>
	
		 <style>
            .content{color:#777;font:12px/1.4 "helvetica neue",arial,sans-serif;width:620px;margin:20px auto;}
            a {color:#22BCB9;text-decoration:none;}
            .cred{margin-top:20px;font-size:11px;}

            /* This rule is read by Galleria to define the gallery height: */
            #galleria{height:620px}

        </style>

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
				<h1>Concursos</h1>
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
						$ganador = dameArrobaDeUsuario($datosConcurso['usuarioGanador']);
						$avatar = dameAvatarDeUsuario($datosConcurso['usuarioGanador']);
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
   					<a href="https://twitter.com/search?q=" id="hashtagTwitter"><?=$datosConcurso['hashtag']?></a>
   					
   					<!--Hacer la paginación de lo que resulte de hacer la query de listar todas las
	 					imagenes del concurso-->

	 					  <div id="galleria">
							<?php $misUrls = dameUrlsDeImagenesSubidas($idConcurso);
							foreach ($misUrls as $fila => $arr) {
								foreach ($arr as $campo => $valor) {
									$findme   = 'php';
									$pos = strpos($valor, $findme);
									$valorUrl = substr($valor, $pos,strlen($valor));
									//echo $valorUrl;
									
									//$valorUrl = "php/uploads/23/manzana-amarilla.jpg";
									echo "<a href=\"$valorUrl\">
				                <img src=\"$valorUrl\"  alt=\"Poster\"/>
				            	</a>";
								}

							}
						?>
				            	
        				</div>
 
    				<p><?=$datosConcurso['descripcion']?></p>    
    			</section>
    			<div class="sombra_seccion"></div>
    			
				<section class="seccion">
					
					<label class = "titulos">Agregar nueva entrada</label>
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
								document.getElementById("valorRTE").value = document.RTEDemo.rte1.value;
								document.RTEDemo.rte1.value = "";
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
						<input id="guardarRT" class="botonGuardar" id="bot" type="submit" style="display:none" name="submit"  value="Guardar" />
						<a id="confirm" style="display:none" href="#show">Regular</a>
						<input type="text" style="display:none" id="valorRTE" />
					</form>
					<a  id="botonSubmit" class="button" style="float:right" onclick="valida_envia()">Guardar</a>
		    		<div style="clear:both"> </div>		
		    		</div>	
		    	</section>
 				<div class="sombra_seccion"></div>
 
    			<p id="titleGanador">Ganador: </p>
    			<section id="enviarEntrada">
    				<a href="http://www.google.com" class="aroba"><?=$ganador?></a>  
					<div class="fechaEnvio"><p class="tituloEnvio">Enviado:</p><a href="http://www.google.com" > -----</a></div>
    				<p class="imageDeAroba"><img  src="<?=$avatar?>" alt="Poster" width="80" height="80"/></p>  
					<p id="texto">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took ae Aldus PageMaker including versions of Lorem Ipsum.</p>             
    			</section>
    			<div class="sombra_seccion"></div>	

				<a id="titleEntrada">Entradas: </a>
				
				
			<div id="contenido">
			<?php 
				require('php/bd.inc');

				$con = mysql_connect($dbhost, $dbuser, $dbpass); 
				mysql_select_db($db, $con) or die ("No se pudo realizar la conexion");
			
			 $RegistrosAMostrar=4;

			//estos valores los recibo por GET
			if(isset($_GET['pag'])){
				$RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
				$PagAct=$_GET['pag'];
			//caso contrario los iniciamos
			}else{
				$RegistrosAEmpezar=0;
				$PagAct=1;
				
			}
			$Resultado=mysql_query("select entrada.idEntrada, entrada.fechaDeEnvio, entrada.descripEntrada,entrada.usuario_IdUsuario 
				from entrada 
				inner join concurso_has_entrada 
				on entrada.idEntrada = concurso_has_entrada.Entrada_idEntrada 
				and concurso_has_entrada.concurso_IdConcurso = $idConcurso
				ORDER BY entrada.idEntrada desc LIMIT $RegistrosAEmpezar, $RegistrosAMostrar",$con);
				if(!$MostrarFila=mysql_fetch_array($Resultado)){
					
					echo "<label>No hay entradas. Sé el primero en agregar 1.</label>";
					
				}else{
					
			echo "<table>";
			echo '<thead><tr>';
			while($MostrarFila=mysql_fetch_array($Resultado)){
			echo '<th> </th>';
			echo '</tr></thead>';
			echo '<tbody>';
	
			$fecha = $MostrarFila['fechaDeEnvio'];
			date_default_timezone_set('UTC');
			$fechaNueva = date('d-m-Y', strtotime($fecha));
			$descripcion = $MostrarFila['descripEntrada'];
			$usuarioId = $MostrarFila['usuario_IdUsuario'];
			$arroba = dameArrobaDeUsuario($usuarioId);
			$avatar = dameAvatarDeUsuario($usuarioId);
			echo "<section class=\"seccion-g\">
				    				<a href=\"https://twitter.com/$arroba\" target=\"_blank\" class=\"aroba\">$arroba</a>  
									<div class=\"fechaEnvio\"><p class=\"tituloEnvio\">Enviado:</p><a href=\"http://alanturing.cucei.udg.mx/equipo-alpha/calendario.php\" > $fechaNueva</a></div>
				    				<p class=\"imageDeAroba\"><img  src=\"$avatar\" alt=\"Poster\" width=\"80\" height=\"80\"/></p>  
									<p class=\"comentarioEntrada\">$descripcion</p>             
			   	  </section>";
			echo '</tr>';
			
			}
	
			echo '</tbody>';
			echo '</table>';
			//******--------determinar las p�ginas---------******//
			$NroRegistros=mysql_num_rows(mysql_query("select entrada.idEntrada, entrada.fechaDeEnvio, entrada.descripEntrada,entrada.usuario_IdUsuario 
					from entrada 
					inner join concurso_has_entrada 
					on entrada.idEntrada = concurso_has_entrada.Entrada_idEntrada 
					and concurso_has_entrada.concurso_IdConcurso = $idConcurso
					ORDER BY entrada.idEntrada desc",$con));

			$PagAnt=$PagAct-1;
			$PagSig=$PagAct+1;
			$PagUlt=$NroRegistros/$RegistrosAMostrar;
			
			//verificamos residuo para ver si llevar� decimales
			$Res=$NroRegistros%$RegistrosAMostrar;
			// si hay residuo usamos funcion floor para que me
			// devuelva la parte entera, SIN REDONDEAR, y le sumamos
			// una unidad para obtener la ultima pagina
			if($Res>0) $PagUlt=floor($PagUlt)+1;

			//desplazamiento
			echo "<a onclick=\"Pagina('1')\">Primero</a> ";
			if($PagAct>1) echo "<a onclick=\"Pagina('$PagAnt',$idConcurso)\">Anterior</a> ";
			echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>";
			if($PagAct<$PagUlt)  echo " <a onclick=\"Pagina('$PagSig',$idConcurso)\">Siguiente</a> ";
			echo "<a onclick=\"Pagina('$PagUlt',$idConcurso)\">Ultimo</a>";
			 }
			 
			 /*
				require_once("php/funciones.php");
			$entradas = dameEntradasDelConcurso($idConcurso);

			if(!isset($entradas)){
				echo "<label>No hay entradas. Sé el primero en agregar 1.</label>";
			}
			else {
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
						$avatar = dameAvatarDeUsuario($usuarioId);
						break;
					}
			
				}
					echo 
					"<section class=\"seccion-g\">
	    				<a href=\"https://twitter.com/$arroba\" target=\"_blank\" class=\"aroba\">$arroba</a>  
						<div class=\"fechaEnvio\"><p class=\"tituloEnvio\">Enviado:</p><a href=\"http://alanturing.cucei.udg.mx/equipo-alpha/calendario.php\" > $fechaNueva</a></div>
	    				<p class=\"imageDeAroba\"><img  src=\"$avatar\" alt=\"Poster\" width=\"80\" height=\"80\"/></p>  
						<p class=\"comentarioEntrada\">$descripcion</p>             
   					</section>";
				echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';
				
	
				
			}*/
				?>	
			
			</div>
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
