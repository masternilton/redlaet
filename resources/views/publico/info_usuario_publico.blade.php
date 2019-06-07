

 <!-- Nav tabs -->
 <ul class="nav nav-tabs md-tabs nav-justified">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">Datos</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panel3" role="tab">Imagen</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panel4" role="tab">Estudios</a>
    </li>
</ul>
<!-- Tab panels -->
<div class="tab-content card">
    <!--Panel 1-->
    <div class="tab-pane fade in show active" id="panel1" role="tabpanel">
          

          <section class="content" >

            <div class="col-md-12">
          
            <div class="box box-primary  box-gris">
            
              <div class="box-body">
          
                
                  @if (count($errors) > 0)
                          
                  
                                                                    
                  <ul class='red-text'>
                      @foreach ($errors->all() as $error)
                          <li class='red-text'><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $error }}</li>
                      @endforeach
                  </ul>
              
          
                  @endif
          
                        


                  <form  style=' padding-top:20px;' >
                 



                  <div class="row" >

                  <table class="table table-striped">
  <thead>
  
  </thead>
  <tbody>
    <tr>
    
      <td><label class="col-sm-10" style='font-weight:bold;'  for="nombre">Nombres*   </label></td>
      <td><span   >{{ $usuario->nombres }}</span></td>
     
    </tr>
    <tr>
   
      <td><label class="col-sm-10" style='font-weight:bold;'  for="apellido">Apellido*</label></td>
      <td> <span  >{{ $usuario->apellidos }}</span></td>
     
    </tr>

    <tr>
   
      <td><label class="col-sm-10" style='font-weight:bold;'  for="pais">Pais  </label></td>
      <td>  <span >{{ $usuario->pais }}</span></td>
     
    </tr>

    <tr>
   
      <td><label class="col-sm-10" style='font-weight:bold;'  for="ciudad">Ciudad</label></td>
      <td>  <span  >{{ $usuario->ciudad }}</span></td>
     
    </tr>

        <tr>
   
      <td><label class="col-sm-10" style='font-weight:bold;'  for="telefono">Telefono</label></td>
      <td> <span >{{ $usuario->telefono }}</span> </td>
     
    </tr>

        <tr>
   
      <td>     <label class="col-sm-10" style='font-weight:bold;'  for="ocupacion">Ocupacion</label></td>
      <td>  <span>{{ $usuario->ocupacion }}</span></td>
     
    </tr>

    <tr>
   
      <td>      <label class="col-sm-10" style='font-weight:bold;'  for="institucion">Institucion</label></td>
      <td>   <span style='margin-left:10px; ' >{{ $usuario->institucion }}</span> </td>
     
    </tr>

      <tr>
   
      <td>    <label class="col-sm-10" style='font-weight:bold;' for="email">Email</label></td>
      <td>    <span style='margin-left:10px; '>{{ $usuario->email }}</span>  </td>
     
    </tr>
   
  </tbody>
</table>
          
                 
                  
                      
                   
                          
                   
          
          
                    
                          
                

                            
                
          
          
               
      
                              </form>
                              
              </div>            
            </div>
          </div>
          </section>
    </div>
    <!--/.Panel 1-->

   
    <!--Panel 3-->
    <div class="tab-pane fade" id="panel3" role="tabpanel">
        <!-- Card -->
        <div class="card testimonial-card">
        
            <!-- Bacground color -->
            <div class="card-up " style='background-color:#ebecee!important'>
            </div>
        
            <!-- Avatar -->
            @if($usuario->url_imagen)
            <div class="avatar mx-auto white"  style='width:200px;'><img id='avatar_usuario_{{ $usuario->id }}' src="{{ asset('storage/'.$usuario->url_imagen)  }}?=<?=rand(1,32000)?>"  style='width:200px; height:200px;'>
            @else
            <div class="avatar mx-auto white"  style='width:200px;'><img id='avatar_usuario_{{ $usuario->id }}' src="{{ asset('assets/images/user_default.jpg')  }}?=<?=rand(1,32000)?>"  style='width:200px; height:200px;'>
            @endif
            
            </div>
        
            <div class="card-body">
                <!-- Name -->
                <h4 class="card-title">{{ $usuario->nombres.' '.$usuario->apellidos }}</h4>
                <hr>

                <form   >
                        <input type="hidden" name="_token" id='_token_avatar' value="<?php echo csrf_token(); ?>"> 
                        <input type="hidden" name="id_usuario" id='id_usuario_avatar' value="{{ $usuario->id }}"> 
                    <!-- Quotation -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroupFileAddon01"></span>
                        </div>
                        <div class="custom-file">
                         
                        </div>
                    </div>

                   
              
               </form>


               
            </div>
        
        </div>
        
    </div>
    <!--/.Panel 3-->
    <div class="tab-pane fade" id="panel4" role="tabpanel">

     <div class="box-header with-border my-box-header margin" style="margin-bottom:15px;margin-top: 15px;">
                        
                        <h5 class="box-title">Formaciòn Acadèmica</h5>
                       
                </div>

          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">tipo</th>
                <th scope="col">clase</th>
                <th scope="col">titulo</th>
                <th scope="col">universidad</th>
                <th>borrar</th>
              </tr>
            </thead>
            <tbody id='TBODY_estudios'>
                    @foreach($estudios as $estudio) 

                          <tr id='TR_estudio_{{ $estudio->id }}'>
                            <th scope="row">{{ $estudio->tipo }}</th>
                            <td>{{ $estudio->tipo_titulo }}</td>
                            <td>{{ $estudio->titulo }}</td>
                            <td>{{ $estudio->universidad.'-'.$estudio->anio }}</td>
                            <td></td>
                          </tr>


                    @endforeach
                  
             
            
            </tbody>
          </table>
          @if(count($estudios)==0)
          <div style='color:green'>...aun no se ha agregado informaciòn academica...</div>
                        
          @endif
    </div>
</div>
 