<?php

namespace App\Http\Controllers\Admin;

use App\Auditoria;
use App\Http\Controllers\Controller;
use App\User;
use App\Sucursal;
use App\ResultadoAuditoria;
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
        $auditorias = Auditoria::get();

      //   ddd($auditorias);
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
      $sucursal = $request->get('sucursal') ? $request->get('sucursal') : '';

      $sucursales = User::with(['sucursals' => function($query) use ($sucursal){
                    $query->where('name', 'LIKE', "%".$sucursal."%");
                    $query->orderBy('name');
              }])
                ->findOrFail(auth()->user()->id);
                // ddd($sucursales);
       return view('admin.auditorias.show', compact('auditoria', 'fecha', 'sucursal', 'sucursales'));
    }
}
