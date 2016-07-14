Dropzone.options.addImages = {
	maxFilesize:1,
	success:function(file,response){
		if(file.status == 'success'){
			handleDropzoneFileUpload.handleSuccess(response);
		}else{
			handleDropzoneFileUpload.handleError(response);
		}
	},
	error:function(file,response){
		this.removeFile(file);
		$("#error_imagen_space").show();
		$("#error_imagen_message").html(response);
		console.log(response);
	}	


};
/*Dropzone.options.addImages = {
	maxFilesize:1,
	accept: function(file, done) {
	 this.on("error", function(file, message) { 
                alert(message);
    	});
    }

};*/

var handleDropzoneFileUpload = {
	handleError:function(response){
		console.log(response);
	},
	handleSuccess: function(response){
		$("#imagenes_recientes_space").show();
		var articulo = '<div class="mi_cell_20 imagen_'+response.id +
						'" id="bloque_imagen" data-delete="/backend/foto/eliminar/'+response.id +'">'+
           '<article class="article_imagen">' +
               '<img src="/imagenes/galeria_imagen/album/miniatura/' + response.imagen+ '">'+
       			 '<div class="middle_trash">' +
                  '<span class="mif-cross"></span>' +
                  '<p>Eliminar</p>' +                  
                '</div>' +
           '</article>'+   
       '</div>';

       $('#imagenes_recientes_append').append(articulo);


	}
};



$(document).ready(function(){


	$.ajaxSetup({
   			headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});

	// mantengo el cuadro de imagenes recientes oculta 
	$("#imagenes_recientes_space").hide();
	//mensaje de error cuando la imagen no es permitida por el sistema 
	$('#error_imagen_space').click(function(){
		$(this).hide();
	});

	$(".evento_eliminar").on('click','.mi_cell_20',function(){
		var confirma = confirm('esta seguro que quiere eliminar esta foto ! ');
		if(confirma){
			var clase = $(this).attr("class");
			var route = $(this).attr("data-delete");
			var spliter = clase.split(" "); 
			$.ajax({
				url: route,
				method: "GET",
				dataType: 'html',
				success: function(result){
					$('.'+spliter[1]+'').remove();
					console.log(result);
				},
				error: function(){
					console.log('Error');
				}
			}); 

		}

	});

});

