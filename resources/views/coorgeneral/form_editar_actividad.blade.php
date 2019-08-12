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

              
      <form   action="{{ url('coorgeneral/editar_actividad') }}"  method="post" id="f_editar_actividad" >
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
        <input type="hidden" name="id_actividad" value="{{ $actividadsel->id }}"> 
           

        <div class="col-md-12">
              <div class="form-group ">
                  <label class="col-sm-12" for="institucion">Titulo actividad</label>
                  <div class="col-sm-12" >
                  <span class="help-block" ></span> 
                  <input type="text" class="form-control" id="titulo" name="titulo"  maxlength="150" value='{{ $actividadsel->titulo }}' required >
                  </div>

              </div><!-- /.form-group -->

        </div><!-- /.col -->


  

        <div class="col-md-12">
                    <div class="form-group ">
                        <label class="col-sm-12" for="email">Descripción*</label>
                        <div class="col-sm-12" >
                        <span class="help-block" ></span> 
                        <textarea  class="form-control" id="descripcion" name="descripcion"     required  maxlength="500">{{ $actividadsel->descripcion }}</textarea>
                        </div>

                    </div><!-- /.form-group -->

         </div><!-- /.col -->

         <!-- Default unchecked -->


<label class="col-sm-6" for="email">ASIGNAR A *  </label><input type='checkbox' class='form-control' value='1' />


<div class="custom-control custom-radio">
  <input type="radio" class="custom-control-input" id="todos" name="asignado" value='1'  @if($actividadsel->asignado==1) checked @endif>
  <label class="custom-control-label" for="todos">Todos los Coordinadores</label>
</div>

<!-- Default checked -->
<div class="custom-control custom-radio">
  <input type="radio" class="custom-control-input" id="personalizado" name="asignado" value='2' @if($actividadsel->asignado==2) checked @endif>
  <label class="custom-control-label" for="personalizado">Personalizado</label>
</div>

   <div class="col-md-12" id='campo_personalizado'  @if($actividadsel->asignado==1) style='display:none;' @endif  >
                    <div class="form-group ">
                    
                        <div class="col-sm-12" >
                        <span class="help-block" ></span> 
                        <select name="asignados[]" id="asignados" class="form-control"  multiple="multiple"   style="width: 100%;">

                          <?php  
                               $arraystring=$actividadsel->usuarios?$actividadsel->usuarios:'';  
                               $arrayvals=explode('|',$arraystring);
                             

                          ?>
                        	
                        	@foreach($coordinadores as $coor)
                                   @if( in_array($coor->id,  $arrayvals ) ) 
                                       <option value='{{$coor->id}}' selected >{{$coor->name}}</option>
                                   @else
                                       <option value='{{$coor->id}}' >{{$coor->name}}</option>
                                   @endif
                              
                        	       
                        	@endforeach
                        </select>
                        </div>

                    </div><!-- /.form-group -->

   </div>


          
                  
        <div class="col-md-12" style='margin-top:20px;'>
                  
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                   </div>
                
        </div>

                   
                   </form>
                    
    </div>            
  </div>
</div>
</section>


<script>
$(function(){ $("#asignados").bsMultiSelect({}); });

 </script>

