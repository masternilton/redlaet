function  verinfo_usuario(arg){

  $('#modal_info_usuarios').modal();
  $('#titulo_modal_usuarios').text('Editar Datos Usuario');
  $('.preloader').fadeIn();
	var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/form_editar_usuario/"+arg+""; 
 
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


function  verinfo_usuario_publico(arg){

  $('#modal_info_usuarios').modal();
  $('#titulo_modal_usuarios').text('Editar Datos Usuario');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/informacion_usuario_publico/"+arg+""; 
 
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


function  verinfo_mi_perfil(arg){

  $('#modal_info_usuarios').modal();
  $('#titulo_modal_usuarios').text('Editar Datos Usuario');
  $('.preloader').fadeIn();
	var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/form_editar_mi_perfil/"+arg+""; 
 
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




$(document).on("click",".div_modal", function(e){
	$(this).hide();
	$("#capa_formularios").hide();
	$("#capa_formularios").html("");
});




function cargar_formulario(arg){

  $('#modal_info_usuarios').modal();
  $('.preloader').fadeIn();
   var urlraiz=$("#url_raiz_proyecto").val();
   var miurl='';
   if(arg==1){  miurl=urlraiz+"/form_nuevo_usuario"; $('#titulo_modal_usuarios').text('Nuevo Usuario'); }
   if(arg==2){ miurl=urlraiz+"/form_nuevo_rol"; }
   if(arg==3){ miurl=urlraiz+"/form_nuevo_permiso"; }
   if(arg==4){ miurl=urlraiz+"/form_nuevo_usuariopais"; }

    $.ajax({
    url: miurl
    }).done( function(resul) 
    {
      $('.preloader').fadeOut();
      $("#contenido_info_usuarios").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
    $("#contenido_info_usuarios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
   }) ;

}



$(document).on("submit",".formentrada",function(e){
  e.preventDefault();
  $('.preloader').fadeIn();
  var quien=$(this).attr("id");
  var formu=$(this);
  var varurl="";
  if(quien=="f_crear_usuario"){  varurl=$(this).attr("action");  var div_resul="contenido_info_usuarios";  }
  if(quien=="f_crear_usuariopais"){  varurl=$(this).attr("action");  var div_resul="contenido_info_usuarios";  }

  if(quien=="f_crear_permiso"){  varurl=$(this).attr("action");  var div_resul="capa_formularios";  }
  if(quien=="f_editar_usuario"){  varurl=$(this).attr("action");  var div_resul="notificacion_E2";  }
  if(quien=="f_editar_acceso"){   varurl=$(this).attr("action");  var div_resul="notificacion_E3";  }
  if(quien=="f_borrar_usuario"){   varurl=$(this).attr("action");  var div_resul="capa_formularios";  }
  if(quien=="f_asignar_permiso"){   varurl=$(this).attr("action");  var div_resul="capa_formularios";  }
  
  $("#"+div_resul+"").html( $("#cargador_empresa").html());
  
  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    method: 'POST',
    dataType : 'html',
  
    success : function(resul) {
      $('.preloader').fadeOut();
      $("#"+div_resul+"").html(resul);
       
    },
    error : function(xhr, status) {
      $('.preloader').fadeOut();
        $("#"+div_resul+"").html('ha ocurrido un error, revise su conexion e intentelo nuevamente');
    }

  });


});

$(document).on("submit",".form_B",function(e){
  e.preventDefault();
  $('.preloader').fadeIn();
  var quien=$(this).attr("id");
  var formu=$(this);
  var varurl="";
  
  if(quien=="f_editar_usuario"){  varurl=$(this).attr("action");   }
  if(quien=="f_editar_acceso"){  varurl=$(this).attr("action");   }
  
  
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
    
    if(resul.estado=="actualizado"){
      
      swal("Actualizado", "Datos Actualizados", "success");

    }


  })
  .fail( function (jqXHR, status, error) {
    $('.preloader').fadeOut();
    swal("Error", "no actualizado", "warning");
   });


});

