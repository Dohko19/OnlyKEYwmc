<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Dm;
use App\GrupoMarca;
use App\Http\Controllers\Controller;
use App\InspeccionSanitaria;
use App\Marca;
use App\PreguntasCuestionario;
use App\Qresults;
use App\Questionnaire;
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
        // $marca = Marca::with('grupos')->get();
        $marcas = GrupoMarca::allowed()->get();
        $users = User::all();
        return view('admin.marcas.index', compact('marcas', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        if($marca->grupos->tipo == 'auditorias')
        {
            $graphics = $request->get('graphics') ?? Carbon::now();
            $sucursales = Sucursal::whereNotNull('created_at')
            ->graphics($graphics)
            ->Where('marca_id', '=', $marca->id)
            ->orderBy('puntuacion_total', 'DESC')
            ->get();
            return view('admin.marcas.show', compact('marca', 'sucursales'));
        }
            $graphics = $request->get('graphics') ?? Carbon::now();
            $dm = $request->get('dm') ?? '';
            $sucursales = Sucursal::with('qresults')
            ->where('sucursals.marca_id', '=', $marca->id)
            ->get();
            // ddd($sucursales);
            $ri = Sucursal::leftJoin('qresults as q', 'q.sucursal_id', '=', 'sucursals.id')
            ->select('sucursals.id', 'sucursals.name', 'q.RI', 'sucursals.created_at')
            ->where('sucursals.marca_id', $marca->id)
            ->orWhere('sucursals.created_at', 'LIkE', "%$graphics%")
            ->orWhere('delegacion_municipio', 'LIkE', "%$dm%")
            ->orderBy('q.RI', 'ASC')
            ->get()->toArray();
            // ddd($ri);
            $c = Sucursal::leftJoin('qresults as q', 'q.sucursal_id', '=', 'sucursals.id')
            ->select('sucursals.id', 'sucursals.name', 'q.C')
            ->where('sucursals.marca_id', $marca->id)
            ->orWhere('sucursals.created_at', 'LIkE', "%$graphics%")
            ->orWhere('delegacion_municipio', 'LIkE', "%$dm%")
            ->orderBy('q.C', 'ASC')
            ->get()->toArray();

            $preguntas = PreguntasCuestionario::select('IdPregunta','NivelRiesgo','Pregunta')->get();
            $dm = Dm::select('name')->get();

            $preguntasLeft = collect();
            $preguntasRigth = collect();
            foreach ($preguntas as $key => $pregunta) {
                if ($key%2 == 0)
                {
                    $preguntasLeft->push($pregunta);

                }
                else
                {
                    $preguntasRigth->push($pregunta);
                }
            }
            // ddd(count($c));
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


            // $sum = 0;

            // foreach($C as $num => $values) {
            //     $sum += $values['Value'];
            // }
            // $averageC = $sum*100/count($C);

            // $RI = Sucursal::select('Value', 'riesgo')->where('sucursals.id', $marca->id)
            // ->join('questionnaires', 'sucursals.id', '=', 'questionnaires.sucursal_id')
            // ->where('riesgo', '=', "RI")
            // ->get()->toArray();

            // $sum = 0;

            // foreach($RI as $num => $values) {
            //     $sum += $values['Value'];
            // }
            // $average = $sum*100/count($RI);
            // ddd($averageC);
            // $sucursales = Sucursal::where('marca_id', '=', $marca->id)
            // // ->get();
            // $questions = Questionnaire::all();
            // ddd($questions);
            // $thiis = DB::table('questionnaires as q')
            //         ->select('sucursal_id', DB::raw('COUNT(riesgo) AS riesgot, riesgo,'))
            //         ->whereRaw('IF(riesgo = '.'C'.', (COUNT(riesgo) * 100 / 15), (COUNT(riesgo) * 100 / 3)) as promedio, s.marca_id')
            //         ->join('sucursals as s', 's.id', '=', 'q.sucursal_id')
            //         ->where('s.marca_id', '=', $marca->id)
            //         ->where('Value', '=', '1')
            //         ->groupBy('sucursal_id', 'riesgo')
            //         ->get();
            //         ddd($thiis);
            // ddd($sucursales);
            // $ss = Sucursal::select('value')->where('sucursals.id', $marca->id)
            // ->join('questionnaires', 'sucursals.id', '=', 'questionnaires.sucursal_id')
            // ->orderBy('value', 'DESC')
            // ->get()->toArray();
            // $ss = array_filter($ss);
            // $f = 100;
            // $sum = 0;

            // foreach($ri as $num => $values) {
            //     $sum = $values['RI'];
            // }
            // return $sum;
            // $average = $sum*$f/count($ss);
            return view('admin.marcas.showquestionnary', compact('marca', 'sucursales', 'ri', 'c', 'preguntas', 'preguntasLeft', 'preguntasRigth', 'dm'));
            // return view('admin.marcas.showquestionnary', compact('marca','sucursales','questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
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
