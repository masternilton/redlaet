 Window.correosarrayNT=[];
 Window.gruposarrayNT=[];
 Window.regionarrayNT=[];

function CO_mostrar_individual(){
    $('#correo_para').attr('readonly',false);
    $('#correo_para').val('');
    Window.correosarray=[];
    Window.gruposarray=[];
    $('#tipo_correo').val(0);
}

function CO_mostrar_usuarios(){
    
    $('#modal_usuarios').modal();
}

function CO_mostrar_grupos(){
    
    $('#modal_grupos').modal();
}

function CO_agregar_correo(id,email){


    if(CO_validar_email( email ) ){ 
        if( $('#checkusu_'+id+'').is(':checked') ){
            $('#tipo_correo').val(1);
            CO_anexar_insumo(email);
            $('#correo_para').attr('readonly',true);

        }
        else {
           CO_retirar_insumo(email);
        }
    }
    else{
        alert('el usuario seleccionado no tiene un email valido');
    }
}



function CO_agregar_correo_grupo(id,grupo){
    
    if(grupo!=''){ 
        if( $('#checkgroup_'+id+'').is(':checked') ){
            $('#tipo_correo').val(2);
            CO_anexar_grupo(grupo);

        }
        else {
           CO_retirar_grupo(grupo);
        }
    }
    else{
        alert('el grupo seleccionado no tiene un nombre valido');
    }

} 


function CO_agregar_correo_region(id,grupo){
    
    if(grupo!=''){ 
        if( $('#checkregion_'+id+'').is(':checked') ){
            $('#tipo_correo').val(3);
            CO_anexar_region(grupo);

        }
        else {
           CO_retirar_region(grupo);
        }
    }
    else{
        alert('el grupo seleccionado no tiene un nombre valido');
    }

} 


function CO_anexar_insumo(email){
    email= email.trim();
    Window.correosarrayNT.push(email);
    $('#correo_paraM').val(   Window.correosarrayNT.toString());
    $('#correo_para').val(   Window.correosarrayNT.toString());

}

function CO_retirar_insumo(email){

    Window.correosarrayNT.splice( Window.correosarrayNT.indexOf(email), 1 );
      $('#correo_paraM').val(   Window.correosarrayNT.toString());
     $('#correo_para').val(   Window.correosarrayNT.toString());
   

}


function CO_anexar_grupo(grupo){
    grupo= grupo.trim();
    Window.gruposarrayNT.push(grupo);
    $('#correo_paraM').val(   Window.gruposarrayNT.toString());
    $('#correo_para').val(   Window.gruposarrayNT.toString());

}

function CO_retirar_grupo(grupo){

    Window.gruposarrayNT.splice( Window.gruposarrayNT.indexOf(grupo), 1 );
    $('#correo_paraM').val(   Window.gruposarrayNT.toString());
    $('#correo_para').val(   Window.gruposarrayNT.toString());
   

}


function CO_anexar_region(grupo){
 
    grupo= grupo.trim();
    Window.regionarrayNT.push(grupo);
    $('#correo_paraM').val(   Window.regionarrayNT.toString());
    $('#correo_para').val(   Window.regionarrayNT.toString());

}

function CO_retirar_region(grupo){

    Window.regionarrayNT.splice( Window.regionarrayNT.indexOf(grupo), 1 );
    $('#correo_paraM').val(   Window.regionarrayNT.toString());
    $('#correo_para').val(   Window.regionarrayNT.toString());
   

}



function CO_validar_email( email ) 
{
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}



  
  
  $(document).on("submit","#form_enviar_correo",function(e){
    e.preventDefault();
    $('.preloader').fadeIn();
    var quien=$(this).attr("id");
    var formu=$(this);
    var varurl="";
    var urlraiz=$("#url_raiz_proyecto").val();

    var tipo_correo=$('#tipo_correo').val();
    if(tipo_correo==0){ varurl=$(this).attr("action");   }
    if(tipo_correo==1){ varurl=$(this).attr("action");   }
    if(tipo_correo==2){ varurl=urlraiz+"/enviar_correo_grupo";   }
    if(tipo_correo==3){ varurl=urlraiz+"/enviar_correo_region";   }

 
  
    var file = $("#file_correo")[0].files[0];
    if(file){   
        var fileName = file.name;
        var fileSize = file.size;
     }
  
  
    var formData = new FormData();
    
    if(file){ formData.append("file_correo", file ); }

    if(tipo_correo==0){  formData.append("correo_para", $("#correo_para").val() ); }
    if(tipo_correo==1){  formData.append("correo_para", Window.correosarrayNT.toString() );     }
    if(tipo_correo==2){  formData.append("correo_para", Window.gruposarrayNT.toString() );     }
    if(tipo_correo==3){  formData.append("correo_para", Window.regionarrayNT.toString() );     }
    
    formData.append("correo_asunto", $("#correo_asunto").val() );
    formData.append("correo_contenido", $("#correo_contenido").val() );

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
        'X-CSRF-Token': $('input[id="_token_correo"]').val()
     }
    
    
  
    }).done(function(resul){
      
      $('.preloader').fadeOut();
      
      if(resul.estado=="enviados"){
       
        swal("Actualizado", "Correo Enviado", "success");
         $('#form_enviar_correo').trigger("reset");
          $('#correo_contenido').val("");
         
      }
  
    })
    .fail( function (jqXHR, status, error) { 
      $('.preloader').fadeOut();
      swal("Error", "error al enviar correos", "warning");
     });
  
  
  });


