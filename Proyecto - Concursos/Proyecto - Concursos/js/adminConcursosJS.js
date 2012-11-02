function acceptContest(){

	document.getElementById("bCancelDec").style.display = "block";


	if(document.getElementById("mensaje_rechazado").style.display == "block"){
		document.getElementById("mensaje_rechazado").style.display="none";
		document.getElementById("bRechazado").style.display="block";
		document.getElementById("textarea").value = "";

		document.getElementById("comments").style.display="none";
		document.getElementById("error_comment").style.display="none";

		document.getElementById("div_r").style.display="none";
		}

	document.getElementById("mensaje_aceptado").style.display="block";
	document.getElementById("bAceptado").style.display="none";
	document.getElementById("comments").style.display = "none";


	var reason = document.getElementById("reason");
	reason.parentNode.removeChild(reason);

}


function cancelContest(){

	if(document.getElementById("div_edit").style.display == "block")
		document.getElementById("div_edit").style.display = "none";

	document.getElementById("bCancelDec").style.display = "block";


	if(document.getElementById("mensaje_aceptado").style.display == "block")
		document.getElementById("mensaje_aceptado").style.display="none"

	document.getElementById("bRechazado").style.display="none";

	document.getElementById("bAceptado").style.display="block";

	document.getElementById("mensaje_rechazado").style.display="block";

	document.getElementById("comments").style.display = "block";

}



function sendReasons(){

	document.getElementById("error_comment").style.display = "none";

	var reasons = document.getElementsByTagName("fieldset");

	var k = 0;
	if(reasons != null)
	for(i in reasons){
		if(reasons[i].id == "reason"){
			k++;
			}
		}

	if(k != 0)
		reasons[0].parentNode.removeChild(reasons[0]);

	if(!(document.getElementById("textarea").value.length <= 10)){

		var fieldset = document.createElement("fieldset");
		fieldset.setAttribute('id','reason');

		var legend = document.createElement("legend");
		var content = document.createTextNode("Razon de rechazo");

		legend.appendChild(content);

		var comment = document.createElement("p");

		var text = document.createTextNode(document.getElementById("textarea").value);

		comment.appendChild(text);

		comment.style.padding = "15px";
		comment.style.backgroundColor = "#BDBDBD";
		comment.style.color = "black";
		comment.style.fontWeight = "600";
		comment.style.whiteSpace = "pre-wrap";
		comment.style.width = "800px";
		comment.style.overflow = "scroll";

		fieldset.appendChild(legend);
		fieldset.appendChild(comment);

		fieldset.style.padding = "10px";

		var div = document.getElementById("div_r");
		div.appendChild(fieldset);
		div.style.marginTop = "20px";

		document.getElementById("comments").style.display = "none";
		document.getElementById("div_r").style.display="block";
	}
	else{
		document.getElementById("error_comment").style.display = "block";
	}

}



var cancel;
var bID = 0;

function cancelDecision(){

	document.getElementById("bCancelDec").style.display = "none";

	if(document.getElementById("mensaje_aceptado").style.display == "block"){
		document.getElementById("mensaje_aceptado").style.display = "none";
		document.getElementById("bAceptado").style.display = "block";
		}
	else	
		if(document.getElementById("mensaje_rechazado").style.display == "block"){
			document.getElementById("textarea").value = "";
			document.getElementById("comments").style.display = "none";
			document.getElementById("mensaje_rechazado").style.display = "none";
			document.getElementById("div_r").style.display = "none";
			document.getElementById("bRechazado").style.display = "block";
			}
		else
			if(document.getElementById("comments").style.display == "block"){
				document.getElementById("comments").style.display = "none";

				}

		if(document.getElementById("div_edit").style.display == "block"){
			document.getElementById("div_edit").style.display = "none";
			var del = document.getElementById("bID"+bID);
			del.parentNode.removeChild(del.previousSibling);
			del.parentNode.removeChild(del);
			cancel = true;
			}

}

function cancelEdit(){

	if(document.getElementById("div_edit").style.display == "block"){
			document.getElementById("div_edit").style.display = "none";
			var del = document.getElementById("bID"+bID);
			del.parentNode.removeChild(del.previousSibling);
			del.parentNode.removeChild(del);
			cancel = true;

			var del = document.getElementById("bCancelDec");
			del.style.display = "none";

			}

}





