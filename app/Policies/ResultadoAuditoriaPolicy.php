<?php

namespace App\Policies;

use App\ResultadoAuditoria;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResultadoAuditoriaPolicy
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
     * Determine whether the user can view any resultado auditorias.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the resultado auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\ResultadoAuditoria  $resultadoAuditoria
     * @return mixed
     */
    public function view(User $user, ResultadoAuditoria $resultadoAuditoria)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('View resultado auditoria');

    }

    /**
     * Determine whether the user can create resultado auditorias.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the resultado auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\ResultadoAuditoria  $resultadoAuditoria
     * @return mixed
     */
    public function update(User $user, ResultadoAuditoria $resultadoAuditoria)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Update resultadosaud') || $user->hasRole('asesor');
    }

    /**
     * Determine whether the user can delete the resultado auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\ResultadoAuditoria  $resultadoAuditoria
     * @return mixed
     */
    public function delete(User $user, ResultadoAuditoria $resultadoAuditoria)
    {
        //
    }

    /**
     * Determine whether the user can restore the resultado auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\ResultadoAuditoria  $resultadoAuditoria
     * @return mixed
     */
    public function restore(User $user, ResultadoAuditoria $resultadoAuditoria)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the resultado auditoria.
     *
     * @param  \App\User  $user
     * @param  \App\ResultadoAuditoria  $resultadoAuditoria
     * @return mixed
     */
    public function forceDelete(User $user, ResultadoAuditoria $resultadoAuditoria)
    {
        //
    }
}
