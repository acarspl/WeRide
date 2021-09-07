<?php

namespace Tests\Feature;

use App\Models\Ride;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class DeleteRideTest extends TestCase
{
    use RefreshDatabase;
    private $users;
    private $ride;
    public function setUp():void{
        parent::setUp();
        $this->seed();
        $this->users = User::factory()->count(2)->create();
        $this->actingAs($this->users[0]);
        $this->ride = Ride::factory()->byUser($this->users[0])->create();
    }

    public function test_owner_of_the_ride_can_delete_empty_ride()
    {
        $this->assertDatabaseCount('rides',1);
        $this->delete(route('ride.destroy',$this->ride));
        $this->assertDatabaseCount('rides',0);
    }
    public function test_owner_of_the_ride_can_delete_ride_with_participants()
    {
        $this->assertDatabaseCount('rides',1);
        $this->users[1]->joinRide($this->ride);
        $this->assertDatabaseCount('participants',1);
        $this->delete(route('ride.destroy',$this->ride));
        $this->assertDatabaseCount('participants',0);
        $this->assertDatabaseCount('users',2);
        $this->assertDatabaseCount('rides',0);
    }
    public function test_user_cannot_delete_someone_else_ride()
    {
        $this->assertDatabaseCount('rides',1);
        $response = $this->actingAs($this->users[1])->delete(route('ride.destroy',$this->ride));
        $response->assertStatus(403);
        $this->assertDatabaseCount('rides',1);
    }
}
