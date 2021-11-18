<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desglose extends Model
{
    use HasFactory;

    protected $fillable =['id_meta',  'desde', 'hasta', 'asignado', 'observacion_desg'];

    public function meta(){
        return $this->belongsTo('App\Models\Meta');
    }
}
