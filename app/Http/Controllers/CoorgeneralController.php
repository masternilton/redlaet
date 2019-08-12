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
use App\Actividades;
use App\Jobs\SendEmailTest;
use App\Jobs\SendEmailNoticiajob;
use DB;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;


class CoorgeneralController extends Controller
{
  
  

}