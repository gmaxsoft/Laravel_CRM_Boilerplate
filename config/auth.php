<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Domyślne ustawienia uwierzytelniania
    |--------------------------------------------------------------------------
    |
    | Domyślna straż (guard) i broker resetowania hasła.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Straże uwierzytelniania (guards)
    |--------------------------------------------------------------------------
    |
    | Straż korzysta z sesji i dostawcy użytkowników (Eloquent).
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Dostawcy użytkowników (providers)
    |--------------------------------------------------------------------------
    |
    | Określają, skąd pobierani są użytkownicy (np. model Eloquent).
    | Wspierane: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', \Modules\Users\Models\User::class),
        ],

        // Przykład dostawcy opartego o tabelę:
        // 'users' => ['driver' => 'database', 'table' => 'users'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetowanie haseł
    |--------------------------------------------------------------------------
    |
    | Tabela tokenów, czas ważności (minuty) i throttle (sekundy) między
    | generowaniem kolejnych tokenów.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Limit czasu potwierdzenia hasła (sekundy)
    |--------------------------------------------------------------------------
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
