<html>
<head>
	<title>Pagina</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script language="javascript" type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<link href="css/pagination.css" type="text/css" rel="stylesheet" />

</head>
<body>

<script type="text/javascript">
	$(document).ready(function() {    
    	$("#paginar").live("click", function(){
		$("#contenido").html("<div align='center'><img src='images/cargando.gif'/></div>");
			var pagina=$(this).attr("data");
			var cadena="pagina="+pagina+"&idConcurso="+22;

			$.ajax({
            			type:"GET",
            			url:"php/paginacionEntradas.php",
            			data:cadena,
            			success:function(data)
            			{
                				$("#contenido").fadeIn(1000).html(data);
            			}
        			});
    		});
	});  
</script>

<div id="contenido"><?php require("php/paginacionEntradas.php"); ?></div>

</body>
</html>