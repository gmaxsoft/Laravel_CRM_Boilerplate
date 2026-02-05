<?php

namespace Tests\Feature\Modules\Access;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Users\Models\User;
use Tests\TestCase;

class AccessModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_access_index_requires_authentication(): void
    {
        $response = $this->get('/module/access');
        $response->assertRedirect(route('login'));
    }

    public function test_access_index_returns_200_for_authorized_user(): void
    {
        $user = User::factory()->level(1)->create();
        $response = $this->actingAs($user)->get(route('access.index'));
        $response->assertStatus(200);
    }

    public function test_access_grid_returns_json_for_authorized_user(): void
    {
        $user = User::factory()->level(1)->create();
        $response = $this->actingAs($user)->get(route('access.grid'));
        $response->assertStatus(200);
        $response->assertJsonStructure([]);
    }

    public function test_access_grid_returns_403_for_low_level_user(): void
    {
        $user = User::factory()->level(10)->create();
        $response = $this->actingAs($user)->get(route('access.grid'));
        $response->assertStatus(403);
    }
}
