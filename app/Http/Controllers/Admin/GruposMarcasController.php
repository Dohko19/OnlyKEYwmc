<?php

namespace App\Http\Controllers\Admin;

use App\GrupoMarca;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class GruposMarcasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.grupomarcas.index', [
            'grupomarcas' => GrupoMarca::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.grupomarcas.create', [
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'user_id' => 'required',
            'description' => 'string',
            'tipo' => 'string',
        ]);

        $grupomarcas = GrupoMarca::create($data);

        return redirect()->back()->with('info', 'Grupo Creado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GrupoMarca  $grupoMarca
     * @return \Illuminate\Http\Response
     */
    public function show(GrupoMarca $grupoMarca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GrupoMarca  $grupoMarca
     * @return \Illuminate\Http\Response
     */
    public function edit(GrupoMarca $grupoMarca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GrupoMarca  $grupoMarca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GrupoMarca $grupoMarca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GrupoMarca  $grupoMarca
     * @return \Illuminate\Http\Response
     */
    public function destroy(GrupoMarca $grupoMarca)
    {
        $grupoMarca->delete();
        return back()->with('info', 'Grupo borrado');
    }
}
