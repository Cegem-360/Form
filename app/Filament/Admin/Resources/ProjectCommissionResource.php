<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Clusters\Settings\SettingsCluster;
use App\Filament\Admin\Resources\ProjectCommissionResource\Pages\CreateProjectCommission;
use App\Filament\Admin\Resources\ProjectCommissionResource\Pages\EditProjectCommission;
use App\Filament\Admin\Resources\ProjectCommissionResource\Pages\ListProjectCommissions;
use App\Models\ProjectCommission;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class ProjectCommissionResource extends Resource
{
    protected static ?string $model = ProjectCommission::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = SettingsCluster::class;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')
                    ->relationship('project', 'name'),
                Select::make('user_id')
                    ->relationship('user', 'name'),
                TextInput::make('commission_amount')
                    ->numeric(),
                TextInput::make('commission_percent')
                    ->numeric(),
                TextInput::make('commission_paid_amount')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('commission_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('commission_percent')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('commission_paid_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjectCommissions::route('/'),
            'create' => CreateProjectCommission::route('/create'),
            'edit' => EditProjectCommission::route('/{record}/edit'),
        ];
    }
}
