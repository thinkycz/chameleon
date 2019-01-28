<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected static $admins = [
        'team@nulisec.com',
    ];

    public function admins()
    {
        // TODO:: Should be changed
        return User::whereEmail(static::$admins)->get();
    }
}
