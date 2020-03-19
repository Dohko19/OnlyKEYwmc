<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Marca;
use App\PlanesAccion;
use App\ResultadoAuditoria;
use App\Segmento;
use App\Sucursal;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SegmentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     if(auth()->user()->hasRole('Admin'))
    //     {
    //                 return view('admin.segmentos.index',[
    //                     'segmentos' => Segmento::all(),
    //                 ]);

    //     }

    //         return redirect()->route('admin.index')->withInfo('Debes pertencer a un grupo de marca o una marca para poder ver esta seccion');
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Segmento  $segmento
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Segmento $segmento)
    {
        $this->authorize('view', $segmento);
        $fil = $request->get('FechaRegistro') ? $request->get('FechaRegistro') : request('FechaRegistro');

      $segmento1 = Sucursal::with(['rauditoria' => function($query) use ($segmento, $fil){
        $query->where('IdSegmento', $segmento->IdSegmentoAuditoria);
        $query->where('FechaRegistro', 'like', "%".$fil."%");
      }])
      ->where('name', request('sucursal'))
      ->get();

        return view('admin.segmentos.show', compact('segmento', 'segmento1'));
    }
}
