@extends('layouts.app')

@section('htmlheader_title')
	Usuarios
@endsection


@section('main-content')


<section  id="contenido_principal">

	

<div class="box box-primary box-gris">

     <div class="box-header">
       
<div class="row">
                <div class="col-lg-6">
                    <h2><b>Usuarios </b></h2>
                 
                </div>


                <div class="col-lg-6 text-right">

                                <a class="btn-floating btn-sm red" href="{{ url('/home') }}" data-toggle="tooltip" data-placement="top" title="Cerrar"> <i class="fa fa-power-off"> </i> </a>

               </div>

  </div>        
        <form   action="{{ url('buscar_usuario') }}"  method="post"  >
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
				<div class="input-group input-group-sm" style='margin-bottom:10px;'>
					<input type="text" class="form-control" id="dato_buscado" name="dato_buscado" required placeholder="Buscar usuario...">
					<span class="input-group-btn">
					<input type="submit" class="btn btn-primary" value="buscar" >
					</span>

				</div>

			
						
        </form>

         @include('menus.menu_listado_usuarios')

    </div>

<div class="box-body box-white">

    <div class="table-responsive" >

	    <table  class="table table-hover table-striped" cellspacing="0" width="100%">
				<thead>
						<tr>    <th>codigo</th>
							
								<th>Nombre</th>
								<th>Email</th>
								<th>Pais</th>
							   <th>Rol</th>
							   <th>Zona</th>
							    <th>Acción</th>
						</tr>
				</thead>
	    <tbody>

	    @foreach($usuarios as $usuario)
		<tr role="row" class="odd" id='TR_usuario_{{ $usuario->id }}'>
			<td  >{{$loop->iteration}}</td>
		
			<td class="mailbox-messages mailbox-name" style='max-width:250px;'><a href="javascript:void(0);"  style="display:block"><i class="fa fa-user"></i>&nbsp;&nbsp;<span id='LU_nombres_{{$usuario->id}}'>{{ $usuario->apellidos.' '.$usuario->nombres }}</span></a></td>
			<td id='LU_email_{{$usuario->id}}' >{{ $usuario->email }}</td>
			<td id='LU_pais_{{$usuario->id}}' >{{ $usuario->pais }}</td>
			<td>
				<span class="label label-default" style='font-size:0.8em' id='LU_nom_rol_{{$usuario->id}}'>
					{{$usuario->nom_rol}}
			
				-</span>
     </td>
         <td id='LU_zona_{{$usuario->id}}' >{{ $usuario->zona_rol }}</td>
			<td>
			@if($usuario->id==Auth::user()->id )
			<button type="button" class="btn-default btn-super-xs" onclick="verinfo_mi_perfil({{  $usuario->id }})" title='editar' ><i class="fa fa-fw fa-edit"></i></button>
			@else
			<button type="button" class="btn-default btn-super-xs" onclick="verinfo_usuario({{  $usuario->id }})" title='editar' ><i class="fa fa-fw fa-edit"></i></button>
			@endif
			<button type="button" class="btn-default btn-super-xs" onclick="verinfo_rol({{  $usuario->id }})" title='rol' >rol</button>
			<button type="button"  class="btn-danger btn-super-xs"  onclick="borrado_usuario({{  $usuario->id }});"  title='borrar' ><i class="fa fa-fw fa-remove"></i></button>
			</td>
		</tr>
	    @endforeach



		</tbody>
		</table>

	</div>
</div>
<div class="modal fade" id="modal_info_usuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h3 class="modal-title" id="titulo_modal_usuarios"></h3>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body" id='contenido_info_usuarios'>
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




{{ $usuarios->links() }}

@if(count($usuarios)==0)


<div class="box box-primary col-xs-12">

<div class='aprobado' style="margin-top:70px; text-align: center">
 
<label style='color:#177F6B'>
              ... no se encontraron resultados para su busqueda...
</label> 

</div>

 </div> 


@endif

</div></section>
@endsection