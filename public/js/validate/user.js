$(document).ready(function(){

	$("#validate_user").click(function(e){
		var a = 0;
		//validando el select multiple
		a = number_tabs(".val_permisos") + a ;

		a = campo_requerido(".val_username") + a;
		a = rango_texto(".val_username",6,30) + a;
		a = es_alfanumerico_sin_espacio(".val_username") + a;

		//si se encontro algún error no proceder a registrar
		if( a > 0){ 
			e.preventDefault();
		}
	});

	$("#validate_trabajador").click(function(e){
		var a = 0;

		a = campo_requerido(".val_dni") +a ;
		a = es_integer(".val_dni") + a;
		a = rango_texto(".val_dni",8,8) +a ;

		a = campo_requerido(".val_nombre") +a ;
		a = rango_texto(".val_nombre",10,50) +a ;
		a = es_string_espacio(".val_nombre") +a ;

		a = campo_requerido(".val_apellido") +a ;
		a = rango_texto(".val_apellido",10,50) +a ;
		a = es_string_espacio(".val_apellido") +a ;

		a = val_seleccion(".val_sexo") + a;

		a = campo_requerido(".val_direccion") +a ;
		a = rango_texto(".val_direccion",10,100) +a ;

		a = campo_requerido(".val_referencia") +a ;
		a = rango_texto(".val_referencia",10,50) +a ;

		a = campo_requerido(".val_tel_fijo") +a ;
		a = rango_texto(".val_tel_fijo",5,20) +a ;

		a = campo_requerido(".val_tel_movil") +a ;
		a = rango_texto(".val_tel_movil",5,20) +a ;

		a = val_correo(".val_correo_personal") + a;



		
		//si se encontro algún error no proceder a registrar
		if( a > 0){
			alerta = '<div class=\'error_mensaje\'>Verifique formulario! </div>';
			$(".btn_verificando").html(alerta);
			e.preventDefault();

		}

	});

	//validando categorias 
	$("#validate_categoria").click(function(e){
		var a = 0;
		a = campo_requerido(".val_nombreCategoria") +a ;
		a = es_alfanumerico(".val_nombreCategoria") +a ;
		
		if( a > 0){ 
			e.preventDefault();
		}
	});

	//validando categorias 
	$("#validate_subcategoria").click(function(e){
		var a = 0;
		a = campo_requerido(".val_nombreCategoria") +a ;
		a = es_alfanumerico(".val_nombreCategoria") +a ;
		a = val_seleccion(".val_selectcategoria") + a;

		
		if( a > 0){ 
			e.preventDefault();
		}
	});


	limpiar();

})


//function para validar campos con un minimo de caracteres
function campo_requerido(class_val){
	if($(class_val + "> .error_mensaje").length == 1) return 1;
	    var value = $(class_val + " input").val();
	   	if(value.length==0){
			html='<div class=\'error_mensaje\'>El campo es requerido </div>';
			$(class_val + " input").css('border','1px solid red');
			$(class_val).append(html);
			return 1;	   		
	   	}else{
	   		return 0;
	   	}
}

//función para validar el select multiple
function number_tabs(class_val){
		if($(class_val + "> .error_mensaje").length == 1) return 1;
		var cantidad_tabs = $(".select2-selection__choice").length;
		if( cantidad_tabs == 0 ){
			html='<div class=\'error_mensaje\'>Nesecita agregar un permiso como minimo</div>';
			$(".select2-selection--multiple").css('border','1px solid red');
			$(class_val).append(html);
			return 1;
		}else{
			return 0;
		}
}
//function para validar campos con un minimo de caracteres
function rango_texto(class_val,min,max){
	if($(class_val + "> .error_mensaje").length == 1) return 1;
	    var value = $(class_val + " input").val();
	   	if(value.length<min || value.length>max){
			html='<div class=\'error_mensaje\'>El numero de caracteres no es valido </div>';
			$(class_val + " input").css('border','1px solid red');
			$(class_val).append(html);
			return 1;	   		
	   	}else{
	   		return 0;
	   	}
}


