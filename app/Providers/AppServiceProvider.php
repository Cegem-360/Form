<?php

declare(strict_types=1);

namespace App\Providers;

use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        Model::automaticallyEagerLoadRelationships();
        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(Permission::class, PermissionPolicy::class);
        $this->migrationsCustomPath();

        Table::$defaultNumberLocale = 'hu';

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
