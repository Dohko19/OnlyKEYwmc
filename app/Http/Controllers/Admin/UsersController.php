<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Mail\ResendAuthDates;
use App\User;
use App\Http\Resources\User as UserCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Excel;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Events\UserResetPassword;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', new User);
        $users = User::allowed()->get();
        // $users = User::paginate(2);
        // return new UserCollection($users);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
        $this->authorize('create', $user);
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name', 'id');
        return view('admin.users.create', compact('roles', 'permissions', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        // return $request;
        $this->authorize('create', new User);
        $data = $request->validate([
            'name' => ['required', 'min:2'],
            'email' => ['required', 'email', 'unique:users' ],
            'username' => ['required','string', 'unique:users'],
            'phone' => ['numeric'],
            'lastname' => ['string'],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        $user = User::create($data);
        //Asiganmos los roles
        $user->assignRole($request->roles);
        //Assigamos los permisos
        $user->givePermissionTo($request->permissions);

//        UserResetPassword::dispatch($user, $data['password']);
        return redirect()->back()->withSuccess('Usuario Creado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id', 'display_name');
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user->update( $request->validated() );
        return redirect()->route('admin.users.edit', $user)->withSuccess('Usuario Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();

        return back()->with('info', 'Usuario Eliminado Correctamente');
    }

    public function userdata(User $user)
    {
        Mail::to($user->email)->send(new ResendAuthDates($user));
        return redirect()->back()->withInfo('Correo re-enviado con datos del usuario');
    }

    public function resetpass(User $user)
    {

        $data['password'] = str_random(8);
        // dd($data);
        $user->password = $data['password'];
        $user->save();
        UserResetPassword::dispatch($user, $data['password']);
        return redirect()->back()->withInfo('Contraseña reseteada exitosamente');
    }
}
