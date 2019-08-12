<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Estudios;
use App\User;
use App\Paises;
use Mail;
use Auth;
use App\Mail\OrderShipped;
use App\Jobs\SendEmailTest;
use App\Jobs\SendEmailNoticiajob;
use App\Jobs\JobUsuarioSolicitud;
use App\Jobs\JobUsuarioAprobado;
use App\EntradasWP;
use Illuminate\Support\Facades\Crypt;
use App\UsuariosPendientes;
use App\ColasCorreo;

class CorreoController extends Controller
{
    

    public function form_correo(){
        return view('formularios.form_correo')->with('listado','paises');

    }


    public function seccion_correo(){
        $paises=Paises::where('estado','=',1)->get();
        return view('secciones.seccion_correo')->with('paises',$paises);

    }


    public function data_usuarios_correo(){

            return Datatables::of( User::all()   )->make(true);
     
    }


    public function data_coordinadores_correo(){

            return Datatables::of( User::where('rol','!=',4)->get()   )->make(true);
     
    }

    public function data_grupos_correo(){

        return Datatables::of( Paises::where("estado","=",1)->where("nombre","!=","")->get()   )->make(true);
 
    }


    public function enviar_correo(Request $request){

        $correo_para=$request->input('correo_para');
        $correo_asunto=$request->input('correo_asunto');
        $correo_contenido=$request->input('correo_contenido');
        $user=Auth::user();
        $pathfile="0";

         if (!$request->hasFile('file_correo') ){
             $pathfile="0";
         }
         else
         {
             $image = $request->file('file_correo');
             $new_name = rand() . '.' . $image->getClientOriginalExtension();
             $image->move(public_path('archivosanexos'), $new_name);
  
             $pathfile="http://etnomatematica.org/apprelaet/public/archivosanexos/".$new_name;
         }

            $users_temp = explode(',', $correo_para );
            $users = [];
            foreach($users_temp as $key => $ut){
            $ua = [];
            $ua['email'] = trim($ut);
            $ua['name'] = trim($ut);
            $users[$key] = (object)$ua;
            }

            dispatch(new SendEmailTest($user, $correo_asunto, $correo_contenido,$users, $pathfile ));
        
            
            return response()->json([ 'estado' => 'enviados' ]);
        
            

       
    }


    public function enviar_correo_grupos(Request $request){

        $correo_para=$request->input('correo_para');
        $correo_asunto=$request->input('correo_asunto');
        $correo_contenido=$request->input('correo_contenido');
        $user=Auth::user();
        $usuarios=User::all();
         $pathfile="0";

        if (!$request->hasFile('file_correo') ){
             $pathfile="0";
         }
         else
         {
             $image = $request->file('file_correo');
             $new_name = rand() . '.' . $image->getClientOriginalExtension();
             $image->move(public_path('archivosanexos'), $new_name);
  
             $pathfile="http://etnomatematica.org/apprelaet/public/archivosanexos/".$new_name;
         }

    

     

        $grupos = explode(',', $correo_para );
        $correosusu= [];
        foreach($grupos as $grupo){
            $correosusu=    $usuarios->filter( function($u) use ($grupo) {
                if($u->pais == $grupo){
                    return $u;
                }
                
            });

        
            $users = [];
            foreach($correosusu  as $key => $ut){
            $ua = [];
            $ua['email'] = trim($ut->email);
            $ua['name'] = trim($ut->email);
            $users[$key] = (object)$ua;
            }

            
            dispatch(new SendEmailTest($user, $correo_asunto, $correo_contenido,$users, 
                $pathfile ));

        }

       
        return response()->json([ 'estado' => 'enviados' ]);
        
        

       
    }





