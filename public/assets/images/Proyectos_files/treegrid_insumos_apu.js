
/* treegrid 02 de proyectos*/
window.PROYECTOSELID=0;
function TGNO3_NO_AUTORIZADO(estado, mensaje){

    if(estado=='noautorizado'){  
              $(".preloader").fadeIn(); 
              $(".div_modal").click(); 
              swal({
                          title: "NO AUTORIZADO!",
                          text: mensaje,
                          type: "warning"
                        },function (isConfirm) { }); 
             return false;
    }


    swal({
                          title: "Error!",
                          text: 'Ha ocurrido un error inseperado ,intentelo nuevamente',
                          type: "warning"
                        },function (isConfirm) { }); 
         

}




function TGPO3_generar_treegrid_sec(idProyecto, tipo,idActividad){


   PROYECTOSELID=idProyecto;

 $("#sec_tabla_insumos_M").html('');
  $("#sec_tabla_insumos_O").html('');
  $("#sec_tabla_insumos_E").html('');
  $("#sec_tabla_insumos_T").html('');
  $("#sec_tabla_insumos_S").html('');

  var codigotree='<div id="TreeGridContainer_003" class="TGP03" style="width: 100%; height: 100%;" ></div>'    ;
  
    
    $('.preloader').fadeIn();

    $.ajax({
            type: "get",
            async: true,
            url: API_URL + 'insumos_proyecto/listado_om_global/'+idProyecto+'/'+tipo+'',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            headers: { 'token' : TOKENCOPRES }
      })
      .done(function(dataresul){

          $("#collapse_"+tipo+"").addClass('show');
          $("#sec_tabla_insumos_"+tipo+"").html(codigotree);
          TGPO3_generar_treegrid_apu(dataresul.insumos_m,idProyecto,tipo,idActividad);
          $('.preloader').fadeOut();

      })
      .fail(function(){
          $('.preloader').fadeOut();
          alert('ocurrio un error cargado vuelva a intentarlo;'); 
      }); 


}


