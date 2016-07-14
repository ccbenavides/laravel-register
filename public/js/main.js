$(document).ready(function(){
	$(".capa_error").click(function(){
		$(".capa_error").hide();
	});
	setTimeout(function(){
		$(".capa_error").slideUp();
	},8000);

	$('.llevar_form_eliminar').on('click',function(){
		 var dato = $(this).attr('datoId');
		 var nombre = $(this).attr('datoNombre');
		  console.log(dato);
		  console.log(nombre);
		 $('.nombre_modal').html(nombre);
		 $('.in_data').val(dato);
	})
	$("#id_visible").hide();
	$("#resetear_imagen").click(function(){
		$("#ocultar_imagen").hide();
		$("#id_visible").show();
		$("#input_hiden_imagen").val('limpiando_imagen');
	});


});


function showDialog(id){
		var dialog = $(id).data('dialog');
		dialog.open();
	}