//Agregar inputs para subir mas imagenes
			
contador = 1;
function crearCampos(obj) {
	contador++;
	field = document.getElementById('campoField');
	elementoContenedor = document.createElement('div');
	elementoContenedor.id = 'div' + contador;
	field.appendChild(elementoContenedor);

	//crea una etiqueta no visible de error
	//por cada input de imagen que se agregue
	elementoEtiqueta = document.createElement('label' + contador);
	elementoEtiqueta.name = 'adv_imagen' + contador;
	elementoEtiqueta.id = 'adv_imagen' + contador;
	elementoEtiqueta.className = 'div_error';
	elementoEtiqueta.style.display = 'none';
	var texto = document.createTextNode("Suba una archivo de imagen");
	elementoEtiqueta.appendChild(texto);
	elementoContenedor.appendChild(elementoEtiqueta);

	//labels para los input de nueva imagen

	elementoEtiqueta = document.createElement('label');
	elementoEtiqueta.className = 'subtitulos';
	texto = document.createTextNode("Imagen # " + contador + " ");
	elementoEtiqueta.appendChild(texto);
	elementoContenedor.appendChild(elementoEtiqueta);

	//su respectivo boton para agregarla
	elementoBoton = document.createElement('input');
	elementoBoton.id = 'imagenUp'+contador;
	elementoBoton.type = 'file';
	elementoBoton.value = 'Agregar otra Imagen';
	elementoBoton.setAttribute('accept','image/*');
	elementoBoton.name = 'boton' + contador;
	elementoContenedor.appendChild(elementoBoton);

	//su respectivo boton para borrarlo
	elementoBoton = document.createElement('input');
	elementoBoton.type = 'button';
	elementoBoton.value = 'borrar';
	elementoBoton.name = 'div' + contador;
	elementoBoton.onclick = function() {
		borrarCampo(this.name)

	}
	elementoContenedor.appendChild(elementoBoton);
}

function borrarCampo(obj) {
	field = document.getElementById('campoField');
	field.removeChild(document.getElementById(obj));
	contador--;
}

function borrarResultados(){
	
}

function agregarResultados(datosEditor) {

	field = document.getElementById('richText');
	elementoContenedor = document.createElement('div');
	elementoContenedor.id = 'div' + contador;
	elementoContenedor.style.background = 'red';
	elementoContenedor.style.width = '774px';
	elementoContenedor.style.height = '286px';
	elementoContenedor = document.createElement('pre');
	var texto = document.createTextNode(datosEditor);
	elementoEtiqueta.appendChild(texto);
	field.appendChild(elementoContenedor); 

}
	




//borrar todas las etiquetas
function clearAll(){
	//adv -> advertencia
	ocultaEtiqueta('adv_nombre');
	ocultaEtiqueta('adv_radio');
	ocultaEtiqueta('adv_hashtag');
	ocultaEtiqueta('adv_categoria');
	ocultaEtiqueta('adv_fechaInicio');
	ocultaEtiqueta('adv_fechaFin');
	ocultaEtiqueta('adv_fechaInicioMal');
	ocultaEtiqueta('adv_fechaFinMal');
	ocultaEtiqueta('adv_imagen');
	ocultarEtiqueta('adv_rteEditor');
}
		
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

function dameFechaActual(){
	return new Date();
}



//al hacer clic en enviar		
function valida_envia() {
			
	//nombre del concurso
	if(document.addConcurso.nombreConcurso.value.length ==' ' || !/([a-zA-Z]\w*){5,20}/.test(document.addConcurso.nombreConcurso.value)){
		muestraEtiqueta('adv_nombre');
	}
	else{
		ocultaEtiqueta('adv_nombre');
	}
	
	
	//hashtag twitter
	if(document.addConcurso.hashTwitter.value.length ==' ' || !/([#a-zA-Z]\w*){5,20}/.test(document.addConcurso.hashTwitter.value)){
		muestraEtiqueta('adv_hashtag');
	}
	else{
		ocultaEtiqueta('adv_hashtag');
	}

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

	//Asignar fecha de creacion
	
	document.getElementById('datepicker3').value = dameFechaActual();
	
	
	
	
	//input file
	
	var extensiones_permitidas = new Array(".gif", ".jpg", ".png", ".bmp",".dib",".tga",".tif",".tiff",".pcx",".pic",".emf",".ico",".raw",".xcf",".eps",".pcx",".wmp",".jp2");

//validar todos los campos de imagen generados
	
	var inputsImage = document.getElementsByTagName("input");
	var extension;
	var imgPermitida = false;
	var numero_para_etiqueta = 0;

		for(elemento in inputsImage){
			if(inputsImage[elemento].type == "file"){
				numero_para_etiqueta =inputsImage[elemento].id.substring(8,inputsImage[elemento].length);
				extension = (inputsImage[elemento].value.substring(inputsImage[elemento].value.lastIndexOf("."))).toLowerCase();
				for(var i=0; i<extensiones_permitidas.length; i++){
					if(extensiones_permitidas[i] == extension){
						imgPermitida = true;
						break;
					}
				}
				if(inputsImage[elemento].value == 0 || imgPermitida == false)
					muestraEtiqueta("adv_imagen"+numero_para_etiqueta);
				else{
					imgPermitida = false;
					ocultaEtiqueta("adv_imagen"+numero_para_etiqueta);
				}
			}
		}
		
 //validar editor
 document.RTEDemo.rte1.value;
 
 if (document.RTEDemo.rte1.value.length == 0) {
		muestraEtiqueta("adv_rteEditor");
		return 0;
	} else {
		ocultaEtiqueta("adv_rteEditor");
	}

document.addConcurso.submit(); 
}
			
	