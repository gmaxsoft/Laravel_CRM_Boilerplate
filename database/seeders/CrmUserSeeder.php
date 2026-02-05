<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Models\User;

class CrmUserSeeder extends Seeder
{
    /**
     * Zasilanie tabeli użytkowników CRM (crm_users).
     */
    public function run(): void
    {
        User::create([
            'first_name' => env('ADMIN_FIRST_NAME', 'Administrator'),
            'last_name' => env('ADMIN_LAST_NAME', 'System'),
            'email' => env('ADMIN_EMAIL', 'admin@example.com'),
            'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
            'user_level' => (int) env('ADMIN_USER_LEVEL', 1),
            'active' => env('ADMIN_ACTIVE', '1'),
        ]);
    }
}
