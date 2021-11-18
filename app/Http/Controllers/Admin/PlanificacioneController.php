<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Planificacione;
use App\Models\Meta;
use Illuminate\Support\Facades\DB;



class PlanificacioneController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.planificaciones.index')->only('index');
        $this->middleware('can:admin.planificaciones.create')->only('create', 'store');
        $this->middleware('can:admin.planificaciones.edit')->only('edit', 'update');
    }

    public function index()
    {
        //$planificaciones = Planificacione::all();

        $planificaciones = Planificacione::join('metas', 'metas.id', '=', 'planificaciones.id_meta')

            ->select([
                'planificaciones.id', 'planificaciones.fecha_inicio', 'planificaciones.fecha_fin',
                'planificaciones.fecha_realCulm', 'planificaciones.asignado', 'planificaciones.observacion',
                'metas.meta'

            ])
            ->Where('metas.estatus', '<>', 3)
            ->get();
        return view('admin.planificaciones.index', compact('planificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $metas = Meta::Where('metas.estatus', '<>', 3)->get();
        //return view('admin.coordinaciones.create',  $metas);
        //dd($metas);
        return view('admin.planificaciones.create', compact('metas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_meta' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'asignado' => 'required|numeric',
            'observacion' => 'required',

        ]);
        $asignado = $request->asignado; //a asignar en esta programación
        $id_meta = $request->id_meta; //idMeta

        $meta = Meta::where('id', '=', $id_meta)->first();
        $porasignar = $meta['nro_programado_demanda_porasignar']; //total por asignar
        //dd($porasignar);
        if ($porasignar >= $asignado) {
            $porasignarNuevoSaldo = $porasignar - $asignado;

            //dd($porasignarNuevoSaldo);

            $affected = DB::table('metas') //actuyalizo al nuevo saldo
                ->where('id', $id_meta)
                ->update(['nro_programado_demanda_porasignar' => $porasignarNuevoSaldo]);
            $planificacionNueva = new Planificacione();

            $planificacionNueva->id_meta = $id_meta;
            $planificacionNueva->fecha_inicio = $request->fecha_inicio;
            $planificacionNueva->fecha_fin = $request->fecha_fin;
            $planificacionNueva->asignado = $request->asignado;
            $planificacionNueva->observacion = $request->observacion;
            $planificacionNueva->save();

            return redirect()->route('admin.planificaciones.index', $planificacionNueva)->with('info', 'La Planificación Especifica se ha Registrado.!! Por asignar => ' . $porasignarNuevoSaldo);
        } else if ($porasignar < $asignado) {
            echo '<script type="text/javascript">', 'alert("Atención!! La cantidad a asignar Sobrepasa a lo que queda por asignar en la programación de la meta!!");', '</script>';

            $planificaciones = Planificacione::join('metas', 'metas.id', '=', 'planificaciones.id_meta')

                ->select([
                    'planificaciones.id', 'planificaciones.fecha_inicio', 'planificaciones.fecha_fin',
                    'planificaciones.fecha_realCulm', 'planificaciones.asignado', 'planificaciones.observacion',
                    'metas.meta'

                ])
                ->Where('metas.estatus', '<>', 3)
                ->get();
            return view('admin.planificaciones.index', compact('planificaciones'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Planificacione $planificacione)
    {
        return view('admin.planificaciones.edit', compact('planificacione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planificacione $planificacione)
    {
        $request->validate([
            'fecha_realCulm' =>'required'
        ]);
        $planificacione -> update($request->all());
        return redirect()->route('admin.planificaciones.index', $planificacione)->with('info', 'La fecha culminación real de esta programación se ha actualizado!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