// solo letras y numeros 
function es_alfanumerico(class_val) {
	if($(class_val + "> .error_mensaje").length == 1) return 1;
	var value = $(class_val + " input").val();
	if(/^[0-9a-zA-Z_ ]+$/.test(value)){
		return 0;
	}else{
		html='<div class=\'error_mensaje\'>Los caracteres no son validos </div>';
		$(class_val + " input").css('border','1px solid red');
		$(class_val).append(html);
		return 1;
	}
}

// solo letras y numeros 
function es_alfanumerico_sin_espacio(class_val) {
	if($(class_val + "> .error_mensaje").length == 1) return 1;
	var value = $(class_val + " input").val();
	if(/^[a-zA-Z][a-zA-Z0-9]*[._-]?[a-zA-Z0-9]+$/.test(value)){
		return 0;
	}else{
		html='<div class=\'error_mensaje\'>Los caracteres no son validos </div>';
		$(class_val + " input").css('border','1px solid red');
		$(class_val).append(html);
		return 1;
	}
}


// solo letras con espacio
function es_string_espacio(class_val){
	if($(class_val + "> .error_mensaje").length == 1) return 1;
	var value = $(class_val + " input").val();
	if(/^[a-zA-Z_ ]+$/.test(value)){
		return 0;
	}else{
		html='<div class=\'error_mensaje\'> Solo letras </div>';
		$(class_val + " input").css('border','1px solid red');
		$(class_val).append(html);
		return 1;
	}
}

// solo letras sin espacio
function es_string_sin_espacio(class_val){
	if($(class_val + "> .error_mensaje").length == 1) return 1;
	var value = $(class_val + " input").val();
	if(/^[a-zA-Z]+$/.test(value)){
		return 0;
	}else{
		html='<div class=\'error_mensaje\'> Solo letras </div>';
		$(class_val + " input").css('border','1px solid red');
		$(class_val).append(html);
		return 1;
	}
}

//solo numeros
function es_integer(class_val){
	if($(class_val + "> .error_mensaje").length == 1) return 1;
	var value = $(class_val + " input").val();
	if(/^[0-9]+$/.test(value)){
		return 0;
	}else{
		html='<div class=\'error_mensaje\'>Solo se aceptan números en este campo </div>';
		$(class_val + " input").css('border','1px solid red');
		$(class_val).append(html);
		return 1;
	}
}

// validar seleccion
function val_seleccion(class_val){
	if( $(class_val + "> .error_mensaje").length == 1 ) return 1;
	if( $(class_val + " select").val().length > 0 ){
		return 0;
	}else{
		html='<div class=\'error_mensaje\'>Seleccione un Item </div>';
		$(class_val + " select").css('border','1px solid red');
		$(class_val).append(html);
		return 1;
	}


}
// validar correo 
function val_correo(class_val){
	if($(class_val + "> .error_mensaje").length == 1) return 1;
	var value = $(class_val + " input").val();
	if(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/.test(value)){
		return 0;
	}else{
		html='<div class=\'error_mensaje\'>Correo no valido! </div>';
		$(class_val + " input").css('border','1px solid red');
		$(class_val).append(html);
		return 1;
	}
}
// limpiear campos 
function limpiar(){
	$("input[type='password']").focus(function(){
		$(".error_mensaje").remove();
		$(".text input").css('border','1px solid #aaa');
	});

	$("input[type='text']").focus(function(){
		$(".error_mensaje").remove();
		$(".text input").css('border','1px solid #aaa');
	});
	$("select").click(function(){
		$("input[type='text']").css('border','1px solid #aaa');
		$("input[type='password']").css('border','1px solid #aaa');
		$(this).css('border','1px solid #aaa');
	});

	
	$(".input-control").click(function(){
		$(".error_mensaje").remove();
		$(".select2-selection--multiple").css('border','1px solid #aaa');

	});
}