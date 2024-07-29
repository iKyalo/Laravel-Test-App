<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_a_list_of_users()
    {
        $users = User::factory()->count(3)->create();

        $response = $this->get('/users');

        $response->assertStatus(200);
        $response->assertViewHas('users', $users);
    }

    /** @test */
    public function it_loads_the_user_creation_form()
    {
        $response = $this->get('/users/create');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_stores_a_new_user()
    {
        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        $response->assertRedirect('/users');
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => 'admin',
        ]);

        // Verify password is hashed
        $user = User::where('email', 'john@example.com')->first();
        $this->assertTrue(Hash::check('password123', $user->password));
    }

    /** @test */
    public function it_loads_the_user_edit_form()
    {
        $user = User::factory()->create();

        $response = $this->get("/users/{$user->id}/edit");

        $response->assertStatus(200);
        $response->assertViewHas('user', $user);
    }

    /** @test */
    public function it_updates_a_user()
    {
        $user = User::factory()->create();

        $response = $this->put("/users/{$user->id}", [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'role' => 'editor',
        ]);

        $response->assertRedirect('/users');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'role' => 'editor',
        ]);
    }

    /** @test */
    public function it_deletes_a_user()
    {
        $user = User::factory()->create();

        $response = $this->delete('/users', ['user_id' => $user->id]);

        $response->assertRedirect('/users');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
