@extends('layouts.app')

@section('htmlheader')
@parent
<style>
        .black-skin .card-header, .black-skin .form-header {
            background-color: #d6d6d6;
        }
        
        .btn.btn-sm {
            padding: .3rem 1.6rem;
            font-size: .64rem;
        }
</style>

@endsection

@section('htmlheader_title')
	Correo
@endsection


@section('main-content')

@include('formularios.form_correo')

<div class="modal  fade" id="modal_usuarios" style=' background-color: rgba(0, 38, 64, 0.18);  height: auto !important;' tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog  modal-fluid" role="document" style='background-color: white !important;width: 90% !important; min-height: 800px;'>

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Usuarios para enviar Correo</h5>
                <button type="button" class="close" data-dismiss="modal" id='btn_ccorreo' aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              <div class="row">
            
                    <div class=" col-md-10">
                      <p><strong>Destinatarios del correo electronico</strong></p>
                        <div class="md-form">
                    <textarea type="text" id="correo_paraM" name="correo_paraM" rows="2" class="form-control md-textarea" readonly required placehoder='...' style='background-color:rgb(214, 214, 214);'></textarea>
                                    
                        </div>
                    </div>
                    <div class="col-md-2">
                    <input type="button" value="seleccionar" name="subscribe" class="btn btn-primary btn-md" style='height: 100px;
    margin-top: 45px;width: 100%;' onclick="javascript:$('#btn_ccorreo').click();">
                
                    </div>
                </div>

                <div class="row margin" style='margin-left:2px;' >
                            <a href="javascript:void(0);" onclick="CO_activar_tabla_usuarios();" class="btn btn-sm  blue-grey waves-effect waves-light"><i class="fa fa-user" style="margin-right:10px;"> </i>Usuarios</a>
                            <a href="javascript:void(0);" onclick="CO_activar_tabla_grupos();" class="btn btn-sm  blue-grey waves-effect waves-light"><i class="fa fa-users" style="margin-right:10px;"> </i>Paises</a>

                            <a href="javascript:void(0);" onclick="CO_activar_tabla_regiones();" class="btn btn-sm  blue-grey waves-effect waves-light"><i class="fa fa-users" style="margin-right:10px;"> </i>Regiones</a>

                             <a href="javascript:void(0);" onclick="CO_activar_tabla_coordinadores();" class="btn btn-sm  blue-grey waves-effect waves-light"><i class="fa fa-users" style="margin-right:10px;"> </i>Coordinadores</a>
                </div>
              
               <div id='sectabla_usuarios'  style='display:none;'>

               <table class="table table-hover" id="tabla-usuarios-correoA" style='width: 100% !important;'>
                    <thead >
                       
                            <th>id</th>
                            <th>nombre</th>
                         
                            <th>email</th>
                            <th>pais</th>
                            <th>ciudad</th>
                      
                            <th>anexar</th>
                     
                    </thead>
                </table>

            </div>

             <div id='sectabla_paises' style='display:none;'>
                    <table class="table table-hover" id="tabla-grupos-correoA" style='width: 100% !important;'>
                        

                      <thead>
                      <tr>
                            <th>id</th>
                            <th>continente</th>
                            <th>nombre</th>
                            <th>anexar</th>
                                    
                      </tr>
                      </thead>
                    </table>
            </div>


             <div id='sectabla_region' style='display:none;'>
                    <table class="table table-hover" id="tabla-region-correoA" style='width: 100% !important;'>
                        
                    <thead>
                    <tr>
                          <th>id</th>
                          <th>region</th>
                          <th>anexar</th>
                        
                    </tr>
                    </thead>
                    </table>
            </div>


            <div id='sectabla_coordinadores'  style='display:none;'>

               <table class="table table-hover" id="tabla-coordinadores-correoA" style='width: 100% !important;'>
                    <thead >
                       
                            <th>id</th>
                            <th>nombre</th>
                         
                            <th>email</th>
                            <th>pais</th>
                          
                      
                            <th>anexar</th>
                     
                    </thead>
                </table>

            </div>



          
           
        
                               
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="modal_enviar_correo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <!-- Change class .modal-sm to change the size of the modal -->
    <div class="modal-dialog modal-fluid" role="document">


      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title w-100" id="myModalLabel">Modal title</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
 
         
            <div class='row'>
        
           </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btn-sm">Save changes</button>
        </div>
      </div>
    </div>
  </div>





@section('scripts')
     @parent
   
     <script type="text/javascript">
	     
      $('#correo_contenido').summernote({
        placeholder: '..escribir su mensaje aqui..',
        tabsize: 2,
        height: 500
      });
    </script>

    <script>

CO_activar_tabla_usuarios();



function CO_mostrar_envio_correo(){

    $('#modal_enviar_correo').modal();
}

</script>

    
@endsection

@endsection