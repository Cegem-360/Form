<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\NotionService;
use Illuminate\Support\ServiceProvider;

final class NotionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(NotionService::class, function ($app) {
            return new NotionService();
        });

        // Alias regisztrálása (opcionális)
        $this->app->alias(NotionService::class, 'notion');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Config fájl publikálása
        $this->publishes([
            __DIR__.'/../../config/notion.php' => config_path('notion.php'),
        ], 'notion-config');
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [NotionService::class, 'notion'];
    }
}