function TGPO3_generar_treegrid_apu(data,idProyecto,tipo,idActividad){


let btn_checkBox='<input type="checkbox" id="checkbox_insumo_{{:id}}" onchange="TGPO3_checkeado({{:id}},'+"'"+'{{:codigo}}'+"'"+','+idProyecto+','+ idActividad+',{{:id_grupo}});" class="filled-in form-check-input classcod_{{:codigo}}" value="true" ><label class="form-check-label" for="checkbox_insumo_{{:id}}"></label>';
let btn_agregar='<button type="button" onclick="TGP03_agregar_hijo({{:id}},'+"'"+tipo+"'"+');" class="e-detailsbutton e-button e-js e-ntouch e-btn-small e-link icon-gris e-btn e-select e-widget e-txt e-corner"><i class="mdi mdi-lead-pencil icontree" style="font-size:1.5em;"></i></button>' ;       
        $("#TreeGridContainer_003").ejTreeGrid({

             dataSource: data,
                childMapping: "subtasks",
                treeColumnIndex: 7,
                idMapping: "id",
                parentIdMapping: "id_grupo",
                rowHeight : 50,
                treeColumnIndex: 1,
                rowHeight : 50,
                allowColumnResize: true,
                isResponsive: true,
                enableResize:true,
                allowSorting: true,
                sortSettings: { sortedColumns: [{ field: "codigo", direction: "ascending" }] },
                sizeSettings: { height: 'auto' },
            
             
                editSettings: {
                    allowAdding: true,
                    allowEditing: true,
                    allowDeleting: false,
                    showAddNewRow : true,
                    editMode: "rowEditing",
                    rowPosition: "belowSelectedRow",
                    showDeleteConfirmDialog  : true
                 },
                toolbarSettings: {
                    showToolbar: true,
                    toolbarItems: [
                    ej.TreeGrid.ToolbarItems.ExpandAll,
                    ej.TreeGrid.ToolbarItems.CollapseAll,
                    ej.TreeGrid.ToolbarItems.Search
                     
                    ]
                },
       
            columns: [
            
                 { field: "id", headerText: "Id", width : 0,visible:false},
                 { iden: "btn_base",template: "<i class='fa fa-check'></i>" , width : 30, allowEditing: true},
                 { field: "codigo", headerText: "Codigo" , width : 80, allowEditing: false},
                 

                 { field: "tipo_insumo", headerText: "Tipo", width : 40,textAlign: "center",allowEditing: false, visible:false},
                 { field: "insumo", headerText: "Insumo" , width : 100 },
                 { field: "unidad", headerText: "unidad" , width:40, textAlign: "center"},
                 { field: "valor_unitario", headerText: "val. unitario" ,editType: "numericedit", editParams: { decimalPlaces: 2 }, format: "{0:N2}", textAlign: "right", width: 60},
                 { field: "marca", headerText: "Marca" , width : 100, visible:false},
                 { field: "referencia", headerText: "Referencia" , width : 50,visible:false},
                 { field: "devolutivo", headerText: 'Devolutivo', width: 40, visible:false},
                 { field: "usuario_crea", headerText: "Creado por." , width : 100, visible:false },
                 { field: "usuario_edit", headerText: "Editado por.", width : 50, visible:false },
                 { field: "id_usuario", headerText: "id_usuario" , width:20, visible:false },
                 { field: "raiz", headerText: "raiz" , width:20, visible:false },
                 { field: "codigo_barras", headerText: "Codigo barras" , width:50,visible:false},
                 { field: "fotografia", headerText: "Fotografia" , width:50,visible:false},
                 { field: "archivo", headerText: "Archivo" , width:50,visible:false},
                 { field: "ficha_tecnica", headerText: "Ficha tecnica" , width:50,visible:false},
                 { field: "tipo_grupo", headerText: "Tipo grupo" , width:50,visible:false},
                 { field: "autoincrement", headerText: "autoincrement" , width:50,visible:false},
                 { field: "id_proyecto", headerText: "id_pro" , width:50,visible:false},
                 { iden:"btn_agregar",template: btn_agregar, isTemplateColumn: true,width :30},
                 { iden:"btn_checkBox",template: btn_checkBox, isTemplateColumn: true,width :30},
             
                 
                 
            ],

            create:'TGPO3_create',
            queryCellInfo: 'TGPO3_queryCellInfo',
            actionComplete:"TGPO3_escuchar_eventos",
            endEdit: "TGPO3_edicion_insumos"
           
          
        });

        $('.preloader').fadeOut();
}

function TGPO3_create (args){


   var gridObj = $("#Grid").data("ejGrid");

   var datosgrid =gridObj.model.currentViewData.records ;

   if(datosgrid){
     datosgrid.forEach(function(element) {
        
        let ncheckbox='classcod_'+element.codigo+'';
        $("."+ncheckbox+"").prop("checked", true);
        
     });

   }

}


function TGPO3_evento_inicial (args,tipo){

 
  if(args.requestType=='add'){
  
     args.data.id_proyecto=PROYECTOSELID;
     
   
    if(args.data.level!=1){ 
         TGPO3_bloquear_add();
          args.data.codigo=0;
          args.data.level=0;
          args.level=0;
          args.rowPosition="top";
          args.parentItem=null;
          //$("#TreeGridContainer_003").ejTreeGrid({ selectedRowIndex:-1 });
          args.data.id_grupo=0;
          args.data.tipo=tipo;
          args.data.insumo="GRUPO";
         

    }


     if(args.data.level==1){ 
       
         args.data.level=1;

        let valid_grupo=0;
         if(args.parentItem){
          if(args.parentItem.id){  valid_grupo=args.parentItem.id; args.data.id_grupo=valid_grupo;  }
          if(!args.parentItem.id){  args.data.id_grupo=valid_grupo;  }
          //if(args.parentItem.isSummaryRow==true){  valid_grupo=args.parentItem.parentItem.id; }  
         } 

     }


    console.log( 'mi grupo sel', args.data.id_grupo);
    args.data.tipo=tipo;
    args.data.cantidad=parseFloat(0);
    args.data.valor_unitario=parseFloat(0);


     
     
  }
}



