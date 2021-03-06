<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Aresult;
use App\Dm;
use App\GrupoMarca;
use App\Http\Controllers\Controller;
use App\Marca;
use App\PreguntasCuestionario;
use App\PromSuc;
use App\Qresults;
use App\Questionnaire;
use App\ResultadoAuditoria;
use App\Segmento;
use App\Sucursal;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', new Marca);
        // $marca = Marca::with('grupos')->get();
        if (auth()->user()->hasRole('Admin'))
        {
                $marcas = Marca::all();
                return view('admin.marcas.index', compact('marcas'));
        }
        $marcas = Marca::where('user_id', auth()->user()->id)->get();
        return view('admin.marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('view', new Marca);
        return view('admin.marcas.create',
            [
            'grupos' => GrupoMarca::all(),
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('view', new Marca);
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255',],
            'photo' => ['image'],
        ]);

        $marca = Marca::create($request->except('photo'));
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = public_path() . '/marcas/';
            $fileName = uniqid() .'-'. $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
            if ($moved)
                {
                    $marca->photo = $fileName;
                    $marca->save();
                }
        }
         // alert()->success('Completado','Registro Agregado Correctamente');
        return redirect()->route('admin.marcas.index', compact('marca'))->with('success', 'Registro Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Marca $marca)
    {
        $this->authorize('view', $marca);

        if(auth()->user()->hasRole('Admin'))
        {
            $graphics = $request->get('graphics') ? $request->get('graphics') : Carbon::now()->format('Y-m');
            $dm = $request->get('delegacion_municipio') ? $request->get('delegacion_municipio') : request('dm') ;

            $zona = request('zone') ? request('zone') : $request->get('zone');

            $preguntasri = PreguntasCuestionario::select('IdPregunta','Pregunta', 'Orden')
                                                    ->where('NivelRiesgo', 'RI')
                                                    ->orderBy('Orden')
                                                    ->get();
            $preguntasc = PreguntasCuestionario::select('IdPregunta','Pregunta', 'Orden')
                                                    ->where('NivelRiesgo', 'C')
                                                    ->orderBy('Orden')
                                                    ->get();
            $preguntasEC = PreguntasCuestionario::select('IdPregunta','Pregunta', 'Orden')
                                                    ->where('NivelRiesgo', 'EC')
                                                    ->orderBy('Orden')
                                                    ->get();
            $preguntasE = PreguntasCuestionario::select('IdPregunta','Pregunta', 'Orden')
                                                    ->where('NivelRiesgo', 'E')
                                                    ->orderBy('Orden')
                                                    ->get();
            $delegacion = request('zonaf');

            $delegaciones = Sucursal::select('delegacion_municipio')
                                      ->where('region', request('zone'))
                                      ->whereNotNull('region')
                                      ->groupBy('delegacion_municipio')
                                      ->get();

            $sucursales = Sucursal::with(['quest' => function($query) use ($marca, $dm, $zona, $graphics){
                $query->where('created_at', 'LIKE', "%". $graphics ."%");
            }])
                ->leftJoin('qresults as qr', function($join) use ($marca,$dm, $zona, $graphics){
                    $join->on('qr.sucursal_id', '=', 'sucursals.id')
                        ->where('qr.created_at', 'like', "%".$graphics."%");
                })
                ->where('marca_id', $marca->id)
                ->where('delegacion_municipio', 'LIKE', "%".$dm."%")
                ->where('region', 'LIKE', "%".$zona."%")
                ->select('qr.*', 'sucursals.*')
                ->get();



            return view('admin.marcas.show',
                compact('marca', 'sucursales', 'preguntasE', 'preguntasEC', 'preguntasc', 'preguntasri', 'delegaciones', 'zona', 'delegacion'));
        }

        $graphics = $request->get('graphics') ? $request->get('graphics') : Carbon::now()->format('Y-m');
        $dm = $request->get('delegacion_municipio') ? $request->get('delegacion_municipio') : request('dm') ;

        $zona = request('zone') ? request('zone') : $request->get('zone');

          $sucursales = User::with(['sucursals.quest' => function($query) use ($graphics){
                  $query->where('created_at', 'LIKE', "%".$graphics."%");
          }, 'sucursals' => function($query) use ($marca,$dm, $zona, $graphics){
                  $query->leftJoin('qresults as qr', function($join) use ($graphics){
                  $join->on('qr.sucursal_id', '=', 'sucursals.id')
                  ->where('qr.created_at', 'like', "%".$graphics."%");
                });
                  $query->where('marca_id', $marca->id);
                  $query->where('delegacion_municipio', 'LIKE', "%".$dm."%");
                  $query->where('region', 'LIKE', "%".$zona."%");
                  $query->select('qr.*', 'sucursals.*');
            }])
            ->findOrFail(auth()->user()->id);

            $preguntasri = PreguntasCuestionario::select('IdPregunta','Pregunta', 'Orden')
                ->where('NivelRiesgo', 'RI')
                ->orderBy('Orden')
                ->get();
            $preguntasc = PreguntasCuestionario::select('IdPregunta','Pregunta', 'Orden')
                ->where('NivelRiesgo', 'C')
                ->orderBy('Orden')
                ->get();
            $preguntasEC = PreguntasCuestionario::select('IdPregunta','Pregunta', 'Orden')
                ->where('NivelRiesgo', 'EC')
                ->orderBy('Orden')
                ->get();
            $preguntasE = PreguntasCuestionario::select('IdPregunta','Pregunta', 'Orden')
                ->where('NivelRiesgo', 'E')
                ->orderBy('Orden')
                ->get();

            $delegacion = request('zonaf');

            $delegaciones = User::with(['sucursals' => function($query){
                    $query->where('region', '=', request('zone') );
                    $query->groupBy('delegacion_municipio');
              }])
                ->findOrFail(auth()->user()->id);
            return view('admin.marcas.showquestionnary',
                compact('marca', 'sucursales', 'preguntasE', 'preguntasEC', 'preguntasc', 'preguntasri', 'delegaciones', 'zona', 'delegacion') );
        //     // return view('admin.marcas.showquestionnary', compact('marca','sucursales','questions'));
    }

    public function showcedula(Request $request, Marca $marca)
    {
            $graphics = $request->get('graphics') ?? Carbon::now()->format('Y-m');
            $cedula = $request->get('cedula') ? $request->get('cedula') : request('cedula');

            if (auth()->user()->hasRole('Admin'))
            {

                   $avg = Sucursal::with(['audres' => function($query) use ($marca, $cedula, $graphics){
                       $query->where('created_at', 'LIKE', "%". $graphics ."%");
                   }])
                   ->leftJoin('prom_sucs as ps', function($join) use ($graphics){
                       $join->on('ps.sucursal_id', '=', 'sucursals.id')
                           ->where('ps.fecharegistro', 'like', "%".$graphics."%");
                   })
                   ->where('marca_id', $marca->id)
                   ->where('cedula', 'like', "%".$cedula."%")
                   ->select('ps.*', 'sucursals.*')
                   ->get();

                return view('admin.marcas.showadmincedula', compact('marca', 'cedula', 'graphics', 'avg' ));
            }

            $avg = User::with(['sucursals.audres' => function($query) use ($marca, $cedula, $graphics){
                $query->where('created_at', 'LIKE', "%".$graphics."%");
            }, 'sucursals' => function($query) use ($marca, $cedula, $graphics){
                $query->leftJoin('prom_sucs as ps', function($join) use ($graphics){
                  $join->on('ps.sucursal_id', '=', 'sucursals.id')
                  ->where('ps.fecharegistro', 'like', "%".$graphics."%");
                });
                $query->where('marca_id', $marca->id);
                $query->where('cedula', 'LIKE', "%".$cedula."%");
                $query->select('ps.*', 'sucursals.*');
            }])
            ->findOrFail(auth()->user()->id);
            return view('admin.marcas.showcedula', compact('marca', 'cedula', 'graphics', 'avg' ));
    }

    public function showVips(Request $request, Marca $marca)
    {
        $graphics = $request->get('graphics') ?? Carbon::now()->format('Y-m');
        $zonaf = request('zonaf') ? request('zonaf') : $request->get('zonaf');
        $zona = request('zona') ? request('zona') : $request->get('zona');

        if (auth()->user()->hasRole('Admin')) {
            $sucursales = Sucursal::with(['quest' => function ($query) use ($marca, $zona, $graphics) {
                $query->where('created_at', 'LIKE', "%" . $graphics . "%");
            }])
                ->leftJoin('qresults as qr', function ($join) use ($marca, $zona, $graphics) {
                    $join->on('qr.sucursal_id', '=', 'sucursals.id')
                        ->where('qr.created_at', 'like', "%" . $graphics . "%");
                })
                ->where('marca_id', $marca->id)
                ->where('region', 'LIKE', "%" . $zona . "%")
                ->select('qr.*', 'sucursals.*')
                ->get();

            $preguntasri = PreguntasCuestionario::select('IdPregunta','Pregunta', 'Orden')
                ->where('NivelRiesgo', 'RI')
                ->whereBetween('IdPregunta', [47, 49])
                ->orderBy('Orden')
                ->get();
            $preguntasc = PreguntasCuestionario::select('IdPregunta','Pregunta', 'Orden')
                ->where('NivelRiesgo', 'C')
                ->whereBetween('IdPregunta', [29, 46])

                ->orderBy('Orden')
                ->get();
            return view('admin.marcas.showadminvips', compact('marca', 'zona', 'graphics', 'sucursales', 'preguntasri', 'preguntasc'));
        }
        $sucursales = User::with(['sucursals' => function($query) use ($marca, $zona, $zonaf) {
            $query->select('id','marca_id','zona','region','name');
            $query->where('marca_id', $marca->id);
            $query->where('zona', 'LIKE', '%'. $zonaf .'%');
            $query->whereNotNull('region');
            $query->groupBy('region');
            $query->orderBy('region', 'DESC');
        }, 'grupos'])->findOrFail(auth()->user()->id);

        return view('admin.pages.zona', compact('sucursales', 'marca'));
    }

    public function showVipsDetails(Request $request, Marca $marca)
    {
        $graphics = $request->get('graphics') ?? Carbon::now()->format('Y-m');
        $zona = request('zona');
        $sucursales = User::with(['sucursals.quest' => function($query) use ($graphics){
            $query->where('created_at', 'LIKE', "%".$graphics."%");
        }, 'sucursals' => function($query) use ($marca,$zona, $graphics){
            $query->leftJoin('qresults as qr', function($join) use ($graphics){
                $join->on('qr.sucursal_id', '=', 'sucursals.id')
                    ->where('qr.created_at', 'like', "%".$graphics."%");
            });
            $query->where('marca_id', $marca->id);
            $query->where('region', 'LIKE', "%".$zona."%");
            $query->select('qr.*', 'sucursals.*');
        }])
            ->findOrFail(auth()->user()->id);

        return view('admin.marcas.showvips', compact('graphics', 'zona', 'sucursales', 'marca'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        $this->authorize('view', $marca);
        return view('admin.marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'photo' => ['image'],
        ]);
        File::delete('marcas/'.$marca->photo);
        $marca->update($request->except('photo'));
        if ($request->hasFile('photo'))
        {
            $file = $request->file('photo');
            $path = public_path() . '/marcas/';
            $fileName = uniqid().'-'.$file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
            if ($moved)
            {
                $marca->photo = $fileName;
                $marca->save();
            }
        }

        return redirect()->route('admin.marcas.index')->with('info', 'Datos Actualizados Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        File::delete('marcas/'.$marca->photo); //Borra la foto junto con el registro
        $marca->delete();
        toast('Registro Eliminado Correctamente','info');
        return back();
    }
}
