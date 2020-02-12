<?php

namespace App\Http\Controllers\Admin;

use App\GrupoMarca;
use App\Http\Controllers\Controller;
use App\Sucursal;
use App\Marca;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursales = GrupoMarca::allowed()->get();
        return view('admin.sucursales.index', compact('sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursale = new Sucursal;
        $this->authorize('create', $sucursale);
        $marcas = Marca::all();

        // ddd($marcas);
        return view('admin.sucursales.create', compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'min:3|string',
            'ciudad' => 'min:1|string',
            'IdCte' => 'min:1'
        ]);
        $this->authorize('create', new Sucursal);
        $sucursal = Sucursal::create($request->all());
        return redirect()->route('admin.sucursales.index', compact('sucursal'))->with('info', 'Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function edit(Sucursal $sucursale)
    {
        $this->authorize('update', $sucursale);
        $marcas = Marca::allowed()->get();
        return view('admin.sucursales.edit', compact('sucursale', 'marcas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sucursal $sucursale)
    {
        $this->validate($request, [
            'name' => 'min:3|string',
            'ciudad' => 'min:1|string'
        ]);

        $sucursal = Sucursal::update($request->all());
        return redirect()->route('admin.sucursales.index')->with('info', 'Agregado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal $sucursale)
    {
        $sucursale->delete();
        return back()->with('info', 'Eliminado Correctamente');
    }
}