function TGPO3_escuchar_eventos(args) {



   let gridObj = $("#TreeGridContainer_003").data("ejTreeGrid");
   if (args.requestType == "addNewRow" && args.addedRow) {
    $('.preloader').fadeIn();

     let idGrupo=0;
     let tipoGrupo=0;
     let autoincrementx = 0;

   
     if(args.addedRow.id_grupo == undefined){
        tipoGrupo=0;
        idGrupo = 0;
      
     }else{

      idGrupo = args.addedRow.id_grupo;
      tipoGrupo = 1;
      

     }
   

      var formData = new FormData();
        formData.append("tipo_insumo", args.addedRow.tipo_insumo);
        formData.append("insumo", args.addedRow.insumo );
        formData.append("codigo", args.addedRow.codigo);
        formData.append("unidad", args.addedRow.unidad );
        if(args.addedRow.valor_unitario==null){ args.addedRow.valor_unitario=parseFloat(0); }
        formData.append("valor_unitario", args.addedRow.valor_unitario);
        if(args.addedRow.devolutivo==null){ args.addedRow.devolutivo=false; }
        formData.append("devolutivo", true);
        formData.append("marca",  args.addedRow.marca);
        formData.append("referencia",  args.addedRow.referencia);
        formData.append("id_usuario", 1);
        formData.append("raiz", 1);
        formData.append("codigo_barras",  args.addedRow.codigo_barras);
        formData.append("fotografia",  args.addedRow.fotografia);
        formData.append("archivo",  "");
        formData.append("ficha_tecnica",  args.addedRow.ficha_tecnica);
        formData.append("autoincrement",  args.addedRow.autoincrementx);
        formData.append("id_grupo",  idGrupo);
        formData.append("tipo_grupo",  tipoGrupo);

        $.ajax({
               type: "post",
               async: true,
               url: API_URL + 'base_datos/nuevo_insumos',
               cache: false,
               contentType: false,
               processData: false,
               headers: { 'token' : TOKENCOPRES },
               data:formData
        })
        .done(function(resul) {
 
          console.log("Resultadoooo", resul.estado);
          if(resul.estado=="OK"){ 
             console.log("Resultadoooo", resul.insumos_m);
       
            var treeGridObj=$("#TreeGridContainer_003").data("ejTreeGrid");        
                var index=args.rowIndex; 
                console.log('datos agregar',index); 
                updatedRecords = treeGridObj.model.updatedRecords;
                itemToUpdate = updatedRecords[index]; 
                if (itemToUpdate) { 
                //To refresh the required record 
                  var item = itemToUpdate.item;
                 
                  itemToUpdate.id = itemToUpdate.item.id = resul.insumos_m.id;
                  itemToUpdate.tipo_insumo = itemToUpdate.item.tipo_insumo = resul.insumos_m.tipo_insumo;
                  itemToUpdate.insumo = itemToUpdate.item.insumo = resul.insumos_m.insumo;  
                  itemToUpdate.unidad = itemToUpdate.item.unidad = resul.insumos_m.unidad;  
                  itemToUpdate.valor_unitario = itemToUpdate.item.valor_unitario = resul.insumos_m.valor_unitario;  
                  itemToUpdate.marca = itemToUpdate.item.marca = resul.insumos_m.marca;  
                  itemToUpdate.referencia = itemToUpdate.item.referencia = resul.insumos_m.referencia;  
                  itemToUpdate.codigo_barras = itemToUpdate.item.codigo_barras = resul.insumos_m.codigo_barras;  
                  itemToUpdate.fotografia = itemToUpdate.item.fotografia = resul.insumos_m.fotografia; 
                  itemToUpdate.ficha_tecnica = itemToUpdate.item.ficha_tecnica = resul.insumos_m.ficha_tecnica;
                  itemToUpdate.usuario_crea = itemToUpdate.item.usuario_crea = resul.insumos_m.usuario_crea;
                  itemToUpdate.usuario_edit = itemToUpdate.item.usuario_edit = resul.insumos_m.usuario_edit;
                  itemToUpdate.id_grupo = itemToUpdate.item.id_grupo = resul.insumos_m.id_grupo;
                  itemToUpdate.codigo = itemToUpdate.item.codigo = resul.insumos_m.codigo;
                  itemToUpdate.updatedAt = itemToUpdate.item.updatedAt = resul.insumos_m.updatedAt;

                  treeGridObj.refreshRow(index); 
                  treeGridObj.sortColumn("insumo", ej.sortOrder.Ascending);
                  treeGridObj.refresh();
                  console.log("Esta entrando aca hary");
                }
                
                TGP03_actualizar_insumo_add(resul, index);
              
               $('.preloader').fadeOut();
               
                $.notify("creado","success");
          }

        })
        .fail( function (jqXHR, status, error) {
            $('.preloader').fadeOut();
            console.log("entro aqui por el error");
            let estado=jqXHR.responseJSON.estado;
            TGP03_NO_AUTORIZADO(estado,'no tiene privilegios suficientes para borrar usuarios');
         });

   }




}


