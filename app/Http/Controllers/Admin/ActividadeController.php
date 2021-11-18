<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gerencia;
use App\Models\Coordinacione;
use App\Models\Actividade;
use App\Models\Meta;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Estatu;

class ActividadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.actividades.index')->only('index');
        $this->middleware('can:admin.actividades.create')->only('create', 'store');
        $this->middleware('can:admin.actividades.edit')->only('edit', 'update');
        //$this->middleware('can:admin.actividades.destroy')->only('destroy');
    }
    public function index(Request $request)
    {

        $id = $request->user()->id; //id usuario
        $id_coordinacion = $request->user()->id_coordinacion; //id_coordinación

        $coordinacione = Coordinacione::where('id', '=', $id_coordinacion)->first();
        $id_gerencia = $coordinacione['id_gerencia']; //id_gerencia

        $role = DB::table('model_has_roles')->where('model_id', $id)->first();
        $role_id = $role->role_id; //role_id


        /*$actividades = Actividade::join('')
            ->join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
            ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
            ->select([
                'metas.id', 'metas.meta', 'metas.avance_ala_fecha',
                'metas.fecha_inicio', 'metas.fecha_fin', 'metas.estatus', 'metas.tipo', 'coordinaciones.nombre_coord',
                'gerencias.nombre'
            ])
            ->Where('metas.estatus', '<>', 2)->get();*/

        if ($role_id == 1) {
            $actividades = Actividade::join('metas', 'metas.id', '=', 'actividades.id_meta')
                ->join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->select([
                    'actividades.id', 'metas.meta', 'actividades.tipo','actividades.nombre_actividad', 'actividades.estatus',
                    'coordinaciones.nombre_coord', 'gerencias.nombre'
                ])
                //->Where('metas.estatus', '<>', 3)
                //->Where('actividades.estatus', '<>', 3)
                ->get();
        } else if ($role_id == 2) {
            $actividades = Actividade::join('metas', 'metas.id', '=', 'actividades.id_meta')
                ->join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->select([
                    'actividades.id', 'metas.meta', 'actividades.tipo','actividades.nombre_actividad', 'actividades.estatus',
                    'coordinaciones.nombre_coord', 'gerencias.nombre'
                ])
                //->Where('metas.estatus', '<>', 3)
                //->Where('actividades.estatus', '<>', 3)
                ->Where('gerencias.id', '=', $id_gerencia)
                ->get();
        } else {

            $actividades = Actividade::join('metas', 'metas.id', '=', 'actividades.id_meta')
                ->join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->select([
                    'actividades.id', 'metas.meta', 'actividades.tipo','actividades.nombre_actividad', 'actividades.estatus',
                    'coordinaciones.nombre_coord', 'gerencias.nombre'
                ])
                //->Where('metas.estatus', '<>', 3)
                //->Where('actividades.estatus', '<>', 3)
                ->Where('coordinaciones.id', '=', $id_coordinacion)
                ->get();
        }

        //$actividades = Actividade::all();

        return view('admin.actividades.index', compact('actividades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->user()->id;
        $id_coordinacion = $request->user()->id_coordinacion; //id_coordinación

        $coordinacione = Coordinacione::where('id', '=', $id_coordinacion)->first();
        $id_gerencia = $coordinacione['id_gerencia']; //id_gerencia

        $role = DB::table('model_has_roles')->where('model_id', $id)->first();
        $role_id = $role->role_id; //role_id

        if ($role_id == 1) {

            $metas = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->Where('metas.estatus', '<>', 3)
                ->pluck('metas.meta', 'metas.id'); //select con varias tablas


        } else if ($role_id == 2) {
            $metas = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->Where('metas.estatus', '<>', 3)
                ->Where('gerencias.id', '=', $id_gerencia)
                ->pluck('metas.meta', 'metas.id'); //select con varias tablas

        } else {

            $metas = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->Where('metas.estatus', '<>', 3)
                ->Where('coordinaciones.id', '=', $id_coordinacion)
                ->pluck('metas.meta', 'metas.id'); //select con varias tablas
        }
        return view('admin.actividades.create',  compact('metas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$id_coordinacion = $request->user()->id_coordinacion;
        $id = $request->user()->id;
        $request->validate([

            'nombre_actividad' => 'required',
            'id_meta' => 'required',
            'tipo' => 'required'

        ]);

        if (($request->tipo == 1) and ($request->observacion_just_imprevisto_act == "")) {

            echo '<script type="text/javascript">', 'alert("Atención!! en el campo (Justificación Actividad Imprevista), debe registrar el motivo del porqué se agrega esta Actividad Imprevista!!");', '</script>';
            $id = $request->user()->id;
            $id_coordinacion = $request->user()->id_coordinacion; //id_coordinación

            $coordinacione = Coordinacione::where('id', '=', $id_coordinacion)->first();
            $id_gerencia = $coordinacione['id_gerencia']; //id_gerencia

            $role = DB::table('model_has_roles')->where('model_id', $id)->first();
            $role_id = $role->role_id; //role_id

            if ($role_id == 1) {

                $metas = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                    ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                    //->Where('metas.estatus', '<>', 3)
                    ->pluck('metas.meta', 'metas.id'); //select con varias tablas


            } else if ($role_id == 2) {
                $metas = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                    ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                    ->Where('metas.estatus', '<>', 3)
                    //->Where('gerencias.id', '=', $id_gerencia)
                    ->pluck('metas.meta', 'metas.id'); //select con varias tablas

            } else {

                $metas = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                    ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                    //->Where('metas.estatus', '<>', 3)
                    ->Where('coordinaciones.id', '=', $id_coordinacion)
                    ->pluck('metas.meta', 'metas.id'); //select con varias tablas
            }
            return view('admin.actividades.create',  compact('metas'));
        }
        $actividadNueva = new Actividade();

        $actividadNueva->nombre_actividad = $request->nombre_actividad;
        $actividadNueva->id_meta = $request->id_meta;
        $actividadNueva->tipo = $request->tipo;
        //$actividadNueva->estatus = 0; en bd esta ya por defecto en 0 al ingresar primera vez
        $actividadNueva->id_usuario_reg = $id;
        if ($request->tipo == 1) {
            $actividadNueva->observacion_just_imprevisto_act = $request->observacion_just_imprevisto_act;
        } else {
            $actividadNueva->observacion_just_imprevisto_act = "";
        }
        //return $metaNueva;
        $actividadNueva->save();
        //dd($metaNueva);
        return redirect()->route('admin.actividades.index', $actividadNueva)->with('info', 'La Actividad se ha Asignado a la Meta!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Actividade $actividade)
    {
        //$id= $request->user()->id;

        //$metas = ['metas' => Meta::where('id_usuario_reg', '<>',0)->pluck('meta', 'id')];
        /*$metas = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
            ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
            ->select(['metas.id', 'metas.meta'])
            ->Where('metas.estatus', '<>', 2)
            ->Where('metas.id_coordinacion', '=', $id_coordinacion)
            ->get();*/
        $id = $request->user()->id;
        $id_coordinacion = $request->user()->id_coordinacion; //id_coordinación

        $coordinacione = Coordinacione::where('id', '=', $id_coordinacion)->first();
        $id_gerencia = $coordinacione['id_gerencia']; //id_gerencia

        $role = DB::table('model_has_roles')->where('model_id', $id)->first();
        $role_id = $role->role_id; //role_id
        //$gerencias = ['gerencias' => Gerencia::pluck('nombre', 'id')];
        $estatus = ['estatus' => Estatu::pluck('nombre_estatus', 'id')];

        if ($role_id == 1) {

            $metas = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                //->Where('metas.estatus', '<>', 3)
                ->pluck('metas.meta', 'metas.id'); //select con varias tablas


        } else if ($role_id == 2) {
            $metas = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                //->Where('metas.estatus', '<>', 3)
                ->Where('gerencias.id', '=', $id_gerencia)
                ->pluck('metas.meta', 'metas.id'); //select con varias tablas

        } else {

            $metas = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                //->Where('metas.estatus', '<>', 3)
                ->Where('coordinaciones.id', '=', $id_coordinacion)
                ->pluck('metas.meta', 'metas.id'); //select con varias tablas
        }



        return view('admin.actividades.edit', compact('metas', 'actividade', 'estatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actividade $actividade)
    {
        $request->validate([

            'nombre_actividad' => 'required',
            'id_meta' => 'required',
            'estatus' => 'required'

        ]);

        if (($request->estatus == 2) and ($request->fecha_estim_final == "")) {

            echo '<script type="text/javascript">', 'alert("Atención!! Debe seleccionar del calendario..La fecha estimada de culminación de esta actividad!!");', '</script>';

            $id = $request->user()->id;
            $id_coordinacion = $request->user()->id_coordinacion; //id_coordinación
    
            $coordinacione = Coordinacione::where('id', '=', $id_coordinacion)->first();
            $id_gerencia = $coordinacione['id_gerencia']; //id_gerencia
    
            $role = DB::table('model_has_roles')->where('model_id', $id)->first();
            $role_id = $role->role_id; //role_id
            //$gerencias = ['gerencias' => Gerencia::pluck('nombre', 'id')];
            $estatus = ['estatus' => Estatu::pluck('nombre_estatus', 'id')];
    
            if ($role_id == 1) {
    
                $metas = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                    ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                    //->Where('metas.estatus', '<>', 3)
                    ->pluck('metas.meta', 'metas.id'); //select con varias tablas
    
    
            } else if ($role_id == 2) {
                $metas = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                    ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                    //->Where('metas.estatus', '<>', 3)
                    ->Where('gerencias.id', '=', $id_gerencia)
                    ->pluck('metas.meta', 'metas.id'); //select con varias tablas
    
            } else {
    
                $metas = Meta::join('coordinaciones', 'coordinaciones.id', '=', 'metas.id_coordinacion')
                    ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                    //->Where('metas.estatus', '<>', 3)
                    ->Where('coordinaciones.id', '=', $id_coordinacion)
                    ->pluck('metas.meta', 'metas.id'); //select con varias tablas
            }
    
    
    
            return view('admin.actividades.edit', compact('metas', 'actividade', 'estatus'));
        }
       
        
        
        //$actividade->update($request->all());
        $actividade = Actividade::find($actividade->id);
        $actividade->nombre_actividad = $request->nombre_actividad;
        $actividade->id_meta = $request->id_meta;
        $actividade->estatus = $request->estatus;
        if($request->estatus == 2){
            $actividade->fecha_estim_final = $request->fecha_estim_final;
        }
        if($request->estatus == 3){ // guardar fecha culminación la cual es la fecha actual...
            $actividade->fecha_culminada_act = date('y-m-d');
            
        }
        $actividade->save();
        return redirect()->route('admin.actividades.index', $actividade)->with('info', 'La Actividad se ha Actualizado!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(Actividade $actividade)
    {
        $actividade->delete();
        return redirect()->route('admin.actividades.index')->with('info', 'La Actividad se ha Eliminado!!');
    }*/
}
