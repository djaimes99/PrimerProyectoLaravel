<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinacione extends Model
{
    use HasFactory;
    protected $fillable =['nombre_coord', 'id_usuario_enc_coord', 'id_gerencia'];

  
    public function gerencia(){
        return $this->belongsTo('App\Models\Gerencia');
    }

     
     public function metas(){
        return $this->hasMany('App\Models\Meta');
    }

    public function users(){
        return $this->hasMany('App\Models\User');
    }

}
