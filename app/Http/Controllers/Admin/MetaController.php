<?php

namespace App\Http\Controllers\Admin;

use BD;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meta;
use App\Models\Coordinacione;
use App\Models\User;
use App\Models\Avance;
use App\Models\Gerencia;
use App\Models\Objetivo;
use App\Models\Actividade;
use Illuminate\Support\Facades\DB;

class MetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.metas.index')->only('index');
        $this->middleware('can:admin.metas.create')->only('create', 'store');
        $this->middleware('can:admin.metas.edit')->only('edit', 'update');
        $this->middleware('can:admin.metas.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        //////------ metas iniciadas a culminadas-------------//
        $update_metas_a_culminadas = Meta::Where('estatus', '=', 1) //metas a tomar estatus =1
            //que se toman en cuenta, pues van a pasar a culminado
            //->Where('tipo', '=', 0)  // tipo 0 toma en cuenta solo las previstas, NO las imprevistas (1)                            
            ->get(); //metas iniciadas No Culminadas
        //para las metas no existe estatus 2 OJO, solo 1 y 3 (1=>No Iniciado Registrado) y (3=>Culminado) 
        foreach ($update_metas_a_culminadas as $item) {

            //calculo actividades totales y las culminadas
            $count_act_tot = Actividade::where('id_meta', '=', $item->id)
                ->Where('tipo', '=', 0) // tipo 0 toma en cuenta solo las previstas, NO las imprevistas
                ->count();
            $count_act_tot_culm = Actividade::where('id_meta', '=', $item->id)
                ->Where('tipo', '=', 0) // tipo 0 toma en cuenta solo las previstas, NO las imprevistas (1)
                ->Where('estatus', '=', 3) //culminadas
                ->count();
            //end calculo actividades totales y las culminadas

            //calculo avance a la fecha segun actividades culminadas
            if ($count_act_tot > 0) {
                $avance_ala_fecha = ($count_act_tot_culm / $count_act_tot) * 100;
            } else {
                $avance_ala_fecha = 0;
            }
            //end calculo avance a la fecha segun actividades culminadas

            //update avance a la fecha segun actividades culminadas
            $affected_avance = DB::table('metas') //actualizo esta meta avance_ala_fecha
                ->where('id', $item->id)
                ->update(['avance_ala_fecha' => $avance_ala_fecha]);
            //end update avance a la fecha segun actividades culminadas

            //si las actividades totales de la meta == act culminadas 
            //y por lo menos existe una actividad cargada.. Si se cumple culmino meta=> estatus 3
            if (($count_act_tot == $count_act_tot_culm) && ($count_act_tot != 0)) {
                $affected = DB::table('metas') //actualizo esa meta a culminada (2)
                    ->where('id', $item->id)
                    ->update(['estatus' => 3]);

                $affected = DB::table('metas') //Guardo La fecha culminacion meta 
                    //si culminaron todas las actividades
                    ->where('id', $item->id)
                    ->update(['fecha_culminada_meta' => date('y-m-d')]); //a la fecha actual
            }
            // end if (($count_act_tot == $count_act_tot_culm) && ($count_act_tot!=0))
        }
        //////------ end metas iniciadas a culminadas--------//

        //////------ Objetivos iniciados a culminados--------// 
        $update_objetivos_a_culminados = Objetivo::Where('estatus', '=', 1)
            ->Where('tipo', '=', 0)  // tipo 0 toma en cuenta solo las previstas, NO las imprevistas (1) 
            ->get(); //Objetivos iniciadas No Culminadas

        foreach ($update_objetivos_a_culminados as $item) {

            //calculo objetivos totales y culminados
            $count_met_tot = Meta::where('id_objetivo', '=', $item->id)
                ->Where('tipo', '=', 0)  // tipo 0 toma en cuenta solo las previstas, NO las imprevistas (1)
                ->count();
            $count_met_tot_culm = Meta::where('id_objetivo', '=', $item->id)
                ->Where('tipo', '=', 0)  // tipo 0 toma en cuenta solo las previstas, NO las imprevistas (1)
                ->Where('estatus', '=', 3)
                ->count();
            //end calculo objetivos totales y culminados

            if ($count_met_tot > 0) {
                $avance_obj = ($count_met_tot_culm / $count_met_tot) * 100;
            } else {
                $avance_obj = 0;
            }

            $affected_avance = DB::table('objetivos') //actualizo este obj avance_obj
                ->where('id', $item->id)
                ->update(['avance_obj' => $avance_obj]);

            if (($count_met_tot == $count_met_tot_culm) && ($count_met_tot != 0)) {
                $affected = DB::table('objetivos') //actualizo este objetivo a culminado (3)
                    ->where('id', $item->id)
                    ->update(['estatus' => 3]);

                $affected = DB::table('objetivos') //Guardo La fecha culminacion Objetivo 
                    //si culminaron todas las metas
                    ->where('id', $item->id)
                    ->update(['fecha_culminada_obj' => date('y-m-d')]);
            }
        }

        //////------ End Objetivos iniciados a culminados--------// 


        $id = $request->user()->id; //id usuario
        $id_coordinacion = $request->user()->id_coordinacion; //id_coordinación

        $coordinacione = Coordinacione::where('id', '=', $id_coordinacion)->first();
        $id_gerencia = $coordinacione['id_gerencia']; //id_gerencia

        $role = DB::table('model_has_roles')->where('model_id', $id)->first();
        $role_id = $role->role_id; //role_id
        session(['role_id' => $role_id]);  //variable session creada rol


        //---------------------Muetsra lista Metas segun el rol--------------------------//
        if ($role_id == 1) {

            $metas = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->join('objetivos', 'objetivos.id', '=', 'metas.id_objetivo')
                ->select([
                    'metas.id', 'metas.meta', 'metas.avance_ala_fecha',
                    'metas.fecha_inicio', 'metas.fecha_fin', 'metas.estatus', 'metas.tipo',
                    'metas.nro_programado_demanda','metas.nro_programado_demanda_porasignar',
                    'metas.meta_modo','coordinaciones.nombre_coord',
                    'gerencias.nombre', 'objetivos.objetivo'
                ])
                //->Where('metas.estatus', '<>', 3)
                ->get();
        } else if ($role_id == 2) {

            $metas = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->join('objetivos', 'objetivos.id', '=', 'metas.id_objetivo')
                ->select([
                    'metas.id', 'metas.meta', 'metas.avance_ala_fecha',
                    'metas.fecha_inicio', 'metas.fecha_fin', 'metas.estatus', 'metas.tipo', 'metas.meta_modo',
                    'metas.nro_programado_demanda','metas.nro_programado_demanda_porasignar',
                     'coordinaciones.nombre_coord', 'gerencias.nombre', 'objetivos.objetivo'
                ])
                //->Where('metas.estatus', '<>', 3)
                ->Where('gerencias.id', '=', $id_gerencia)
                ->get();
        } else {

            $metas = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->join('objetivos', 'objetivos.id', '=', 'metas.id_objetivo')
                ->select([
                    'metas.id', 'metas.meta', 'metas.avance_ala_fecha',
                    'metas.fecha_inicio', 'metas.fecha_fin', 'metas.estatus', 'metas.meta_modo',
                    'metas.nro_programado_demanda','metas.nro_programado_demanda_porasignar',
                    'metas.tipo', 'coordinaciones.nombre_coord', 'gerencias.nombre', 'objetivos.objetivo'
                ])
                //->Where('metas.estatus', '<>', 3)
                ->Where('coordinaciones.id', '=', $id_coordinacion)
                ->get();
            

        }
        //dd($metas);//metas por coordinaciones
        //---------------------End Muetsra lista Metas segun el rol--------------------------//

        //$gerencias = ['gerencias' => Gerencia::pluck('nombre', 'id')];
        //$coordinaciones = ['coordinaciones' => Coordinacione::pluck('nombre_coord', 'id')];
        //dd($metas);  
        return view('admin.metas.index', compact('metas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$coordinaciones = ['coordinaciones' => Coordinacione::pluck('nombre_coord', 'id')];
        //$objetivos = ['objetivos' => Objetivo::pluck('objetivo', 'id')];
        $id = $request->user()->id; //id usuario
        $id_coordinacion = $request->user()->id_coordinacion; //id_coordinación

        $coordinacione = Coordinacione::where('id', '=', $id_coordinacion)->first();
        $id_gerencia = $coordinacione['id_gerencia']; //id_gerencia

        $role = DB::table('model_has_roles')->where('model_id', $id)->first();
        $role_id = $role->role_id; //role_id

        if ($role_id == 1) {

            $objetivos = Objetivo::join('coordinaciones', 'coordinaciones.id', '=', 'objetivos.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->Where('objetivos.estatus', '<>', 3)
                ->pluck('objetivos.objetivo', 'objetivos.id'); //select con varias tablas

        } else if ($role_id == 2) {

            $objetivos = Objetivo::join('coordinaciones', 'coordinaciones.id', '=', 'objetivos.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->Where('gerencias.id', '=', $id_gerencia)
                ->Where('objetivos.estatus', '<>', 3)
                ->pluck('objetivos.objetivo', 'objetivos.id'); //select con varias tablas

        } else {

            $objetivos = Objetivo::join('coordinaciones', 'coordinaciones.id', '=', 'objetivos.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->Where('coordinaciones.id', '=', $id_coordinacion)
                ->Where('objetivos.estatus', '<>', 3)
                ->pluck('objetivos.objetivo', 'objetivos.id'); //select con varias tablas

        }
        return view('admin.metas.create', compact('objetivos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_coordinacion = $request->user()->id_coordinacion;

        $request->validate([
            'meta' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'meta_modo' => 'required',

            'nro_programado_demanda' => 'required|numeric',
            'explicacion_prog_dem' => 'required',
            'ejecutado' => 'required|numeric',
            //'avance_ala_fecha' => 'required|numeric',
            'tipo' => 'required',
            'id_objetivo' => 'required'

        ]);
        //dd('helo: '.$id_coordinacion);


        if (($request->tipo == 1) and ($request->observacion_just_imprevisto_meta == "")) {
            echo '<script type="text/javascript">', 'alert("Atención!! en el campo (Justificación Meta Imprevista), debe registrar el motivo del porqué se agrega esta Meta Imprevista!!");', '</script>';
            $id = $request->user()->id; //id usuario
            $id_coordinacion = $request->user()->id_coordinacion; //id_coordinación

            $coordinacione = Coordinacione::where('id', '=', $id_coordinacion)->first();
            $id_gerencia = $coordinacione['id_gerencia']; //id_gerencia

            $role = DB::table('model_has_roles')->where('model_id', $id)->first();
            $role_id = $role->role_id; //role_id

            if ($role_id == 1) {

                $objetivos = Objetivo::join('coordinaciones', 'coordinaciones.id', '=', 'objetivos.id_coordinacion')
                    ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                    ->pluck('objetivos.objetivo', 'objetivos.id'); //select con varias tablas

            } else if ($role_id == 2) {

                $objetivos = Objetivo::join('coordinaciones', 'coordinaciones.id', '=', 'objetivos.id_coordinacion')
                    ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                    ->Where('gerencias.id', '=', $id_gerencia)
                    ->pluck('objetivos.objetivo', 'objetivos.id'); //select con varias tablas

            } else {

                $objetivos = Objetivo::join('coordinaciones', 'coordinaciones.id', '=', 'objetivos.id_coordinacion')
                    ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                    ->Where('coordinaciones.id', '=', $id_coordinacion)
                    ->pluck('objetivos.objetivo', 'objetivos.id'); //select con varias tablas

            }
            return view('admin.metas.create', compact('objetivos'));

            return view('admin.metas.create');
        }
        $metaNueva = new Meta();

        $metaNueva->id_coordinacion = $id_coordinacion;
        $metaNueva->meta = $request->meta;
        $metaNueva->iniciativa = $request->iniciativa;
        $metaNueva->supuesto = $request->supuesto;
        $metaNueva->indicadores = $request->indicadores;
        $metaNueva->nro_programado_demanda = $request->nro_programado_demanda;
        $metaNueva->nro_programado_demanda_porasignar = $request->nro_programado_demanda;
        $metaNueva->ejecutado = $request->ejecutado;
        $metaNueva->avance_ala_fecha = 0;
        $metaNueva->fecha_inicio = $request->fecha_inicio;
        $metaNueva->fecha_fin = $request->fecha_fin;
        $metaNueva->meta_modo = $request->meta_modo;
        $metaNueva->nro_pto_cta_aprob_poai = $request->nro_pto_cta_aprob_poai;
        $metaNueva->id_usuario_reg = $request->user()->id;
        $metaNueva->explicacion_prog_dem = $request->explicacion_prog_dem;
        $metaNueva->id_objetivo = $request->id_objetivo;
        $metaNueva->tipo = $request->tipo;

        if ($request->tipo == 1) {
            $metaNueva->observacion_just_imprevisto_meta = $request->observacion_just_imprevisto_meta;
        } else {
            $metaNueva->observacion_just_imprevisto_meta = "";
        }
        //return $metaNueva;
        $metaNueva->save();
        //dd($metaNueva);
        return redirect()->route('admin.metas.index', $metaNueva)->with('info', 'La Meta se ha Creado!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Meta $meta)
    {
        return view('admin.metas.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Meta $meta)
    {
        $objetivos = ['objetivos' => Objetivo::pluck('objetivo', 'id')];
        return view('admin.metas.edit', compact('meta', 'objetivos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meta $meta)
    {
        $request->validate([

            //'id_objetivo' => 'required',
            //'meta' => 'required',
            //'fecha_inicio' => 'required',
            //'fecha_fin' => 'required',
            //'programado' => 'required|numeric',
            'ejecutado' => 'required|numeric'

        ]);


        $meta->update($request->all());
        return redirect()->route('admin.metas.index', $meta)->with('info', 'La Meta se ha Actualizado!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meta $meta)
    {
        //$meta->delete();
        //$meta->update($request->all());
        $meta = Meta::find($meta->id);

        /*$avance = new Avance();
        $avance->avance_ala_fecha_pocentaje = 0;
        $avance->obs_avance = $request->obs_avance_obstaculo;
        $avance->id_meta = $meta->id;
        $avance->id_usuario_reg = $request->user()->id;
        $avance->save();*/

        if ($meta) {
            $meta->estatus = 3; //inactivo o eliminado logico
            $meta->save();
        }
        return redirect()->route('admin.metas.index')->with('info', 'La Meta se ha Eliminado!!');
    }

    /* public function barChart(){
    return view('admin.metas.barchart');
   }   */
}
