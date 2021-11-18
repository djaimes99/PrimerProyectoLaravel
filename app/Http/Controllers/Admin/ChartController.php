<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meta;
use Illuminate\Support\Facades\DB;
use App\Models\Coordinacione;
use App\Models\User;
use App\Models\Actividade;
use App\Models\Objetivo;
use App\Models\Gerencia;

class ChartController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.charts.index')->only('index');
        

    }

    public function index(Request $request)
    {

        $gerencias = ['gerencias' => Gerencia::pluck('nombre', 'id')];
        $coordinaciones = ['coordinaciones' => Coordinacione::pluck('nombre_coord', 'id')];

        return view('admin.charts.index', compact('gerencias', 'coordinaciones'));
    }

    public function barChart(Request $request)
    {   
        //////------ metas iniciadas a culminadas-------------//
        $update_metas_a_culminadas = Meta::Where('estatus', '=', 1)->get(); //metas iniciadas No Culminadas

        foreach ($update_metas_a_culminadas as $item) {

            //calculo actividades totales y las culminadas
            $count_act_tot = Actividade::where('id_meta', '=', $item->id)->count();
            $count_act_tot_culm = Actividade::where('id_meta', '=', $item->id)
                ->Where('estatus', '=', 2)
                ->count();
            //end calculo actividades totales y las culminadas

            //calculo avance a la fecha segun actividades culminadas
            if($count_act_tot > 0){ 
                $avance_ala_fecha = ($count_act_tot_culm / $count_act_tot) * 100; 
            }else{
                $avance_ala_fecha = 0;
            }
            //end calculo avance a la fecha segun actividades culminadas

            //update avance a la fecha segun actividades culminadas
            $affected_avance = DB::table('metas')//actualizo esta meta avance_ala_fecha
                    ->where('id', $item->id)
                    ->update(['avance_ala_fecha' => $avance_ala_fecha ]);
            //end update avance a la fecha segun actividades culminadas

            //si las actividades totales de la meta == act culminadas 
            //y por lo menos existe una actividad cargada.. Si se cumple culmino meta=> estatus 2
            if (($count_act_tot == $count_act_tot_culm) && ($count_act_tot!=0)) { 
                $affected = DB::table('metas')//actualizo esa meta a culminada (2)
                    ->where('id', $item->id)
                    ->update(['estatus' => 2]);
            }
           // end if (($count_act_tot == $count_act_tot_culm) && ($count_act_tot!=0))
        }
         //////------ end metas iniciadas a culminadas--------//

         //////------ Objetivos iniciados a culminados--------// 
       $update_objetivos_a_culminados = Objetivo::Where('estatus', '=', 1)->get(); //Objetivos iniciadas No Culminadas

        foreach ($update_objetivos_a_culminados as $item) {

            //calculo objetivos totales y culminados
            $count_met_tot = Meta::where('id_objetivo', '=', $item->id)->count();
            $count_met_tot_culm = Meta::where('id_objetivo', '=', $item->id)
                ->Where('estatus', '=', 2)
                ->count();
            //end calculo objetivos totales y culminados

            if($count_met_tot > 0){
                $avance_obj = ($count_met_tot_culm / $count_met_tot) * 100; 
            }else{
                $avance_obj = 0;
            }

            $affected_avance = DB::table('objetivos')//actualizo este obj avance_obj
            ->where('id', $item->id)
            ->update(['avance_obj' => $avance_obj ]);

            if (($count_met_tot == $count_met_tot_culm) && ($count_met_tot!=0)) {
                $affected = DB::table('objetivos')//actualizo este objetivo a culminado (2)
                    ->where('id', $item->id)
                    ->update(['estatus' => 2]);
            }
        }
        $fechaini = $request->fecha_inicio;
        $fechafin = $request->fecha_fin;
        $id_gerencia = $request->id_gerencia;
        $id_coordinacion = $request->id_coordinacion;
        $tipo = $request->tipo;

        if(is_null($id_coordinacion)){
            $coordinacion ='';
        }else{
            $coordinacione_colec = Coordinacione::where('id', '=', $id_coordinacion)->first();
            $coordinacion = $coordinacione_colec['nombre_coord']; 
        }

        if(is_null($id_gerencia)){
            $gerencia = '';
        }else{
            $gerencia_colec = Gerencia::where('id', '=', $id_gerencia)->first();
            $gerencia = $gerencia_colec['nombre']; 
        }

        if (is_null($id_gerencia)) { // seleccciona solo la coordinación sin gerencia

            $metasTot = DB::table('metas')
                ->where('id_coordinacion', $id_coordinacion)
                ->where('estatus', '<>',3)
                ->where('fecha_inicio', '>=', $fechaini)
                ->where('fecha_fin', '<=', $fechafin)
                ->count();

            $metas20YMenor = DB::table('metas')
                ->where('id_coordinacion', $id_coordinacion)
                ->where('estatus', '<>',3)
                ->where('fecha_inicio', '>=', $fechaini)
                ->where('fecha_fin', '<=', $fechafin)
                ->where('avance_ala_fecha', '<=', 20)
                ->count();
                if($metasTot!=0){
                    $porc_20YMenor = ($metas20YMenor/$metasTot)*100;
                }else{
                    $porc_20YMenor = 0; 
                }
            

            $metasMay20YMenIgual80 = DB::table('metas')
                ->where('id_coordinacion', $id_coordinacion)
                ->where('estatus', '<>',3)
                ->where('fecha_inicio', '>=', $fechaini)
                ->where('fecha_fin', '<=', $fechafin)
                ->where('avance_ala_fecha', '>', 20)
                ->where('avance_ala_fecha', '<=', 80)
                ->count();
                if($metasTot!=0){
                    $porc_May20MenIgual80 = ($metasMay20YMenIgual80/$metasTot)*100;
                }else{
                    $porc_May20MenIgual80 = 0; 
                }
            
            
            $metasMay80 = DB::table('metas')
                ->where('id_coordinacion', $id_coordinacion)
                ->where('estatus', '<>',3)
                ->where('fecha_inicio', '>=', $fechaini)
                ->where('fecha_fin', '<=', $fechafin)
                ->where('avance_ala_fecha', '>', 80)
                ->count();
                if($metasTot!=0){
                    $porc_May80 = ($metasMay80/$metasTot)*100;
                }else{
                    $porc_May80 = 0; 
                }
            

        } else { //seleccionado la gerencia

            $metasTot = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->where('id_gerencia', $id_gerencia)
                ->where('estatus', '<>',3)
                ->where('fecha_inicio', '>=', $fechaini)
                ->where('fecha_fin', '<=', $fechafin)
                ->count();

            $metas20YMenor = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->where('id_gerencia', $id_gerencia)
                ->where('estatus', '<>',3)
                ->where('fecha_inicio', '>=', $fechaini)
                ->where('fecha_fin', '<=', $fechafin)
                ->where('avance_ala_fecha', '<=', 20)
                ->count();
                if($metasTot!=0){
                    $porc_20YMenor = ($metas20YMenor/$metasTot)*100;
                }else{
                    $porc_20YMenor = 0; 
                }
            

            $metasMay20YMenIgual80 = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->where('id_gerencia', $id_gerencia)
                ->where('estatus', '<>',3)
                ->where('fecha_inicio', '>=', $fechaini)
                ->where('fecha_fin', '<=', $fechafin)
                ->where('avance_ala_fecha', '>', 20)
                ->where('avance_ala_fecha', '<=', 80)
                ->count();
                if($metasTot!=0){
                    $porc_May20MenIgual80 = ($metasMay20YMenIgual80/$metasTot)*100;
                }else{
                    $porc_May20MenIgual80 = 0; 
                }
            
            //dd($metas20);
            $metasMay80 = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->where('id_gerencia', $id_gerencia)
                ->where('estatus', '<>',3)
                ->where('fecha_inicio', '>=', $fechaini)
                ->where('fecha_fin', '<=', $fechafin)
                ->where('avance_ala_fecha', '>', 80)
                ->count();
                if($metasTot!=0){
                    $porc_May80 = ($metasMay80/$metasTot)*100;
                }else{
                    $porc_May80 = 0; 
                }
            
            //dd($metasMay80);
        }

        $datas = array(0,0,0);
        //$rangos =array('Av <= 20%','20% > Av <= 80%','Av > 80%');
        $datas[0] = $porc_20YMenor;
        $datas[1] = $porc_May20MenIgual80;
        $datas[2] = $porc_May80;
        //dd($metasTot);
        return view('admin.charts.barchart', compact('datas', 'metasTot', 'gerencia', 'coordinacion'));
    }
}
