<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Preference;
use Illuminate\Auth\Access\HandlesAuthorization;

class PreferencePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the preference.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Preference  $preference
     * @return mixed
     */
    public function view(User $user, Preference $preference)
    {
        return true;
    }

    /**
     * Determine whether the user can create preferences.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the preference.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Preference  $preference
     * @return mixed
     */
    public function update(User $user, Preference $preference)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the preference.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Preference  $preference
     * @return mixed
     */
    public function delete(User $user, Preference $preference)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the preference.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Preference  $preference
     * @return mixed
     */
    public function restore(User $user, Preference $preference)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the preference.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Preference  $preference
     * @return mixed
     */
    public function forceDelete(User $user, Preference $preference)
    {
        return false;
    }
}
