@extends('layouts.app')

@section('htmlheader_title')
	Certificados
@endsection


@section('main-content')


<h2 class="h3-responsive">Bienvenido : <span > {{ Auth::user()->name }} </span> </h2>
<hr>

<div class='row'>

<div  class='col-md-9 row'>


	 @foreach($mensajes as $mensaje)

        <div  class='col-md-6'>

		<div class="card" style='margin-bottom:10px; border-left:3px solid red;'>
		<div class="card-body">
           <div class='row'>
					<div class='col-md-3'> 
						<div class="avatar mx-auto white">
						<img src="https://st2.depositphotos.com/3326513/11225/v/950/depositphotos_112258910-stock-illustration-simple-red-letter-icon-with.jpg" class=" img-responsive" style='max-width:100px;'>
						</div> 
					</div>

					<div class='col-md-9'> 
					
							<h5 class="card-title">Mensaje</h5>
							<h6 class="card-subtitle mb-2 text-muted">De: {{$mensaje->nombre_de}}</h6>
							<h6 class="card-subtitle mb-2 text-muted">Fecha: {{$mensaje->created_at}}</h6>
							
							
							<a href="javascript:void(0);" onclick='ver_info_mensaje({{$mensaje->id}});' target='_blank' class="btn btn-sm btn-outline-danger waves-effect">Ver</a>
							
					</div>

		    </div>

			</div>
		</div>
        </div>

     @endforeach

     @if(count($mensajes)==0)
     ...no tienes notificaciones pendientes...
     @endif

		<div  class='col-md-6' style='display:none;'>

  

		<div class="card" style='margin-bottom:10px; border-left:3px solid red;'>
		<div class="card-body">
           <div class='row'>
					<div class='col-md-3'> 
						<div class="avatar mx-auto white">
						<img src="https://botcore.ai/wp-content/uploads/2018/04/Notifications.png" class=" img-responsive" style='max-width:80px;'>
						</div> 
					</div>

					<div class='col-md-9'> 
					
							<h5 class="card-title">Notificacion</h5>
							<h6 class="card-subtitle mb-2 text-muted">Red</h6>
							<p class="card-text">hay un nuevo libro recomendado</p>

							
							<a href="{{ url('listado_noticias')  }}" target='_blank' class="btn btn-sm btn-outline-danger waves-effect">leer</a>
							
						</div>

		    </div>

			</div>
		</div>
		

       </div>
		

</div>




<div class='col-md-3'>

@include('menus.menu_enlaces_red')

</div>

</div>


<div class="modal fade" id="modal_info_notificacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h3 class="modal-title" id="titulo_modal_usuarios">Mensaje</h3>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body" id='contenido_info_notificacion'>
		  ...
		</div>
	
	  </div>
	</div>
</div>

   



@endsection