

<div class="box box-primary col-xs-12">


<div class='intermedio' style="margin-top:70px; text-align: center; background-color:#ffeccb; border: 1px dashed #ff5a07;">
  <span class="label label-warning">Email Duplicado<i class="fa fa-check"></i></span><br/>
<label style='color:#7f1717;'>
              <?php  echo $msj; ?> 
</label> 

</div>

 <div class="margin" style="margin-top:50px; text-align:center;margin-bottom: 50px;">
             
            

              <div class="btn-group" style="margin-left:50px; " >
                     
                       @if(Auth::user()->rol==2)
                      <a href="{{ url('/solicitudes_registro') }}" class="btn btn-xs btn-primary waves-effect waves-light"      > Listado Solicitudes </a>
                      @endif

                      @if(Auth::user()->rol==3)
                      <a href="{{ url('/solicitudes_registro') }}" class="btn btn-xs btn-primary waves-effect waves-light"      > Listado Solicitudes </a>
                      @endif

                       @if(Auth::user()->rol==1)
                      
                      <a href="{{ url('/solicitudes_registro_coor') }}" class="btn btn-xs btn-primary waves-effect waves-light"     > Listado Solicitudes </a>

                       <a href="javascript:void(0);"  
                       onclick="Usr_reenviar_clave('{{$emailpendiente}}');"  class="btn btn-xs btn-default waves-effect waves-light" style="margin-left: 20px;"    > Reenviar clave </a>
                      
                      @endif


                        @if(Auth::user()->rol==5)
                          <a href="{{ url('/solicitudes_registro_region') }}" class="btn btn-xs btn-primary waves-effect waves-light"    value=" "  > Listado Solicitudes </a>
                        @endif
             </div>
       

</div> 


 

 </div> 

