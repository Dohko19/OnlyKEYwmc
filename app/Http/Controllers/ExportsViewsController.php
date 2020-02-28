<?php

namespace App\Http\Controllers;

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
    	return (new DetailsExport)->download('ReporteChecklist-'.Carbon::now()->format('d-m-Y').'.xls');
    }

    public function viewpdf(Request $request)
    {
        $from = Carbon::parse(request('desdep'))->format('Y-m-d');
        $to = Carbon::parse(request('hastap'))->endOfMonth();
        $zr = request('zrp');
        $dates = User::join('marcas as m', 'm.user_id', '=', 'users.id')
        ->join('sucursals as s', 's.marca_id', '=', 'm.id')
        ->join('qresults as q', 'q.sucursal_id', '=', 's.id')
        ->select('s.*', 'm.*', 'q.*')
        ->where('users.id', auth()->user()->id)
        ->where('s.region', request('zrp'))
        ->whereBetween('q.created_at', [$from, $to])
        ->get();
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
            return 'peticion ajax fails';
        }
    }
}
