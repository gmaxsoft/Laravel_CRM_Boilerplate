<?php

namespace Tests\Unit\Modules\Advertisements;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Advertisements\Models\Advertisement;
use Tests\TestCase;

class AdvertisementModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_advertisement_has_fillable_attributes(): void
    {
        $adv = new Advertisement;
        $this->assertContains('adv_model', $adv->getFillable());
        $this->assertContains('adv_price', $adv->getFillable());
        $this->assertContains('adv_machine_type', $adv->getFillable());
    }

    public function test_advertisement_uses_correct_table_and_primary_key(): void
    {
        $adv = new Advertisement;
        $this->assertSame('crm_advertisements', $adv->getTable());
        $this->assertSame('adv_id', $adv->getKeyName());
    }
}
