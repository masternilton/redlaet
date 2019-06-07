@if(Auth::user()->rol==2 or Auth::user()->rol==1 )

<div class="margin" id="botones_control">
              <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(4);">Nuevo usuario</a>
             <a href="{{ url("/listado_usuarios_pais") }}"  class="btn btn-xs btn-primary" >Mis Usuarios Pais</a> 
              <a href="{{ url("/listado_coordinadores_zona") }}"  class="btn btn-xs btn-primary" >Mis Coordinadores Zona</a> 
               <a href="{{ url("/solicitudes_registro") }}"  class="btn btn-xs btn-primary" >Solicitudes</a> 
			
                                             
</div>
@endif


@if(Auth::user()->rol==3)

<div class="margin" id="botones_control">
              <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(4);">Nuevo usuario</a>
             <a href="{{ url("/listado_usuarios_pais") }}"  class="btn btn-xs btn-primary" > Usuarios Pais</a> 
               <a href="{{ url("/solicitudes_registro") }}"  class="btn btn-xs btn-primary" >Solicitudes</a> 
			
                                             
</div>
@endif