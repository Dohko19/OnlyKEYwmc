<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ResultadoAuditoria;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResultadoAuditoriaController extends Controller
{
    public function update(Request $request, $id)
    {
    	$this->authorize('update', $id);
    	$resultado = ResultadoAuditoria::find($id);
    	$resultado->Aprobado = $request->get('Aprobado');
    	$resultado->FechaActualizacion = Carbon::now();
    	$resultado->save();
    	return redirect()->back()->withSuccess('Realizado');
    }
}
