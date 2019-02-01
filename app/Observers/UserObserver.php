<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\AccountActivated;

class UserObserver
{

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updating(User $user)
    {
        // if ($user->isDirty('activated_at') && !$user->is_active) {
        $user->notify(new AccountActivated());
        // }
    }
}
