<?php

namespace App\Providers;

use App\Models\Race;
use App\Models\Ride;
use App\Models\User;
use App\Policies\RacePolicy;
use App\Policies\RidePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Ride::class => RidePolicy::class,
        Race::class => RacePolicy::class,
        User::class => UserPolicy::class,
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