    public function enviar_correo_region(Request $request){

        $correo_para=$request->input('correo_para');
        $correo_asunto=$request->input('correo_asunto');
        $correo_contenido=$request->input('correo_contenido');
        $user=Auth::user();
        $usuarios=User::all();


        $regiones = explode(',', $correo_para );
         $filtropaises=[];
         $arraypaises=[];

      foreach($regiones as $region){

          
           if($region=='SurAmerica'){  
            $filtropaises=Paises::where("continenteid","=",442 )->get(); 
           }



           if($region=='Norteamerica ,CentroAmerica y el Caribe'){   
              $filtropaises=Paises::where("continenteid","=",2089 )->orwhere("continenteid","=",453 )->get();
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

            foreach($filtropaises as $fpais){
              array_push($arraypaises,$fpais->nombre);

            }
           
          

      }

     

        $grupos=$arraypaises;
        $correosusu= [];
        foreach($grupos as $grupo){
            $correosusu=    $usuarios->filter( function($u) use ($grupo) {
                if($u->pais == $grupo){
                    return $u;
                }
                
            });

        
            $users = [];
            foreach($correosusu  as $key => $ut){
            $ua = [];
            $ua['email'] = trim($ut->email);
            $ua['name'] = trim($ut->email);
            $users[$key] = (object)$ua;
            }

            
            dispatch(new SendEmailTest($user, $correo_asunto, $correo_contenido,$users ));

        }
         dispatch( CorreoController::desbloquear_email() );

        return response()->json([ 'estado' => 'enviados', 'val'=>$grupos ]);
        
     

       
    }


    
    public function enviar_correo_noticias(Request $request){
        $idnoticia=$request->input('id_noticia',0);
       
        
         $noticia=  EntradasWP::where('ID','=',$idnoticia)->first();
         if($noticia){

            $correo_para=$request->input('correo_para');
            $correo_asunto=$noticia->post_title;
       
        
            $user=Auth::user();

            $users_temp = explode(',', $correo_para );
            $users = [];
            foreach($users_temp as $key => $ut){
            $ua = [];
            $ua['email'] = trim($ut);
            $ua['name'] = trim($ut);
            $users[$key] = (object)$ua;
            }

    

            dispatch(new SendEmailNoticiajob($user, $correo_asunto, [ 'noticia' => $noticia ],$users ));
            dispatch( CorreoController::desbloquear_email() );
            return response()->json([ 'estado' => 'enviados' ]);

        }
        else
        {
            return response()->json([ 'estado' => 'la noticia no existe' ],400);
        }
        
    }


    
    public function enviar_correo_grupos_noticia(Request $request){

        $idnoticia=$request->input('id_noticia',0);
        $noticia=  EntradasWP::where('ID','=',$idnoticia)->first();
        if($noticia){

        $correo_para=$request->input('correo_para');
        $correo_asunto=$noticia->post_title;
    
        $user=Auth::user();
        $usuarios=User::all();

     

        $grupos = explode(',', $correo_para );
        $correosusu= [];
        foreach($grupos as $grupo){
            $correosusu=    $usuarios->filter( function($u) use ($grupo) {
                if($u->pais == $grupo){
                    return $u;
                }
                
            });

            //$correosusu =explode(',','niltonjairo2000@hotmail.com,niltonjairo2000@gmail.com');
            $users = [];
            foreach($correosusu  as $key => $ut){
                 
            $ua = [];
            $ua['email'] = trim($ut->email);
            $ua['name'] = trim($ut->email);
            $users[$key] = (object)$ua;
                
            }

            $gurpo10users=[];

            $gurpo10users=array_chunk( $users,5);
           
            foreach($gurpo10users as $us){
            
                
                dispatch(new SendEmailNoticiajob($user, $correo_asunto, [ 'noticia' => $noticia ],$us ));
            }
            
          
            
           
        }
        dispatch( CorreoController::desbloquear_email() );
        return response()->json([ 'estado' => 'enviados' ]);
        
    
        }else{
            dispatch( CorreoController::desbloquear_email() );
            return response()->json([ 'estado' => 'la noticia no existe' ],400);
        }

        
     

       
    }




        public function enviar_correo_region_noticia(Request $request){

        $idnoticia=$request->input('id_noticia',0);
        $noticia=  EntradasWP::where('ID','=',$idnoticia)->first();
        if($noticia){

        $correo_para=$request->input('correo_para');
        $correo_asunto=$noticia->post_title;
    
        $user=Auth::user();
        $usuarios=User::all();

     

        $regiones = explode(',', $correo_para );
         $filtropaises=[];
         $arraypaises=[];

      foreach($regiones as $region){

          
           if($region=='SurAmerica'){  
            $filtropaises=Paises::where("continenteid","=",442 )->get(); 
           }

          if($region=='Norteamerica ,CentroAmerica y el Caribe'){   
              $filtropaises=Paises::where("continenteid","=",2089 )->orwhere("continenteid","=",453 )->get();
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

            foreach($filtropaises as $fpais){
              array_push($arraypaises,$fpais->nombre);

            }
           
          

      }

       
       
        


        $correosusu= [];
        $grupos=$arraypaises;
        
        $users = [];

        foreach($grupos as $grupo){

            $correosusu=    $usuarios->filter( function($u) use ($grupo) {
                if($u->pais == $grupo){
                    return $u;
                }
                
            });

            
            
            foreach($correosusu  as $key => $ut){
                 
            $ua = [];
            $ua['email'] = trim($ut->email);
            $ua['name'] = trim($ut->email);
            $users[$key] = (object)$ua;
                
            }



        }
        
        $gurpo10users=[];
        $gurpo10users=array_chunk( $users,500);
        foreach($gurpo10users as $Gus){
                $textocorreos = "";
                $newcola=new ColasCorreo;
                foreach($Gus as $us){
                   $textocorreos=$textocorreos."|".trim($us->email);
                }
                $newcola->tipo=2;
                $newcola->estado=0;
                $newcola->correos= $textocorreos;
                $newcola->id_noticia=$idnoticia;
                $newcola->save();
                
        }



        return response()->json([ 'estado' => 'enviados' ]);
        
    }
    else{
         return response()->json([ 'estado' => 'la noticia no existe' ],400);
    }
     




        
     

       
    }



    public function enviar_correo_aprobado($usuario,$password){

        $correo_para=$usuario->email;
        $correo_asunto='Bienvenido a la RELAET';
      

            $users_temp = explode(',', $correo_para );
            $useremail = [];
            foreach($users_temp as $key => $ut){
            $ua = [];
            $ua['email'] = trim($ut);
            $ua['name'] = $usuario->name;
            $useremail[$key] = (object)$ua;
            }

            dispatch(new JobUsuarioAprobado($correo_asunto, $password,$useremail,$usuario ));
        
    
            return true;
       
    }



    public function enviar_correo_solicitud($usuario){
      
        $correo_para='hilbla@udenar.edu.co,director@etnomatematica.org ';
        $usersel=$usuario;
        $correo_asunto='Solicitud de acceso a la RELAET';
        
        $clavesol=Crypt::encrypt($usuario->id);

            $users_temp = explode(',', $correo_para );
            $users = [];
            foreach($users_temp as $key => $ut){

            $ua = [];
            $ua['email'] = trim($ut);
            $ua['name'] = $usuario->name;
            $users[$key] = (object)$ua;
            }

       
                        
           dispatch( new JobUsuarioSolicitud( $correo_asunto, $users,$usersel, $clavesol ) );
             return true;
       
    }


      public function enviar_correo_registro($usuario){
      
        $correo_para=$usuario->email;
        $usersel=$usuario;
        $correo_asunto='Solicitud de acceso a la RELAET';
        
        $clavesol=Crypt::encrypt($usuario->id);

            $users_temp = explode(',', $correo_para );
            $users = [];
            foreach($users_temp as $key => $ut){

            $ua = [];
            $ua['email'] = trim($ut);
            $ua['name'] = $usuario->name;
            $users[$key] = (object)$ua;
            }

       
                        
           dispatch( new JobUsuarioRegistro( $correo_asunto, $users,$usersel, $clavesol ) );
             return true;
       
    }


    public function desbloquear_email(){

            $cp_user = "hilbert";
            $cp_pwd = "BGLCkbJ03oxV.jls";
            $url = "https://etnomatematica.org:2083/login";
            $cookies = "/path/to/storage/for/cookies.txt";

            // Create new curl handle
            $ch=curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies); // Save cookies to
            curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$cp_user&pass=$cp_pwd");
            curl_setopt($ch, CURLOPT_TIMEOUT, 100020);

            // Execute the curl handle and fetch info then close streams.
            $f = curl_exec($ch);
            $h = curl_getinfo($ch);
            

          

            // If we had no issues then try to fetch the cpsess
            if ($f == true and strpos($h['url'],"cpsess"))
            {
                // Get the cpsess part of the url
                $pattern="/.*?(\/cpsess.*?)\/.*?/is";
                $preg_res=preg_match($pattern,$h['url'],$cpsess);

                $codigosession=(isset($cpsess[1])) ? $cpsess[1] : "";

                // From URL to get webpage contents. 
                $url2 = "https://etnomatematica.org:2083".$codigosession."/execute/Email/unsuspend_outgoing?email=divulgacion@etnomatematica.org"; 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                curl_setopt($ch, CURLOPT_URL, $url2); 
                $result = curl_exec($ch);  
                curl_close($ch);
                return 1;



            }
            else
            {    
                 curl_close($ch);
                 return 0;

            }





    }


    public function enviar_cola_noticias(){

        $colascorreo=ColasCorreo::where("tipo","=",2)->first();
        if(count( $colascorreo)>0){

            $noticia=  EntradasWP::where('ID','=',$colascorreo->id_noticia)->first();
            if($noticia){

                  $user=User::find(4314);
                $correo_asunto=$noticia->post_title;


                    $correosusu =explode('|',$colascorreo->correos);
                   
                    $users = [];
                    foreach($correosusu  as $key => $ut){

                         
                        if($ut!=""){
                            
                            $ua = [];
                            $ua['email'] = trim($ut);
                            $ua['name'] = trim($ut);
                            $users[$key] = (object)$ua;  
                        }  
                    }

                    $gurpo10users=[];
                    $gurpo10users=array_chunk( $users,5);

                     $colascorreo->delete();
                   
                    foreach($gurpo10users as $us){
                        
                        dispatch(new SendEmailNoticiajob($user, $correo_asunto, [ 'noticia' => $noticia ],$us ) );
                    }
                    
                
                    dispatch( CorreoController::desbloquear_email() );

            }

        }

        return response()->json([ 'estado' => 'enviados' ]);




    }

  







}