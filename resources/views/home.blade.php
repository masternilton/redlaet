@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

@if(Auth::user()->rol==1)
<h2>Coordinador General RELAET</h2>
@endif

@if(Auth::user()->rol==2)
<h2>Coordinador de País  RELAET</h2>
@endif


@if(Auth::user()->rol==3)
<h2>Coordinador de Zona RELAET</h2>
@endif

@if(Auth::user()->rol==5)
<h2>Coordinador de Región RELAET</h2>
@endif



<h4 class="h4-responsive">Bienvenido : <span > {{ Auth::user()->name }} </span> </h4>
<hr>
<div class='row'>
<div class='col-md-9'>
    <div class='row'>
	  
	   
        <div class="col-lg-4">

				<!--Card Dark-->
				<div class="card card-dark"  style='border-left:5px solid red;'>
					<!--Card image-->
				
					<div class="card-body dark-text ">
						
					
						
						<h4 class="card-title"><i class="fa fa-users " style='color:red;'></i> Usuarios</h4>
						<hr style='color:#039be5; ' >
						<!--Text-->
						<p class="font-small mb-4">Usuarios generales del sistema </p>
						<a href="{{ url('/listado_usuarios') }}" class="d-flex justify-content-end" style='color:red;'>
							<h5>Ingresar</h5>
							<span>
								<i class="fa fa-chevron-right pl-2"></i>
							</span>
						</a>
					</div>
					<!--/.Card content-->
				</div>
				<!--/.Card Dark-->

		</div>


		<div class="col-lg-4">

				<!--Card Dark-->
				<div class="card " style='border-left:5px solid red;'>
					<!--Card image-->
				
					<div class="card-body  dark-text">
						
					
						
						<h4 class="card-title"><i class="fa fa-envelope " style='color:red;'></i> Correo</h4>
						<hr style='color:#039be5; '>
						<!--Text-->
						<p class="font-small mb-4">Enviar emails a usuarios o grupos </p>
						<a href="{{ url('/seccion_correo') }}" class=" d-flex justify-content-end" style='color:red;'>
							<h5>Ingresar</h5>
							<span>
								<i class="fa fa-chevron-right pl-2"></i>
							</span>
						</a>
					</div>
					<!--/.Card content-->
				</div>
				<!--/.Card Dark-->

		</div>

		<div class="col-lg-4">

				<!--Card Dark-->
				<div class="card card-dark"  style='border-left:5px solid red;'>
					<!--Card image-->
				
					<div class="card-body dark-text">
						
					
						
						<h4 class="card-title"><i class="fa fa-newspaper-o " style='color:red;'></i> Noticias</h4>
							<hr style='color:#039be5; '>
						<!--Text-->
						<p class="font-small mb-4">Noticias del blog - enviar entradas </p>
						<a href="{{ url('/listado_entradaswp') }}" class=" d-flex justify-content-end" style='color:red;'>
							<h5>Ingresar</h5>
							<span>
								<i class="fa fa-chevron-right pl-2"></i>
							</span>
						</a>
					</div>
					<!--/.Card content-->
				</div>
				<!--/.Card Dark-->

		</div>
	</div>

     <div class='row' style='margin-top:20px;'>
			<div class="col-lg-4">

					<!--Card Dark-->
					<div class="card card-dark"  style='border-left:5px solid red;'>
						<!--Card image-->
					
						<div class="card-body dark-text">
							
						
							
							<h4 class="card-title"><i class="fa fa-users " style='color:red;'></i> Coordinador</h4>
							<hr style='color:#039be5; '>
							<!--Text-->

							@if(Auth::user()->rol==1)
							<p class="font-small mb-4">Coordinador General RELAET</p>
							@endif

							@if(Auth::user()->rol==2)
							<p class="font-small mb-4">Coordinador País  RELAET</p>
							@endif


							@if(Auth::user()->rol==3)
							<p class="font-small mb-4">Coordinador Zona RELAET</p>
							@endif

							@if(Auth::user()->rol==5)
							<p class="font-small mb-4">Coordinador Región RELAET</p>
							@endif

							
							@if(Auth::user()->rol==5)
							<a href="{{ url('/listado_usuarios_region' ) }}" class="d-flex justify-content-end" style='color:red;'>
							

							@else

                              @if(Auth::user()->rol==1)
							        <a href="{{ url('/listado_usuarios_coorgeneral' ) }}" class="d-flex justify-content-end" style='color:red;'>
							  @else
                                <a href="{{ url('/listado_usuarios_pais' ) }}" class="d-flex justify-content-end" style='color:red;'>

							  @endif


							@endif
								<h5>Ingresar</h5>
								<span>
									<i class="fa fa-chevron-right pl-2"></i>
								</span>
							</a>
							




						</div>
						<!--/.Card content-->
					</div>
					<!--/.Card Dark-->
	
			</div>
	
	
			<div class="col-lg-4">
	
					<!--Card Dark-->
					<div class="card " style='border-left:5px solid red;'>
						<!--Card image-->
					
						<div class="card-body  dark-text">
							
						
							
							<h4 class="card-title"><i class="fa fa-file-text " style='color:red;'></i> Revista Relaet</h4>
							<hr style='color:#039be5; '>

							<form id='form_revista_login' method='post' action='http://www.revista.etnomatematica.org/index.php/RevLatEm/login/signIn' target='_blank' style='display:none;'>
							<input type='text'  name='username'  value='{{Auth::user()->email}}'>
							<input type='text'  name='password'  value='relaetexterno'>

							</form>

							<!--Text-->
							<p class="font-small mb-4">Revista de la red Latinoamericana </p>
							<a href="javascript:void(0);" onclick="javascript:$('#form_revista_login').submit();"  class=" d-flex justify-content-end" style='color:red;'>
								<h5>Ingresar</h5>
								<span>
									<i class="fa fa-chevron-right pl-2"></i>
								</span>
							</a>
						</div>
						<!--/.Card content-->
					</div>
					<!--/.Card Dark-->
	
			</div>
	
			<div class="col-lg-4">
	
					<!--Card Dark-->
					<div class="card card-dark"  style='border-left:5px solid red;'>
						<!--Card image-->
					
						<div class="card-body dark-text">
							
						
							
							<h4 class="card-title"><i class="fa fa-book " style='color:red;'></i> Editorial</h4>
							<hr style='color:#039be5; '>
							<!--Text-->

						   <form id='form_editorial_login' method='post' action='http://etnomatematica.org/editorial/index.php/editorial/login/signInExterno' target='_blank' style='display:none;'>
							<input type='text'  name='username'  value='{{Auth::user()->email}}'>
							<input type='text'  name='password'  value='{{Auth::user()->password}}'>

							</form>
							<p class="font-small mb-4">Libros - Articulos - publicaciones</p>
							<a href="javascript:void(0);" onclick="javascript:$('#form_editorial_login').submit();"  class=" d-flex justify-content-end" style='color:red;'>
								<h5>Ingresar</h5>
								<span>
									<i class="fa fa-chevron-right pl-2"></i>
								</span>
							</a>
						</div>
						<!--/.Card content-->
					</div>
					<!--/.Card Dark-->
	
			</div>


			<div class="col-lg-4" style='margin-top:20px;' >
	
					<!--Card Dark-->
					<div class="card card-dark"  style='border-left:5px solid red;'>
						<!--Card image-->
					
						<div class="card-body dark-text">
							
						
							
							<h4 class="card-title"><i class="fa fa-book " style='color:red;'></i>Repositorio</h4>
							<hr style='color:#039be5; '>
							<!--Text-->

						
							<p class="font-small mb-4">Libros - Articulos - publicaciones</p>
							<a href="javascript:void(0);" onclick="javascript:$('#btn_submit_repositorio').click();"  class=" d-flex justify-content-end" style='color:red;'>
								<h5>Ingresar</h5>
								<span>
									<i class="fa fa-chevron-right pl-2"></i>
								</span>
							</a>
						</div>
						<!--/.Card content-->
					</div>
					<!--/.Card Dark-->
	
			</div>

			<div class="col-lg-4" style='margin-top:20px;'>
	
					<!--Card Dark-->
					<div class="card card-dark"  style='border-left:5px solid red;'>
						<!--Card image-->
					
						<div class="card-body dark-text">
							
						
							
							<h4 class="card-title"><i class="fa fa-book " style='color:red;'></i>Crear Entradas</h4>
							<hr style='color:#039be5; '>
							<!--Text-->

						   <form id='form_editorial_wordpres' method='GET' action='http://etnomatematica.org/home' target='_blank' style='display:none;'>
							<input type='text'  name='correo'  value='{{Auth::user()->email}}'>
							<input type='text'  name='do_login'  value='true'>

							</form>
							<p class="font-small mb-4">Crear Noticia en Blog</p>
							<a href="javascript:void(0);" onclick="javascript:$('#form_editorial_wordpres').submit();"  class=" d-flex justify-content-end" style='color:red;'>
								<h5>Ingresar</h5>
								<span>
									<i class="fa fa-chevron-right pl-2"></i>
								</span>
							</a>
						</div>
						<!--/.Card content-->
					</div>
					<!--/.Card Dark-->
	
			</div>

		

			<div class="col-lg-4" style='margin-top:20px;'>

				<!--Card Dark-->
				<div class="card " style='border-left:5px solid red;'>
					<!--Card image-->
				
					<div class="card-body  dark-text">
						
					
						
						<h4 class="card-title"><i class="fa fa-edit " style='color:red;'></i> Actividades</h4>
						<hr style='color:#039be5; '>
						<!--Text-->
						<p class="font-small mb-4">Actividades equipo coordinadores </p>
						@if(Auth::user()->rol==1)
							<a href="{{ url('/coorgeneral/seccion_actividades') }}" class=" d-flex justify-content-end" style='color:red;'>
								<h5>Ingresar</h5>
								<span>
									<i class="fa fa-chevron-right pl-2"></i>
								</span>
							</a>
						@endif


					   @if(Auth::user()->rol==2)
							<a href="{{ url('/coordinador/seccion_actividades_coordinadorP') }}" class=" d-flex justify-content-end" style='color:red;'>
								<h5>Ingresar</h5>
								<span>
									<i class="fa fa-chevron-right pl-2"></i>
								</span>
							</a>
						@endif


						 @if(Auth::user()->rol==3)
							<a href="{{ url('/coordinador/seccion_actividades_coordinadorP') }}" class=" d-flex justify-content-end" style='color:red;'>
								<h5>Ingresar</h5>
								<span>
									<i class="fa fa-chevron-right pl-2"></i>
								</span>
							</a>
						@endif

						@if(Auth::user()->rol==5)
							<a href="{{ url('/coordinador/seccion_actividades_coordinador') }}" class=" d-flex justify-content-end" style='color:red;'>
								<h5>Ingresar</h5>
								<span>
									<i class="fa fa-chevron-right pl-2"></i>
								</span>
							</a>
						@endif



					</div>
					<!--/.Card content-->
				</div>
				<!--/.Card Dark-->
 
		    </div>

		

    </div>

</div>

<div class='col-md-3'>

@include('menus.menu_enlaces_red')

</div>
</div>

 @section('scripts')
    @parent

    <script>
       US_registrar_cuenta();

    </script>
 @show

@endsection
