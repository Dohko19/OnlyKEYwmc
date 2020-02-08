<?php

namespace App\Policies;

use App\Sucursal;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SucursalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any sucursals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the sucursal.
     *
     * @param  \App\User  $user
     * @param  \App\Sucursal  $sucursal
     * @return mixed
     */
    public function view(User $user, Sucursal $sucursal)
    {
        //
    }

    /**
     * Determine whether the user can create sucursals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the sucursal.
     *
     * @param  \App\User  $user
     * @param  \App\Sucursal  $sucursal
     * @return mixed
     */
    public function update(User $user, Sucursal $sucursal)
    {
        //
    }

    /**
     * Determine whether the user can delete the sucursal.
     *
     * @param  \App\User  $user
     * @param  \App\Sucursal  $sucursal
     * @return mixed
     */
    public function delete(User $user, Sucursal $sucursal)
    {
        //
    }

    /**
     * Determine whether the user can restore the sucursal.
     *
     * @param  \App\User  $user
     * @param  \App\Sucursal  $sucursal
     * @return mixed
     */
    public function restore(User $user, Sucursal $sucursal)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the sucursal.
     *
     * @param  \App\User  $user
     * @param  \App\Sucursal  $sucursal
     * @return mixed
     */
    public function forceDelete(User $user, Sucursal $sucursal)
    {
        //
    }
}
