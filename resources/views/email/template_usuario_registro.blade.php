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

     Buen dìa {{ $user->name }} 
     <br/>
     <p>

     <br> 
     Ha solicitado unirse a la Red Latinoamericana de Etnomatematica:
     </p>
   
    <p>Su solicitud se encuentra en proceso de aprobaciòn y sera informado por este medio cuando se haya completado el registro para poder acceder a la plataforma</p>
        <br/>

          <p>Gracias por participar en la Red</p>

      


    
    </div>


     <div  class='footer' >
     <br/>
     <a href='http://etnomatematica.org'  class='colorrojo'>visitenos en www.etnomatematica.org </a>
     <p>2018</p>

    
    </div>


	
</body>
</html>