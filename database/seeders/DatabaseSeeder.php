<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Zasilanie bazy danych aplikacji.
     */
    public function run(): void
    {
        // Użytkownicy są w module Users (Modules\Users\Models\User), tabela crm_users.
    }
}
