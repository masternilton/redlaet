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
use PDF;
use App\Paises;


define('DOMPDF_ENABLE_AUTOLOAD', false);
require_once "../vendor/dompdf/dompdf/dompdf_config.inc.php";





class pdfController extends Controller
{




    public function reporte_pdf_usuarios(Request $request){

     $datonombre=$request->input('filpdf_nombre')?: 'vacio';
    $datoemail=$request->input('filpdf_email')?: 'vacio';
    $datopais=$request->input('filpdf_pais')?: 'vacio';
    $datociudad=$request->input('filpdf_ciudad')?: 'vacio';  
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

   if($datonombre=='vacio' and $datoemail=='vacio' and $datopais=='vacio' and  $datociudad=='vacio' ){

        $usuarios=User::all();
        $collectionU = $collectionU->merge($usuarios); 
   }

    ini_set("pcre.backtrack_limit", "1000000");
    ini_set("memory_limit","512M");

    $options = array(
  
 
    );

  
    $usuario=Auth::user();
    $usuarios=$collectionU;

    $pdf = PDF::loadView('reportes.pdf_tabla_usuarios', compact(['usuarios',$collectionU  ]) );
    $pdf->setOptions($options );

    return $pdf->stream('usuariosdelsistema.pdf');
   
      


  }

  public function reporte_pdf_usuarios_pais(Request $request){
   
    $datonombre=$request->input('filpdf_nombre')?: 'vacio';
    $datoemail=$request->input('filpdf_email')?: 'vacio';
    $datopais=$request->input('filpdf_pais')?: 'vacio';
    $datociudad=$request->input('filpdf_ciudad')?: 'vacio';

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


        if($datonombre=='vacio' and $datoemail=='vacio' and $datopais=='vacio' and  $datociudad=='vacio' ){

        $usuarios=User::where('pais','=', $cordinadorpais )->get();
        $collectionU = $collectionU->merge($usuarios); 
      }

    ini_set("pcre.backtrack_limit", "1000000");
    ini_set("memory_limit","512M");

    $options = array();

  
    $usuario=Auth::user();
    $usuarios=$collectionU;
    $pdf = PDF::loadView('reportes.pdf_tabla_usuarios_pais', compact(['usuarios',$collectionU  ]) );
    $pdf->setOptions($options );
    return $pdf->stream('usuariosdelsistema.pdf');
   
}


 public function reporte_pdf_usuarios_region(Request $request){
   
    $datonombre=$request->input('filpdf_nombre')?: 'vacio';
    $datoemail=$request->input('filpdf_email')?: 'vacio';
    $datopais=$request->input('filpdf_pais')?: 'vacio';
    $datociudad=$request->input('filpdf_ciudad')?: 'vacio';


	  	$useract=Auth::user();
	   $region= $useract->region_rol;
	   $clavecontinente=0;

	   if($region=='SurAmerica'){  
	   	$filtropaises=Paises::where("continenteid","=",442 )->get(); 
	   }

	  

	   if($region=='Norteamerica ,CentroAmerica y el Caribe'){ 
	   	  $filtropaises=Paises::where("continenteid","=",453 )->where("continenteid","=",2089 )->get();
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


     if($datonombre=='vacio' and $datoemail=='vacio' and $datopais=='vacio' and  $datociudad=='vacio' ){

        $usuarios=User::whereIn('pais',$arraypaises)->get();
        $collectionU = $collectionU->merge($usuarios); 
     }

    ini_set("pcre.backtrack_limit", "1000000");
    ini_set("memory_limit","512M");

    $options = array();

  
    $usuario=Auth::user();
    $usuarios=$collectionU;
    $regionsel=strtoupper($useract->region_rol );
    $pdf = PDF::loadView('reportes.pdf_tabla_usuarios_region', 
    	compact(['usuarios','regionsel'  ]) );
    $pdf->setOptions($options );
    return $pdf->stream('usuariosregion.pdf');



	}


  public function  reporte_pdf_coordinadoresRegGlobal(Request $request){

    $usuarios=User::where('rol','=',5)->orderBy('apellidos','asc')->paginate(100);
    $usuario_actual=Auth::user();
 


    ini_set("pcre.backtrack_limit", "1000000");
    ini_set("memory_limit","512M");

    $options = array();

    $pdf = PDF::loadView('reportes.pdf_tabla_coordinadoresReg', compact(['usuarios',$usuarios  ]) );
    $pdf->setOptions($options );

    return $pdf->stream('coordinadoresReg_sistema.pdf');

  }


   public function  reporte_pdf_coordinadoresPaisGlobal(Request $request){

    $usuarios=User::where('rol','=',2)->orderBy('apellidos','asc')->paginate(100);
    $usuario_actual=Auth::user();
 


    ini_set("pcre.backtrack_limit", "1000000");
    ini_set("memory_limit","512M");

    $options = array();

    $pdf = PDF::loadView('reportes.pdf_tabla_coordinadoresPais', compact(['usuarios',$usuarios  ]) );
    $pdf->setOptions($options );

    return $pdf->stream('coordinadoresPais_sistema.pdf');

  }


  public function  reporte_pdf_coordinadoresZonaGlobal(Request $request){

    $usuarios=User::where('rol','=',3)->orderBy('apellidos','asc')->paginate(100);
    $usuario_actual=Auth::user();
 


    ini_set("pcre.backtrack_limit", "1000000");
    ini_set("memory_limit","512M");

    $options = array();

    $pdf = PDF::loadView('reportes.pdf_tabla_coordinadoresZona', compact(['usuarios',$usuarios  ]) );
    $pdf->setOptions($options );

    return $pdf->stream('coordinadoresZona_sistema.pdf');

  }


   

}