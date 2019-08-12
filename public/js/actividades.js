
$(document).on('change','input[type=radio][name=asignado]',function() {

	if (this.value == 1) {
       $('#campo_personalizado').hide();
    }
    else if (this.value == 2) {
       $('#campo_personalizado').show();
    }

    
});


$(document).on("submit","#f_crear_actividad",function(e){
  e.preventDefault();
  $('.preloader').fadeIn();
  var quien=$(this).attr("id");
  var formu=$(this);
  var varurl="";
  var url_raiz_proyecto=$('#url_raiz_proyecto').val();
  if(quien=="f_crear_actividad"){  varurl=$(this).attr("action");  var div_resul="contenido_info_usuarios";  }

  
  $("#"+div_resul+"").html( $("#cargador_empresa").html());
  
  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    method: 'POST',
    dataType : 'html',
  
    success : function(resul) {
      $('.preloader').fadeOut();
      window.location=url_raiz_proyecto+'/coorgeneral/seccion_actividades';
      swal("Creada", "Se ha creado una nueva actividad", "success");
      
       
    },
    error : function(xhr, status) {
      $('.preloader').fadeOut();
              swal("Error", "Ha ocurrido un error , vuelva a intentarlo", "warning");
    }

  });


});

$(document).on("submit","#f_crear_actividad_R",function(e){

  e.preventDefault();
  $('.preloader').fadeIn();
  var quien=$(this).attr("id");
  var formu=$(this);
  var varurl="";
  var url_raiz_proyecto=$('#url_raiz_proyecto').val();
  if(quien=="f_crear_actividad_R"){  varurl=$(this).attr("action");  var div_resul="contenido_info_usuarios";  }
  $("#"+div_resul+"").html( $("#cargador_empresa").html());
  
  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    method: 'POST',
    dataType : 'html',
  
    success : function(resul) {
      $('.preloader').fadeOut();
      window.location=url_raiz_proyecto+'/coordinador/seccion_actividades_coordinador';
      swal("Creada", "Se ha creado una nueva actividad", "success");
      
       
    },
    error : function(xhr, status) {
      $('.preloader').fadeOut();
              swal("Error", "Ha ocurrido un error , vuelva a intentarlo", "warning");
    }

  });


});



$(document).on("submit","#f_editar_actividad",function(e){
  e.preventDefault();
  $('.preloader').fadeIn();
  var quien=$(this).attr("id");
  var formu=$(this);
  var varurl="";
  var url_raiz_proyecto=$('#url_raiz_proyecto').val();
  if(quien=="f_editar_actividad"){  varurl=$(this).attr("action");  var div_resul="contenido_info_usuarios";  }

  
  $("#"+div_resul+"").html( $("#cargador_empresa").html());
  
  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    method: 'POST',
    dataType : 'html',
  
    success : function(resul) {
      $('.preloader').fadeOut();
      window.location=url_raiz_proyecto+'/coorgeneral/seccion_actividades';
      swal("Actualizado", "Se ha creado una nueva actividad", "success");
      
       
    },
    error : function(xhr, status) {
      $('.preloader').fadeOut();
              swal("Error", "Ha ocurrido un error , vuelva a intentarlo", "warning");
    }

  });


});

$(document).on("submit","#f_editar_actividad_R",function(e){
  e.preventDefault();
  $('.preloader').fadeIn();
  var quien=$(this).attr("id");
  var formu=$(this);
  var varurl="";
  var url_raiz_proyecto=$('#url_raiz_proyecto').val();
  if(quien=="f_editar_actividad_R"){  varurl=$(this).attr("action");  var div_resul="contenido_info_usuarios";  }

  
  $("#"+div_resul+"").html( $("#cargador_empresa").html());
  
  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    method: 'POST',
    dataType : 'html',
  
    success : function(resul) {
      $('.preloader').fadeOut();
      window.location=url_raiz_proyecto+'/coordinador/seccion_actividades_coordinador';
      swal("Actualizado", "Se ha creado una nueva actividad", "success");
      
       
    },
    error : function(xhr, status) {
      $('.preloader').fadeOut();
              swal("Error", "Ha ocurrido un error , vuelva a intentarlo", "warning");
    }

  });


});


$(document).on("submit","#f_editar_actividad_P",function(e){
  e.preventDefault();
  $('.preloader').fadeIn();
  var quien=$(this).attr("id");
  var formu=$(this);
  var varurl="";
  var url_raiz_proyecto=$('#url_raiz_proyecto').val();
  if(quien=="f_editar_actividad_P"){  varurl=$(this).attr("action");  var div_resul="contenido_info_usuarios";  }

  
  $("#"+div_resul+"").html( $("#cargador_empresa").html());
  
  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    method: 'POST',
    dataType : 'html',
  
    success : function(resul) {
      $('.preloader').fadeOut();
      window.location=url_raiz_proyecto+'/coordinador/seccion_actividades_coordinadorP';
      swal("Actualizado", "Se ha creado una nueva actividad", "success");
      
       
    },
    error : function(xhr, status) {
      $('.preloader').fadeOut();
              swal("Error", "Ha ocurrido un error , vuelva a intentarlo", "warning");
    }

  });


});


