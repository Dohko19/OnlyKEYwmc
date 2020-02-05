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
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Segmento  $segmento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Segmento $segmento)
    {
        //
    }
}