function CO_activar_tabla_usuarios() {
   $('#correo_paraM').val('');
   $('#correo_para').val('');
   Window.correosarrayNT=[];
   Window.gruposarrayNT=[];
   Window.regionarrayNT=[];
   $('.preloader').show();
    $.fn.dataTable.ext.errMode = 'throw';


    if ( $.fn.DataTable.isDataTable('#tabla-usuarios-correoA') ) {
        $('#tabla-usuarios-correoA').DataTable().destroy();
        
      }

      if ( $.fn.DataTable.isDataTable('#tabla-grupos-correoA') ) {
        $('#tabla-grupos-correoA').DataTable().destroy();
    }

     if ( $.fn.DataTable.isDataTable('#tabla-region-correoA') ) {
        $('#tabla-region-correoA').DataTable().destroy();
    }

      
      $('#sectabla_paises').hide();
       $('#sectabla_region').hide();
      $('#sectabla_usuarios').show();

    
    var urlraiz=$("#url_raiz_proyecto").val();
    $('#tabla-usuarios-correoA').DataTable({
            /*processing: true,
            serverSide: true,*/
             processing: true,
            pageLength: 100,
           
             initComplete: function(){
             
                  var tableusuarios =  $('#tabla-usuarios-correoA').DataTable() ;
                  var codigotool='<a style="float:right; margin-right:5px; display:none;" id="DTB_marcartodos" onclick="CO_marcarfiltro();"><i class="fa fa-check-square-o" id="icono_marcar_todo" style="margin-right:5px;"></i><b>Marcar todo</b></a>';
                  $("#tabla-usuarios-correoA_filter label").append(codigotool);

                  tableusuarios.on('search.dt', function() {

                   var input = $('.dataTables_filter input')[0];
                   if(input.value!=''){ $('#DTB_marcartodos').show(); }else{ $('#DTB_marcartodos').hide(); }
                   

                  });


             }  ,
            language: {
                    "url": urlraiz + "/plugins/datatables/latino.json"
                    } ,
            ajax: urlraiz + '/listado_usuarios_correo',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'nombre' },
                { data: 'email', name: 'email' },
                { data: 'pais', name: 'pais' },
                { data: 'ciudad', name: 'ciudad' },
        
        
                { data: null,  
            
                render: function ( data, type, row ) {
                    
                    codigocheck='<div class="form-check"><input type="checkbox" onchange="CO_agregar_correo('+ data.id +','+"'"+ data.email +"'"+')" class="form-check-input" id="checkusu_'+ data.id +'"><label class="form-check-label" for="checkusu_'+ data.id +'"></label></div>';
                    return codigocheck;  
                    }  
                }
            ]
        });

    
   
  
      $('.preloader').hide();
}