function TGPO3_edicion_insumos(args) {

  $('.preloader').fadeIn();

     var dataval = {};
    

     if (args.requestType == "update") {
                $.extend(dataval, args.currentValue);
      } else {
                $.extend(dataval, args.data.item);
     }
     var tipoGrupo = 0;

     console.log("Datos editar",dataval);
     if(dataval.id_grupo == 0){
       
      tipoGrupo == dataval.id_grupo;
     }else{
      tipoGrupo = 1;
     }


      var formData = new FormData();
      formData.append("id", dataval.id);
      formData.append("insumo", dataval.insumo );
      formData.append("codigo", dataval.codigo );
      if( !dataval.valor_unitario ){ dataval.valor_unitario=0;  }
      formData.append("valor_unitario", dataval.valor_unitario);

      if(dataval.id_proyecto){ 
        formData.append("id_proyecto", dataval.id_proyecto );  
      }else{
        formData.append("id_proyecto", 0 );  
      }
      
    

      $.ajax({
         type: "post",
         async: true,
         url: API_URL + 'insumos_proyecto/editar_insumo_base',
         cache: false,
         contentType: false,
         processData: false,
         headers: { 'token' : TOKENCOPRES },
         data:formData
      })
      .done(function(resul) {
     
        if(resul.estado=='OK'){
          $('.preloader').fadeOut();
        
          TGPO3_refrescar_row(dataval.id, resul.insumos_m[0]);
          TGP03_refrescar_checks();
          
       
          
          
          $.notify("actualizado","success");  
        }
            
    })
    .fail( function (jqXHR, status, error) {
                $('.preloader').fadeOut();
                let estado=jqXHR.responseJSON.estado;
               TGNO3_NO_AUTORIZADO(estado,'no tiene privilegios suficientes para borrar usuarios');
     });

     

}


function TGPO3_refrescar_row(id, info) {
            

          
            var treeObj = $("#TreeGridContainer_003").data("ejTreeGrid");
            let dato= treeObj.model.updatedRecords; 
            let indexrealfila = dato.findIndex(x => x.id==id);
            
            var record = $.grep(treeObj.model.updatedRecords, function(e) {
                return e.id == id;
            });

             if(info.tipo!=0){
       
             record[0].id_grupo = record[0].item.id_capitulo=info.id_grupo;
             record[0].tipo_insumo = record[0].item.tipo_insumo=info.tipo_insumo;
             treeObj.refreshRow(indexrealfila);
             treeObj.refreshContent();    
            
            }

            let indexcapitulo=dato.findIndex(function(x) { 
              if(x.tipo==0){ return x.id==info.id_grupo ; }
            });

            treeObj.sortColumn("codigo", ej.sortOrder.Ascending);
            treeObj.refreshRow(indexcapitulo); 
            treeObj.refresh();

}


function TGPO3_borrar_insumo(idfila){

  

    var treeObj = $("#TreeGridContainer_003").data("ejTreeGrid");
    let dato= treeObj.model.updatedRecords;
    let index = dato.findIndex(x => x.id==idfila);
    var grid = $("#TreeGridContainer_003").ejTreeGrid("instance");
    var record1 = grid.getCurrentViewData()[index]; 
    var primaryKeyValue=record1['id'];

   

    var obj = $("#TreeGridContainer_003").data("ejTreeGrid"),
    updatedRecords = obj.model.updatedRecords;
    record = updatedRecords.filter(function(data){return data.id == primaryKeyValue  });        
    obj.selectRows(updatedRecords.indexOf(record[0]));        
    obj.deleteRow();

}

