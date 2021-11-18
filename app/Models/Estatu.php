<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estatu extends Model
{
    use HasFactory;

    public function metas(){
        return $this->hasMany('App\Models\Metas');
    }

    public function objetivos(){
        return $this->hasMany('App\Models\Objetivo');
    }

    public function actividades(){
        return $this->hasMany('App\Models\Actividade');
    }
}