function ACT_borrado_actividad(idactividad){

   swal({
      title: "¡borrar!",
      text: "¿Esta seguro de Borrar esta actividad ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "SI",
      cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false 
  },

  function(isConfirm) {
      if (isConfirm) {
        var urlraiz=$("#url_raiz_proyecto").val();
        var miurl=urlraiz+"/coorgeneral/borrar_actividad";
        var formData = new FormData(); 
        formData.append("id_actividad",idactividad);
        

        $.ajax({
        url: miurl,
        method:"POST",
        data:formData,
        cache: false,
        processData: false,
        contentType : false,
        headers: {
          'X-CSRF-Token': $('input[id="_token_maestro"]').val()
        }

        }).done( function(resul) {
            if(resul.estado=='borrado'){
              $("#TR_actividad_"+idactividad+"").remove();
              swal("Borrado", "se ha borrado correctamente la informaciòn", "success");

            }
      
        }).fail( function(resul) {
            swal("No borrado", "No se pudo borrar la informaciòn :)", "warning");
       
        }) ;

          
      } else {
          swal("Cancelado", "ok se ha cancelado el evento:)", "warning");
      }
  });

}




function ACT_activar_actividad(idactividad){

   swal({
      title: "¡Completar!",
      text: "¿Desea dar por completada esta actividad ?",
      type: "info",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "SI",
      cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false 
  },

  function(isConfirm) {
      if (isConfirm) {
        var urlraiz=$("#url_raiz_proyecto").val();
        var miurl=urlraiz+"/coorgeneral/completar_actividad";
        var formData = new FormData(); 
        formData.append("id_actividad",idactividad);
        

        $.ajax({
        url: miurl,
        method:"POST",
        data:formData,
        cache: false,
        processData: false,
        contentType : false,
        headers: {
          'X-CSRF-Token': $('input[id="_token_maestro"]').val()
        }

        }).done( function(resul) {
            if(resul.estado=='completada'){
              $("#TR_actividad_"+idactividad+"").remove();
              swal("Completada", "se ha completado correctamente la informaciòn", "success");

            }
      
        }).fail( function(resul) {
            swal("No completada", "No se ha completado la informacion :)", "warning");
       
        }) ;

          
      } else {
          swal("Cancelado", "ok se ha cancelado el evento:)", "warning");
      }
  });

}

