<?php

namespace App\Http\Controllers\Admin;

use App\Auditoria;
use App\GrupoMarca;
use App\Http\Controllers\Controller;
use App\Marca;
use App\Question;
use App\Segmento;
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
        if (auth()->user()->isAdmin()) {
            $grupos = GrupoMarca::all();
            $marcas = Marca::allowed()->get();
                return view('admin.dashboard', compact('grupos', 'marcas'));
        }
    	elseif (auth()->user()->isDral()) {
	    	$grupos = GrupoMarca::allowed()->get();
	    		return view('admin.dashboard', compact('grupos'));
    	}
    	elseif(auth()->user()->isDmarca() || auth()->user()->isAdmin())
    	{
    		$marcas = Marca::allowed()->get();
            return view('admin.dashboard', compact('marcas'));
    	}
    }
}
