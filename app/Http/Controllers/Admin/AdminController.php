<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Marca;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
    		$marcas = Marca::allowed()->get();
    	return view('admin.dashboard', compact('marcas'));
    }
}
