<?php

namespace Tests\Feature;

use App\Models\Race;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class DeleteRaceTest extends TestCase
{
    use RefreshDatabase;

    private $users;
    private $race;
    public function setUp():void{
        parent::setUp();
        $this->seed();
        $this->users = User::factory()->count(2)->create();
        $this->actingAs($this->users[0]);
        $this->race = Race::factory()->byUser($this->users[0])->create();
        }

    public function test_owner_of_the_race_can_delete_empty_race()
    {
        $this->assertDatabaseCount('races',1);
        $response = $this->actingAs($this->users[0])->delete(route('race.destroy',$this->race));
        $response->assertStatus(302);
        $this->assertDatabaseCount('races',0);
    }
    public function test_owner_of_the_race_can_delete_race_with_participants()
    {
        $this->assertDatabaseCount('races',1);
        $this->users[1]->joinRace($this->race);
        $this->assertDatabaseCount('participants',1);
        $this->delete(route('race.destroy',$this->race));
        $this->assertDatabaseCount('participants',0);
        $this->assertDatabaseCount('users',2);
        $this->assertDatabaseCount('races',0);
    }
    public function test_user_cannot_delete_someone_else_race()
    {
        $this->assertDatabaseCount('races',1);
        $response = $this->actingAs($this->users[1])->delete(route('race.destroy',$this->race));
        $response->assertStatus(403);
        $this->assertDatabaseCount('races',1);
    }
}
