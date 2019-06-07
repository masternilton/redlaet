<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>reporte</title>

       <style> 
       table{
          font-size: 0.9em;
          width: 100%;

       }
       table {
         
          border: 1px solid #dee2e6;
          border-collapse: collapse;
       }

        table tr td {
         border-collapse: collapse;
          border: 1px solid #dee2e6;
       }

       thead { display: table-header-group }
tfoot { display: table-row-group }
tr { page-break-inside: avoid }


       </style>
</head>
<body>       
	    <table    >
	    
	    	
				<thead>

					     <tr style='padding-top: 10px; padding-bottom: 10px;'>    

							<th colspan='5'  style=' padding-top: 10px; padding-bottom: 10px;' >Red Latinoamericana de Etnomatemàtica</th>
					
						</tr>
						<tr style='background-color:#dee2e6; padding-top: 10px; padding-bottom: 10px;'>    

							<th colspan='5'  style=' padding-top: 10px; padding-bottom: 10px;' >LISTADO COORDINADORES PAIS </th>
					
						</tr>
						<tr>   
						    <th style='width:30px;'>#</th>
						    <th style='width:250px;' >Nombre</th>
							<th>Email</th>
							<th>Rol</th>
							<th>Pais</th>

							
							
						</tr>
				</thead>
	    <tbody>
	  

	    @foreach($usuarios as $usuario)
	    @if($usuario->rol==2)
		<tr  >
			<td  >{{$loop->iteration}}</td>
		
			<td  style='width:40%;'>{{ $usuario->nombres.' '.$usuario->apellidos }}</td>
			<td  >{{ $usuario->email }}</td>
			<td  >{{ $usuario->nom_rol }}</td>
			<td>
				{{$usuario->pais_rol}}
           </td>
	
		</tr>
		@endif
	    @endforeach



		</tbody>
		</table>


		



</body>

</html>		