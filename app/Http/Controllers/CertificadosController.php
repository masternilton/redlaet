<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Directorio;
use Auth;

define('DOMPDF_ENABLE_AUTOLOAD', false);
require_once "../vendor/dompdf/dompdf/dompdf_config.inc.php";


class CertificadosController extends Controller
{
    
 public function generar_certificado (){

    $dompdf = new \DOMPDF;
    $usurio=Auth::user();
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
    $fecha_actual=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

    $dompdf->set_option('enable_html5_parser', TRUE);
   

    $codigo = view('certificados.certificado_pertenencia')
    ->with('fecha_actual',$fecha_actual)
    ->with('usuario',$usurio);
   
    $dompdf->load_html($codigo);
    
    // (Optional) Setup the paper size and orientation
    $dompdf->set_paper('letter', 'portrait');
    $dompdf->render();
    
    // Output the generated PDF to Browser
    return  $dompdf-> stream("certificado.pdf", array("Attachment" => false));
    //return $dompdf->stream("sample.pdf");


 }



  public function generar_certificado_coordinador (){

    $dompdf = new \DOMPDF;
    $usuario=Auth::user();
     $rols = array(1, 2, 3, 5);
    if (!in_array($usuario->rol, $rols)) {
          return view('mensajes.mensaje_error')->with('msj','no tiene autorizacion para esta seccion');
    }
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
    $fecha_actual=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

      $titulo_coordinador='';
    if($usuario->rol==1  ){  $titulo_coordinador=$usuario->nom_rol;  }
    if($usuario->rol==2  ){  $titulo_coordinador=$usuario->nom_rol. ' para ' .$usuario->pais_rol;  }
    if($usuario->rol==3  ){  $titulo_coordinador=$usuario->nom_rol.' ' .$usuario->zona_rol . ' en  ' .$usuario->pais_rol ;  }
    
    if($usuario->rol==5 ){  $titulo_coordinador=$usuario->nom_rol.' '.$usuario->region_rol;  }


    $dompdf->set_option('enable_html5_parser', TRUE);

    $codigo = view('certificados.certificado_pertenencia_coordinador')
    ->with('fecha_actual',$fecha_actual)
    ->with('titulo_coordinador',$titulo_coordinador)
    ->with('usuario',$usuario);
   
    $dompdf->load_html($codigo);
    
    // (Optional) Setup the paper size and orientation
    $dompdf->set_paper('letter', 'portrait');
    $dompdf->render();
    
    // Output the generated PDF to Browser
    return  $dompdf-> stream("certificado_coordinador.pdf", array("Attachment" => false));
    //return $dompdf->stream("sample.pdf");


 }


 public function listado_certificado (){

    $usuario=Auth::user();
    $escoordinador=false;
    $rols = array(1, 2, 3, 5);
    if (in_array($usuario->rol, $rols)) {
         $escoordinador=true;
    }

    return view('mired.listado_certificados_red')->with('escoordinador',$escoordinador);


 }




}
