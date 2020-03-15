<?php

namespace App\Exports;

use App\Sucursal;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class DetailsExport implements FromView, ShouldAutoSize, WithDrawings
{
	use Exportable;

	private $date;

	public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Dominos Logo');
        $drawing->setPath( public_path('/marcas/dominos_pizza_logo.png') );
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

	public function view(): View
	{
		$from = Carbon::parse(request('from'))->format('Y-m-d');
		$to = Carbon::parse(request('to'))->endOfMonth();
		$to = Carbon::parse($to)->format('Y-m-d');
		if (request('zr') == 'allcelulas')
		{
			$dates = Sucursal::with(['marcas', 'qresults' => function ($query) use ($from, $to){
		 			$query->whereBetween('created_at', array($from, $to) );
		 		}, 'users' => function($query){
					$query->findOrFail(auth()->user()->id);
				}])
                ->get();
		}
		else{
		 $dates = Sucursal::with(['marcas', 'qresults' => function ($query) use ($from, $to){
		 			$query->whereBetween('created_at', array($from, $to) );
		 		}, 'users' => function($query){
					$query->findOrFail(auth()->user()->id);
				}])
				->where('region', request('zr'))
                ->get();
		}

		return view('exports.details', compact('dates'))->withSuccess('Archivo Listo');
	}

	public function forDate($date)
	{
		$this->date = $date;

		return $this;
	}

    /**
    * @return \Illuminate\Database\Query\Builder
    */
    // public function query()
    // {
    //     return User::query()->whereDate('created_at', $this->date);
    // }
}
