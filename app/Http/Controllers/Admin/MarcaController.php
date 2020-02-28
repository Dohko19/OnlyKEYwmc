<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Dm;
use App\GrupoMarca;
use App\Http\Controllers\Controller;
use App\Marca;
use App\PreguntasCuestionario;
use App\Qresults;
use App\Questionnaire;
use App\ResultadoAuditoria;
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
            $sucursales = Sucursal::with(['segmentos'])
            ->whereNotNull('created_at')
            ->graphics($graphics)
            ->where('marca_id', '=', $marca->id)
            ->orderBy('puntuacion_total', 'DESC')
            ->get();
            // ddd($sucursales);


            return view('admin.marcas.show', compact('marca', 'sucursales'));
        }


        $graphics = $request->get('graphics') ? $request->get('graphics') : Carbon::now()->format('Y-m-d');
        $dm = $request->get('delegacion_municipio') ? $request->get('delegacion_municipio') : request('dm') ;

        $zona = request('zone') ? request('zone') : $request->get('zona');
        // return request('dm');
            $sucursales = Sucursal::with('qresults')
            ->where('sucursals.marca_id', '=', $marca->id)
            ->where('sucursals.delegacion_municipio', 'LIKE', "%".$dm."%")
            ->where('sucursals.region', 'LIKE', "%".$zona."%")
            ->paginate();
            // ddd($sucursales);

            $ri = Sucursal::leftJoin('qresults as q', 'q.sucursal_id', '=', 'sucursals.id')
            ->select('sucursals.id', 'sucursals.name', 'q.RI', 'sucursals.created_at', 'sucursals.zone', 'sucursals.region')
            ->where('sucursals.marca_id', $marca->id)
            ->whereDate('sucursals.created_at', 'LIkE', "%".Carbon::now()->format('Y-m')."%")
            ->where('sucursals.delegacion_municipio', 'LIKE', "%$dm%")
            ->where('sucursals.region', 'LIKE', "%".$zona."%")
            ->orderBy('q.RI', 'ASC')
            ->get()->toArray();
            ddd($ri);
            $c = Sucursal::leftJoin('qresults as q', 'q.sucursal_id', '=', 'sucursals.id')
            ->select('sucursals.id', 'sucursals.name', 'q.C')
            ->where('sucursals.marca_id', $marca->id)
            ->whereDate('sucursals.created_at', 'LIkE', "%".Carbon::parse($graphics)->format('Y-m')."%")
            ->where('sucursals.delegacion_municipio', 'LIkE', "%$dm%")
            ->where('sucursals.region', 'LIKE', "%".$zona."%")
            ->orderBy('q.C', 'ASC')
            ->get()->toArray();

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

              $delegaciones =Sucursal::with(['users', 'marcas'])
                ->findOrFail(auth()->user()->id)
                ->selectRaw('delegacion_municipio dm')
                ->selectRaw('delegacion_municipio del')
                ->whereRaw('marca_id = '. $marca->id )
                ->whereRaw('region = '."'".$delegacion."'")
                ->selectRaw('count(*) del')
                ->groupBy('dm')
                ->orderBy('dm')
                ->get();
            // $C = Sucursal::select('Value', 'riesgo')->where('sucursals.id', $marca->id)
            // ->join('questionnaires', 'sucursals.id', '=', 'questionnaires.sucursal_id')
            // ->where('riesgo', '=', "C")
            // ->get();
            // $idq = Questionnaire::select()
            // $idSuc = Sucursal::where();
            // $C = DB::table('Questionnaire')->get();
            // $users = Questionnaire::with(['posts' => function ($query) {
            //     $query->where('title', 'like', '%first%');
            // }])->get();
            // return $idSuc;


        //     // $sum = 0;

        //     // foreach($C as $num => $values) {
        //     //     $sum += $values['Value'];
        //     // }
        //     // $averageC = $sum*100/count($C);

        //     // $RI = Sucursal::select('Value', 'riesgo')->where('sucursals.id', $marca->id)
        //     // ->join('questionnaires', 'sucursals.id', '=', 'questionnaires.sucursal_id')
        //     // ->where('riesgo', '=', "RI")
        //     // ->get()->toArray();

        //     // $sum = 0;

        //     // foreach($RI as $num => $values) {
        //     //     $sum += $values['Value'];
        //     // }
        //     // $average = $sum*100/count($RI);
        //     // ddd($averageC);
        //     // $sucursales = Sucursal::where('marca_id', '=', $marca->id)
        //     // // ->get();
        //     // $questions = Questionnaire::all();
        //     // ddd($questions);
        //     // $thiis = DB::table('questionnaires as q')
        //     //         ->select('sucursal_id', DB::raw('COUNT(riesgo) AS riesgot, riesgo,'))
        //     //         ->whereRaw('IF(riesgo = '.'C'.', (COUNT(riesgo) * 100 / 15), (COUNT(riesgo) * 100 / 3)) as promedio, s.marca_id')
        //     //         ->join('sucursals as s', 's.id', '=', 'q.sucursal_id')
        //     //         ->where('s.marca_id', '=', $marca->id)
        //     //         ->where('Value', '=', '1')
        //     //         ->groupBy('sucursal_id', 'riesgo')
        //     //         ->get();
        //     //         ddd($thiis);
        //     // ddd($sucursales);
        //     // $ss = Sucursal::select('value')->where('sucursals.id', $marca->id)
        //     // ->join('questionnaires', 'sucursals.id', '=', 'questionnaires.sucursal_id')
        //     // ->orderBy('value', 'DESC')
        //     // ->get()->toArray();
        //     // $ss = array_filter($ss);
        //     // $f = 100;
        //     // $sum = 0;

        //     // foreach($ri as $num => $values) {
        //     //     $sum = $values['RI'];
        //     // }
        //     // return $sum;
        //     // $average = $sum*$f/count($ss);
            return view('admin.marcas.showquestionnary', compact('marca', 'sucursales', 'ri', 'c', 'preguntasRigth', 'preguntasLeft', 'delegaciones', 'zona', 'delegacion'));
        //     // return view('admin.marcas.showquestionnary', compact('marca','sucursales','questions'));
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
