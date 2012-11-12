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


//al hacer clic en enviar		
function valida_envia() {
			
	

	//radios dificultad
	var opciones = document.getElementsByName("dificultad");
	var seleccionado = false;
	for(var i=0; i<opciones.length; i++) {	
	  if(opciones[i].checked) {
	    seleccionado = true;
	    ocultaEtiqueta('adv_radio');
	    break;
	  }
	}
 
	if(!seleccionado) {
	  muestraEtiqueta('adv_radio');
	}


	//select categoria
	if (document.getElementById("e1").selectedIndex == 0 ) { 
		muestraEtiqueta("adv_categoria");
	} 
	else
	  ocultaEtiqueta("adv_categoria");




	//CALENDARIOS

	
	// fecha de inicio
	if ($("#datepicker").datepicker("getDate") == null) {
		muestraEtiqueta('adv_fechaInicio');
	} else {
		ocultaEtiqueta('adv_fechaInicio');
		var fechaArr = $("#datepicker").val().split('-');
		var dia = fechaArr[0];
		var mes = fechaArr[1] - 1;//mes = 0 -->enero
		var anio = fechaArr[2];
		var fecha = new Date();
		fecha.setFullYear(anio, mes, dia);
		var fechaActual = new Date();

		var milisegFecha1 = fecha.getTime();
		var milisegFecha2 = fechaActual.getTime();
		var difMiliseg = milisegFecha1 - milisegFecha2;
		var numero_dias = (((difMiliseg / 1000) / 60) / 60) / 24;
		
		//si numero_dias < 0 --> se selecciono una fecha anterior como inicio
		//si numero_dias = 0 --> se selecciono la fecha actual como inicio
		//si numero_dias > 0 --> se selecciono una fecha posterior como inicio	
		console.log(numero_dias);
		 if (numero_dias>0) {
			ocultaEtiqueta("adv_fechaInicioMal");
		} else {
			muestraEtiqueta("adv_fechaInicioMal");
		}
	}	


	// fecha de fin 	
	if ($("#datepicker2").datepicker("getDate") == null) {
		muestraEtiqueta('adv_fechaFin');

	} else {
		
		ocultaEtiqueta('adv_fechaFin');
		
		var fechaArr = $("#datepicker2").val().split('-');
		var dia = fechaArr[0];
		var mes = fechaArr[1]-1;//mes = 0 -->enero
		var anio = fechaArr[2];
		var fecha = new Date();
		fecha.setFullYear(anio, mes, dia);
		var fechaActual = new Date();

		var milisegFecha1 = fecha.getTime();
		var milisegFecha2 = fechaActual.getTime();
		var difMiliseg = milisegFecha1 - milisegFecha2;
		var numero_dias = (((difMiliseg / 1000) / 60) / 60) / 24;
		
		//si numero_dias < 0 --> se selecciono una fecha anterior como fin
		//si numero_dias = 0 --> se selecciono la fecha actual como fin
		//si numero_dias > 0 --> se selecciono una fecha posterior como fin	
		console.log(numero_dias);
		 if (numero_dias>0) {
			ocultaEtiqueta("adv_fechaFinMal");
		} else {
			muestraEtiqueta("adv_fechaFinMal");
		}
	}


	
document.listarConcursos.submit(); 
}
			
	
