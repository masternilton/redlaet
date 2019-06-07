@extends('layouts.app')

@section('htmlheader_title')
	Noticias
@endsection


@section('main-content')


<h2 class="h3-responsive">Bienvenido : <span > {{ Auth::user()->name }} </span> </h2>
<hr>

<div class='row'>

<div  class='col-md-9'>

          @foreach($entradas as $entrada)

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
             $images=[]; 
             $parrafos=[]; 
             $urlimagen='';
             $parrafodata=$content ;
            }

		
			foreach ($images as $img) {
			if (isset($img["src"])) {    $urlimagen= $img['src'];   break;  }
			}

			foreach ($parrafos as $parrafo) {
			if (isset($parrafo)) {    $parrafodata=utf8_decode ($parrafo);    break;  }
			}

										
									
		?>

		<div class="card" style='margin-bottom:10px; border-left:3px solid red;'>
		<div class="card-body">
           <div class='row'>
					<div class='col-md-2'> 
						<div class="avatar mx-auto white">
						<img src="{{$urlimagen}}" class=" img-responsive" style='max-width:100px;'>
						</div> 
					</div>

					<div class='col-md-10'> 
					
							<h5 class="card-title">{{ $entrada->post_title}}</h5>
							<h6 class="card-subtitle mb-2 text-muted">{{ $entrada->post_date}}</h6>
							<p class="card-text">{{ $parrafodata }}</p>

							
							<a href='{{$entrada->guid  }}' target='_blank' class="btn btn-sm btn-outline-danger waves-effect"> ver</a>
							<button type="button" class="btn btn-sm btn-outline-danger waves-effect">compartir</button>
						</div>

		    </div>

			</div>
		</div>
		@endforeach

		{{ $entradas->links() }}

</div>


<div class='col-md-3'>

@include('menus.menu_enlaces_red')

</div>

</div>

 @section('scripts')
    @parent

    <script>
    

         registrar_fecha_noticias();

    </script>
 @show
   



@endsection