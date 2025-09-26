<?php

declare(strict_types=1);

namespace App\Providers;

use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Table;
use FiveamCode\LaravelNotionApi\NotionFacade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Cashier::calculateTaxes();
        Number::useCurrency('HUF');
        $this->migrationsCustomPath();

        Table::configureUsing(fn (Table $table): Table => $table->defaultNumberLocale('hu'));

        // Register NotionFacade
        $loader = AliasLoader::getInstance();
        $loader->alias('Notion', NotionFacade::class);

        ToggleButtons::configureUsing(function (ToggleButtons $toggleButtons): void {
            $toggleButtons->translateLabel();

        });
    }

    private function migrationsCustomPath(): void
    {
        $this->loadMigrationsFrom([
            database_path('migrations/basics'),
            database_path('migrations/formStarter'),
            database_path('migrations/permission'),
            database_path('migrations/stripe'),
            database_path('migrations/requestQuote'),
            database_path('migrations/project'),
            database_path('migrations/formQuestion'),

        ]);
    }
}
