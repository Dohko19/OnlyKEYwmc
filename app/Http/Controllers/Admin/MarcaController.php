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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('view', new Marca);
        return view('admin.marcas.create',[
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
        if($marca->grupos->tipo == 'auditorias')
        {

            $graphics = $request->get('graphics') ?? Carbon::now()->format('Y-m-d');
            $cedula = $request->get('cedula') ? $request->get('cedula') : request('cedula');
            $sucursales = User::with(['sucursals.audres' => function($query) use ($marca, $cedula, $graphics){
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


            return view('admin.marcas.show', compact('marca', 'sucursales'));
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
            $preguntas = PreguntasCuestionario::select('IdPregunta','Pregunta')->get();

            $preguntasLeft = collect();
            $preguntasRigth = collect();
              foreach ($preguntas as $key => $pregunta) {
                  if ($key < 15)
                  {
                      $preguntasLeft->push($pregunta);
                  }
                  else
                  {
                      $preguntasRigth->push($pregunta);
                  }
              }
            $delegacion = request('zonaf');

            $delegaciones = User::with(['sucursals' => function($query){
                    $query->where('region', '=', request('zone') );
                    $query->groupBy('delegacion_municipio');
              }])
                ->findOrFail(auth()->user()->id);
            return view('admin.marcas.showquestionnary', compact('marca', 'sucursales', 'preguntasRigth', 'preguntasLeft', 'delegaciones', 'zona', 'delegacion') );
        //     // return view('admin.marcas.showquestionnary', compact('marca','sucursales','questions'));
    }

    public function showcedula(Request $request, Marca $marca)
    {
            $graphics = $request->get('graphics') ?? Carbon::now()->format('Y-m');
            $cedula = $request->get('cedula') ? $request->get('cedula') : request('cedula');

            if (auth()->user()->hasRole('Admin'))
            {
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
                    ->get();
                return view('admin.marcas.showcedula', compact('marca', 'cedula', 'graphics', 'avg' ));
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
