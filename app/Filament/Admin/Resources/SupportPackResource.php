<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Clusters\ProjectOption\ProjectOptionCluster;
use App\Filament\Admin\Resources\SupportPackResource\Pages\CreateSupportPack;
use App\Filament\Admin\Resources\SupportPackResource\Pages\EditSupportPack;
use App\Filament\Admin\Resources\SupportPackResource\Pages\ListSupportPacks;
use App\Filament\Admin\Resources\SupportPackResource\Pages\ViewSupportPack;
use App\Models\SupportPack;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

final class SupportPackResource extends Resource
{
    protected static ?string $model = SupportPack::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string|UnitEnum|null $navigationGroup = 'Project';

    protected static ?string $cluster = ProjectOptionCluster::class;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
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
                ViewAction::make(),
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
            'index' => ListSupportPacks::route('/'),
            'create' => CreateSupportPack::route('/create'),
            'view' => ViewSupportPack::route('/{record}'),
            'edit' => EditSupportPack::route('/{record}/edit'),
        ];
    }
}
