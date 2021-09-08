<?php

namespace Tests\Feature;

use App\Models\Race;
use App\Models\Ride;
use App\Models\User;
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

}