function editContest(){

	if(document.getElementById("div_edit").style.display != "block"){

	document.getElementById("bCancelDec").style.display = "block";


	document.getElementById("div_edit").style.display = "block";

	document.getElementById("inNombre").value = document.getElementById("concurso_name").innerHTML;

	document.getElementById("user").value = document.getElementById("pEnvia").innerHTML;

	document.getElementById("field_hashtag").value = document.getElementById("pHash").innerHTML;

	//document.getElementById("content_area").value = document.getElementById("pCont").innerHTML;

	var optText = document.getElementById("pCat").innerHTML;
	var arrayOpt = document.getElementsByTagName("option");

	for(i in arrayOpt){
		if(arrayOpt[i].innerHTML == optText){
			//arrayOpt[i].setAttribute('selected','selected');

			var cat = document.createTextNode(optText);
			var opt = document.createElement("option");

			opt.appendChild(cat);
			opt.setAttribute('value',arrayOpt[i].value);
			//opt.setAttribute('selected', 'selected')

			var list = document.getElementById("e1");
			list.appendChild(opt);

			arrayOpt[i].parentNode.removeChild(arrayOpt[i]);			
			break;
			}
	}


	var div_imgs = document.getElementById("images");
	var p = document.createElement("p");
	var imgs = document.getElementsByTagName("img");
	var nameImg, bDelete;

	if(imgs != null){
		for(i in imgs){
			if(imgs[i].id == "img1"){
				nameImg = document.createTextNode(imgs[i].getAttribute('src'));
				p.appendChild(nameImg);
				div_imgs.appendChild(p);

				bDelete = document.createElement("input");
				bDelete.setAttribute('type','button');
				bDelete.setAttribute('id','bID' + (++bID));
				bDelete.setAttribute('value','Borrar');
				bDelete.setAttribute('onClick','deleteImage()');
				div_imgs.appendChild(bDelete);
			}
		}
	}

	}
}




function deleteImage(){

	var button = document.getElementById(bID);
	var imgs = document.getElementsByTagName("img");

	for(i in imgs){
		if(button.previousSibling.innerHTML == imgs[i].getAttribute('src')){
			imgs[i].parentNode.removeChild(imgs[i]);
			button.parentNode.removeChild(button.previousSibling);
			button.parentNode.removeChild(button);
			}
	}

}




