<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Estudios;

class EstudiosController extends Controller
{
    //



     //datatable empresas
     public function crear_estudio(Request $request){
       
        $id_usuario=$request->input('id_usuario');
        $tipo=$request->input('tipo');
        $titulo=$request->input('titulo');
        $universidad=$request->input('universidad');
        $anio=$request->input('anio');
        $tipo_titulo=$request->input('tipo_titulo');
        
        $estudio= new Estudios;
        $estudio->tipo=$tipo;
        $estudio->titulo=$titulo;
        $estudio->universidad=$universidad;
        $estudio->anio=$anio;
        $estudio->tipo_titulo=$tipo_titulo;
        $estudio->id_usuario=$id_usuario;

        if( $estudio->save()){
            return response()->json([ 'estado' => 'creado', 'idestudio' => $estudio->id, "estudio"=>$estudio ]);
        }
        else
        {
            return response()->json([ 'estado' => 'error', 'idestudio' => 0 ]);
        }

        
        
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


     public function borrar_estudio(Request $request){
        $idestudio=$request->input('id_estudio');
        $estudio=Estudios::find($idestudio);
        if( $estudio->delete()){
            return response()->json([ 'estado' => 'borrado', 'idestudio' => $idestudio  ]);
        }
        else
        {
            return response()->json([ 'estado' => 'error', 'idestudio' => 0 ]);
        }


     }

    

     //laravel personas





}
