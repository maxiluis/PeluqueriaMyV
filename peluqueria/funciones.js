function saludo(){
	alert("Hola");
}
function agregarItem(){

 
 	
 	var fila = document.createElement('tr');
 	//NODO tratamiento
 	
 	var tratamiento = document.createElement('td');
 	var texTratamiento = document.createTextNode(document.formulario.tratamiento.value);
 	tratamiento.appendChild(texTratamiento);
 	
 	alert(document.formulario.precio.value);
 	//NODO PRECIO
 	
 	var precio= document.createElement('td');
 	var textPrecio = document.createTextNode(document.formulario.precio.value);
 	precio.appendChild(textPrecio);
 	
 	//NODO DESCRIPCION
 	
 	var desc= document.createElement('td');
 	if(document.formulario.descripcion.value ==0){
 		var textDesc = document.createTextNode("Sin Descripcion");
 	}
 	else{
 		var textDesc = document.createTextNode(document.formulario.descripcion.value);
 	}
 	
 	desc.appendChild(textDesc);
 	
 	//Agrego al TD
 	
 	//
 	fila.appendChild(tratamiento);
 	fila.appendChild(precio);
 	fila.appendChild(desc);
 
 	
 	var obj=document.getElementById('items');
 	obj.appendChild(fila);
 	
 	//document.getElementById('campoDeshabilitado').value = suma();
 	/*var tratamiento = "Tratamiento: "+document.formulario.tratamiento.value;
 	var precio = "Precio: "+document.formulario.precio.value;
 	var descripcion = "Descripcion: "+document.formulario.descripcion.value;
 	var full = tratamiento+precio+descripcion;
 	var elemento=document.createElement('p'); 
  	var texto=document.createTextNode(full);
  	elemento.appendChild(texto);
  	var obj=document.getElementById('items');
  	obj.appendChild(elemento);*/
 }
 

function justNumbers(e) {
	var keynum = window.event ? window.event.keyCode : e.which;
	if ( keynum == 8 ) return true;
		return /\d/.test(String.fromCharCode(keynum));
}
function suma(){
	var arrID = document.getElementById("Tratamiento");
	var total = 0;
	
	for(var i=0;i<arrID.length;i++){
		
		alert(arrID[i].content.innerHTML);
	}
	
} 
