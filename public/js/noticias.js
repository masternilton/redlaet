Window.correosarrayNT=[];
Window.gruposarrayNT=[];
Window.regionarrayNT=[];



function NT_mostrar_correo(idnoticia){
    $("#NT_id_noticia").val(idnoticia);
    Window.correosarrayNT=[];
    Window.gruposarrayNT=[];


    $('#correo_para').text('');
    $('#modal_usuarios').modal();
    NT_activar_tabla_usuarios();
}


function NT_activar_tabla_usuarios() {
   $('#correo_para').text('');
   Window.correosarrayNT=[];
   Window.gruposarrayNT=[];
   Window.regionarrayNT=[];
   $('.preloader').show();
    $.fn.dataTable.ext.errMode = 'throw';


    if ( $.fn.DataTable.isDataTable('#tabla-usuarios-correo') ) {
        $('#tabla-usuarios-correo').DataTable().destroy();
        
      }

      if ( $.fn.DataTable.isDataTable('#tabla-grupos-correo') ) {
        $('#tabla-grupos-correo').DataTable().destroy();
    }

     if ( $.fn.DataTable.isDataTable('#tabla-region-correo') ) {
        $('#tabla-region-correo').DataTable().destroy();
    }

      
      $('#sectabla_paises').hide();
       $('#sectabla_region').hide();
      $('#sectabla_usuarios').show();

    
    var urlraiz=$("#url_raiz_proyecto").val();
    $('#tabla-usuarios-correo').DataTable({
            /*processing: true,
            serverSide: true,*/
             processing: true,
            pageLength: 100,
           
             initComplete: function(){
             
                  var tableusuarios =  $('#tabla-usuarios-correo').DataTable() ;
                  var codigotool='<a style="float:right; margin-right:5px; display:none;" id="DTB_marcartodos" onclick="NT_marcarfiltro();"><i class="fa fa-check-square-o" id="icono_marcar_todo" style="margin-right:5px;"></i><b>Marcar todo</b></a>';
                  $("#tabla-usuarios-correo_filter label").append(codigotool);

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
                    codigocheck='<div class="form-check"><input type="checkbox" onchange="NT_agregar_correo('+ data.id +','+"'"+ data.email +"'"+')" class="form-check-input" id="checkusu_'+ data.id +'"><label class="form-check-label" for="checkusu_'+ data.id +'"></label></div>';
                    return codigocheck;  
                    }  
                }
            ]
        });

    
   
  
      $('.preloader').hide();
}



function NT_activar_tabla_grupos() {
   $('#correo_para').text('');
   Window.correosarrayNT=[];
   Window.gruposarrayNT=[];
   Window.regionarrayNT=[];

    $('.preloader').show();

    if ( $.fn.DataTable.isDataTable('#tabla-grupos-correo') ) {
        $('#tabla-grupos-correo').DataTable().destroy();
    }


    if ( $.fn.DataTable.isDataTable('#tabla-usuarios-correo') ) {
        $('#tabla-usuarios-correo').DataTable().destroy();
    }

     if ( $.fn.DataTable.isDataTable('#tabla-region-correo') ) {
        $('#tabla-region-correo').DataTable().destroy();
    }



      $('#sectabla_usuarios').hide();
       $('#sectabla_region').hide();
      $('#sectabla_paises').show();
      
      
    
    
    var urlraiz=$("#url_raiz_proyecto").val();
 
    $('#tabla-grupos-correo').DataTable({
        processing: true,
        pageLength: 100,
        initComplete: function(){
             
                  var tablegrupos =  $('#tabla-grupos-correo').DataTable() ;
                  var codigotool='<a style="float:right; margin-right:5px; display:none;" id="DTB_marcartodos_grupos" onclick="NT_marcarfiltro_grupos();"><i class="fa fa-check-square-o" id="icono_marcar_todo" style="margin-right:5px;"></i><b>Marcar todo</b></a>';
                  $("#tabla-grupos-correo_filter label").append(codigotool);

                  tablegrupos.on('search.dt', function() {
                 
                   var input = $('.dataTables_filter label input')[0];
                     console.log('el valor dado',input.value);
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
                 codigocheck='<div class="form-check"><input type="checkbox" onchange="NT_agregar_correo_grupo('+ data.id +','+"'"+ data.nombre +"'"+')" class="form-check-input" id="checkgroup_'+ data.id +'"><label class="form-check-label" for="checkgroup_'+ data.id +'"></label></div>';
                return codigocheck;  
                }  
            }
        ]
    });

    $('.preloader').hide();
}



