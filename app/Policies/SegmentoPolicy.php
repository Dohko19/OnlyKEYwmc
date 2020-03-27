<?php

namespace App\Policies;

use App\Segmento;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SegmentoPolicy
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
     * Determine whether the user can view any segmentos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the segmento.
     *
     * @param  \App\User  $user
     * @param  \App\Segmento  $segmento
     * @return mixed
     */
    public function view(User $user, Segmento $segmento)
    {
        return $user->hasRole('asesor') || $user->hasPermissionTo('View segmentos') || $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can create segmentos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the segmento.
     *
     * @param  \App\User  $user
     * @param  \App\Segmento  $segmento
     * @return mixed
     */
    public function update(User $user, Segmento $segmento)
    {
        //
    }

    /**
     * Determine whether the user can delete the segmento.
     *
     * @param  \App\User  $user
     * @param  \App\Segmento  $segmento
     * @return mixed
     */
    public function delete(User $user, Segmento $segmento)
    {
        //
    }

    /**
     * Determine whether the user can restore the segmento.
     *
     * @param  \App\User  $user
     * @param  \App\Segmento  $segmento
     * @return mixed
     */
    public function restore(User $user, Segmento $segmento)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the segmento.
     *
     * @param  \App\User  $user
     * @param  \App\Segmento  $segmento
     * @return mixed
     */
    public function forceDelete(User $user, Segmento $segmento)
    {
        //
    }
}
