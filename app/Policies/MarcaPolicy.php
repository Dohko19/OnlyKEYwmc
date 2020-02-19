<?php

namespace App\Policies;

use App\Marca;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarcaPolicy
{
    use HandlesAuthorization;


    public function before($user)
    {
        if ($user->hasRole('Admin'))
        {
            return true;
        }
    }


    /**
     * Determine whether the user can view any marcas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the marca.
     *
     * @param  \App\User  $user
     * @param  \App\Marca  $marca
     * @return mixed
     */
    public function view(User $user, Marca $marca)
    {
        return false;
    }

    /**
     * Determine whether the user can create marcas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
    }

    /**
     * Determine whether the user can update the marca.
     *
     * @param  \App\User  $user
     * @param  \App\Marca  $marca
     * @return mixed
     */
    public function update(User $user, Marca $marca)
    {
    }

    /**
     * Determine whether the user can delete the marca.
     *
     * @param  \App\User  $user
     * @param  \App\Marca  $marca
     * @return mixed
     */
    public function delete(User $user, Marca $marca)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the marca.
     *
     * @param  \App\User  $user
     * @param  \App\Marca  $marca
     * @return mixed
     */
    public function restore(User $user, Marca $marca)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the marca.
     *
     * @param  \App\User  $user
     * @param  \App\Marca  $marca
     * @return mixed
     */
    public function forceDelete(User $user, Marca $marca)
    {
        //
    }
}
