  		 	 <div class="row">
                <div class="col-lg-6">
                    <h3><b>Coordinador Regiòn</b></h3>
					 <h6 class="box-title">{{$usuario_actual->name}} -- Coordinador Regiòn {{ $usuario_actual->region_rol }}</h6>	
                 
                </div>


                <div class="col-lg-6 text-right">

                                <a class="btn-floating btn-sm red" href="{{ url('/home') }}" data-toggle="tooltip" data-placement="top" title="Cerrar"> <i class="fa fa-power-off"> </i> </a>

               </div>

  </div>  
  
   
   
  	        
       <!-- <form   action="{{ url('buscar_usuario_region') }}"  method="post"  >
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
				<div class="input-group input-group-sm" style='margin-bottom:10px;'>
					<input type="text" class="form-control" id="dato_buscado" name="dato_buscado" required placeholder="Buscar usuario...">
					<span class="input-group-btn">
					<input type="submit" class="btn btn-primary" value="buscar" >
					</span>

				</div>

			
						
   </form>-->