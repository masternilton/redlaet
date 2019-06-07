<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\EntradasWP;

class EntradaswpController extends Controller
{
    //

    public function listado_entradaswp(){
       $entradas=EntradasWP::where('post_status','=', 'publish')->where('post_content','!=', '')->where('post_type','=', 'post')->orderBy('post_date', 'desc')->limit(30)->get();
       $cc=new CorreoController;
       $cc->desbloquear_email();
 
       return view('listados.listado_entradaswp')->with('entradas',$entradas);

    }


     public function buscar_entrada(Request $request){
     	$dato=$request->input('dato_buscado','');
     
     	if(strlen ($dato)<=2){ $dato='nn';  }
     	$entradas=EntradasWP::where('post_status','=', 'publish')
     	                      ->where('post_title','like', '%'.$dato.'%')->get();

     	return view('listados.listado_entradaswp')->with('entradas',$entradas);


     }






    

  





}
