<?php

namespace App\Http\Controllers;

use App\Exports\DetailsExport;
use App\Sucursal;
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
}
