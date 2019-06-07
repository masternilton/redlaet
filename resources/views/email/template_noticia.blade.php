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
    <h5 class='colorrojo'>mas informacòn en:  <a class='colorrojo' href="{{ $datos['noticia']->guid }}">{{ $datos['noticia']->guid }}</a></h5>
    </div>
    <div  class='card' >

     <h4>{!! $datos['noticia']->post_title !!}</h4>
     <br/>
     <p> </p>
     <div align="center">
    
    {!! $datos['noticia']->post_content !!}
    </div>

       <p></p>
    
    </div>


     <div  class='footer' >
     <br/>
     <a href='{{ $datos['noticia']->guid }}'  class='colorrojo'>visitenos en {{ $datos['noticia']->guid }}</a>
     <p>2018</p>

    
    </div>


	
</body>
</html>