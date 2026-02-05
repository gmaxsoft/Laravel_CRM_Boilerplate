<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarCategorySeeder extends Seeder
{
    /**
     * Zasilanie kategorii kalendarza (crm_calendar_category).
     */
    public function run(): void
    {
        // Sprawdź jakie kategorie są używane w wydarzeniach
        $usedCategories = DB::table('crm_calendar')
            ->distinct()
            ->whereNotNull('cal_category')
            ->pluck('cal_category')
            ->toArray();

        // Definicje wszystkich dostępnych kategorii z unikalnymi kolorami
        $allCategories = [
            ['name' => 'Wydarzenie ogólne', 'value' => 'bg-primary', 'color' => '#727cf5', 'position' => 1],
            ['name' => 'Urlop', 'value' => 'bg-success', 'color' => '#0acf97', 'position' => 2],
            ['name' => 'Targi i wystawy', 'value' => 'bg-info', 'color' => '#39afd1', 'position' => 3],
            ['name' => 'Spotkanie z klientem', 'value' => 'bg-warning', 'color' => '#ffbc00', 'position' => 4],
            ['name' => 'Konferencja', 'value' => 'bg-danger', 'color' => '#fa5c7c', 'position' => 5],
            ['name' => 'Szkolenie', 'value' => 'bg-secondary', 'color' => '#6c757d', 'position' => 6],
            // Dodatkowe kategorie z unikalnymi kolorami
            ['name' => 'Spotkanie biznesowe', 'value' => 'bg-dark', 'color' => '#313a46', 'position' => 7],
            ['name' => 'Warsztaty', 'value' => 'bg-workshop', 'color' => '#ffbc00', 'position' => 8],
        ];

        // Dodaj wszystkie kategorie, ale priorytet dla tych używanych w wydarzeniach
        $categories = [];
        foreach ($allCategories as $cat) {
            $categories[] = $cat;
        }

        // Dodaj brakujące kategorie z wydarzeń (jeśli jakieś nie są w liście)
        $missingCategories = array_diff($usedCategories, array_column($allCategories, 'value'));
        if (! empty($missingCategories)) {
            $additionalColors = [
                '#8b5cf6', // fioletowy
                '#06b6d4', // cyjan
                '#f59e0b', // pomarańczowy
                '#ef4444', // czerwony
                '#10b981', // zielony
                '#3b82f6', // niebieski
                '#ec4899', // różowy
                '#6366f1', // indigo
            ];

            $position = count($allCategories) + 1;
            foreach ($missingCategories as $missingCat) {
                $colorIndex = ($position - count($allCategories) - 1) % count($additionalColors);
                $categories[] = [
                    'name' => ucfirst(str_replace(['bg-', '-'], ['', ' '], $missingCat)),
                    'value' => $missingCat,
                    'color' => $additionalColors[$colorIndex],
                    'position' => $position++,
                ];
            }
        }

        foreach ($categories as $category) {
            DB::table('crm_calendar_category')->updateOrInsert(
                ['cal_cat_value' => $category['value']],
                [
                    'cal_cat_name' => $category['name'],
                    'cal_cat_value' => $category['value'],
                    'cal_cat_color' => $category['color'],
                    'cal_cat_position' => $category['position'],
                    'cal_created_at' => now(),
                    'cal_update_at' => now(),
                ]
            );
        }

        // Upewnij się, że wszystkie kategorie używane w wydarzeniach mają unikalne kolory
        $this->ensureUniqueColors();
    }

    /**
     * Upewnij się, że wszystkie kategorie mają unikalne kolory
     */
    private function ensureUniqueColors(): void
    {
        // Pobierz wszystkie kategorie używane w wydarzeniach
        $usedCategories = DB::table('crm_calendar')
            ->distinct()
            ->whereNotNull('cal_category')
            ->pluck('cal_category')
            ->toArray();

        // Pobierz wszystkie kategorie z bazy
        $dbCategories = DB::table('crm_calendar_category')
            ->whereIn('cal_cat_value', $usedCategories)
            ->get();

        // Sprawdź czy wszystkie mają kolory i czy są unikalne
        $usedColors = [];

        foreach ($dbCategories as $cat) {
            if (empty($cat->cal_cat_color) || in_array($cat->cal_cat_color, $usedColors)) {
                // Przypisz nowy unikalny kolor
                $newColor = $this->getUniqueColor($usedColors);
                DB::table('crm_calendar_category')
                    ->where('cal_cat_id', $cat->cal_cat_id)
                    ->update(['cal_cat_color' => $newColor]);
                $usedColors[] = $newColor;
            } else {
                $usedColors[] = $cat->cal_cat_color;
            }
        }

        // Dodaj brakujące kategorie z wydarzeń
        $existingValues = $dbCategories->pluck('cal_cat_value')->toArray();
        $missing = array_diff($usedCategories, $existingValues);

        if (! empty($missing)) {
            $additionalColors = [
                '#8b5cf6', // fioletowy
                '#06b6d4', // cyjan
                '#f59e0b', // pomarańczowy
                '#ef4444', // czerwony
                '#10b981', // zielony
                '#3b82f6', // niebieski
                '#ec4899', // różowy
                '#6366f1', // indigo
            ];

            $maxPosition = DB::table('crm_calendar_category')->max('cal_cat_position') ?? 0;
            $position = $maxPosition + 1;

            foreach ($missing as $missingCat) {
                $newColor = $this->getUniqueColor($usedColors);

                DB::table('crm_calendar_category')->insert([
                    'cal_cat_name' => ucfirst(str_replace(['bg-', '-'], ['', ' '], $missingCat)),
                    'cal_cat_value' => $missingCat,
                    'cal_cat_color' => $newColor,
                    'cal_cat_position' => $position++,
                    'cal_created_at' => now(),
                    'cal_update_at' => now(),
                ]);

                $usedColors[] = $newColor;
            }
        }
    }

    /**
     * Zwraca unikalny kolor, który nie jest jeszcze używany
     */
    private function getUniqueColor(array $usedColors): string
    {
        $availableColors = [
            '#727cf5', // primary
            '#0acf97', // success
            '#39afd1', // info
            '#ffbc00', // warning
            '#fa5c7c', // danger
            '#6c757d', // secondary
            '#313a46', // dark
            '#eef2f7', // light
            '#8b5cf6', // fioletowy
            '#06b6d4', // cyjan
            '#f59e0b', // pomarańczowy
            '#ef4444', // czerwony
            '#10b981', // zielony
            '#3b82f6', // niebieski
            '#ec4899', // różowy
            '#6366f1', // indigo
            '#14b8a6', // teal
            '#f97316', // orange
            '#84cc16', // lime
            '#a855f7', // purple
        ];

        foreach ($availableColors as $color) {
            if (! in_array($color, $usedColors)) {
                return $color;
            }
        }

        // Jeśli wszystkie kolory są zajęte, wygeneruj losowy
        return sprintf('#%06x', mt_rand(0, 0xFFFFFF));
    }
}
