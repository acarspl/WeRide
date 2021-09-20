<?php

namespace Tests\Feature;

use App\Models\Race;
use App\Models\Ride;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CanViewEventsTest extends TestCase
{
    use RefreshDatabase;
    private $users;
    private $ride;
    private $race;
    public function setUp():void{
        parent::setUp();
        $this->seed();
        $this->users = User::factory()->count(3)->create();
        $this->ride = Ride::factory()->byUser($this->users[0])->create();
        $this->race = Race::factory()->byUser($this->users[0])->create();
        $this->users[1]->joinRace($this->race);
        $this->users[1]->joinRide($this->ride);
    }
    public function test_guest_can_view_race_index(){
        Auth::logout();
        $response = $this->get(route('race.index'));
        $response->assertStatus(200);
    }
    public function test_guest_can_view_race(){
        Auth::logout();
        $response =  $this->get(route('race.show',$this->race));
        $response->assertStatus(200);
    }
    public function test_guest_cannot_view_participants(){
        Auth::logout();
        $response =  $this->get(route('race.show',$this->race));
        $response->assertStatus(200);
        $response->assertDontSee($this->users[1]->name);
        $response->assertDontSee($this->users[0]->name);
    }
    public function test_guest_cannot_view_ride(){
        Auth::logout();
        $response = $this->get(route('ride.show',$this->ride));
        $response->assertStatus(302)->assertRedirect(route('login'));
    }
    public function test_user_can_view_ride(){
        $response =  $this->actingAs($this->users[2])->get(route('ride.show',$this->ride));
        $response->assertStatus(200);
        $response->assertSee($this->users[1]->name);
        $response->assertSee($this->users[0]->name);
    }
    public function test_user_can_view_race(){
        $response =  $this->actingAs($this->users[2])->get(route('race.show',$this->race));
        $response->assertStatus(200);
        $response->assertSee($this->users[1]->name);
        $response->assertSee($this->users[0]->name);
    }
    public function test_user_can_get_events_within_bounds(){
        $rides = collect();
        $races = collect();
        for($i=0; $i<20;$i++){
            $rides->push(Ride::factory()->byUser($this->users[0])->create(['start_location_lat'=>0+$i, 'start_location_lng'=>0]));
        }
        for($i=0; $i<20;$i++){
            $races->push(Race::factory()->byUser($this->users[0])->create(['start_location_lat'=>3+$i, 'start_location_lng'=>0]));
        }

        $payload = [
          'start_time_from'=>Carbon::now()->subHour()->toDateTimeString(),
          'is_race'=>0,
          'latSW'=>0,
          'latNE'=>4.5,
          'lngSW'=>-5,
          'lngNE'=>5,
          'sport_type'=>0,
            "start_time_to"=> null,
        "speed_from"=> null,
        "speed_to"=> null,
        "distance_from"=> null,
        "distance_to"=> null,
        "elevation_from"=> null,
        "elevation_to"=> null
        ];
        Auth::logout(); // act as guest - only 2 races within bounds
        $response = $this->call('get',route('events.in.bounds'),$payload);
        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $this->actingAs($this->users[2]);
        // RIDES AND RACES - 7 WITHIN BOUNDS
       $response = $this->call('get',route('events.in.bounds'),$payload);
       $response->assertStatus(200);
       $response->assertJsonCount(7);
       $payload['is_race'] = 1; // ONLY RIDES - 5 WITHIN BOUNDS
        $response = $this->call('get',route('events.in.bounds'),$payload);
        $response->assertStatus(200);
        $response->assertJsonCount(5);
        $payload['is_race'] = 2;// ONLY RACES - 2 WITHIN BOUNDS
        $response = $this->call('get',route('events.in.bounds'),$payload);
        $response->assertStatus(200);
        $response->assertJsonCount(2);


    }

}
