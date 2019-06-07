<!DOCTYPE html>
<html lang="en">
     @section('htmlheader')
        @include('layouts.partials.htmlheader')
    @show
    

<body  class='fixed-sn black-skin' style="background-color:#d6d6d6;" >
    <input type="hidden"  id="url_raiz_proyecto" value="{{ url("/") }}" />
    <input type="hidden"  id="_token_maestro" value="<?php echo csrf_token(); ?>" />
    
     <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Relaet Cargando</p>
        </div>
    </div>

   <!--Double navigation-->
    <header id='main_header'>

        <div class='col-md-12' style='background-color:#202020; height: 88.09px; padding-top: 17px;padding-left: 1.5rem;'>
                  <div id="logo" class="site-branding clearfix" style="max-height: 316px; ">

                    <a href="http://www.etnomatematica.org/home/" class="custom-logo-link" rel="home" itemprop="url"><img width="248" height="57" src="http://www.etnomatematica.org/home/wp-content/uploads/2018/11/cropped-logoh2.png" class="custom-logo" alt="Red Latinoamericana de Etnomatemática RELAET" itemprop="logo"></a>                    
           

        
                </div>
        </div>

    <div class='col-md-12' style='background-color:#ad0606; height: 63px;'>

        <div class='margin' style='padding-top: 15px; padding-left: 1.5rem; color:white;'>
           <a href="http://www.etnomatematica.org" style='color:white;margin-right: 20px;'>INICIO</a>

           
            <a href="{{url('listado_usuarios_publico')}}" style='color:white;margin-right: 20px;'>GENERAL</a>
           <a href="{{url('listado_publico_suramerica')}}" style='color:white;margin-right: 20px;'>SUR AMERICA</a>
           <a href="{{url('listado_publico_norteamerica')}}" style='color:white;margin-right: 20px;'>NORTE , CENTRO AMERICA Y EL CARIBE</a>
           <a href="{{url('listado_publico_europa')}}" style='color:white;margin-right: 20px;'>EUROPA Y AFRICA</a>
          

        </div>

    </div>

            
    </header>
    <!--/.Double navigation-->
    
    <!--Main layout-->




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
