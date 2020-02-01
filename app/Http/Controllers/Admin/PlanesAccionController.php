<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PlanesAccion;
use Illuminate\Http\Request;

class PlanesAccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.planesAccion.index');
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
     * @param  \App\PlanesAccion  $planesAccion
     * @return \Illuminate\Http\Response
     */
    public function show(PlanesAccion $planesAccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PlanesAccion  $planesAccion
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanesAccion $planesAccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PlanesAccion  $planesAccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlanesAccion $planesAccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PlanesAccion  $planesAccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlanesAccion $planesAccion)
    {
        //
    }
}
