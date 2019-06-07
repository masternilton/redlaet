<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Mensajes;
use App\User;
use App\Globales;
use Auth;

class MensajesController extends Controller
{
    public function crear_mensaje(Request $request)
    {
        $contenido=$request->input('contenido','sin datos');
        $para=$request->input('para',0);
        $nombre_para=$request->input('nombre_para',0);
    	$mensaje=new Mensajes;
    	$mensaje->de=Auth::user()->id;
    	$mensaje->nombre_de=Auth::user()->nombres.' '.Auth::user()->apellidos;
    	$mensaje->para=$para;
    	$mensaje->nombre_para=$nombre_para;
    	$mensaje->contenido=$contenido;
    	$mensaje->estado=1;


    	if( $mensaje->save()){
          
    		return response()->json([ 'estado' => 'creado' ],200);
    	}
    	else{

    		return response()->json([ 'estado' => 'error' ],400);
    	}


    }


     public function responder_mensaje(Request $request)
    {
        $respuesta=$request->input('respuesta','sin datos');
        $idmensaje=$request->input('mensaje_id',1);
        $mensajeinicial=Mensajes::find($idmensaje);
        
        $mensaje=new Mensajes;
        $mensaje->de=Auth::user()->id;
        $mensaje->nombre_de=Auth::user()->nombres.' '.Auth::user()->apellidos;
        $mensaje->para=$mensajeinicial->de;
        $mensaje->nombre_para=$mensajeinicial->nombre_de;
        $mensaje->contenido=$respuesta;
        $mensaje->estado=1;
        if( $mensaje->save()){
            return response()->json([ 'estado' => 'creado' ],200);
        }
        else{

            return response()->json([ 'estado' => 'error' ],400);
        }


    }


       public function archivar_mensaje(Request $request)
    {
       
        $idmensaje=$request->input('mensaje_id',1); 
        $mensaje=Mensajes::find($idmensaje);
        $mensaje->estado=0;
        if( $mensaje->save()){
            return response()->json([ 'estado' => 'archivado' ],200);
        }
        else{

            return response()->json([ 'estado' => 'error' ],400);
        }


    }




}