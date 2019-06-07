@extends('layouts.auth')

@section('htmlheader_title')
   Ingresar
@endsection

@section('content')



  <body style='background-color: black;'>


        <div class="preloader">
         <div class="loader">
             <div class="loader__figure"></div>
             <p class="loader__label">Redlaet Cargando</p>
         </div>
     </div>
 
         <!-- Main navigation -->
 
 
 
 <!-- Main navigation -->
 <header>

    

   <!-- Full Page Intro -->
   <div class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url( {{ asset('/assets/img/bg_003.jpg') }}); background-repeat: no-repeat; background-size: cover; background-position: center center;">
     <!-- Mask & flexbox options-->
        <div class="mask rgba-blue-slight d-flex justify-content-center align-items-center">
                <!-- Content -->

              
                <div class="container">


                        <!--Grid row-->
                        <div class="row">

                           

                                <!--Grid column-->
                                <div class="col-md-12 white-text align-items-center">
                        
                                        <div class="wow fadeInDown" data-wow-delay="0.3s">
                                            <!--Grid column-->
                                            <div class="col-md-6 col-xl-6 mb-5 mx-auto">

                                                    <!--Form-->
                                                    <form method="post" action="{{url('/login_externo')}}">
                                                           <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                       <div class="align-items-center" data-wow-delay="0.3s" style='background-color: rgba(3, 14, 19, 0.89); '>
                                                     
                                                        <div class='card-body'>
                                                      
                                                           <div class="mx-auto align-items-center" style="margin-top: 2rem; margin-bottom: 1rem">
                                                               <img class="mx-auto" src="{{ asset('/assets/img/logo_negativo.png') }}" width="200">
                                                           </div>
                                
                                                       
                                                           <div class="md-form col-xs-12">
                                                               <i class="fa fa-envelope prefix white-text active"> </i>
                                                               <input type="email" class="white-text form-control valCP_email" value="{{ old('email') }}" required id="email" name="email">
                                                               <label for="email" class="active">Email</label>
                                                           </div>
                                                            
                                                           <div class="col-xs-12">
                                                                <div class="md-form">
                                                                  <i class="fa fa-lock prefix white-text active "></i>
                                                                  <input type="password" id="password" class="white-text form-control" required name="password">
                                                                  <label for="password">Contraseña</label>
                                                                </div>
                                                           </div>

                                                           @if (count($errors) > 0)
               
        
                                                         
                                                           <ul class='red-text'>
                                                               @foreach ($errors->all() as $error)
                                                                   <li class='red-text'><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $error }}</li>
                                                               @endforeach
                                                           </ul>
                                                      
                                             
                                                           @endif
                               
                                            
                               
                                                           <div class="md-form  col-xs-12 text-center" style='margin-top:20px; '>
                                                        <div class='row'>
                                                              
                                                            </div>

                                                                   <div class="text-center ">
                                                                       
                                                                       
                                                                        <button class="btn red accent-4  m-l-5"  type="submit">Ingresar al sistema</button>
                                                           
                                                                    <hr class="hr-light mb-3 mt-4">
                                        
                                                                    <div class="inline-ul text-center d-flex justify-content-center">
                                                                        <div class="col-sm-12 text-center">
                                                                            <h6 style="color: #ffffff">No tienes una cuenta? <a href="{{url('/register')}}" class="text-danger m-l-5">Registrate Aquí</a></h6>
                                                                        </div>
                                                                    </div>
                                            
                                                                    <div class="inline-ul text-center d-flex justify-content-center">
                                                                        <div class="col-sm-12 text-center">
                                                                            <h6 style="color: #ffffff">Olvidaste tu Contraseña? <a href="{{url('/form_reset_password')}}" class="text-danger m-l-5">Recuperala Aquí</a></h6>
                                                                        </div>
                                                                    </div>
                                        
                                                                 </div>
                                                           
                                                            </div
                               
                                                        
                                                        
                                                       </div> 
                                                       </div>
                                                    </form>
                               
                                                    <!--/.Form-->
                                

                                                
                                                
                                            </div>
                                            <!--Grid column-->
                                        </div>
                        
                                </div>
                                <!--Grid column-->
                        </div>
                        <!--Grid row-->
                </div>
                <!-- Content -->
        </div>
     <!-- Mask & flexbox options-->
   </div>
   <!-- Full Page Intro -->
 </header>

 
 


 
 
 
 </body>

@endsection





