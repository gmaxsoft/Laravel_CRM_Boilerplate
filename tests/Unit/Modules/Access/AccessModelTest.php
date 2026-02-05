<?php

namespace Tests\Unit\Modules\Access;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Access\Models\Access;
use Tests\TestCase;

class AccessModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_access_has_fillable_attributes(): void
    {
        $access = new Access;
        $this->assertContains('name', $access->getFillable());
        $this->assertContains('level', $access->getFillable());
        $this->assertContains('position', $access->getFillable());
    }

    public function test_access_can_be_created(): void
    {
        $access = Access::create([
            'name' => 'Test Role',
            'level' => 5,
            'position' => 1,
            'created_at' => now(),
            'update_at' => now(),
        ]);
        $this->assertDatabaseHas('crm_access', ['name' => 'Test Role', 'level' => 5]);
        $this->assertSame(5, $access->level);
    }

    public function test_access_has_users_relation(): void
    {
        $access = new Access;
        $this->assertTrue(method_exists($access, 'users'));
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $access->users());
    }
}
