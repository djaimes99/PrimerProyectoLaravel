<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gerencia;

class GerenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.gerencias.index')->only('index');
        $this->middleware('can:admin.gerencias.create')->only('create', 'store');
        $this->middleware('can:admin.gerencias.edit')->only('edit', 'update');
        $this->middleware('can:admin.gerencias.destroy')->only('destroy');

    }
   
    public function index()
    {
        $gerencias = Gerencia::all();
        return view('admin.gerencias.index', compact('gerencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gerencias.create');
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
            'nombre' =>'required'
        ]);
        $gerencia = Gerencia::create($request->all());
        return redirect()->route('admin.gerencias.index', $gerencia)->with('info', 'La Gerencia se ha Creado!!');;

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gerencia $gerencia)
    {
        return view('admin.gerencias.show', compact('gerencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gerencia $gerencia)
    {
        return view('admin.gerencias.edit', compact('gerencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gerencia $gerencia)
    {
        $request->validate([
            'nombre' =>'required'
        ]);
        $gerencia->update($request->all());
        return redirect()->route('admin.gerencias.edit', $gerencia)->with('info', 'La Gerencia se ha Actualizado!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gerencia $gerencia)
    {
        $gerencia->delete();
        return redirect()->route('admin.gerencias.index')->with('info', 'La Gerencia se ha Eliminado!!');   
    }
}
