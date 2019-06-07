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


class UsuariosController extends Controller
{
 
public function registrar_en_red($usuario,$passwordlimpio){
  
   $post = [
                'firstName' => $usuario->nombres,
                'lastName' =>  $usuario->apellidos,
                'affiliation'   => 'relaet',
                'country'=> 'CO',
                'email'=> $usuario->email,
                'username'=> $usuario->email,
                'password'=> $usuario->password,
                'privacyConsent'=> 1,
                'emailConsent'=> 1,
                'reviewerGroup[16]'=> 0
         

            ];



            $post_eprints = [
                'screen' => "Register::Internal",
                'c1_name_honourific' => "S",
                'c1_name_given' => $usuario->nombres ,
                'c1_name_family' =>  $usuario->apellidos ,
                'c1_newemail' =>  $usuario->email ,
                'c1_username' =>  $usuario->email ,
                'c1_newpassword' =>  $passwordlimpio ,
                '_default_action' =>  "register" ,
                '_action_register' =>  "Registrarse" 
                  
                

            ];


             $dataconfirm = array("userid" => "0" , 
              "pin" => "0" , 
              "emailexterno"  => $usuario->email,
              "regexterno"  => "redlaet",

              );





       $ch = curl_init('http://etnomatematica.org/ojs310/index.php/RevLatEm/login/registerExterno');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                    $response = curl_exec($ch);
                    curl_close($ch);
                     

       $ch2 = curl_init('http://www.etnomatematica.org/editorial/index.php/editorial/login/registerExterno');
                    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch2, CURLOPT_POSTFIELDS, $post);
                    $response2 = curl_exec($ch2);
                    curl_close($ch2);


         $ch3 = curl_init('http://repositorio.etnomatematica.org/cgi/register');
                    curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch3, CURLOPT_POSTFIELDS, $post_eprints);
                    $response3 = curl_exec($ch3);
                    curl_close($ch3);

               

      
          $ch4 = curl_init("http://repositorio.etnomatematica.org/cgi/confirm?userid=0&pin=0&regexterno=redlaet&emailexterno=".$usuario->email);
                 curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);
                 curl_setopt($ch4, CURLOPT_CUSTOMREQUEST, "GET");
                 $response4= curl_exec($ch4);
                 curl_close($ch4);

             $ch4 = curl_init("http://repositorio.etnomatematica.org/cgi/register?userid=0&pin=0&regexterno=redlaet&emailexterno=".$usuario->email."&_action_confirm=1");
                 curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);
                 curl_setopt($ch4, CURLOPT_CUSTOMREQUEST, "GET");
                 $response4= curl_exec($ch4);
                 curl_close($ch4);

       $obj = array("response" => $response, "response2" => $response2  ) ;
       return   $obj ;          

}


public function form_nuevo_usuario(){
    //carga el formulario para agregar un nuevo usuario
    $roles=Role::all();
    $usuario_actual=Auth::user();
    return view("formularios.form_nuevo_usuario")->with("usuario_actual",$usuario_actual)
                                                     ->with("roles",$roles);

}

public function form_nuevo_usuariopais(){
    //carga el formulario para agregar un nuevo usuario
    $roles=Role::all();
     $usuario_actual=Auth::user();
    return view("formularios.form_nuevo_usuariopais")->with("usuario_actual",$usuario_actual)
                                                     ->with("roles",$roles);

}


public function form_nuevo_rol(){
    //carga el formulario para agregar un nuevo rol
    $roles=Role::all();
    return view("formularios.form_nuevo_rol")->with("roles",$roles);
}

public function form_nuevo_permiso(){
    //carga el formulario para agregar un nuevo permiso
     $roles=Role::all();
     $permisos=Permission::all();
    return view("formularios.form_nuevo_permiso")->with("roles",$roles)->with("permisos", $permisos);
}



public function listado_usuarios(){
    //presenta un listado de usuarios paginados de 100 en 100
    $usuarios=User::orderBy('apellidos','asc')->paginate(100);
    $usuario_actual=Auth::user();
    return view("listados.listado_usuarios")->with("usuario_actual",$usuario_actual)
                                            ->with("usuarios",$usuarios);
}

