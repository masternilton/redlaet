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

use App\Jobs\SendEmailTest;
use App\Jobs\SendEmailNoticiajob;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Paises;

class PublicoController extends Controller
{
    

    public function listado_usuarios_publico(){
        $usuariosgen=User::paginate(50);
        $tituloseccion='General';

        $filtropaises=Paises::where("estado","=",1 )->get(); 
        
        return view('publico.listado_usuarios_publico')
               ->with('paises',$filtropaises)
               ->with('tituloseccion',$tituloseccion)
               ->with('usuariosgen', $usuariosgen);
    
 
     }


    public function listado_publico_suramerica(){

	   $useract=Auth::user();
	   $region= 'SurAmerica';
	   $clavecontinente=0;
	   $tituloseccion= $region;

	    //suramerica
	   	$filtropaises=Paises::where("continenteid","=",442 )->where("estado","=",1 )->get(); 
	   

	   
       
       $arraypaises=[];
	   foreach($filtropaises as $fpais){
	      array_push($arraypaises,$fpais->nombre);

	   }

       
       $usuariosgen=User::whereIn('pais',$arraypaises)->orderBy('apellidos','asc')->paginate(50);
       
       return view('publico.listado_usuarios_publico')
	         ->with('paises',$filtropaises)
	         ->with('tituloseccion',$tituloseccion)
	         ->with('usuariosgen', $usuariosgen);


	}



	  public function listado_publico_norteamerica(){

	   $useract=Auth::user();
	   $region= 'Norte  , Centro America y el Caribe';
	   $clavecontinente=0;
	   $tituloseccion= $region;



	    //suramerica
	   $filtropaises=Paises::where("estado","=",1 )->where("continenteid","=",453 )->orwhere("continenteid","=",2089 )->get();
	   

	   
       
       $arraypaises=[];
	   foreach($filtropaises as $fpais){
	      array_push($arraypaises,$fpais->nombre);

	   }

       
       $usuariosgen=User::whereIn('pais',$arraypaises)->orderBy('apellidos','asc')->paginate(50);
       
       return view('publico.listado_usuarios_publico')
	         ->with('paises',$filtropaises)
	         ->with('tituloseccion',$tituloseccion)
	         ->with('usuariosgen', $usuariosgen);


	}



    public function listado_publico_europa(){

	   $useract=Auth::user();
	   $region= 'Europa y Africa';
	   $clavecontinente=0;
	   $tituloseccion= $region;

	    //suramerica
	   $filtropaises=Paises::where("continenteid","=",2094 )
	                 ->orwhere("continenteid","=",2097 )->where("estado","=",1 )->get();
	   
       $arraypaises=[];
	   foreach($filtropaises as $fpais){
	      array_push($arraypaises,$fpais->nombre);

	   }

       
       $usuariosgen=User::whereIn('pais',$arraypaises)->orderBy('apellidos','asc')->paginate(50);
       
       return view('publico.listado_usuarios_publico')
	         ->with('paises',$filtropaises)
	         ->with('tituloseccion',$tituloseccion)
	         ->with('usuariosgen', $usuariosgen);


	}




	  public function listado_publico_pais($pais){

	   $useract=Auth::user();
	   $clavecontinente=0;

	   $paissel=Paises::where("nombre",'=',$pais)->first();

       $clavecontinente=$paissel->continenteid ?: 453;
	    $tituloseccion= '';
	   
	   if($clavecontinente==442){ 
	    $tituloseccion= 'Sur America'; 
	   	$filtropaises=Paises::where("continenteid","=",442 )->where("estado",'=',1)->get(); 
	   }


	   if($clavecontinente==453 or $clavecontinente==2089 ){ 
	   	   $tituloseccion= 'Norte  , Centro America y el Caribe';
	   	  $filtropaises=Paises::where("estado",'=',1)->where("continenteid","=",453 )->orwhere("continenteid","=",2089 )->get();
	   }
	   if($clavecontinente==2094 or $clavecontinente==2097){ 
	   	  $tituloseccion= 'Europa  y Africa';
	      $filtropaises=Paises::where("estado",'=',1)->where("continenteid","=",2094 )->orwhere("continenteid","=",2097 )->get();
	   }
	  
	   if($clavecontinente==2123){ 
	   	   $tituloseccion= 'Asia';
	   	   $filtropaises=Paises::where("estado",'=',1)->where("continenteid","=",2123 )->get();
	   }
	   if($clavecontinente==476){ 
	      $tituloseccion= 'Oceania'; 
	   	  $filtropaises=Paises::where("estado",'=',1)->where("continenteid","=",476 )->get();
	   }
	  
	   

	   
       
       $arraypaises=[];
	   foreach($filtropaises as $fpais){
	      array_push($arraypaises,$fpais->nombre);

	   }

       
       $usuariosgen=User::where('pais',"=", $paissel->nombre)->orderBy('apellidos','asc')->paginate(50);
       
       return view('publico.listado_usuarios_publico')
	         ->with('paises',$filtropaises)
	         ->with('tituloseccion',$tituloseccion)
	         ->with('usuariosgen', $usuariosgen);


	}

	public function buscar_usuario_publico(Request $request){

    $datobuscado=$request->input("dato_buscado");
	$usuariosgen=User::where("nombres","like","%".$datobuscado."%")
	                   ->orwhere("apellidos","like","%".$datobuscado."%")
	                   ->orwhere("email","like","%".$datobuscado."%")
	                   ->orwhere("pais","like","%".$datobuscado."%")
	                   ->orwhere("ciudad","like","%".$datobuscado."%")
	                   ->paginate(50);

	$tituloseccion='General';
    $filtropaises=Paises::where("estado","=",1 )->get(); 
       
    return view('publico.listado_usuarios_publico')
	         ->with('paises',$filtropaises)
	         ->with('tituloseccion',$tituloseccion)
	         ->with('usuariosgen', $usuariosgen);


	}


	public function informacion_usuario_publico($id){


    $usuario=User::find($id);
    $roles=Role::all();
    $estudios=Estudios::where("id_usuario","=",$id)->get();
   
 
    return view("publico.info_usuario_publico")->with("usuario",$usuario)
                                                  ->with("estudios",$estudios)
	                                              ->with("roles",$roles);



	}








}
