<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gerencia;
use App\Models\Coordinacione;
use App\Models\Meta;
use App\Models\Desglose;
use Illuminate\Support\Facades\DB;

class DesgloseController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.desgloses.index')->only('index');
        $this->middleware('can:admin.desgloses.create')->only('create', 'store');
        $this->middleware('can:admin.desgloses.edit')->only('edit', 'update');
        //$this->middleware('can:admin.actividades.destroy')->only('destroy');
    }
    public function index()
    {
        $desgloses = Desglose::all();
        return view('admin.desgloses.index', compact('desgloses'));
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
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
