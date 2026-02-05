<?php

if (! function_exists('module_lang')) {
    /**
     * Pobiera tekst interfejsu z pliku lang.json modułu (etykiety, menu, przyciski itp.).
     */
    function module_lang(string $module, string $key, array $replace = [], ?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();
        $modulePath = app_path("Modules/{$module}/Lang/{$locale}/lang.json");

        if (! file_exists($modulePath)) {
            $fallbackLocale = config('app.fallback_locale');
            if ($fallbackLocale !== $locale) {
                $modulePath = app_path("Modules/{$module}/Lang/{$fallbackLocale}/lang.json");
            }
            if (! file_exists($modulePath)) {
                return $key;
            }
        }

        $data = json_decode(file_get_contents($modulePath), true);
        if (! $data) {
            return $key;
        }

        $keys = explode('.', $key);
        $value = $data;
        foreach ($keys as $k) {
            if (! isset($value[$k])) {
                return $key;
            }
            $value = $value[$k];
        }
        if (! is_string($value)) {
            return $key;
        }
        foreach ($replace as $search => $replacement) {
            $value = str_replace(':'.$search, $replacement, $value);
        }

        return $value;
    }
}

if (! function_exists('module_trans')) {
    /**
     * Pobiera tłumaczenie z pliku JSON modułu.
     */
    function module_trans(string $module, string $key, array $replace = [], ?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();
        $modulePath = app_path("Modules/{$module}/Lang/{$locale}/messages.json");

        if (! file_exists($modulePath)) {
            $fallbackLocale = config('app.fallback_locale');
            if ($fallbackLocale !== $locale) {
                $modulePath = app_path("Modules/{$module}/Lang/{$fallbackLocale}/messages.json");
            }
            if (! file_exists($modulePath)) {
                return $key;
            }
        }

        $messages = json_decode(file_get_contents($modulePath), true);

        if (! $messages) {
            return $key;
        }

        $keys = explode('.', $key);
        $value = $messages;

        foreach ($keys as $k) {
            if (! isset($value[$k])) {
                return $key;
            }

            $value = $value[$k];
        }

        if (! is_string($value)) {
            return $key;
        }

        foreach ($replace as $search => $replacement) {
            $value = str_replace(':'.$search, $replacement, $value);
        }

        return $value;
    }
}