public function listado_usuarios_coordinadores(){
    //presenta un listado de usuarios paginados de 100 en 100
    $usuarios=User::where('rol','!=',4)->orderBy('apellidos','asc')->paginate(100);
    $usuario_actual=Auth::user();
    return view("listados.listado_coordinadoresGlobal")->with("usuario_actual",$usuario_actual)
                                            ->with("usuarios",$usuarios);
}


public function listado_usuarios_coordinadores_pais(){
    //presenta un listado de usuarios paginados de 100 en 100
    $usuarios=User::where('rol','=',2)->orderBy('apellidos','asc')->paginate(100);
    $usuario_actual=Auth::user();
    return view("listados.listado_coordinadorespaisGlobal")->with("usuario_actual",$usuario_actual)
                                            ->with("usuarios",$usuarios);
}


public function listado_usuarios_coordinadores_region(){
    //presenta un listado de usuarios paginados de 100 en 100
    $usuarios=User::where('rol','=',5)->orderBy('apellidos','asc')->paginate(100);
    $usuario_actual=Auth::user();
    return view("listados.listado_coordinadoresregionGlobal")->with("usuario_actual",$usuario_actual)
                                            ->with("usuarios",$usuarios);
}


public function listado_usuarios_coordinadores_zona(){
    //presenta un listado de usuarios paginados de 100 en 100
    $usuarios=User::where('rol','=',3)->paginate(100);
    $usuario_actual=Auth::user();
    return view("listados.listado_coordinadoreszonaGlobal")->with("usuario_actual",$usuario_actual)
                                            ->with("usuarios",$usuarios);
}










public function listado_coordinadores(){
    //presenta un listado de usuarios paginados de 100 en 100
    $usuarios=User::where('rol','<',4)->orderBy('apellidos','asc')->paginate(100);
    $usuario_actual=Auth::user();
    return view("listados.listado_coordinadores")->with("usuario_actual",$usuario_actual)
                                                  ->with("usuarios",$usuarios);
}





public function listado_coordinadores_zona(){
    //presenta un listado de usuarios paginados de 100 en 100
   
    $usuarios=User::where('rol','=',3)->orderBy('apellidos','asc')->paginate(100);
    $usuario_actual=Auth::user();
    return view("listados.listado_coordinadores_zona")->with("usuario_actual",$usuario_actual)
                                                     ->with("usuarios",$usuarios);
}


public function crear_usuario_pais(Request $request){
    //crea un nuevo usuario en el sistema


               
    $reglas=[  'nombres' => 'required',
                'pais'=> 'required',
               'apellidos' => 'required',
               'telefono' => 'numeric',
               'password' => 'required|min:8',
             'email' => 'required|email|unique:users', ];
   
    $mensajes=['nombres.required' => 'el nombre es obligatorio',
                'pais.required' => 'el pais es obligatorio',
               'apellidos.required' => 'el apellido es obligatorio',
               'telefono.numeric' => 'el telefono debe contener solo numeros',
               'password.min' => 'El password debe tener al menos 8 caracteres',
             'email.unique' => 'El email ya se encuentra registrado en la base de datos', ];
    
  $validator = Validator::make( $request->all(),$reglas,$mensajes );
  if( $validator->fails() ){ 
      return view("formularios.form_nuevo_usuario")->withErrors($validator)
                                                     ->withInput($request->flash());         
  }

  $usuario=new User;
  $usuario->name=strtoupper( $request->input("nombres")." ".$request->input("apellidos") ) ;
  $usuario->nombres=strtoupper( $request->input("nombres") ) ;
    $usuario->apellidos=strtoupper( $request->input("apellidos") ) ;
    $usuario->telefono=$request->input("telefono");
    $usuario->pais=$request->input("pais");
    $usuario->ciudad=$request->input("ciudad");
  $usuario->email=$request->input("email");
    $usuario->password= md5( $request->input("password") ); 
    $usuario->ocupacion=$request->input("ocupacion");
    $usuario->institucion=$request->input("institucion");
    
    $usuario->rol=4;
    $usuario->nom_rol= 'USUARIO STANDARD'; 
    $usuario->pais_rol='';
    $usuario->zona_rol='';
    
    
 
            
    if($usuario->save())
    {
       
      $respuesta = UsuariosController::registrar_en_red($usuario);
      return view("mensajes.msj_usuario_creado")->with("msj","Usuario agregado correctamente")->with('regrevista', $respuesta ->{'response'} )->with('regeditorial', $respuesta->{'response2'} )  ;

      return view("mensajes.msj_usuario_creado_pais")->with("msj","Usuario agregado correctamente");
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }

}





