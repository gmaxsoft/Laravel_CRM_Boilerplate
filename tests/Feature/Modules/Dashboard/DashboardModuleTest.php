<?php

namespace Tests\Feature\Modules\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Users\Models\User;
use Tests\TestCase;

class DashboardModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_requires_authentication(): void
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_dashboard_returns_200_for_authenticated_user(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertStatus(200);
        $response->assertViewHas('user');
        $response->assertViewHas('stats');
    }

    public function test_dashboard_stats_contain_expected_keys(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertViewHas('stats');
        $stats = $response->viewData('stats');
        $this->assertArrayHasKey('customers', $stats);
        $this->assertArrayHasKey('advertisements', $stats);
        $this->assertArrayHasKey('calendar_events', $stats);
        $this->assertArrayHasKey('users', $stats);
    }
}
