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
            $sucursales = User::with('sucursals')->findOrFail(auth()->user()->id);
            // ddd($sucursales);
            return view('admin.pages.dashboardsucursales', compact('sucursales'));
        }
            $grupos = GrupoMarca::all();
            $marcas = Marca::allowed()->get();
                return view('admin.dashboard', compact('grupos', 'marcas'));
	    	// $grupos = GrupoMarca::allowed()->get();
	    	// 	return view('admin.dashboard', compact('grupos'));
    		// $marcas = Marca::allowed()->get();
      //       return view('admin.dashboard', compact('marcas'));
    }
}
