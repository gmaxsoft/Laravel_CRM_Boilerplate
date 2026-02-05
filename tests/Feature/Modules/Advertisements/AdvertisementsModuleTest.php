<?php

namespace Tests\Feature\Modules\Advertisements;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Users\Models\User;
use Tests\TestCase;

class AdvertisementsModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_advertisements_index_requires_authentication(): void
    {
        $response = $this->get(route('advertisements.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_advertisements_index_returns_200_for_authenticated_user(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('advertisements.index'));
        $response->assertStatus(200);
    }

    public function test_advertisements_grid_returns_json(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('advertisements.grid'));
        $response->assertStatus(200);
        $this->assertIsArray(json_decode($response->getContent(), true));
    }
}
