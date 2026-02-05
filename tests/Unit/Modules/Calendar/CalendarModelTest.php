<?php

namespace Tests\Unit\Modules\Calendar;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Calendar\Models\Calendar;
use Tests\TestCase;

class CalendarModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_calendar_has_fillable_attributes(): void
    {
        $cal = new Calendar;
        $this->assertContains('cal_name', $cal->getFillable());
        $this->assertContains('cal_start', $cal->getFillable());
        $this->assertContains('cal_end', $cal->getFillable());
    }

    public function test_calendar_has_user_relation(): void
    {
        $cal = new Calendar;
        $this->assertTrue(method_exists($cal, 'user'));
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $cal->user());
    }
}
