<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planificacione extends Model
{
    use HasFactory;

    protected $fillable =['id_meta',  'fecha_inicio', 'fecha_fin', 'fecha_realCulm', 'asignado', 'observacion'];

    public function meta(){
        return $this->belongsTo('App\Models\Meta');
    }
}