$(document).on("submit",".form_D",function(e){
  e.preventDefault();
  $('.preloader').fadeIn();
  var quien=$(this).attr("id");
  var formu=$(this);
  var varurl="";
  
  if(quien=="f_crear_estudio"){  varurl=$(this).attr("action");   }

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

      var filahtml='<tr id="TR_estudio_'+resul.estudio.id+'" >';
      filahtml+='<td scope="row">'+resul.estudio.tipo+'</td>';
      filahtml+='<td>'+resul.estudio.tipo_titulo+'</td>';
      filahtml+='<td>'+resul.estudio.titulo+'</td>';
      filahtml+='<td >'+resul.estudio.universidad+'-'+resul.estudio.anio+'</td>';
      filahtml+='<td ><button type="button"  class="btn-danger btn-super-xs"  onclick="borrar_estudio('+resul.estudio.id+');"  title="borrar" ><i class="fa fa-fw fa-remove"></i></button></td>';
      
      filahtml+='</tr>';

      
     
      $("#f_crear_estudio").hide();
      $("#f_crear_estudio").trigger('reset');
      $("#TBODY_estudios").append(filahtml);
      swal("Actualizado", "Datos Actualizados", "success");
    }


  })
  .fail( function (jqXHR, status, error) {
    $('.preloader').fadeOut();
    swal("Error", "no actualizado", "warning");
 });


});


$(document).on('change','.input-file', function(e){

  var file = $("#file_avatar")[0].files[0];
  var fileName = file.name;
  var fileSize = file.size;
  $('#fileavatar_text').text(file.name);

});


$(document).on("submit",".form_C",function(e){
  e.preventDefault();
  $('.preloader').fadeIn();
  var quien=$(this).attr("id");
  var formu=$(this);
  var varurl="";

  var file = $("#file_avatar")[0].files[0];
  var fileName = file.name;
  var fileSize = file.size;

  var formData = new FormData();
  
  formData.append("photo", file );
  formData.append("id_usuario", $("#id_usuario_avatar").val() );
  
  
  

  if(quien=="f_editar_imagen"){  varurl=$(this).attr("action");   }
  
  
  $(".preleader").fadeIn();

  
  $.ajax({
    // la URL para la petición
    url : varurl,
    method : 'POST',
    cache: false,
    processData: false,
    contentType : false,
    data: formData,
    headers: {
      'X-CSRF-Token': $('input[id="_token_avatar"]').val()
   }
  
  

  }).done(function(resul){
    
    $('.preloader').fadeOut();
    
    if(resul.estado=="actualizado"){
      var idval=$("#id_usuario_avatar").val();
      var urlraiz=$("#url_raiz_proyecto").val(); 
      $('#avatar_usuario_'+idval+'').attr('src', urlraiz+'/storage/'+resul.url_imagen + '?t=' + new Date().getTime() );
      swal("Actualizado", "Datos Actualizados", "success");
    }

  })
  .fail( function (jqXHR, status, error) { 
    $('.preloader').fadeOut();
    swal("Error", "no actualizado", "warning");
   });


});




$(document).on("submit",".form_crear_rol",function(e){
  e.preventDefault();
  var quien=$(this).attr("id");
  var formu=$(this);
  var varurl=$(this).attr("action"); 

   $("#div_notificacion_rol").html( $("#cargador_empresa").html());
   $(".form-group").removeClass("has-error");
   $(".help-block").text('');
  
  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    method : 'POST',
    dataType : "html",
  
    success : function(resul) {
      $("#capa_formularios").html(resul);
    },
    error : function(data) {
              var lb="";
              var errors = $.parseJSON(data.responseText);
               $.each(errors, function (key, value) {

                   $("#"+key+"_group").addClass( "has-error" );
                   $("#"+key+"_span").text(value);
               });

           $("#div_notificacion_rol").html('');
           
    }

  });
  



});






function asignar_rol(idusu){
   var idrol=$("#rol1").val();
   var urlraiz=$("#url_raiz_proyecto").val();
   $("#zona_etiquetas_roles").html($("#cargador_empresa").html());
   var miurl=urlraiz+"/asignar_rol/"+idusu+"/"+idrol+""; 

    $.ajax({
    url: miurl
    }).done( function(resul) 
    { 
      var etiquetas="";
      var roles=$.parseJSON(resul);
      
      $.each(roles,function(index, value) {
        etiquetas+= '<span class="label label-warning">'+value+'</span> ';
      });

     $("#zona_etiquetas_roles").html(etiquetas);
   
    }).fail( function() 
    {
    $("#zona_etiquetas_roles").html('<span style="color:red;">...Error: Aun no ha agregado roles o revise su conexion...</span>');
    }) ;

}


