<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Marca;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
    	$marcas = Marca::allowed()->get();
=======
    	$marcas = Marca::all();
>>>>>>> d85af56abd3e5be5a564346dfe9928f376bea8ad
    	return view('admin.dashboard', compact('marcas'));
    }
}
