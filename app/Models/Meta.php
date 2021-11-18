<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;
    protected $fillable =['id_coordinacion', 'meta', 'iniciativa','supuesto', 'indicadores',
     'fecha_inicio', 'fecha_fin', 'fecha_culminada_meta','nro_programado_demanda','nro_programado_demanda_porasignar', 
    'explicacion_prog_dem', 'ejecutado', 'avance_ala_fecha', 'obs_avance_obstaculo', 'observacion_just_imprevisto_meta',
    'nro_pto_cta_aprob_poai', 'id_objetivo', 'meta_modo', 'tipo', 'id_usuario_reg'];

    public function estatu(){
        return $this->belongsTo('App\Models\Estatu');
    }
    
    public function coordinacione(){
        return $this->belongsTo('App\Models\Coordinacione');
    }

    public function actividades(){
        return $this->hasMany('App\Models\Actividade');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }


    public function avances(){
        return $this->hasMany('App\Models\Avance');
    }

    public function planificacionespecificametas(){
        return $this->hasMany('App\Models\Planificacione');
    }

    public function desgloses(){
        return $this->hasMany('App\Models\Desglose');
    }
}
