<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected  $user;

    public function test_registration(){
        $this->seed();
        $user = ['name'=> "John",
                'email' => 'testemail@test.com',
                'password' => 'passwordtest',
                'password_confirmation' => 'passwordtest'
            ];
        $response = $this->post('/register', $user);
        $response->assertRedirect('/home')->assertStatus(302);
        array_splice($user,2,2);
        $this->assertDatabaseHas('users', $user);

    }
    public function test_user_has_preferences(){
        $this->assertNotNull(User::first()->preferences);
    }
    public function test_user_is_standard(){
        $this->assertTrue(User::first()->type->name == 'standard');
    }

}
