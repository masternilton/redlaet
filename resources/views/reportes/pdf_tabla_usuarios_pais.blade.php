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

							<th colspan='5'  style=' padding-top: 10px; padding-bottom: 10px;' >LISTADO USUARIOS DEL SISTEMA </th>
					
						</tr>
						<tr>   
						    <th style='width:50px;'>#</th>
						    <th style='width:250px;' >Nombre</th>
							<th>Email</th>
							<th>Pais</th>
							<th   >Ciudad</th>
							
						</tr>
				</thead>
	    <tbody>
	  

	    @foreach($usuarios as $usuario)
		<tr  >
			<td  >{{$loop->iteration}}</td>
		
			<td  style='width:40%;'>{{ $usuario->nombres.' '.$usuario->apellidos }}</td>
			<td  >{{ $usuario->email }}</td>
			<td  >{{ $usuario->pais }}</td>
			<td style='text-align: center;'>
				{{$usuario->ciudad}}
           </td>
	
		</tr>
	    @endforeach



		</tbody>
		</table>
</body>

</html>		