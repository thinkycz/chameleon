<?php

namespace App\Repositories;

use App\Models\User;
use Silvanite\Brandenburg\Permission;

class UserRepository
{
    public static function admins()
    {
        return User::whereHas('roles', function ($query) {
            return $query->whereIn('id', optional(optional(Permission::find('viewNova'))->roles)->pluck('id') ?: []);
        })->get();
    }
}
