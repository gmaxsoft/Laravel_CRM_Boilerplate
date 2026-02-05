<?php

namespace Modules\Customers\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Customers\Models\Customer;
use Modules\Users\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Customers\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'customers_firstname' => fake()->firstName(),
            'customers_lastname' => fake()->lastName(),
            'customers_firmname' => fake()->optional(0.5)->company(),
            'customers_phone' => fake()->phoneNumber(),
            'customers_email' => fake()->optional(0.8)->safeEmail(),
            'customers_adres' => fake()->streetAddress(),
            'customers_city' => fake()->city(),
            'customers_postcode' => fake()->postcode(),
            'customers_area' => fake()->optional()->state(),
            'customers_county' => fake()->optional()->city(),
            'customers_community' => fake()->optional()->city(),
            'customers_postoffice' => fake()->optional()->city(),
            'customers_country' => 'Polska',
            'customers_regon' => fake()->optional(0.3)->numerify('##########'),
            'customers_nip' => fake()->optional(0.3)->numerify('##########'),
            'customers_krs' => fake()->optional(0.2)->numerify('##########'),
            'customers_legalform' => fake()->optional(0.4)->randomElement(['Sp. z o.o.', 'Sp. j.', 'SA']),
            'customers_agricultural_land' => fake()->optional(0.3)->numerify('##.##'),
            'customers_rodo' => fake()->optional(0.5)->randomElement(['Tak', 'Nie']),
            'customers_aditional' => fake()->optional(0.3)->text(),
            'customers_trader_id' => User::factory(),
            'customers_re_contact_date' => fake()->optional(0.4)->date(),
            'customers_sp_email' => fake()->boolean(30),
            'customers_sp_sms' => fake()->boolean(20),
            'customers_sp_phone' => fake()->boolean(25),
            'customers_sp_postoffice' => fake()->boolean(15),
            'customers_active' => '0',
            'customers_type' => '0',
            'customers_adddate' => now(),
        ];
    }
}
