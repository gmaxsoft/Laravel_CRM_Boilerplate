<?php

namespace Modules\Users\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Models\User;

/**
 * Fabryka użytkowników CRM (tabela crm_users).
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Users\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password = null;

    protected $model = User::class;

    /** Domyślne atrybuty użytkownika. */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'phone' => fake()->optional(0.7)->numerify('###-###-###'),
            'user_level' => 1,
            'active' => '1',
        ];
    }

    /** Stan: poziom uprawnień (user_level). */
    public function level(int $level): static
    {
        return $this->state(fn (array $attributes) => [
            'user_level' => $level,
        ]);
    }
}
