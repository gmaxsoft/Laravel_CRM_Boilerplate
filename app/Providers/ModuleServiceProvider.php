<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Rejestracja usług – ładowanie widoków z modułów.
     */
    public function register(): void
    {
        $modulesPath = app_path('Modules');

        if (! is_dir($modulesPath)) {
            return;
        }

        $modules = array_filter(glob($modulesPath.'/*'), 'is_dir');

        foreach ($modules as $module) {
            $moduleName = basename($module);
            $viewsPath = $module.'/Views';

            if (is_dir($viewsPath)) {
                $this->loadViewsFrom($viewsPath, strtolower($moduleName));
            }
        }
    }

    /**
     * Uruchomienie – rejestracja tras modułów.
     */
    public function boot(): void
    {
        $modulesPath = app_path('Modules');

        if (! is_dir($modulesPath)) {
            return;
        }

        $modules = array_filter(glob($modulesPath.'/*'), 'is_dir');

        foreach ($modules as $module) {
            $moduleName = basename($module);
            $routesPath = $module.'/Routes/routes.php';

            if (file_exists($routesPath)) {
                // Auth i Dashboard bez prefiksu module/
                if (in_array(strtolower($moduleName), ['auth', 'dashboard'])) {
                    Route::middleware('web')
                        ->group($routesPath);
                } else {
                    // Pozostałe moduły z prefiksem module/{nazwa}
                    Route::middleware('web')
                        ->prefix('module/'.strtolower($moduleName))
                        ->group($routesPath);
                }
            }
        }
    }
}
