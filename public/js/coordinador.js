function cargar_formulario_actividad(arg){

  $('#modal_info_actividades').modal();
  $('.preloader').fadeIn();
   var urlraiz=$("#url_raiz_proyecto").val();
   var miurl='';
   if(arg==1){  miurl=urlraiz+"/coorgeneral/form_nueva_actividad"; $('#titulo_modal_actividades').text('Nueva actividad'); }


    $.ajax({
    url: miurl
    }).done( function(resul) 
    {
      $('.preloader').fadeOut();
      $("#contenido_info_actividades").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
    $("#contenido_info_actividades").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
   }) ;

}


function cargar_formulario_actividad_R(arg){

  $('#modal_info_actividades').modal();
  $('.preloader').fadeIn();
   var urlraiz=$("#url_raiz_proyecto").val();
   var miurl='';
   if(arg==1){  miurl=urlraiz+"/coordinador/form_nueva_actividad_R"; $('#titulo_modal_actividades').text('Nueva actividad'); }


    $.ajax({
    url: miurl
    }).done( function(resul) 
    {
      $('.preloader').fadeOut();
      $("#contenido_info_actividades").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
    $("#contenido_info_actividades").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
   }) ;

}


function cargar_formulario_actividad_P(arg){

  $('#modal_info_actividades').modal();
  $('.preloader').fadeIn();
   var urlraiz=$("#url_raiz_proyecto").val();
   var miurl='';
   if(arg==1){  miurl=urlraiz+"/coordinador/form_nueva_actividad_P"; $('#titulo_modal_actividades').text('Nueva actividad'); }


    $.ajax({
    url: miurl
    }).done( function(resul) 
    {
      $('.preloader').fadeOut();
      $("#contenido_info_actividades").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
    $("#contenido_info_actividades").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
   }) ;

}





function  verinfo_solicitud(arg){

  $('#modal_info_usuarios').modal();
  $('#titulo_modal_usuarios').text('Informacion de solicitud');
  $('.preloader').fadeIn();
	var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/solicitud_informacion/"+arg+""; 
 
    $.ajax({
    url: miurl
    }).done( function(resul) {
      $('.preloader').fadeOut();
     $("#contenido_info_usuarios").html(resul);
   
    }).fail( function()  {
    $('.preloader').fadeOut();
    $("#contenido_info_usuarios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    }) ;
 
}


function  CO_aprobar_solicitud(arg){


  $('.preloader').fadeIn();
	var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/aprobar_solicitud/"+arg+""; 
 
    $.ajax({
    url: miurl
    }).done( function(resul) {
      $('.preloader').fadeOut();
     $("#contenido_info_usuarios").html(resul);
   
    }).fail( function()  {
    $('.preloader').fadeOut();
    $("#contenido_info_usuarios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    }) ;
 
}


function CO_quitar_solicitud(arg){

    $('.preloader').fadeIn();
    var urlraiz=$("#url_raiz_proyecto").val();
    var miurl =urlraiz+"/archivar_solicitud/"+arg+""; 
 
    $.ajax({
    url: miurl
    }).done( function(resul) {
      $('.preloader').fadeOut();
      $("#contenido_info_usuarios").html(resul);
   
    }).fail( function(err)  {
      $('.preloader').fadeOut();
      $("#contenido_info_usuarios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    }) ;


}



