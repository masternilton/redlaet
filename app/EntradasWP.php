<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradasWP extends Model
{
    protected $connection = 'basewordpres';
    protected $table='wp_posts';
}
