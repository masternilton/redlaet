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

	</style>
</head>
<body class='bodys'>

<div class='logo-container'>
    <h4>RED LATINOAMERICANA DE ETNOMATEMÀTICA</h4>
    <h5 class='colorrojo'>Recuparacion de contraseña</h5>
    </div>
    <div  class='card' >

     Hola {{ $user->name }}
     <br/>
     <p>ha solicitado recuperar sus datos de acceso a la Red Latinoamericana de Etnomatemàtica
     <br> sus datos de acceso son los sigueintes:
     </p>
     <p>email: <span class='colorrojo' ><b>{{$user->email}}</b></span> </p>
     <p>Password: <span class='colorrojo' ><b>{{$password}}</b></span>  </p>

       <p>El password es temporal y podrà cambiarlo cuando desee al ingresar al sistema</p>
    
    </div>


     <div  class='footer' >
     <br/>
     <a href='http://etnomatematica.org'  class='colorrojo'>visitenos en www.etnomatematica.org </a>
     <p>2018</p>

    
    </div>


	
</body>
</html>