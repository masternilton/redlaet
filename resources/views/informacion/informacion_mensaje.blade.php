<div class="card">

  <div class="card-body">

    <!-- Title -->
    <h4 class="card-title">Datos del Mensaje</h4>
    <!-- Text -->
    <p class="card-text">De: {{$mensaje->nombre_de}}</p>
    <p class="card-text">Fecha: {{$mensaje->created_at}}</p>
    <hr>
    <p class="card-text">{{$mensaje->contenido}}</p>
    <!-- Button -->
    <hr>

    <form id='form_responder_mensaje' method="post" action="{{url('responder_mensaje')}}">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" name="_token_mensaje" id='_token_mensaje' value="<?php echo csrf_token(); ?>">
     <input type='hidden' name='mensaje_id'  value='{{ $mensaje->id }}'>
    <textarea class='form-control' name="respuesta" required ></textarea>

    <a href="javascript:void(0);" onclick="javascript:$('#form_responder_mensaje').submit();" class="btn btn-sm btn-primary">Responder</a>
    <a href="javascript:void(0);" onclick='archivar_mensaje({{ $mensaje->id }});' class="btn btn-sm btn-primary">Archivar</a>
    </form>

  </div>

</div>