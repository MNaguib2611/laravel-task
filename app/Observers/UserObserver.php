<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;

class UserObserver
{
    public function created(User $user): void
    {
        //in EventServiceProvider --SendEmailVerificationNotification listener is attacked to Registered
        event(new Registered($user));
    }
}
