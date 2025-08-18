<?php

declare(strict_types=1);

namespace App\Providers;

use FiveamCode\LaravelNotionApi\NotionFacade;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Table;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Console\Commands\SyncPermissions;

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
        /*   Gate::policy(Role::class, RolePolicy::class);
          Gate::policy(Permission::class, PermissionPolicy::class); */
        $this->migrationsCustomPath();

        Table::configureUsing(fn (Table $table): Table => $table->defaultNumberLocale('hu'));

        // Register NotionFacade
        $loader = AliasLoader::getInstance();
        $loader->alias('Notion', NotionFacade::class);

        ToggleButtons::configureUsing(function (ToggleButtons $toggleButtons): void {
            $toggleButtons->translateLabel();

        });

        // Register lightweight permissions sync command so tests and seeders can call it.
        if ($this->app->runningInConsole()) {
            $this->commands([
                SyncPermissions::class,
            ]);
        }

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
