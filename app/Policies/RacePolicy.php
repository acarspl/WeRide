<?php

namespace App\Policies;

use App\Models\Race;
use App\Models\Ride;
use App\Models\User;
use Carbon\Carbon;
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
        return $user->id !== $race->user_id && !$user->doesParticipate($race) && $race->signing_deadline >= Carbon::now()
            && ($race->participants()->count() + 1) < $race->max_users;
    }
    public function leave(User $user, Race $race){
        return $user->doesParticipate($race) && $race->start_time >= Carbon::now();
    }
}
