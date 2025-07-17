<?php

declare(strict_types=1);

namespace App\Providers;

use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Wizard\Step;
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
        /*   Gate::policy(Role::class, RolePolicy::class);
          Gate::policy(Permission::class, PermissionPolicy::class); */
        $this->migrationsCustomPath();

        Table::configureUsing(fn (Table $table): Table => $table->defaultNumberLocale('hu'));

        ToggleButtons::configureUsing(function (ToggleButtons $component): void {
            $component->translateLabel();
        });
        TextInput::configureUsing(function (TextInput $component): void {
            $component->translateLabel();
        });
        Select::configureUsing(function (Select $component): void {
            $component->translateLabel();
        });
        Checkbox::configureUsing(function (Checkbox $component): void {
            $component->translateLabel();
        });
        CheckboxList::configureUsing(function (CheckboxList $component): void {
            $component->translateLabel();
        });
        Repeater::configureUsing(function (Repeater $component): void {
            $component->translateLabel();
        });
        Step::configureUsing(function (Step $component): void {
            $component->translateLabel();
        });
        RichEditor::configureUsing(function (RichEditor $component): void {
            $component->translateLabel();
        });
        FileUpload::configureUsing(function (FileUpload $component): void {
            $component->translateLabel();
        });
        Action::configureUsing(function (Action $component): void {
            $component->translateLabel();
        });
        Toggle::configureUsing(function (Toggle $component): void {
            $component->translateLabel();
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
