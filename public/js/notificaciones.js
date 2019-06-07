function ver_info_mensaje(id){

	$('#modal_info_notificacion').modal();
    $('.preloader').fadeIn();
	var urlraiz=$("#url_raiz_proyecto").val();
    var miurl =urlraiz+"/ver_info_mensaje/"+id+""; 
 
    $.ajax({
    url: miurl
    }).done( function(resul) {
	     $('.preloader').fadeOut();
	     $("#contenido_info_notificacion").html(resul);
   
    }).fail( function()  {
	    $('.preloader').fadeOut();
	    $("#contenido_info_notificacion").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    }) ;


}

 function numero_notificaciones(){

    var urlraiz=$("#url_raiz_proyecto").val();
    var miurl =urlraiz+"/cargar_numero_notificaciones"; 
 
    $.ajax({
    url: miurl
    }).done( function(resul) {
	     if(resul.estado=='numerado'){
            var badge='<span  class="badge red" style="margin-left:5px;">'+resul.numero_mensajes+' nuevos</span>';
            var badge1='<span  class="badge red" style="margin-left:5px;">'+resul.numero_noticias+' nuevas</span>';
             var badge2='<span  class="badge red" style="margin-left:5px;">'+resul.numero_solicitudes+' </span>';
	       

          if(resul.numero_mensajes>0){ $("#numero_notificaciones").html(badge); }
             if(resul.numero_noticias>0){ $("#numero_noticias").html(badge1); }
              if(resul.numero_solicitudes>0){ $("#numero_solicitudes").html(badge2); }

            
	     }
   
    }).fail( function(err)  {
	   console.log('hay un error');
    }) ;
 }

 numero_notificaciones();


function  registrar_fecha_noticias(){


              var urlraiz=$("#url_raiz_proyecto").val();
              var miurl =urlraiz+"/registrar_fecha_noticias"; 
             
                $.ajax({
                url: miurl
                }).done( function(resul) {
                   console.log(resul);
               
                }).fail( function(err)  {
                  console.log(err);
                }) ;
             
}