function NT_activar_tabla_regiones() {
  
  $('#correo_para').text('');

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

    if ( $.fn.DataTable.isDataTable('#tabla-grupos-correo') ) {
        $('#tabla-grupos-correo').DataTable().destroy();
    }


    if ( $.fn.DataTable.isDataTable('#tabla-usuarios-correo') ) {
        $('#tabla-usuarios-correo').DataTable().destroy();
    }

    if ( $.fn.DataTable.isDataTable('#tabla-region-correo') ) {
        $('#tabla-region-correo').DataTable().destroy();
    }



      $('#sectabla_usuarios').hide();
      $('#sectabla_paises').hide();
      $('#sectabla_region').show();
      
      
    
    
    var urlraiz=$("#url_raiz_proyecto").val();
 
    $('#tabla-region-correo').DataTable({
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
                 codigocheck='<div class="form-check"><input type="checkbox" onchange="NT_agregar_correo_region('+ data.id +','+"'"+ data.region +"'"+')" class="form-check-input" id="checkregion_'+ data.id +'"><label class="form-check-label" for="checkregion_'+ data.id +'"></label></div>';
                return codigocheck;  
                }  
            }
        ]
    });

    $('.preloader').hide();
}


function NT_agregar_correo(id,email){


    if(NT_validar_email( email ) ){ 
        if( $('#checkusu_'+id+'').is(':checked') ){
            $('#tipo_correo').val(1);
            NT_anexar_insumo(email);
            $('#correo_para').attr('readonly',true);

        }
        else {
           NT_retirar_insumo(email);
        }
    }
    else{
        alert('el usuario seleccionado no tiene un email valido');
    }
}


function NT_agregar_correo_grupo(id,grupo){
    
    if(grupo!=''){ 
        if( $('#checkgroup_'+id+'').is(':checked') ){
            $('#tipo_correo').val(2);
            NT_anexar_grupo(grupo);

        }
        else {
           NT_retirar_grupo(grupo);
        }
    }
    else{
        alert('el grupo seleccionado no tiene un nombre valido');
    }

} 


function NT_agregar_correo_region(id,grupo){
    
    if(grupo!=''){ 
        if( $('#checkregion_'+id+'').is(':checked') ){
            $('#tipo_correo').val(3);
            NT_anexar_region(grupo);

        }
        else {
           NT_retirar_region(grupo);
        }
    }
    else{
        alert('la region seleccionada no tiene un nombre valido');
    }

} 


function NT_anexar_insumo(email){
    email= email.trim();
    Window.correosarrayNT.push(email);
    $('#correo_para').text(   Window.correosarrayNT.toString());

}

function NT_retirar_insumo(email){

    Window.correosarrayNT.splice( Window.correosarrayNT.indexOf(email), 1 );
     $('#correo_para').text(   Window.correosarrayNT.toString());
   

}


function NT_anexar_grupo(grupo){
    grupo= grupo.trim();
    Window.gruposarrayNT.push(grupo);
    $('#correo_para').text(Window.gruposarrayNT.toString());

}

function NT_retirar_grupo(grupo){

    Window.gruposarrayNT.splice( Window.gruposarrayNT.indexOf(grupo), 1 );
     $('#correo_para').text(   Window.gruposarrayNT.toString());
   

}


function NT_anexar_region(grupo){
    grupo= grupo.trim();
    Window.regionarrayNT.push(grupo);
    $('#correo_para').text(Window.regionarrayNT.toString());

}

