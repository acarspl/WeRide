<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function follow(User $authUser, User $user){
        return $authUser->id != $user->id && !$authUser->isFollowing($user);
    }
    public function unfollow(User $authUser, User $user){
        return $authUser->id != $user->id && $authUser->isFollowing($user);
    }
}
