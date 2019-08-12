@extends('layouts.app')

@section('htmlheader_title')
	Actividades del Sistema
@endsection


@section('main-content')


<section  id="contenido_principal">

	

<div class="box box-primary box-gris">

     <div class="box-header">
         @include('encabezados.encabezado_coordinadores_general') 
         @include('menus.menu_listado_actividades') 
    </div>

<div class="box-body box-white">

    <div class="table-responsive" >

	    <table  class="table table-hover table-striped" cellspacing="0" width="100%">
	    	  <thead>
						<tr>    

							<th colspan='4'>Listado de Actividades Completas del sistema</th>
							
						</tr>
				</thead>
				<thead>
						<tr>    <th style='width: 50px;'>#</th>
							
								<th>Actividad</th>
								<th style='width: 100px;' >estado</th>
							
							  
							    <th style='width: 150px;'></th>
							 
						</tr>
				</thead>
	    <tbody>

	   <tr>
	
	   
	   </tr> 	

	    	

	    @foreach($actividades as $actividad)
		<tr role="row" class="odd" id='TR_actividad_{{ $actividad->id }}'>
			<td  >{{$loop->iteration}}</td>
		
			<td class="mailbox-messages mailbox-name"><a href="javascript:void(0);"  style="display:block"><i class="fa fa-pencil"></i>&nbsp;&nbsp;<span id='LU_nombres_{{$actividad->id}}'>{{ $actividad->titulo }}</span></a></td>
			
            @if($actividad->estado==0)    
			<td id='LU_email_{{$actividad->id}}' style='background-color: #ffe2bbf2; text-align:center;'>
				ACTIVA

			</td>
			@endif

			@if($actividad->estado==1)    
			<td id='LU_email_{{$actividad->id}}' style='background-color: #ccffbbf2; text-align:center;' >
				COMPLETA

			</td>
			@endif
		
          
		    <td>
		    <button type="button" class="btn-default btn-super-xs" onclick="ACT_ver_actividad({{  $actividad->id }})" title='editar' ><i class="fa fa-fw fa-edit"></i></button>
           
			<button type="button"  class="btn-danger btn-super-xs"  onclick="ACT_borrado_actividad({{  $actividad->id }});"  title='borrar' ><i class="fa fa-fw fa-remove"></i></button>
			</td>
		</tr>
	    @endforeach



		</tbody>
		</table>

	</div>
</div>
<div class="modal fade" id="modal_info_actividades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h3 class="modal-title" id="titulo_modal_actividades"></h3>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body" id='contenido_info_actividades'>
		  ...
		</div>
	
	  </div>
	</div>
</div>
	
<div class="modal fade" id="modal_info_rol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="titulo_modal_rol"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id='contenido_info_rol'>
				...
			</div>
		
			</div>
		</div>
</div>




{{ $actividades->links() }}

@if(count($actividades)==0)


<div class="box box-primary col-xs-12">

<div class='aprobado' style="margin-top:70px; text-align: center">
 
<label style='color:#177F6B'>
              ... no se encontraron actividades aun ...
</label> 

</div>

 </div> 


@endif

</div></section>
@endsection