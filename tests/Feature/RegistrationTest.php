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
        $this->post('/register', $user);
        $this->get('/home')->assertStatus(302)->assertRedirect('email/verify');
        array_splice($user,2,2);
        $this->assertDatabaseHas('users', $user);
        $user = User::first();
        $user->email_verified_at = now();
        $this->actingAs($user)->get('home')->assertStatus(200);
        $this->assertNotNull(User::first()->preferences);
        $this->assertTrue(User::first()->type->name == 'standard');
    }
}
