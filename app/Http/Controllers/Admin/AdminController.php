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
            if (request()->wantsJson())
            {
                return $marcas;
            }
            return view('admin.dashboard', compact('marcas'));
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
            if (request()->wantsJson())
            {
                return $sucursales;
            }
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
            if (request()->wantsJson())
            {
                return ['sucursales' => $sucursales,
                        'marca' => $data
                    ];
            }
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
            if ($marca->grupo_marca_id == 3)
            {
                $sucursales = User::with(['sucursals' => function($query) use ($marca) {
                        $query->where('marca_id', $marca->id);
                        $query->selectRaw('marca_id m');
                        $query->selectRaw('zona z');
                        $query->selectRaw('region r');
                        $query->selectRaw('count(*) region');
                        $query->groupBy('zona');
                        $query->orderBy('zona');
                }, 'grupos'])->findOrFail(auth()->user()->id);

                // ddd($sucursales);
                return view('admin.pages.regionVips', compact('sucursales', 'marca'));
            } else {

                $sucursales = User::with(['sucursals' => function($query) use ($marca){
                    $query->where('marca_id', $marca->id);
                    $query->selectRaw('marca_id m');
                    $query->selectRaw('delegacion_municipio dm');
                    $query->selectRaw('region r');
                    $query->whereNotNull('region');
                    $query->selectRaw('count(*) sucursals');
                    $query->groupBy('region');
                    $query->orderBy('region');
                }, 'grupos'])
                    ->findOrFail(auth()->user()->id);
                return view('admin.pages.region', compact('sucursales', 'marca'));
            }
        } else {
            $marca = Marca::findOrFail($id);
            if ($marca->grupo_marca_id == 3)
            {
                $sucursales = Sucursal::
                selectRaw('marca_id m')
                    ->selectRaw('zona z')
                    ->selectRaw('region r')
                    ->selectRaw('count(*) sucursals')
                    ->where('marca_id', $marca->id)
                    ->groupBy('region')
                    ->orderBy('region')
                    ->get();
                return view('admin.pages.regionVips', compact('sucursales', 'marca'));
            }
            $sucursales = Sucursal::
                 selectRaw('marca_id m')
                 ->selectRaw('delegacion_municipio dm')
                 ->selectRaw('region r')
                 ->selectRaw('count(*) sucursals')
                 ->where('marca_id', $marca->id)
                 ->groupBy('region')
                 ->orderBy('region')
                ->get();
            $mil = Sucursal::where('IdCte', '=', 10000)->get();

            return view('admin.pages.region', compact('sucursales', 'marca', 'mil'));
        }
        return redirect()->route('admin.index')->withInfo('Algo salio mal, contacta con soporte para mas información o posiblemente no tengas permitido ver esta parte');
    }

    public function cedula($id)
    {
        if (!auth()->user()->hasRole('Admin'))
        {
            $this->authorize('view', new Sucursal);
            $marca = Marca::findOrFail($id);

             $sucursales = User::with(['sucursals' => function($query) use ($marca){
                $query->where('marca_id', $marca->id);
                $query->selectRaw('marca_id m');
                $query->selectRaw('cedula c');
                $query->whereNotNull('cedula');
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
            $sucursales = Sucursal::selectRaw('marca_id m')
                ->selectRaw('cedula c')
                ->selectRaw('count(*) sucursals')
                ->whereNotNull('cedula')
                ->where('marca_id', $marca->id)
                ->groupBy('cedula')
                ->orderBy('cedula')
                ->get();
            return view('admin.pages.cedula', compact('sucursales', 'marca'));
        }
        return redirect()->route('admin.index')->withInfo('Algo salio mal, contacta con soporte para mas información o posiblemente no tengas permitido ver esta parte');
    }

    public function charts(Request $request)
    {
        if (request()->wantsJson())
        {
            $mes = Carbon::parse($request->mes)->format('m');
            $anio = Carbon::parse($request->anio)->format('Y');
            $zona = $request->zona;
            $region = $request->region;
            if ($mes == '' || $anio == '')
            {
                $mes = Carbon::now()->format('m');
                $anio = Carbon::now()->format('Y');
                $zona = 'ZNF';
                $region = 'CENTRO';
//                $sucursales = Sucursal::with(['quest'])
//                    ->join('questionnaires as q', function ($join) use ($mes, $anio){
//                        $join->on('q.sucursal_id', '=', 'sucursals.id')
//                            ->whereMonth('q.created_at', $mes)
//                            ->whereYear('q.created_at', $anio)
//                            ->where('Value', 0);
//                    })
//                    ->where('sucursals.marca_id', 5)
//                    ->where('sucursals.zona', 'LIKE', "%" . $zona . "%")
//                    ->select('sucursals.zona', 'sucursals.region', 'sucursals.name', 'q.value', 'q.riesgo')
//                    ->get();

                $questionsbad = Sucursal::with(['quest'])
                    ->join('questionnaires as q', function ($join) use ($mes, $anio){
                        $join->on('q.sucursal_id', '=', 'sucursals.id')
                            ->whereMonth('q.created_at', $mes)
                            ->whereYear('q.created_at', $anio)
                            ->where('Value', 0);
                    })
                    ->join('PreguntasCuestionario as pc', function($join){
                        $join->on('q.IdPregunta', '=', 'pc.IdPregunta')
                            ->where('pc.IdCuestionario', '=', 2)
                            ->orderBy('pc.Orden');
                    })
                    ->where('sucursals.marca_id', 5)
                    ->where('sucursals.zona', 'LIKE', "%" . $zona . "%")
                    ->where('sucursals.region', 'LIKE', "%" . $region . "%")
                    ->selectRaw('pc.Orden orden')
                    ->selectRaw('count(pc.Pregunta) fails')
                    ->selectRaw('pc.Pregunta pregunta')
                    ->groupBy('pc.Pregunta')
                    ->get();
            }
            else
            {

//                $sucursales = Sucursal::with(['quest'])
//                    ->join('questionnaires as q', function ($join) use ($mes, $anio){
//                        $join->on('q.sucursal_id', '=', 'sucursals.id')
//                            ->whereMonth('q.created_at', $mes)
//                            ->whereYear('q.created_at', $anio)
//                            ->where('Value', 0);
//                    })
//                    ->where('sucursals.marca_id', 5)
//                    ->where('sucursals.zona', 'LIKE', "%" . $zona . "%")
//                    ->select('sucursals.zona', 'sucursals.region', 'sucursals.name', 'q.value', 'q.riesgo')
//                    ->get();

                $questionsbad = Sucursal::with(['quest'])
                    ->join('questionnaires as q', function ($join) use ($mes, $anio){
                        $join->on('q.sucursal_id', '=', 'sucursals.id')
                            ->whereMonth('q.created_at', $mes)
                            ->whereYear('q.created_at', $anio)
                            ->where('Value', 0);
                    })
                    ->join('PreguntasCuestionario as pc', function($join){
                        $join->on('q.IdPregunta', '=', 'pc.IdPregunta')
                            ->where('pc.IdCuestionario', '=', 2);
                    })
                    ->where('sucursals.marca_id', 5)
                    ->where('sucursals.zona', 'LIKE', "%" . $zona . "%")
                    ->where('sucursals.region', 'LIKE', "%" . $region . "%")
                    ->selectRaw('pc.Orden orden')
                    ->selectRaw('count(pc.Pregunta) fails')
                    ->selectRaw('pc.Pregunta pregunta')
                    ->selectRaw('sucursals.name sucursal')
                    ->orderBy('orden', 'ASC')
                    ->groupBy('pregunta')
                    ->get();
            }
            return ['questionbad' => $questionsbad];
        }
    }

    public function zonaslist(Request $request)
    {
        if (request()->wantsJson())
        {


            $zonas = Sucursal::select('zona')
                ->whereNotNull('zona')
                ->groupBy('zona')
                ->orderBy('zona', 'ASC')
                ->get();

            return $zonas;
        }
    }

    public function regionList()
    {
        if (request()->wantsJson())
        {
            $regiones = Sucursal::select('id','region')
                ->where('marca_id', 5)
                ->groupBy('region')
                ->get();
            return $regiones;
        }
    }
}
