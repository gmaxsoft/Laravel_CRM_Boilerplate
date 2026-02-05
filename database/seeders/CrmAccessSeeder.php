<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CrmAccessSeeder extends Seeder
{
    /**
     * Zasilanie poziomów dostępu (crm_access).
     */
    public function run(): void
    {
        DB::table('crm_access')->insert([
            [
                'id' => 1,
                'name' => 'ADMINISTRATOR',
                'level' => 1,
                'position' => 1,
                'created_at' => '2024-02-03 00:50:06',
                'update_at' => null,
            ],
            [
                'id' => 2,
                'name' => 'DYREKTOR',
                'level' => 2,
                'position' => 2,
                'created_at' => '2024-02-03 00:50:18',
                'update_at' => null,
            ],
            [
                'id' => 3,
                'name' => 'KIEROWNIK SPRZEDAŻY',
                'level' => 3,
                'position' => 3,
                'created_at' => '2024-02-03 00:50:25',
                'update_at' => null,
            ],
            [
                'id' => 4,
                'name' => 'KIEROWNIK FINANSOWY',
                'level' => 4,
                'position' => 4,
                'created_at' => '2024-02-03 00:50:33',
                'update_at' => null,
            ],
            [
                'id' => 5,
                'name' => 'HANDLOWIEC',
                'level' => 5,
                'position' => 5,
                'created_at' => '2024-02-03 00:50:45',
                'update_at' => null,
            ],
            [
                'id' => 6,
                'name' => 'HANDLOWIEC ZEWNĘTRZNY',
                'level' => 6,
                'position' => 6,
                'created_at' => '2024-02-03 00:50:53',
                'update_at' => '2024-02-03 00:51:12',
            ],
            [
                'id' => 7,
                'name' => 'PRACOWNIK ADMINISTRACJI',
                'level' => 7,
                'position' => 7,
                'created_at' => '2024-04-04 13:16:10',
                'update_at' => null,
            ],
        ]);
    }
}
