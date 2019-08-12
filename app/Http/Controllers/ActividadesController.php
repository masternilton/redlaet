<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\User;
use App\Estudios;
use App\Rolesred;
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Storage;
use Auth;
use Illuminate\Support\Facades\Crypt;

use App\UsuariosOLD;
use App\UsuariosPendientes;
use App\UsuariosOLDB;
use App\Cuenta;
use App\Paises;

use App\Jobs\SendEmailTest;
use App\Jobs\SendEmailNoticiajob;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\UsersBorrados;
use Mail;
use App\Actividades;
use DB;



class ActividadesController extends Controller
{

    public function seccion_actividades(){

         $useract=Auth::user();
         if($useract->rol!=1 ){   
          return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); 
         }

         $actividades=Actividades::where('estado','=',0)->orderBy('created_at', 'desc')->paginate(100);
         return view('coorgeneral.seccion_actividades')->with('actividades',$actividades)->with('usuario_actual', $useract);
    }


    public function seccion_actividades_completas(){

         $useract=Auth::user();
         if($useract->rol!=1 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }
           $actividades=Actividades::where('estado','=',1)->orderBy('created_at', 'desc')->paginate(100);
           return view('coorgeneral.seccion_actividades_completas')->with('actividades',$actividades)->with('usuario_actual', $useract);
    }

    public function seccion_actividades_coordinador(){

         $useract=Auth::user();
         if($useract->rol==4 ){   
          return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); 
         }


          $region= $useract->region_rol;
          $clavecontinente=0;

     

           if($region=='SurAmerica'){  
            $filtropaises=Paises::where("continenteid","=",442 )->get(); 
           }

           if($region=='Norteamerica CentroAmerica y el Caribe'){ 
              $filtropaises=Paises::where("continenteid","=",453 )->orwhere("continenteid","=",2089 )->get();
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

          $coordinadores=User::whereIn('pais_rol',$arraypaises)
            ->where('rol','=',2)->orwhere('rol','=',3)->orwhere('id','=', $useract->id)->get();
          
          $arrayREGEX = '';
          foreach($coordinadores as $c){
             
                 $arrayREGEX.=$c->id.'|';
          }

  
          $actividades = DB::table('actividades')->select("actividades.*")
                        ->where('estado','=',0)
                        ->whereRaw('CONCAT(",", `usuarios`, ",") REGEXP ",('.$arrayREGEX.')," ' )
                        ->paginate(100);
       

    
         return view('coordinador.seccion_actividades_coordinador')->with('actividades',$actividades)
                                                                   ->with('usuario_actual', $useract);
    }


    public function seccion_actividades_completas_coordinador(){

         $useract=Auth::user();
         if($useract->rol==4 ){   
          return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); 
         }

          $region= $useract->region_rol;
          $clavecontinente=0;

     

           if($region=='SurAmerica'){  
            $filtropaises=Paises::where("continenteid","=",442 )->get(); 
           }

           if($region=='Norteamerica CentroAmerica y el Caribe'){ 
              $filtropaises=Paises::where("continenteid","=",453 )->orwhere("continenteid","=",2089 )->get();
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

          $coordinadores=User::whereIn('pais_rol',$arraypaises)
            ->where('rol','=',2)->orwhere('rol','=',3)->orwhere('id','=', $useract->id)->get();
          
          $arrayREGEX = '';
         

          foreach($coordinadores as $c){
             
                 $arrayREGEX.=$c->id.'|';
          }


          
  
          $actividades = DB::table('actividades')->select("actividades.*")
                        ->where('estado','=',1)
                        ->whereRaw('CONCAT(",", `usuarios`, ",") REGEXP ",('.$arrayREGEX.')," ' )
                        ->paginate(100);

  
         return view('coordinador.seccion_actividades_completas_coordinador')->with('actividades',$actividades)
                                                                   ->with('usuario_actual', $useract);
    }


    public function form_nueva_actividad(){

         $useract=Auth::user();
         if($useract->rol!=1 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }
           $coordinadores=User::where('rol','=',2)->orwhere('rol','=',1)->orwhere('rol','=',3)->orwhere('rol','=',5)->orderBy('created_at', 'desc')->get();


           return view('coorgeneral.form_nueva_actividad')->with('coordinadores',$coordinadores)->with('usuario_actual', $useract);
    }


    public function form_nueva_actividad_R(){

         $useract=Auth::user();
         
         if($useract->rol!=5 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }
          
          $region= $useract->region_rol;
          $clavecontinente=0;

     

           if($region=='SurAmerica'){  
            $filtropaises=Paises::where("continenteid","=",442 )->get(); 
           }

           if($region=='Norteamerica CentroAmerica y el Caribe'){ 
              $filtropaises=Paises::where("continenteid","=",453 )->orwhere("continenteid","=",2089 )->get();
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

       
            $coordinadores=User::whereIn('pais_rol',$arraypaises)
            ->where('rol','=',2)->orwhere('rol','=',3)->orwhere('id','=',$useract->id )
            ->orderBy('created_at', 'desc')->get();


           return view('coordinador.form_nueva_actividad_R')->with('coordinadores',$coordinadores)->with('usuario_actual', $useract);
    }

    public function form_editar_actividad($idact){

         $useract=Auth::user();
         if($useract->rol!=1 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }
         $coordinadores=User::where('rol','=',2)->orwhere('rol','=',1)->orwhere('rol','=',3)->orwhere('rol','=',5)->orderBy('created_at', 'desc')->get();
         $actividadsel=Actividades::where('id','=',$idact)->first();
         return view('coorgeneral.form_editar_actividad')->with('actividadsel',$actividadsel)->with('coordinadores',$coordinadores)->with('usuario_actual', $useract);
    }


  public function crear_actividad(Request $request){


    	   $useract=Auth::user();
    	   if($useract->rol!=1 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }

           $nuevoA=new Actividades;
           $nuevoA->titulo=$request->input("titulo");
           $nuevoA->descripcion=$request->input("descripcion");
           $nuevoA->asignado=$request->input("asignado");
           $nuevoA->creador_id= $useract->id;
           $nuevoA->estado= 0;
           $nuevoA->nom_creador= $useract->nombres;



           $coordinadores=User::where("rol","=",5)->orwhere("rol","=",3)->orwhere("rol","=",2)->orwhere("rol","=",1)->get();
           if($nuevoA->asignado==1){
             $asigns='';
               foreach($coordinadores as $us){  $asigns.=$us->id.','; }
             //$news = implode(',', $news);
             $nuevoA->usuarios=  $asigns ;

           }
           
           if($nuevoA->asignado==2){
             $asigns='';
             $news = $request->input('asignados') ? $request->input('asignados'):[];
             foreach($news as $us){  $asigns.=$us.','; }
             //$news = implode(',', $news);
             $nuevoA->usuarios=  $asigns ;
           }



          
        if(  $nuevoA->save()){
          return response()->json([ 'estado' => 'actualizado', 'idusuario' => $nuevoA->id ]);
			  }
			    else
			  {
					return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
			  }

   }


     public function crear_actividad_R(Request $request){


         $useract=Auth::user();
         if($useract->rol!=5 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }

           $nuevoA=new Actividades;
           $nuevoA->titulo=$request->input("titulo");
           $nuevoA->descripcion=$request->input("descripcion");
           $nuevoA->asignado=$request->input("asignado");
           $nuevoA->creador_id= $useract->id;
           $nuevoA->estado= 0;
           $nuevoA->nom_creador= $useract->nombres;

           $region= $useract->region_rol;
           $clavecontinente=0;

     

           if($region=='SurAmerica'){  
            $filtropaises=Paises::where("continenteid","=",442 )->get(); 
           }

           if($region=='Norteamerica CentroAmerica y el Caribe'){ 
              $filtropaises=Paises::where("continenteid","=",453 )->orwhere("continenteid","=",2089 )->get();
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


            $coordinadores=User::whereIn("pais_rol",$arraypaises)->where("rol","=",2)->orwhere("rol","=",3)->orwhere("id","=", $useract->id)->get();


            if($nuevoA->asignado==1){
             $asigns='';
               foreach($coordinadores as $us){  $asigns.=$us->id.','; }
             //$news = implode(',', $news);
             $nuevoA->usuarios=  $asigns ;

           }
           
           if($nuevoA->asignado==1){
             $asigns='';
           foreach($coordinadores as $us){  $asigns.=$us->id.','; }
           $nuevoA->usuarios=  $asigns ;

           }

           
           if($nuevoA->asignado==2){
             $asigns='';
             $news = $request->input('asignados') ? $request->input('asignados'):[];
             foreach($news as $us){  $asigns.=$us.','; }
             //$news = implode(',', $news);
             $nuevoA->usuarios=  $asigns ;
           }



          
        if(  $nuevoA->save()){
          return response()->json([ 'estado' => 'actualizado', 'idusuario' => $nuevoA->id ]);
        }
          else
        {
          return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
        }

   }



     public function crear_actividad_P(Request $request){

 

         $useract=Auth::user();
         if($useract->rol==4 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }

           $nuevoA=new Actividades;
           $nuevoA->titulo=$request->input("titulo");
           $nuevoA->descripcion=$request->input("descripcion");
           $nuevoA->asignado=$request->input("asignado");
           $nuevoA->creador_id= $useract->id;
           $nuevoA->estado= 0;
           $nuevoA->nom_creador= $useract->nombres;

           $paisrol= $useract->pais_rol;
          

            $coordinadores=User::where("pais_rol","=",$paisrol)
                          ->where("rol","=",3)
                          ->orwhere("id","=", $useract->id)->get();



         
           
           if($nuevoA->asignado==1){
             $asigns='';
             foreach($coordinadores as $us){  $asigns.=$us->id.','; }
             $nuevoA->usuarios=  $asigns ;

           }

           
           if($nuevoA->asignado==2){
             $asigns='';
             $news = $request->input('asignados') ? $request->input('asignados'):[];
             foreach($news as $us){  $asigns.=$us.','; }
             //$news = implode(',', $news);
             $nuevoA->usuarios=  $asigns ;
           }



          
        if(  $nuevoA->save()){
          return response()->json([ 'estado' => 'actualizado', 'idusuario' => $nuevoA->id ]);
        }
          else
        {
          return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
        }

   }


    public function form_editar_actividad_R($idact){

         $useract=Auth::user();
         if($useract->rol!=5 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }

          $region= $useract->region_rol;
          $clavecontinente=0;

     

           if($region=='SurAmerica'){  
            $filtropaises=Paises::where("continenteid","=",442 )->get(); 
           }

           if($region=='Norteamerica CentroAmerica y el Caribe'){ 
              $filtropaises=Paises::where("continenteid","=",453 )->orwhere("continenteid","=",2089 )->get();
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

       
       
            $coordinadores=User::whereIn('pais_rol',$arraypaises)
            ->where('rol','=',2)->orwhere('rol','=',3)->orwhere('id','=',$useract->id )
            ->orderBy('created_at', 'desc')->get();
       
         $actividadsel=Actividades::where('id','=',$idact)->first();
         return view('coordinador.form_editar_actividad_R')->with('actividadsel',$actividadsel)->with('coordinadores',$coordinadores)->with('usuario_actual', $useract);
    }

  public function borrar_actividad(Request $request){

        $useract=Auth::user();
        $idact=$request->input('id_actividad');
        if($useract->rol!=1 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }
        $nuevoA=Actividades::where("id","=",$idact)->first();

        if($nuevoA->delete() ){
             return response()->json([ 'estado' => 'borrado', 'idusuario' => $nuevoA->id ]);
        }
        else
        {
          return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
        }


  } 

  public function completar_actividad(Request $request){

        $useract=Auth::user();
        $idact=$request->input('id_actividad');
        if($useract->rol!=1 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }
        $nuevoA=Actividades::where("id","=",$idact)->first();
        $nuevoA->estado=1;

        if($nuevoA->save() ){
             return response()->json([ 'estado' => 'completada', 'idusuario' => $nuevoA->id ]);
        }
        else
        {
          return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
        }


  } 


    public function editar_actividad(Request $request){


         $useract=Auth::user();
         if($useract->rol!=1 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }
           $idacts=$request->input("id_actividad");

           $nuevoA=Actividades::where('id','=', $idacts)->first();
           $nuevoA->titulo=$request->input("titulo");
           $nuevoA->descripcion=$request->input("descripcion");
           $nuevoA->asignado=$request->input("asignado");
           $nuevoA->creador_id= $useract->id;
        

        
           $coordinadores=User::where("rol","=",5)->orwhere("rol","=",3)->orwhere("rol","=",2)->orwhere("rol","=",1)->get();
             if($nuevoA->asignado==1){
             $asigns='';
               foreach($coordinadores as $us){  $asigns.=$us->id.','; }
             //$news = implode(',', $news);
             $nuevoA->usuarios=  $asigns ;

           }


           if($nuevoA->asignado==2){
             $asigns='';
            $news = $request->input('asignados') ? $request->input('asignados'):[];
             foreach($news as $us){  $asigns.=$us.','; }
          
             //$news = implode(',', $news);
             $nuevoA->usuarios=  $asigns ;
           }


          
        if(  $nuevoA->save()){
          return response()->json([ 'estado' => 'actualizado', 'idusuario' => $nuevoA->id ]);
        }
          else
        {
          return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
        }

   }

    public function editar_actividad_R(Request $request){


         $useract=Auth::user();
         if($useract->rol!=5 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }
           $idacts=$request->input("id_actividad");

           $nuevoA=Actividades::where('id','=', $idacts)->first();
           $nuevoA->titulo=$request->input("titulo");
           $nuevoA->descripcion=$request->input("descripcion");
           $nuevoA->asignado=$request->input("asignado");
           $nuevoA->creador_id= $useract->id;

          $region= $useract->region_rol;
          $clavecontinente=0;

     

           if($region=='SurAmerica'){  
            $filtropaises=Paises::where("continenteid","=",442 )->get(); 
           }

           if($region=='Norteamerica CentroAmerica y el Caribe'){ 
              $filtropaises=Paises::where("continenteid","=",453 )->orwhere("continenteid","=",2089 )->get();
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
        

           
           $coordinadores=User::whereIn("pais_rol",$arraypaises)->where("rol","=",2)->orwhere("rol","=",3)->orwhere("id","=", $useract->id)->get();

        

            if($nuevoA->asignado==1){
             $asigns='';
               foreach($coordinadores as $us){  $asigns.=$us->id.','; }
             //$news = implode(',', $news);
             $nuevoA->usuarios=  $asigns ;

           }


           if($nuevoA->asignado==2){
             $asigns='';
            $news = $request->input('asignados') ? $request->input('asignados'):[];
             foreach($news as $us){  $asigns.=$us.','; }
          
             //$news = implode(',', $news);
             $nuevoA->usuarios=  $asigns ;
           }


          
          if(  $nuevoA->save()){
            return response()->json([ 'estado' => 'actualizado', 'idusuario' => $nuevoA->id ]);
          }
            else
          {
            return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
          }

   }



  public function completar_actividad_R(Request $request){

        $useract=Auth::user();
        $idact=$request->input('id_actividad');
        if($useract->rol!=5 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }
        $nuevoA=Actividades::where("id","=",$idact)->first();
        $nuevoA->estado=1;

        if($nuevoA->save() ){
             return response()->json([ 'estado' => 'completada', 'idusuario' => $nuevoA->id ]);
        }
        else
        {
          return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
        }


  } 


  public function borrar_actividad_R(Request $request){

        $useract=Auth::user();
        $idact=$request->input('id_actividad');
        if($useract->rol!=5 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }
        $nuevoA=Actividades::where("id","=",$idact)->first();

        if($nuevoA->delete() ){
             return response()->json([ 'estado' => 'borrado', 'idusuario' => $nuevoA->id ]);
        }
        else
        {
          return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
        }


  } 

  public function seccion_actividades_coordinadorP(){

         $useract=Auth::user();
         if($useract->rol==4 ){   
          return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); 
         }
         $pais_sel='';
         if($useract->rol==2){  $pais_sel= $useract->pais_rol;  }
         if($useract->rol==3){  $pais_sel= $useract->pais_rol;  }


          
          $clavecontinente=0;
       
          $coordinadores=User::where('pais_rol','=',  $pais_sel )
            ->where('rol','=',2)->orwhere('rol','=',3)->orwhere('id','=', $useract->id)->get();
          
          $arrayREGEX = '';
          foreach($coordinadores as $c){
             
                 $arrayREGEX.=$c->id.'|';
          }

  
          $actividades = DB::table('actividades')->select("actividades.*")
                        ->where('estado','=',0)
                        ->whereRaw('CONCAT(",", `usuarios`, ",") REGEXP ",('.$arrayREGEX.')," ' )
                        ->paginate(100);

       


       

         return view('coordinadorP.seccion_actividades_coordinadorP')->with('actividades',$actividades)
                                                                    ->with('usuario_actual', $useract);
    }



    public function seccion_actividades_coordinadorP_completas(){

         $useract=Auth::user();
         if($useract->rol!=2 and $useract->rol!=3 ){   
          return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); 
         }
         $pais_sel='';
         if($useract->rol==2){  $pais_sel= $useract->pais;  }
         if($useract->rol==3){  $pais_sel= $useract->pais_rol;  }


           $coordinadores=User::where('pais_rol','=',  $pais_sel )
            ->where('rol','=',2)->orwhere('rol','=',3)->orwhere('id','=', $useract->id)->get();
          
          $arrayREGEX = '';
          foreach($coordinadores as $c){
             
                 $arrayREGEX.=$c->id.'|';
          }

  
          $actividades = DB::table('actividades')->select("actividades.*")
                        ->where('estado','=',1)
                        ->whereRaw('CONCAT(",", `usuarios`, ",") REGEXP ",('.$arrayREGEX.')," ' )
                        ->paginate(100);

       

         return view('coordinadorP.seccion_actividades_coordinadorP_completas')->with('actividades',$actividades)
                                                                               ->with('usuario_actual', $useract);
    }




    public function form_nueva_actividad_P(){

         $useract=Auth::user();
         
         if($useract->rol!=3 and $useract->rol!=2 ){   
          return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); 
         }
          
          $pais_sel='';
         if($useract->rol==2){  $pais_sel= $useract->pais_rol;  }
         if($useract->rol==3){  $pais_sel= $useract->pais_rol;  }


          
          $clavecontinente=0;
          $coordinadores=User::where("pais_rol","=",$pais_sel)
                               ->where("rol","=",3)
                               ->orwhere("id","=", $useract->id)->get();


        


          return view('coordinadorP.form_nueva_actividad_P')->with('coordinadores',$coordinadores)->with('usuario_actual', $useract);
    }


     


    public function form_editar_actividad_P($idact){

         $useract=Auth::user();
         if($useract->rol==4 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }

         $paisrol= $useract->pais_rol;
          

         $coordinadores=User::where("pais_rol","=",$paisrol)
                          ->where("rol","=",3)
                          ->orwhere("id","=", $useract->id)->get();
       
         $actividadsel=Actividades::where('id','=',$idact)->first();
         return view('coordinadorP.form_editar_actividad_P')
                ->with('actividadsel',$actividadsel)
                ->with('coordinadores',$coordinadores)
                ->with('usuario_actual', $useract);
    }



        public function editar_actividad_P(Request $request){


         $useract=Auth::user();
         if($useract->rol==4 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }
           $idacts=$request->input("id_actividad");

           $nuevoA=Actividades::where('id','=', $idacts)->first();
           $nuevoA->titulo=$request->input("titulo");
           $nuevoA->descripcion=$request->input("descripcion");
           $nuevoA->asignado=$request->input("asignado");
           $nuevoA->creador_id= $useract->id;

           $paisrol= $useract->pais_rol;
          

           $coordinadores=User::where("pais_rol","=",$paisrol)
                          ->where("rol","=",3)
                          ->orwhere("id","=", $useract->id)->get();

        

            if($nuevoA->asignado==1){
             $asigns='';
               foreach($coordinadores as $us){  $asigns.=$us->id.','; }
             //$news = implode(',', $news);
             $nuevoA->usuarios=  $asigns ;

           }


           if($nuevoA->asignado==2){
             $asigns='';
            $news = $request->input('asignados') ? $request->input('asignados'):[];
             foreach($news as $us){  $asigns.=$us.','; }
          
             //$news = implode(',', $news);
             $nuevoA->usuarios=  $asigns ;
           }


          
          if(  $nuevoA->save()){
            return response()->json([ 'estado' => 'actualizado', 'idusuario' => $nuevoA->id ]);
          }
            else
          {
            return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
          }

   }



  public function completar_actividad_P(Request $request){

        $useract=Auth::user();
        $idact=$request->input('id_actividad');
        if($useract->rol==4 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }
        $nuevoA=Actividades::where("id","=",$idact)->first();
        $nuevoA->estado=1;

        if($nuevoA->save() ){
             return response()->json([ 'estado' => 'completada', 'idusuario' => $nuevoA->id ]);
        }
        else
        {
          return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
        }


  } 


    public function borrar_actividad_P(Request $request){

        $useract=Auth::user();
        $idact=$request->input('id_actividad');
        if($useract->rol==4 ){   return view('mensajes.msj_no_autorizado')->with('msj','sin Autorizacion para esta area'); }
        $nuevoA=Actividades::where("id","=",$idact)->first();

        if($nuevoA->delete() ){
             return response()->json([ 'estado' => 'borrado', 'idusuario' => $nuevoA->id ]);
        }
        else
        {
          return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
        }


  } 



    



}