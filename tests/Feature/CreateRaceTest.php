<?php

namespace Tests\Feature;

use App\Models\Race;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CreateRaceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp():void{
        parent::setUp();
        $this->seed();

    }
    public function test_verified_user_can_create_race(){
        User::factory()->create();
        $user = Auth::loginUsingId(1);
        $this->actingAs($user);
        $race = Race::factory()->make()->toArray();
        $response = $this->post(route('race.store'),$race);
        $response->assertStatus(302);
        $this->assertDatabaseCount('races',1);
        $this->assertEquals(Race::first()->distance , $race['distance']);
        $this->assertEquals(Race::first()->user_id , Auth::id());
    }
    public function test_verified_user_can_create_race_end_location_not_given(){
        User::factory()->create();
        $user = Auth::loginUsingId(1);
        $this->actingAs($user);
        $race = Race::factory()->withoutEndLocation()->make()->toArray();
        $response = $this->post(route('race.store'),$race);
        $response->assertStatus(302);
        $this->assertDatabaseCount('races',1);
        $this->assertEquals(Race::first()->distance , $race['distance']);
        $this->assertEquals(Race::first()->user_id , Auth::id());
        $this->assertEquals(Race::first()->end_location_lat , $race['start_location_lat']);
    }
    public function test_guest_cannot_create_race(){
        $race = Race::factory()->make()->toArray();
        $response = $this->post(route('race.store'),$race);
        $response->assertStatus(302)->assertRedirect('/login');
        $this->assertDatabaseCount('races',0);
    }
    public function test_unverified_user_cannot_create_race(){
        User::factory()->unverified()->create();
        $user = Auth::loginUsingId(1);
        $this->actingAs($user);
        $race = Race::factory()->make()->toArray();
        $response = $this->post(route('race.store'),$race);
        $response->assertStatus(302);
        $this->assertDatabaseCount('races',0);
    }

}
