<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Marca;
use App\PlanesAccion;
use App\ResultadoAuditoria;
use App\Segmento;
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
        $fil = Carbon::parse($fil)->format('Y-m');
        $segmento1 = User::join('marcas as m', 'm.user_id', '=', 'users.id')
        ->join('sucursals as s', 's.marca_id', '=', 'm.id')
        ->join('ResultadoAuditoria as r', 'r.IdCte', '=', 's.IdCte')
        ->join('PreguntasAuditoria as p', 'p.IdPreguntaSegmentoAuditoria', '=', 'r.IdPregunta')
        ->select('p.*', 'r.*')
        ->where('users.id', '=', auth()->user()->id)
        ->where('p.IdSegmento', '=', $segmento->IdSegmentoAuditoria)
        ->where('FechaRegistro', 'LIKE', "%".$fil."%")
        ->get();

        // $segmento1 = Segmento::get();
            // ddd($segmento1);
        return view('admin.segmentos.show', compact('segmento', 'segmento1'));
    }
}
