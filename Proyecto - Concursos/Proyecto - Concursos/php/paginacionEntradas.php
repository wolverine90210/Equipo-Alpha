<?php
require('bd.inc');
include("funciones.php");
$idConcurso = $_REQUEST['id'];

$con = mysql_connect($dbhost, $dbuser, $dbpass); 
mysql_select_db($db, $con) or die ("Verifique la Base de Datos");
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
echo "<table>";
echo '<thead><tr>';
while($MostrarFila=mysql_fetch_array($Resultado)){
echo '<th> </th>';
echo '</tr></thead>';
echo '<tbody>';
echo '<tr>';
	$fecha = $MostrarFila['fechaDeEnvio'];
	date_default_timezone_set('UTC');
	$fechaNueva = date('d-m-Y', strtotime($fecha));
	$descripcion = $MostrarFila['descripEntrada'];
	$usuarioId = $MostrarFila['usuario_IdUsuario'];
	$arroba = dameArrobaDeUsuario($usuarioId);
	$avatar = dameAvatarDeUsuario($usuarioId);
	echo '</td>';
echo 
					"<section class=\"seccion-g\">
	    				<a href=\"https://twitter.com/$arroba\" target=\"_blank\" class=\"aroba\">$arroba</a>  
						<div class=\"fechaEnvio\"><p class=\"tituloEnvio\">Enviado:</p><a href=\"http://alanturing.cucei.udg.mx/equipo-alpha/calendario.php\" > $fechaNueva</a></div>
	    				<p class=\"imageDeAroba\"><img  src=\"$avatar\" alt=\"Poster\" width=\"80\" height=\"80\"/></p>  
						<p class=\"comentarioEntrada\">$descripcion</p>             
   					</section></td>" ;
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
?>