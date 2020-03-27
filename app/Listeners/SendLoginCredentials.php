<?php

namespace App\Listeners;

use App\Events\UserResetPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginCredentials;

class SendLoginCredentials
{

    /**
     * Handle the event.
     *
     * @param  UserResetPassword  $event
     * @return void
     */
    public function handle(UserResetPassword $event)
    {
        Mail::to($event->user)->queue(
            new LoginCredentials($event->user, $event->password)
        );
    }
}