function NT_retirar_region(grupo){

    Window.regionarrayNT.splice( Window.regionarrayNT.indexOf(grupo), 1 );
     $('#correo_para').text(   Window.regionarrayNT.toString());
   

}



function NT_validar_email( email ) 
{
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}



 
$(document).on("submit","#form_enviar_correo_noticias",function(e){
    e.preventDefault();
    $('.preloader').fadeIn();
    var quien=$(this).attr("id");
    var formu=$(this);
    var varurl="";
    var urlraiz=$("#url_raiz_proyecto").val();
    var id_noticia=$("#NT_id_noticia").val();

    var tipo_correo=$('#tipo_correo').val();
    if(tipo_correo==0){ varurl=$(this).attr("action");   }
    if(tipo_correo==1){ varurl=$(this).attr("action");   }
    if(tipo_correo==2){ varurl=urlraiz+"/enviar_correo_grupos_noticia";   }
    if(tipo_correo==3){ varurl=urlraiz+"/enviar_correo_region_noticia";   }
    

  
    var formData = new FormData();
    

    if(tipo_correo==0){  formData.append("correo_para", $("#correo_para").text() ); }
    if(tipo_correo==1){  formData.append("correo_para", Window.correosarrayNT.toString() );     }
    if(tipo_correo==2){  formData.append("correo_para",Window.gruposarrayNT.toString() );     }
    if(tipo_correo==3){  formData.append("correo_para",Window.regionarrayNT.toString() );     }
    formData.append("id_noticia",id_noticia );
   

    
  
    
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
      
   
      
      if(resul.estado=="enviados"){
        Window.correosarrayNT=[];
        $('#correo_para').text('');
        $('#modal_usuarios').modal('hide');
        console.log(resul);

        
      }
  
    })
    .fail( function (jqXHR, status, error) { 
      $('.preloader').fadeOut();
      swal("Error", "error al enviar correos", "warning");
     });



     var timeoutId = setTimeout(function() {
  
        $(".preloader").fadeOut();

        $('#correo_para').text('');
        $('#modal_usuarios').modal('hide');
        swal("Actualizado", "Correos Enviados", "success");
  
         clearTimeout(timeoutId);
      }, 3000);
  
  
  });

  
  function NT_marcarfiltro(){
    Window.correosarrayNT=[];
    var table =  $('#tabla-usuarios-correo').DataTable() ;
    console.log(table.rows( { filter : 'applied'} ).nodes().length);
    //filtered rows data as arrays
    console.log(table.rows( { filter : 'applied'} ).data());  

   var arrayfiltro=table.rows( { filter : 'applied'} ).data();
    var email='';
    var idusu='';


    $.each(arrayfiltro, function( index, element ) {

       email= element.email.trim();
       idusu=element.id;
       Window.correosarrayNT.push(email); 
       $( "#checkusu_"+idusu+"").prop('checked', true);  
    }); 

    console.log('totalregistrados',Window.correosarrayNT.length );  

    $('#correo_para').text(   Window.correosarrayNT.toString());                                           

  }





    function NT_marcarfiltro_grupos(){
    Window.gruposarrayNT=[];
    var table =  $('#tabla-grupos-correo').DataTable() ;
    console.log(table.rows( { filter : 'applied'} ).nodes().length);
    //filtered rows data as arrays
    console.log(table.rows( { filter : 'applied'} ).data());  

   var arrayfiltro=table.rows( { filter : 'applied'} ).data();
    var nombre='';
    var idusu='';


    $.each(arrayfiltro, function( index, element ) {

       nombre= element.nombre.trim();
       idusu=element.id;
       Window.gruposarrayNT.push(nombre); 
       $( "#checkgroup_"+idusu+"").prop('checked', true);  
    }); 

    console.log('totalregistrados',Window.gruposarrayNT.length );  

    $('#correo_para').text(   Window.gruposarrayNT.toString());                                           

  }







 