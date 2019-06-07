@extends('layouts.app')

@section('htmlheader_title')
	Noticias
@endsection


@section('main-content')


<section  id="contenido_principal">

	

<div class="box box-primary box-gris">

     <div class="box-header">
       
<div class="row">
                <div class="col-lg-6">
                    <h2><b>Noticias  </b></h2>
                 
                </div>


                <div class="col-lg-6 text-right">

                                <a class="btn-floating btn-sm red" href="{{ url('/home') }}" data-toggle="tooltip" data-placement="top" title="Cerrar"> <i class="fa fa-power-off"> </i> </a>

               </div>

  </div>  

  <div class="margin" id="botones_control">
             
<a href="{{ url("/listado_entradaswp") }}"  class="btn btn-xs btn-primary" >listado General</a> 
            
                                             
</div>      
        <form   action="{{ url('buscar_entrada') }}"  method="post"  >
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
				<div class="input-group input-group-sm" style='margin-bottom:10px;'>
					<input type="text" class="form-control" id="dato_buscado" name="dato_buscado" required placeholder="Buscar noticia...">
					<span class="input-group-btn">
					<input type="submit" class="btn btn-primary" value="buscar" >
					</span>

				</div>

			
						
        </form>


	

    </div>

<div class="box-body box-white">


   <div class="card-columns">

    

	    @foreach($entradas as $entrada)
    

       

                    <!--Card-->
                    <div class="card ">

                        <!--Card image-->
                        <div class="view overlay" style='padding:10px 10px 10px 10px;'>

                           


 
<?php
            $content = $entrada->post_content;
            try {
            @$doc = new DOMDocument();
            @$doc->loadHTML($content);
            $xml = simplexml_import_dom( $doc); // making xpath more simple
            $images = $xml->xpath('//img');
            $parrafos = $xml->xpath('//p');
            $urlimagen='';
            $parrafodata='';


            } catch (Exception $e) {
               
             $urlimagen='';
             $images=[]; 
             $parrafos=[]; 
             $parrafodata=$content ;
            }
           


        
            foreach ($images as $img) {
            if (isset($img["src"])) {    $urlimagen= $img['src'];   break;  }
            }

            foreach ($parrafos as $parrafo) {
            if (isset($parrafo)) {    $parrafodata=utf8_decode ($parrafo);    break;  }
            }





                                
                            
?>
                           
                            <img src="{{$urlimagen}}" class="card-img-top" alt="">
                            <a href="#">
                                <div class="mask rgba-white-slight waves-effect waves-light"></div>
                            </a>
                        </div>

                        <!--Card content-->
                        <div class="card-body">
                            <!--Title-->
                            <h5 class="card-title">{{ $entrada->post_title}}</h5>
                            <!--Text-->
                            <p class="card-text">{{ $entrada->post_date }}</p>
                            <p class="card-text">{{ $parrafodata }}</p>
                            <div class='row margin'>
                            <a href="javascript:void(0);" onclick='NT_mostrar_correo({{ $entrada->ID}});' class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-envelope" style='margin-right:10px;'> </i>Enviar</a>
                            <a href="{{$entrada->guid}}" target='_blank' class="btn btn-sm  blue-grey waves-effect waves-light"><i class="fa fa-eye" style='margin-right:10px;'> </i>ver</a>
                            </div>
                        </div>

                    </div>
                    

        
	
	    @endforeach

        @if(count($entradas)==0)

           <div>... no se encontraron entradas con esa busqueda..</did>
        @endif
    </div> 
	
</div>


