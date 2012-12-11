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
	<link rel="icon" href="hackergarage_32.png" sizes="32x32">	
	<link rel="icon" media="screen" type="image/png" href="hackergarage_16.png">
	<link rel="icon" href="hackergarage_48.png" sizes="48x48">
	<link href="css/general.css" type="text/css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
	<script src="jquery/jquery-1.7.2.min.js" type="text/javascript" ></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	
	<script src="jquery/jquery.effects.core.js" type="text/javascript" ></script>
	
	<script type="text/javascript" src="js/adminConcursosJS.js"></script>
	<a id="ancla1">
	<script type="text/javascript" >
			 $(document).ready(function(e) {
				$('#site-name h1').show('fast')
			$('#menu-r li a').hover(function(){$(this).stop(false,true).animate({'color':'#F33'},500)},function(){$(this).stop
			(false,true).animate({'color':'#FFF'},200)});	
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
			
			<script type="text/javascript">
			$('#adminButton').hide();
			$('#accountButton').hide();
			</script>
		
	   </nav>

	
	<h1>Administración de concursos</h1>
	<div class="cont" style="float:right;"><a class="boton1" href="agregarConcurso.php"><span>enviar</span></a></div>
	
	<br /><br />
	<h2>Edición o eliminación de concursos:</h2>
	
	</header>
	
	<article class="articulo">
	
		<section class="seccion">
	
			<h1 style="text-align:center;font-size:2em;margin-bottom:3%">Listado de concursos para edición o eliminación: </h1>
			<div class="clear"></div>
		
			<form method="GET" action="php/mostrarConcursosSinAceptar.php" style="float:left;margin-left:15%;font-size:1.2em">
				<input type="submit" value="Listar concursos sin aceptar" class="button" style="font-size:1.2em;"/>
			</form>
			<form method="GET" action="php/mostrarConcursosCancelados.php" style="float:right;margin-right:15%;font-size:1.2em">
				<input type="submit" value="Listar concursos cancelados" class="button" style="font-size:1.2em;"/>
			</form>
		
			<div style="margin-bottom: 3%" class="clear"></div>
		
	
		</section>
	
		<div class="sombra_seccion"></div>

		
		<br />
		<h2>Evaluación y edición de concursos:</h2>
			
			<?php
			
			require_once('bd.inc');
			$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

			if($conexion->connect_error){

				die("Por el momento no se puede acceder al gestor de la BD");

			}
			
			echo '<section class="seccion">';
		
			$query = "select idConcurso as 'Evaluar/Editar', nombreConcurso as 'Nombre', hashtag as 'Hashtag de Twitter', dificultad as 'Dificultad', categoria as 'Categoria', usuarioOrganizador as 'Usuario creador' from concurso where status != 2";
	
			$resultados = $conexion -> query($query);
			$datos = "";
	
			$query = "select * from categoria";
	
			$categorias = $conexion -> query($query);
	
			$query = "select * from usuario";
	
			$usuarios = $conexion -> query($query);
	
			//Convierto el resultado de mi consulta a un arreglo
			if($categorias -> num_rows >= 1){
				//Por cada fila obtengo un arreglo
				while($filaCat = $categorias -> fetch_assoc())
					$datosCat[] = $filaCat;
			}
	
			//Convierto el resultado de mi consulta a un arreglo
			if($usuarios -> num_rows >= 1){
				//Por cada fila obtengo un arreglo
				while($filaUsers = $usuarios -> fetch_assoc())
					$datosUsers[] = $filaUsers;
			}
			
			
			
			echo "<strong><p style='color: white; text-align:center; font-size:1.7em;'>Concursos sin aceptar:</p></strong>";
			
			//Convierto el resultado de mi consulta a un arreglo
			if($resultados -> num_rows >= 1){
				//Por cada fila obtengo un arreglo
				while($fila = $resultados -> fetch_assoc())
					$datos[] = $fila;			

	
			//Recorro mi arreglo para dibujar la tabla				
	
			echo "<div style='clear:both;
				background-color: #D5D7C6;
				color: #1739AB;
				font-weight: bold;
				font-size: 1.5em;
				text-align: center;
				border-style: solid;
				margin-top: 20px;
				border-radius:7px;
				-moz-border-radius:7px;
				-webkit-border-radius:7px;'>";
	
			echo "<table border='1' style='text-align:center;'>";
			echo '<caption>Datos de los concursos</caption>';

			//Obtener los titulos
			$fila = $datos[0];
			$titulos = array_keys($fila);
			echo '<thead style="color:black"><tr>';
			foreach($titulos as $th)
			echo '<th>',$th,'</th>';
			echo '</tr></thead>';

			echo '<tbody>';

			//Por cada fila
			foreach($datos as $fila => $arr){
			echo '<tr>';
			//Todos los campos de cada fila
			foreach($arr as $campo => $valor){
				if($campo == 'Evaluar/Editar'){
		
	
			echo '<td>
			<a href="evalConcurso.php?id=',$valor,'">
			<img src="images/edit-eval.jpg" width="48px" height="48px" />
			</a>
			</td>';

	
			}else if($campo == 'Dificultad'){
				if($valor == 1)
						echo '<td>','B&aacutesica','</td>';
				if($valor == 2)
						echo '<td>','Intermedia','</td>';
				if($valor == 3)
						echo '<td>','Alta','</td>';
		
			}
			else if($campo == "Categoria"){
				for($i=0; $i < count($datosCat);$i++){
					if($datosCat[$i]['idCategoria'] == $valor)
						echo '<td>',$datosCat[$i]['nom_Categoria'],'</td>';
				}
			}
			else if($campo == 'Usuario creador'){
				for($i=0; $i < count($datosUsers);$i++){
					if($datosUsers[$i]['idUsuario'] == $valor)
						echo '<td>',$datosUsers[$i]['arrobaUsuario'],'</td>';
				}
			}
			else
			echo '<td>',$valor,'</td>';
			}
			echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';	
	
			echo "</div>
	
			<div style='text-align:center;'><br />
			<a href='#ancla1' style='font-size:1.1 em; font-weight: bold; font-size:1.3em; color:white'>Ir al principio</a>
			</div>";
			
			}else{
				
				echo "<p style='text-align:center;font-weight:bold;font-size:1.3em;'>No hay resultados para mostrar.</p>
				<p style='text-align:center'><img src='images/empty_folder.png' width='128px' height='128px' 
				alt='empty_folder_icon' /></p>";
				echo "<div style='text-align:center;'><br />
				<a href='#ancla1' style='font-size:1.1 em; font-weight: bold; font-size:1.3em; color:white'>Ir al inicio de la página</a>
				</div>";
			}
			
			echo '</section><div class="sombra_seccion"></div>';
			
			
			
			/****************************************************/
			
			
			echo '<section class="seccion">';
		
			$query = "select idConcurso as 'Evaluar/Editar', nombreConcurso as 'Nombre', hashtag as 'Hashtag de Twitter', dificultad as 'Dificultad', categoria as 'Categoria', motivos as 'Motivos de cancelación', usuarioOrganizador as 'Usuario creador' from concurso where status=3";
			
			$resultados = $conexion -> query($query);
			$datos = "";
					
			
			echo "<strong><p style='color: white; text-align:center; font-size:1.7em;'>Concursos cancelados:</p></strong>";
			
			//Convierto el resultado de mi consulta a un arreglo
			if($resultados -> num_rows >= 1){
				//Por cada fila obtengo un arreglo
				while($fila = $resultados -> fetch_assoc())
					$datos[] = $fila;
						
			
			//Recorro mi arreglo para dibujar la tabla
	
			echo "<div style='clear:both;
				background-color: #D5D7C6;
				color: #1739AB;
				font-weight: bold;
				font-size: 1.5em;
				text-align: center;
				border-style: solid;
				margin-top: 20px;
				border-radius:7px;
				-moz-border-radius:7px;
				-webkit-border-radius:7px;'>";
	
			echo "<table border='1' style='text-align:center;'>";
			echo '<caption>Datos de los concursos</caption>';

			//Obtener los titulos
			$fila = $datos[0];
			$titulos = array_keys($fila);
			echo '<thead style="color:black"><tr>';
			foreach($titulos as $th)
			echo '<th>',$th,'</th>';
			echo '</tr></thead>';

			echo '<tbody>';

			//Por cada fila
			foreach($datos as $fila => $arr){
			echo '<tr>';
			//Todos los campos de cada fila
			foreach($arr as $campo => $valor){
				if($campo == 'Evaluar/Editar'){
		
	
			echo '<td>
			<a href="evalConcurso.php?id=',$valor,'">
			<img src="images/edit-eval.jpg" width="48px" height="48px" />
			</a>
			</td>';

	
			}else if($campo == 'Dificultad'){
				if($valor == 1)
						echo '<td>','B&aacutesica','</td>';
				if($valor == 2)
						echo '<td>','Intermedia','</td>';
				if($valor == 3)
						echo '<td>','Alta','</td>';
		
			}
			else if($campo == "Categoria"){
				for($i=0; $i < count($datosCat);$i++){
					if($datosCat[$i]['idCategoria'] == $valor)
						echo '<td>',$datosCat[$i]['nom_Categoria'],'</td>';
				}
			}
			else if($campo == 'Usuario creador'){
				for($i=0; $i < count($datosUsers);$i++){
					if($datosUsers[$i]['idUsuario'] == $valor)
						echo '<td>',$datosUsers[$i]['arrobaUsuario'],'</td>';
				}
			}
			else
			echo '<td>',$valor,'</td>';
			}
			echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';	
	
			echo "</div>
	
			<div style='text-align:center;'><br />
			<a href='#ancla1' style='font-size:1.1 em; font-weight: bold; font-size:1.3em; color:white'>Ir al principio</a>
			</div>";
			
			}
			else{
				echo "<p style='text-align:center;font-weight:bold;font-size:1.3em;'>No hay resultados para mostrar.</p>
				<p style='text-align:center'><img src='images/empty_folder.png' width='128px' height='128px' 
				alt='empty_folder_icon' /></p>";
				echo "<div style='text-align:center;'><br />
				<a href='#ancla1' style='font-size:1.1 em; font-weight: bold; font-size:1.3em; color:white'>Ir al inicio de la página</a>
				</div>";
				}
			
			echo '</section><div class="sombra_seccion"></div>';							
			
			
			
			/****************************************************/
			
			
			echo '<section class="seccion">';
		
			$query = "select idConcurso as 'Evaluar/Editar', nombreConcurso as 'Nombre', hashtag as 'Hashtag de Twitter', dificultad as 'Dificultad', categoria as 'Categoria', fechaDeAlta as 'Fecha de alta', usuarioOrganizador as 'Usuario creador' from concurso where status=2";
			
			$resultados = $conexion -> query($query);
			$datos = "";
			
			echo "<strong><p style='color: white; text-align:center; font-size:1.7em;'>Concursos aceptados:</p></strong>";
			
			//Convierto el resultado de mi consulta a un arreglo
			if($resultados -> num_rows >= 1){
				//Por cada fila obtengo un arreglo
				while($fila = $resultados -> fetch_assoc())
					$datos[] = $fila;
						
			
			//Recorro mi arreglo para dibujar la tabla
	
			echo "<div style='clear:both;
				background-color: #D5D7C6;

				color: #1739AB;

				font-weight: bold;
				font-size: 1.1em;

				text-align: center;
				border-style: solid;

				margin-top: 20px;
				border-radius:7px;

				-moz-border-radius:7px;
				-webkit-border-radius:7px;'>";
	
			echo "<table border='1' style='text-align:center;'>";
			echo '<caption>Datos de los concursos</caption>';

			//Obtener los titulos
			$fila = $datos[0];
			$titulos = array_keys($fila);
			echo '<thead style="color:black"><tr>';
			foreach($titulos as $th)
			echo '<th>',$th,'</th>';
			echo '</tr></thead>';

			echo '<tbody>';

			//Por cada fila
			foreach($datos as $fila => $arr){
			echo '<tr>';
			//Todos los campos de cada fila
			foreach($arr as $campo => $valor){
				if($campo == 'Evaluar/Editar'){
		
	
			echo '<td>
			<a href="evalConcurso.php?id=',$valor,'">

			<img src="images/edit-eval.jpg" width="16px" height="16px" />
			</a>

			</td>';

	
			}else if($campo == 'Dificultad'){
				if($valor == 1)
						echo '<td>','B&aacutesica','</td>';
				if($valor == 2)
						echo '<td>','Intermedia','</td>';
				if($valor == 3)
						echo '<td>','Alta','</td>';
		
			}
			else if($campo == "Categoria"){
				for($i=0; $i < count($datosCat);$i++){
					if($datosCat[$i]['idCategoria'] == $valor)
						echo '<td>',$datosCat[$i]['nom_Categoria'],'</td>';
				}
			}
			else if($campo == 'Usuario creador'){
				for($i=0; $i < count($datosUsers);$i++){
					if($datosUsers[$i]['idUsuario'] == $valor)
						echo '<td>',$datosUsers[$i]['arrobaUsuario'],'</td>';
				}
			}
			else
			echo '<td>',$valor,'</td>';
			}
			echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';	
	
			echo "</div>

	
			<div style='text-align:center;'><br />

			<a href='#ancla1' style='font-size:1.1 em; font-weight: bold; font-size:1.3em; color:white'>Ir al principio</a>
			</div>";
			
			}
			else{
				echo "<p style='text-align:center;font-weight:bold;font-size:1.3em;'>No hay resultados para mostrar.</p>

				<p style='text-align:center'><img src='images/empty_folder.png' width='128px' height='128px' 

				alt='empty_folder_icon' /></p>";
				echo "<div style='text-align:center;'><br />

				<a href='#ancla1' style='font-size:1.1 em; font-weight: bold; font-size:1.3em; color:white'>Ir al inicio de la página</a>
				</div>";
				}
			
			echo '</section><div class="sombra_seccion"></div>';
			
	
			/****************************************************/
			
			
			echo '<section class="seccion">';
		
			$query = "select idConcurso as 'ID Concurso', nombreConcurso as 'Nombre', hashtag as 'Hashtag de Twitter', dificultad as 'Dificultad', categoria as 'Categoria', usuarioGanador as 'Ganador', usuarioOrganizador as 'Usuario creador' from concurso where usuarioGanador != 960498034";
			
			$resultados = $conexion -> query($query);
			$datos = "";					
			
			echo "<strong><p style='color: white; text-align:center; font-size:1.7em;'>Concursos ganados:</p></strong>";
			
			//Convierto el resultado de mi consulta a un arreglo
			if($resultados -> num_rows >= 1){
				//Por cada fila obtengo un arreglo
				while($fila = $resultados -> fetch_assoc())
					$datos[] = $fila;
						
			
			//Recorro mi arreglo para dibujar la tabla
	
			echo "<div style='clear:both;
				background-color: #D5D7C6;
				color: #1739AB;
				font-weight: bold;
				font-size: 1.1em;
				text-align: center;
				border-style: solid;
				margin-top: 20px;
				border-radius:7px;
				-moz-border-radius:7px;
				-webkit-border-radius:7px;'>";
	
			echo "<table border='1' style='text-align:center;'>";
			echo '<caption>Datos de los concursos</caption>';

			//Obtener los titulos
			$fila = $datos[0];
			$titulos = array_keys($fila);
			echo '<thead style="color:black"><tr>';
			foreach($titulos as $th)
			echo '<th>',$th,'</th>';
			echo '</tr></thead>';

			echo '<tbody>';

			//Por cada fila
			foreach($datos as $fila => $arr){
			echo '<tr>';
			//Todos los campos de cada fila
			foreach($arr as $campo => $valor){
			if($campo == 'Dificultad'){
				if($valor == 1)
						echo '<td>','B&aacutesica','</td>';
				if($valor == 2)
						echo '<td>','Intermedia','</td>';
				if($valor == 3)
						echo '<td>','Alta','</td>';
		
			}
			else if($campo == "Categoria"){
				for($i=0; $i < count($datosCat);$i++){
					if($datosCat[$i]['idCategoria'] == $valor)
						echo '<td>',$datosCat[$i]['nom_Categoria'],'</td>';
				}
			}
			else if($campo == 'Usuario creador'){
				for($i=0; $i < count($datosUsers);$i++){
					if($datosUsers[$i]['idUsuario'] == $valor)
						echo '<td>',$datosUsers[$i]['arrobaUsuario'],'</td>';
				}
			}
			else if($campo == 'Ganador'){
				for($i=0; $i < count($datosUsers);$i++){
					if($datosUsers[$i]['usuarioGanador'] == $valor)
						echo '<td>',$datosUsers[$i]['arrobaUsuario'],'</td>';
				}
			}
			else
			echo '<td>',$valor,'</td>';
			}
			echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';	
	
			echo "</div>
	
			<div style='text-align:center;'><br />
			<a href='#ancla1' style='font-size:1.1 em; font-weight: bold; font-size:1.3em; color:white'>Ir al principio</a>
			</div>";
			
			}
			else{
				echo "<p style='text-align:center;font-weight:bold;font-size:1.3em;'>No hay resultados para mostrar.</p>
				<p style='text-align:center'><img src='images/empty_folder.png' width='128px' height='128px' 
				alt='empty_folder_icon' /></p>";
				echo "<div style='text-align:center;'><br />
				<a href='#ancla1' style='font-size:1.1 em; font-weight: bold; font-size:1.3em; color:white'>Ir al inicio de la página</a>
				</div>";
				}
			
			echo '</section><div class="sombra_seccion"></div>';
			
	
			?>
			
			
		
	</article>
	<div class="clear"></div>
	
	
	
	<footer id="paginacion">
		
		<div class="clear"></div>
		
		<?php
			include('php/secciones/copyright.html');
		?>
		
	</footer>
	
</body>

</html>