function CO_activar_tabla_grupos() {
   $('#correo_paraM').val('');
   $('#correo_para').val('');
   Window.correosarrayNT=[];
   Window.gruposarrayNT=[];
   Window.regionarrayNT=[];

    $('.preloader').show();

    if ( $.fn.DataTable.isDataTable('#tabla-grupos-correoA') ) {
        $('#tabla-grupos-correoA').DataTable().destroy();
    }


    if ( $.fn.DataTable.isDataTable('#tabla-usuarios-correoA') ) {
        $('#tabla-usuarios-correoA').DataTable().destroy();
    }

     if ( $.fn.DataTable.isDataTable('#tabla-region-correoA') ) {
        $('#tabla-region-correoA').DataTable().destroy();
    }



      $('#sectabla_usuarios').hide();
       $('#sectabla_region').hide();
      $('#sectabla_paises').show();
      
      
    
    
    var urlraiz=$("#url_raiz_proyecto").val();
 
    $('#tabla-grupos-correoA').DataTable({
        processing: true,
        pageLength: 100,
        initComplete: function(){
             
                  var tablegrupos =  $('#tabla-grupos-correoA').DataTable() ;
                  var codigotool='<a style="float:right; margin-right:5px; display:none;" id="DTB_marcartodos_grupos" onclick="CO_marcarfiltro_grupos();"><i class="fa fa-check-square-o" id="icono_marcar_todo" style="margin-right:5px;"></i><b>Marcar todo</b></a>';
                  $("#tabla-grupos-correoA_filter label").append(codigotool);

                  tablegrupos.on('search.dt', function() {
                 
                   var input = $('.dataTables_filter label input')[0];
                     
                   if(input.value!=''){ $('#DTB_marcartodos_grupos').show(); }else{ $('#DTB_marcartodos_grupos').hide(); }
                   

                  });


        }  ,
        language: {
                 "url": urlraiz + "/plugins/datatables/latino.json"
                  } ,
        ajax: urlraiz + '/listado_grupos_correo',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'continente', name: 'continente' },
            { data: 'nombre', name: 'nombre' },

      
            { data: null,  
           
            render: function ( data, type, row ) {
                codigocheck='<div class="form-check"><input type="checkbox" onchange="CO_agregar_correo_grupo('+ data.id +','+"'"+ data.nombre +"'"+')" class="form-check-input" id="checkgroup_'+ data.id +'"><label class="form-check-label" for="checkgroup_'+ data.id +'"></label></div>';
                return codigocheck;  
                }  
            }
        ]
    });

    $('.preloader').hide();
}


function CO_activar_tabla_regiones() {
   $('#correo_paraM').val('');
  $('#correo_para').val('');

   Window.correosarrayNT=[];
   Window.gruposarrayNT=[];
   Window.regionarrayNT=[];

  var dataregiones=[{id:1,region:"SurAmerica"},
  {id:2,region:"Norteamerica CentroAmerica y el Caribe"},
  {id:3,region:"Europa y Africa"},
   {id:4,region:"Asia"},
  {id:5,region:"Oceania"}


  ];





    $('.preloader').show();

    if ( $.fn.DataTable.isDataTable('#tabla-grupos-correoA') ) {
        $('#tabla-grupos-correoA').DataTable().destroy();
    }


    if ( $.fn.DataTable.isDataTable('#tabla-usuarios-correoA') ) {
        $('#tabla-usuarios-correoA').DataTable().destroy();
    }

    if ( $.fn.DataTable.isDataTable('#tabla-region-correoA') ) {
        $('#tabla-region-correoA').DataTable().destroy();
    }



      $('#sectabla_usuarios').hide();
      $('#sectabla_paises').hide();
      $('#sectabla_region').show();
      
      
    
    
    var urlraiz=$("#url_raiz_proyecto").val();
 
    $('#tabla-region-correoA').DataTable({
        processing: true,
        pageLength: 100,
    
        language: {
                 "url": urlraiz + "/plugins/datatables/latino.json"
                  } ,
        data: dataregiones,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'region', name: 'region' },

      
            { data: null,  
           
            render: function ( data, type, row ) {
                 codigocheck='<div class="form-check"><input type="checkbox" onchange="CO_agregar_correo_region('+ data.id +','+"'"+ data.region +"'"+')" class="form-check-input" id="checkregion_'+ data.id +'"><label class="form-check-label" for="checkregion_'+ data.id +'"></label></div>';
                return codigocheck;  
                }  
            }
        ]
    });

    $('.preloader').hide();
}


  
  function CO_marcarfiltro(){
    $('#correo_para').val(''); 
    $('#correo_paraM').val('');    
    Window.correosarrayNT=[];
    var table =  $('#tabla-usuarios-correoA').DataTable() ;
  
    var arrayfiltro=table.rows( { filter : 'applied'} ).data();
    var email='';
    var idusu='';


    $.each(arrayfiltro, function( index, element ) {

       email= element.email.trim();
       idusu=element.id;
       Window.correosarrayNT.push(email); 
       $( "#checkusu_"+idusu+"").prop('checked', true);  
    }); 

    
     $('#correo_paraM').val(   Window.correosarrayNT.toString());
    $('#correo_para').val(   Window.correosarrayNT.toString());
                                             

  }



   function CO_marcarfiltro_grupos(){
    $('#correo_para').val(''); 
    $('#correo_paraM').val('');    
    Window.gruposarrayNT=[];
    var table =  $('#tabla-grupos-correoA').DataTable() ;
  
    var arrayfiltro=table.rows( { filter : 'applied'} ).data();
    var email='';
    var idusu='';


    $.each(arrayfiltro, function( index, element ) {

       nombre= element.nombre.trim();
       idusu=element.id;
       Window.gruposarrayNT.push(nombre); 
       $( "#checkgroup_"+idusu+"").prop('checked', true);  
    }); 

    
     $('#correo_paraM').val(   Window.gruposarrayNT.toString());
     $('#correo_para').val(   Window.gruposarrayNT.toString());
                                             

  }




