function form_modal_mensaje(id,nombre){

	$('#modal_info_mensaje').modal();
	$('#para').val(id);
	$('#nombre_para').val(nombre);


}


$(document).on("submit","#form_enviar_mensaje",function(e){
  e.preventDefault();
  $('.preloader').fadeIn();
  var formu=$(this);
  var varurl="";
  varurl=$(this).attr("action"); 
 
  
  
  $(".preleader").fadeIn();
  
  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    method : 'POST',
    cache: false,
    processData: false
  
  

  }).done(function(resul){
    
    $('.preloader').fadeOut();
    
    if(resul.estado=="creado"){
           swal("Mensaje enviado", "mensaje enviado con exito", "success");
           $('#modal_info_mensaje').modal('hide');

    }


  })
  .fail( function (jqXHR, status, error) {
    $('.preloader').fadeOut();
    swal("Error", "no enviado", "warning");
   });


});


$(document).on("submit","#form_responder_mensaje",function(e){
  e.preventDefault();
  $('.preloader').fadeIn();
  var formu=$(this);
  var varurl="";
  varurl=$(this).attr("action"); 
 
  
  
  $(".preloader").fadeIn();
  
  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    method : 'POST',
    cache: false,
    processData: false
  
  

  }).done(function(resul){
    
    $('.preloader').fadeOut();
    if(resul.estado=="creado"){
           swal("Mensaje enviado", "mensaje enviado con exito", "success");
           $('#modal_info_notificacion').modal('hide');
    }
  })
  .fail( function (jqXHR, status, error) {
          $('.preloader').fadeOut();
          swal("Error", "no enviado", "warning");
   });


});

function archivar_mensaje(id){

    $(".preloader").fadeIn();
    var urlraiz=$("#url_raiz_proyecto").val();
    var miurl =urlraiz+"/archivar_mensaje"; 


  var formData = new FormData();
  
  formData.append("mensaje_id", id );
  
  $.ajax({
    url : miurl,
    method : 'POST',
    cache: false,
    processData: false,
    contentType : false,
    data: formData,
    headers: {
      'X-CSRF-Token': $('input[id="_token_mensaje"]').val()
   }
  
  

  }).done(function(resul){
    
    $('.preloader').fadeOut();
    if(resul.estado=="archivado"){
           swal("Mensaje archivado", "mensaje archivado con exito", "success");
           $('#modal_info_notificacion').modal('hide');
    }
  })
  .fail( function (jqXHR, status, error) {
          $('.preloader').fadeOut();
          swal("Error", "no enviado", "warning");
   });

}


