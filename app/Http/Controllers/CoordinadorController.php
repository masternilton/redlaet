<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Paises;

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
use DB;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;



class CoordinadorController extends Controller
{

	public function listado_usuarios_region(){

	   $useract=Auth::user();
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

       
       $usuarios=User::whereIn('pais',$arraypaises)->orderBy('apellidos','asc')->paginate(100);
       $usuario_actual=Auth::user();
       return view("region.listado_usuarios_region")->with("usuario_actual",$usuario_actual)
                                                     ->with("mispaises",  $arraypaises)
                                                     ->with("usuarios",$usuarios);


	}



		public function listado_coordinadores_pais_region(){

	   $useract=Auth::user();
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

       
       $usuarios=User::where('rol','=',2)->whereIn('pais',$arraypaises)->orderBy('apellidos','asc')->paginate(100);
       $usuario_actual=Auth::user();
       return view("region.listado_coordinadores_pais_region")->with("usuario_actual",$usuario_actual)
                                                     ->with("mispaises",  $arraypaises)
                                                     ->with("usuarios",$usuarios);


	}


	public function listado_coordinadores_zona_region(){

	   $useract=Auth::user();
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

       
       $usuarios=User::where('rol','=',3)->whereIn('pais',$arraypaises)->orderBy('apellidos','asc')->paginate(100);
       $usuario_actual=Auth::user();
       return view("region.listado_coordinadores_zona_region")
                                                     ->with("usuario_actual",$usuario_actual)
                                                     ->with("mispaises",  $arraypaises)
                                                     ->with("usuarios",$usuarios);


	}



	public function solicitudes_registro_region(){
	   $useract=Auth::user();
       
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
	   	
    
     
     $usuariosP=UsuariosPendientes::whereIn('pais',  $arraypaises )->where('estado','=', 0 )->paginate(100);
     $usuario_actual=Auth::user();
     return view('region.listado_solicitudes_region')->with('usuarios',$usuariosP)
                                                ->with('usuario_actual',$usuario_actual);;

    }


    public function buscar_usuario_region(Request $request){
		$dato=$request->input("dato_buscado");

		$useract=Auth::user();
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
	


	   $usuarios=User::whereIn('pais',$arraypaises)->where("name","like","%".$dato."%")->orwhere("apellidos","like","%".$dato."%")->paginate(100);

       $usuario_actual=Auth::user();
       return view("region.listado_usuarios_region")->with("usuario_actual",$usuario_actual)
                                                     ->with("mispaises",  $arraypaises)
                                                     ->with("usuarios",$usuarios);
    }




 public function listado_usuariosregion_filtro(Request $request){

    $datonombre=$request->input('filtro_nombre')?: 'vacio';
    $datoemail=$request->input('filtro_email')?: 'vacio';
    $datopais=$request->input('filtro_pais')?: 'vacio';
    $datociudad=$request->input('filtro_ciudad')?: 'vacio';

		$useract=Auth::user();
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

   
   $collectionU = collect([]); 

   if($datonombre!='vacio'){   
        $usuarios=User::whereIn('pais',$arraypaises)->where("name","like","%".$datonombre."%")->get(); 
        $collectionU = $collectionU->merge($usuarios);  
   }

    if($datoemail!='vacio'){   
        $usuarios=User::whereIn('pais',$arraypaises)->where("email","like","%".$datoemail."%")->get(); 
        $collectionU = $collectionU->merge($usuarios);  
   }

    if($datopais!='vacio'){   
        $usuarios=User::whereIn('pais',$arraypaises)->where("pais","like","%".$datopais."%")->get(); 
        $collectionU = $collectionU->merge($usuarios);  
   }


     if($datociudad!='vacio'){   
        $usuarios=User::whereIn('pais',$arraypaises)->where("ciudad","like","%".$datociudad."%")->get(); 
        $collectionU = $collectionU->merge($usuarios);  
   }


   $paginator = new Paginator($collectionU, $collectionU->count(), 100, 1);
   $usuario_actual=Auth::user();
   $filtros= array("nombre"=>  $datonombre , 
                   "pais"=>  $datopais , 
                   "email"=>  $datoemail, 
                   "ciudad"=>  $datociudad   );
    return view("region.listado_usuarios_region")->with("usuario_actual",$usuario_actual)
                                                 ->with("mispaises",  $arraypaises)
                                                 ->with("filtros",  $filtros)
                                                 ->with("usuarios",$paginator);


  }




