<!DOCTYPE html>
<html>

 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RELAET- @yield('htmlheader_title', 'Your title here') </title>
 
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap core CSS -->

    <!-- Material Design Bootstrap -->
    <link href="{{ asset('/assets/css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/mdb.min.css') }}" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('/assets/img/favicon.png') }}"/>
    <link href="{{ asset('/assets/css/spinners.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/plugins/sweetalert/sweetalert.css') }} " rel="stylesheet" type="text/css">
    <link href="{{ asset('/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>


@yield('content')

<script type="text/javascript" src="{{ asset('/assets/js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/mdb.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/sammy/lib/sammy.js') }}"></script>
<script src="{{ asset('/assets/plugins/sammy/lib/plugins/sammy.template.js') }}"></script>
<script src="{{ asset('/assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
<script src="{{ asset('/assets/js/lib/globals_acceso.js') }}"></script>  
<script src="{{ asset('/assets/plugins/jqueryui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/assets/js/acceso.js') }}"></script> 


<script>
      $('.preloader').fadeOut();
      new WOW().init();
      
     
</script>

</html>