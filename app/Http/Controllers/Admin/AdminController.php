<?php

namespace App\Http\Controllers\Admin;

use App\Aresult;
use App\Auditoria;
use App\GrupoMarca;
use App\Http\Controllers\Controller;
use App\Marca;
use App\Marcaprom;
use App\PromSuc;
use App\Qresults;
use App\Question;
use App\Segmento;
use App\Sucursal;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function spa()
    {
        return view('pages.spa');
    }

    public function index()
    {
        if (auth()->user()->hasRole('dgral')) {

            $marcas = Marca::with(['grupos', 'average' => function($query){
                $query->where('created_at', 'like', "%".Carbon::now()->format('Y-m')."%");
            }])->where('user_id', auth()->user()->id)->get();

            $sj = Marca::where('user_id', auth()->user()->id )
            ->selectRaw('id')
            ->get()->toArray();
            for($i=0;$i<count($sj);$i++) {
                    $id = $sj[$i];
                }
                // dd();
                $marca = Marca::find($id['id']);
            if ($marca->grupos->tipo == 'auditorias') {
                $promedio = Aresult::join('sucursals as s', 's.id', '=', 'aresults.sucursal_id')
                ->join('marcas as m', 'm.id', '=', 's.marca_id')
                ->where('m.id', '=', $marca->id)
                ->where('aresults.created_at', 'LIKE', "%".Carbon::now()->format('Y-m')."%")
                ->selectRaw('AVG(aresults.Promedio) prom')
                ->get()->toArray();
                 //ddd($promedio);
                for($i=0;$i<count($promedio);$i++) {
                    $total = $promedio[$i];
                }
                // dd($total['prom']);
                if($total['prom'] != null)
                {
                    $prom = Marcaprom::updateOrCreate(
                        [
                            'marca_id' => $marca->id,
                            'created_at' => Marcaprom::where('created_at', 'like', '%'.Carbon::now()->format('Y-m').'%' )->first(),
                        ],
                        [
                            'promedio' => $total['prom'],
                            'marca_id' => $marca->id,
                        ]
                    );
                }
            }

            return view('admin.dashboard', compact('marcas','sj'));
        }

        if (auth()->user()->hasRole('dmarca')) {
            $sucursales = User::with(['sucursals.marcas.average' => function($query){
               $query->where('created_at', 'like', "%".Carbon::now()->format('Y-m')."%");
           }])->findOrFail(auth()->user()->id);

            $sj = Marca::where('user_id', auth()->user()->id )
            ->selectRaw('id')
            ->get();
            return view('admin.dashboard', compact('sucursales', 'sj'));

        }

        if ( auth()->user()->hasRole('gzona') || auth()->user()->hasRole('gsucursal') || auth()->user()->hasRole('dregional') || auth()->user()->hasRole('asesor')) {

            $sucursales = User::with(['sucursals.marcas.average' => function($query){
               $query->where('created_at', 'like', "%".Carbon::now()->format('Y-m')."%");
           }])->findOrFail(auth()->user()->id);

            $sj = Marca::where('user_id', auth()->user()->id )
            ->selectRaw('id')
            ->get();
            return view('admin.dashboard', compact('sucursales', 'sj'));
        }

        if(auth()->user()->hasRole('ddistrital'))
        {
            $sucursales = User::with(['sucursals.marcas.average' => function($query){
               $query->where('created_at', 'like', "%".Carbon::now()->format('Y-m')."%");
           }])->findOrFail(auth()->user()->id);

            $sj = Marca::where('user_id', auth()->user()->id )
            ->selectRaw('id')
            ->get();
            return view('admin.dashboard', compact('sucursales', 'sj'));
        }

        if(auth()->user()->hasRole('Admin'))
        {
            $users = User::selectRaw('count(*) users')->get();
            $gmarca = GrupoMarca::selectRaw('count(*) gmarca')->get();
            $marcas = Marca::selectRaw('count(*) marca')->get();
            $sucursales = Sucursal::selectRaw('count(*) sucursals')
            ->get();
            $data =  Marca::with(['grupos', 'average'])->get();
             return view('admin.dashboard', compact('users', 'gmarca', 'marcas', 'sucursales', 'data'));
        }
        abort(403);
    }

    public function region($id)
    {
        if (!auth()->user()->hasRole('Admin'))
        {
            $this->authorize('view', new Sucursal);
            $marca = Marca::findOrFail($id);

             $sucursales = User::with(['sucursals' => function($query){
                $query->selectRaw('marca_id m');
                $query->selectRaw('delegacion_municipio dm');
                $query->selectRaw('region r');
                $query->selectRaw('count(*) sucursals');
                $query->whereNotNull('region');
                $query->groupBy('region');
                $query->orderBy('region');
            }, 'grupos'])
                ->findOrFail(auth()->user()->id);
                return view('admin.pages.region', compact('sucursales', 'marca'));
        }
        else
        {
            $marca = Marca::findOrFail($id);
            $sucursales = Sucursal::
                 selectRaw('marca_id m')
                 ->selectRaw('delegacion_municipio dm')
                 ->selectRaw('region r')
                 ->selectRaw('count(*) sucursals')
                 ->whereNotNull('region')
                 ->groupBy('region')
                 ->orderBy('region')
                ->get();
            return view('admin.pages.region', compact('sucursales', 'marca'));
        }
        return redirect()->route('admin.index')->withInfo('Algo salio mal, contacta con soporte para mas información o posiblemente no tengas permitido ver esta parte');
    }

    public function cedula($id)
    {
        if (!auth()->user()->hasRole('Admin'))
        {
            $this->authorize('view', new Sucursal);
            $marca = Marca::findOrFail($id);

             $sucursales = User::with(['sucursals' => function($query){
                $query->selectRaw('marca_id m');
                $query->selectRaw('cedula c');
                $query->selectRaw('count(*) sucursals');
                $query->groupBy('cedula');
                $query->orderBy('cedula');
            }, 'grupos'])
                ->findOrFail(auth()->user()->id);

                return view('admin.pages.cedula', compact('sucursales', 'marca'));
        }
        else
        {
            $this->authorize('view', new Sucursal);
            $marca = Marca::findOrFail($id);
            $sucursales = Sucursal::
            selectRaw('marca_id m')
                ->selectRaw('cedula c')
                ->selectRaw('count(*) sucursals')
                ->whereNotNull('cedula')
                ->groupBy('cedula')
                ->orderBy('cedula')
                ->get();
            return view('admin.pages.cedula', compact('sucursales', 'marca'));
        }
        return redirect()->route('admin.index')->withInfo('Algo salio mal, contacta con soporte para mas información o posiblemente no tengas permitido ver esta parte');
    }

    // public function promedio()
    // {
    //     $marca = Marca::findOrFail( request('id') );
    //     if ($marca->grupos->tipo == 'auditorias') {
    //         $promedio = Aresult::join('sucursals as s', 's.id', '=', 'aresults.sucursal_id')
    //         ->join('marcas as m', 'm.id', '=', 's.marca_id')
    //         ->where('m.id', '=', $marca->id)
    //         ->selectRaw('AVG(aresults.Promedio) prom')
    //         ->get()->toArray();

    //         for($i=0;$i<count($promedio);$i++) {
    //             $total = $promedio[$i];
    //         }
    //         $prom = Marcaprom::updateOrCreate(
    //             [
    //                 'marca_id' => $marca->id,
    //                 'created_at' => Carbon::now()->format('m'),
    //             ],
    //             [
    //                 $prom->promedio = $total['prom'],
    //                 $prom->marca_id => $marca->id,
    //             ]
    //         );
    //         // $prom->puntuacion_general = $total['prom'];
    //         // $prom->save();
    //         // $success = true;
    //     }
    //     else
    //     {
    //         $success = true;
    //         $promedio = "Ningun dato a calcular";
    //     }

    //     if(request()->ajax()){
    //         return response()->json([
    //             'promedio' => $promedio,
    //             'success' => $success
    //         ]);
    //     }
    //     else
    //     {
    //         return 'ajax fail';
    //     }//procesa la peticion ajax

    // }
}
