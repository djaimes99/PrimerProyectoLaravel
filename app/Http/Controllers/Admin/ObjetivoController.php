<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Objetivo;
use App\Models\Coordinacione;
use Illuminate\Support\Facades\DB;
//use App\Http\Controllers\Admin\MetaController;

class ObjetivoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.objetivos.index')->only('index');
        $this->middleware('can:admin.objetivos.create')->only('create', 'store');
        $this->middleware('can:admin.objetivos.edit')->only('edit', 'update');
        $this->middleware('can:admin.objetivos.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $id = $request->user()->id; //id usuario
        $id_coordinacion = $request->user()->id_coordinacion; //id_coordinación

        $coordinacione = Coordinacione::where('id', '=', $id_coordinacion)->first();
        $id_gerencia = $coordinacione['id_gerencia']; //id_gerencia

        $role = DB::table('model_has_roles')->where('model_id', $id)->first();
        $role_id = $role->role_id; //role_id

        if ($role_id == 1) {

            $objetivos = Objetivo::join('coordinaciones', 'coordinaciones.id', '=', 'objetivos.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->select(['objetivos.id', 'objetivos.objetivo', 'objetivos.avance_obj', 'objetivos.tipo', 'objetivos.estatus'])
                //->Where('objetivos.estatus', '<>', 3)
                ->get();
        } else if ($role_id == 2) {

            $objetivos = Objetivo::join('coordinaciones', 'coordinaciones.id', '=', 'objetivos.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->select(['objetivos.id', 'objetivos.objetivo', 'objetivos.avance_obj', 'objetivos.tipo', 'objetivos.estatus'])
                ->Where('gerencias.id', '=', $id_gerencia)
                //->Where('objetivos.estatus', '<>', 3)
                ->get();
        } else {

            $objetivos = Objetivo::join('coordinaciones', 'coordinaciones.id', '=', 'objetivos.id_coordinacion')
                ->join('gerencias', 'gerencias.id', '=', 'coordinaciones.id_gerencia')
                ->select(['objetivos.id', 'objetivos.objetivo', 'objetivos.avance_obj', 'objetivos.tipo', 'objetivos.estatus'])
                ->Where('coordinaciones.id', '=', $id_coordinacion)
                //->Where('objetivos.estatus', '<>', 3)
                ->get();
        }
        return view('admin.objetivos.index', compact('objetivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.objetivos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id_coordinacion = $request->user()->id_coordinacion; //id_coordinación

        $request->validate([
            'objetivo' => 'required',
            'tipo' => 'required'
        ]);

        if ( ($request->tipo == 1) and ($request->observacion_just_imprevisto_obj=="")) {
            echo '<script type="text/javascript">', 'alert("Atención!! en el campo (Justificación Objetivo Imprevisto), debe registrar el motivo del porqué se Agrega este Objetivo Imprevisto!!");', '</script>';

            
            return view('admin.objetivos.create');
        }


        $objetivoNuevo = new Objetivo();
        $objetivoNuevo->objetivo = $request->objetivo;
        $objetivoNuevo->tipo = $request->tipo;

        $objetivoNuevo->id_usuario_reg = $request->user()->id;
        $objetivoNuevo->id_coordinacion = $id_coordinacion;

        if ($request->tipo == 1) {
            $objetivoNuevo->observacion_just_imprevisto_obj = $request->observacion_just_imprevisto_obj;  
        }else {
            $objetivoNuevo->observacion_just_imprevisto_obj = "";
        }
       


        $objetivoNuevo->save();
        //$objetivoNuevo = Objetivo::create($request->all());
        return redirect()->route('admin.objetivos.index', $objetivoNuevo)->with('info', 'El Objetivo se ha Creado!!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Objetivo $objetivo)
    {
        //return view('admin.gerencias.show', compact('gerencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Objetivo $objetivo)
    {
        return view('admin.objetivos.edit', compact('objetivo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objetivo $objetivo)
    {
        $request->validate([
            'objetivo' => 'required'
        ]);
        $objetivo->update($request->all());
        return redirect()->route('admin.objetivos.index', $objetivo)->with('info', 'El Objetivo se ha Actualizado!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(Objetivo $objetivo)
    {
        /*$objetivo->delete();
        return redirect()->route('admin.objetivos.index')->with('info', 'El Objetivo se ha Eliminado!!');*/
       /* $objetivo = Objetivo::find($objetivo->id);

        if ($objetivo) {
            $objetivo->estatus = 3; //inactivo o eliminado logico
            $objetivo->save();
        }
        return redirect()->route('admin.objetivos.index')->with('info', 'La Meta se ha Eliminado!!');
    }*/
}
