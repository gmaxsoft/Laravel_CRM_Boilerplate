<?php

namespace Tests\Feature\Modules\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Users\Models\User;
use Tests\TestCase;

class UsersModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_index_requires_authentication(): void
    {
        $response = $this->get(route('users.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_users_index_returns_200_for_authenticated_user(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('users.index'));
        $response->assertStatus(200);
    }

    public function test_users_grid_returns_json(): void
    {
        $user = User::factory()->level(1)->create();
        $response = $this->actingAs($user)->get(route('users.grid'));
        $response->assertStatus(200);
        $this->assertIsArray(json_decode($response->getContent(), true));
    }
}
