<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    use HasFactory;
    protected $fillable =['objetivo', 'tipo', 'fecha_culminada_obj', 'observacion_just_imprevisto_obj','id_usuario_reg', 'id_coordinacion'];

    public function metas(){
        return $this->hasMany('App\Models\Meta');
    } 
    public function user(){
        return $this->belongsTo('App\Models\User');
    } 

    public function coordinacion(){
        return $this->belongsTo('App\Models\Coordinacione');
    } 
    public function estatu(){
        return $this->belongsTo('App\Models\Estatu');
    }
}