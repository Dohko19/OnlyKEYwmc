<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PlanesAccion;
use App\Segmento;
use Illuminate\Http\Request;

class SegmentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.segmentos.index',[
            'segmentos' => Segmento::allowed()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Segmento  $segmento
     * @return \Illuminate\Http\Response
     */
    public function show(Segmento $segmento)
    {
        // $segmento = Segmento::with('questions')->get();
        return view('admin.segmentos.show', compact('segmento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Segmento  $segmento
     * @return \Illuminate\Http\Response
     */
    public function edit(Segmento $segmento)
    {
        return view('admin.segmentos.edit', compact('segmento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Segmento  $segmento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Segmento $segmento)
    {
        //
    }

    public function approved(Request $request, Segmento $segmento)
    {
        // return $request;
        $segmento->update($request->only('approved'));
        if($request->approved = 1)
        {
            $segmento->puntuacion = "100";
            $segmento->save();
        }
        else
        {
            $segmento->puntuacion = "70";
            $segmento->save();
        }
        return redirect()->route('admin.segmentos.index')->withInfo('Aprovado, se mostrara mas en el panel de inicio');
    }
}
