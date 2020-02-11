<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\GrupoMarca;
use App\Http\Controllers\Controller;
use App\InspeccionSanitaria;
use App\Marca;
use App\Questionnaire;
use App\Sucursal;
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
        return view('admin.marcas.index', compact('marcas'));
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
            $graphics = $request->get('graphics') ?? '';
            $sucursales = Sucursal::whereNotNull('created_at')
            ->graphics($graphics)
            ->Where('marca_id', '=', $marca->id)
            ->orderBy('puntuacion_total', 'DESC')
            ->get();
            return view('admin.marcas.show', compact('marca', 'sucursales'));
        }
            $graphics = $request->get('graphics') ?? '';

            $sucursales = Sucursal::where('sucursals.marca_id', '=', $marca->id)
            ->graphics($graphics)
            ->orderBy('puntuacion_total', 'ASC')
            ->get();
            // dd($sucursales);
            $promedio = Sucursal::join('qresults', 'qresults.sucursal_id', '=', 'sucursals.id' )
            ->where('sucursals.id', $marca->id)
            ->orderBy('puntuacion_total', 'DESC')
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
            // ->get();
            $questions = Questionnaire::all();
            $thiis = DB::('questionnaires as q')
            // ddd($sucursales);
            // $ss = Sucursal::select('value')->where('sucursals.id', $marca->id)
            // ->join('questionnaires', 'sucursals.id', '=', 'questionnaires.sucursal_id')
            // ->orderBy('value', 'DESC')
            // ->get()->toArray();
            // $ss = array_filter($ss);
            // $f = 100;
            // $sum = 0;

            // foreach($ss as $num => $values) {
            //     $sum += $values['value'];
            // }

            // $average = $sum*$f/count($ss);
            return view('admin.marcas.showquestionnary', compact('marca', 'sucursales', 'questions', 'promedio'));
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
