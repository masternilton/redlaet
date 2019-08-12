<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Actividades extends Model
{
     protected $table='actividades';

     public function creador($id)
    {
    	
        $user=User::find($id);
        if( $user){   return $user;  }
        if( !$user){   
        	User::find(4314);

        	return $user;  
        }
       
    }
}

