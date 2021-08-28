<?php

namespace Tests\Feature;

use App\Models\Race;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCanJoinEventTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_verified_user_can_join_ride()
    {
        $this->seed();
        $user1 = User::factory()->create();
        $user2= User::factory()->create();
        $ride = Ride::factory()->byUser($user1)->create();
        $this->assertTrue($user2->joinRide($ride));
        $this->assertDatabaseCount('participants',1);
        $this->assertTrue($user2->participatedRides->first()->id == $ride->id);

    }
    public function test_verified_user_can_join_race()
    {
        $this->seed();
        $user1 = User::factory()->create();
        $user2= User::factory()->create();
        $race = Race::factory()->byUser($user1)->create();
        $this->assertTrue($user2->joinRace($race));
        $this->assertDatabaseCount('participants',1);
        $this->assertTrue($user2->participatedRaces->first()->id == $race->id);
    }
    public function test_verified_user_cannot_join_own_ride()
    {
        $this->seed();
        $user1 = User::factory()->create();
        $ride = Ride::factory()->byUser($user1)->create();
        $this->assertFalse($user1->joinRide($ride));
        $this->assertDatabaseCount('participants',0);
    }
    public function test_verified_user_cannot_join_own_race()
    {
        $this->seed();
        $user1 = User::factory()->create();
        $race = Race::factory()->byUser($user1)->create();
        $this->assertFalse($user1->joinRace($race));
        $this->assertDatabaseCount('participants',0);
    }
}
