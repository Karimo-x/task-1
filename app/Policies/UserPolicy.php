<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function manageUser(User $user){
        return $user->is_admin;
    }
}
