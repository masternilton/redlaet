@extends('layouts.apppublico')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')


<h2 class="h3-responsive">Listado {{$tituloseccion}}  </h2>
<hr>

<div class='row'>

<div  class='col-md-9'>

	 <form   action="{{ url('buscar_usuario_publico') }}"  method="post"  >
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
				<div class="input-group input-group-sm" style='margin-bottom:10px;'>
					<input type="text" class="form-control" id="dato_buscado" name="dato_buscado" required placeholder="Buscar usuario...">
					<span class="input-group-btn">
					<input type="submit" class="btn btn-primary" value="buscar" >
					</span>

				</div>

			
						
   </form>

       @foreach($usuariosgen as $usuario)

		<div class="card" style='margin-bottom:10px; border-left:3px solid red;'>
		<div class="card-body">
           <div class='row'>
					<div class='col-md-2'> 
						<div class="avatar mx-auto white">

							 @if($usuario->url_imagen)
            <img id='avatar_usuario_{{ $usuario->id }}' src="{{ 'http://etnomatematica.org/apprelaet/storage/app/public/'.$usuario->url_imagen  }}?=<?=rand(1,32000)?>"  style='width:100px; height:100px;'>
            @else
          <img src="https://st3.depositphotos.com/4326917/12573/v/950/depositphotos_125734036-stock-illustration-user-sign-illustration-white-icon.jpg" class="rounded-circle img-responsive" style='max-width:100px;'>
            @endif
						
						</div> 
					</div>

					<div class='col-md-10'> 
					
							<h5 class="card-title">{{ $usuario->name }}</h5>
							<h6 class="card-subtitle mb-2 text-muted">{{ $usuario->pais }} - {{ $usuario->ocupacion }}</h6>
							<p class="card-text">{{ $usuario->email }} <BR>{{ $usuario->pais }} - {{ $usuario->ciudad }}</p>
							

							<button type="button" class="btn btn-sm btn-outline-danger waves-effect" onclick="verinfo_usuario_publico({{ $usuario->id }})" >ver</button>
							
							
						</div>

		    </div>

			</div>
		</div>
		@endforeach

		{{ $usuariosgen->links() }}

		@if(count($usuariosgen)==0)
		<div><span>...No se encontraron resultados para su busqueda...</span></div>
		@endif

</div>


<div class='col-md-3'>

@include('menus.menu_paises_publico')

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




@endsection
