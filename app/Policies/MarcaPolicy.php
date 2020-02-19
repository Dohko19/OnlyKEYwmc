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
        if ( $user->hasRole('Admin') )
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
        return $user->id === $marca->user_id || $user->hasPermissionTo('View marcas');
    }

    /**
     * Determine whether the user can create marcas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Create marcas');
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
        return $user->id === $marca->user_id || $user->hasPermissionTo('Update marcas');
    }

    /**
     * Determine whether the user can delete the marca.
     *
     * @param  \App\User  $user
     * @param  \App\Marca  $marca
     * @return mixed
     */
    public function delete(User $user, Marca $marca)
    {   //$user->id === $marca->user_id
        return $user->hasPermissionTo('Delete marcas');
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