function quitar_rol(idusu){
   var idrol=$("#rol2").val();
   var urlraiz=$("#url_raiz_proyecto").val();
   $("#zona_etiquetas_roles").html($("#cargador_empresa").html());
   var miurl=urlraiz+"/quitar_rol/"+idusu+"/"+idrol+""; 

    $.ajax({
    url: miurl
    }).done( function(resul) 
    { 
      var etiquetas="";
      var roles=$.parseJSON(resul);
      $.each(roles,function(index, value) {
        etiquetas+= '<span class="label label-warning" style="margin-left:10px;" >'+value+'</span> ';
      });

     $("#zona_etiquetas_roles").html(etiquetas);
   
    }).fail( function() 
    {
    $("#zona_etiquetas_roles").html('<span style="color:red;">...Error: Aun no ha agregado roles  o revise su conexion...</span>');
    }) ;

}


function borrado_usuario(idusu){


  $("#modal_borrado_usuario").modal('show');
  $("#id_usuario_borrado").val(idusu);


    /*swal({
        title: "¡borrar!",
        text: "¿Esta seguro de Borrar este usuario ?",
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
         

    

            
        } else {
            swal("Cancelado", "ok se ha cancelado el evento:)", "warning");
        }
    }
    );*/

}







function borrar_permiso(idrol,idper){

     var urlraiz=$("#url_raiz_proyecto").val();
     var miurl=urlraiz+"/quitar_permiso/"+idrol+"/"+idper+""; 
     $("#filaP_"+idper+"").html($("#cargador_empresa").html() );
        $.ajax({
    url: miurl
    }).done( function(resul) 
    {
     $("#filaP_"+idper+"").hide();
   
    }).fail( function() 
   {
     alert("No se borro correctamente, intentalo nuevamente o revisa tu conexion");
   }) ;



}


function borrar_rol(idrol){

     var urlraiz=$("#url_raiz_proyecto").val();
     var miurl=urlraiz+"/borrar_rol/"+idrol+""; 
     $("#filaR_"+idrol+"").html($("#cargador_empresa").html() );
        $.ajax({
    url: miurl
    }).done( function(resul) 
    {
     $("#filaR_"+idrol+"").hide();
   
    }).fail( function() 
   {
     alert("No se borro correctamente, intentalo nuevamente o revisa tu conexion");
   }) ;



}


