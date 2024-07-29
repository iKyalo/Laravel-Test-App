<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fetch_all_users()
    {
        $users = User::factory()->count(3)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200);
        $response->assertJson($users->toArray());
    }

    /** @test */
    public function it_can_fetch_a_single_user()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");

        $response->assertStatus(200);
        $response->assertJson($user->toArray());
    }

    /** @test */
    public function it_returns_404_if_user_not_found()
    {
        $response = $this->getJson('/api/users/9999');

        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'User not found'
        ]);
    }

    /** @test */
    public function it_can_create_a_user()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => 'admin',
            'password' => 'password123',
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => 'admin',
        ]);

        // Verify password is hashed
        $user = User::where('email', 'john@example.com')->first();
        $this->assertTrue(Hash::check('password123', $user->password));
    }

    /** @test */
    public function it_can_update_a_user()
    {
        $user = User::factory()->create();

        $response = $this->putJson("/api/users/{$user->id}", [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'role' => 'editor',
            'password' => 'newpassword123',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'role' => 'editor',
        ]);

        // Verify password is updated
        $user->refresh();
        $this->assertTrue(Hash::check('newpassword123', $user->password));
    }

    /** @test */
    public function it_returns_404_if_user_not_found_on_update()
    {
        $response = $this->putJson('/api/users/9999', [
            'name' => 'Nonexistent User',
        ]);

        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'User not found'
        ]);
    }

    /** @test */
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/users/{$user->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'User deleted successfully'
        ]);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** @test */
    public function it_returns_404_if_user_not_found_on_delete()
    {
        $response = $this->deleteJson('/api/users/9999');

        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'User not found'
        ]);
    }
}
