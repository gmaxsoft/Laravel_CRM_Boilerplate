<?php

namespace Tests\Unit\Modules\Calendar;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Calendar\Models\CalendarCategory;
use Tests\TestCase;

class CalendarCategoryModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_calendar_category_has_fillable_attributes(): void
    {
        $cat = new CalendarCategory;
        $this->assertContains('cal_cat_name', $cat->getFillable());
        $this->assertContains('cal_cat_value', $cat->getFillable());
        $this->assertContains('cal_cat_position', $cat->getFillable());
    }

    public function test_calendar_category_can_be_created(): void
    {
        $cat = CalendarCategory::create([
            'cal_cat_name' => 'Spotkanie',
            'cal_cat_value' => 'bg-primary',
            'cal_cat_color' => 'Niebieski',
            'cal_cat_position' => 1,
            'cal_created_at' => now(),
            'cal_update_at' => now(),
        ]);
        $this->assertDatabaseHas('crm_calendar_category', ['cal_cat_name' => 'Spotkanie']);
    }
}
