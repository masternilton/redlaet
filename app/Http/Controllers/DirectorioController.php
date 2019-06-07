<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Directorio;

class DirectorioController extends Controller
{
    //



     //datatable empresas
     public function listado_empresas(){
     	return view('listados.listado_empresas');
     }

     public function data_empresas(){
           return Datatables::of( Directorio::where('tipo','=',1)->get()   )->make(true);
     }
     //datatable empresas
     
     //laravel personas
     public function listado_personas($filtro='id',$orden='asc'){
         //2 corresponde   al tipo  en la base de datos
     	$listado=Directorio::where('tipo','=',2)->orderBy($filtro,$orden)->paginate(20); 
     	if($orden=='asc'){ $orden='desc'; }else{ $orden='asc';  }
        return view('listados.listado_personas')->with('listado',$listado)->with('orden',$orden);
     }

     public function buscar_persona(Request $request){
        $dato=$request->input('dato_buscado',null);
        $ciudad=$request->input('ciudad',null);
        $orden='asc';
        $listado=Directorio::where('tipo','=',2)
                            ->where('nom_persona','like','%'.$dato.'%')
                            ->where('ciudad','like','%'.$ciudad.'%')
                            ->paginate(20);

        return view('listados.listado_personas')->with('listado',$listado)->with('orden',$orden);

     }

     //laravel personas





}
