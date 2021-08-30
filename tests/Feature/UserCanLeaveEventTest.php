<?php

namespace Tests\Feature;

use App\Models\Race;
use App\Models\Ride;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCanLeaveEventTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_leave_ride(){
        $this->seed();
        $user1 = User::factory()->create();
        $user2= User::factory()->create();
        $ride = Ride::factory()->byUser($user1)->create();
        $response = $this->actingAs($user2)->post('/ride/'.$ride->id.'/join');
        $this->assertDatabaseCount('participants',1);
        $response = $this->actingAs($user2)->delete('/ride/'.$ride->id.'/leave');
        $response->assertJson(['success'=>true])->assertStatus(200);
        $this->assertDatabaseCount('participants',0);

    }
    public function test_user_can_leave_race(){
        $this->seed();
        $user1 = User::factory()->create();
        $user2= User::factory()->create();
        $race = Race::factory()->byUser($user1)->create();
        $response = $this->actingAs($user2)->post('/race/'.$race->id.'/join');
        $this->assertDatabaseCount('participants',1);
        $response = $this->actingAs($user2)->delete('/race/'.$race->id.'/leave');
        $response->assertJson(['success'=>true])->assertStatus(200);
        $this->assertDatabaseCount('participants',0);

    }
    public function test_user_cannot_leave_not_participated_ride(){
        $this->seed();
        $user1 = User::factory()->create();
        $user2= User::factory()->create();
        $ride = Ride::factory()->byUser($user1)->create();
        $response = $this->actingAs($user2)->delete('/ride/'.$ride->id.'/leave');
        $response->assertStatus(403);
    }
    public function test_user_cannot_leave_not_participated_race(){
        $this->seed();
        $user1 = User::factory()->create();
        $user2= User::factory()->create();
        $race = Race::factory()->byUser($user1)->create();
        $response = $this->actingAs($user2)->delete('/race/'.$race->id.'/leave');
        $response->assertStatus(403);
    }
    public function test_user_cannot_leave_ride_after_start_time(){
        $this->seed();
        $user1 = User::factory()->create();
        $user2= User::factory()->create();
        $ride = Ride::factory()->byUser($user1)->create(['start_time'=>Carbon::now()->subDays(1)]);
        $response = $this->actingAs($user2)->post('/ride/'.$ride->id.'/join');
        $this->assertDatabaseCount('participants',1);
        $response = $this->actingAs($user2)->delete('/ride/'.$ride->id.'/leave');
        $response->assertStatus(403);
        $this->assertDatabaseCount('participants',1);
    }
    public function test_user_cannot_leave_race_after_start_time(){
        $this->seed();
        $user1 = User::factory()->create();
        $user2= User::factory()->create();
        $race = Race::factory()->byUser($user1)->create(['start_time'=>Carbon::now()->subDays(1)]);
        $response = $this->actingAs($user2)->post('/race/'.$race->id.'/join');
        $this->assertDatabaseCount('participants',1);
        $response = $this->actingAs($user2)->delete('/race/'.$race->id.'/leave');
        $response->assertStatus(403);
        $this->assertDatabaseCount('participants',1);
    }
}
