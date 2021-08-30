<?php

namespace App\Policies;

use App\Models\Race;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RacePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function join(User $user, Race $race){
        return $user->id !== $race->user_id;
    }
}
