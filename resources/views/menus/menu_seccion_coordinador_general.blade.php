@if(Auth::user()->rol==1 )

<div class="margin" id="botones_control">
              <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(4);">Nuevo usuario</a>
             <a href="{{ url("/listado_usuarios_coorgeneral") }}"  class="btn btn-xs btn-primary" >Mis Usuarios</a> 


              <a href="{{ url("/listado_coordinadoresregion_coor") }}"  class="btn btn-xs btn-primary" >Mis Coordinadores Region</a> 

             <a href="{{ url("/listado_coordinadorespais_coor") }}"  class="btn btn-xs btn-primary" >Mis Coordinadores Pais</a> 
              

              <a href="{{ url("/listado_coordinadoreszona_coor") }}"  class="btn btn-xs btn-primary" >Mis Coordinadores Zona</a> 
               
               <a href="{{ url("/solicitudes_registro_coor") }}"  class="btn btn-xs btn-primary" >Solicitudes</a> 


                 <a href="{{ url("listado_borrados") }}"  class="btn btn-xs btn-primary" >Borrados</a> 
			
			
                                             
</div>
@endif