function ACT_ver_actividad(arg){

  $('#modal_info_actividades').modal();
  $('.preloader').fadeIn();
   var urlraiz=$("#url_raiz_proyecto").val();
   var miurl='';
   miurl=urlraiz+"/coorgeneral/form_editar_actividad/"+arg+""; $('#titulo_modal_actividades').text('Editar actividad'); 


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


function ACT_ver_actividad_R(arg){

  $('#modal_info_actividades').modal();
  $('.preloader').fadeIn();
   var urlraiz=$("#url_raiz_proyecto").val();
   var miurl='';
   miurl=urlraiz+"/coordinador/form_editar_actividad_R/"+arg+""; $('#titulo_modal_actividades').text('Editar actividad'); 


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


function ACT_ver_actividad_P(arg){

  $('#modal_info_actividades').modal();
  $('.preloader').fadeIn();
   var urlraiz=$("#url_raiz_proyecto").val();
   var miurl='';
   miurl=urlraiz+"/coordinador/form_editar_actividad_P/"+arg+""; $('#titulo_modal_actividades').text('Editar actividad'); 


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



function ACT_activar_actividad_R(idactividad){

   swal({
      title: "¡Completar!",
      text: "¿Desea dar por completada esta actividad ?",
      type: "info",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "SI",
      cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false 
  },

  function(isConfirm) {
      if (isConfirm) {
        var urlraiz=$("#url_raiz_proyecto").val();
        var miurl=urlraiz+"/coordinador/completar_actividad_R";
        var formData = new FormData(); 
        formData.append("id_actividad",idactividad);
        

        $.ajax({
        url: miurl,
        method:"POST",
        data:formData,
        cache: false,
        processData: false,
        contentType : false,
        headers: {
          'X-CSRF-Token': $('input[id="_token_maestro"]').val()
        }

        }).done( function(resul) {
            if(resul.estado=='completada'){
              $("#TR_actividad_"+idactividad+"").remove();
              swal("Completada", "se ha completado correctamente la informaciòn", "success");

            }
      
        }).fail( function(resul) {
            swal("No completada", "No se ha completado la informacion :)", "warning");
       
        }) ;

          
      } else {
          swal("Cancelado", "ok se ha cancelado el evento:)", "warning");
      }
  });

}


function ACT_activar_actividad_P(idactividad){

   swal({
      title: "¡Completar!",
      text: "¿Desea dar por completada esta actividad ?",
      type: "info",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "SI",
      cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false 
  },

  function(isConfirm) {
      if (isConfirm) {
        var urlraiz=$("#url_raiz_proyecto").val();
        var miurl=urlraiz+"/coordinador/completar_actividad_P";
        var formData = new FormData(); 
        formData.append("id_actividad",idactividad);
        

        $.ajax({
        url: miurl,
        method:"POST",
        data:formData,
        cache: false,
        processData: false,
        contentType : false,
        headers: {
          'X-CSRF-Token': $('input[id="_token_maestro"]').val()
        }

        }).done( function(resul) {
            if(resul.estado=='completada'){
              $("#TR_actividad_"+idactividad+"").remove();
              swal("Completada", "se ha completado correctamente la informaciòn", "success");

            }
      
        }).fail( function(resul) {
            swal("No completada", "No se ha completado la informacion :)", "warning");
       
        }) ;

          
      } else {
          swal("Cancelado", "ok se ha cancelado el evento:)", "warning");
      }
  });

}


function ACT_borrado_actividad_R(idactividad){

   swal({
      title: "¡borrar!",
      text: "¿Esta seguro de Borrar esta actividad ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "SI",
      cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false 
  },

  function(isConfirm) {
      if (isConfirm) {
        var urlraiz=$("#url_raiz_proyecto").val();
        var miurl=urlraiz+"/coordinador/borrar_actividad_R";
        var formData = new FormData(); 
        formData.append("id_actividad",idactividad);
        

        $.ajax({
        url: miurl,
        method:"POST",
        data:formData,
        cache: false,
        processData: false,
        contentType : false,
        headers: {
          'X-CSRF-Token': $('input[id="_token_maestro"]').val()
        }

        }).done( function(resul) {
            if(resul.estado=='borrado'){
              $("#TR_actividad_"+idactividad+"").remove();
              swal("Borrado", "se ha borrado correctamente la informaciòn", "success");

            }
      
        }).fail( function(resul) {
            swal("No borrado", "No se pudo borrar la informaciòn :)", "warning");
       
        }) ;

          
      } else {
          swal("Cancelado", "ok se ha cancelado el evento:)", "warning");
      }
  });

}


function ACT_borrado_actividad_P(idactividad){

   swal({
      title: "¡borrar!",
      text: "¿Esta seguro de Borrar esta actividad ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "SI",
      cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false 
  },

  function(isConfirm) {
      if (isConfirm) {
        var urlraiz=$("#url_raiz_proyecto").val();
        var miurl=urlraiz+"/coordinador/borrar_actividad_P";
        var formData = new FormData(); 
        formData.append("id_actividad",idactividad);
        

        $.ajax({
        url: miurl,
        method:"POST",
        data:formData,
        cache: false,
        processData: false,
        contentType : false,
        headers: {
          'X-CSRF-Token': $('input[id="_token_maestro"]').val()
        }

        }).done( function(resul) {
            if(resul.estado=='borrado'){
              $("#TR_actividad_"+idactividad+"").remove();
              swal("Borrado", "se ha borrado correctamente la informaciòn", "success");

            }
      
        }).fail( function(resul) {
            swal("No borrado", "No se pudo borrar la informaciòn :)", "warning");
       
        }) ;

          
      } else {
          swal("Cancelado", "ok se ha cancelado el evento:)", "warning");
      }
  });

}


$(document).on("submit","#f_crear_actividad_P",function(e){

  e.preventDefault();
  $('.preloader').fadeIn();
  var quien=$(this).attr("id");
  var formu=$(this);
  var varurl="";
  var url_raiz_proyecto=$('#url_raiz_proyecto').val();
  if(quien=="f_crear_actividad_P"){  varurl=$(this).attr("action");  var div_resul="contenido_info_usuarios";  }
  $("#"+div_resul+"").html( $("#cargador_empresa").html());
  
  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    method: 'POST',
    dataType : 'html',
  
    success : function(resul) {
      $('.preloader').fadeOut();
      window.location=url_raiz_proyecto+'/coordinador/seccion_actividades_coordinadorP';
      swal("Creada", "Se ha creado una nueva actividad", "success");
      
       
    },
    error : function(xhr, status) {
      $('.preloader').fadeOut();
              swal("Error", "Ha ocurrido un error , vuelva a intentarlo", "warning");
    }

  });


});
