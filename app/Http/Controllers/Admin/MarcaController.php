<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Marca;
use App\Sucursal;
use App\InspeccionSanitaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marca::allowed()->get();
        return view('admin.marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.marcas.create');
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'photo' => ['image'],
        ]);

        $marca = Marca::create($request->except('photo'));
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = public_path() . '/marcas/';
            $fileName = uniqid() .'-'. $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
            if ($moved)
                {
                    $marca->photo = $fileName;
                    $marca->save();
                }
        }
        return redirect()->route('admin.marcas.index', compact('marca'))->with('info', 'Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        $sucursales = Sucursal::where('marca_id', '=', $marca->id)->orderBy('puntuacion_total', 'DESC')->get();
        // $sucursal = Marca::with('sucursales')->where('id', '=', $marca->id)->get();
        return view('admin.marcas.show', compact('marca', 'sucursales'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        return view('admin.marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'photo' => ['image'],
        ]);
        File::delete('marcas/'.$marca->photo);
        $marca->update($request->except('photo'));
        if ($request->hasFile('photo'))
        {
            $file = $request->file('photo');
            $path = public_path() . '/marcas/';
            $fileName = uniqid().'-'.$file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
            if ($moved)
            {
                $marca->photo = $fileName;
                $marca->save();
            }
        }

        return redirect()->route('admin.marcas.index', compact('ema'))->with('info', 'Datos Actualizados Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        File::delete('marcas/'.$marca->photo); //Borra la foto junto con el registro
        $marca->delete();
        return back()->with('info', 'Eliminado Correctamente');
    }
}
