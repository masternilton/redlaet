@extends('layouts.app')

@section('htmlheader_title')
	Certificados
@endsection


@section('main-content')


<h2 class="h3-responsive">Bienvenido : <span > {{ Auth::user()->name }} </span> </h2>
<hr>

<div class='row'>

<div  class='col-md-9'>

  

		<div class="card" style='margin-bottom:10px; border-left:3px solid red;'>
		<div class="card-body">
           <div class='row'>
					<div class='col-md-12'> 
						<div class="avatar mx-auto white">
						<img src="https://st2.depositphotos.com/5266903/8487/v/950/depositphotos_84879234-stock-illustration-medical-certificate-icon.jpg" class=" img-responsive" style='max-width:100px;'>
						</div> 
					</div>

					<div class='col-md-12'> 
					
							<h5 class="card-title">Certificado de la Red</h5>
							<h6 class="card-subtitle mb-2 text-muted">Certificado Red</h6>
							<p class="card-text">Certificado de pertenencia a la red latinoamericana de etnomatematica</p>

							
							<a href="{{url('generar_certificado')  }}" target='_blank' class="btn btn-sm btn-outline-danger waves-effect">ver certificado</a>
							
						</div>

		    </div>

			</div>
		</div>

        @if($escoordinador)

	    <div class="card" style='margin-bottom:10px; border-left:3px solid red;'>
		<div class="card-body">
           <div class='row'>
					<div class='col-md-12'> 
						<div class="avatar mx-auto white">
						<img src="https://st2.depositphotos.com/5266903/8487/v/950/depositphotos_84879234-stock-illustration-medical-certificate-icon.jpg" class=" img-responsive" style='max-width:100px;'>
						</div> 
					</div>

					<div class='col-md-12'> 
					
							<h5 class="card-title">Certificado de Coordinador</h5>
							<h6 class="card-subtitle mb-2 text-muted">Certificado Red</h6>
							<p class="card-text">Certificado de coordinador de la Red</p>

							
							<a href="{{url('generar_certificado_coordinador')  }}" target='_blank' class="btn btn-sm btn-outline-danger waves-effect">ver certificado</a>
							
						</div>

		    </div>

			</div>
		</div>

		@endif
	

		

</div>


<div class='col-md-3'>

@include('menus.menu_enlaces_red')

</div>

</div>



   



@endsection