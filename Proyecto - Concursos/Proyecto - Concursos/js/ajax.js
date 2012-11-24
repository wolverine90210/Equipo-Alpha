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




function checkStatus(){

	//Obtengo del formulario el campo del tipo de usuario para poder hacer la consulta filtrada
	var nombreCon = document.getElementById("nombreCon").value;

	// Creo el nuevo objeto AJAX
	var ajax = nuevoAjax();

	//Mando a abrir en el servidor el archivo de php que consulta la lista de usuario
	ajax.open("GET", "php/evaluarConcurso.php?nombreCon="+nombreCon, true);

	//Acciones para los distintos estados de mi conexión ajax
	ajax.onreadystatechange=function()
	{
	if (ajax.readyState == 4){
	
		if(ajax.responseText == "1")
			document.getElementById("fpendiente").style.display = 'block';
		if(ajax.responseText == "2")
			document.getElementById("faceptado").style.display = 'block';
		if(ajax.responseText == "3")
			document.getElementById("fcancelado").style.display = 'block';
			
	document.getElementById("botonEval").style.display = 'none';
	
	}
	}

	ajax.send(null);
}




function fillSelect(){

	var selectLangs = document.getElementById("e1");
	
	var ajax = nuevoAjax();
	
	ajax.open("GET", "php/fillSelectLangs.php?="+selectLangs, true); 
	
	ajax.onreadystatechange=function(){
	
		if(ajax.readyState == 4){
			document.getElementById("catego").outerHTML = ajax.responseText;
			document.getElementById("sel").style.display = "none";
		}
	}

	ajax.send(null);
}




function addCat(){

	var new_cat = document.getElementById("new_cat").value;
	
	if(document.getElementById("error_nueva_categoria").style.display == "block")
	document.getElementById("error_nueva_categoria").style.display="none";

	var expresion = new RegExp(/(^[a-zA-Z]\w*){1,20}/);

	if(!expresion.test(new_cat) || new_cat.length == 0  || 
	new_cat.length > 20){
			document.getElementById("error_nueva_categoria").style.display='block';
			document.form_edit.new_cat.focus();
			return 0;
		}

	
	var ajax = nuevoAjax();
	
	ajax.open("GET", "php/addCategory.php?new_cat="+new_cat, true);
	
	ajax.onreadystatechange = function(){
		
		if(ajax.readyState == 4){
		
			if(ajax.responseText == "Wrong"){
				document.getElementById("error_nueva_categoria").style.display = "block";
				}
				else if(ajax.responseText == "Right"){
					if(document.getElementById("error_nueva_categoria").style.display == "block")
					document.getElementById("error_nueva_categoria").style.display = "none";
					
					var select = document.getElementById("e1");
					var text = document.getElementById("new_cat").value;
					var cat = document.createTextNode(text);
					var opt = document.createElement("option");
					opt.appendChild(cat);
					select.appendChild(opt);					
					
					document.getElementById("new_cat").value = "";
				}
		}
	}
	
	ajax.send(null);

}

