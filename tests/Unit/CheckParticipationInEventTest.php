<?php

namespace Tests\Unit;

use App\Models\Race;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckParticipationInEventTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_check_participation_in_ride()
    {
        $this->seed();
        $user1 = User::factory()->create();
        $user2= User::factory()->create();
        $ride = Ride::factory()->byUser($user1)->create();
        $this->assertFalse($user2->doesParticipate($ride));
        $this->assertTrue($user2->joinRide($ride));
        $this->assertTrue($user2->doesParticipate($ride));
    }
    public function test_check_participation_in_race()
    {
        $this->seed();
        $user1 = User::factory()->create();
        $user2= User::factory()->create();
        $race = Race::factory()->byUser($user1)->create();
        $this->assertFalse($user2->doesParticipate($race));
        $this->assertTrue($user2->joinRace($race));
        $this->assertTrue($user2->doesParticipate($race));
    }
}
