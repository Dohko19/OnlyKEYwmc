<?php

namespace App\Http\Controllers\Admin;

use App\Auditoria;
use App\GrupoMarca;
use App\Http\Controllers\Controller;
use App\Marca;
use App\Question;
use App\Segmento;
use App\Sucursal;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->hasRole('dgral')) {
            // $sucursales = Sucursal::with(['users', 'marcas'])
            //     ->findOrFail(auth()->user()->id)
            //     ->selectRaw('region r')
            //     ->selectRaw('marca_id m')
            //     ->selectRaw('id id')
            //     ->selectRaw('delegacion_municipio dm')
            //     ->selectRaw('count(*) sucursals')
            //     ->groupBy('region')
            //     ->orderBy('region')
            //     ->get();
            // ddd($sucursales);
            $marcas = Marca::with(['grupos'])->where('user_id', auth()->user()->id)->get();
            // ddd($grupos);
            // ddd($sucursales);
            return view('admin.dashboard', compact('marcas'));
        }
        // if (auth()->user()->hasRole('dmarca')) {
        //     $sucursales = User::with('sucursals')->findOrFail(auth()->user()->id);
        //     return view('admin.dashboard', compact('sucursales'));
        // }
        if(auth()->user()->hasRole('Admin'))
        {
            // $sucursales = User::all();
            // $grupos = GrupoMarca::all();

                return view('admin.dashboard');
        }
    }

    public function region($id)
    {
        if (auth()->user()->hasRole('dgral'))
        {
            $marca = Marca::findOrFail($id);
             $sucursales = User::with(['sucursals' => function($query){
                $query->selectRaw('marca_id m');
                $query->selectRaw('delegacion_municipio dm');
                $query->selectRaw('region r');
                $query->selectRaw('count(*) sucursals');
                $query->groupBy('region');
                $query->orderBy('region');
            }, 'grupos'])
                ->findOrFail(auth()->user()->id);
                return view('admin.pages.region', compact('sucursales', 'marca'));
        }
        return redirect()->route('admin.index')->withInfo('No tienes Permisos para ver esta seccion');
    }

    public function consultareporte(Request $request)
    {
        //
    }
}
