<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividade extends Model
{
    use HasFactory;
    protected $fillable =['id_meta', 'nombre_actividad', 'tipo', 'fecha_estim_final', 'fecha_culminada_act', 'observacion_just_imprevisto_act','id_usuario_reg', 'estatus'];

    public function meta(){
        return $this->belongsTo('App\Models\Meta');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function estatu(){
        return $this->belongsTo('App\Models\Estatu');
    }
}
