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
        $fil = $request->get('FechaRegistro') ? $request->get('FechaRegistro') : Carbon::now()->format('Y-m');
        // $fil = Carbon::parse($fil)->format('Y-m');

      //   $segmento1 = ResultadoAuditoria::with(['questions'])
      //   ->where('IdSegmento', $segmento->IdSegmentoAuditoria)
      //   ->where('FechaRegistro', 'LIKE', "%".$fil."%")
      //   ->get();

      // $segmento1 = User::join('marcas as m', 'm.user_id', '=', 'users.id')
      //                   ->join('sucursals as s', 's.marca_id', '=', 'm.id')
      //                   ->join('ResultadoAuditoria as r', 'r.IdCte', '=', 's.IdCte')
      //                   ->join('PreguntasAuditoria as p', 'p.IdSegmento', '=', 'r.IdSegmento')
      //                   ->select('r.*', 'p.Pregunta')
      //                   ->where('users.id', '=', auth()->user()->id)
      //                   ->where('r.IdSegmento', '=', $segmento->IdSegmentoAuditoria)
      //                   ->where('r.FechaRegistro', 'LIKE', "%".request('FechaRegistro')."%")
      //                   ->where('s.name', 'LIKE', "%".request('sucursal')."%")
      //                   ->where('s.name', 'LIKE', "%".request('cedula')."%")
      //                   // ->findOrFail(auth()->user()->id);
      //                   ->get();
        $segmento1 = User::with(['sucursals' => function($query){
                    $query->join('aresults as ar', function($join){
                      $join->on('ar.sucursal_id', '=', 'sucursals.id')
                      ->where('sucursals.created_at','like', "%".request('FechaRegistro')."%");
                      // ->where('sucursals.name','like', "%".request('sucursal')."%");
                    });
        }])
        ->findOrFail(auth()->user()->id);

      // ddd($segmento1);
        return view('admin.segmentos.show', compact('segmento', 'segmento1'));
    }
}