function makeChanges(){

	document.getElementById("error_nombre").style.display="none";
	document.getElementById("error_hashtag").style.display="none";
	document.getElementById("error_categoria").style.display="none";
	document.getElementById("error_dificultad").style.display="none";
	document.getElementById("error_imagen").style.display="none";
	document.getElementById("error_otraimg").style.display="none";
	//document.getElementById("error_contenido").style.display="none";
	document.getElementById("error_fechaAct").style.display="none";
	document.getElementById("error_fechasIF").style.display="none";
	document.getElementById("error_fechasIC").style.display="none";
	document.getElementById("error_fechas").style.display="none";

	var flag = true, flag2 = true, flag3 = true;


	var expresion = new RegExp(/([a-zA-Z]\w*){5,20}/);

		if(!expresion.test(document.form_edit.inNombre.value) || document.form_edit.inNombre.value.length == 0){
			document.getElementById("error_nombre").style.display='block';
			document.form_edit.inNombre.focus();
			return 0;
		}

	expresion = new RegExp(/#([a-zA-Z]\w*){5,20}/);

		if(!expresion.test(document.form_edit.field_hashtag.value) || document.form_edit.field_hashtag.value.length == 0){
			document.getElementById("error_hashtag").style.display='block';
			document.form_edit.field_hashtag.focus();
			return 0;
		}

	if(document.getElementById("e1").selectedIndex == 0 ){
		document.getElementById("error_categoria").style.display='block';
		document.form_edit.e1.focus();
		return 0;
	}

	if(!(document.form_edit.dificultad[0].checked || document.form_edit.dificultad[1].checked || document.form_edit.dificultad[2].checked)){
		document.getElementById("error_dificultad").style.display='block';
		document.form_edit.dificultad[0].focus();
		return 0;
	}

	var extensiones_permitidas = new Array(".jpg", ".gif", ".png", ".bmp", ".raw", ".psd", ".tiff", ".xcf", ".eps", ".pcx", ".pict", ".dng", ".wmp", ".psb", ".jp2", ".tga", ".tif", ".pic", ".emf", ".ico"); 

	var extension = (document.form_edit.imagen1.value.substring(document.form_edit.imagen1.value.lastIndexOf("."))).toLowerCase(); 

	var permitida = false; 
 
	for (var i = 0; i < extensiones_permitidas.length; i++) 
         	if (extensiones_permitidas[i] == extension) { 
         	permitida = true; 
         	break; 
         	}
 
	if(document.form_edit.imagen1.value == "" || permitida != true){
		document.getElementById("error_imagen").style.display='block';
		document.form_edit.imagen1.focus();
		return 0;
		}

	var imgs = document.getElementsByTagName("input"); 


	for(i in imgs){
		
		permitida = false;
		
		if(imgs[i].type == "file" && imgs[i].id != 'imagen1'){
		
		extension = (imgs[i].value.substring(imgs[i].value.lastIndexOf("."))).toLowerCase();
		
			if(imgs[i].value == ""){
				document.getElementById("error_otraimg").style.display='block';
				return 0;
			}
			
			for (i = 0; i < extensiones_permitidas.length; i++) 
         		if (extensiones_permitidas[i] == extension) { 
         		permitida = true; 
				//document.getElementById("error_otraimg").style.display='block';
				break;
         	}

			if(permitida != true){
				document.getElementById("error_otraimg").style.display='block';
				return 0;
			}
		}
	}

	/*if(document.form_edit.content_area.value == ""){
		document.getElementById("error_contenido").style.display='block';
		document.form_edit.content_area.focus();
		return 0;
		}*/


	/*Validación de fechas*/

	if(document.getElementById("datepicker").value == ""){
		document.getElementById("error_fechas").style.display='block';
		document.form_edit.datepicker.focus();
		return 0;
	}

	if(document.getElementById("datepicker2").value == ""){
		document.getElementById("error_fechas").style.display='block';
		document.form_edit.datepicker2.focus();
		return 0;
	}


	var fecha_inic = document.getElementById("datepicker").value;
	var fecha_fin = document.getElementById("datepicker2").value;
	var fecha_crea = document.getElementById("fcreacion").value;

	var arrayi = fecha_inic.split("-");
	var arrayf = fecha_fin.split("-");
	var arrayc = fecha_crea.split("-");

	var fecha_actual = new Date();
	var dia = fecha_actual.getDate();
	var mes = fecha_actual.getMonth() + 1;
	var anio = fecha_actual.getFullYear();

	if(parseInt(arrayi[2],10) < anio)
		flag = false;
	else if(parseInt(arrayi[2],10) == anio)
			if(parseInt(arrayi[1],10) < mes)
				flag = false;
			else if(parseInt(arrayi[1],10) == mes)
					if(parseInt(arrayi[0],10) < dia)
						flag = false;

	if(flag == false){
		document.getElementById("error_fechaAct").style.display='block';
		return 0;
	}

	if(flag == true){

		if(parseInt(arrayf[2],10) < parseInt(arrayi[2],10))
			flag2 = false;
		else if(parseInt(arrayf[2],10) == parseInt(arrayi[2],10))
				if(parseInt(arrayf[1],10) < parseInt(arrayi[1],10))
					flag2 = false;
				else if(parseInt(arrayf[1],10) == parseInt(arrayi[1],10))
						if(parseInt(arrayf[0],10) <= parseInt(arrayi[0],10))
							flag2 = false;

	}

	if(flag2 == false){
		document.getElementById("error_fechasIF").style.display='block';
		return 0;
	}

	if(flag2 == true){

		if(parseInt(arrayi[2],10) < parseInt(arrayc[2],10))
			flag3 = false;
		else if(parseInt(arrayi[2],10) == parseInt(arrayc[2],10))
				if(parseInt(arrayi[1],10) < parseInt(arrayc[1],10))
					flag3 = false;
				else if(parseInt(arrayi[1],10) == parseInt(arrayc[1],10))
						if(parseInt(arrayi[0],10) <= parseInt(arrayc[0],10))
							flag3 = false;

	}

	if(flag3 == false){
		document.getElementById("error_fechasIC").style.display='block';
		return 0;
	}




	var text = document.createTextNode(document.getElementById("inNombre").value);
	var name = document.getElementById("concurso_name");
	name.parentNode.removeChild(name);

	var node = document.createElement("p");
	node.setAttribute('id','concurso_name');
	node.appendChild(text);

	document.getElementById("div_name").appendChild(node);

	/******************/

	text = document.createTextNode(document.getElementById("field_hashtag").value);
	name = document.getElementById("pHash");
	name.parentNode.removeChild(name);

	node = document.createElement("p");
	node.setAttribute('id','pHash');
	node.appendChild(text);

	document.getElementById("hashtag").appendChild(node);

	/******************/

	text = document.createTextNode(document.getElementById("e1")[document.getElementById("e1").selectedIndex].innerHTML);
	name = document.getElementById("pCat");
	name.parentNode.removeChild(name);

	node = document.createElement("p");
	node.setAttribute('id','pCat');
	node.appendChild(text);

	document.getElementById("div_cat").appendChild(node);

	/******************/

	text = document.createTextNode(document.getElementById("e1")[document.getElementById("e1").selectedIndex].innerHTML);
	name = document.getElementById("pDif");
	name.parentNode.removeChild(name);

	node = document.createElement("p");
	node.setAttribute('id','pDif');
	node.appendChild(text);

	document.getElementById("div_dif").appendChild(node);

	/******************/

	/*text = document.createTextNode(document.getElementById("content_area").value);
	name = document.getElementById("pCont");
	name.parentNode.removeChild(name);
	
	node = document.createElement("p");
	node.setAttribute('id','pCont');
	node.appendChild(text);
	
	document.getElementById("div_content").appendChild(node);*/

	/******************/

	text = document.createTextNode(document.getElementById("datepicker").value);
	name = document.getElementById("pFinic");
	name.parentNode.removeChild(name);

	node = document.createElement("p");
	node.setAttribute('id','pFinic');
	node.appendChild(text);

	document.getElementById("div_Finic").appendChild(node);

	/******************/

	text = document.createTextNode(document.getElementById("datepicker2").value);
	name = document.getElementById("pFfin");
	name.parentNode.removeChild(name);

	node = document.createElement("p");
	node.setAttribute('id','pFfin');
	node.appendChild(text);

	document.getElementById("div_Ffin").appendChild(node);

	/******************/

	document.getElementById("div_edit").style.display = "none";
	document.getElementById("div_editado").style.display = "block";

}



var listValue = 18;

function addCategory(){

	document.getElementById("error_nueva_categoria").style.display="none";

	var expresion = new RegExp(/([a-zA-Z.*+-_:;=&#$@|?%!°<>{}]\w*){1,20}/);

	if(!expresion.test(document.form_edit.new_cat.value) || document.form_edit.new_cat.value.length == 0  || document.form_edit.new_cat.value.length > 20){
			document.getElementById("error_nueva_categoria").style.display='block';
			document.form_edit.new_cat.focus();
			return 0;
		}


	var text = document.getElementById("new_cat").value;

	var arrayOpt = document.getElementsByTagName("option");
	var flag = false;

	for(i in arrayOpt){
		if(arrayOpt[i].innerHTML == text)
			flag = true;
	}

	if(flag == false){
		var cat = document.createTextNode(text);
		var opt = document.createElement("option");
		opt.appendChild(cat);
		opt.setAttribute('value',++listValue);
		opt.setAttribute('selected', 'selected')

		var list = document.getElementById("e1");
		list.appendChild(opt);
		document.getElementById("new_cat").value = "";
	}
	else{
		document.getElementById("error_nueva_categoria").style.display='block';
		document.form_edit.new_cat.focus();
		flag = false;
		return 0;
	}	


}



var imgID = 1;

function otherImage(){

	var label = document.createElement("label");
	var text = document.createTextNode("Otra imagen: ");
	label.appendChild(text);

	var file = document.createElement("input");
	file.setAttribute('type','file');
	++imgID;
	file.setAttribute('id',"imagen" +imgID);
	file.setAttribute('accept','image/*');

	var br = document.createElement("br");

	var bimg = document.getElementById("botra_img");
	bimg.parentNode.insertBefore(label, bimg);
	bimg.parentNode.insertBefore(br, label);
	bimg.parentNode.insertBefore(br, label);
	bimg.parentNode.insertBefore(file, br);


	var bdelete = document.createElement("input");
	bdelete.setAttribute('type','button');
	bdelete.setAttribute('id',"delete");
	bdelete.setAttribute('value','Eliminar campo');
	bdelete.setAttribute('onClick','deleteField($(this))');

	bimg.parentNode.insertBefore(bdelete, file);

}


function deleteField(obj){

	obj.prev().remove();
	obj.next().remove();
	obj.next().remove();
	obj.remove();

}
