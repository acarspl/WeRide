<?php

namespace App\Policies;

use App\Models\Ride;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

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
        return $ride->canJoin($user);
    }
    public function leave(User $user, Ride $ride){
        return $user->doesParticipate($ride) && $ride->start_time >= Carbon::now();
    }
    public function edit(User $user, Ride $ride){
        return $user->id === $ride->user_id;
    }
    public function destroy(User $user, Ride $ride){
        return $user->id === (int)$ride->user_id;
    }
}
