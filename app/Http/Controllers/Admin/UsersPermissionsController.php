<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UsersPermissionsController extends Controller
{
     public function update(Request $request, User $user)
    {
    	$user->permissions()->detach();

    	// if ($request->filled('permissions'))
    	// {
    	// 	$user->givePermissionTo($request->permissions);
    	// }
    	$user->syncPermissions($request->permissions);

    	return back()->withSuccess('Los Permisos han sido actualizados');
    }
}
