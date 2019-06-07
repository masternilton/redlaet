<section class="content" >

        <div class="col-md-12">
       
         <div class="box box-primary  box-gris">
        
           <div class="box-body">
       
                <div class="box-header with-border my-box-header margin" style="margin-bottom:15px;margin-top: 15px;">
                        
                        <h5 class="box-title">Formaciòn Acadèmica</h5>
                        <button class='btn btn-xs btn-primary waves-effect waves-light' onclick='javascript:$("#f_crear_estudio").show();' >agregar</button> 
                </div>

               
                       
               
       
                     
             <form   action="{{ url('crear_estudio') }}"  method="post" id="f_crear_estudio" class="form_D" style='display:none;'>
               <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
               <input type="hidden" name="id_usuario" value="{{ $usuario->id }}"> 
              
       
       
               <div class="row">
       
               
       
               
              

              
              
       
                       <div class="col-md-12">
                         <div class="form-group ">
                           <label class="col-sm-12" for="clase">Tipo*</label>
                           <div class="col-sm-12" >
                            <span class="help-block" </span> 
                              <select class='browser-default form-control' name='tipo' required>
                                 <option value='' disabled selected>..seleccione..</option>
                                  <option >Estudiante</option>
                                  <option >Titulado</option>
                              </select>
                           </div>
       
                           </div><!-- /.form-group -->
       
                         </div><!-- /.col -->

                         <div class="col-md-12">
                                <div class="form-group ">
                                  <label class="col-sm-12" for="clase">Tipo de Tìtulo*</label>
                                  <div class="col-sm-12" >
                                   <span class="help-block" </span> 
                                     <select class='browser-default form-control' name='tipo_titulo' required>
                                        <option value='' disabled selected>..seleccione..</option>
                                         <option >PREGRADO</option>
                                         <option >MAESTRIA</option>
                                         <option >DOCTORADO</option>
                                         <option >POSTDOCTORADO</option>
                                     </select>
                                  </div>
              
                                  </div><!-- /.form-group -->
              
                        </div><!-- /.col -->
       
                         <div class="col-md-12">
                           <div class="form-group ">
                               <label class="col-sm-12" for="titulo">Tìtulo*</label>
                               <div class="col-sm-12" >
                               <span class="help-block" ></span> 
                               <input type="text" class="form-control" id="titulo" name="titulo"    required >
                               </div>
       
                           </div><!-- /.form-group -->
       
                         </div><!-- /.col -->
                         <div class="col-md-8">
                                <div class="form-group ">
                                    <label class="col-sm-12" for="Universidad">Universidad*</label>
                                    <div class="col-sm-12" >
                                    <span class="help-block" ></span> 
                                    <input type="text" class="form-control" id="universidad" name="universidad"    required >
                                    </div>
            
                                </div><!-- /.form-group -->
            
                        </div><!-- /.col -->
                        <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="col-sm-12" for="anio">Año*</label>
                                    <div class="col-sm-12" >
                                    <span class="help-block" ></span> 
                                    <select class='browser-default form-control' name='anio'>
                                    @for($i=1900; $i<=2100;$i++)
                                      <option>{{ $i }}</option>
                                    
                                    @endfor
                                    </select>
                                    </div>
            
                                </div><!-- /.form-group -->
            
                        </div><!-- /.col -->
                         
                       <div class="col-md-12" style='margin-top:20px;'>
                         
                         <div class="form-group">
                           <button type="submit" class="btn btn-primary">Agregar</button>
                          </div>
                       
                         </div>
       

       
            </form>
                           
           </div>            
         </div>
       </div>

       <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">tipo</th>
                <th scope="col">clase</th>
                <th scope="col">titulo</th>
                <th scope="col">universidad</th>
                <th>borrar</th>
              </tr>
            </thead>
            <tbody id='TBODY_estudios'>
                    @foreach($estudios as $estudio) 

                          <tr id='TR_estudio_{{ $estudio->id }}'>
                            <th scope="row">{{ $estudio->tipo }}</th>
                            <td>{{ $estudio->tipo_titulo }}</td>
                            <td>{{ $estudio->titulo }}</td>
                            <td>{{ $estudio->universidad.'-'.$estudio->anio }}</td>
                            <td><button type="button"  class="btn-danger btn-super-xs"  onclick="borrar_estudio({{  $estudio->id }});"  title='borrar' ><i class="fa fa-fw fa-remove"></i></button></td>
                          </tr>


                    @endforeach
                  
             
            
            </tbody>
          </table>
          @if(count($estudios)==0)
          <div style='color:green'>...aun no se ha agregado informaciòn academica...</div>
                        
          @endif
</section>