public function crear_usuario(Request $request){
    //crea un nuevo usuario en el sistema


               
    $reglas=[  'nombres' => 'required',
                'pais'=> 'required',
               'apellidos' => 'required',
               'telefono' => 'numeric',
               'password' => 'required|min:8',
	           'email' => 'required|email|unique:users', ];
	 
    $mensajes=['nombres.required' => 'el nombre es obligatorio',
                'pais.required' => 'el pais es obligatorio',
               'apellidos.required' => 'el apellido es obligatorio',
               'telefono.numeric' => 'el telefono debe contener solo numeros',
               'password.min' => 'El password debe tener al menos 8 caracteres',
	           'email.unique' => 'El email ya se encuentra registrado en la base de datos', ];
	  
	$validator = Validator::make( $request->all(),$reglas,$mensajes );
	if( $validator->fails() ){ 
	  	return view("formularios.form_nuevo_usuario")->withErrors($validator)
                                                     ->withInput($request->flash());         
	}

	$usuario=new User;
	$usuario->name=strtoupper( $request->input("nombres")." ".$request->input("apellidos") ) ;
	$usuario->nombres=strtoupper( $request->input("nombres") ) ;
    $usuario->apellidos=strtoupper( $request->input("apellidos") ) ;
    $usuario->telefono=$request->input("telefono");
    $usuario->pais=$request->input("pais");
    $usuario->ciudad=$request->input("ciudad");
	$usuario->email=$request->input("email");
    $usuario->password= md5( $request->input("password") ); 
    $usuario->ocupacion=$request->input("ocupacion");
    $usuario->institucion=$request->input("institucion");
    
    $usuario->rol=4;
    $usuario->nom_rol= 'USUARIO STANDARD'; 
    $usuario->pais_rol='';
    $usuario->zona_rol='';
    
    
 
            
    if($usuario->save())
    {
       
      $respuesta = UsuariosController::registrar_en_red($usuario);
      return view("mensajes.msj_usuario_creado")->with("msj","Usuario agregado correctamente")->with('regrevista', $respuesta ->{'response'} )->with('regeditorial', $respuesta->{'response2'} ) ;

      return view("mensajes.msj_usuario_creado")->with("msj","Usuario agregado correctamente");
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }

}



