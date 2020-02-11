<?php

namespace App\Http\Controllers\Admin;

use App\GrupoMarca;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
       $this->validate($request, [
            'name' => 'required',
            'user_id' => 'required',
            'description' => 'string',
            'tipo' => 'string',
            'logo' => 'image',
        ]);

        $grupomarcas = GrupoMarca::create($request->except('logo'));
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = public_path() . '/grupomarcas/';
            $fileName = uniqid() .'-'. $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
            if ($moved)
                {
                    $grupomarcas->logo = $fileName;
                    $grupomarcas->save();
                }
        }
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
    public function edit($id)
    {
        $gruposMarca = GrupoMarca::findOrFail($id);
        $users = User::all();
        return view('admin.grupomarcas.edit', compact('gruposMarca', 'users'));
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
         $this->validate($request, [
            'name' => 'required',
            'user_id' => 'required',
            'description' => 'string',
            'tipo' => 'string',
            'logo' => 'image',
        ]);
         File::delete('grupomarcas/'.$grupoMarca->photo);
        $grupoMarca->update($request->except('logo'));
        if ($request->hasFile('logo'))
        {
            $file = $request->file('logo');
            $path = public_path() . '/grupomarcas/';
            $fileName = uniqid().'-'.$file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
            if ($moved)
            {
                $grupoMarca->logo = $fileName;
                $grupoMarca->save();
            }
        }

        return redirect()->route('admin.gruposm.index')->with('info', 'Datos Actualizados Correctamente');
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