function TGPO3_agregar_hijo(idfila,tipo,id_proyecto){
                          
                          //var index = this.element.closest("tr").index(); 
                           var treeObj = $("#TreeGridContainer_003").data("ejTreeGrid");
                           updatedRecords = treeObj.model.updatedRecords;
                           record = updatedRecords.filter(function(data){return data.id == idfila  });        
                           treeObj.selectRows(updatedRecords.indexOf(record[0]));   
                                               
                          var data=    {
                                          "id": 0,
                                          "tipo": tipo,
                                          "codigo": 0,
                                          "insumo": "INSUMO DEFAULT",
                                          "unidad": "-",
                                          "cantidad": "0",
                                          "valor_unitario": 0,
                                          "id_proyecto":id_proyecto,
                                          "id_grupo":idfila,
                                          "level":1,
                                          "createdAt": "2018-04-26T16:04:32.000Z",
                                          "updatedAt": "2018-04-26T16:05:17.000Z"
                                        };

                                         
                          console.log('la dada en fila',data);

                          treeObj.addRow(data,ej.TreeGrid.RowPosition.Child);
                           

                         

}


function TGPO3_queryCellInfo(args) {

 

  


    if (args.column.field == "unidad") {
      if(args.data.level==0){  args.cellElement.innerHTML='';  }
    }

    if (args.column.field == "cantidad") {

      if(args.data.level==0){  args.cellElement.innerHTML='';  }
    }

    if (args.column.field == "valor_unitario") {
      if(args.data.level==0){  args.cellElement.innerHTML='';  }
    }

    if (args.column.iden == "btn_checkBox") {
     
      if(args.data.level==0){  args.cellElement.innerHTML='';  }
    }


    if (args.column.iden == "btn_agregar") {
     
      if(args.data.level==1){  args.cellElement.innerHTML='';  }
    }


    if (args.column.iden == "btn_base") {
     
      if(args.data.level==1){ 

        if(args.data.id_proyecto>0){
             args.cellElement.innerHTML='<i class="fa fa-check"></i>';  
        }
        else
        {
             args.cellElement.innerHTML='';  
        }

        
        
      }


    }
        

 





}



function TGPO3_bloquear_add(){


  var timeoutId = setTimeout(function() {
                  $(".e-table tr.e-addedrow td input").each(function() {
                                    
                                 
                                    $('#TreeGridContainer_003tipo').closest( "td" ).hide();
                                    $('#TreeGridContainer_003unidad').closest( "td" ).hide();
                                    $('#TreeGridContainer_003cantidad').closest( "td" ).hide();
                                    $('#TreeGridContainer_003valor_unitario').closest( "td" ).hide();
                                    $('#TreeGridContainer_003val_parcial').closest( "td" ).hide();
                                    $('#TreeGridContainer_003TGcolumn9').closest( "td" ).hide();
                                    $('#TreeGridContainer_003TGcolumn10').closest( "td" ).hide();
                                    $('#TreeGridContainer_003insumo').closest( "td" ).attr('colspan','7');

                                   
                    });                
              
              clearTimeout(timeoutId);
  }, 30);
              

}


function TGPO3_checkeado(id,codigo,idProyecto,idActividad,idGrupo){

  if( $('#checkbox_insumo_'+id+'').is(':checked') ){

      
       TGP03_anexar_insumo(id,codigo,idProyecto,idActividad,idGrupo);


  }
  else {
      TGP03_retirar_insumo(id,idProyecto,idActividad);
    
  }



}



