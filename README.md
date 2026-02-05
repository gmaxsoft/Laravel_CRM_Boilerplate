# CRM Boilerplate

Panel CRM z modułową strukturą – zarządzanie klientami, ogłoszeniami, kalendarzem, dokumentami i użytkownikami.

Projekt jest zbudowany w **architekturze modułowej (Modular Monolith)**: jedna aplikacja Laravel, w której funkcjonalność jest podzielona na autonomiczne moduły (`app/Modules/`). Każdy moduł zawiera własne modele, kontrolery, widoki, trasy i tłumaczenia, co ułatwia rozwój i utrzymanie oraz ewentualne wydzielenie modułów w przyszłości.

## Technologie

### Backend
- **PHP** 8.2+
- **Laravel** 12
- **Baza danych**: MySQL / MariaDB (produkcja), SQLite (testy)
- **Autentykacja**: Laravel Session (wbudowana)
- **Bezpieczeństwo**: CSRF protection, Rate limiting (5 prób/min na logowanie)
- **Cache**: Laravel Cache dla statystyk i często używanych danych
- **Testy**: PHPUnit 11 (Unit, Feature, Integration)

### Frontend
- **Blade** – szablony Laravel
- **Bootstrap** 5.3 – layout i komponenty UI
- **Bootstrap Icons** 1.11
- **Font Awesome** 6.5 – ikony
- **jQuery** 3.7
- **Bootstrap Table** 1.22 – tabele z filtrami, sortowaniem, paginacją
- **Chart.js** 4.4 – wykresy (Dashboard)
- **Vite** 7 – budowanie assetów (Tailwind 4 w projekcie)
- **Bootstrap 5 Modal** – okna potwierdzenia (np. usuwanie rekordów) z pełną obsługą ARIA dla dostępności (role="dialog", aria-labelledby, aria-describedby, aria-modal)

### Narzędzia deweloperskie
- **Laravel Pint** – formatowanie kodu PHP
- **Laravel Sail** – Docker dla Laravel
- **Laravel Boost** – narzędzia MCP
- **Faker** – dane testowe
- **Laravel Tinker** – REPL

## Moduły aplikacji

| Moduł | Opis |
|-------|------|
| **Dashboard** | Strona startowa, statystyki (klienci, ogłoszenia, wydarzenia, użytkownicy) z cache'owaniem |
| **Klienci** | CRUD klientów (baza `crm_customers_db`) z eager loading relacji |
| **Ogłoszenia** | CRUD ogłoszeń / magazyn (`crm_advertisements`) z cache'owaniem lookup tables |
| **Kalendarz** | Wydarzenia i kategorie (`crm_calendar`, `crm_calendar_category`) |
| **Dokumenty** | Upload i zarządzanie plikami (`crm_document_files`) |
| **Przypadki (Cases)** | Zarządzanie przypadkami biznesowymi (`crm_case`) |
| **Pliki (Files)** | Zarządzanie plikami powiązanymi z klientami, przypadkami i ogłoszeniami |
| **Logi** | Historia zmian, logi email, logi cron (`crm_*_log`) |
| **Użytkownicy** | CRUD użytkowników (`crm_users`) z eager loading relacji |
| **Uprawnienia (Access)** | Zarządzanie poziomami dostępu (`crm_access`) |
| **Ustawienia** | Kategorie kalendarza i inne ustawienia systemowe |
| **Auth** | Logowanie / wylogowanie z rate limiting (5 prób/min) |

## Wymagania

- PHP 8.2+
- Composer
- Node.js i npm (dla Vite)
- MySQL/MariaDB lub SQLite

## Instalacja

```bash
# Zależności PHP
composer install

# Konfiguracja
cp .env.example .env
php artisan key:generate

# Baza danych – ustaw DB_* w .env, potem:
php artisan migrate

# (Opcjonalnie) link do storage
php artisan storage:link

# Zależności frontendu
npm install
npm run build
```

## Języki / Lokalizacja

Interfejs aplikacji (menu, formularze, przyciski, tabele) jest dostępny w dwóch wersjach językowych: **polskiej** i **angielskiej**.

### Zmiana języka

W pliku **`.env`** ustaw zmienną **`APP_LANG`**:

```env
# Język interfejsu: pl (polski) lub en (angielski)
APP_LANG=pl
```

- `APP_LANG=pl` – polski (domyślny)
- `APP_LANG=en` – angielski

Po zmianie wartości uruchom:

```bash
php artisan config:clear
```

Tłumaczenia modułów znajdują się w katalogach `app/Modules/<Moduł>/Lang/pl/` i `app/Modules/<Moduł>/Lang/en/` (pliki `lang.json`). Aplikacja korzysta z helpera `module_lang()` do ładowania tekstów zgodnie z bieżącą lokalizacją.

## Uruchomienie

- **Laravel Herd** (zalecane): aplikacja dostępna jako `https://crm-boilerplate.test`
- **Laravel Sail**: `./vendor/bin/sail up`
- **Wbudowany serwer**: `php artisan serve` (oraz np. `npm run dev` dla Vite)

## Testy

```bash
# Wszystkie testy
php artisan test --compact

# Tylko testy modułów (Unit + Feature)
php artisan test --compact tests/Unit/Modules tests/Feature/Modules

# Testy integracyjne workflow'ów między modułami
php artisan test --compact tests/Feature/Modules/Integration
```

### Typy testów

- **Unit Tests**: Testy modeli i klas jednostkowych
- **Feature Tests**: Testy funkcjonalności modułów (CRUD, autoryzacja)
- **Integration Tests**: Testy workflow'ów między modułami (np. Customer → Document → Case)

## CI (GitHub Actions)

W katalogu `.github/workflows/` znajduje się workflow **Tests** (`tests.yml`), który przy każdym pushu i pull requeście do gałęzi `main` lub `master`:

- uruchamia środowisko z PHP 8.4,
- instaluje zależności Composer (z cache),
- generuje klucz aplikacji,
- uruchamia testy (`php artisan test --compact`),
- sprawdza styl kodu Laravel Pint (`pint --test`).

Testy używają SQLite in-memory (konfiguracja w `phpunit.xml`).

## Formatowanie kodu

```bash
vendor/bin/pint --dirty --format agent
```

## Bezpieczeństwo

Aplikacja implementuje następujące mechanizmy bezpieczeństwa:

- **CSRF Protection**: Wszystkie formularze POST używają tokenów CSRF (`@csrf` w Blade)
- **Rate Limiting**: Route logowania ograniczony do 5 prób na minutę (middleware `throttle:5,1`)
- **Autentykacja**: Wymagana dla wszystkich modułów (middleware `auth`)
- **Autoryzacja**: Kontrola uprawnień na poziomie użytkownika (`user_level`)

## Wydajność

Aplikacja wykorzystuje następujące optymalizacje:

- **Eager Loading**: Relacje ładowane z wyprzedzeniem w kontrolerach (np. `Customer::with('trader')`)
- **Cache'owanie**: Statystyki dashboardu i lookup tables cache'owane (5 min - 24h)
- **Query Optimization**: Unikanie problemów N+1 poprzez eager loading i cache'owanie

## Licencja

MIT

## Licencja

MIT
