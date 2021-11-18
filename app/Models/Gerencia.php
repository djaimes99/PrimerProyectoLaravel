<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gerencia extends Model
{
    use HasFactory;

    protected $fillable =['nombre', 'id_usuario_enc'];

    //relacion uno a muchos

    public function coordinaciones(){
        return $this->hasMany('App\Models\Coordinacione');
    }
    
}
