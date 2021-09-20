<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCanFollowUsersTest extends TestCase
{
    use RefreshDatabase;
    protected $users;
    use WithFaker;
    public function setUp():void{
        parent::setUp();
        $this->setUpFaker();
        $this->seed();
        $this->users = User::factory()->count(10)->create();
    }
    public function test_verified_user_can_access_user_search(){
        $this->actingAs($this->users->first());
        $this->get(route('users.index'))->assertStatus(200);
        if(strlen($this->users[1]->name)<3) {
            $this->users[1]->name = 'aa';
        }
        $this->get(route('users.find',['name'=>substr($this->users[1]->name,1,3)]))->assertStatus(200)->assertSee($this->users[1]->name);
        $this->get(route('users.find',['name'=>$this->faker->text(30)]))->assertStatus(200)->assertSee('No users found');
    }
    public function test_guest_cannot_access_user_search(){
        $this->get(route('users.index'))->assertStatus(302)->assertRedirect(route('login'));
    }

}
