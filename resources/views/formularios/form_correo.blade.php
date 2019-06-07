


<div class="row ">
                <div class="col-lg-6">
                    <h2><b>Correo Electronico</b></h2>
                 
                </div>


                 <div class="col-lg-6 text-right">

                          <a class="btn-floating btn-sm blue-grey" href="javascript:void(0);" onclick="CO_mostrar_individual();" data-toggle="tooltip" data-placement="top" title="individual" > <i class="fa fa-envelope"> </i> </a>
                         



                          <a class="btn-floating btn-sm blue-grey" href="javascript:void(0);" onclick="CO_mostrar_usuarios();" data-toggle="tooltip" data-placement="top" title="usuarios" > <i class="fa fa-user"> </i> </a>

                               
                                <a class="btn-floating btn-sm red" href="{{ url('/home') }}" data-toggle="tooltip" data-placement="top" title="Cerrar"> <i class="fa fa-power-off"> </i> </a>

                   
               </div>

  </div>
<div class="col-md-12">
          <div class="box box-primary">
          <form  id='form_enviar_correo' method='post' action='{{ url('enviar_correo') }}' >
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
            <input type="hidden" id='_token_correo' name="_token_correo" value="<?php echo csrf_token(); ?>"> 
            <input type="hidden" id='tipo_correo' name="tipo_correo" value="0"> 
            <!-- /.box-header -->
            <div class="box-body">
              
              <div class="form-group">
                 <textarea type="text" id="correo_para" name="correo_para" rows="1" class="form-control md-textarea"  required placeholder='para:' ></textarea>
             
              </div>

              <div class="form-group" style='margin-top:10px;'>
                <input class="form-control"  id='correo_asunto' name='correo_asunto' placeholder="Asunto:" required>
              </div>

              <div class="form-group" style='margin-top:10px;'>
                  <textarea required id='correo_contenido' name='correo_contenido' class="form-control" style="height: 300px; ">                     
                  </textarea>
              </div>

              <div class="form-group" >
                <div class="btn btn-default btn-file" style='display:block;'>
                  <i class="fa fa-paperclip"></i> Archivo
                  <input type="file" name="file_correo" id='file_correo'>
                </div>
                <div class="pull-right">
                
                  <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar correo</button>
                </div>
                <p class="help-block">Max. 10MB</p>
              </div>

            </div>
            </form>
            <!-- /.box-body -->
            <div class="box-footer">
             
             
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>

