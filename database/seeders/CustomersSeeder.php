<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Customers\Models\Customer;
use Modules\Users\Models\User;

class CustomersSeeder extends Seeder
{
    /**
     * Zasilanie klientów (crm_customers_db).
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('pl_PL');
        $traders = User::whereIn('user_level', [1, 5, 6, 7])->pluck('id')->toArray();
        $areas = ['Dolnośląskie', 'Kujawsko-Pomorskie', 'Lubelskie', 'Lubuskie', 'Łódzkie', 'Małopolskie', 'Mazowieckie', 'Opolskie', 'Podkarpackie', 'Podlaskie', 'Pomorskie', 'Śląskie', 'Świętokrzyskie', 'Warmińsko-Mazurskie', 'Wielkopolskie', 'Zachodniopomorskie'];
        $legalForms = ['Produkcja roślinna', 'Produkcja zwierzęca', 'Usługodawca', 'Firma komunalna', 'Handel', 'Przemysł', 'Przetwórstwo', 'Inne'];
        $rodoOptions = ['Tak', 'Nie'];

        for ($i = 1; $i <= 100; $i++) {
            Customer::create([
                'customers_code' => $faker->unique()->numberBetween(1000, 9999),
                'customers_firmname' => $faker->company(),
                'customers_firstname' => $faker->firstName(),
                'customers_lastname' => $faker->lastName(),
                'customers_phone' => $faker->numerify('#########'),
                'customers_email' => $faker->unique()->safeEmail(),
                'customers_rodo' => $faker->randomElement($rodoOptions),
                'customers_adres' => $faker->streetAddress(),
                'customers_city' => $faker->city(),
                'customers_postcode' => $faker->postcode(),
                'customers_area' => $faker->randomElement($areas),
                'customers_county' => $faker->city(),
                'customers_community' => $faker->city(),
                'customers_postoffice' => $faker->city(),
                'customers_country' => 'Polska',
                'customers_legalform' => $faker->randomElement($legalForms),
                'customers_regon' => $faker->numerify('#########'),
                'customers_nip' => $faker->numerify('##########'),
                'customers_krs' => $faker->optional()->numerify('########'),
                'customers_trader_id' => ! empty($traders) ? $faker->randomElement($traders) : null,
                'customers_agricultural_land' => $faker->optional()->numerify('##'),
                'customers_aditional' => $faker->optional()->text(500),
                'customers_type' => '0',
                'customers_active' => '0',
                'customers_re_contact_date' => $faker->optional(0.3)->dateTimeBetween('now', '+1 year')?->format('Y-m-d'),
                'customers_re_contact_date_cron' => 0,
                'customers_sp_email' => $faker->boolean() ? 1 : 0,
                'customers_sp_sms' => $faker->boolean() ? 1 : 0,
                'customers_sp_phone' => $faker->boolean() ? 1 : 0,
                'customers_sp_postoffice' => $faker->boolean() ? 1 : 0,
                'customers_adddate' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
