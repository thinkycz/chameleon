<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected static $admins = [
        'team@nulisec.com',
    ];

    public static function admins()
    {
        // TODO:: Should be changed with nova permissions
        return User::whereEmail(static::$admins)->get();
    }
}
