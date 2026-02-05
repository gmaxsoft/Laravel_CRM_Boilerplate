<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Advertisements\Models\Advertisement;
use Modules\Users\Models\User;

class AdvertisementsSeeder extends Seeder
{
    /**
     * Zasilanie ogłoszeń (crm_advertisements).
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('pl_PL');

        // Pobierz dane z tabel pomocniczych
        $machines = DB::table('crm_machines')->pluck('id')->toArray();
        $producers = DB::table('crm_producers')->pluck('id')->toArray();
        $locations = DB::table('crm_location')->pluck('name')->toArray();
        $stans = DB::table('crm_stan')->pluck('name')->toArray();
        $traders = User::whereIn('user_level', [1, 5, 6, 7])->pluck('id')->toArray();

        // Jeśli nie ma danych w tabelach pomocniczych, użyj wartości domyślnych
        if (empty($machines)) {
            $machines = [1, 2, 3];
        }
        if (empty($producers)) {
            $producers = [1, 2, 3];
        }
        if (empty($locations)) {
            $locations = ['Warszawa', 'Kraków', 'Wrocław', 'Poznań', 'Gdańsk'];
        }
        if (empty($stans)) {
            $stans = ['Nowe', 'Używane'];
        }

        $statuses = ['Wolne', 'Rezerwacja', 'Wynajem', 'Sprzedane', 'Fakturowane'];
        $reservations = [0, 1, 2, 4]; // 0=Wyświetlone, 1=Rezerwacja, 2=Wkrótce, 4=Nie wyświetlone
        $models = ['Model A', 'Model B', 'Model C', 'Model D', 'Model E', 'Model F', 'Model G', 'Model H'];
        $gears = ['Manualna', 'Automatyczna', 'CVT', 'DSG'];

        // Pobierz maksymalną pozycję
        $maxPosition = Advertisement::where('adv_magazyn_type', '0')->max('adv_position') ?? 0;

        for ($i = 1; $i <= 50; $i++) {
            $machineId = $faker->randomElement($machines);
            $producerId = $faker->randomElement($producers);
            $model = $faker->randomElement($models).' '.$faker->numberBetween(100, 999);
            $year = $faker->numberBetween(2015, 2024);
            $reservation = $faker->randomElement($reservations);
            $status = match ($reservation) {
                1 => 'Rezerwacja',
                2 => 'Wkrótce',
                0 => 'Wolne',
                default => $faker->randomElement($statuses),
            };
            $active = ($reservation == 2) ? '0' : '1';

            // Pobierz nazwy dla machine_name
            $machineName = DB::table('crm_machines')->where('id', $machineId)->value('name') ?? 'Maszyna';
            $producerName = DB::table('crm_producers')->where('id', $producerId)->value('name') ?? 'Producent';
            $machineNameFull = trim($machineName.' '.$producerName.' '.$model);

            $position = $maxPosition + $i;

            Advertisement::create([
                'adv_status' => $status,
                'adv_reservation' => $reservation,
                'adv_machine_name' => $machineNameFull,
                'adv_machine_type' => $machineId,
                'adv_producer' => $producerId,
                'adv_state' => $faker->randomElement($stans),
                'adv_price' => $faker->numberBetween(50000, 500000),
                'adv_price_netto' => $faker->numberBetween(40000, 400000),
                'adv_location' => $faker->randomElement($locations),
                'adv_model' => $model,
                'adv_year' => (string) $year,
                'adv_mileage' => $faker->optional(0.7)->numberBetween(0, 500000),
                'adv_power' => $faker->optional(0.8)->numberBetween(50, 500).' KM',
                'adv_gear' => $faker->optional(0.6)->randomElement($gears),
                'adv_register' => $faker->optional(0.3)->regexify('[A-Z]{2,3}[0-9]{4,5}'),
                'adv_warranty_start' => $faker->optional(0.4)->dateTimeBetween('-2 years', 'now')?->format('Y-m-d'),
                'adv_warranty_end' => $faker->optional(0.4)->dateTimeBetween('now', '+2 years')?->format('Y-m-d'),
                'adv_additional' => $faker->optional(0.5)->text(500),
                'adv_serial_number' => $faker->optional(0.6)->bothify('VIN#########'),
                'adv_internal_order_number' => $faker->optional(0.5)->numerify('ZAM-####'),
                'adv_producer_order_number' => $faker->optional(0.4)->numerify('PROD-####'),
                'adv_production_date' => $faker->optional(0.5)->dateTimeBetween('-5 years', 'now')?->format('Y-m-d'),
                'adv_comments' => $faker->optional(0.4)->text(200),
                'adv_comments_additional' => $faker->optional(0.3)->text(300),
                'adv_comments_info' => $faker->optional(0.3)->text(300),
                'adv_order_price' => $faker->optional(0.4)->numberBetween(30000, 300000),
                'adv_active' => $active,
                'adv_demo' => $faker->boolean(20) ? '1' : '0',
                'adv_promo' => $faker->boolean(15) ? '1' : '0',
                'adv_warranty' => $faker->boolean(25) ? '1' : '0',
                'adv_finances' => $faker->boolean(10) ? '1' : '0',
                'adv_position' => $position,
                'adv_magazyn_type' => '0',
                'adv_trader_id' => ! empty($traders) ? $faker->optional(0.6)->randomElement($traders) : null,
                'adv_reservation_user_id' => ! empty($traders) && $reservation == 1 ? $faker->randomElement($traders) : null,
                'adv_order_date' => $faker->optional(0.3)->dateTimeBetween('-1 year', 'now')?->format('Y-m-d'),
                'adv_fv_nr' => $faker->optional(0.2)->numerify('FV/####/####'),
                'adv_created_at' => $faker->dateTimeBetween('-6 months', 'now'),
            ]);
        }
    }
}
