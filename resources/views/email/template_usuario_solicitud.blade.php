    <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<style>
		
	 .bodys{
        background-color:#f2f2f2;
        text-align:center;

    }

    .card{
        background-color:white;
        margin-top:10px;
        margin:0 auto;
        padding-top:10px;
        padding-bottom:10px;
    }
    .logo-container{
        background-color:none;
        margin:0 auto;
        padding-top:20px;
        border-bottom:1px solid red;


    }

    .colorrojo{
       color:red;
    }


    .footer{
        background-color:#f2f2f2;
        margin-top:10px;
         margin:0 auto;
    }

    .myButton {
    -moz-box-shadow:inset 0px 39px 0px -24px #e67a73;
    -webkit-box-shadow:inset 0px 39px 0px -24px #e67a73;
    box-shadow:inset 0px 39px 0px -24px #e67a73;
    background-color:#e4685d;
    -moz-border-radius:4px;
    -webkit-border-radius:4px;
    border-radius:4px;
    border:1px solid #ffffff;
    display:inline-block;
    cursor:pointer;
    color:#ffffff;
    font-family:Arial;
    font-size:15px;
    padding:6px 15px;
    text-decoration:none;
    text-shadow:0px 1px 0px #b23e35;
}
.myButton:hover {
    background-color:#eb675e;
}
.myButton:active {
    position:relative;
    top:1px;
}

#table{
   
    background-color:#f2f2f2;
}

#table tr{
    background-color:#f2f2f2;
    border:3px solid white;
}

#table tr td{
    background-color:#f2f2f2;
    border:3px solid white;
}

	</style>
</head>
<body class='bodys'>

<div class='logo-container'>
    <h4>RED LATINOAMERICANA DE ETNOMATEMÀTICA</h4>
    <h5 class='colorrojo'>Solicitud de Nuevo Usuario</h5>
    </div>
    <div  class='card' >

     Solicitud de {{ $user->name }} 
     <br/>
     <p>

     <br> sus datos son los siguientes:
     </p>
   

     <table  class='card'>
        <tr>
            <td style='text-align: left;'>Nombres:</td><td style='text-align: left;' > <span class='colorrojo' ><b>{{$user->nombres}}</b></span></td>
        </tr>
         <tr>
            <td style='text-align: left;' >Apellidos:</td><td style='text-align: left;'> <span class='colorrojo' ><b>{{$user->apellidos}}</b></span></td>
        </tr>
         <tr>
            <td style='text-align: left;' >Pais:</td><td style='text-align: left;'> <span class='colorrojo' ><b>{{$user->pais}}</b></span></td>
        </tr>
         <tr>
            <td style='text-align: left;'>Ciudad:</td><td style='text-align: left;'> <span class='colorrojo' ><b>{{$user->ciudad}}</b></span> </td>
        </tr>
         <tr>
            <td style='text-align: left;'>Ocupaciòn: </td><td style='text-align: left;'> <span class='colorrojo' ><b>{{$user->ocupacion}}</b></span></td>
        </tr>
         <tr>
            <td style='text-align: left;'>Instituciòn:</td><td style='text-align: left;'> <span class='colorrojo' ><b>{{$user->institucion}}</b></span> </td>
        </tr>
          <tr>
            <td style='text-align: left;'>Email:</td><td style='text-align: left;'> <span class='colorrojo' ><b>{{$user->email}}</b></span> </td>
        </tr>

     </table>
     

       <p>¿ Desea Aprobar esta solicitud ?</p>
        <br/>

       <a href='http://etnomatematica.org/apprelaet/public/solicitudred/{{$clavesol}}'  class="myButton">APROBAR</a>


    
    </div>


     <div  class='footer' >
     <br/>
     <a href='http://etnomatematica.org'  class='colorrojo'>visitenos en www.etnomatematica.org </a>
     <p>2018</p>

    
    </div>


	
</body>
</html>