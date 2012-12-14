//mostrar etiqueta		
function muestraEtiqueta(id){
	if (document.getElementById){ 
		var elemento = document.getElementById(id); 
		elemento.style.display = 'block';
	}
}

//ocultarEtiqueta
function ocultaEtiqueta(id){
	if (document.getElementById){ 
	  var elemento = document.getElementById(id); 
	  elemento.style.display = 'none';
	}
}


function mostrarRich() {
	document.getElementById('TituloConcurso').style.display = "none";
	document.getElementById('richText').style.display = "block";

}

function valida_envia(idConcurso){
	 //validar editor

		
		document.getElementById('guardarRT').click();
		if (document.getElementById('valorRTE').value == 0) {
			muestraEtiqueta("adv_rteEditor");
			return 0;
		} else {
			ocultaEtiqueta("adv_rteEditor");
			document.getElementById('confirm').click();
			//guardarlo con ajax
			guardarEntrada(idConcurso,document.getElementById('valorRTE').value);
			
		}

}


/* Crea el objeto AJAX. Funcion generica para cualquier utilidad de este tipo*/
function nuevoAjax()
{
	var xmlhttp=false;
	try
	{
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
	try
	{
		// Creacion del objet AJAX para IE
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	catch(E)
	{
		if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
	}
	}
	return xmlhttp;
}


function guardarEntrada(idConcurso,valorRTE){
	//Obtengo del formulario el campo del tipo de usuario
	//para poder hacer la consulta filtrada
	var entrada = valorRTE;
	console.log(entrada);
	console.log(idConcurso);
	var fecha = new Date();
	var fechaActual = (fecha.getDate() + "/" + (fecha.getMonth() +1) + "/" + fecha.getFullYear());

	// Creo el nuevo objeto AJAX
	var ajax=nuevoAjax();

	//Mando a abrir en el servidor el archivo de php que
	//consulta la lista de usuario
	ajax.open("GET", "php/entradaAgregar.php?entrada="+entrada+"&fecha="+fechaActual+"&idConcurso="+idConcurso, true);

	//Acciones para los distintos estados de mi conexión
	//ajax
	ajax.onreadystatechange=function() 
	{ 
		if (ajax.readyState==4)
		{
			
			//document.getElementById("extra").innerHTML = ajax.responseText;
		} 
	}

	ajax.send(null);
}
