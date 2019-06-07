<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\EntradasWP;
use Auth;
use App\User;

class RedController extends Controller
{


    public function listado_usuarios_red(){
        $usuariosgen=User::paginate(50);
        return view('home_usuario')->with('usuariosgen', $usuariosgen);
    
 
     }
    

    public function listado_noticias_red(){
        $entradas=EntradasWP::where('post_status','=', 'publish')->where('post_content','!=', '')->where('post_type','=', 'post')->orderBy('post_date', 'desc')->paginate(30);

      
 
       return view('mired.listado_noticias_red')->with('entradas',$entradas);

    }


    public function buscar_usuario_mired(Request $request){
	  $dato=$request->input("dato_buscado");
	  $usuarios=User::where("name","like","%".$dato."%")->orwhere("apellidos","like","%".$dato."%")->orwhere("ciudad","like","%".$dato."%")->orwhere("pais","like","%".$dato."%")->paginate(100);

	

	  return view('home_usuario')->with('usuariosgen',$usuarios);
    }




    

  





}
