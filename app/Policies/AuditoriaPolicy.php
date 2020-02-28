<?php

namespace App\Policies;

use App\Auditoria;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuditoriaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any auditorias.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\Auditoria  $auditoria
     * @return mixed
     */
    public function view(User $user, Auditoria $auditoria)
    {
        return $user->hasRole('asesor') || $user->hasPermissionTo('View auditoria') || $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can create auditorias.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
       return false;
    }

    /**
     * Determine whether the user can update the auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\Auditoria  $auditoria
     * @return mixed
     */
    public function update(User $user, Auditoria $auditoria)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\Auditoria  $auditoria
     * @return mixed
     */
    public function delete(User $user, Auditoria $auditoria)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\Auditoria  $auditoria
     * @return mixed
     */
    public function restore(User $user, Auditoria $auditoria)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\Auditoria  $auditoria
     * @return mixed
     */
    public function forceDelete(User $user, Auditoria $auditoria)
    {
        //
    }
}