public function crear_rol(Request $request){
   
    $reglas=[    'rol_nombre' => 'required|alpha',
                 'rol_slug' => 'required|unique:roles,slug',
                 'rol_descripcion' => 'required',
            ];
     
    $mensajes=[  'rol_nombre.alpha' => 'solo se permiten letras en el nombre, sin espacios , ni simbolos',
                 'rol_slug.unique' => 'el slug debe ser unico',
                 'rol_descripcion.required' => 'la descripcion es obligatoria',
            ];


    $validator = Validator::make( $request->all(),$reglas,$mensajes );
    if( $validator->fails() ){ 
     

        return new JsonResponse($validator->errors(), 422);     
    }     
  
   


   $rol=new Role;
   $rol->name=$request->input("rol_nombre") ;
   $rol->slug=$request->input("rol_slug") ;
   $rol->description=$request->input("rol_descripcion") ;
    if($rol->save())
    {
        return view("mensajes.msj_rol_creado")->with("msj","Rol agregado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }
}




public function crear_permiso(Request $request){

  
   $permiso=new Permission;
   $permiso->name=$request->input("permiso_nombre") ;
   $permiso->slug=$request->input("permiso_slug") ;
   $permiso->description=$request->input("permiso_descripcion") ;
    if($permiso->save())
    {
        return view("mensajes.msj_permiso_creado")->with("msj","Permiso creado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }


}

public function asignar_permiso(Request $request){

     $roleid=$request->input("rol_sel");
     $idper=$request->input("permiso_rol");
     $rol=Role::find($roleid);
     $rol->assignPermission($idper);
    
    if($rol->save())
    {
        return view("mensajes.msj_permiso_creado")->with("msj","Permiso asignado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }



}



public function form_editar_usuario($id){
    $usuario=User::find($id);
    $roles=Role::all();
    $estudios=Estudios::where("id_usuario","=",$id)->get();
    $usuario_actual= Auth::user();
     $proteger=false;
    

   
      if(  $usuario_actual->rol==1 ){ $proteger=false; }

      if($usuario_actual->rol==2 and $usuario_actual->rol_pais!=  $usuario->pais  ){ 
        $proteger=false; 
      }

      if($usuario_actual->rol==3 and $usuario_actual->rol_pais!=  $usuario->pais  ){ 
        $proteger=false; 
      }
 
    
      




      if($usuario_actual->rol==5   ){ 
          
          $region= $usuario_actual->region_rol;
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

           if (in_array($usuario->pais, $arraypaises)) {
                $proteger=false;
            }
           else {
                $proteger=true;
            }

      }



      if(  $usuario_actual->rol==4 or $proteger==true ){

        return view("informacion.informacion_usuario")->with("usuario",$usuario)
                                                      ->with("estudios",$estudios)
                                                      ->with("roles",$roles);
      }



    return view("formularios.form_editar_usuario")->with("usuario",$usuario)
                                                  ->with("estudios",$estudios)
	                                              ->with("roles",$roles);                                 
}


public function form_editar_mi_perfil($id){
    $usuario=User::find($id);
    $roles=Role::all();
    $estudios=Estudios::where("id_usuario","=",$id)->get();
    $usuario_actual= Auth::user();
    $role = Role::find($usuario_actual->rol);
   $permiso=true;

    if($permiso!=true){  return view("mensajes.mensaje_error")->with("msj","...No tiene permisos para ver esta seccion ;...") ;  }
    
    if($id==$usuario_actual->id){
         return view("formularios.form_editar_usuario")->with("usuario",$usuario)
                                                  ->with("estudios",$estudios)
                                                  ->with("roles",$roles); 
    }                                
}




public function editar_usuario(Request $request){
          
    $idusuario=$request->input("id_usuario");
    $usuario=User::find($idusuario);
    $usuario->name=strtoupper( $request->input("nombres")." ".$request->input("apellidos") ) ;
	$usuario->nombres=strtoupper( $request->input("nombres") ) ;
    $usuario->apellidos=strtoupper( $request->input("apellidos") ) ;
    $usuario->telefono=$request->input("telefono");
    $usuario->pais=$request->input("pais");
    $usuario->ciudad=$request->input("ciudad");
    $usuario->ocupacion=$request->input("ocupacion");
    $usuario->institucion=$request->input("institucion");

    
 
	 
    if( $usuario->save()){
        return response()->json([ 'estado' => 'actualizado', 'idusuario' => $usuario->id ]);
    }
    else
    {
		return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
    }
}


public function buscar_usuario(Request $request){
	$dato=$request->input("dato_buscado");
	$usuarios=User::where("name","like","%".$dato."%")->orwhere("apellidos","like","%".$dato."%")                                              ->paginate(100);
	return view('listados.listado_usuarios')->with("usuarios",$usuarios);
}


public function buscar_usuario_pais(Request $request){
   $cordinadorpais=Auth::user()->pais_rol;
   $usuarios=User::where('pais','=', $cordinadorpais )->paginate(100);
   $usuario_actual=Auth::user();
   $dato=$request->input("dato_buscado");
   $usuarios=User::where('pais','=', $cordinadorpais )->where("name","like","%".$dato."%")
                                                      ->orwhere("apellidos","like","%".$dato."%")
                                                      ->paginate(100);
   return view("listados.listado_usuarios_pais")->with("usuario_actual",$usuario_actual)
                                                ->with("usuarios",$usuarios);
                                                  
 
}




public function borrar_usuario(Request $request){
        
       /* if(\Auth::user()->isRole('administrador')==false ){ 
            return view("mensajes.mensaje_error")->with("msj","..no tiene permiso para borrar usuario..");
        }*/

        $idusuario=$request->input("id_usuario_borrado");
        $usuario=User::find($idusuario);
        $usuario->estado=1;
        $texto_titulo=Auth::user()->nombres.' '.Auth::user()->apellidos;
        $usuario->justificacion=   $request->input("justificacion")." <br/>autor: ".$texto_titulo;


      
        if( $usuario->save() ){
        
           return response()->json([ 'estado' => 'borrado', 'idusuario' => $idusuario ]);
           
        }
        else
        {
            return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
        }
        
     
}


public function borrar_usuario_final(Request $request){
        

        $idusuario=$request->input("id_usuario_borrado");
        $usuario=User::find($idusuario);

        if( $usuario->delete() ){
        
           return response()->json([ 'estado' => 'borrado', 'idusuario' => $idusuario ]);
           
        }
        else
        {
            return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
        }
        
     
}

public function editar_acceso(Request $request){
         
         $idusuario=$request->input("id_usuario");
         $usuario=User::find($idusuario);
         $usuario->email=$request->input("email");
         $usuario->password= md5( $request->input("password") ); 
         if( $usuario->save()){
            return response()->json([ 'estado' => 'actualizado', 'idusuario' => $usuario->id ]);
         }
          else
         {
            return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
         }
}



public function asignar_rol($idusu,$idrol){

        $usuario=User::find($idusu);
        $usuario->assignRole($idrol);
        $usuario=User::find($idusu);
        $rolesasignados=$usuario->getRoles();
        return json_encode ($rolesasignados);


}


public function quitar_rol($idusu,$idrol){

    $usuario=User::find($idusu);
    $usuario->revokeRole($idrol);
    $rolesasignados=$usuario->getRoles();
    return json_encode ($rolesasignados);


}


public function form_borrado_usuario($id){
  $usuario=User::find($id);
  return view("confirmaciones.form_borrado_usuario")->with("usuario",$usuario);

}


public function quitar_permiso($idrole,$idper){ 
    
    $role = Role::find($idrole);
    $role->revokePermission($idper);
    $role->save();

    return "ok";
}


public function borrar_rol($idrole){

    $role = Role::find($idrole);
    $role->delete();
    return "ok";
}

public function editar_imagen(Request $request){
    
   
    $file = $request->file('photo');
   
    $id_usuario = $request->input('id_usuario');
    
     $rutafinal='cuentas/'.$id_usuario.'/avatar_'.$id_usuario.'.'.$file->extension();
     Storage::disk('public')->put($rutafinal,  file_get_contents($file)  );
     $usuario=User::find( $id_usuario);
     $usuario->url_imagen=$rutafinal;

    
 
	 
    if( $usuario->save()){
        return response()->json([ 'estado' => 'actualizado', 'idusuario' => $usuario->id, 'url_imagen'=> $rutafinal ]);
    }
    else
    {
		return response()->json([ 'estado' => 'error', 'idusuario' => 0, 'url_imagen'=> '' ]);
    }
    
   
  
}

public function  form_editar_rol($id){
    $usuario=User::find($id);
    $useract=Auth::user();
    if($useract->rol==1){ $roles=Role::all(); }
    if($useract->rol==5){ $roles=Role::where('id','>',1)->where('id','<>',5)->get(); }
    if($useract->rol==2){ $roles=Role::where('id','>',2)->where('id','<>',5)->get(); }
    if($useract->rol==3){ $roles=Role::where('id','>',10000000000)->get(); } //para que no envie nada
    if($useract->rol==4){ $roles=Role::where('id','>',10000000000)->get(); } 
    
    
    return view("formularios.form_editar_rol")->with("usuario",$usuario)
                                              ->with("roles",$roles);
}

public function actualizar_usuario_rol(Request $request){
   
    $useract=Auth::user();
    $idrol=$request->input('id_rol');
    if($idrol==1 and $useract->rol !==1 ){  
       response()->json([ 'estado' => 'error', 'idusuario' => 0 , 'error'=> 'no tiene autorizacion para asignar este rol' ]);    
    }
    $idusu=$request->input('id_usuario');
    $paisrol=$request->input('pais','');
    $zonarol=$request->input('zona','');
    $regionrol=$request->input('region','');
   
    $usuario=User::find($idusu);
    $usuario->revokeAllRoles();
    $usuario=User::find($idusu);
    $usuario->assignRole($idrol);
   
   
     $rolsel=Rolesred::find($idrol);

    
    

    $usuario->rol=$idrol;
    $usuario->nom_rol=$rolsel->name ? $rolsel->name :'vacio'; 
    $usuario->pais_rol='';
    $usuario->zona_rol='';

    if($idrol!=4){
        $usuario->pais_rol=$paisrol;
        $usuario->zona_rol=$zonarol;
    }

    if($idrol==5){
        $usuario->pais_rol=$paisrol;
        $usuario->region_rol=$regionrol;
    }

    if( $usuario->save()){
        return response()->json([ 'estado' => 'actualizado', 'idusuario' => $usuario->id, 'rolsel'=> $rolsel ], 200);
     }
      else
     {
        return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
     }

   


}

public function  pasar_usuarios_viejos(){

    $usuariosOLD=UsuariosOLD::all();

    foreach($usuariosOLD as $userold){
        $val=User::where('email','=',  $userold->email )->get();
     
        
        $userold->codigo=$userold->id?$userold->id:0;
        if(count($val)==0){
        $usuario=new User;
        $usuario->codigoold=$userold->codigo;
        $usuario->name=strtoupper( $userold->nombre." ".$userold->apellidos ) ;
        $usuario->nombres=strtoupper( $userold->nombre ) ;
        $usuario->apellidos=strtoupper( $userold->apellidos ) ;
        $usuario->telefono='';
        $usuario->pais=$userold->pais;
        $usuario->ciudad=$userold->ciudad;
        $usuario->email=$userold->email;
        $usuario->password= md5( $userold->pais ); 
        $usuario->ocupacion=$userold->pregrado;
        $usuario->institucion='';
        $usuario->pregrado=$userold->pregrado;
        $usuario->postgrado=$userold->postgrado;
        $usuario->libros=$userold->libros;
        $usuario->articulos=$userold->articulos;
        $usuario->noticias=$userold->noticias;

        $usuario->rol=4;
        $usuario->nom_rol= 'USUARIO STANDARD'; 
        $usuario->pais_rol='';
        $usuario->zona_rol='';

        if($usuario->save()){ }else{   };

        }

        if(count($val)>0){
            $usuario=User::where('email','=',  $userold->email )->first();
            $usuario->codigoold=$userold->codigo;
            $usuario->name=strtoupper( $userold->nombre." ".$userold->apellidos ) ;
            $usuario->nombres=strtoupper( $userold->nombre ) ;
            $usuario->apellidos=strtoupper( $userold->apellidos ) ;
            $usuario->telefono='';
            $usuario->pais=$userold->pais;
            $usuario->ciudad=$userold->ciudad;
            $usuario->email=$userold->email;
            $usuario->password= md5( $userold->pais ); 
            $usuario->ocupacion=$userold->pregrado;
            $usuario->institucion='';
            $usuario->pregrado=$userold->pregrado;
            $usuario->postgrado=$userold->postgrado;
            $usuario->libros=$userold->libros;
            $usuario->articulos=$userold->articulos;
            $usuario->noticias=$userold->noticias;
    
            $usuario->rol=4;
            $usuario->nom_rol= 'USUARIO STANDARD'; 
            $usuario->pais_rol='';
            $usuario->zona_rol='';
            if($usuario->save()){ }else{   };

        }



    }

    return response()->json([ 'estado' => 'actualizado'], 200);


}


public function  pasar_claves_viejas(){

    $usuariosOLD=UsuariosOLDB::all();

    foreach($usuariosOLD as $userold){
        $val=User::where('email','=',  $userold->email )->get();
        if(count($val)>0){
            $usuario=User::where('email','=',  $userold->email )->first();
            $usuario->password= $userold->password ;
            if($usuario->save()){ }else{   };

        }
    }


    return response()->json([ 'estado' => 'actualizado'], 200);


}


public function solicitudes_registro(){
     $paiscoor=Auth::user()->pais_rol ?  Auth::user()->pais_rol:'nada';
     $usuario_actual=Auth::user();
     if($usuario_actual->rol==1){  $paiscoor=$usuario_actual->pais;  }

     $usuariosP=UsuariosPendientes::where('pais','=',  $paiscoor )->where('estado','=', 0 )->paginate(100);
     return view('listados.listado_solicitudes')->with('usuarios',$usuariosP)
                                                ->with('usuario_actual',$usuario_actual);;

}

public function solicitud_informacion($id){

    $usuario=UsuariosPendientes::find($id);
    $roles=Role::all();
    $estudios=Estudios::where("id_usuario","=",$id)->get();
    $usuario_actual= Auth::user();
    $clavesol=Crypt::encrypt($usuario->id);
   
    return view("informacion.informacion_solicitud")->with("usuario",$usuario)
                                                    ->with("clavesol",  $clavesol)
                                                    ->with("roles",$roles)
                                                    ->with("estudios",$estudios);

}

public function aprobar_solicitud_desde_correo($key){
    $idsolicitud=Crypt::decrypt($key);
    $usuarioPendiente=UsuariosPendientes::find($idsolicitud);
    $duplicado=User::where('email','=',  $usuarioPendiente->email)->first();
    if($duplicado){  return view("mensajes.msj_solicitud_warning")->with("msj","el email ya se encuentra registrado en nuestra base de datos") ;   }
    $usuario=new User;
    $usuario->name=$usuarioPendiente->name ;
    $usuario->nombres=$usuarioPendiente->nombres ;
    $usuario->apellidos=$usuarioPendiente->apellidos ;
    $usuario->telefono=$usuarioPendiente->telefono;
    $usuario->pais=$usuarioPendiente->pais;
    $usuario->ciudad=$usuarioPendiente->pais;
    $usuario->email=$usuarioPendiente->email;
    $usuario->password= md5( $usuarioPendiente->password ); 
    $usuario->ocupacion=$usuarioPendiente->ocupacion;
    $usuario->institucion=$usuarioPendiente->institucion;
    
    $usuario->rol=4;
    $usuario->nom_rol= 'USUARIO STANDARD'; 
    $usuario->pais_rol='';
    $usuario->zona_rol='';

    if($usuario->save())
    {
       $respuesta = UsuariosController::registrar_en_red($usuario,$usuarioPendiente->password);

        $usuarioPendiente->delete();
        $CorroC=new   CorreoController;
        $CorroC->enviar_correo_aprobado($usuario,$usuarioPendiente->password);
       return view("mensajes.mensaje_aprobado_externo")->with("msj","...registro logrado ;...") ;
    }
    else
    {
       return view("mensajes.mensaje_error")->with("msj","...error al aprobar solicitud...") ;
    }
    
}

public function aprobar_solicitud($key){

    $idsolicitud=Crypt::decrypt($key);
    $usuarioPendiente=UsuariosPendientes::find($idsolicitud);

    $duplicado=User::where('email','=',  $usuarioPendiente->email)->first();
    if($duplicado){  
        return view("mensajes.msj_solicitud_warning")
        ->with("msj","el email ya se encuentra registrado en nuestra base de datos") 
        ->with("emailpendiente",$usuarioPendiente->email);   
    }
    $usuario=new User;
	$usuario->name=$usuarioPendiente->name ;
	$usuario->nombres=$usuarioPendiente->nombres ;
    $usuario->apellidos=$usuarioPendiente->apellidos ;
    $usuario->telefono=$usuarioPendiente->telefono;
    $usuario->pais=$usuarioPendiente->pais;
    $usuario->ciudad=$usuarioPendiente->pais;
	$usuario->email=$usuarioPendiente->email;
    $usuario->password= md5( $usuarioPendiente->password ); 
    $usuario->ocupacion=$usuarioPendiente->ocupacion;
    $usuario->institucion=$usuarioPendiente->institucion;
    
    $usuario->rol=4;
    $usuario->nom_rol= 'USUARIO STANDARD'; 
    $usuario->pais_rol='';
    $usuario->zona_rol='';
    
    
 
            
    if($usuario->save())
    {
      $respuesta = UsuariosController::registrar_en_red($usuario,$usuarioPendiente->password);
       $CorroC=new   CorreoController;
      $CorroC->enviar_correo_aprobado($usuario,$usuarioPendiente->password);
      $usuarioPendiente->delete();


      return view("mensajes.msj_solicitud_success")->with("msj","solicitud aprobada correctamente")->with('regrevista', $respuesta['response'] )->with('regeditorial', $respuesta['response2'] ) ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }



}


  public function listado_usuarios_pais(){
    //presenta un listado de usuarios paginados de 100 en 100
    $cordinadorpais=Auth::user()->pais_rol;
    $usuarios=User::where('pais','=', $cordinadorpais )->orderBy('apellidos','asc')->paginate(100);
    $usuario_actual=Auth::user();



    return view("listados.listado_usuarios_pais")->with("usuario_actual",$usuario_actual)
                                                 ->with("usuarios",$usuarios);
}

  public function archivar_solicitud($key){

     $idsolicitud=Crypt::decrypt($key);
     $usuarioPendiente=UsuariosPendientes::find($idsolicitud);
     $usuarioPendiente->estado=1;
     if($usuarioPendiente->save())
    {
     
      return view("mensajes.msj_solicitud_archivada")->with("msj","solicitud archivada correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }

  }




  public function registrar_cuenta(){

    $usuario=Auth::user();
    $cuenta=Cuenta::where("id_usuario","=",$usuario->id )->first();
    if( count($cuenta)==0 ) {
       
        $respuesta = UsuariosController::registrar_en_red($usuario,$usuario->password);
        $newcuenta=new Cuenta;
        $newcuenta->id_usuario=$usuario->id;
        $newcuenta->fecha_activacion=date("Y-m-d");
        $newcuenta->save();
         return response()->json([ 'estado' => 'new registro en red'], 200);

   }else
   {
     return response()->json([ 'estado' => 'ya registrado en red'], 200);
   }




  }


  public function listado_usuarios_filtro(Request $request){

    $datonombre=$request->input('filtro_nombre')?: 'vacio';
    $datoemail=$request->input('filtro_email')?: 'vacio';
    $datopais=$request->input('filtro_pais')?: 'vacio';
    $datociudad=$request->input('filtro_ciudad')?: 'vacio';



   
   $collectionU = collect([]); 

   if($datonombre!='vacio'){   
        $usuarios=User::where("name","like","%".$datonombre."%")->get(); 
        $collectionU = $collectionU->merge($usuarios);  
   }

    if($datoemail!='vacio'){   
        $usuarios=User::where("email","like","%".$datoemail."%")->get(); 
        $collectionU = $collectionU->merge($usuarios);  
   }

    if($datopais!='vacio'){   
        $usuarios=User::where("pais","like","%".$datopais."%")->get(); 
        $collectionU = $collectionU->merge($usuarios);  
   }


     if($datociudad!='vacio'){   
        $usuarios=User::where("ciudad","like","%".$datociudad."%")->get(); 
        $collectionU = $collectionU->merge($usuarios);  
   }


   $paginator = new Paginator($collectionU, $collectionU->count(), 100, 1);
   $filtros= array("nombre"=>  $datonombre , 
                   "pais"=>  $datopais , 
                   "email"=>  $datoemail, 
                   "ciudad"=>  $datociudad   );


  return view('listados.listado_usuarios')
           ->with("usuarios",$paginator  )
           ->with("filtros",$filtros  );


  }







public function listado_usuariospais_filtro(Request $request){
   
    $datonombre=$request->input('filtro_nombre')?: 'vacio';
    $datoemail=$request->input('filtro_email')?: 'vacio';
    $datopais=$request->input('filtro_pais')?: 'vacio';
    $datociudad=$request->input('filtro_ciudad')?: 'vacio';

    $cordinadorpais=Auth::user()->pais_rol;

       $collectionU = collect([]); 

       if($datonombre!='vacio'){   
            $usuarios=User::where('pais','=', $cordinadorpais )->where("name","like","%".$datonombre."%")->get(); 
            $collectionU = $collectionU->merge($usuarios);  
       }

        if($datoemail!='vacio'){   
            $usuarios=User::where('pais','=', $cordinadorpais )->where("email","like","%".$datoemail."%")->get(); 
            $collectionU = $collectionU->merge($usuarios);  
       }

        if($datopais!='vacio'){   
            $usuarios=User::where('pais','=', $cordinadorpais )->where("pais","like","%".$datopais."%")->get(); 
            $collectionU = $collectionU->merge($usuarios);  
       }


         if($datociudad!='vacio'){   
            $usuarios=User::where('pais','=', $cordinadorpais )->where("ciudad","like","%".$datociudad."%")->get(); 
            $collectionU = $collectionU->merge($usuarios);  
       }

    
    $paginator = new Paginator($collectionU, $collectionU->count(), 100, 1);

    $usuario_actual=Auth::user();

    $filtros= array("nombre"=>  $datonombre , 
                   "pais"=>  $datopais , 
                   "email"=>  $datoemail, 
                   "ciudad"=>  $datociudad   );
    return view("listados.listado_usuarios_pais")->with("usuario_actual",$usuario_actual)
                                            ->with("usuarios", $paginator)
                                             ->with("filtros",$filtros  );
}



    public function recuperarle_password_usuario(Request $request){
         $email=$request->input('email','0');
         $user=User::where('email',"=",$email)->first();
         $usuariosP=UsuariosPendientes::where('email','=',  $email )->first();
         
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

                    $usuariosP->delete();
                    return response()->json([ 'estado' => 'recuperado', 'usuario'=> $user ],200);  
            }
           
            
        
        }


        

    }










}
