@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')


<h2 class="h3-responsive">Bienvenido : <span > {{ Auth::user()->name }} </span> </h2>
<hr>

<div class='row'>

<div  class='col-md-9'>

	 <form   action="{{ url('buscar_usuario_mired') }}"  method="post"  >
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
							

							<button type="button" class="btn btn-sm btn-outline-danger waves-effect" onclick="verinfo_usuario({{ $usuario->id }})" >ver</button>
							<button type="button" class="btn btn-sm btn-outline-danger waves-effect" onclick="form_modal_mensaje({{ $usuario->id }},'{{ $usuario->name }}' );" >conectar</button>
							
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

@include('menus.menu_enlaces_red')

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


<div class="modal fade" id="modal_info_mensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h3 class="modal-title" id="titulo_modal_usuarios">Mensaje</h3>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body" id='contenido_info_mensaje'>
		 


          <!-- Default form subscription -->
<form class="text-center border border-light p-5" id='form_enviar_mensaje' method='post' style='background-color: #e0e0e0 !important; padding-top: 5px !important;'
 action="{{url('crear_mensaje')}}">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	<input type='hidden' name='para' id='para' value='0'>




      <div class="form-group">
      	<label for="exampleFormControlTextarea1">De</label>
    		<input type="text" readonly="readonly" id="nombre_de" name='nombre_de' class="form-control mb-4" value='{{Auth::user()->name}}'>
     </div>
     <div class="form-group">
     	<label for="exampleFormControlTextarea1">Para</label>
     	<input type="text" readonly="readonly" id="nombre_para" name='nombre_para' class="form-control mb-4" >
     </div>

    
	 <div class="form-group">
		  <label for="exampleFormControlTextarea1">Mensaje</label>
		  <textarea class="form-control rounded-0" id="contenido" name='contenido' rows="10"></textarea>
	 </div>

   
    <button class="btn btn-primary waves-effect waves-light  btn-block" type="submit">Enviar Mensaje</button>


      </form>



		</div>
	
	  </div>
	</div>
</div>



@section('scripts')
    @parent

    <script>
    

         US_registrar_cuenta();

    </script>
 @show
   



@endsection
