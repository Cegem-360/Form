<?php

declare(strict_types=1);

namespace App\Filament\Admin\Pages;

use App\Enums\RolesEnum;
use App\Filament\Admin\Clusters\Reseller\ResellerCluster;
use App\Filament\Admin\Resources\UserResource;
use App\Models\User;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use UnitEnum;

final class ResellerUsers extends Page implements HasTable
{
    /*   use InteractsWithForms; */
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserPlus;

    protected static string $resource = UserResource::class;

    protected static ?string $modelLabel = 'Viszont eladó';

    protected static ?string $pluralModelLabel = 'Viszont eladók';

    protected static string|null|UnitEnum $navigationGroup = 'Viszont eladók';

    protected static ?string $cluster = ResellerCluster::class;

    protected static ?string $title = 'Viszont eladók';

    protected string $view = 'filament.admin.pages.reseller-users';

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return User::query()->role(RolesEnum::RESELLER);
            })
            ->columns([
                TextColumn::make('name'),
            ])
            ->filters([
                // ...
            ])
            ->recordActions([
                EditAction::make()->url(fn (User $record): string => UserResource::getUrl('edit', ['record' => $record]))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                // ...
            ]);
    }

    /*
        public function render(): View
        {
            return view('filament.admin.pages.reseller-users');
        } */
}
