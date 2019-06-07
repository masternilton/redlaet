
	<div class="card">
			<div class="card-body">
				<h4 class="card-title">Mi Red</h4>
				<h6 class="card-subtitle mb-2 text-muted">Panel de enlaces</h6>
				
				<ul class="list-group">
				@if(Auth::user()->rol!=4)
				<li class="list-group-item"><a href="{{ url('/') }}" style='display:block;color:#212529;'>INICIO</a></li>
               

                @if(Auth::user()->rol==5)
				<li class="list-group-item"><a href="{{ url('solicitudes_registro_region') }}" style='display:block;color:#212529;'>SOLICITUDES<span id='numero_solicitudes'></span></a></li>
				@endif

				@if(Auth::user()->rol==1)
				<li class="list-group-item"><a href="{{ url('/solicitudes_registro_coor') }}" style='display:block;color:#212529;'>SOLICITUDES<span id='numero_solicitudes'></span></a></li>
				@endif

				@if(Auth::user()->rol==2)
				<li class="list-group-item"><a href="{{ url('/solicitudes_registro') }}" style='display:block;color:#212529;'>SOLICITUDES<span id='numero_solicitudes'></span></a></li>
				@endif

				@if(Auth::user()->rol==3)
				<li class="list-group-item"><a href="{{ url('/solicitudes_registro') }}" style='display:block;color:#212529;'>SOLICITUDES<span id='numero_solicitudes'></span></a></li>
				@endif

				
				
				@endif
				<li class="list-group-item"><a href="{{ url('listado_usuarios_red') }}" style='display:block;color:#212529;'>Usuarios</a></li>
				
                <li class="list-group-item"><a href="{{ url('listado_noticias_red') }}" style='display:block;color:#212529;'> Noticias <span id='numero_noticias'></span></a></li>
                <li class="list-group-item"><a href="{{ url('listado_certificado') }}" style='display:block;color:#212529;'>Certificados</a></li>
				<li class="list-group-item"><a href="{{ url('listado_notificaciones') }}" style='display:block;color:#212529;'>Mensajes<span id='numero_notificaciones'></span></a></li>
				<li class="list-group-item"><a href="javascript:void(0);" onclick="javascript:$('#form_revista_loginM').submit();"  style='display:block;color:#212529;'> Revista RELAET</a></li>
				<li class="list-group-item"><a href="javascript:void(0);" onclick="javascript:$('#form_editorial_loginM').submit();"  style='display:block;color:#212529;'> Editorial Red</a></li>
				
				<li class="list-group-item" >
					<a href="javascript:void(0);" onclick="javascript:$('#btn_submit_repositorio').click();"  style='display:block;color:#212529;'>Repositorio</a></li>
				
		

				</ul>
			</div>

				<form id='form_editorial_loginM' method='post' action='http://etnomatematica.org/editorial/index.php/editorial/login/signInExterno' target='_blank' style='display:none;'>
							<input type='text'  name='username'  value='{{Auth::user()->email}}'>
							<input type='text'  name='password'  value='{{Auth::user()->password}}'>

				 </form>

				 <form id='form_revista_loginM' method='post' action='http://www.revista.etnomatematica.org/index.php/RevLatEm/login/signIn' target='_blank' style='display:none;'>
							<input type='text'  name='username'  value='{{Auth::user()->email}}'>
							<input type='text'  name='password'  value='relaetexterno'>

				</form>




	<form method="post" id='form_repositorio_loginM' target='_blank' style='display:none;' accept-charset="utf-8" action="http://repositorio.etnomatematica.org/cgi/users/login" enctype="multipart/form-data"><input name="screen" id="screen" value="Login::Internal" type="hidden"><input name="login_params" id="login_params" value="target=http%3A%2F%2Frepositorio.etnomatematica.org%2Fcgi%2Fusers%2Fhome" type="hidden"><input name="target" id="target" value="http://repositorio.etnomatematica.org/cgi/users/home" type="hidden">
    
    <div class="ep_block">
     
      <input type='text'  name='login_email'  value='{{Auth::user()->email}}'>
      <input type='text'  name='login_externo'  value='redlaet'>

      <input name="login_username" id="login_username" type="text" class="ep_form_text" value='{{Auth::user()->email}}'>
      <input name="login_password" id="login_password" type="password" class="ep_form_text" value='redlaet'>
      <input value="Login" name="_action_login" id='btn_submit_repositorio' type="submit" class="ep_form_action_button">
    
    </div>
  </form>









	</div>