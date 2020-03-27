<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ( $user->hasRole('Admin') )
        {
            return true;
        }
    }

     public function view(User $user)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('View reporte');
    }
}
