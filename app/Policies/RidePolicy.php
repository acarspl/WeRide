<?php

namespace App\Policies;

use App\Models\Ride;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RidePolicy
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
    public function join(User $user, Ride $ride){
        return $user->id !== $ride->user_id;
    }
}
