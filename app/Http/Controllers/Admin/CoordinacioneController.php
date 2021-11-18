<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coordinacione;
use App\Models\Gerencia;

class CoordinacioneController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.coordinaciones.index')->only('index');
        $this->middleware('can:admin.coordinaciones.create')->only('create', 'store');
        $this->middleware('can:admin.coordinaciones.edit')->only('edit', 'update');
        $this->middleware('can:admin.coordinaciones.destroy')->only('destroy');

    }

    public function index()
    {
        //$coordinaciones = Coordinacione::with('gerencia')->all();
        $coordinaciones = Coordinacione::all();
        return view('admin.coordinaciones.index', compact('coordinaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $gerencia = ['gerencias' => Gerencia::pluck('nombre', 'id')];
        return view('admin.coordinaciones.create',  $gerencia);
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
            'nombre_coord' =>'required',
            'id_gerencia' =>'required'
        ]);
        $coordinacione = Coordinacione::create($request->all());
        return redirect()->route('admin.coordinaciones.index', $coordinacione)->with('info', 'La Coordinación se ha Creado!!');;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Coordinacione $coordinacione)
    {
        return view('admin.coordinaciones.show', compact('coordinacione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Coordinacione $coordinacione)
    {
        return view('admin.coordinaciones.edit', compact('coordinacione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coordinacione $coordinacione)
    {
        $request->validate([
            //'nombre' =>'required'
        ]);
        $coordinacione->update($request->all());
        return redirect()->route('admin.coordinaciones.index', $coordinacione)->with('info', 'La Coordinación se ha Actualizado!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coordinacione $coordinacione)
    {
        $coordinacione->delete();
        return redirect()->route('admin.coordinaciones.index')->with('info', 'La Coordinacion se ha Eliminado!!'); 
    }
}
