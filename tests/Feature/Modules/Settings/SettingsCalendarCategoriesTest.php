<?php

namespace Tests\Feature\Modules\Settings;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Users\Models\User;
use Tests\TestCase;

class SettingsCalendarCategoriesTest extends TestCase
{
    use RefreshDatabase;

    public function test_calendar_categories_index_requires_authentication(): void
    {
        $response = $this->get(route('settings.calendar-categories.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_calendar_categories_index_returns_200_for_authorized_user(): void
    {
        $user = User::factory()->level(1)->create();
        $response = $this->actingAs($user)->get(route('settings.calendar-categories.index'));
        $response->assertStatus(200);
    }

    public function test_calendar_categories_index_returns_403_for_unauthorized_user(): void
    {
        $user = User::factory()->level(10)->create();
        $response = $this->actingAs($user)->get(route('settings.calendar-categories.index'));
        $response->assertStatus(403);
    }

    public function test_calendar_categories_grid_returns_json(): void
    {
        $user = User::factory()->level(1)->create();
        $response = $this->actingAs($user)->get('/module/settings/calendar-categories/grid');
        $response->assertStatus(200);
        $this->assertIsArray(json_decode($response->getContent(), true));
    }
}
