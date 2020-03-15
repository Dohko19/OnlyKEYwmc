<?php

namespace App\Http\Controllers;

use App\Exports\AuditoriaExport;
use App\Exports\DetailsExport;
use App\Sucursal;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;

class ExportsViewsController extends Controller
{
	use Exportable;

    public function index()
    {
    	$region = Sucursal::select('region')->groupBy('region')->get();
    	return view('exportsviews.index', compact('region'));
    }

     public function export()
    {
    	return (new DetailsExport)->download('ReporteChecklist-'.Carbon::now()->format('d-m-Y').'.xlsx');
    }

    public function viewpdf(Request $request)
    {
        $from = Carbon::parse(request('desdep'))->format('Y-m-d');
        $to = Carbon::parse(request('hastap'))->endOfMonth();
        $zr = request('zrp');
        if ($zr == 'allcelulas')
        {
            User::join('marcas as m', 'm.user_id', '=', 'users.id')
                    ->join('sucursals as s', 's.marca_id', '=', 'm.id')
                    ->join('qresults as q', 'q.sucursal_id', '=', 's.id')
                    ->select('s.*', 'm.*', 'q.*')
                    ->where('users.id', auth()->user()->id)
                    ->whereBetween('q.created_at', array($from, $to) )
                    ->get();
        }
        else
        {
                $dates = User::join('marcas as m', 'm.user_id', '=', 'users.id')
                    ->join('sucursals as s', 's.marca_id', '=', 'm.id')
                    ->join('qresults as q', 'q.sucursal_id', '=', 's.id')
                    ->select('s.*', 'm.*', 'q.*')
                    ->where('users.id', auth()->user()->id)
                    ->where('s.region', request('zrp'))
                    ->whereBetween('q.created_at', array($from, $to) )
                    ->get();
        }

         // $dates = Sucursal::with(['marcas', 'qresults', 'users' => function($query){
         //            $query->findOrFail(auth()->user()->id);
         //        }])
         //        ->where('region', $zr)
         //        ->where(function ($query) use ($from, $to){
         //            $query->whereBetween('created_at', [$from, $to]);
         //        })
         //        ->get();
        if(request()->ajax()){
            return response()->json($dates);
        }//procesa la peticion ajax
        else
        {
            return response()->json( ['error'=>'Fallo al realizar la peticion'], 404 );
        }
    }

    public function auditoria()
    {
        $sucursales = Sucursal::select('cedula')->groupBy('cedula')->get();
        return view('exportsviews.auditoria', compact('sucursales'));
    }

    public function exportauditoria()
    {
        return (new AuditoriaExport)->download('ReporteAuditoria-'.Carbon::now()->format('d-m-Y').'.xlsx');
    }

    public function exportauditoriapdf(Request $request)
    {
       $from = Carbon::parse(request('desdep'))->format('Y-m-d');
        $to = Carbon::parse(request('hastap'))->endOfMonth();
        $zr = request('zrp');
        if ($zr == 'allcelulas') {
            $dates = User::join('marcas as m', 'm.user_id', '=', 'users.id')
            ->join('sucursals as s', 's.marca_id', '=', 'm.id')
            ->join('aresults as a', 'a.sucursal_id', '=', 's.id')
            ->select('s.*', 'm.*', 'a.*')
            ->where('users.id', auth()->user()->id)
            ->whereBetween('a.created_at', array($from, $to) )
            ->groupBy('IdCte')
            ->get();
        }
        else{
            $dates = User::join('marcas as m', 'm.user_id', '=', 'users.id')
            ->join('sucursals as s', 's.marca_id', '=', 'm.id')
            ->join('aresults as a', 'a.sucursal_id', '=', 's.id')
            ->select('s.*', 'm.*', 'a.*')
            ->where('users.id', auth()->user()->id)
            ->where('s.cedula', request('zrp'))
            ->whereBetween('a.created_at', array($from, $to) )
            ->groupBy('IdCte')
            ->get();
            }
        // ddd($dates);
         // $dates = Sucursal::with(['marcas', 'qresults', 'users' => function($query){
         //            $query->findOrFail(auth()->user()->id);
         //        }])
         //        ->where('region', $zr)
         //        ->where(function ($query) use ($from, $to){
         //            $query->whereBetween('created_at', [$from, $to]);
         //        })
         //        ->get();
        if(request()->ajax()){
            return response()->json($dates);
        }//procesa la peticion ajax
        else
        {
            return response()->json( ['error'=>'Fallo al realizar la peticion'], 404 );
        }
    }

    public function allpdf(Request $request)
    {
        $year = request('year');
        $dates = User::join('marcas as m', 'm.user_id', '=', 'users.id')
        ->join('sucursals as s', 's.marca_id', '=', 'm.id')
        ->join('qresults as q', 'q.sucursal_id', '=', 's.id')
        ->select('s.*', 'q.*')
        ->where('users.id', auth()->user()->id)
        ->where('q.created_at', 'like', "%".$year."%")
        ->get();
        // var_dump(count($dates));
      if(request()->ajax()){
            return response()->json($dates);
        }//procesa la peticion ajax
    }

    public function allauditoriapdf(Request $request)
    {
        $year = request('year');
        $dates = User::join('marcas as m', 'm.user_id', '=', 'users.id')
        ->join('sucursals as s', 's.marca_id', '=', 'm.id')
        ->join('aresults as a', 'a.sucursal_id', '=', 's.id')
        ->where('users.id', auth()->user()->id)
        ->where('a.created_at', 'LIKE', "%".$year."%")
        ->groupBy('s.name')
        ->select('s.*', 'a.*')
        ->get();
            // ddd($dates);
      if(request()->ajax()){
            return response()->json($dates);
        }
        else{
            return 'ajax fail';
        }//procesa la peticion ajax
    }
}
