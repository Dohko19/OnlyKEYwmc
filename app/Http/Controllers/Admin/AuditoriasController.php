<?php

namespace App\Http\Controllers\Admin;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuditoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', new Auditoria);
        $auditorias = User::join('marcas as m', 'm.user_id', '=', 'users.id')
        ->join('sucursals as s', 's.marca_id', '=', 'm.id')
        ->join('ResultadoAuditoria as r', 'r.IdCte', '=', 's.IdCte')
        ->join('Auditorias as a', 'a.IdAuditoria', '=', 'r.IdAuditoria')
        ->select('a.*', 'r.*')
        ->groupBy('a.IdAuditoria')
        ->where('users.id', '=', auth()->user()->id)
        ->get();
        return view('admin.auditorias.index', compact('auditorias'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Auditoria  $auditoria
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Auditoria $auditoria)
    {
        $this->authorize('view', new Auditoria);
        $fecha = $request->get('FechaRegistro');
        $auditorias = User::join('marcas as m', 'm.user_id', '=', 'users.id')
        ->join('sucursals as s', 's.marca_id', '=', 'm.id')
        ->join('ResultadoAuditoria as r', 'r.IdCte', '=', 's.IdCte')
        ->join('SegmentosAuditoria as sa', 'sa.IdAuditoria', '=', 'r.IdSegmento')
        ->join('aresults as ar', 'ar.IdSegmentoAuditoria', '=', 'sa.IdSegmentoAuditoria')
        ->select('sa.*', 'r.*', 's.*', 'ar.*')
        ->groupBy('sa.IdSegmentoAuditoria')
        ->where('r.FechaRegistro', 'LIKE', "%".$fecha."%")
        ->where('users.id', '=', auth()->user()->id)
        ->get();

        // ddd($auditorias);

       return view('admin.auditorias.show', compact('auditoria', 'auditorias'));
    }
}
