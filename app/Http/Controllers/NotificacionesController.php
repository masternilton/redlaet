<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\EntradasWP;
use Auth;
use App\User;
use App\Mensajes;
use App\pushNoticias;
use App\Paises;
use App\UsuariosPendientes;



class NotificacionesController extends Controller
{
    public function get_count_solicitudes(){
     $useract=Auth::user();
     $region= $useract->region_rol;
     $clavecontinente=0;
     if($useract->rol==4){ return 0; }


     $filtropaises=[];

     if($region=='SurAmerica'){  
      $filtropaises=Paises::where("continenteid","=",442 )->get(); 
     }

     if($region=='Norteamerica'){   
          $filtropaises=Paises::where("continenteid","=",2089 )->get();
     }

     if($region=='CentroAmerica y el Caribe'){ 
        $filtropaises=Paises::where("continenteid","=",453 )->get();
     }
     if($region=='Europa y Africa'){ 
        $filtropaises=Paises::where("continenteid","=",2094 )->orwhere("continenteid","=",2097 )->get();
     }
     if($region=='Asia'){ 
         $filtropaises=Paises::where("continenteid","=",2123 )->get();
     }
     if($region=='Oceania'){  
        $filtropaises=Paises::where("continenteid","=",476 )->get();
     }

     $arraypaises=[];

     foreach($filtropaises as $fpais){
        array_push($arraypaises,$fpais->nombre);

     }

     if($useract->rol==2){ array_push($arraypaises,$useract->pais); }
     if($useract->rol==3){ array_push($arraypaises,$useract->pais); }
      
  
     $usuariosP=UsuariosPendientes::whereIn('pais',  $arraypaises )->where('estado','=', 0 )->paginate(100);

     return count($usuariosP);


       


    }


    public function listado_notificaciones(){
       $iduser=Auth::user()->id;
       $mensajes=Mensajes::where('para','=',$iduser)->where('estado','=',1)->get();
       //$mensajes=Mensajes::where('estado','=',1)->get();
       return view('mired.listado_notificaciones_red')->with('mensajes',$mensajes);

    }


     public function ver_info_mensaje($id){
       $iduser=Auth::user()->id;
       $mensaje=Mensajes::where('para','=',$iduser)->where('id','=',$id)->first();
       //$mensaje=Mensajes::where('id','=',$id)->first();
       return view('informacion.informacion_mensaje')->with('mensaje',$mensaje);

    }

     public function cargar_numero_notificaciones(){
          $iduser=Auth::user()->id;
          $pushnoti=pushNoticias::where('estado','=',1)->where('para','=',$iduser)->first();
          $countnoticias=0;
          $fecha_ultimo_acceso=date("Y-m-d");
          if(count($pushnoti)>0 ){
             $fecha_ultimo_acceso=$pushnoti->fecha_ultimo_acceso;
             
          }

          $entradas=EntradasWP::where('post_status','=', 'publish')->where('post_content','!=', '')->where('post_type','=', 'post')->where('post_date','>', $fecha_ultimo_acceso )->limit(10)->get();
           $countnoticias=count($entradas);

          $iduser=Auth::user()->id;
          $countmensajes=Mensajes::where('estado','=',1)->where('para','=',$iduser)->count();

           $countsolicitudes=NotificacionesController::get_count_solicitudes();
          return response()->json([ 'estado' => 'numerado', 'numero_mensajes' => $countmensajes, 'numero_noticias'=>$countnoticias, 'numero_solicitudes' =>$countsolicitudes  ]);

            
     }



      public function registrar_fecha_noticias(){
          $iduser=Auth::user()->id;
          $nombreusuar=Auth::user()->nombres;
          $pushnoti=pushNoticias::where('estado','=',1)->where('para','=',$iduser)->first();

          if(count($pushnoti)>0 ){ 

             $pushnoti->fecha_ultimo_acceso=date("Y-m-d") ;
             $pushnoti->save();


           }
           else
           {
              $newpush=new pushNoticias;
              $newpush->de=$iduser;
              $newpush->nombre_de=$nombreusuar;
              $newpush->para=$iduser;
              $newpush->nombre_para=$nombreusuar;
              $newpush->fecha_ultimo_acceso="2018-11-01" ;
              $newpush->contenido='ultimo acceso';
              $newpush->estado=1;
              $newpush->save();

           }
          
          return response()->json([ 'estado' => 'registrado' ]);

            
     }






}