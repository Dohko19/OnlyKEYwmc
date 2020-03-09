<?php

namespace App\Http\Controllers\Admin;

use App\GrupoMarca;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;

class GruposMarcasController extends Controller
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
            $grupomarcas = GrupoMarca::get();
            if (request()->wantsJson())
            {
                  return $grupomarcas;
            }
                return view('admin.grupomarcas.index', compact('grupomarcas'));
        }
        $grupomarcas = GrupoMarca::where('user_id', auth()->user()->id)->get();
        if (request()->wantsJson())
        {
              return $grupomarcas;
        }
        // $this->authorize('view', new GrupoMarca);
        return view('admin.grupomarcas.index', compact('grupomarcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->authorize('create', $grupoMarca = new GrupoMarca);
        return view('admin.grupomarcas.create', [
            'users' => User::all(),
            'grupoMarca' => $grupoMarca
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
        $this->authorize('create', new GrupoMarca);
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
        $this->authorize('view', $grupoMarca);
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
        $this->authorize('update', $gruposMarca);
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
    public function update(Request $request, $id)
    {
        $grupoMarca = GrupoMarca::findOrFail($id);
        $this->authorize('update', $grupoMarca);
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
    public function destroy($id)
    {
        $grupoMarca = GrupoMarca::findOrFail($id);
        $this->authorize('update', $grupoMarca);
        $grupoMarca->delete();
        return back()->with('info', 'Grupo borrado');
    }
}
