<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Datatables;

use App\Directorio;
use App\UsuariosPendientes;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Globales;
use App\Mensajes;
use App\Conteo;
use App\Paises;

class AccesoController extends Controller
{
    //

     public function registro_usuario(Request $request){


         
        $this->validate($request, [
            'g-recaptcha-response' => 'required',
            'password_usuario' => 'required'
        ]);

        $email=$request->input('email_usuario');
        $duplicado= UsuariosPendientes::where('email','=',$email)->first();

         

        if($duplicado){  return view('acceso.error_registro'); }
        
        $usuarioP=new UsuariosPendientes;
        $usuarioP->name=$request->input('nombre_usuario') . ' '. $request->input('apellido_usuario') ;
        $usuarioP->nombres=$request->input('nombre_usuario');
        $usuarioP->apellidos=$request->input('apellido_usuario');
        $usuarioP->email=$request->input('email_usuario');
        $usuarioP->pais=$request->input('pais_usuario');
        $usuarioP->ciudad=$request->input('ciudad_usuario');
        $usuarioP->ocupacion=$request->input('profesion_usuario');
        $usuarioP->institucion=$request->input('institucion_usuario');
        $usuarioP->password=$request->input('password_usuario');
        
        if( $usuarioP->save() ){

            $newpais=Paises::where('nombre' ,'=', $request->input('pais_usuario') )->first();
            $newpais->estado=1;
            $newpais->conti_estado=1;
            $newpais->save();

            $correocontroller = new CorreoController;
            $correocontroller->enviar_correo_solicitud($usuarioP);
            $correocontroller->enviar_correo_registro($usuarioP);
            return view('acceso.confirmacion_registro');
        }
        else
        {
            return view('acceso.error_registro');
        }

    }

    public function form_reset_password(){
         return view('auth.resetpassword');
    }

    public function recuperar_password(Request $request){
         $email=$request->input('email','0');
         $user=User::where('email',"=",$email )->first();
         if(!$user ){
             return response()->json([ 'estado' => 'noencontrado' ],400);

         }
         if($user ){  
            
            $newpassword=rand(pow(10, 4 - 1) - 1, pow(10, 4) - 1);        
            $user->password= md5($newpassword); 
           
           
            if($user->save() ){
                    Mail::send('email.template_reset_password', ['user' => $user, 'password'=>  $newpassword], function ($m) use ($user) {
                        $m->from('divulgacion@etnomatematica.org', 'Relaet');
                        $m->to($user->email, $user->name)->subject('Recuperaciòn de Password');
                    });
            
                    return response()->json([ 'estado' => 'enviado' ],200);  
            }
           
            
        
        }


        

    }


    public function login_externo(Request $request){
        $password=$request->input('password');
        $email=$request->input('email');
        $user=User::where('email',"=",$email )->first();
        if(!$user ){
            return redirect('login')->withErrors([ 'email' => 'Email no encontrado '])->withInput();

        }
        if($user ){
            $userreal=User::where('email',"=",$email )->where('password',"=",md5($password) )->first();
            if(!$userreal ){  return redirect('login')->withErrors([ 'email' => 'credenciales incorrectas'])->withInput();  }
            if($userreal){ 
                Auth::login($userreal); 
                AccesoController::recargar_notificaciones($userreal->id);
                return redirect('home');
                
            }

        }


       
   }


   public function recargar_notificaciones($id){
     $idusuario=$id;
     $countmensajes=Mensajes::where('estado','=',1)->where('para','=',$idusuario)->count();
     $global=Globales::where('id_usuario','=',$idusuario)->first();
     if($global){
         $global->mensajes=$countmensajes;
         $global->save();
     }
     else{
        $newglobal=new Globales;
        $newglobal->id_usuario=$idusuario;
        $newglobal->mensajes=$countmensajes;
        $newglobal->save();

     }

   }


   public function get_conteo(){
    $fecha_actual = date('Y-m-d'); 
    $conteo=Conteo::where('fecha','=',$fecha_actual )->first();
    $conteoactual=0;
    if(count($conteo)>0){ $conteoactual=$conteo->conteo;  }
    return response()->json([ 'conteo' =>  $conteoactual ], 200);



   }


    public function registrar_conteo(){
    
        $fecha_actual = date('Y-m-d'); 
        $conteo=Conteo::where('fecha','=',$fecha_actual )->first();
        $conteoactual=0;
        if(count($conteo)>0){ 
            $conteoactual=$conteo->conteo;  
            $conteo->conteo= $conteoactual+1;
            $conteo->save();
        }
        else
        {
            $newconteo=new Conteo;
            $newconteo->fecha=$fecha_actual;
            $newconteo->conteo=1;
        }
    
    



   }









}

