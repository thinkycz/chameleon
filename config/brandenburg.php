<?php

use App\Models\User;

return [
    /**
     * User model class name.
     */
    'userModel' => User::class,

    /**
     * Configure Brandenburg to not register its migrations.
     */
    'ignoreMigrations' => false,
];
