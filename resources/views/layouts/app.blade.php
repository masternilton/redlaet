<!DOCTYPE html>
<html lang="en">
     @section('htmlheader')
        @include('layouts.partials.htmlheader')
    @show
    

<body  class='fixed-sn black-skin' style="background-color:#d6d6d6;" >
    <input type="hidden"  id="url_raiz_proyecto" value="{{ url("/") }}" />
    <input type="hidden"  id="id_raiz_usuarioactual" value="{{ Auth::user()->id }}" />
    <input type="hidden"  id="rol_raiz_usuarioactual" value="{{ Auth::user()->rol }}" />
    <input type="hidden"  id="_token_maestro" value="<?php echo csrf_token(); ?>" />
    
     <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Relaet Cargando</p>
        </div>
    </div>

   <!--Double navigation-->
    <header id='main_header'>

            @include('layouts.partials.mainheader') 
    </header>
    <!--/.Double navigation-->
    
    <!--Main layout-->


<div id='modal_formularios' class='div_modal' ></div>
     <div id='div_formularios' class='div_contenido' style='display:none; background-color:#ffffff; min-height:600px; max-width: 800px; margin:0 auto; transition: opacity .15s linear;' >
     <div class="modal-header blue-gradient white-text" style='box-shadow: 0 5px 11px 0 rgba(0,0,0,.18), 0 4px 15px 0 rgba(0,0,0,.15); margin-top: -40px; text-align: center; margin-left: 12px; margin-right: 12px; border-bottom: none; border-radius: 0px; padding:1.5rem;'>
        <h4 class="title mx-auto" id='titulo_modal' style='margin-bottom: 0; width: 100%; font-size: 1.25rem'> </h4>
        <span class='close btn-cerrar' style='opacity: 1;  text-shadow: none; color: #fff;outline: 0;' aria-hidden="true">×</span>
        </div>                     
        <div  id='div_formularios_contenido' style='margin-top: 25px;' ></div>
</div> 

<div class="modal fade" id="modal_borrado_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog " role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">Borrar Usuario?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal_contenido_borrado_usuario">


      <form id="form_borrado_usuario_modal" method="post">
         <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
         <input id="id_usuario_borrado" name="id_usuario_borrado" type="hidden" value="0">
         <label class="active">Escriba una justificaciòn</label>
         <div class="form-group">
            <textarea required class="form-control rounded-0" name="justificacion" rows="3" placeholder="..."></textarea>
        </div>

         <button type="submit" class="btn btn-primary btn-sm"> Si Borrar Usuario</button>

      </form>

      </div>
      <div class="modal-footer">
       
       
      </div>
    </div>
  </div>
</div>
<!-- Central Modal Small -->



    <main  style="min-height: 575px; padding-top:1em" >

    <div id='body_principal'>

            @yield('main-content')
              
    </div>
    <!-- body principal -->
        
    </main>
    <!--/Main layout-->

    @include('layouts.partials.footer')

    @section('scripts')
    @include('layouts.partials.scripts')
    @show



</body>

</html>
