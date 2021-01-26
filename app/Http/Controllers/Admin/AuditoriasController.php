<?php

namespace App\Http\Controllers\Admin;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\User;
use App\Sucursal;
use App\ResultadoAuditoria;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuditoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', new Auditoria);
        $auditorias = Auditoria::get();

      //   ddd($auditorias);
        return view('admin.auditorias.index', compact('auditorias'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Auditoria $auditoria
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function show(Request $request, Auditoria $auditoria)
    {
      $this->authorize('view', new Auditoria);
      $fecha = $request->get('FechaRegistro');
      $sucursal = $request->get('sucursal') ? $request->get('sucursal') : '';

      if (auth()->user()->hasRole('Admin') === true)
      {
          $sucursales = Sucursal::get(['name']);
      }
      else{
          $sucursales = User::with(['sucursals.rauditoria','sucursals' => function($query) use ($sucursal){
              $query->orderBy('name');
          }])->findOrFail(auth()->user()->id);
      }
        if ($sucursal){
            $sucursalId = Sucursal::get(['name']);
        }
        $countSegmento = Sucursal::with(['rauditoria' => function($query) use ($auditoria, $fecha){
            $query->where('IdSegmento', $auditoria->IdSegmentoAuditoria);
            $query->where('FechaRegistro', 'like', "%".$fecha."%");
        }])
            ->where('name', request('sucursal'))
            ->count();
        return view('admin.auditorias.show',
           compact('auditoria', 'fecha', 'sucursal', 'sucursales', 'countSegmento')
        );
    }
}
