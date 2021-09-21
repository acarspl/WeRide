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
        $this->get(route('users.find',['name'=>substr($this->users[1]->name,1,4)]))->assertStatus(200)->assertSee($this->users[1]->name);
        $this->get(route('users.find',['name'=>$this->faker->text(30)]))->assertStatus(200)->assertSee('No users found');
    }
    public function test_guest_cannot_access_user_search(){
        $this->get(route('users.index'))->assertStatus(302)->assertRedirect(route('login'));
    }
    public function test_user_can_follow_other_user(){
        $this->actingAs($this->users[0]);
        $this->post(route('users.follow',$this->users[1]))->assertStatus(200);
        $this->assertDatabaseCount('followers',1);
        $this->assertTrue($this->users[0]->isFollowing($this->users[1]));
        $this->assertTrue($this->users[1]->followers()->count()===1);
    }
    public function test_user_cannot_follow_other_user_when_already_following(){
        $this->actingAs($this->users[0]);
        $this->post(route('users.follow',$this->users[1]))->assertStatus(200);
        $this->assertDatabaseCount('followers',1);
        $this->post(route('users.follow',$this->users[1]))->assertStatus(403);
        $this->assertDatabaseCount('followers',1);
    }
    public function test_user_cannot_follow_itself(){
        $this->actingAs($this->users[0]);
        $this->post(route('users.follow',$this->users[0]))->assertStatus(403);
        $this->assertDatabaseCount('followers',0);
    }
    public function test_user_can_unfollow_following_user(){
        $this->actingAs($this->users[0]);
        $this->post(route('users.follow',$this->users[1]))->assertStatus(200);
        $this->assertDatabaseCount('followers',1);
        $this->delete(route('users.unfollow',$this->users[1]))->assertStatus(200);
        $this->assertDatabaseCount('followers',0);
        $this->assertFalse($this->users[0]->isFollowing($this->users[1]));
        $this->assertTrue($this->users[1]->followers()->count()===0);
    }
    public function test_user_cannot_unfollow_not_followed_user(){
        $this->actingAs($this->users[0]);
        $this->delete(route('users.unfollow',$this->users[1]))->assertStatus(403);
    }

}
