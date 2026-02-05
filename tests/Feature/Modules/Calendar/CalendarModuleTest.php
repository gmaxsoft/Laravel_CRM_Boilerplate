<?php

namespace Tests\Feature\Modules\Calendar;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Users\Models\User;
use Tests\TestCase;

class CalendarModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_calendar_index_requires_authentication(): void
    {
        $response = $this->get(route('calendar.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_calendar_index_returns_200_for_authenticated_user(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('calendar.index'));
        $response->assertStatus(200);
    }

    public function test_calendar_json_returns_json(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('calendar.json'));
        $response->assertStatus(200);
    }
}
