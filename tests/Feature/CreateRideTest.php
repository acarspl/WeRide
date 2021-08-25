<?php

namespace Tests\Feature;

use App\Models\Ride;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CreateRideTest extends TestCase
{
    use RefreshDatabase;

    public function setUp():void{
        parent::setUp();
        $this->seed();

    }
    public function test_verified_user_can_create_ride(){
        User::factory()->create();
        $user = Auth::loginUsingId(1);
        $this->actingAs($user);
        $ride = Ride::factory()->make()->toArray();
        $response = $this->post(route('ride.store'),$ride);
        $response->assertStatus(302);
        $this->assertDatabaseCount('rides',1);
        $this->assertEquals(Ride::first()->distance , $ride['distance']);
        $this->assertEquals(Ride::first()->user_id , Auth::id());
    }
    public function test_verified_user_can_create_ride_end_location_not_given(){
        User::factory()->create();
        $user = Auth::loginUsingId(1);
        $this->actingAs($user);
        $ride = Ride::factory()->withoutEndLocation()->make()->toArray();
        $response = $this->post(route('ride.store'),$ride);
        $response->assertStatus(302);
        $this->assertDatabaseCount('rides',1);
        $this->assertEquals(Ride::first()->distance , $ride['distance']);
        $this->assertEquals(Ride::first()->user_id , Auth::id());
        $this->assertEquals(Ride::first()->end_location_lat , $ride['start_location_lat']);
    }
    public function test_guest_cannot_create_ride(){
        $ride = Ride::factory()->make()->toArray();
        $response = $this->post(route('ride.store'),$ride);
        $response->assertStatus(302)->assertRedirect('/login');
        $this->assertDatabaseCount('rides',0);
    }
    public function test_unverified_user_cannot_create_ride(){
        User::factory()->unverified()->create();
        $user = Auth::loginUsingId(1);
        $this->actingAs($user);
        $ride = Ride::factory()->make()->toArray();
        $response = $this->post(route('ride.store'),$ride);
        $response->assertStatus(302);
        $this->assertDatabaseCount('rides',0);
    }
}
