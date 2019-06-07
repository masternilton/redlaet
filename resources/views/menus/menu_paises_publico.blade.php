
	<div class="card">
			<div class="card-body">
				<h4 class="card-title">{{ $tituloseccion }}</h4>
				<h6 class="card-subtitle mb-2 text-muted">Paises Activos</h6>
				
				<ul class="list-group">

				@foreach($paises as $pais)	
			         @if($pais->nombre!='')
				<li class="list-group-item"><a href="{{ url('listado_publico_pais/'.$pais->nombre ) }}" style='display:block;color:#212529;'>{{ $pais->nombre }}</a>
				</li>
				    @endif

				@endforeach
               
				
		

				</ul>
			</div>

			


	</div>