function borrar_estudio(idestudio){


  swal({
      title: "¡borrar!",
      text: "¿Esta seguro de Borrar el registro ?",
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
        var miurl=urlraiz+"/borrar_estudio";
        var formData = new FormData(); 
        formData.append("id_estudio",idestudio);
        

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
              $("#TR_estudio_"+idestudio+"").remove();
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

function  verinfo_rol(arg){

  $('#modal_info_rol').modal();
  $('#titulo_modal_rol').text('Asignar rol');
  $('.preloader').fadeIn();
	var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/form_editar_rol/"+arg+""; 
 

    $.ajax({
    url: miurl
    }).done( function(resul) {
      $('.preloader').fadeOut();
     $("#contenido_info_rol").html(resul);
   
    }).fail( function()  {
    $('.preloader').fadeOut();
    $("#contenido_info_usuarios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    }) ;
 
}



$(document).on("submit",".form_E",function(e){
  e.preventDefault();
  $('.preloader').fadeIn();
  var quien=$(this).attr("id");
  var formu=$(this);
  var varurl="";
  
  if(quien=="f_actualizar_usuario_rol"){  varurl=$(this).attr("action");   }

  $(".preleader").fadeIn();
  
  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    method:"POST",
    cache: false,
    processData: false


  }).done(function(resul){
    
    $('.preloader').fadeOut();
    
    if(resul.estado=="actualizado"){
      let nombrerol=resul.rolsel.name;
      let idusuario=resul.idusuario;
      $('#FER_nombre_rol').text(nombrerol);
      $('#LU_nom_rol_'+idusuario+'').text(nombrerol);
      $('#modal_info_rol').modal('hide');
      
      swal("Actualizado", "Datos Actualizados", "success");
    }

  })
  .fail( function (jqXHR, status, error) {
    $('.preloader').fadeOut();
    swal("Error", "no actualizado", "warning");
 });


});


function US_desplegar_div(idrol){
  if(idrol==1 ){ $('#region_rol').hide(); $('#pais_rol').show(); $('#zona_rol').hide(); $('#zona').val('vacio'); }
  if(idrol==2 ){ $('#region_rol').hide(); $('#pais_rol').show(); $('#zona_rol').hide(); $('#zona').val('vacio');  }
  if(idrol==3 ){  $('#region_rol').hide();$('#pais_rol').show(); $('#zona_rol').show();  }
  if(idrol==4 ){   $('#region_rol').hide(); $('#pais_rol').hide(); $('#zona_rol').hide(); $('#zona').val('vacio'); $('#pais option:selected').val('Colombia'); }
  if(idrol==5 ){  $('#region_rol').show(); $('#pais_rol').hide(); $('#zona_rol').hide(); $('#zona').val('vacio'); $('#pais option:selected').val('Colombia'); }

}

function US_registrar_cuenta(){

    var urlraiz=$("#url_raiz_proyecto").val();
     var miurl =urlraiz+"/registrar_cuenta"; 
 

    $.ajax({
    url: miurl
    }).done( function(resul) {
      console.log(resul);
   
    }).fail( function(err)  {
       console.log(err);
   
    }) ;

}



$(document).on("submit","#form_borrado_usuario_modal",function(e){
  e.preventDefault();
  $('.preloader').fadeIn();
  var quien=$(this).attr("id");
  var formu=$(this);
  var varurl="";

   var urlraiz=$("#url_raiz_proyecto").val();
   var miurl=urlraiz+"/borrar_usuario";
   var idusu=$('#id_usuario_borrado').val();



   $.ajax({
    // la URL para la petición
    url : miurl,
    data : formu.serialize(),
    method: 'POST',
    dataType : 'html',
  
    success : function(resul) {
      resul= $.parseJSON(resul);
   
     if(resul.estado=='borrado'){
   
                $('.preloader').fadeOut();
                $("#modal_borrado_usuario").modal('hide');
                $("#TR_usuario_"+idusu+"").remove();
                swal("Borrado", "Se ha iniciado el proceso de borrado y se espera aprobacion del coordinador genral para el borrado definitivo del sistema", "success");

      }
       
    },
    error : function(xhr, status) {
       $('.preloader').fadeOut();
       swal("No borrado", "No se pudo borrar al usuario:)", "warning");
    }

  });



});


function borrado_usuario_final(idusu){

   var urlraiz=$("#url_raiz_proyecto").val();
   var miurl=urlraiz+"/borrar_usuario_final";
   var formData = new FormData();
   formData.append("id_usuario_borrado", idusu );
 

 
  //$("#id_usuario_borrado").val(idusu);
  var texto= $("#borrado_justificacion_"+idusu+"").val();


    swal({
        title: "¡borrar!",
        text: texto,
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

         

                 $.ajax({
                  // la URL para la petición
                  url : miurl,
                  method : 'POST',
                  cache: false,
                  processData: false,
                  contentType : false,
                  data: formData,
                  headers: {
                    'X-CSRF-Token': $('input[id="_token_maestro"]').val()
                 }
                
                

                }).done(function(resul){
                  
             
                 
                    if(resul.estado=='borrado'){
                 
                              $('.preloader').fadeOut();
                              $("#TR_usuario_"+idusu+"").remove();
                              swal("Borrado", "Se ha iniciado el proceso de borrado y se espera aprobacion del coordinador genral para el borrado definitivo del sistema", "success");

                    }

                })
                .fail( function (jqXHR, status, error) { 
                  $('.preloader').fadeOut();
                  swal("Error", "no actualizado", "warning");
                 });
           

            
        } else {
            swal("Cancelado", "ok se ha cancelado el evento:)", "warning");
        }
    }
    );




}


function Usr_reenviar_clave(correo){ 

   $('.preloader').fadeIn();

    var urlraiz=$("#url_raiz_proyecto").val();
        var miurl=urlraiz+"/recuperarle_password_usuario";
        var formData = new FormData(); 
        formData.append("email",correo);
        

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
            if(resul.estado=='recuperado'){
              $('.preloader').fadeOut();
              let idusu=resul.usuario.id;
              $("#TR_usuario_"+idusu+"").remove();    
              swal("Reenvidado", "se ha enviado un correo con clave de acceso al usuario", "success");

            }
      
        }).fail( function(resul) {
            $('.preloader').fadeOut();
            swal("No enviado", "No se pudo enviar la informacion:)", "warning");
       
        }) ;

}




