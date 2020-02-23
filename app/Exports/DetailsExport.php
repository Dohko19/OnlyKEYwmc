<?php

namespace App\Exports;

use App\Sucursal;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DetailsExport implements FromView, ShouldAutoSize
{
	use Exportable;

	private $date;

	public function view(): View
	{
		$from = Carbon::parse(request('from'))->format('Y-m-d');
		$to = Carbon::parse(request('to'))->endOfMonth();
		// $to = Carbon::parse($to)->format('Y-m-d');
		// ddd($to);
		$dates = Sucursal::with(['marcas', 'qresults'])
				->where('region', request('zr'))
				->where(function ($query) use ($from, $to){
					$query->whereBetween('created_at', [$from, $to]);
				})
                ->get();
		return view('exports.details', compact('dates'));
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
