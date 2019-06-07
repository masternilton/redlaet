<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Directorio;
use App\User;
use App\Globales;

use Auth;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        
        $usuarioactual=Auth::user();
        $usuariosgen=User::paginate(50);
        $globales=Globales::where('id_usuario','=',Auth::user()->id )->first();
     
        if($usuarioactual->rol!=4){
          return view('home')->with('globales',$globales);
        }
        else
        {
          return view('home_usuario')->with('usuariosgen', $usuariosgen)
                                     ->with('globales',$globales);
        }
    }



    public function cargar_directorio(){


        
        for($i=0;$i<count($directorio);$i++){
                  $rc=$this->actualizardir($directorio[$i]);

        }


    }




    public function actualizardir($data){

         $directorio=new Directorio;
        

         if($data['nombre_empresa']){
                 $directorio->tipo=1;
                 if($data['nombre_empresa']==''){ $data['nombre_empresa']='plusis empresa'; }
                 if($data['nombre_empleado']==''){ $data['nombre_empleado']='plusis persona'; }
                 if($data['telefono']==''){ $data['telefono']='123456'; }else{ $data['telefono']= rand ( 1 , 20 ). $data['telefono']; }
                 if($data['email']==''){ $data['email']='plusisejemplo'.rand ( 1 , 500 ).'@gmail.com'; }else{ $data['email']='plusisejemplo'.rand ( 1 , 500 ).'@gmail.com'; }
                 if($data['ciudad']==''){ $data['ciudad']='armenia'; }else{ $data['ciudad']='cali'; }

                 if($data['direccion']==''){ $data['direccion']='mexico'; }else{ $data['direccion']='cali'; }
                 
                 $directorio->nom_empresa=$data['nombre_empresa'];
                 $directorio->nom_persona=$data['nombre_empleado'];
                 $directorio->encargado=$data['nombre_empleado'];
                 $directorio->telefono=$data['telefono'];
                 $directorio->email=$data['email'];
                 $directorio->ciudad=$data['ciudad'];
                 $directorio->direccion=$data['direccion'];


           }
           else
           {      
                 if($data['nombre_empresa']==''){ $data['nombre_empresa']='plusis empresa'; }
                 if($data['nombre_empleado']==''){ $data['nombre_empleado']='plusis persona'; }
                 if($data['telefono']==''){ $data['telefono']='123456'; }else{ $data['telefono']= rand ( 1 , 20 ). $data['telefono']; }
                 if($data['email']==''){ $data['email']='plusisejemplo'.rand ( 1 , 500 ).'@gmail.com'; }else{ $data['email']='plusisejemplo'.rand ( 1 , 500 ).'@gmail.com'; }
                 if($data['ciudad']==''){ $data['ciudad']='armenia'; }else{ $data['ciudad']='cali'; }
                     if($data['direccion']==''){ $data['direccion']='mexico'; }else{ $data['direccion']='cali'; }
                 $directorio->tipo=2;
                 $directorio->nom_empresa='';
                 $directorio->nom_persona=$data['nombre_empleado'];
                 $directorio->encargado=$data['nombre_empleado'];
                 $directorio->telefono=$data['telefono'];
                 $directorio->email=$data['email'];
                 $directorio->ciudad=$data['ciudad'];
                 $directorio->direccion=$data['direccion'];

           }
        $directorio->save();
        return '1';
    }




}