<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Calendar\Models\Calendar;
use Modules\Users\Models\User;

class CalendarSeeder extends Seeder
{
    /**
     * Zasilanie wydarzeń kalendarza (crm_calendar).
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('pl_PL');

        // Pobierz kategorie z bazy danych wraz z nazwami i kolorami
        $categoryData = DB::table('crm_calendar_category')
            ->orderBy('cal_cat_position')
            ->get(['cal_cat_value', 'cal_cat_name', 'cal_cat_color']);

        // Jeśli nie ma kategorii, użyj domyślnych
        if ($categoryData->isEmpty()) {
            $categoryData = collect([
                (object) ['cal_cat_value' => 'bg-primary', 'cal_cat_name' => 'Wydarzenie ogólne', 'cal_cat_color' => '#727cf5'],
                (object) ['cal_cat_value' => 'bg-success', 'cal_cat_name' => 'Urlop', 'cal_cat_color' => '#0acf97'],
                (object) ['cal_cat_value' => 'bg-info', 'cal_cat_name' => 'Targi i wystawy', 'cal_cat_color' => '#39afd1'],
                (object) ['cal_cat_value' => 'bg-warning', 'cal_cat_name' => 'Spotkanie z klientem', 'cal_cat_color' => '#ffbc00'],
                (object) ['cal_cat_value' => 'bg-danger', 'cal_cat_name' => 'Konferencja', 'cal_cat_color' => '#fa5c7c'],
            ]);
        }

        $categories = $categoryData->pluck('cal_cat_value')->toArray();

        // Pobierz użytkowników
        $users = User::pluck('id')->toArray();
        if (empty($users)) {
            $users = [1]; // Fallback do użytkownika ID 1
        }

        // Generuj wydarzenia na luty i marzec 2026
        $currentMonth = now()->month; // Luty = 2
        $nextMonth = $currentMonth + 1; // Marzec = 3
        $year = now()->year; // 2026

        // Mapowanie nazw kategorii na tytuły wydarzeń
        $categoryEventMap = [];
        foreach ($categoryData as $cat) {
            $categoryEventMap[$cat->cal_cat_value] = [
                'name' => $cat->cal_cat_name,
                'events' => $this->getEventsForCategory($cat->cal_cat_name),
            ];
        }

        // Domyślne tytuły wydarzeń jeśli nie ma mapowania
        $defaultEventTitles = [
            'Spotkanie z klientem',
            'Prezentacja produktu',
            'Szkolenie zespołu',
            'Wizyta u klienta',
            'Spotkanie biznesowe',
            'Konferencja',
            'Warsztaty',
            'Spotkanie projektowe',
            'Konsultacje',
            'Weryfikacja dokumentów',
            'Spotkanie z dostawcą',
            'Audyt',
            'Spotkanie z zarządem',
            'Prezentacja wyników',
            'Spotkanie techniczne',
            'Spotkanie sprzedażowe',
            'Spotkanie marketingowe',
            'Spotkanie HR',
            'Spotkanie finansowe',
            'Spotkanie operacyjne',
        ];

        $annotations = [
            'Ważne spotkanie wymagające przygotowania',
            'Proszę przygotować prezentację',
            'Spotkanie wymaga obecności wszystkich członków zespołu',
            'Proszę przynieść dokumenty',
            'Spotkanie online',
            'Spotkanie w biurze',
            'Spotkanie u klienta',
            'Wymagana wcześniejsza rezerwacja sali',
            'Spotkanie z caterem',
            'Spotkanie z tłumaczem',
            null, // Czasami bez uwag
            null,
            null,
        ];

        $eventsCreated = 0;
        $maxEvents = 50;

        // Generuj wydarzenia dla lutego i marca
        foreach ([$currentMonth, $nextMonth] as $month) {
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            // Generuj około 25 wydarzeń na miesiąc (lub mniej jeśli już mamy 50)
            $eventsPerMonth = min(25, $maxEvents - $eventsCreated);

            for ($i = 0; $i < $eventsPerMonth && $eventsCreated < $maxEvents; $i++) {
                $day = $faker->numberBetween(1, $daysInMonth);
                $hour = $faker->numberBetween(8, 18);
                $minute = $faker->randomElement([0, 15, 30, 45]);

                $startDate = sprintf('%04d-%02d-%02d %02d:%02d:00', $year, $month, $day, $hour, $minute);

                // Czas trwania: 30 minut do 4 godzin
                $duration = $faker->randomElement([30, 60, 90, 120, 180, 240]);
                $endDateTime = date('Y-m-d H:i:s', strtotime($startDate.' +'.$duration.' minutes'));

                $selectedCategory = $faker->randomElement($categories);
                $categoryInfo = $categoryData->firstWhere('cal_cat_value', $selectedCategory);
                $eventTitles = $categoryEventMap[$selectedCategory]['events'] ?? $defaultEventTitles;

                Calendar::create([
                    'cal_name' => $faker->randomElement($eventTitles).($faker->boolean(30) ? ' - '.$faker->company() : ''),
                    'cal_category' => $selectedCategory,
                    'cal_start' => $startDate,
                    'cal_end' => $endDateTime,
                    'cal_annotations' => $faker->optional(0.6)->randomElement($annotations),
                    'cal_user_id' => $faker->randomElement($users),
                    'created_at' => $faker->dateTimeBetween('-1 month', 'now'),
                ]);

                $eventsCreated++;
            }
        }

        // Jeśli jeszcze nie mamy 50 wydarzeń, dodaj więcej losowo
        while ($eventsCreated < $maxEvents) {
            $month = $faker->randomElement([$currentMonth, $nextMonth]);
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $day = $faker->numberBetween(1, $daysInMonth);
            $hour = $faker->numberBetween(8, 18);
            $minute = $faker->randomElement([0, 15, 30, 45]);

            $startDate = sprintf('%04d-%02d-%02d %02d:%02d:00', $year, $month, $day, $hour, $minute);
            $duration = $faker->randomElement([30, 60, 90, 120, 180, 240]);
            $endDateTime = date('Y-m-d H:i:s', strtotime($startDate.' +'.$duration.' minutes'));

            $selectedCategory = $faker->randomElement($categories);
            $categoryInfo = $categoryData->firstWhere('cal_cat_value', $selectedCategory);
            $eventTitles = $categoryEventMap[$selectedCategory]['events'] ?? $defaultEventTitles;

            Calendar::create([
                'cal_name' => $faker->randomElement($eventTitles).($faker->boolean(30) ? ' - '.$faker->company() : ''),
                'cal_category' => $selectedCategory,
                'cal_start' => $startDate,
                'cal_end' => $endDateTime,
                'cal_annotations' => $faker->optional(0.6)->randomElement($annotations),
                'cal_user_id' => $faker->randomElement($users),
                'created_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);

            $eventsCreated++;
        }
    }

    /**
     * Zwraca listę tytułów wydarzeń dla danej kategorii
     */
    private function getEventsForCategory(string $categoryName): array
    {
        $categoryEvents = [
            'Wydarzenie ogólne' => [
                'Spotkanie ogólne',
                'Wydarzenie',
                'Spotkanie',
                'Zebranie',
                'Narada',
            ],
            'Urlop' => [
                'Urlop',
                'Dni wolne',
                'Wypoczynek',
            ],
            'Targi i wystawy' => [
                'Targi',
                'Wystawa',
                'Targi branżowe',
                'Wystawa produktów',
                'Targi handlowe',
            ],
            'Spotkanie z klientem' => [
                'Spotkanie z klientem',
                'Wizyta u klienta',
                'Konsultacje z klientem',
                'Prezentacja dla klienta',
            ],
            'Konferencja' => [
                'Konferencja',
                'Seminarium',
                'Sympozjum',
                'Kongres',
            ],
            'Szkolenie' => [
                'Szkolenie',
                'Szkolenie zespołu',
                'Kurs',
                'Warsztaty szkoleniowe',
            ],
            'Spotkanie biznesowe' => [
                'Spotkanie biznesowe',
                'Narada biznesowa',
                'Spotkanie zarządu',
                'Spotkanie strategiczne',
            ],
            'Warsztaty' => [
                'Warsztaty',
                'Warsztaty praktyczne',
                'Sesja warsztatowa',
                'Szkolenie praktyczne',
            ],
        ];

        return $categoryEvents[$categoryName] ?? [
            'Spotkanie',
            'Wydarzenie',
            'Zebranie',
        ];
    }
}
