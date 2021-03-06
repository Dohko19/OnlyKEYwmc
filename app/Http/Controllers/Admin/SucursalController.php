<?php

namespace App\Http\Controllers\Admin;

use App\GrupoMarca;
use App\Http\Controllers\Controller;
use App\Marca;
use App\Sucursal;
use App\User;
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
        if(auth()->user()->hasRole('Admin'))
        {
            $sucursales = Sucursal::get();
            return view('admin.sucursales.index', compact('sucursales'));
        }
        $sucursales = User::with('sucursals')->findOrFail(auth()->user()->id);
        return view('admin.pages.dashboardsucursales', compact('sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', $sucursale = new Sucursal);

        // ddd($marcas);
        return view('admin.sucursales.create',[
            'marcas' => Marca::all(),
            'users' => User::all(),
            'sucursale' => $sucursale,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'min:3|string',
            'IdCte' => 'min:1|numeric',
        ]);
        $this->authorize('create', new Sucursal);
        $sucursal = Sucursal::create($request->except('users'));
            $sucursal->users()->attach($request->get('users'));
        return redirect()->route('admin.sucursales.index')->with('info', 'Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal $sucursale)
    {
        $this->authorize('view', $sucursale);
        return view('admin.sucursales.show', compact('sucursale'));
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
        $users = User::all();
        return view('admin.sucursales.edit', compact('sucursale', 'marcas', 'users'));
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
        $this->authorize('update', $sucursale);
        $this->validate($request, [
            'name' => 'min:3|string',
            'IdCte' => 'min:1|numeric',
            'marca_id' => 'required',
        ]);

        $sucursale->update($request->except('users'));
        $sucursale->users()->sync($request->get('users'));
        return redirect()->route('admin.sucursales.index')->with('info', 'Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal $sucursale)
    {
        $this->authorize('delete', $sucursale);
        $sucursale->delete();
        $sucursal->users()->sync([]);
        return back()->with('info', 'Eliminado Correctamente');
    }
}
