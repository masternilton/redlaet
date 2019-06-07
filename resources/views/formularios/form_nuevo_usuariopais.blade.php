<section class="content" >

 <div class="col-md-12">

  <div class="box box-primary  box-gris">
 
    <div class="box-body">

      
        @if (count($errors) > 0)
               
        
                                                         
        <ul class='red-text'>
            @foreach ($errors->all() as $error)
                <li class='red-text'><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $error }}</li>
            @endforeach
        </ul>
   

        @endif

              
      <form   action="{{ url('crear_usuario_pais') }}"  method="post" id="f_crear_usuariopais" class="formentrada" >
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
        <div class="row">

            <div class="col-md-6">
                    <div class="form-group  ">
                      <label class="col-sm-2" for="nombre">Nombres*   </label>
                      <div class="col-sm-10" >
                     <span class="help-block" >  </span>
                        <input type="text" class="form-control" id="nombres" name="nombres"  value="{{ old('nombres') }}"  required   >
                       
                    </div>
            </div><!-- /.form-group -->
            </div><!-- /.col -->
                
            <div class="col-md-6">
                      <div class="form-group  ">
    									  <label class="col-sm-2" for="apellido">Apellido*</label>
                        <div class="col-sm-10" >
                        <span class="help-block" > </span>  
    										<input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos') }}"  required >
                        </div>
    									</div><!-- /.form-group -->

            </div><!-- /.col -->
            
            <div class="col-md-6">
              <div class="form-group ">
                <label class="col-sm-2" for="pais">Pais*   </label>
                <div class="col-sm-10" >
               <span class="help-block" >   </span>
               
            
            <select name="pais" id="pais" class="browser-default form-control" required >	
              <option value="0" disabled >Seleccionar</option>	
              <option selected value="{{ $usuario_actual->pais_rol }}">{{ $usuario_actual->pais_rol }}</option>	
            
            	
              	
              </select>
                 
              </div>
            </div><!-- /.form-group -->
            </div><!-- /.col -->
                
            <div class="col-md-6">
                      <div class="form-group ">
                        <label class="col-sm-2" for="ciudad">Ciudad*</label>
                        <div class="col-sm-10" >
                        <span class="help-block" > </span>  
                        <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ old('ciudad') }}"  required >
                        </div>
                      </div><!-- /.form-group -->

            </div><!-- /.col -->


         
                
            <div class="col-md-6">
                      <div class="form-group  ">
                        <label class="col-sm-2" for="telefono">Telefono*</label>
                        <div class="col-sm-10" >
                        <span class="help-block" > </span>  
                        <input type="number" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}"  >
                        </div>
                      </div><!-- /.form-group -->

            </div><!-- /.col -->

            <div class="col-md-6">
              <div class="form-group ">
                  <label class="col-sm-2" for="ocupacion">Ocupaciòn</label>
                  <div class="col-sm-10" >
                  <span class="help-block" ></span> 
                  <input type="text" class="form-control" id="ocupacion" name="ocupacion"    >
                  </div>

              </div><!-- /.form-group -->

            </div><!-- /.col -->

            <div class="col-md-6">
              <div class="form-group ">
                  <label class="col-sm-2" for="institucion">Institucion</label>
                  <div class="col-sm-10" >
                  <span class="help-block" ></span> 
                  <input type="text" class="form-control" id="institucion" name="institucion"   >
                  </div>

              </div><!-- /.form-group -->

            </div><!-- /.col -->


        </div><!-- /.col -->


        <div class="row">

        

        
        <div class="box-header with-border my-box-header col-md-12" style="margin-bottom:15px;margin-top: 15px;">
                    <h5 class="box-title">Datos de acceso</h5>
        </div>
       

                <div class="col-md-6">
                  <div class="form-group ">
                    <label class="col-sm-2" for="email">eMail*</label>
                    <div class="col-sm-10" >
                     <span class="help-block" </span> 
                    <input type="email" class="form-control" id="email" name="email"  value="{{ old('email') }}"  required >
                    </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-6">
                    <div class="form-group ">
                        <label class="col-sm-2" for="email">Password*</label>
                        <div class="col-sm-10" >
                        <span class="help-block" ></span> 
                        <input type="password" class="form-control" id="password" name="password"    required >
                        </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

          
                  
                <div class="col-md-12" style='margin-top:20px;'>
                  
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Crear Nuevo Usuario</button>
                   </div>
                
                  </div>

                   


            



                  


                   </form>
                    
    </div>            
  </div>
</div>
</section>