function TGP03_anexar_insumo(id,codigo,idProyecto,idActividad,idGrupo){

    $('.preloader').fadeIn();

        let treegridObj = $("#TreeGridContainer_003").data("ejTreeGrid");
        
        var gie = treegridObj.model.dataSource.find(function(item, i){
               if(item.id==idGrupo ){
                  return item;
               }
         });

        if(gie){

        var formData = new FormData();
        formData.append("id_insumo", id);
        formData.append("codigo_insumo", codigo);
        formData.append("id_actividad",idActividad );
        formData.append("id_proyecto", idProyecto);
        formData.append("nom_grupo", gie.insumo);
        formData.append("cod_grupo", gie.codigo);

        }

        if(!gie){

        var formData = new FormData();
        formData.append("id_insumo", id);
        formData.append("codigo_insumo", codigo);
        formData.append("id_actividad",idActividad );
        formData.append("id_proyecto", idProyecto);
        formData.append("nom_grupo", 'grupo');
        formData.append("cod_grupo", '000');

        }

    
       
         $.ajax({
               type: "post",
               async: true,
               url: API_URL + 'apu_proyectos/nuevo_oam',
               cache: false,
               contentType: false,
               processData: false,
               headers: { 'token' : TOKENCOPRES },
               data:formData
        })
        .done(function(resul) {
 

          if(resul.estado=='anexado'){ 

           let gridObj = $("#Grid").data("ejGrid");
             //gridObj.model.dataSource.splice(0,1);
             gridObj.model.dataSource.push(resul.insumo);
             gridObj.refreshContent();
               
            $.notify("creado","success");
            if(resul.actividad.id){ 
               TGP03_actualizar_val_unitario(idActividad,resul.actividad.val_unitario,resul.actividad.val_parcial );
            }
             

          }

           if(resul.estado=='noencontrado'){ 

             
             $.notify("no encontrado","warning");         

           }

           $('.preloader').fadeOut();



        })
        .fail( function (jqXHR, status, error) {
                args.cancel=true;
                $('.preloader').fadeOut();
                let estado=jqXHR.responseJSON.estado;
                TGNO3_NO_AUTORIZADO(estado,'ha ocurrido un error');
         });



}



function TGP03_retirar_insumo(id,idProyecto,idActividad){

      $('.preloader').fadeIn();

        var formData = new FormData();
        
      
        formData.append("id_insumo", id);
        formData.append("id_actividad",idActividad );
        formData.append("id_proyecto", idProyecto);
       
         $.ajax({
               type: "post",
               async: true,
               url: API_URL + 'apu_proyectos/eliminar_oam',
               cache: false,
               contentType: false,
               processData: false,
               headers: { 'token' : TOKENCOPRES },
               data:formData
        })
        .done(function(resul) {
 

          if(resul.estado=='borrado'){

            let gridObj = $("#Grid").data("ejGrid");

         

            $.each(gridObj.model.dataSource , function(i){
                
                if(gridObj.model.dataSource[i].codigo === resul.codigo) {
                   
                      gridObj.model.dataSource.splice(i, 1);
                      gridObj.refreshContent(); 

                    return false;
                }
            });  

            $.notify("retirado","success");

            if(resul.actividad.id){ 
               TGP03_actualizar_val_unitario(idActividad,resul.actividad.val_unitario,resul.actividad.val_parcial );
            }
             

             
          }

            $('.preloader').fadeOut();



        })
        .fail( function (jqXHR, status, error) {
                args.cancel=true;
                $('.preloader').fadeOut();
                let estado=jqXHR.responseJSON.estado;
                TGNO3_NO_AUTORIZADO(estado,'ha ocurrido un error');
         });



}




function TGP03_agregar_hijo(idfila,grupo){
   $('.preloader').fadeIn();
var treeObj = $("#TreeGridContainer_003").data("ejTreeGrid");
 let dato= treeObj.model.updatedRecords;
 let index = dato.findIndex(x => x.id==idfila);
$("#TreeGridContainer_003").ejTreeGrid({ selectedRowIndex:index });
     var data= {
                "id": 0,
                "codigo":0,
                "tipo_insumo": grupo,
                "insumo": "Nuevo insumo",
                "unidad": "Und",
                "valor_unitario": "0",
                "marca": "N/A",
                "referencia": "N/A",
                "devolutivo": false,
                "id_usuario": "",
                "raiz": "",
                "codigo_barras": "",
                "fotografia": "" ,
                "ficha_tecnica": "",
                "archivo": "",
                "id_grupo": idfila,
                "tipo_grupo": 1,
                "createdAt": "2018-04-26T16:04:32.000Z",
                "updatedAt": "2018-04-26T16:05:17.000Z"
              };

    treeObj.addRow(data,ej.TreeGrid.RowPosition.Child);
     $('.preloader').fadeOut();
}



