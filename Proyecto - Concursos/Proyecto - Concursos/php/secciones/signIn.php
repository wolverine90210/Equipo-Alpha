<?php
 	  
	  require 'tmh/tmhOAuth.php';
	  require 'tmh/tmhUtilities.php';
	  
	  require_once('keys.inc');

	  if ( !isset($_SESSION['access_token']) ):?>
	 	<link href="css/auth-buttons.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript">$('#loginButton').show();</script>
		<script type="text/javascript">
			$(document).ready(function(e){
			$('#enviar1').show();
			});
		</script>
		
	  <? else: ?>	  	
		<script type="text/javascript">
			$(document).ready(function(e){
			$('#enviar2').show();
			});
		</script>
		<link href="css/auth-buttons.css" type="text/css" rel="stylesheet" />
		<div style="background-image: url('images/grey_background.jpg'); margin-top:11px; height: 48px; width: 100%; border-radius:5px;
		-moz-border-radius:5px;	-webkit-border-radius:5px; position: relative;">
			<img src="<?=$_SESSION['access_token']['avatar']?>"/>
			<div style="position: absolute; top:30%; left:7%; color: white;">
			<strong>Bienvenid@ <?= $_SESSION['access_token']['name'] ?> 
			(<a id="twitter-user" target="_blank"href="https://twitter.com/<?=$_SESSION['access_token']['screen_name']?>">@<?=
			$_SESSION['access_token']['screen_name'] ?></a>)</strong>
			</div>
			<script type="text/javascript">
				$('#twitter-user').css('cursor','pointer');
				$('#twitter-user').css('color','white');
				$('#twitter-user').css("text-decoration","none");
				$('#twitter-user').mouseover(function(){$("#twitter-user").css("color","#90D1ED");});
				$('#twitter-user').mouseout(function(){$("#twitter-user").css("color","white");});
			</script>
			<div style="position: absolute; top:25%; right:1%;">
			<a class="btn-auth btn-twitter" href="loginWithTwitter.php?wipe=1" style="position: absolute; top:25%; right:1%;">Cerrar sesi&oacuten</a>
			</div>			
		</div>
		
		<?php
		
		if($_SESSION['access_token']['id'] == 960498032 || $_SESSION['access_token']['id'] == 984327331 || 
		$_SESSION['access_token']['id'] == 302412674 || $_SESSION['access_token']['id'] == 199881655){
			echo "<script type='text/javascript'>$(document).ready(function(e){ $('#adminButton').show();
			$('#accountButton').show();});</script>";				
			}
		
		//Nos conectamos a la base de datos y obtenemos el usuario
		require_once('php/bd.inc');
		$conexion = new mysqli($dbhost, $dbuser, $dbpass, $db);

		if($conexion->connect_error){

			die("Por el momento no se puede acceder al gestor de la BD");

		}
		
		$idUsuario = $_SESSION['access_token']['id'];
		$arrobaUsuario = '@'.$_SESSION['access_token']['screen_name'];
		$avatar = $_SESSION['access_token']['avatar'];
		
		//echo $_SESSION['access_token']['id'].$_SESSION['access_token']['screen_name'];
		
		if($idUsuario == 960498032 || $idUsuario == 984327331 || $idUsuario == 302412674 || $idUsuario == 199881655)
			$query = "insert into usuario values($idUsuario, '$arrobaUsuario', 0, '$avatar')";
			else $query = "insert into usuario values($idUsuario, '$arrobaUsuario', 1, '$avatar')";
		
		$conexion -> query($query);
		
		$conexion -> close();
	
		
		?>
	  <? endif;


	  if ( isset($_SESSION['access_token']) && isset($_REQUEST['tuit']) ):
	    $tmhOAuth->config['user_token'] = $_SESSION['access_token']['oauth_token'];
	    $tmhOAuth->config['user_secret'] = $_SESSION['access_token']['oauth_token_secret'];
	    

	    $code = $tmhOAuth->request('POST', $tmhOAuth->url('1/statuses/update'), array(
		'status' => '¡Hola Twitter¡ Enviando desde Equipo-Alpha Concursos.'
	    ));

	    if ($code == 200) {
		tmhUtilities::pr(json_decode($tmhOAuth->response['response']));
	    } else {
		tmhUtilities::pr($tmhOAuth->response['response']);
	    }
	  endif;
