<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avance extends Model
{
    use HasFactory;
    protected $fillable =['avance_ala_fecha_pocentaje', 'obs_avance','id_meta', 'id_usuario_reg'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function meta(){
        return $this->belongsTo('App\Models\Meta');
    }
}