<div class="modal  fade " id="modal_usuarios" style=' background-color: rgba(0, 38, 64, 0.18);  height: auto !important;' tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog  modal-fluid" role="document" style='background-color: white !important; width: 90% !important;'  >

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Usuarios para enviar Correo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<section id="dynamicContentWrapper-docsPanel" class="mb-5">
    <div class="card border border-info z-depth-0">
        <div class="card-body pb-0 text-center">
          
            <form  method="post" id="form_enviar_correo_noticias" action="{{url('/enviar_correo_noticias')}}" >
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                <input type="hidden" id='_token_correo' name="_token_correo" value="<?php echo csrf_token(); ?>"> 
                <input type="hidden" id='tipo_correo' name="tipo_correo" value="0"> 
                 <input type="hidden" id='NT_id_noticia' name="id_noticia" value="0"> 
                
                <div class="text-center font-weight-bold">
                    <div id="mce-responses" class="clear">
                        <div class="response p-4" id="mce-error-response" style="display:none"></div>
                        <div class="response p-4" id="mce-success-response" style="display:none"></div>
                    </div>
                    <div style="position: absolute; left: -5000px;" aria-hidden="true">
                        <input type="text" name="b_461480655ccce528d909d3f42_0e60d6d505" tabindex="-1" value="">
                    </div>
                </div>
                <div class="row">
            
                    <div class=" col-md-10">
                      <p><strong>Destinatarios del correo electronico</strong></p>
                        <div class="md-form">
                    <textarea type="text" id="correo_para" name="correo_para" rows="2" class="form-control md-textarea" readonly required placehoder='...' style='background-color:rgb(214, 214, 214);'></textarea>
                                    
                        </div>
                    </div>
                    <div class="col-md-2">
                    <input type="submit" value="Enviar Email " name="subscribe" class="btn btn-primary btn-md" style='height: 100px;
    margin-top: 45px;width: 100%;'>
                
                    </div>
                </div>
           
            </form>
        </div>
    </div>
</section>

           
            <div class="modal-body">
             <div class="row margin" style='margin-left:2px;' >
                            <a href="javascript:void(0);" onclick="NT_activar_tabla_usuarios();" class="btn btn-sm  blue-grey waves-effect waves-light"><i class="fa fa-user" style="margin-right:10px;"> </i>Usuarios</a>
                            <a href="javascript:void(0);" onclick="NT_activar_tabla_grupos();" class="btn btn-sm  blue-grey waves-effect waves-light"><i class="fa fa-users" style="margin-right:10px;"> </i>Paises</a>

                            <a href="javascript:void(0);" onclick="NT_activar_tabla_regiones();" class="btn btn-sm  blue-grey waves-effect waves-light"><i class="fa fa-users" style="margin-right:10px;"> </i>Regiones</a>
            </div>

           

    <div id='table_responsive' style='min-height: 700px;' >

           <div id='sectabla_usuarios'  style='display:none;'>

		   <table class="table table-hover" id="tabla-usuarios-correo" style='width: 100% !important;'>
		        <thead >
		           
		                <th>id</th>
		                <th>nombre</th>
		             
		                <th>email</th>
		                <th>pais</th>
                        <th>ciudad</th>
		          
		                <th>anexar</th>
		         
		        </thead>
		    </table>

            </div>

          
           <div id='sectabla_paises' style='display:none;'>
                    <table class="table table-hover" id="tabla-grupos-correo" style='width: 100% !important;'>
                        

                <thead>
					<tr>
					      <th>id</th>
                                <th>continente</th>
                            
                                <th>nombre</th>
                                <th>anexar</th>
                        
					</tr>
				</thead>
                    </table>
            </div>


             <div id='sectabla_region' style='display:none;'>
                    <table class="table table-hover" id="tabla-region-correo" style='width: 100% !important;'>
                        

                <thead>
                    <tr>
                          <th>id</th>
                          <th>region</th>
                          <th>anexar</th>
                        
                    </tr>
                </thead>
                    </table>
            </div>



		 
         
         </div>   
                               
            </div>
        </div>
    </div>
</div>

@section('scripts')
     @parent
   
     <script type="text/javascript">
	     
      $('#correo_contenido').summernote({
        placeholder: '..escribir su mensaje aqui..',
        tabsize: 2,
        height: 500
      });
    </script>

    <script>

NT_activar_tabla_usuarios();




</script>

    
@endsection



	









</div></section>
@endsection