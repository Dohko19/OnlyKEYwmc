<?php

namespace App\Policies;

use App\GrupoMarca;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GrupoMarcaPolicy
{
    use HandlesAuthorization;


    public function before($user)
    {
        if ( $user->isAdmin() )
        {
            return true;
        }
    }

    /**
     * Determine whether the user can view any grupo marcas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the grupo marca.
     *
     * @param  \App\User  $user
     * @param  \App\GrupoMarca  $grupoMarca
     * @return mixed
     */
    public function view(User $user, GrupoMarca $grupoMarca)
    {
        //
    }

    /**
     * Determine whether the user can create grupo marcas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the grupo marca.
     *
     * @param  \App\User  $user
     * @param  \App\GrupoMarca  $grupoMarca
     * @return mixed
     */
    public function update(User $user, GrupoMarca $grupoMarca)
    {
        //
    }

    /**
     * Determine whether the user can delete the grupo marca.
     *
     * @param  \App\User  $user
     * @param  \App\GrupoMarca  $grupoMarca
     * @return mixed
     */
    public function delete(User $user, GrupoMarca $grupoMarca)
    {
        //
    }

    /**
     * Determine whether the user can restore the grupo marca.
     *
     * @param  \App\User  $user
     * @param  \App\GrupoMarca  $grupoMarca
     * @return mixed
     */
    public function restore(User $user, GrupoMarca $grupoMarca)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the grupo marca.
     *
     * @param  \App\User  $user
     * @param  \App\GrupoMarca  $grupoMarca
     * @return mixed
     */
    public function forceDelete(User $user, GrupoMarca $grupoMarca)
    {
        //
    }
}