  public function listado_usuarios_coorgeneral(){

	   $useract=Auth::user();
	   $filtropaises=Paises::where("estado","=",1)->get();
       
       $arraypaises=[];
	   foreach($filtropaises as $fpais){
	      array_push($arraypaises,$fpais->nombre);

	   }

       
       $usuarios=User::paginate(100);
       $usuario_actual=Auth::user();
       return view("coorgeneral.listado_usuarios_coorgeneral")->with("usuario_actual",$usuario_actual)
                                                     ->with("mispaises",  $arraypaises)
                                                     ->with("usuarios",$usuarios);


	}



	  public function listado_borrados(){

	   $useract=Auth::user();
	   $filtropaises=Paises::where("estado","=",1)->get();
       
       $arraypaises=[];
	   foreach($filtropaises as $fpais){
	      array_push($arraypaises,$fpais->nombre);

	   }

       
       $usuarios=User::where("estado","=",1)->paginate(100);
       $usuario_actual=Auth::user();
       return view("coorgeneral.listado_borrados")->with("usuario_actual",$usuario_actual)
                                                     ->with("mispaises",  $arraypaises)
                                                     ->with("usuarios",$usuarios);


	}


		public function solicitudes_registro_coor(){
			   $useract=Auth::user();
			
               $filtropaises=Paises::where("estado","=",1)->get();
	  
       
		       $arraypaises=[];
			   foreach($filtropaises as $fpais){
			      array_push($arraypaises,$fpais->nombre);

			   }
	   	
    
     
		     $usuariosP=UsuariosPendientes::where('estado','=', 0 )->paginate(100);
		     $usuario_actual=Auth::user();
		     return view('coorgeneral.listado_solicitudes_coor')->with('usuarios',$usuariosP)
		                                                ->with('usuario_actual',$usuario_actual);;

    }


    	public function listado_coordinadoreszona_coor(){

	   $useract=Auth::user();
       $filtropaises=Paises::where("estado","=",1)->get();
          $arraypaises=[];
			   foreach($filtropaises as $fpais){
			      array_push($arraypaises,$fpais->nombre);

			   }

       
       $usuarios=User::where('rol','=',3)->orderBy('apellidos','asc')->paginate(100);
       $usuario_actual=Auth::user();
       
       return view("coorgeneral.listado_coordinadoreszona_coor")
                                                     ->with("usuario_actual",$usuario_actual)
                                                     ->with("mispaises",  $arraypaises)
                                                     ->with("usuarios",$usuarios);


	}


	public function listado_coordinadorespais_coor(){
    //presenta un listado de usuarios paginados de 100 en 100
    $usuarios=User::where('rol','=',2)->orderBy('apellidos','asc')->paginate(100);
    $usuario_actual=Auth::user();
     $filtropaises=Paises::where("estado","=",1)->get();
          $arraypaises=[];
			   foreach($filtropaises as $fpais){
			      array_push($arraypaises,$fpais->nombre);

			   }


    return view("coorgeneral.listado_coordinadorespais_coor")
                                                     ->with("usuario_actual",$usuario_actual)
                                                     ->with("mispaises",  $arraypaises)
                                                     ->with("usuarios",$usuarios);
    }



    public function listado_coordinadoresregion_coor(){
    //presenta un listado de usuarios paginados de 100 en 100
    $usuarios=User::where('rol','=',5)->orderBy('apellidos','asc')->paginate(100);
    $usuario_actual=Auth::user();
     $filtropaises=Paises::where("estado","=",1)->get();
          $arraypaises=[];
			   foreach($filtropaises as $fpais){
			      array_push($arraypaises,$fpais->nombre);

			   }


    return view("coorgeneral.listado_coordinadoresregion_coor")
                                                     ->with("usuario_actual",$usuario_actual)
                                                     ->with("mispaises",  $arraypaises)
                                                     ->with("usuarios",$usuarios);
    }



      public function listado_usuarioscoor_filtro(Request $request){

      	$datonombre=$request->input('filtro_nombre')?: 'vacio';
    $datoemail=$request->input('filtro_email')?: 'vacio';
    $datopais=$request->input('filtro_pais')?: 'vacio';
    $datociudad=$request->input('filtro_ciudad')?: 'vacio';

     $usuario_actual=Auth::user();
     $filtropaises=Paises::where("estado","=",1)->get();
          $arraypaises=[];
			   foreach($filtropaises as $fpais){
			      array_push($arraypaises,$fpais->nombre);

			   }



   
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

       return view("coorgeneral.listado_usuarios_coorgeneral")
                                                     ->with("usuario_actual",$usuario_actual)
                                                     ->with("mispaises",  $arraypaises)
                                                     ->with("filtros",  $filtros)
                                                     ->with("usuarios",$paginator);

      }









    


}