function TGP03_actualizar_insumo_add(resul,index){

   var treeGridObj=$("#TreeGridContainer_003").data("ejTreeGrid");        
    
    
    updatedRecords = treeGridObj.model.updatedRecords;
    itemToUpdate = updatedRecords[index]; 
    if (itemToUpdate) { 
    //To refresh the required record 
      var item = itemToUpdate.item;
     
      itemToUpdate.insumo = itemToUpdate.item.insumo = resul.insumos_m.insumo;  
      itemToUpdate.unidad = itemToUpdate.item.unidad = resul.insumos_m.unidad;
      itemToUpdate.codigo = itemToUpdate.item.codigo = resul.insumos_m.codigo; 

      treeGridObj.refreshRow(index); 
      treeGridObj.sortColumn("insumo", ej.sortOrder.Ascending);
      treeGridObj.refresh();
      
    }
}


function TGP03_actualizar_insumo_edit(id, info){


   var treeObj = $("#TreeGridContainer_003").data("ejTreeGrid");
  
   if(treeObj != undefined){
    let dato= treeObj.model.updatedRecords; 
    let indexrealfila = dato.findIndex(x => x.id==id);
    var record = $.grep(treeObj.model.updatedRecords, function(e) {
        return e.id == id;
    });
     if(record[0] != undefined){
      record[0].insumo = record[0].item.insumo = info.insumo;
      record[0].unidad = record[0].item.unidad = info.unidad;   
      treeObj.refreshRow(indexrealfila);
      treeObj.sortColumn("insumo", ej.sortOrder.Ascending);
      treeObj.refreshContent();
      TGP03_actualizar_checkbox();
    
     }
   }
}



function TGP03_obtener_val_unitario(){

             let gridObj = $("#Grid").data("ejGrid");
             //gridObj.model.dataSource.splice(0,1);
             let total_unitario=0;
             let idact=0;

               $.each(gridObj.model.dataSource , function(i){

                     if(gridObj.model.dataSource[i].val_parcial){
                           idact=gridObj.model.dataSource[i].id_actividad;
                           total_unitario=parseFloat(total_unitario)+parseFloat(gridObj.model.dataSource[i].valor_parcial);
                     }
                
              });  

        return total_unitario;
           
}



function TGP03_actualizar_val_unitario(idact,total_unitario,total_parcial,tipoact ){


            var treeObj = $("#TreeGridContainer").data("ejTreeGrid");
            let dato= treeObj.model.updatedRecords; 
            let indexrealfila = dato.findIndex(x => x.id== idact);
            
            var record = $.grep(treeObj.model.updatedRecords, function(e) {
                return e.id == idact;
            });

            console.log('kkkkkkk', record[0]);

         
             record[0].val_unitario = record[0].item.val_unitario=total_unitario;
             record[0].val_parcial = record[0].item.val_parcial=total_parcial;
             record[0].apu_json = record[0].item.apu_json=[{'val_parcial':'10'}];
  
             treeObj.refreshRow(indexrealfila);

             treeObj.refresh();  

}



function TGP03_actualizar_checkbox(){

   var gridObj = $("#Grid").data("ejGrid");
   var datosgrid =gridObj.model.currentViewData.records ;
   if(datosgrid){
     datosgrid.forEach(function(element) {
        
        let ncheckbox='classcod_'+element.codigo+'';
        $("."+ncheckbox+"").prop("checked", true);
        
    });
   }

}

function TGP03_mostrar_modal_insumos(){

   $("#modal_apu_insumos").modal();
   $('#sec_tabla_insumos_M').html('');
   $('#sec_tabla_insumos_O').html('');
   $('#sec_tabla_insumos_E').html('');
   $('#sec_tabla_insumos_T').html('');
   $('#sec_tabla_insumos_S').html('');

   $('#collapse_O').removeClass('show');
   $('#collapse_M').removeClass('show');
   $('#collapse_E').removeClass('show');
   $('#collapse_T').removeClass('show');
   $('#collapse_S').removeClass('show');
} 


function TGP03_refrescar_checks(){
   var gridObj = $("#Grid").data("ejGrid");

   var datosgrid =gridObj.model.currentViewData.records ;

   if(datosgrid){
     datosgrid.forEach(function(element) {
        
        let ncheckbox='classcod_'+element.codigo+'';
        $("."+ncheckbox+"").prop("checked", true);
        
     });

   }
 }













         


 