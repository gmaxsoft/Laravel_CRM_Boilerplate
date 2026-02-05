<?php

namespace Tests\Unit\Modules\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Users\Models\User;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_fillable_attributes(): void
    {
        $user = new User;
        $this->assertContains('first_name', $user->getFillable());
        $this->assertContains('last_name', $user->getFillable());
        $this->assertContains('email', $user->getFillable());
        $this->assertContains('user_level', $user->getFillable());
    }

    public function test_user_can_be_created_with_factory(): void
    {
        $user = User::factory()->create([
            'first_name' => 'Jan',
            'last_name' => 'Kowalski',
            'email' => 'jan@example.com',
        ]);
        $this->assertDatabaseHas('crm_users', ['email' => 'jan@example.com']);
        $this->assertSame('Jan', $user->first_name);
    }

    public function test_user_has_access_relation(): void
    {
        $user = new User;
        $this->assertTrue(method_exists($user, 'access'));
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $user->access());
    }
}
