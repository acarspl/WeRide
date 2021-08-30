<?php

namespace App\Policies;

use App\Models\Ride;
use App\Models\User;
use Carbon\Carbon;
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
        return $user->id !== $ride->user_id && !$user->doesParticipate($ride) &&  $ride->signing_deadline >= Carbon::now();
    }
    public function leave(User $user, Ride $ride){
        return $user->doesParticipate($ride) && $ride->start_time >= Carbon::now();
    }
}
