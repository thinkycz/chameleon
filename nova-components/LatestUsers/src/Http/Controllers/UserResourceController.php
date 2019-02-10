<?php

namespace Nulisec\LatestUsers\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Nulisec\LatestUsers\Http\Resources\UserResource;

class UserResourceController extends Controller
{
    public function latest()
    {
        $users = User::latest()->take(6)->get();

        return UserResource::collection($users);
    }
}
